<?php

App::uses('NodeAttachmentsAppModel', 'NodeAttachments.Model');

class NodeAttachment extends NodeAttachmentsAppModel {

        public $actsAs = array('Tree');
 
	public $belongsTo = array(
		'Node' => array(
			'className' => 'Node',
			'foreignKey' => 'node_id',
			'conditions' => '',
			'fields' => '',
			'order' => '',
		),
	);

}
