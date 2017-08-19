<?php 
namespace tFramework; 

class helper_interesting_event{

public $table_name='interesting_event';

public $table_alias='ie6';

public $interesting_event_id_sql='ie6.interesting_event_id';

public $active_sql='ie6.active';

public $event_description_sql='ie6.event_description';

public $select_columns_sql='ie6.interesting_event_id,ie6.active,ie6.event_description';

public $raw_click_data_join_sql=' raw_click_data rcd8 ON(ie6.interesting_event_id=rcd8.interesting_event_ref)';

public $insert_into_sql='INSERT INTO interesting_event VALUES (:interesting_event_id, :active, :event_description)';

public $update_base_sql='UPDATE interesting_event SET ';

public $update_interesting_event_id_sql='interesting_event_id=:interesting_event_id';

public $update_active_sql='active=:active';

public $update_event_description_sql='event_description=:event_description';

}?>