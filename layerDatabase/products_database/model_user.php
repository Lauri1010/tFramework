<?php 
namespace tFramework; 
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'products_database'.DS.'helper_user.php'; 

class schema_user extends helper_user {

public $user_id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $username_validation = array('string','max'=>75,'min'=>1);

public $password_validation = array('string','max'=>50,'min'=>1);

public $email_validation = array('string','max'=>150,'min'=>1);

public $salt_validation = array('string','max'=>150,'min'=>1);

public $columns = array('user_id','username','password','email','salt');

public $user_id;

public $username;

public $password;

public $email;

public $salt;

public $insert_sql_statement;

public $update_sql_statement;

}?>

