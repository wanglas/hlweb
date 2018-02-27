var swfu;
$(document).ready(function(){
    swfu = new SWFUpload({
        // Backend Settings
        upload_url: APP+"/file/do_upload_img",
        post_params: {
        	"sid": sid,
            "thumb": thumb,
            "water": water,
            "path": path,
            "authcode":CURR_MODULE
        },
        // File Upload Settings
        file_size_limit : (file_size_limit/1024)+" MB",	// 2MB
        file_types : file_types,
        file_types_description : "JPG Images",
        file_upload_limit : "1",

        // Event Handler Settings - these functions as defined in Handlers.js
        //  The handlers are not part of SWFUpload but are part of my website and control how
        //  my website reacts to the SWFUpload events.
        file_queue_error_handler : fileQueueError_ll,
        file_dialog_complete_handler : fileDialogComplete_ll,
        upload_progress_handler : uploadProgress_ll,
        upload_error_handler : uploadError_ll,
        upload_success_handler : uploadSuccess_ll,
        upload_complete_handler : uploadComplete_ll,

        // Button Settings
        button_image_url : PUBLIC +"/js/swfupload/SmallSpyGlassWithTransperancy_17x18.png",
        button_placeholder_id : "spanButtonPlaceholder_"+img_id,
        button_width: 120,
        button_height: 30,
        button_text : '',//<span class="button">选择图片</span>
        button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
        button_text_top_padding: 0,
        button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,
				
        // Flash Settings
        flash_url : PUBLIC +"/js/swfupload/swfupload.swf",
				
        // Debug Settings
        debug: false
    });
});