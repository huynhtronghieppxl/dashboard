//env.GIT_BRANCH
//env.BRANCH_NAME
// Image infor in registry
def serviceName = "php-restaurant-dashboard"
def serviceNameSendEmail = "Web Restaurant Dashboard"

def dockerBuildTemplateDir = "${JENKINS_WORKSPACE}/TECHRES/WEB/docker-build"
def dockerBuildDir = "${JENKINS_WORKSPACE}/TECHRES/WEB/docker-build-${serviceName}"
def dockerImageEnvFlag = "BETA"

//helm param for upgrade
def helmNamespace = "beta"
def deployEnv = "beta"
def helmValues = "${JENKINS_WORKSPACE}/helm/management-web-service-helm/service-values.yaml"
def helmChart = "${JENKINS_WORKSPACE}/helm/management-web-service-helm/service"
def port = "8008"
def nodePort = "30818"

def configAPIOauthProjectId = "net.techres.order.api"

def mailSendTo = "all@overate-vntech.com"
def mailSubject = "Build result ${serviceNameSendEmail}"

switch(env.BRANCH_NAME) {
  case "beta":
    helmNamespace = "beta"
    deployEnv = "beta"
    dockerImageEnvFlag = "BETA"
    break
  case "staging":
    helmNamespace = "staging"
    deployEnv = "staging"
    dockerImageEnvFlag = "STAGING"
    break
  case "master":
    helmNamespace = "production"
    deployEnv = "production"
    dockerImageEnvFlag = "RELEASE"
    break
  default:
    break
}

def majorVersion = "1"
def minorVersion = "1"
def fixVersion = "0"
def buildVersion = "${BUILD_NUMBER}"
def version = "${majorVersion}.${minorVersion}.${fixVersion}-${dockerImageEnvFlag}-${buildVersion}"
def buildTime = Calendar.getInstance().getTime().format('dd-MM-YYYY.HH:mm',TimeZone.getTimeZone('GMT+7'))

def serviceIngressDomain = "${deployEnv}.${serviceName}.k8s"

pipeline {
    agent any
    environment {
      DOCKER_IMAGE_NAME = "${serviceName}"
      DOCKER_IMAGE = "overatevntech/${DOCKER_IMAGE_NAME}"
    }
    stages {
      stage("Build image and push registry") {
      steps {
        script {
          echo "Remove old file"
          sh "rm -rf WEB_SOURCE.tgz"
          sh "rm -rf ${dockerBuildDir}"
          sh "cp -rf ${dockerBuildTemplateDir} ${dockerBuildDir}"
          echo "Compress tar"
          sh "tar -czvf WEB_SOURCE.tgz *"
          echo "Move WEB_SOURCE.tgz to ${dockerBuildDir}"
          sh "mv WEB_SOURCE.tgz ${dockerBuildDir}/WEB_SOURCE.tgz"
          echo "Build docker image ${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE}:${version}"
          app = docker.build(DOCKER_IMAGE, dockerBuildDir)
          echo "Push image ${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE}:${version} to registry"
          docker.withRegistry(DOCKER_REGISTRY_URL, REGISTRY_CREDENTIAL_ID) {                       
             app.push(version)
          }
          sh "rm -rf ${dockerBuildDir}"
          echo "Remove docker image"
          sh "docker rmi ${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE}:${version} -f"
        }
      }
    }
    stage("Deploy service") {
      steps {
        script {
          SHORT_COMMIT = "${GIT_COMMIT[0..7]}"
          switch(env.BRANCH_NAME) {
            case "beta":
              sh "helm upgrade -i ${serviceName} -f ${helmValues} ${helmChart} --namespace ${helmNamespace} --set image.repository=${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE},image.tag=${version},nameOverride=${serviceName},fullnameOverride=${serviceName},service.port=${port},service.nodePort=${nodePort},configAPIOauthProjectId=${configAPIOauthProjectId},buildNumber=${version}-rv:${SHORT_COMMIT}-${buildTime},ingress.hosts[0].host=${serviceIngressDomain},affinity.nodeAffinity.requiredDuringSchedulingIgnoredDuringExecution.nodeSelectorTerms[0].matchExpressions[1].values[0]=${deployEnv}"
              break
            case "staging":
              nodePort = "30828"
              sh "helm upgrade -i ${serviceName} -f ${helmValues} ${helmChart} --namespace ${helmNamespace} --set image.repository=${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE},image.tag=${version},nameOverride=${serviceName},fullnameOverride=${serviceName},service.port=${port},service.nodePort=${nodePort},configAPIOauthProjectId=${configAPIOauthProjectId},buildNumber=${version}-rv:${SHORT_COMMIT}-${buildTime},ingress.hosts[0].host=${serviceIngressDomain},affinity.nodeAffinity.requiredDuringSchedulingIgnoredDuringExecution.nodeSelectorTerms[0].matchExpressions[1].values[0]=${deployEnv}"
              break
            case "master":
              break
            default:
              break
          }
          
        }
      }
    }
  }
  post{
    success {
        mail to: mailSendTo,
        subject: "[${deployEnv.toUpperCase()}][SUCCESS] ${mailSubject}",
        body: "Build thành công, có thể sẽ mất một khoảng thời gian để service khởi chạy sau khi email này được gửi.\n\n=============THÔNG TIN BẢN BUILD=============\nGitlab SHA commit: ${GIT_COMMIT[0..7]}\nBuild version: ${majorVersion}.${minorVersion}.${fixVersion}\nBuild number: ${buildVersion}\nBuild time: ${buildTime}\nDocker image: ${DOCKER_REGISTRY_DOMAIN}/${DOCKER_IMAGE}:${version}\nEnvironment: ${deployEnv.toUpperCase()}"
    }
    failure {
        mail to: mailSendTo,
        subject: "[${deployEnv.toUpperCase()}][FAILURE] ${mailSubject}",
        body: "Build lỗi.\n\n=============THÔNG TIN BẢN BUILD=============\nGitlab SHA commit: ${GIT_COMMIT[0..7]}\nBuild version: ${majorVersion}.${minorVersion}.${fixVersion}\nBuild number: ${buildVersion}\nBuild time: ${buildTime}\nEnvironment: ${deployEnv.toUpperCase()}"
    }
  }
}