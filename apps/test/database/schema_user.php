<?php 
namespace tFramework; 

require DBFOLDER.'helper_user.php'; 

class schema_user extends helper_user{

public $id_validation = array('primary','intiger','max'=>10,'min'=>1);

public $username_validation = array('required','string','max'=>50,'min'=>1);

public $password_validation = array('string','max'=>50,'min'=>1);

public $columns = array('id','username','password');

public $id;

public $username;

public $password;

public $insert_sql_statement;

public $update_sql_statement;

}?>

