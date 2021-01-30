<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 1.0
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="IT Helpdesk Administrator">
  <meta name="keywords" content="IT, helpdesk, system">
  <title>Helpdesk IT</title>

  <!-- Favicons-->
  <link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->

  <link href="admin/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="admin/css/style.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="admin/css/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="admin/css/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="admin/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->



  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" action="proseslogin.php" method="POST" name="formku" id="formku">
        <div class="row">
          <div class="input-field col s12 center">
            <!-- <img src="images/login-logo.png" alt="" class="circle responsive-img valign profile-image-login"> -->
            <p class="center login-form-text">Login Helpdesk IT</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" name="username" type="text" autocomplete="new-password" autofocus="on">
            <label for="username" class="center-align">Username</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password" autocomplete="off">
            <label for="password">Password</label>
          </div>
        </div>
        <!-- <div class="row">          
          <div class="input-field col s12 m12 l12  login-text">
              <input type="checkbox" id="remember-me" />
              <label for="remember-me">Remember me</label>
          </div>
        </div> -->
        <div class="row">
          <div class="input-field col s12">
            <button type="submit" class="btn waves-effect waves-light col s12" name="login" id="login">Login</button>
          </div>
        </div>
        <!-- <div class="row">
          <div class="input-field col s6 m6 l6">
            <p class="margin medium-small"><a href="page-register.html">Register Now!</a></p>
          </div>
          <div class="input-field col s6 m6 l6">
              <p class="margin right-align medium-small"><a href="page-forgot-password.html">Forgot password ?</a></p>
          </div>          
        </div> -->
        <center>Copyright &copy; Yongki Agustin<br /><br /></center>
      </form>
    </div>



    <!-- ================================================
    Scripts
    ================================================ -->

    <!-- jQuery Library -->
    <script type="text/javascript" src="admin/js/jquery-1.11.2.min.js"></script>
    <!--materialize js-->
    <script type="text/javascript" src="admin/js/materialize.js"></script>
    <!--prism-->
    <script type="text/javascript" src="admin/js/prism.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="admin/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="admin/js/plugins.js"></script>

</body>

</html>