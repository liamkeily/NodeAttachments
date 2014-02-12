<?php
if(!empty($attachments)){
	echo '<table class="attachments">';
	foreach($attachments as $attachment){
		$ext = pathinfo($attachment['NodeAttachment']['url'], PATHINFO_EXTENSION);
		$imagefile = "attachment_blue.png";
		if($ext =='pdf'){
			$imagefile = "pdf.png";
		}
		if($ext == 'zip'){
			$imagefile = "zip.png";
		}
		$att_image = $this->Html->image('NodeAttachments.'.$imagefile,array('width'=>30));
		echo '<tr><td>'.$att_image.'</td><td>'.$this->Html->link($attachment['NodeAttachment']['title'],'/'.$attachment['NodeAttachment']['url']).'</td></tr>';		
	}
	echo '</table>';
}
?>

