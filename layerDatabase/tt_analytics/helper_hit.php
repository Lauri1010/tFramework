<?php 
namespace tFramework; 

class helper_hit{

public $table_name='hit';

public $table_alias='h7';

public $hit_id_sql='h7.hit_id';

public $hit_account_id_ref_sql='h7.hit_account_id_ref';

public $visit_identity_sql='h7.visit_identity';

public $visitor_identity_sql='h7.visitor_identity';

public $hit_segment_id_ref_sql='h7.hit_segment_id_ref';

public $page_id_ref_sql='h7.page_id_ref';

public $request_ip_sql='h7.request_ip';

public $browser_type_sql='h7.browser_type';

public $browser_version_sql='h7.browser_version';

public $is_mobile_sql='h7.is_mobile';

public $is_tablet_sql='h7.is_tablet';

public $domain_sql='h7.domain';

public $trust_level_sql='h7.trust_level';

public $select_columns_sql='h7.hit_id,h7.hit_account_id_ref,h7.visit_identity,h7.visitor_identity,h7.hit_segment_id_ref,h7.page_id_ref,h7.request_ip,h7.browser_type,h7.browser_version,h7.is_mobile,h7.is_tablet,h7.domain,h7.trust_level';

public $analytics_account_join_sql=' analytics_account aa1 ON(h7.hit_account_id_ref=aa1.account_id)';
public $hit_page_join_sql=' hit_page hp9 ON(h7.page_id_ref=hp9.page_id)';
public $segment_join_sql=' segment s10 ON(h7.hit_segment_id_ref=s10.segment_id)';

public $insert_into_sql='INSERT INTO hit VALUES (:hit_id, :hit_account_id_ref, :visit_identity, :visitor_identity, :hit_segment_id_ref, :page_id_ref, :request_ip, :browser_type, :browser_version, :is_mobile, :is_tablet, :domain, :trust_level)';

public $update_base_sql='UPDATE hit SET ';

public $update_hit_id_sql='hit_id=:hit_id';

public $update_hit_account_id_ref_sql='hit_account_id_ref=:hit_account_id_ref';

public $update_visit_identity_sql='visit_identity=:visit_identity';

public $update_visitor_identity_sql='visitor_identity=:visitor_identity';

public $update_hit_segment_id_ref_sql='hit_segment_id_ref=:hit_segment_id_ref';

public $update_page_id_ref_sql='page_id_ref=:page_id_ref';

public $update_request_ip_sql='request_ip=:request_ip';

public $update_browser_type_sql='browser_type=:browser_type';

public $update_browser_version_sql='browser_version=:browser_version';

public $update_is_mobile_sql='is_mobile=:is_mobile';

public $update_is_tablet_sql='is_tablet=:is_tablet';

public $update_domain_sql='domain=:domain';

public $update_trust_level_sql='trust_level=:trust_level';

}?>