const firebaseConfig = {
    apiKey: "AIzaSyDEgXdhIllWTcGMvOThfJ7vZgElGYZ3lXI",
    authDomain: "techres-tms.firebaseapp.com",
    databaseURL: "https://techres-tms.firebaseio.com",
    projectId: "techres-tms",
    storageBucket: "techres-tms.appspot.com",
    messagingSenderId: "507549433713",
    appId: "1:507549433713:web:8eca878e1c859d26",
    measurementId: "G-93KVHGFENG"
}

$(function (){
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();
    if (getCookieShared('config-firebase') === undefined) {
        messaging.requestPermission()
            .then(() => {
                navigator.permissions.query({ name: 'notifications' }).then((permissionStatus) => {
                    permissionStatus.onchange = () => {
                        if(permissionStatus.state === 'granted' && getCookieShared('config-firebase') === undefined){
                            messaging.requestPermission()
                                .then(() => {
                                    firebase.auth().signOut();
                                    deleteCookieShared('config-firebase');
                                    return messaging.getToken()
                                })
                                .then(async (token) => {
                                    axios.interceptors.request.use((config) => {
                                        if (config.method == 'post' && config.url == 'push-token') {
                                            console.log(config);
                                        }
                                        return config;
                                    }, (error) => {
                                        return Promise.reject(error);
                                    });
                                    axios.interceptors.response.use((response) => {
                                        return response;
                                    }, (error) => {
                                        console.log(error);
                                        return Promise.reject(error);
                                    });

                                    await axios.post("/push-token", {
                                        Token: token
                                    }).then(res => {
                                        console.log('======= Thành công ========');
                                        console.log(res);
                                    }).catch(error => {
                                        console.log(error);
                                        return false;
                                    });
                                    saveCookieShared('config-firebase', token);
                                    // location.reload();
                                }).catch((err) => {
                                if (err.code === "messaging/permission-default") {
                                    if (!('Notification' in window)) {
                                        console.log("This browser does not support notifications.");
                                    } else {
                                        if (checkNotificationPromise()) {
                                            Notification.requestPermission()
                                                .then((permission) => {
                                                    handlePermission(permission);
                                                })
                                        } else {
                                            Notification.requestPermission(function (permission) {
                                                handlePermission(permission);
                                            });
                                        }
                                    }

                                } else {
                                    console.log('Chưa cấp quyền thông báo')
                                }
                            });
                        }
                    };
                });
                return messaging.getToken()
            })
            .then(async (token) => {
                axios.interceptors.request.use((config) => {
                    if (config.method == 'post' && config.url == 'push-token') {
                        console.log(config);
                    }
                    return config;
                }, (error) => {
                    return Promise.reject(error);
                });
                axios.interceptors.response.use((response) => {
                    return response;
                }, (error) => {
                    console.log(error);
                    return Promise.reject(error);
                });

                await axios.post("/push-token", {
                    Token: token
                }).then(res => {
                    console.log('======= Thành công ========');
                    console.log(res);
                }).catch(error => {
                    console.log(error);
                    return false;
                });
                saveCookieShared('config-firebase', token);
            }).catch((err) => {
            if (err.code === "messaging/permission-default") {
                if (!('Notification' in window)) {
                    console.log("This browser does not support notifications.");
                } else {
                    if (checkNotificationPromise()) {
                        Notification.requestPermission()
                            .then((permission) => {
                                handlePermission(permission);
                            })
                    } else {
                        Notification.requestPermission(function (permission) {
                            handlePermission(permission);
                        });
                    }
                }

            } else {
                console.log('Chưa cấp quyền thông báo')
            }
        });
    }

    function handlePermission(permission) {
        if (permission === 'denied' || permission === 'default') {
            Notification.requestPermission();
        } else {
            console.log('Được rồi')
        }
    }
    function checkNotificationPromise() {
        try {
            Notification.requestPermission().then();
        } catch (e) {
            return false;
        }
        return true;
    }
})
