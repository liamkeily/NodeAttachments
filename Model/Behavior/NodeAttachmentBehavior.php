<?php
App::uses('ModelBehavior', 'Model');

class NodeAttachmentBehavior extends ModelBehavior {

/**
 * Setup
 *
 * @param Model $model
 * @param array $config
 * @return void
 */
	public function setup(Model $model, $config = array()) {
		
            $model->hasMany['NodeAttachment'] = array(
                'className' => 'NodeAttachments.NodeAttachment',
                'foreignKey' => 'node_id',
                'conditions' => array(),
                'dependent' => true,
		'order' => 'NodeAttachment.lft',
            );
	}

}
