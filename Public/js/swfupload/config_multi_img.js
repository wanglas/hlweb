var swfu;
$(document).ready(function(){
    swfu = new SWFUpload({
        // Backend Settings
        upload_url: APP+"/file/do_upload_img",
        post_params: {
        	"sid": multi_sid,
            "thumb": multi_thumb,
            "water": multi_water,
            "path": multi_path,
            "authcode":CURR_MODULE
        },
        // File Upload Settings
        file_size_limit : (multi_file_size_limit/1024)+" MB",	// 2MB
        file_types : multi_file_types,
        file_types_description : "JPG Images",
        file_upload_limit : "0",

		custom_settings : {
			progressTarget : "fsUploadProgress"
			//cancelButtonId : "btnCancel"
		},
        swfupload_preload_handler : preLoad,
		swfupload_load_failed_handler : loadFailed,
		file_queued_handler : fileQueued,
		file_queue_error_handler : fileQueueError,
		file_dialog_complete_handler : fileDialogComplete,
		upload_start_handler : uploadStart,
		upload_progress_handler : uploadProgress,
		upload_error_handler : uploadError,
		upload_success_handler : uploadSuccess,
		upload_complete_handler : uploadComplete,

        // Button Settings
        button_image_url : PUBLIC +"/js/swfupload/SmallSpyGlassWithTransperancy_17x18.png",
        button_placeholder_id : "spanButtonPlaceholder_"+multi_img_id,
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