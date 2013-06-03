<?php

class AttachmentHelper extends AppHelper {

/**
 * Helpers
 */
	public $helpers = array(
		'Html',
		'Form',
		);


	public function row($title = null, $url = null, $id = null) {
            
		$uuid = String::uuid();
                
		?>
                <tr id="attachment_<?=$id;?>">
		<td>
		<?php echo $this->Html->image('NodeAttachments.attach.png'); ?>
		</td>

                <?php
                if($id != null){
                    echo $this->Form->input('NodeAttachment.'.$uuid.'.id',array('value'=>$id));
		    $this->Form->unlockField('NodeAttachment.' . $uuid . '.id');
                }
                ?>
                <td>
                    <?php
                    echo $this->Form->input('NodeAttachment.'.$uuid.'.title',array('label'=>false,'style'=>'float:left;','value'=>$title,'class'=>'title'));
		    $this->Form->unlockField('NodeAttachment.' . $uuid . '.title');
                    ?>
                </td>
                
                <td>
                    <?php
                    echo $this->Form->input('NodeAttachment.'.$uuid.'.url',array('label'=>false,'style'=>'float:left;','value'=>$url,'class'=>'url'));
		    $this->Form->unlockField('NodeAttachment.' . $uuid . '.url');
                    ?>
                    <button onclick="return false;" class="btn attachment_select_file" style="float:left;"><i class="icon-folder-open"></button></i>
			
			<img class="image_preview" src="<?php echo $this->Html->url('/').$url ?>" width="100" style="display:none;" />
		
		</td>
		
                <td>
			<button class="btn attachment-delete" onclick="return false;"><i class="icon-trash icon-large"></i></button>
			<?php if($id != null){?>
			<button class="btn attachment-moveup" onclick="return false;">Move Up</button>
			<button class="btn attachment-movedown" onclick="return false;">Move Down</button>
			<?php } ?>
		</td>
            </tr>
                <?php
	}

}
