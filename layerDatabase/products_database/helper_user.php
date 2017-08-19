<?php 
namespace tFramework; 

class helper_user{

public $table_name='user';

public $table_alias='u3';

public $user_id_sql='u3.user_id';

public $username_sql='u3.username';

public $password_sql='u3.password';

public $email_sql='u3.email';

public $salt_sql='u3.salt';

public $select_columns_sql='u3.user_id,u3.username,u3.password,u3.email,u3.salt';


public $insert_into_sql='INSERT INTO user VALUES (:user_id, :username, :password, :email, :salt)';

public $update_base_sql='UPDATE user SET ';

public $update_user_id_sql='user_id=:user_id';

public $update_username_sql='username=:username';

public $update_password_sql='password=:password';

public $update_email_sql='email=:email';

public $update_salt_sql='salt=:salt';

}?>