<?php

$this->title = 'Login';
?>

<html lang="ru">
<head>

    <!-- App css -->
    <link href="asset/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="asset/css/icons.css" rel="stylesheet" type="text/css"/>
    <link href="asset/css/style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<div class="site-login">
    <div class="p-5"></div>

    <!-- Log In page -->
    <div class="row">
        <div class="col-lg-4 "></div>

        <div class="col-xl-4">
            <div class="card mb-0 shadow-none">
                <div class="card-body">
                    <div class="px-3">
                        <div class="media">
                            <a href="/" class="logo logo-admin"><img src="asset/images/logo-sm.png" height="55"
                                                                     alt="logo" class="my-3"></a>
                            <div class="media-body ml-3 align-self-center">
                                <h4 class="mt-0 mb-1">Авторизация</h4>
                                <p class="text-muted mb-0">Войдите в систему для прохождения обучения.</p>
                            </div>
                        </div>

                        <form class="form-horizontal my-4" action="index.html">
                            <div class="form-group">
                                <label for="username">Логин</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-outline font-16"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="username" placeholder="Enter username">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="userpassword">Пароль</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="mdi mdi-key font-16"></i></span>
                                    </div>
                                    <input type="password" class="form-control" id="userpassword" placeholder="Enter password">
                                </div>
                            </div>

                            <div class="form-group row mt-4">
                                <div class="col-sm-6"></div>
                                <div class="col-sm-6 text-right">
                                    <a href="pages-recoverpw-2.html" class="text-muted font-13"><i class="mdi mdi-lock"></i> Забыли пароль?</a>
                                </div>
                            </div>

                            <div class="form-group mb-0 row">
                                <div class="col-12 mt-2">
                                    <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Авторизоваться <i class="fas fa-sign-in-alt ml-1"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="m-3 text-center bg-light p-3 text-primary">
                        <h5 class="">Вы еще не зарегистрированы?</h5>
                        <a href="#" class="btn btn-primary btn-round waves-effect waves-light">Регистрация</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4"></div>
    </div>
    <!-- End Log In page -->

    <div class="p-lg-5"></div>
</div>
</body>
</html>