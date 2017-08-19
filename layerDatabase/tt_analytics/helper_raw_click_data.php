<?php 
namespace tFramework; 

class helper_raw_click_data{

public $table_name='raw_click_data';

public $table_alias='rcd8';

public $click_id_sql='rcd8.click_id';

public $interesting_event_ref_sql='rcd8.interesting_event_ref';

public $hit_id_ref_sql='rcd8.hit_id_ref';

public $click_html_classes_sql='rcd8.click_html_classes';

public $click_html_id_sql='rcd8.click_html_id';

public $select_columns_sql='rcd8.click_id,rcd8.interesting_event_ref,rcd8.hit_id_ref,rcd8.click_html_classes,rcd8.click_html_id';

public $interesting_event_join_sql=' interesting_event ie6 ON(rcd8.interesting_event_ref=ie6.interesting_event_id)';

public $insert_into_sql='INSERT INTO raw_click_data VALUES (:click_id, :interesting_event_ref, :hit_id_ref, :click_html_classes, :click_html_id)';

public $update_base_sql='UPDATE raw_click_data SET ';

public $update_click_id_sql='click_id=:click_id';

public $update_interesting_event_ref_sql='interesting_event_ref=:interesting_event_ref';

public $update_hit_id_ref_sql='hit_id_ref=:hit_id_ref';

public $update_click_html_classes_sql='click_html_classes=:click_html_classes';

public $update_click_html_id_sql='click_html_id=:click_html_id';

}?>