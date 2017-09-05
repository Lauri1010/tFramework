<?php 
namespace tFramework; 

class helper_user{

public $table_name='user';

public $table_alias='u5';

public $user_id_sql='u5.user_id';

public $username_sql='u5.username';

public $password_sql='u5.password';

public $email_sql='u5.email';

public $salt_sql='u5.salt';

public $select_columns_sql='u5.user_id,u5.username,u5.password,u5.email,u5.salt';


public $insert_into_sql='INSERT INTO user VALUES (:user_id, :username, :password, :email, :salt)';

public $update_base_sql='UPDATE user SET ';

public $update_user_id_sql='user_id=:user_id';

public $update_username_sql='username=:username';

public $update_password_sql='password=:password';

public $update_email_sql='email=:email';

public $update_salt_sql='salt=:salt';

}?>