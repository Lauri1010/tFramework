<?php 
namespace tFramework; 

class helper_active_campaigs{

public $table_name='active_campaigs';

public $table_alias='ac0';

public $campaign_id_sql='ac0.campaign_id';

public $segment_if_ref_sql='ac0.segment_if_ref';

public $page_id_ref_sql='ac0.page_id_ref';

public $select_columns_sql='ac0.campaign_id,ac0.segment_if_ref,ac0.page_id_ref';

public $hit_page_join_sql=' hit_page hp9 ON(ac0.page_id_ref=hp9.page_id)';

public $insert_into_sql='INSERT INTO active_campaigs VALUES (:campaign_id, :segment_if_ref, :page_id_ref)';

public $update_base_sql='UPDATE active_campaigs SET ';

public $update_campaign_id_sql='campaign_id=:campaign_id';

public $update_segment_if_ref_sql='segment_if_ref=:segment_if_ref';

public $update_page_id_ref_sql='page_id_ref=:page_id_ref';

}?>