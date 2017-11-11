<?php 
namespace tFramework; 

class helper_user{

public $table_name='user';

public $table_alias='u0';

public $id_sql='u0.id';

public $username_sql='u0.username';

public $password_sql='u0.password';

public $select_columns_sql='u0.id,u0.username,u0.password';


public $insert_into_sql='INSERT INTO user VALUES (:id, :username, :password)';

public $update_base_sql='UPDATE user SET ';

public $update_id_sql='id=:id';

public $update_username_sql='username=:username';

public $update_password_sql='password=:password';

}?>