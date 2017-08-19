<?php 
namespace tFramework; 

class helper_engagement{

public $table_name='engagement';

public $table_alias='e3';

public $e_row_id_sql='e3.e_row_id';

public $page_id_ref_sql='e3.page_id_ref';

public $time_spent_in_seconds_sql='e3.time_spent_in_seconds';

public $scroll_depth_sql='e3.scroll_depth';

public $select_columns_sql='e3.e_row_id,e3.page_id_ref,e3.time_spent_in_seconds,e3.scroll_depth';

public $hit_page_join_sql=' hit_page hp9 ON(e3.page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO engagement VALUES (:e_row_id, :page_id_ref, :time_spent_in_seconds, :scroll_depth)';

public $update_base_sql='UPDATE engagement SET ';

public $update_e_row_id_sql='e_row_id=:e_row_id';

public $update_page_id_ref_sql='page_id_ref=:page_id_ref';

public $update_time_spent_in_seconds_sql='time_spent_in_seconds=:time_spent_in_seconds';

public $update_scroll_depth_sql='scroll_depth=:scroll_depth';

}?>