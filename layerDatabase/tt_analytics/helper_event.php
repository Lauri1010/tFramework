<?php 
namespace tFramework; 

class helper_event{

public $table_name='event';

public $table_alias='e4';

public $interesting_event_id_sql='e4.interesting_event_id';

public $active_sql='e4.active';

public $page_id_ref_sql='e4.page_id_ref';

public $event_description_sql='e4.event_description';

public $select_columns_sql='e4.interesting_event_id,e4.active,e4.page_id_ref,e4.event_description';

public $event_data_join_sql=' event_data ed5 ON(e4.interesting_event_id=ed5.event_id_ref)';
public $hit_page_join_sql=' hit_page hp9 ON(e4.page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO event VALUES (:interesting_event_id, :active, :page_id_ref, :event_description)';

public $update_base_sql='UPDATE event SET ';

public $update_interesting_event_id_sql='interesting_event_id=:interesting_event_id';

public $update_active_sql='active=:active';

public $update_page_id_ref_sql='page_id_ref=:page_id_ref';

public $update_event_description_sql='event_description=:event_description';

}?>