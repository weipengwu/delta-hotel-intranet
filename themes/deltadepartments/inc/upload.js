jQuery(document).ready(function(){
	var _custom_media = true,
      _orig_send_attachment = wp.media.editor.send.attachment;	
			jQuery(".button").live('click',function(){
				 var send_attachment_bkp = wp.media.editor.send.attachment;
			var button = $(this);
			var id = button.attr('id').replace('_button', '');
			alert(id);
			_custom_media = true;
			wp.media.editor.send.attachment = function(props, attachment) {

			  if ( _custom_media ) {
				var url = $("#"+id).val(attachment.url);
				
			  } else {
				return _orig_send_attachment.apply( this, [url, attachment] );
				
			  };

			}

			wp.media.editor.open(button);

			return false;
		  });
		jQuery('.add_media').live('click', function() {
		_custom_media = false;
		});
	
});
