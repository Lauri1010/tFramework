<?php namespace tFramework; ?>
<!DOCTYPE html>
<!--
	ustora by freshdesignweb.com
	Twitter: https://twitter.com/freshdesignweb
	URL: https://www.freshdesignweb.com/ustora/
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Ustora Demo</title>
    <style>
    .sethidden{
    	visibility:hidden;
    }
/*     #giosg_live_chat_dialog{
    	display: inline!important;
    } */
    </style>
    <!-- Google Fonts -->
    <?php if(DEVELOPMENT_ENVIRONMENT){?>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <?php }else{?>
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>
    <?php }?>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?php echo cssFolder; ?>bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo cssFolder; ?>font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo cssFolder; ?>owl.carousel.css">
    <link rel="stylesheet" href="<?php echo cssFolder; ?>style.css">
    <link rel="stylesheet" href="<?php echo cssFolder; ?>responsive.css">
    <script async type="text/javascript" src="<?php echo jsFolder; ?>loader.js"></script>
  </head>
<?php 
require SNIPPLETS.'bodyStart.php';