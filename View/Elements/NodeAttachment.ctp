<div class="row-fluid padded">
    
<p class="alert">
Attachments are a list of downloadable files that will appear under the content.
</p>

<script type="text/javascript" charset="utf-8">
    
        // Liam's ElFinder File Picker
        var filepicker = new Object();
    
        $(function(){
            // Create instance of elfinder
            filepicker.div = $("#attachments_finder");
            filepicker.elf = filepicker.div.elfinder({
                    // lang: 'ru',             // language (OPTIONAL)
                    url : '/ElFinder/elfinder/php/connector.php'  // connector URL (REQUIRED)
            }).elfinder('instance');
        
            // Create a dialog for elfinder
           filepicker.dialog = filepicker.div.dialog({
            autoOpen:false,
            width:750,
            buttons:{
                "Insert":function(){
                    // get array of files
                    var files = filepicker.div.find(".ui-selected").map( function() {
                        return filepicker.elf.path($(this).attr('id'));
                    }).get();
                    
                    filepicker.callback_function(files);
                    filepicker.dialog.dialog('close');
                }
            }
           });
           
           
            // Get Files Method
            filepicker.getFiles = function(callback_function){
                filepicker.callback_function = callback_function;
                filepicker.dialog.dialog("open");
            }
        });
        
        
        // Bind Filepicker to button
        $(function(){
            
            // Bind select file button
            $("#attachments").on('click','.attachment_select_file',function(){
               filepicker.row = $(this).parent();
               filepicker.getFiles(function(files){
                    filepicker.row.find('.url').val(files[0]);
                    filepicker.row.find('.image_preview').attr('src','<?php echo $this->Html->url('/') ?>' + files[0]);
               });
            });
            
            // Bind select file button
            $(".attachment-add").click(function(){
               filepicker.urlbox = $(this).parent().find('.url');
               filepicker.getFiles(function(files){
                    
                    console.log(files);
                    for (file in files) {
                
                        $.ajax({
                            url:"<?php echo $this->Html->url(array("plugin"=>"node_attachments","controller"=>"nodeattachment","action"=>"add"));?>?url=" + encodeURIComponent(files[file]) + '&title=' + encodeURIComponent(files[file]),
                            success:function(data){
                                $("#attachments").append(data);
                            }
                        });
                    
                    }
                    
               });
               
               
            });
        });
        
</script>

<div id="attachments_finder" title="Select Files"></div>

<script>
    $(function(){
        
        /*
        $('.attachment-add').click(function(){
            $.ajax({
                url:"<?php echo $this->Html->url(array("plugin"=>"node_attachments","controller"=>"nodeattachment","action"=>"add"));?>",
                success:function(data){
                    $("#attachments").append(data);
                }
            })
        });
        */
        
        $('table').on('click','.attachment-delete',function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_attachments","controller"=>"nodeattachment","action"=>"remove"))?>/" + id,
                   success:function(){
                    row.remove();
                   }
                });
            }
            else
            {
            row.remove();
            }
        });
        
         $('.attachment-moveup').click(function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_attachments","controller"=>"nodeattachment","action"=>"moveup"))?>/" + id,
                   success:function(){
                    row.prev().before(row)
                   }
                });
            }
        });
         
         $('.attachment-movedown').click(function(){
            var row = $(this).parent().parent();
            var id = row.attr('id').split('_')[1];
            if (id > 0) {
                $.ajax({
                   url:"<?php echo $this->Html->url(array("plugin"=>"node_attachments","controller"=>"nodeattachment","action"=>"movedown"))?>/" + id,
                   success:function(){
                    row.next().after(row)
                   }
                });
            }
        });
    });
</script>


<table class="table table-striped" id="attachments">
    <tr><th></th><th>Attachment Title</th><th>Attachment File URL</th><th>Operations</th></tr>
    
    <tbody>
    <?php
    if(isset($this->data['NodeAttachment'])){
        foreach($this->data['NodeAttachment'] as $attachment){
            $this->Attachment->row($attachment['title'],$attachment['url'],$attachment['id']);       
        }
    }
    ?>
    </tbody>
    
</table>


<button class="btn attachment-add" onclick="return false;">Add Attachment</button>

    
</div>
