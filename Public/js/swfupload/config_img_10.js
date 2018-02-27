var swfu;
var URL = '/index.php/admin/bank';
var PUBLIC = '/Public';
var ROOT_PATH = '';
var APP	 =	 '/index.php';
var STATIC = '/ieflex/Modules/Admin/Tpl/default/Static';
var CURR_MODULE = 'bank';
var CURR_ACTION = 'edit';
var CURR_GROUP = 'Admin';
//定义JS中使用的语言变量
var CONFIRM_DELETE = '你确定要删除选择项吗？';
var AJAX_LOADING = '提交请求中，请稍候...';
var AJAX_ERROR = 'AJAX请求发生错误！';
var ALREADY_REMOVE = '已删除';
var SEARCH_LOADING = '搜索中...';
var CLICK_EDIT_CONTENT = '点击修改内容';

$(document).ready(function(){
    swfu = new SWFUpload({
        // Backend Settings
        upload_url: APP+"/"+CURR_GROUP+"/file/do_upload_img",
        post_params: {
        	"sid": sid,
            "thumb": thumb,
            "water": water
        },
        // File Upload Settings
        file_size_limit : "2 MB",	// 2MB
        file_types : "*.jpg;*.gif;*.jpeg;*.bmp;*.png",
        file_types_description : "JPG Images",
        file_upload_limit : "3",

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
        button_image_url : ROOT_PATH+"/Public/js/swfupload/SmallSpyGlassWithTransperancy_17x18.png",
        button_placeholder_id : "spanButtonPlaceholder_"+img_id,
        button_width: 100,
        button_height: 18,
        button_text : '<span class="button">选择图片</span>',
        button_text_style : '.button { font-family: Helvetica, Arial, sans-serif; font-size: 12pt; } .buttonSmall { font-size: 10pt; }',
        button_text_top_padding: 0,
        button_text_left_padding: 18,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,
				
        // Flash Settings
        flash_url : ROOT_PATH+"/Public/js/swfupload/swfupload.swf",
				
        // Debug Settings
        debug: false
    });
});