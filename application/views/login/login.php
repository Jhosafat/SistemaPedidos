<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Login - Sistema Aquitectos</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes"> 

        <link href="<?= base_url("resources/css/bootstrap.min.css") ?>" rel="stylesheet" type="text/css" />
        <link href="<?= base_url("resources/css/bootstrap-responsive.min.css") ?>" rel="stylesheet" type="text/css" />

        <link href="<?= base_url("resources/css/font-awesome.css") ?>" rel="stylesheet">
        <link href="<?= base_url("resources/css/googlefonts.css") ?>" rel="stylesheet">

        <link href="<?= base_url("resources/css/style.css") ?>" rel="stylesheet" type="text/css">
        <link href="<?= base_url("resources/css/pages/signin.css") ?>" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div class="navbar navbar-fixed-top">

            <div class="navbar-inner">

                <div class="container">

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="index.html">
                        Sistema Administrativo				
                    </a>		

                    <div class="nav-collapse">
                        <ul class="nav pull-right">
                            <!--
                            <li class="">						
                                    <a href="signup.html" class="">
                                            Don't have an account?
                                    </a>
                                    
                            </li>
                            
                            <li class="">						
                                    <a href="index.html" class="">
                                            <i class="icon-chevron-left"></i>
                                            Back to Homepage
                                    </a>
                                    
                            </li>-->
                        </ul>

                    </div><!--/.nav-collapse -->	

                </div> <!-- /container -->

            </div> <!-- /navbar-inner -->

        </div> <!-- /navbar -->



        <div class="account-container">

            <div class="content clearfix">

                <form action="<?=base_url("index.php/login/val")?>" method="post">

                    <h1>Ingresar</h1>		

                    <div class="login-fields">

                        <p>Ingresa tus credenciales para ingresar</p>
 <?php
                            //obtenemos el resultado
                            $data_error = $this->session->flashdata('data_error');
                            $datas = $this->session->flashdata();
                            if ($data_error == "TRUE") {
                                echo "<p style='color:#e81123;'>La cuenta o la contraseña es incorrecta</p>";
                            }

                            //obtenemos el resultado
                            $user_error = $this->session->flashdata('user_error');
                            if ($user_error == "TRUE") {
                                echo "<p style='color:#e81123;'>Escribe una cuenta.</p>";
                            }
                            ?>
                        <div class="field">
                           
                            <label for="username">Usuario:</label>
                            <input type="text" id="txt_user" name="txt_user" value="" placeholder="Usuario" class="login username-field" />
                        </div> <!-- /field -->
<?php
                            $pass_error = $this->session->flashdata('pass_error');
                            if ($pass_error == "TRUE") {
                                echo "<p style='color:#e81123;'>Escribe la contrase&ntilde;a de tu cuenta</p>";
                            }
                            ?>
                        <div class="field">
                            
                            <label for="password">Conrase&ntilde;a:</label>
                            <input type="password" id="txt_pass" name="txt_pass" value="" placeholder="Conrase&ntilde;a" class="login password-field"/>
                        </div> <!-- /password -->

                    </div> <!-- /login-fields -->

                    <div class="login-actions">
                        <!--
                        <span class="login-checkbox">
                                <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                                <label class="choice" for="Field">Keep me signed in</label>
                        </span>-->

                        <button type="submit" class="button btn btn-success btn-large">Ingresar</button>

                    </div> <!-- .actions -->
                </form>
            </div> <!-- /content -->
        </div> <!-- /account-container -->

        <script src="<?= base_url("resources/js/jquery-1.7.2.min.js") ?>"></script>
        <script src="<?= base_url("resources/js/bootstrap.js") ?>"></script>

        <script src="<?= base_url("resources/js/signin.js") ?>"></script>

    </body>

</html>
