<?php

Croogo::hookComponent('Nodes', array('NodeAttachments.NodeAttachment'=>array('priority' => 8)));

Croogo::hookBehavior('Node', 'NodeAttachments.NodeAttachment', array());

Croogo::hookHelper('*', 'NodeAttachments.Attachment');
