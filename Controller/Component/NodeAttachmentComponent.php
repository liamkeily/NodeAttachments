<?php

App::uses('Component', 'Controller');

/**
 * Note Attachments Component
 *
 * @author Liam Keily
 * @package Croogo.NodeAttachments.Controller.Component
 */
class NodeAttachmentComponent extends Component {
	
	public function startup(Controller $controller){

		if($controller->action == 'admin_edit' || $controller->action == 'admin_add'){
			$controller->helpers[] = 'NodeAttachments.Attachment';
			$controller->helpers[] = 'ElFinder.ElFinder';
			
			Croogo::hookAdminTab('Nodes/admin_add','Attachments','NodeAttachments.NodeAttachment');
			Croogo::hookAdminTab('Nodes/admin_edit','Attachments','NodeAttachments.NodeAttachment');
			
			
			if (!empty($controller->request->data['NodeAttachment'])) {
			
				foreach ($controller->request->data['NodeAttachment'] as $uuid => $fields) {
					foreach ($fields as $field => $vals) {
						$controller->Security->unlockedFields[] = 'NodeAttachment.' . $uuid . '.' . $field;
					}
				}
				
				print_R($controller->Security->unlockedFields);
			
			}
		}
		
		
	}
	
	public function beforeRender(Controller $controller){
		if($controller->action == 'view'){
			
			$node_id = $controller->viewVars['node']['Node']['id'];
			
			$attachments = $controller->Node->NodeAttachment->find('all',array('conditions'=>array('NodeAttachment.node_id'=>$node_id)));
			
			$controller->set(compact('attachments'));
		}
	}

}
