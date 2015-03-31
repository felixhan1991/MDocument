<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo base_url().APPPATH.'views/default/';?>images/favicon.png">

    <title><?= $template['title']; ?></title>

    <!--Core CSS -->
    <link href="<?php echo base_url().APPPATH.'themes/default/views/';?>bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url().APPPATH.'themes/default/views/';?>css/bootstrap-reset.css" rel="stylesheet">
    <link href="<?php echo base_url().APPPATH.'themes/default/views/';?>font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url().APPPATH.'themes/default/views/';?>css/style.css" rel="stylesheet">
    <link href="<?php echo base_url().APPPATH.'themes/default/views/';?>css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">

    <div class="container">
        <?=  $template['body']; ?>
    </div>



    <!-- Placed js at the end of the document so the pages load faster -->

    <!--Core js-->
    <script src="<?php echo base_url().APPPATH.'themes/default/views/';?>js/jquery.js"></script>
    <script src="<?php echo base_url().APPPATH.'themes/default/views/';?>bs3/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url().APPPATH.'themes/default/views/';?>js/jquery.validate.js"></script>
    <script src="<?php echo base_url().APPPATH.'themes/default/views/';?>js/validation-init.js"></script>
    
  </body>
</html>
