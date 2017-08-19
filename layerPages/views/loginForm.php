<?php 
namespace tFramework;
require ROOT.DS.FRFOLDER.DS.'layerPages'.DS.'baseview'.DS.'getHtmElements.php';
generateHead('Login');
?>
<div class="pure-u-1-5"></div>
<div class="pure-u-3-5">
<h1>Login</h1>
<div><?php $this->processSubmit('user'); ?></div>
<form enctype="multipart/form-data" class="pure-form pure-form-stacked" action="" method="POST">
<label>Email</label>
<?php
echo $this->inputField('user','email');
?>
<label>Password</label>
<?php 
echo $this->inputField('user','password');
?>
<br/><br/>
<button type="submit" class="pure-button pure-button-primary">Submit</button>
</form>
</div>
<div class="pure-u-1-5">
<?php 
generateBottom();
?>
</div>