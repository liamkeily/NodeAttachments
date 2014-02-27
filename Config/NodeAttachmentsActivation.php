<?php
/**
 * NodeAttachments Plugin Activation
 *
 * @package  Croogo
 * @version  1.5
 * @author   Liam Keily
 */
class NodeAttachmentsActivation {

/**
 * onActivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeActivation(&$controller) {
    return true;
  }

/**
 * Called after activating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onActivation(&$controller) {
    $controller->Croogo->addAco('NodeAttachment'); 
    $controller->Croogo->addAco('NodeAttachment/admin_index'); 
    $controller->Croogo->addAco('NodeAttachment/admin_add'); 
    $controller->Croogo->addAco('NodeAttachment/admin_remove'); 
    $controller->Croogo->addAco('NodeAttachment/admin_moveup'); 
    $controller->Croogo->addAco('NodeAttachment/admin_movedown'); 
    
    $this->_schema('create');
  }

/**
 * onDeactivate will be called if this returns true
 *
 * @param  object $controller Controller
 * @return boolean
 */
  public function beforeDeactivation(&$controller) {
    return true;
  }

/**
 * Called after deactivating the plugin in ExtensionsPluginsController::admin_toggle()
 *
 * @param object $controller Controller
 * @return void
 */
  public function onDeactivation(&$controller) {
    $controller->Croogo->removeAco('NodeAttachment');
//    $this->_schema('drop');
}
		
/**
 * Schema
 *
 * @param string sql action
 * @return void
 * @access protected
 */
	protected function _schema($action = 'create') {
		App::uses('File', 'Utility');
		App::import('Model', 'CakeSchema', false);
		App::import('Model', 'ConnectionManager');
		$db = ConnectionManager::getDataSource('default');
		if(!$db->isConnected()) {
			$this->Session->setFlash(__('Could not connect to database.'), 'default', array('class' => 'error'));
		} else {
			CakePlugin::load('NodeAttachments'); //is there a better way to do this?
			$schema =& new CakeSchema(array('name'=>'NodeAttachments', 'plugin'=>'NodeAttachments'));
			$schema = $schema->load();
			foreach($schema->tables as $table => $fields) {
			  if($action == 'create') {
				$tables = $db->listSources();
				if(!in_array($table,$tables)){
			  	$sql = $db->createSchema($schema, $table);
				$db->execute($sql);
				}
			  } else {
  			  $sql = $db->dropSchema($schema, $table);
				$db->execute($sql);
			  }

			}
		}
	}
  
}
