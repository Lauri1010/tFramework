<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'helper_analytics_account.php'; 

class model_analytics_account extends helper_analytics_account {

public $account_id_validation = array('primary','intiger','max'=>20,'min'=>1);

public $email_validation = array('required','string','max'=>250,'min'=>1);

public $password_validation = array('required','string','max'=>100,'min'=>1);

public $salt_validation = array('string','max'=>50,'min'=>1);

public $token_validation = array('string','max'=>50,'min'=>1);

public $website_identity_token_validation = array('required','string','max'=>255,'min'=>1);

public $insert_sql_statement;

public $update_sql_statement;

public $account_id;

public $email;

public $password;

public $salt;

public $token;

public $website_identity_token;

public $columns = array('account_id','email','password','salt','token','website_identity_token');

}?>