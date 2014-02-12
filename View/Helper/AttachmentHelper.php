<?php
class AttachmentHelper extends AppHelper {

	public $helpers = array(
		'Html',
		'Form'
	);

	public function row($title = null, $url = null, $id = null) {
            
		$uuid = String::uuid();
                
                echo '<tr id="attachment_'.$id.'">';

		echo '<td>';
		 if($id != null){
                    echo $this->Form->input('NodeAttachment.'.$uuid.'.id',array('value'=>$id));
          	$this->Form->unlockField('NodeAttachment.' . $uuid . '.id');
                }
		echo $this->Html->image('NodeAttachments.attach.png');
		echo '</td>';
                               
		echo '<td>';
                echo $this->Form->input('NodeAttachment.'.$uuid.'.title',array('label'=>false,'style'=>'float:left;','value'=>$title,'class'=>'title'));
          		$this->Form->unlockField('NodeAttachment.' . $uuid . '.title');
                echo '</td>';
                
                echo '<td>';
                echo $this->Form->input('NodeAttachment.'.$uuid.'.url',array('label'=>false,'style'=>'float:left;','value'=>$url,'class'=>'url'));
          	$this->Form->unlockField('NodeAttachment.' . $uuid . '.url');
                echo '<button onclick="return false;" class="btn attachment_select_file" style="float:left;"><i class="icon-folder-open"></button></i>';
		echo '<img class="image_preview" src="'.$this->Html->url('/').$url.'" width="100" style="display:none;" />';
		echo '</td>';
		
                echo '<td>';
		echo '<button class="btn attachment-delete" onclick="return false;"><i class="icon-trash icon-large"></i></button>';
		if($id != null){
			echo '<button class="btn attachment-moveup" onclick="return false;">Move Up</button>';
			echo '<button class="btn attachment-movedown" onclick="return false;">Move Down</button>';
		}
		echo '</td>';
            
		echo '</tr>';
	}
}
