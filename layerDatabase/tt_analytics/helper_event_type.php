<?php 
namespace tFramework; 

class helper_event_type{

public $table_name='event_type';

public $table_alias='et6';

public $event_type_id_sql='et6.event_type_id';

public $event_type_description_sql='et6.event_type_description';

public $select_columns_sql='et6.event_type_id,et6.event_type_description';

public $event_data_join_sql=' event_data ed5 ON(et6.event_type_id=ed5.event_type_id_ref)';

public $insert_into_sql='INSERT INTO event_type VALUES (:event_type_id, :event_type_description)';

public $update_base_sql='UPDATE event_type SET ';

public $update_event_type_id_sql='event_type_id=:event_type_id';

public $update_event_type_description_sql='event_type_description=:event_type_description';

}?>