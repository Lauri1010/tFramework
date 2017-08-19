<?php 
namespace tFramework; 

class helper_hit_page{

public $table_name='hit_page';

public $table_alias='hp9';

public $page_id_sql='hp9.page_id';

public $page_title_sql='hp9.page_title';

public $page_url_sql='hp9.page_url';

public $page_meta_description_sql='hp9.page_meta_description';

public $select_columns_sql='hp9.page_id,hp9.page_title,hp9.page_url,hp9.page_meta_description';

public $active_campaigs_join_sql=' active_campaigs ac0 ON(hp9.page_id=ac0.page_id_ref)';
public $content_join_sql=' content c2 ON(hp9.page_id=c2.page_id_ref)';
public $engagement_join_sql=' engagement e3 ON(hp9.page_id=e3.page_id_ref)';
public $event_join_sql=' event e4 ON(hp9.page_id=e4.page_id_ref)';
public $hit_join_sql=' hit h7 ON(hp9.page_id=h7.page_id_ref)';
public $hit_flow_join_sql=' hit_flow hf8 ON(hp9.page_id=hf8.previous_page_id_ref)';

public $insert_into_sql='INSERT INTO hit_page VALUES (:page_id, :page_title, :page_url, :page_meta_description)';

public $update_base_sql='UPDATE hit_page SET ';

public $update_page_id_sql='page_id=:page_id';

public $update_page_title_sql='page_title=:page_title';

public $update_page_url_sql='page_url=:page_url';

public $update_page_meta_description_sql='page_meta_description=:page_meta_description';

}?>