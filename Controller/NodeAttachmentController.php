<?php

App::uses('AppController', 'Controller');
App::uses('Croogo', 'Lib');

/**
 * Support Controller
 *
 * PHP version 5
 *
 * @category NodeAttachments.Controller
 * @package  Croogo.NodeAttachments
 * @version  1.0
 * @author   Liam Keily
 * @link     http://www.liamkeily.com
 */

class NodeAttachmentController extends AppController {

	public $helpers = array('Html','Form');
        
        public function beforeFilter(){
            $this->loadModel('NodeAttachment');
        }

	public function admin_add(){
		$title = $this->request->query['title'];
		$url = $this->request->query['url'];
		
            $this->set(compact('title','url'));
	}
        
        public function admin_remove($id){
            if($this->NodeAttachment->delete($id)){
                $success=true;
            }
            else
            {
                $success=false;
            }
            
            $this->set('success',$success);
            $this->layout = 'ajaxsuccess';
        }
        
        public function admin_moveup($id){
            $att = $this->NodeAttachment->findById($id);
            if (isset($att['NodeAttachment']['id'])) {
                 $this->NodeAttachment->Behaviors->attach('Tree', array(
                    'scope' => array(
                            'NodeAttachment.node_id' => $att['NodeAttachment']['node_id'],
                    ),
                ));
                 
                if($this->NodeAttachment->moveUp($id, 1)){
                   $success=true;
                }
                else
                {
                   $success=false;
                }
            }
            else
            {
                $success=false;
            }
            
            $this->set('success',$success);
            $this->render('ajaxsuccess');
        }
        
        public function admin_movedown($id){
            $att = $this->NodeAttachment->findById($id);
            if (isset($att['NodeAttachment']['id'])) {
                 $this->NodeAttachment->Behaviors->attach('Tree', array(
                    'scope' => array(
                            'NodeAttachment.node_id' => $att['NodeAttachment']['node_id'],
                    ),
                ));
                 
                if($this->NodeAttachment->moveDown($id, 1)){
                   $success = true;
                }
                else
                {
                   $success = false;
                }
            }
            else
            {
                $success = false;
            }            
            
            
            $this->set('success',$success);
            $this->render('ajaxsuccess');
        }

}
