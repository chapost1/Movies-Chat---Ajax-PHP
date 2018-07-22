<?php
if (isset($_SESSION['currentUser'])) {
    header('location: ./movies');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>JBMDb Login</title>
        <!--jQuery-->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--Bootsrtap-->
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <link href="../style/login_register.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div id="fullscreen_bg" class="fullscreen_bg"/>
        <div id="regContainer" class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="#" id="register-form-link">Register</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <label for="lUsername">Username</label>
                                            <input required="required" type="text" name="username" id="lUsername" tabindex="1" class="form-control" placeholder="Username" value="" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <label for="lPassword">Password</label>
                                            <input required="required" type="password" name="password" id="lPassword" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <!--                                        <div class="form-group text-center">
                                                                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                                                                    <label for="remember"> Remember Me</label>
                                                                                </div>-->
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="button" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In" onclick="checkValidation();">
                                                    <div id="lformConErr" class="rErr">Something is missing.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <form id="register-form" method="post" role="form" style="display: none;">
                                        <div class="form-group">
                                            <label for="rUsername">Username</label>
                                            <input required="required" type="text" name="username" id="rUsername" tabindex="1" class="form-control" placeholder="Username" value="" onblur="checkIfUserExist(this);">
                                            <div id="userConErr" class="rErr">Username already Exists.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rEmail">Email</label>
                                            <input required="required" type="email" name="email" id="rEmail" tabindex="2" class="form-control" placeholder="Email" value="" onblur="checkIfEmailExist(this);">
                                            <div id="emailConErr" class="rErr">Email already In Use.</div>
                                        </div>
                                        <div class="form-group">
                                            <label for="rPassword">Password</label>
                                            <input required="required" type="password" name="password" id="rPassword" tabindex="3" class="form-control" placeholder="Password" onblur="checkIfPassAreSame();">
                                        </div>
                                        <div class="form-group">
                                            <label for="rConfirmPassword">Confirm password</label>
                                            <input required="required" type="password" name="confirm-password" id="rConfirmPassword" tabindex="3" class="form-control" placeholder="Confirm Password" onblur="checkIfPassAreSame();">
                                            <div id="passConErr" class="rErr">Passwords Are Not The Same.</div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="button" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now" onclick="checkForm();">
                                                    <div id="formConErr" class="rErr">Not All Fields Are as excpected.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        ////// Register Or Login Handlers.
        $(function () {
            $('#login-form-link').click(function (e) {
                $("#login-form").delay(100).fadeIn(100);
                $("#register-form").fadeOut(100);
                $('#register-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
            $('#register-form-link').click(function (e) {
                $("#register-form").delay(100).fadeIn(100);
                $("#login-form").fadeOut(100);
                $('#login-form-link').removeClass('active');
                $(this).addClass('active');
                e.preventDefault();
            });
        });
        ///////
        var letRegisterU;
        var letRegisterE;
        var letRegisterP;
        ///////// Check if user exists in DB
        function checkIfUserExist(eUname) {
            let userConErr = document.getElementById('userConErr');
            let objectToSend = {userCheck: eUname.value};
            let url = '../Controllers/usersControllers/registerLoginControl.php';
            $.post(url, objectToSend, function (callBack) {
                if (callBack === 'exist' && eUname.value.length > 0) {
                    userConErr.style.display = "block";
                    letRegisterU = false;
                } else {
                    userConErr.style.display = "none";
                    letRegisterU = true;
                }
            })
        }
        //////// Check if Email exists in DB
        function checkIfEmailExist(eEmail) {
            let emailConErr = document.getElementById('emailConErr');
            let objectToSend = {emailCheck: eEmail.value};
            let url = '../Controllers/usersControllers/registerLoginControl.php';
            $.post(url, objectToSend, function (callBack) {
                if (callBack === 'exist' && eEmail.value.length > 0) {
                    emailConErr.innerHTML = 'Email already In Use.'
                    emailConErr.style.display = "block";
                    letRegisterE = false;
                } else if (callBack === 'bad Email' && eEmail.value.length > 0) {
                    emailConErr.innerHTML = 'Email Format is invalid.'
                    emailConErr.style.display = "block";
                    letRegisterE = false;
                } else {
                    emailConErr.style.display = "none";
                    letRegisterE = true;
                }
            })
        }
        ///////// Check if passwords are fine
        function checkIfPassAreSame() {
            let rPassword = document.getElementById('rPassword');
            let rConfirmPassword = document.getElementById('rConfirmPassword');
            let passConErr = document.getElementById('passConErr');
            if (!(rConfirmPassword.value === rPassword.value)) {
                passConErr.style.display = "block";
                letRegisterP = false;
            } else {
                passConErr.style.display = "none";
                letRegisterP = true;
            }
        }
        ;
        ///////// Check if everything is ok and CREATE user if does.
        function checkForm() {
            let myRegForm = document.getElementById('register-form');
            let formConErr = document.getElementById('formConErr');
            if (letRegisterE && letRegisterU && letRegisterP && myRegForm.checkValidity()) {
                //// form seems fine.
                formConErr.style.display = "none";
                let objectToSend = {username: document.getElementById('rUsername').value, email: document.getElementById('rEmail').value, password: document.getElementById('rPassword').value, register: null};
                let url = '../Controllers/usersControllers/registerLoginControl.php';
                $.post(url, objectToSend, function (callBack) {
                    if (callBack === "worked") {
                        /////// if user have created : take client to login place, insert username and autofocus password.
                        $("#login-form").delay(100).fadeIn(100);
                        $("#register-form").fadeOut(100);
                        $('#register-form-link').removeClass('active');
                        $(this).addClass('active');
                        document.getElementById('lUsername').value = document.getElementById('rUsername').value;
                        setTimeout(function () {
                            document.getElementById('lPassword').focus();
                        }, 200);
                        cleanR();
                    } else {
                        /// form is fine but something happened in DB..
                        formConErr.innerHTML = "Couldn't create User. Please Try Later";
                        formConErr.style.display = "block";
                    }
                })
            } else {
                //// oh nooo!
                formConErr.innerHTML = "Not All Fields Are as excpected.";
                formConErr.style.display = "block";
            }
        }
        ;
        ///cleanRegisterForm
        function cleanR() {
            document.getElementById('rPassword').value ="";
            document.getElementById('rConfirmPassword').value ="";
            document.getElementById('rUsername').value ="";
            document.getElementById('rEmail').value ="";
        };
        ////// Done creating
        ////// Done creating
        ////// 
        ///// Check IF usename & passwords are validate
        function checkValidation() {
            let myLoginForm = document.getElementById('login-form');
            let username = document.getElementById('lUsername').value;
            let password = document.getElementById('lPassword').value;
            let lformConErr = document.getElementById('lformConErr');
            if (myLoginForm.checkValidity()) {
                ////everything is full
                lformConErr.style.display = "none";
                ////check in DB Validation
                let objectToSend = {username: username, password: password, login: null};
                let url = '../Controllers/usersControllers/registerLoginControl.php';
                $.post(url, objectToSend, function (answer) {
                    if (answer === 'not exist') {
                        //// user and password arn't correct
                        lformConErr.innerHTML = 'Username OR password are Invalid.';
                        lformConErr.style.display = "block";
                    } else {
                        ////user and password are correct
                        lformConErr.style.display = "none";
                        window.location.reload();
                    }
                })
            } else {
                //// one or more of inputs are empty
                lformConErr.innerHTML = 'Something is missing.';
                lformConErr.style.display = "block";
            }
        }
    </script>
</html>
