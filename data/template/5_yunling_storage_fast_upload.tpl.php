<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./source/plugin/yunling_storage/template/fast_upload.htm', './template/default/common/upload.htm', 1584689664, 'yunling_storage', './data/template/5_yunling_storage_fast_upload.tpl.php', './source/plugin/yunling_storage/template', 'fast_upload')
;?><?php
$__STATICURL = STATICURL;$__VERHASH = VERHASH;$__IMGDIR = IMGDIR;$return = <<<EOF

EOF;
 if(empty($_G['uploadjs'])) { 
$return .= <<<EOF

<link rel="stylesheet" type="text/css" href="{$__STATICURL}js/webuploader/webuploader.css?{$__VERHASH}">
<script src="{$__STATICURL}js/mobile/jquery.min.js?{$__VERHASH}" type="text/javascript"></script>
<script src="{$__STATICURL}js/webuploader/webuploader.min.js?{$__VERHASH}" type="text/javascript"></script>
<script src="{$_G['setting']['jspath']}webuploader.js?{$__VERHASH}" type="text/javascript"></script>
EOF;
 $_G['uploadjs'] = 1;
$return .= <<<EOF

EOF;
 } 
$return .= <<<EOF
<script>

    function fileDialogComplete1(numFilesSelected, numFilesQueued) {
        try {
            if(this.customSettings.uploadSource == 'forum') {
                if(this.customSettings.uploadType == 'attach') {
                    if(typeof switchAttachbutton == "function") {
                        switchAttachbutton('attachlist');
                    }
                    try {
                        if(this.getStats().files_queued) {
                            $('attach_tblheader').style.display = '';
                            $('attach_notice').style.display = '';
                        }
                    } catch (ex) {}
                } else if(this.customSettings.uploadType == 'image') {
                    if(typeof switchImagebutton == "function") {
                        switchImagebutton('imgattachlist');
                    }
                    try {
                        $('imgattach_notice').style.display = '';
                    } catch (ex) {}
                }
                var objId = this.customSettings.uploadType == 'attach' ? 'attachlist' : 'imgattachlist';
                var listObj = $(objId);
                var tableObj = listObj.getElementsByTagName("table");
                if(!tableObj.length) {
                    listObj.innerHTML = "";
                }
            } else if(this.customSettings.uploadType == 'blog') {
                if(typeof switchImagebutton == "function") {
                    switchImagebutton('imgattachlist');
                }
            }
            var _upload = this;
            var _ajax = new Ajax('JSON');
            _ajax.get('plugin.php?id=yunling_storage:token',function(res){
                if(res.apiselect){

                    let c_file;
                    if (typeof _upload.getFile === 'undefined')
                    {
                        let files = _upload.uploader.getFiles();
                        c_file = files[files.length-1];
                    }
                    else
                    {
                        c_file = _upload.getFile();
                    }


                    if (typeof _upload.setFilePostName !== 'undefined')
                        _upload.setFilePostName('file');
                    else
                        _upload.uploader.option('fileVal','file');

                    if (typeof _upload.setUploadURL !== 'undefined')
                    {
                        _upload.setUploadURL(res.host);
                    }
                    else
                    {
                        _upload.uploader.option('server',res.host);
                        _upload.settings.upload_url = res.host;
                    }

                    if (res.apiselect == '1') {
                        // _upload.setUploadURL(res.host);
                        // _upload.setFilePostName('file');
                        _upload.settings.post_params['signature'] = res.signature;
                        _upload.settings.post_params['OSSAccessKeyId'] = res.OSSAccessKeyId;
                        _upload.settings.post_params['success_action_status'] = '200';
                        _upload.settings.post_params['callback'] = '';
                        _upload.settings.post_params['filename'] = c_file.name;
                        _upload.settings.post_params['filesize'] = c_file.size;
                        _upload.settings.post_params['Content-Disposition'] = c_file.size;
                        _upload.settings.post_params['policy'] = res.policy;
                        _upload.settings.post_params['key'] =res.key;

                        if (typeof _upload.setUploadURL === 'undefined')
                        {
                            _upload.uploader.option('formData',_upload.settings);
                        }

                    }else if (res.apiselect == '2') {
                        // _upload.setUploadURL(res.host);
                        // _upload.setFilePostName('file');
                        _upload.settings.post_params['bucket'] = res.bucket;
                        _upload.settings.post_params['expiration'] = res.expiration;
                        _upload.settings.post_params['policy'] = res.policy;
                        _upload.settings.post_params['authorization'] = res.authorization;
                        // _upload.settings.post_params['filename'] = _upload.getFile().name;
                        // _upload.settings.post_params['filesize'] = _upload.getFile().size;
                        _upload.settings.post_params['filename'] = c_file.name;
                        _upload.settings.post_params['filesize'] = c_file.size;
                        _upload.settings.post_params['key'] =res.key;
                    }

                    if (typeof _upload.startUpload === 'undefined')
                    {
                        _upload.uploader.upload();
                    }
                    else
                    {
                        _upload.startUpload();
                    }
                }
            })

        } catch (ex)  {
            this.debug(ex);
        }
    }

    function serialize(data,sep){
        var send_string = '';
        for(_key in data){
            if(typeof (data[_key])!='object' && typeof (data[_key])!='array'){
                if(sep){
                    send_string += sep+'['+_key+"]="+data[_key]+"&";
                }
                else{
                    send_string += _key+"="+data[_key]+"&";
                }

            }
            else{
                send_string += serialize(data[_key],_key);
            }
        }
        return send_string;
    }

    // function uploadSuccess1(file, serverData ,upload) {
    //
    //     var swfobj = upload;
    //     // var _ajax = new Ajax('JSON');
    //     // var postData;
    //     // var send_string = serialize(swfobj.options.formData);$('attach_tblheader').style = '';
    //     uploadSuccess.call(swfobj,file,serverData);
    //     // _ajax.post('plugin.php?id=yunling_storage:upload&current=forum&operation=upload',send_string,function(res){
    //     //     $('attach_tblheader').style = '';
    //     //     uploadSuccess.call(swfobj,file, res);
    //     // })
    // }

    var upload = new SWFUpload({
        // upload_url: "{$_G['siteurl']}misc.php?mod=swfupload&action=swfupload&operation=upload&fid={$_G['fid']}",
        upload_url: "{$upload_host}",
        post_params: {"uid" : "{$_G['uid']}", "hash":"{$swfconfig['hash']}"},
        file_size_limit : "{$swfconfig['max']}",
        file_types : "{$swfconfig['attachexts']['ext']}",
        file_types_description : "{$swfconfig['attachexts']['depict']}",
        file_upload_limit : {$swfconfig['limit']},
        file_queue_limit : 0,
        swfupload_preload_handler : preLoad,
        swfupload_load_failed_handler : loadFailed,
        file_dialog_start_handler : fileDialogStart,
        file_queued_handler : fileQueued,
        file_queue_error_handler : fileQueueError,
        file_dialog_complete_handler : fileDialogComplete,
        upload_start_handler : uploadStart,
        upload_progress_handler : uploadProgress,
        upload_error_handler : uploadError,
        // upload_success_handler : uploadSuccess1,
        upload_complete_handler : uploadComplete,
        button_image_url : "{$__IMGDIR}/uploadbutton_small.png",
        button_placeholder_id : "spanButtonPlaceholder",
        button_width: 17,
        button_height: 25,
        button_cursor:SWFUpload.CURSOR.HAND,
        button_window_mode: "transparent",
        custom_settings : {
            progressTarget : "attachlist",
            uploadSource: 'forum',
            uploadType: 'attach',
            
EOF;
 if($swfconfig['maxsizeperday']) { 
$return .= <<<EOF

            maxSizePerDay: {$swfconfig['maxsizeperday']},
            
EOF;
 } 
$return .= <<<EOF

            
EOF;
 if($swfconfig['maxattachnum']) { 
$return .= <<<EOF

            maxAttachNum: {$swfconfig['maxattachnum']},
            
EOF;
 } 
$return .= <<<EOF

            uploadFrom: 'fastpost'
        },
        debug: false
    });

    upload.uploader.options.formData.key = [];

    upload.uploader.on('uploadSuccess', function (file, data) {

        let _upload = this;

        var filename = file.name;
        filename = filename.replace(/(\(|\)|\s)/g, "");

        // jQuery('#' + file.id).addClass('upload-state-done');
        var postData = {};
        var currentId = 'forum';
        postData.Filename = filename;
        postData.type = 'attach';
        postData.hash = '{$swfconfig['hash']}';
        postData.filetype = '.' + file.ext;
        postData.uid = {$_G['uid']};
        postData['success_action_status'] = '200';
        postData['callback'] = '';
        postData['filename'] = filename;
        postData['Disposition'] = filename;
        postData['Content-Disposition'] = filename;
        postData['filesize'] = file.size;
        postData['key'] = _upload.options.formData.key.shift();
        postData['formhash'] = '{$_G['formhash']}';
        var _ajax = new Ajax('JSON');
        var send_string = serialize(postData);
        _ajax.post('plugin.php?id=yunling_storage:upload&current=' + currentId + '&operation=upload', send_string, function (res) {
            // uploadSuccess.call(file, res);
            uploadSuccess.call(upload,file,res);
            // uploadSuccess1(file, res, upload);
            // jQuery('#' + file.id).remove();
        })
    });

    upload.uploader.on('uploadBeforeSend',function (obj,data,headers) {
        // console.log(this);
        // console.log(obj);
        // console.log(data);
        // console.log(headers);
        // return;
        let _upload = this;
        let _ajax = new Ajax('JSON');
        let file = obj.file;
        var tokeninfo;
        jQuery.ajax({
            type: "post",
            url: 'plugin.php?id=yunling_storage:token',
            timeout: 3000,
            data: {},
            success: function (str) {
                if (str) {
                    try {
                        tokeninfo = jQuery.parseJSON(str);
                    } catch (e) {
                        console.log("data_error");
                    }
                } else {
                    console.log("token_responce_is_empty");
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                console.log("ajax error");
            },
            complete: function (XMLHttpRequest, status) { //请求完成后最终执行参数
                if (status == 'timeout') {
                    console.log('ajax_timeout');
                }
            },
            async: false
        });
        // _ajax.get('plugin.php?id=yunling_storage:token',function(res){resource=res});
        _upload.option('fileVal','file');

        // console.log(tokeninfo);
        data['signature'] = tokeninfo.signature;
        data['OSSAccessKeyId'] = tokeninfo.OSSAccessKeyId;
        data['success_action_status'] = '200';
        data['callback'] = '';
        data['filename'] = file.name;
        data['filesize'] = file.size;
        data['Content-Disposition'] = file.size;
        data['policy'] = tokeninfo.policy;
        data['key'] =tokeninfo.key;

        _upload.options.formData.key.push(tokeninfo.key);
        // _upload.uploader.upload();
    })
</script>

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>