<?php ?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
<meta charset="UTF-8">
<title><?php if(isset($title)){echo $title;} ?></title>
<?php if(isset($metad)){ ?><meta name="description" content="<?php echo $metad;}?>">
<style type="text/css">
/*      html{visibility: hidden;} */
</style>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
<style type="text/css">
body{color:#777}.pure-img-responsive{max-width:100%;height:auto}#layout,#menu,.menu-link{-webkit-transition:all .2s ease-out;-moz-transition:all .2s ease-out;-ms-transition:all .2s ease-out;-o-transition:all .2s ease-out;transition:all .2s ease-out}#layout{position:relative;left:0;padding-left:0}#layout.active #menu{left:150px;width:150px}#layout.active .menu-link{left:150px}#menu,.menu-link{position:fixed;top:0;left:0}.content{margin:0 auto 50px;padding:0 2em;max-width:800px;line-height:1.6em}.header{margin:0;color:#333;text-align:center;padding:2.5em 2em 0;border-bottom:1px solid #eee}.header h1{margin:.2em 0;font-size:3em;font-weight:300}.header h2{font-weight:300;color:#ccc;padding:0;margin-top:0}.content-subhead{margin:50px 0 20px;font-weight:300;color:#888}#menu{margin-left:-150px;width:150px;bottom:0;z-index:1000;background:#191818;overflow-y:auto;-webkit-overflow-scrolling:touch}#menu a{color:#999;border:none;padding:.6em 0 .6em .6em}#menu .pure-menu,#menu .pure-menu ul{border:none;background:0 0}#menu .pure-menu .menu-item-divided,#menu .pure-menu ul{border-top:1px solid #333}#menu .pure-menu li a:focus,#menu .pure-menu li a:hover{background:#333}#menu .pure-menu-heading,#menu .pure-menu-selected{background:#1f8dd6}#menu .pure-menu-selected a{color:#fff}#menu .pure-menu-heading{font-size:110%;color:#fff;margin:0}.menu-link{display:block;background:#000;background:rgba(0,0,0,.7);font-size:10px;z-index:10;width:2em;height:auto;padding:2.1em 1.6em}.menu-link:focus,.menu-link:hover{background:#000}.menu-link span{position:relative;display:block}.menu-link span,.menu-link span:after,.menu-link span:before{background-color:#fff;width:100%;height:.2em}.menu-link span:after,.menu-link span:before{position:absolute;margin-top:-.6em;content:" "}.menu-link span:after{margin-top:.6em}@media (min-width:48em){.content,.header{padding-left:2em;padding-right:2em}#layout{padding-left:150px;left:0}#layout.active .menu-link,#menu,.menu-link{left:150px}.menu-link{position:fixed;display:none}}@media (max-width:48em){#layout.active{position:relative;left:150px}}
</style>
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;lang=en" />
<style>
body{
font-family: "Open Sans", serif;
}
</style>
<script type="text/javascript" src="<?php echo jsFolder ?>jquery-3.1.0.min.js"></script>
<script type="text/javascript">
/*   $(document).ready(function() {  
      	$('html').css("visibility", "visible");
    });  */ 
</script>
<script src="<?php echo jsFolder ?>loader.js"></script>
</head>
<?php 
require SNIPPLETS.'bodyStart.php';
require SNIPPLETS.'menu.php';