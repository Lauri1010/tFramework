<?php 
namespace tFramework; 

class helper_event_data{

public $table_name='event_data';

public $table_alias='ed5';

public $click_id_sql='ed5.click_id';

public $event_id_ref_sql='ed5.event_id_ref';

public $event_type_id_ref_sql='ed5.event_type_id_ref';

public $html_classes_sql='ed5.html_classes';

public $html_id_sql='ed5.html_id';

public $select_columns_sql='ed5.click_id,ed5.event_id_ref,ed5.event_type_id_ref,ed5.html_classes,ed5.html_id';

public $event_join_sql=' event e4 ON(ed5.event_id_ref=e4.interesting_event_id)';
public $event_type_join_sql=' event_type et6 ON(ed5.event_type_id_ref=et6.event_type_id)';

public $insert_into_sql='INSERT INTO event_data VALUES (:click_id, :event_id_ref, :event_type_id_ref, :html_classes, :html_id)';

public $update_base_sql='UPDATE event_data SET ';

public $update_click_id_sql='click_id=:click_id';

public $update_event_id_ref_sql='event_id_ref=:event_id_ref';

public $update_event_type_id_ref_sql='event_type_id_ref=:event_type_id_ref';

public $update_html_classes_sql='html_classes=:html_classes';

public $update_html_id_sql='html_id=:html_id';

}?>