<?php

namespace tFramework;

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php if(isset($title)){echo $title;} ?></title>
<?php if(isset($metad)){ ?><meta name="description" content="<?php echo $metad;}?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
<link rel="icon" type="image/png" href="favicon.png">
</head>