<?php 
namespace tFramework;

require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'Sql_service_base.php';

class Sql_service_tt_analytics extends Sql_service_base{

protected $active_campaigs;

protected $analytics_account;

protected $content;

protected $engagement;

protected $event;

protected $event_data;

protected $event_type;

protected $hit;

protected $hit_flow;

protected $hit_page;

protected $segment;

protected $segment_trait;

protected $trait;

public function get_active_campaigs_model_value($value){

if(!isset($this->active_campaigs)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_active_campaigs.php';
$this->active_campaigs=new model_active_campaigs();
}

return $this->active_campaigs->$value;
}

public function get_analytics_account_model_value($value){

if(!isset($this->analytics_account)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_analytics_account.php';
$this->analytics_account=new model_analytics_account();
}

return $this->analytics_account->$value;
}

public function get_content_model_value($value){

if(!isset($this->content)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_content.php';
$this->content=new model_content();
}

return $this->content->$value;
}

public function get_engagement_model_value($value){

if(!isset($this->engagement)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_engagement.php';
$this->engagement=new model_engagement();
}

return $this->engagement->$value;
}

public function get_event_model_value($value){

if(!isset($this->event)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event.php';
$this->event=new model_event();
}

return $this->event->$value;
}

public function get_event_data_model_value($value){

if(!isset($this->event_data)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event_data.php';
$this->event_data=new model_event_data();
}

return $this->event_data->$value;
}

public function get_event_type_model_value($value){

if(!isset($this->event_type)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event_type.php';
$this->event_type=new model_event_type();
}

return $this->event_type->$value;
}

public function get_hit_model_value($value){

if(!isset($this->hit)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit.php';
$this->hit=new model_hit();
}

return $this->hit->$value;
}

public function get_hit_flow_model_value($value){

if(!isset($this->hit_flow)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit_flow.php';
$this->hit_flow=new model_hit_flow();
}

return $this->hit_flow->$value;
}

public function get_hit_page_model_value($value){

if(!isset($this->hit_page)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit_page.php';
$this->hit_page=new model_hit_page();
}

return $this->hit_page->$value;
}

public function get_segment_model_value($value){

if(!isset($this->segment)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_segment.php';
$this->segment=new model_segment();
}

return $this->segment->$value;
}

public function get_segment_trait_model_value($value){

if(!isset($this->segment_trait)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_segment_trait.php';
$this->segment_trait=new model_segment_trait();
}

return $this->segment_trait->$value;
}

public function get_trait_model_value($value){

if(!isset($this->trait)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_trait.php';
$this->trait=new model_trait();
}

return $this->trait->$value;
}

public function set_active_campaigs($column_name,$column_value){

if(!isset($this->active_campaigs)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_active_campaigs.php';
$this->active_campaigs=new model_active_campaigs();
}

$this->active_campaigs->$column_name=$column_value;
}

public function set_analytics_account($column_name,$column_value){

if(!isset($this->analytics_account)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_analytics_account.php';
$this->analytics_account=new model_analytics_account();
}

$this->analytics_account->$column_name=$column_value;
}

public function set_content($column_name,$column_value){

if(!isset($this->content)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_content.php';
$this->content=new model_content();
}

$this->content->$column_name=$column_value;
}

public function set_engagement($column_name,$column_value){

if(!isset($this->engagement)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_engagement.php';
$this->engagement=new model_engagement();
}

$this->engagement->$column_name=$column_value;
}

public function set_event($column_name,$column_value){

if(!isset($this->event)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event.php';
$this->event=new model_event();
}

$this->event->$column_name=$column_value;
}

public function set_event_data($column_name,$column_value){

if(!isset($this->event_data)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event_data.php';
$this->event_data=new model_event_data();
}

$this->event_data->$column_name=$column_value;
}

public function set_event_type($column_name,$column_value){

if(!isset($this->event_type)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_event_type.php';
$this->event_type=new model_event_type();
}

$this->event_type->$column_name=$column_value;
}

public function set_hit($column_name,$column_value){

if(!isset($this->hit)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit.php';
$this->hit=new model_hit();
}

$this->hit->$column_name=$column_value;
}

public function set_hit_flow($column_name,$column_value){

if(!isset($this->hit_flow)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit_flow.php';
$this->hit_flow=new model_hit_flow();
}

$this->hit_flow->$column_name=$column_value;
}

public function set_hit_page($column_name,$column_value){

if(!isset($this->hit_page)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_hit_page.php';
$this->hit_page=new model_hit_page();
}

$this->hit_page->$column_name=$column_value;
}

public function set_segment($column_name,$column_value){

if(!isset($this->segment)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_segment.php';
$this->segment=new model_segment();
}

$this->segment->$column_name=$column_value;
}

public function set_segment_trait($column_name,$column_value){

if(!isset($this->segment_trait)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_segment_trait.php';
$this->segment_trait=new model_segment_trait();
}

$this->segment_trait->$column_name=$column_value;
}

public function set_trait($column_name,$column_value){

if(!isset($this->trait)){
require ROOT.DS.FRFOLDER.DS.'layerDatabase'.DS.'tt_analytics'.DS.'model_trait.php';
$this->trait=new model_trait();
}

$this->trait->$column_name=$column_value;
}

}

?>