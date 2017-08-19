<?php 
namespace tFramework; 

class helper_analytics_account{

public $table_name='analytics_account';

public $table_alias='aa1';

public $account_id_sql='aa1.account_id';

public $email_sql='aa1.email';

public $password_sql='aa1.password';

public $salt_sql='aa1.salt';

public $token_sql='aa1.token';

public $website_identity_token_sql='aa1.website_identity_token';

public $select_columns_sql='aa1.account_id,aa1.email,aa1.password,aa1.salt,aa1.token,aa1.website_identity_token';

public $hit_join_sql=' hit h7 ON(aa1.account_id=h7.hit_account_id_ref)';

public $insert_into_sql='INSERT INTO analytics_account VALUES (:account_id, :email, :password, :salt, :token, :website_identity_token)';

public $update_base_sql='UPDATE analytics_account SET ';

public $update_account_id_sql='account_id=:account_id';

public $update_email_sql='email=:email';

public $update_password_sql='password=:password';

public $update_salt_sql='salt=:salt';

public $update_token_sql='token=:token';

public $update_website_identity_token_sql='website_identity_token=:website_identity_token';

}?>