<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use GuzzleHttp\Promise\Utils;
use Exception;
use DateTime;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getClientGateway($project, $api, $method)
    {
        $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
        switch ($project) {
                /**
             * Project JAVA
             */
            case ENUM_PROJECT_ID_JAVA_OAUTH:
                $api = '/api/' . ENUM_PREFIX_JAVA_OAUTH . $api;
                $token = 'Basic ' . Session::get(SESSION_JAVA_KEY_SESSION) . ':' . Session::get(SESSION_JAVA_TOKEN_OAUTH);
                break;
            case ENUM_PROJECT_ID_JAVA_DASHBOARD:
                $api = '/api/' . ENUM_PREFIX_JAVA_DASHBOARD . $api;
                break;
            case ENUM_PROJECT_ID_JAVA_REPORT:
                $api = '/api/' . ENUM_PREFIX_JAVA_REPORT . $api;
                break;
            case ENUM_PROJECT_ID_JAVA_INVOICES:
                $api = '/api/' . ENUM_PREFIX_JAVA_INVOICES . $api;
                break;
                /**
                 * Project Nest
                 */
            case ENUM_PROJECT_ID_NEST_LOGS:
                $api = '/api/' . ENUM_PREFIX_NEST_LOGS . $api;
                break;
            case ENUM_PROJECT_ID_NEST_UPLOAD:
                $api = '/api/' . ENUM_PREFIX_NEST_UPLOAD . $api;
                break;
            case ENUM_PROJECT_ID_NEST_USER:
                $api = '/api/' . ENUM_PREFIX_NEST_USER . $api;
                break;
            case ENUM_PROJECT_ID_NEST_TIMELINE:
                $api = '/api/' . ENUM_PREFIX_NEST_TIMELINE . $api;
                break;
            case ENUM_PROJECT_ID_NEST_COMMENT:
                $api = '/api/' . ENUM_PREFIX_NEST_COMMENT . $api;
                break;
            case ENUM_PROJECT_ID_NEST_CONVERSATION:
                $api = '/api/' . ENUM_PREFIX_NEST_CONVERSATION . $api;
                break;
            case ENUM_PROJECT_ID_NEST_MESSAGE:
                $api = '/api/' . ENUM_PREFIX_NEST_MESSAGE . $api;
                break;
            case ENUM_PROJECT_ID_NEST_STICKER:
                $api = '/api/' . ENUM_PREFIX_NEST_STICKER . $api;
                break;
            case ENUM_PROJECT_ID_NEST_REMINDER:
                $api = '/api/' . ENUM_PREFIX_NEST_REMINDER . $api;
                break;
            default:
                break;
        }
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $token,
                'ProjectId' => $project,
                'Content-Type' => 'application/json',
                'Method' => $method
            ],
        ]);
        return [$client, $api, $token, $project];
    }

    public function callApiGatewayTemplateChat($project, $method, $api, $body)
    {
        $dataClient = $this->getClientGateway($project, $api, $method);
        $api = $dataClient[1];
        $token = $dataClient[2];
        $request = 'http://localhost:9024' . $api;
        $methodType = ($method === 0) ? "GET" : "POST";
        try {
            $time_before = microtime(true);
            $response = $dataClient[0]->request($methodType, 'http://localhost:9024' . $api, [
                'http_errors' => false,
                'json' => $body,
                'timeout' => 15,
                'connect_timeout' => 15
            ]);
            $time_after = microtime(true);
            if ($response->getStatusCode() === 401) {
                if ($this->refreshToken() === true && Session::get(SESSION_KEY_CHECK_REFRESH_TOKEN) === false) {
                    Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, true);
                    $this->callApiGatewayTemplate($project, $method, $api, $body);
                } else {
                    Session::put(SESSION_STATUS_SERVER, Config::get('constants.type.checkbox.SELECTED'));
                    return [
                        'status' => 401,
                        'config' => 'Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body)
                    ];
                }
            }
            Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, false);
            $data = json_decode($response->getBody(), true);
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId: ' . $dataClient[3] . ' Method: ' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
                $data['time_api'] = number_format($time_after - $time_before, 3) . 's';
                $data['time_before'] = $time_before;
                $data['time_after'] = $time_after;
            }
            return $data;
        } catch (Exception $e) {
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId:' . $project . ' Method:' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
            }
            $data['error'] = $e;
            return $data;
        }
    }

    public function callApiGatewayTemplate($project, $method, $api, $body)
    {
        $dataClient = $this->getClientGateway($project, $api, $method);
        $api = $dataClient[1];
        $token = $dataClient[2];
        $request = Config::get('app.DOMAIN_GATEWAY') . $api;
        $methodType = ($method === 0) ? "GET" : "POST";
        try {
            $time_before = microtime(true);
            $response = $dataClient[0]->request($methodType, Config::get('app.DOMAIN_GATEWAY') . $api, [
                'http_errors' => false,
                'json' => $body,
                'timeout' => 15,
                'connect_timeout' => 15
            ]);
            $time_after = microtime(true);
            if ($response->getStatusCode() === 401) {
                if ($this->refreshToken() === true && Session::get(SESSION_KEY_CHECK_REFRESH_TOKEN) === false) {
                    Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, true);
                    $this->callApiGatewayTemplate($project, $method, $api, $body);
                } else {
                    Session::put(SESSION_STATUS_SERVER, Config::get('constants.type.checkbox.SELECTED'));
                    return [
                        'status' => 401,
                        'config' => 'Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body)
                    ];
                }
            }
            Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, false);
            $data = json_decode($response->getBody(), true);
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId: ' . $dataClient[3] . ' Method: ' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
                $data['time_api'] = number_format($time_after - $time_before, 3) . 's';
                $data['time_before'] = $time_before;
                $data['time_after'] = $time_after;
            }
            return $data;
        } catch (Exception $e) {
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId:' . $project . ' Method:' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
            }
            $data['error'] = $e;
            return $data;
        }
    }

    public function callApiMultiGatewayTemplate($data)
    {
        try {
            $responses = [];
            $request = [];
            foreach ($data as $db) {
                $dataClient = $this->getClientGateway($db['project'], $db['api'], $db['method']);
                $methodType = ($db['method'] === 0) ? "GET" : "POST";
                array_push($responses, $dataClient[0]->requestAsync($methodType, Config::get('app.DOMAIN_GATEWAY') . $dataClient[1], ['http_errors' => false, 'json' => $db['body']]));
                array_push($request, 'ProjectId: ' . $db['project'] . ' Method: ' . $db['method'] . ' Token:' . $dataClient[2] . ' Request:' . Config::get('app.DOMAIN_GATEWAY') . $dataClient[1] . ' Body:' . json_encode($db['body']));
            }
            $time_before = microtime(true);
            $wait = Utils::unwrap($responses);
            $response = [];
            $time_after = microtime(true);
            for ($i = 0; $i < count($wait); $i++) {
                if ($wait[$i]->getStatusCode() === 401) {
                    if ($this->refreshToken() === true && Session::get(SESSION_KEY_CHECK_REFRESH_TOKEN) === false) {
                        Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, true);
                        $this->callApiMultiGatewayTemplate($data);
                    } else {
                        Session::put(SESSION_STATUS_SERVER, Config::get('constants.type.checkbox.SELECTED'));
                    }
                } else {
                    $response[$i] = json_decode($wait[$i]->getBody(), true);
                }
                if (env('APP_DEBUG') === true) {
                    $response[$i]['config'] = $request[$i];
                }
            }
            Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, false);
            $response['time_api'] = number_format($time_after - $time_before, 3) . 's';
            $response['time_before'] = $time_before;
            $response['time_after'] = $time_after;
            return $response;
        } catch (Exception $e) {
            if (env('APP_DEBUG') === true) {
                return [
                    'config' => $response,
                    'File Error' => $e->getFile(),
                    'Line Error' => $e->getLine(),
                    'Error' => $e->getMessage()
                ];
            } else {
                return [
                    'File Error' => $e->getFile(),
                    'Line Error' => $e->getLine(),
                    'Error' => $e->getMessage()
                ];
            }
        }
    }

    public function getClientGateway2($project, $api, $method)
    {
        switch ($project) {
            case ENUM_PROJECT_ID_OAUTH:
                $api = '/api' . ENUM_PREFIX_OAUTH . $api;
                $token = 'Basic ' . Session::get(SESSION_JAVA_KEY_SESSION) . ':' . Session::get(SESSION_JAVA_TOKEN_OAUTH);
                break;
            case ENUM_PROJECT_ID_OAUTH_ALOLINE:
                $api = '/api' . ENUM_PREFIX_OAUTH_ALOLINE . $api;
                $token = 'Basic ' . Session::get(SESSION_JAVA_KEY_SESSION) . ':' . Session::get(SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE);
                break;
            case ENUM_PROJECT_ID_OAUTH2:
            case ENUM_PROJECT_ID_ORDER2:
            case ENUM_PROJECT_ID_PROMOTION:
                $api = '/api' . ENUM_PREFIX_OAUTH . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_TMS:
                $api = '/api' . ENUM_PREFIX_TMS . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_ORDER:
            case ENUM_PROJECT_ID_ORDER_VERSION:
                $api = '/api' . ENUM_PREFIX_ORDER . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.CHAT'):
                $api = '/api' . ENUM_PREFIX_CHAT . $api;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.UPLOAD'):
                $api = '/api' . ENUM_PREFIX_UPLOAD . $api;
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.REPORT_NODE'):
                $api = '/api' . ENUM_PREFIX_REPORT . $api;
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE'):
                $token = 'Basic ' . Session::get(SESSION_NODE_CONFIG_NODE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE_ALOLINE'):
                $token = 'Basic ' . Session::get(SESSION_NODE_KEY_CONFIG_NODE_ALOLINE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.ALOLINE_NODE'):
            case ENUM_PROJECT_ID_ALOLINE_USER:
            case ENUM_PROJECT_ID_ALOLINE_TIMELINE:
                $api = '/api' . ENUM_PREFIX_ALOLINE . $api;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_JAVA_REPORT:
                $api = '/api' . ENUM_PREFIX_REPORT . $api;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_INVOICES:
                $api = '/api' . ENUM_PREFIX_INVOICE . $api;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_UPLOAD_V2:
                $api = '/api' . ENUM_PREFIX_UPLOAD . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.LOGS'):
                $api = '/api' . ENUM_PREFIX_LOG . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_CONVERSATION:
                $api = '/api' . ENUM_PREFIX_CONVERSATION . $api;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            default:
                $token = '';
                break;
        }
        switch ($project) {
            case Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION'):
            case Config::get('constants.GATEWAY.PROJECT_ID.ORDER2'):
            case ENUM_PROJECT_ID_ORDER_VERSION:
                $project = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH2'):
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_ALOLINE'):
                $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE_ALOLINE'):
                $project = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE');
                break;
        }
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $token,
                'ProjectId' => $project,
                'Content-Type' => 'application/json',
                'Method' => $method
            ],
        ]);
        return [$client, $api, $token, $project];
    }

    public function callApiGatewayTemplate2($project, $method, $api, $body)
    {
        $data_client = $this->getClientGateway2($project, $api, $method);
        $client = $data_client[0];
        $api = $data_client[1];
        $token = $data_client[2];
        $request = Config::get('app.DOMAIN_GATEWAY') . $api;
        $methodType = ($method === 0) ? "GET" : "POST";
        try {
            $time_before = microtime(true);
            $response = $client->request($methodType, Config::get('app.DOMAIN_GATEWAY') . $api, [
                'http_errors' => false,
                'json' => $body,
                'timeout' => 15,
                'connect_timeout' => 15
            ]);
            $time_after = microtime(true);
            if ($response->getStatusCode() === 401) {
                if ($this->refreshToken() === true && Session::get(SESSION_KEY_CHECK_REFRESH_TOKEN) === false) {
                    Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, true);
                    $this->callApiGatewayTemplate2($project, $method, $api, $body);
                } else {
                    Session::put(SESSION_STATUS_SERVER, Config::get('constants.type.checkbox.SELECTED'));
                    return [
                        'status' => 401,
                        'config' => 'Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body)
                    ];
                }
            }
            Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, false);
            $data = json_decode($response->getBody(), true);
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId: ' . $data_client[3] . ' Method: ' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
                $data['time_api'] = number_format($time_after - $time_before, 3) . 's';
                $data['time_before'] = $time_before;
                $data['time_after'] = $time_after;
            }
            return $data;
        } catch (Exception $e) {
            if (env('APP_DEBUG') === true) {
                $data['config'] = 'ProjectId:' . $project . ' Method:' . $method . ' Token:' . $token . ' Request:' . $request . ' Body:' . json_encode($body);
            }
            $data['error'] = $e;
            return $data;
        }
    }

    public function getClientMulti2($data)
    {
        $domain = '';
        switch ($data['project']) {
            case ENUM_PROJECT_ID_OAUTH:
                $domain = '/api' . ENUM_PREFIX_OAUTH . $data['api'];
                $token = 'Basic ' . Session::get(SESSION_JAVA_TOKEN_OAUTH);
                break;
            case ENUM_PROJECT_ID_OAUTH_ALOLINE:
                $domain = '/api' . ENUM_PREFIX_ALOLINE . $data['api'];
                $token = 'Basic ' . Session::get(SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE);
                break;
            case ENUM_PROJECT_ID_OAUTH2:
            case ENUM_PROJECT_ID_ORDER2:
            case ENUM_PROJECT_ID_PROMOTION:
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_TMS:
                $domain = '/api' . ENUM_PREFIX_TMS . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_ORDER:
            case ENUM_PROJECT_ID_ORDER_VERSION:
                $domain = '/api' . ENUM_PREFIX_ORDER . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_CHAT:
                $domain = '/api' . ENUM_PREFIX_CHAT . $data['api'];
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_UPLOAD:
                $domain = '/api' . ENUM_PREFIX_UPLOAD . $data['api'];
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_REPORT_NODE:
                $domain = '/api' . ENUM_PREFIX_REPORT . $data['api'];
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_OAUTH_NODE:
                $token = 'Basic ' . Session::get(SESSION_NODE_CONFIG_NODE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE_ALOLINE'):
                $token = 'Basic ' . Session::get(SESSION_NODE_KEY_CONFIG_NODE_ALOLINE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.ALOLINE_NODE'):
            case ENUM_PROJECT_ID_ALOLINE_USER:
            case ENUM_PROJECT_ID_ALOLINE_TIMELINE:
                $domain = '/api' . ENUM_PREFIX_ALOLINE . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_REPORT_NODE_V2:
                $domain = '/api' . ENUM_PREFIX_REPORT . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_INVOICES:
                $domain = '/api' . ENUM_PREFIX_INVOICE . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_UPLOAD_V2:
                $domain = '/api' . ENUM_PREFIX_UPLOAD . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_LOGS:
                $domain = '/api' . ENUM_PREFIX_LOG . $data['api'];
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            default:
                $token = '';
                break;
        }
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $token,
                'Content-Type' => 'application/json',
                'ProjectId' => $data['project'],
                'Method' => $data['method']
            ],
        ]);
        return [$client, $domain, $token];
    }

    public function callApiMultiGatewayTemplate2($data)
    {
        if (count($data) === 0) {
            return false;
        }
        try {
            $responses = [];
            $request = [];
            foreach ($data as $db) {
                switch ($db['project']) {
                    case Config::get('constants.GATEWAY.PROJECT_ID.PROMOTION'):
                    case ENUM_PROJECT_ID_ORDER_VERSION:
                        $db['project'] = Config::get('constants.GATEWAY.PROJECT_ID.ORDER');
                        break;
                    case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH2'):
                        $db['project'] = Config::get('constants.GATEWAY.PROJECT_ID.OAUTH');
                        break;
                }
                $data_client = $this->getClientMulti2($db);
                $client = $data_client[0];
                $domain = $data_client[1];
                $token = $data_client[2];
                $api = $domain;
                $methodType = ($db['method'] === 0) ? "GET" : "POST";
                $data_req = [];
                $data_req['config'] = 'ProjectId: ' . $db['project'] . ' Method: ' . $db['method'] . ' Token:' . $token . ' Request:' . Config::get('app.DOMAIN_GATEWAY') . $domain . ' Body:' . json_encode($db['body']);
                array_push($responses, $client->requestAsync($methodType, Config::get('app.DOMAIN_GATEWAY') . $api, ['http_errors' => false, 'json' => $db['body']]));
                array_push($request, ['data' => $data_req, 'token' => $token]);
            }
            $time_before = microtime(true);
            $wait = Utils::unwrap($responses);
            $response = [];
            $time_after = microtime(true);
            for ($i = 0; $i < count($wait); $i++) {
                if ($wait[$i]->getStatusCode() === 401) {
                    if ($this->refreshToken() === true && Session::get(SESSION_KEY_CHECK_REFRESH_TOKEN) === false) {
                        Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, true);
                        $this->callApiMultiGatewayTemplate2($data);
                    } else {
                        Session::put(SESSION_STATUS_SERVER, Config::get('constants.type.checkbox.SELECTED'));
                    }
                } else {
                    $response[$i] = json_decode($wait[$i]->getBody(), true);
                }
                if (env('APP_DEBUG') === true) {
                    $response[$i]['config'] = $request[$i]['data']['config'];
                }
            }
            Session::put(SESSION_KEY_CHECK_REFRESH_TOKEN, false);
            $response['time_api'] = number_format($time_after - $time_before, 3) . 's';
            $response['time_before'] = $time_before;
            $response['time_after'] = $time_after;
            return $response;
        } catch (Exception $e) {
            if (env('APP_DEBUG') === true) {
                return [
                    'config' => $response,
                    'File Error' => $e->getFile(),
                    'Line Error' => $e->getLine(),
                    'Error' => $e->getMessage()
                ];
            } else {
                return [
                    'File Error' => $e->getFile(),
                    'Line Error' => $e->getLine(),
                    'Error' => $e->getMessage()
                ];
            }
        }
    }

    /**
     * Bắt buộc dùng chung PROJECT
     */

    public function getClientMulti($project)
    {
        $domain = '';
        switch ($project) {
            case ENUM_PROJECT_ID_OAUTH:
                $domain = '/api' . ENUM_PREFIX_OAUTH . $domain;
                $token = 'Basic ' . Session::get(SESSION_JAVA_TOKEN_OAUTH);
                break;
            case ENUM_PROJECT_ID_OAUTH_ALOLINE:
                $domain = '/api' . ENUM_PREFIX_ALOLINE . $domain;
                $token = 'Basic ' . Session::get(SESSION_JAVA_KEY_TOKEN_OAUTH_ALOLINE);
                break;
            case ENUM_PROJECT_ID_OAUTH2:
            case ENUM_PROJECT_ID_ORDER2:
            case ENUM_PROJECT_ID_PROMOTION:
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_TMS:
                $domain = '/api' . ENUM_PREFIX_TMS . $domain;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_ORDER:
                $domain = '/api' . ENUM_PREFIX_ORDER . $domain;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_ORDER_VERSION:
                $domain = '/api' . ENUM_PREFIX_ORDER . $domain;
                $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
                break;
            case ENUM_PROJECT_ID_CHAT:
                $domain = '/api' . ENUM_PREFIX_CHAT . $domain;
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_UPLOAD:
                $domain = '/api' . ENUM_PREFIX_UPLOAD . $domain;
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_REPORT_NODE:
                $domain = '/api' . ENUM_PREFIX_REPORT . $domain;
                $token = Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_OAUTH_NODE:
                $token = 'Basic ' . Session::get(SESSION_NODE_CONFIG_NODE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.OAUTH_NODE_ALOLINE'):
                $token = 'Basic ' . Session::get(SESSION_NODE_KEY_CONFIG_NODE_ALOLINE);
                break;
            case Config::get('constants.GATEWAY.PROJECT_ID.ALOLINE_NODE'):
            case ENUM_PROJECT_ID_ALOLINE_USER:
            case ENUM_PROJECT_ID_ALOLINE_TIMELINE:
                $domain = '/api' . ENUM_PREFIX_ALOLINE . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_REPORT_NODE_V2:
                $domain = '/api' . ENUM_PREFIX_REPORT . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_INVOICES:
                $domain = '/api' . ENUM_PREFIX_INVOICE . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_UPLOAD_V2:
                $domain = '/api' . ENUM_PREFIX_UPLOAD . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            case ENUM_PROJECT_ID_LOGS:
                $domain = '/api' . ENUM_PREFIX_LOG . $domain;
                $token = 'Bearer ' . Session::get(SESSION_NODE_KEY_ACCESS_TOKEN_CHAT);
                break;
            default:
                $token = '';
                break;
        }
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => $token,
                'Content-Type' => 'application/json',
            ],
        ]);
        return [$client, $domain, $token];
    }

    public function convertApiTemplate($api)
    {
        $x = strstr($api, '?');
        $api = str_replace($x, '', $api);
        $x = str_replace('?', '', $x);
        $x = str_replace('&', '","', $x);
        $x = str_replace('=', '":"', $x);
        $x = str_replace('/', '\/', $x);
        $x = '{"' . $x . '"}';
        $x = json_decode($x, true);
        $x['is_force_online'] = 1;
        return [$api, $x];
    }

    public function refreshToken()
    {
        $client = new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . Session::get(SESSION_JAVA_TOKEN_OAUTH),
                'Content-Type' => 'application/json',
            ],
        ]);
        $data = [
            'request_url' => API_AUTH_POST_REFRESH_TOKEN,
            'project_id' => Config::get('constants.GATEWAY.PROJECT_ID.OAUTH'),
            'http_method' => 1, // 0: get, 1: post
            'is_production_mode' => Config::get('app.MODE_GATEWAY'), // 0: beta, 1: live
            'os_name' => Config::get('app.PROJECT_NAME'),
            'params' => [
                'refresh_token' => Session::get(SESSION_JAVA_ACCOUNT)['refresh_token']
            ]
        ];
        try {
            $response = $client->request('POST', Config::get('app.DOMAIN_GATEWAY'), [
                'http_errors' => false,
                'json' => $data
            ]);
            $data = json_decode($response->getBody(), true);
            if ($data['status'] == Config::get('constants.type.status.STATUS_SUCCESS')) {
                Session::put(SESSION_JAVA_ACCOUNT, $data['data']);
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function keySearchDatatableTemplate($data)
    {
        try {
            foreach ($data as $db => $v) {
                if (gettype($v) === 'array') {
                    try {
                        $data[$db] = mb_strtolower(implode($v));
                    } catch (Exception $e) {
                        $data[$db] = '';
                    }
                }
            }
            $data = mb_strtolower(implode($data));
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            );
            foreach ($unicode as $nonUnicode => $uni) {
                $data = preg_replace("/($uni)/i", $nonUnicode, $data);
            }
            $data = str_replace(' ', '', $data);
            return $data;
        } catch (Exception $e) {
            dd($e, $data);
        }
    }

    public function keySearchFilterTemplate($data)
    {
        try {
            $data = mb_strtolower($data);
            $unicode = array(
                'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
                'd' => 'đ',
                'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
                'i' => 'í|ì|ỉ|ĩ|ị',
                'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
                'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
                'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            );
            foreach ($unicode as $nonUnicode => $uni) {
                $data = preg_replace("/($uni)/i", $nonUnicode, $data);
            }
            $data = str_replace(' ', '', $data);
            return $data;
        } catch (Exception $e) {
            dd($e, $data);
        }
    }

    public function convertRomanNumberTemplate($number)
    {
        try {
            $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
            $value = '';
            while ($number > 0) {
                foreach ($map as $roman => $int) {
                    if ($number >= $int) {
                        $number -= $int;
                        $value .= $roman;
                        break;
                    }
                }
            }
            return $value;
        } catch (Exception $e) {
            dd($e, $number);
        }
    }

    public function convertFileUploadTemplate($file)
    {
        try {
            $name = $file->getClientOriginalName();
            $size = $file->getSize();
            $name = 'web-' . time() . '-' . $name;
            $path = $file->move(public_path('images/upload/'), $name);
            return [$name, $path, $size];
        } catch (Exception $e) {
            dd($file, $e);
        }
    }

    public function removeDomainMediaTemplate($media)
    {
        $domain = Session::get(SESSION_NODE_KEY_BASE_URL_ADS);
        return str_replace($domain, "", $media);
    }

    public function getClient()
    {
        return new Client([
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . Session::get(SESSION_JAVA_TOKEN),
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function checkServiceRestaurantLevel()
    {
        $isLevel = Session::get(SESSION_KEY_LEVEL);
        if ($isLevel > 0) {
            return false;
        } else {
            return true;
        }
    }

    public function convertDayToDayMonthYear($day)
    {
        $years = ($day / 365);
        $years = floor($years);
        $month = ($day % 365) / 30.5;
        $month = floor($month);
        $days = ($day % 365) % 30.5;
        ($years > 0) ? $years_str = $years . ' năm, ' : $years_str = '';
        ($month > 0) ? $month_str = $month . ' tháng, ' : $month_str = '';
        $day_tr = $days . ' ngày';
        return $years_str . $month_str . $day_tr;
    }

    public function convertDateUsingSort($date)
    {
        $date = str_replace('/', '-', $date);
        $date = date('Y-m-d H:i', strtotime($date));
        $date = str_replace('-', '', $date);
        $date = str_replace(':', '', $date);
        return str_replace(' ', '', $date);
    }

    public function getFacebookUrl($request, $api_name)
    {
        return Session::get(SESSION_KEY_FACEBOOK_URL) . $api_name;
    }

    public function getBaseUrlFacebook($api_name)
    {
        return Config::get('app.HOST_API_FACEBOOK') . $api_name;
    }

    public function callApiFacebookTemplate($request, $method, $api, $body)
    {
        try {

            $client = new Client();
            $response = $client->request($method, $this->getBaseUrlFacebook($api), [
                'http_errors' => false,
                'json' => $body
            ]);
            $token = Session::get(SESSION_KEY_ACCESS_TOKEN_FACEBOOK);
            $request = $this->getBaseUrlFacebook($api);
            $body = json_encode($body);
            $data = json_decode($response->getBody(), true);
            $data['config'] = 'Token:' . $token . 'Request:' . $request . 'Body:' . $body;
            return $data;
        } catch (Exception $e) {
            return [
                'File Error' => $e->getFile(),
                'Line Error' => $e->getLine(),
                'Error' => $e->getMessage()
            ];
        }
    }

    public function catchTemplate($config, $e)
    {
        //        if ($config['status'] !== Config::get('constants.type.status.STATUS_SUCCESS')) {
        //            return $config;
        //        } else {
        return [
            'Config' => $config,
            'File Error' => $e->getFile(),
            'Line Error' => $e->getLine(),
            'Error' => $e->getMessage()
        ];
        //        }
    }

    public function numberFormat($num)
    {
        if (!is_numeric($num)) return $num;
        if (($num > 1000 || $num < -1000) && (fmod($num, 1) === 0.00)) {
            return number_format($num);
        } else {
            switch (strlen(substr(strrchr($num, "."), 1))) {
                case 0:
                    return number_format($num);
                case 1:
                    return number_format($num, 1);
                case 2:
                    return number_format($num, 2);
                default:
                    return number_format($num, 3);
            }
        }
    }

    public function removeNumberFormat($num)
    {
        return str_replace(',', '', $num);
    }

    public function convertTimeReport($time, $type, $index)
    {
        switch ((int)$type) {
            case 1:
                return substr($time, 11, 2);
            case 2:
                switch ((int)$time) {
                    case Config::get('constants.type.WeekTimeText.MONDAY'):
                        return TEXT_MONDAY;
                    case Config::get('constants.type.WeekTimeText.TUESDAY'):
                        return TEXT_TUESDAY;
                    case Config::get('constants.type.WeekTimeText.WEDNESDAY'):
                        return TEXT_WEDNESDAY;
                    case Config::get('constants.type.WeekTimeText.THURSDAY'):
                        return TEXT_THURSDAY;
                    case Config::get('constants.type.WeekTimeText.FRIDAY'):
                        return TEXT_FRIDAY;
                    case Config::get('constants.type.WeekTimeText.SATURDAY'):
                        return TEXT_SATURDAY;
                    case Config::get('constants.type.WeekTimeText.SUNDAY'):
                        return TEXT_SUNDAY;
                    default:
                        return $time;
                }
            case 3:
                return substr($time, -2);
            case 4:
            case 5:
            case 6:
                return substr($time, 5, 2);
            case 7:
                return substr($time, 0, 4);
            default:
                return $time;
        }
    }

    public function rateDefaultTemplate($numerator, $denominator)
    {
        if ($numerator === 0 && $denominator === 0) {
            $rate = 0;
        } else if ($denominator === 0) {
            $rate = 1;
        } else {
            $rate = $numerator / $denominator;
        }
        return $rate;
    }

    public function keySearch($key)
    {
        return str_replace(",", "", sprintf($key));
    }

    public function removeSpecialCharacterAttr($str)
    {
        if ($str === "") return $str;
        $str = str_replace('"', '', $str);
        return str_replace("'", "", $str);
    }

    public function covertTimeReport($time, $type, $index)
    {
        try {
            switch ((int)$type) {
                case 1: // DAY
                    //                    return substr($time, 11, 2);
                    return date_format(date_create($time . ':00'), 'H:i');
                case 2: // WEEK
                    switch ((int)$index) {
                        case Config::get('constants.type.WeekTimeType.MONDAY'):
                            return TEXT_MONDAY;
                        case Config::get('constants.type.WeekTimeType.TUESDAY'):
                            return TEXT_TUESDAY;
                        case Config::get('constants.type.WeekTimeType.WEDNESDAY'):
                            return TEXT_WEDNESDAY;
                        case Config::get('constants.type.WeekTimeType.THURSDAY'):
                            return TEXT_THURSDAY;
                        case Config::get('constants.type.WeekTimeType.FRIDAY'):
                            return TEXT_FRIDAY;
                        case Config::get('constants.type.WeekTimeType.SATURDAY'):
                            return TEXT_SATURDAY;
                        case Config::get('constants.type.WeekTimeType.SUNDAY'):
                            return TEXT_SUNDAY;
                        default:
                            return $time;
                    }
                case 3: // MONTH
                    return date_format(date_create($time), 'd/m');
                case 4:
                case 13:
                    return date_format(date_create($time), 'd/m/Y');
                case 5:
                case 6: // YEAR
                case 15:
                    return date_format(date_create($time), 'm/Y');
                case 7: // ALL YEAR
                case 8: // ALL YEAR
                case 16:
                    return date_format(date_create($time), 'Y');
                default:
                    return $time;
            }
        } catch (Exception $e) {
            return $time;
        }
    }

    public function covertTimeReportNewCustomer($time, $type, $index)
    {
        try {
            switch ((int)$type) {
                case 1: // DAY
                    return substr($time, 11, 2);
                    return date_format(date_create($time), 'H');
                case 2: // WEEK
                    switch ((int)$index) {
                        case Config::get('constants.type.WeekTimeType.MONDAY'):
                            return TEXT_MONDAY;
                        case Config::get('constants.type.WeekTimeType.TUESDAY'):
                            return TEXT_TUESDAY;
                        case Config::get('constants.type.WeekTimeType.WEDNESDAY'):
                            return TEXT_WEDNESDAY;
                        case Config::get('constants.type.WeekTimeType.THURSDAY'):
                            return TEXT_THURSDAY;
                        case Config::get('constants.type.WeekTimeType.FRIDAY'):
                            return TEXT_FRIDAY;
                        case Config::get('constants.type.WeekTimeType.SATURDAY'):
                            return TEXT_SATURDAY;
                        case Config::get('constants.type.WeekTimeType.SUNDAY'):
                            return TEXT_SUNDAY;
                        default:
                            return $time;
                    }
                case 3: // MONTH
                    return date_format(date_create($time), 'm/Y');
                case 4:
                case 13:
                    return date_format(date_create($time), 'm/d//Y');
                case 5:
                case 6: // YEAR
                case 15:
                    return date_format(date_create($time), 'd/Y');
                case 7: // ALL YEAR
                case 8: // ALL YEAR
                case 16:
                    return date_format(date_create($time), 'Y');
                default:
                    return $time;
            }
        } catch (Exception $e) {
            return $time;
        }
    }

    public function covertTimeDetailReport($time, $type, $reportTime, $index)
    {
        try {
            switch ((int)$type) {
                case 1: // DAY
                    $type = 0;
                    $time = date_format(date_create($time), 'H d/m/Y');
                    return [$type, $time];
                case 2: // WEEK
                    $type = 1;
                    $dto = new DateTime();
                    $dto->setISODate(substr($reportTime, 3, 4), substr($reportTime, 0, 2));
                    $time = $dto->modify('+' . $index . ' days')->format('d/m/Y');
                    return [$type, $time];
                case 3: // MONTH
                    $type = 1;
                    $time = date_format(date_create($time), 'd/m/Y');
                    return [$type, $time];
                case 4: // MONTH
                case 5: // YEAR
                case 6: // YEAR
                    $type = 3;
                    $time = date_format(date_create($time), 'm/Y');
                    return [$type, $time];
                case 7: // ALL YEAR
                    $type = 5;
                    $time = date_format(date_create($time), 'Y');
                    return [$type, $time];
                case 13: // DAY TO DAY
                    $type = 13;
                    $time = date_format(date_create($time), 'H d/m/Y');
                    return [$type, $time];
                case 15: // MONTH
                    $type = 15;
                    $time = date_format(date_create($time), 'm/Y');
                    return [$type, $time];
                case 16: // ALL YEAR
                    $type = 16;
                    $time = date_format(date_create($time), 'Y');
                    return [$type, $time];
                default:
                    dd($type, $time);
                    return '';
            }
        } catch (Exception $e) {
            return $time;
        }
    }

    public function returnHourMinuteFromTimeTemplate($time)
    {
        return date_format(date_create($time), 'H:i');
    }

    public function formatFromTimeTemplate($time)
    {
        try {
            $dateCurrent = new DateTime();
            $date = new DateTime($time);
            $days = $dateCurrent->diff($date)->format("%a");
            $hours = $dateCurrent->diff($date)->format("%h");
            $minutes = $dateCurrent->diff($date)->format("%i");
            //            $seconds = $dateCurrent->diff($date)->format("%s");
            if ($days > 9) {
                return date_format(date_create($time), 'd/m');
            } else if ($days > 0) {
                return $days . ' ngày ';
                //            } else if ($days > 9) {
                //                return date_format(date_create($time), 'd/m/Y');
            } else if ($hours > 0) {
                return $hours . ' giờ ';
            }
            if ($minutes > 0) {
                return $minutes . ' phút ';
            }
            return ' Vài giây ';
        } catch (Exception $e) {
            dd($e, $time);
        }
    }
    public function formatFromTimeTemplateChat($time)
    {
        try {
            $dateCurrent = new DateTime();
            $date = new DateTime($time);
            $date->modify('+7 hours');
            $days = $dateCurrent->diff($date)->format("%a");
            $hours = $dateCurrent->diff($date)->format("%h");
            $minutes = $dateCurrent->diff($date)->format("%i");
            if ($days > 9) {
                return date_format(date_create($time), 'd/m');
            } else if ($days > 0) {
                return $days . ' ngày ';
            } else if ($hours > 0) {
                return $hours . ' giờ ';
            }
            if ($minutes > 0) {
                return $minutes . ' phút ';
            }
            return ' Vài giây ';
        } catch (Exception $e) {
            dd($e, $time);
        }
    }

    public function compareTwoArrayTemplate($arr1, $arr2, $key1, $key2)
    {
        $arr2 = collect($arr2)->pluck($key2)->toArray();
        $arrayDiff = [];
        foreach ($arr1 as $db) {
            if (!in_array($db[$key1], $arr2)) array_push($arrayDiff, $db);
        }
        return $arrayDiff;
    }

    /**
     * Bắt đầu
     */


    public function getBaseUrl($api_name)
    {
        return Session::get(SESSION_JAVA_BASE_URL) . $api_name;
    }

    public function getBaseADS($api_name)
    {
        return Config::get('app.DOMAIN_GATEWAY') . $api_name;
    }

    public function callApiTemplate($request, $method, $api, $body)
    {
        try {
            $client = $this->getClient();
            $response = $client->request($method, $this->getBaseUrl($api), [
                'http_errors' => false,
                'json' => $body
            ]);
            if ($response->getStatusCode() === 401) {
                Session::put(SESSION_STATUS_SERVER, 1);
            }
            $token = 'Bearer ' . Session::get(SESSION_JAVA_TOKEN);
            $request = $this->getBaseUrl($api);
            $body = json_encode($body);
            $data = json_decode($response->getBody(), true);
            $data['config'] = 'Token:' . $token . ' Request:' . $request . ' Body:' . $body;
            return $data;
        } catch (Exception $e) {
            return $e;
        }
    }

    public function convertDateTime($dataTime)
    {
        if (strlen($dataTime) > 16) {

            $dataTime = substr($dataTime, 0, 16);
            $time = strtotime(str_replace('/', '-', $dataTime));
            $date = date('d/m/Y', $time);
            $time = date('H:i', $time);
            return '<div class="group-date-time-datatable">
                        <label class="date">' . $date . '</label>
                        <label class="time">' . $time . '</label>
                    </div>';
        } else if (strlen($dataTime) > 10) {
            $time = strtotime(str_replace('/', '-', $dataTime));
            $date = date('d/m/Y', $time);
            $time = date('H:i', $time);
            return '<div class="group-date-time-datatable">
                        <label class="date">' . $date . '</label>
                        <label class="time">' . $time . '</label>
                    </div>';
        } else {
            return $dataTime;
        }
    }

    public function checkPermission($permission)
    {
        if (count(array_intersect(Session::get(SESSION_PERMISSION), $permission)) > 0) {
            return [true];
        } else {
            return [false, $this->renderListPermission($permission)];
        }
    }

    public function checkLevel($level)
    {
        if ($level <= Session::get(SESSION_KEY_LEVEL)) {
            return [true];
        } else {
            return [false, 'Công ty của bạn chưa đăng ký sử dụng chức năng này [Gói dịch vụ Level ' . $level . ']'];
        }
    }

    public function checkOffice($type)
    {
        switch ($type) {
                /**
             * Chức năng không được hoạt động trên TH văn phòng -> yêu cầu User phải có thương hiệu chi nhánh
             */
            case 0:
                if (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('is_office', 0)->count() > 0) {
                    return [true];
                } else {
                    return [false, 'Chức năng yêu cầu tài khoản phải được cấp quyền hoạt động trên Thương hiệu'];
                }
                /**
                 * Chức năng chỉ được hoạt động trên TH văn phòng -> yêu cầu User phải có thương hiệu văn phòng
                 */
            case 1:
                if (collect(Session::get(SESSION_KEY_DATA_BRAND))->where('is_office', 1)->count() > 0) {
                    return [true];
                } else {
                    return [false, 'Chức năng yêu cầu tài khoản phải được cấp quyền hoạt động trên Công ty'];
                }
            default:
                return true;
        }
    }

    public function renderListPermission($permission)
    {
        $permission_name = [
            'BUSINESS_ACTIVE_REPORT' => 'QUYỀN XEM BÁO CÁO HOẠT ĐỘNG KINH DOANH TRÊN CHI NHÁNH',
            'TREASURE_REPORT' => 'BÁO CÁO HOẠT ĐỘNG CÔNG TY',
            'SETTING_MANAGER' => 'QUYỀN XÂY DỰNG DỮ LIỆU CHÍNH SÁCH CỦA TOÀN CÔNG TY',
            'ACCOUNTANT_ACCESS' => 'QUYỀN KẾ TOÁN CHI NHÁNH',
            'BRANCH_INVENTORY_MANAGEMENT' => 'QUYỀN QUẢN LÝ KHO CHI NHÁNH(DÀNH CHO KẾ TOÁN CHI NHÁNH)',
            'ACCOUNTING_MANAGER' => 'QUYỀN QUẢN LÝ CHUỖI THƯƠNG HIỆU  KẾ TOÁN',
            'MARKETING_MANAGER' => 'QUYỀN TRƯỞNG PHÒNG MARKETING',
            'ADDITION_FEE_MANAGER' => 'QUYỀN TẠO & CHỈNH SỬA PHIẾU THU CHI',
            'SALARY_MANAGER' => 'QUYỀN QUẢN LÝ LƯƠNG NHÂN VIÊN',
            'EMPLOYEE_MANAGER' => 'QUYỀN QUẢN LÝ NHÂN VIÊN',
            'TOPUP_CUSTOMER_CARD' => 'QUYỀN NẠP THẺ CHO KHÁCH HÀNG ALOLINE',
            'BOOKING_DEPOSIT_MANAGEMENT' => 'QUYỀN QUẢN LÝ NHẬN/TRẢ CỌC BOOKING',
            'RESTAURANT_GIFT_MANAGER' => 'QUYỀN QUẢN LÝ QUÀ TẶNG CHO KHÁCH HÀNG ALOLINE',
            'BOOKING_MANAGEMENT' => 'QUYỀN QUẢN LÝ BOOKING',
            'DASHBOARD_WEB_ACCESS' => 'QUYỀN TRUY CẬP VÀO HỆ THỐNG DASHBOARD WEB',
            'VIEW_ALL' => 'QUYỀN VIEW ALL HỆ THỐNG , CHỈ XEM KHÔNG ĐƯỢC SỬA',
            'SALE_REPORT' => 'BÁO CÁO BÁN HÀNG',
            'CASHIER_REPORT' => 'QUYỀN BÁN HÀNG DÀNH CHO THU NGÂN',
            'OWNER' => 'QUYỀN CHỦ NHÀ HÀNG',
        ];
        return array_intersect_key($permission_name, array_flip($permission));
    }
}
