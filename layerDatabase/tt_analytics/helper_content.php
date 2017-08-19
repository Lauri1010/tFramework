<?php 
namespace tFramework; 

class helper_content{

public $table_name='content';

public $table_alias='c2';

public $content_id_sql='c2.content_id';

public $page_id_ref_sql='c2.page_id_ref';

public $content_type_sql='c2.content_type';

public $select_columns_sql='c2.content_id,c2.page_id_ref,c2.content_type';

public $hit_page_join_sql=' hit_page hp9 ON(c2.page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO content VALUES (:content_id, :page_id_ref, :content_type)';

public $update_base_sql='UPDATE content SET ';

public $update_content_id_sql='content_id=:content_id';

public $update_page_id_ref_sql='page_id_ref=:page_id_ref';

public $update_content_type_sql='content_type=:content_type';

}?>