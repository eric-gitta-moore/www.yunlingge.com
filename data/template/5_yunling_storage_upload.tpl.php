<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./source/plugin/yunling_storage/template/upload.htm', './template/default/common/upload.htm', 1584707270, 'yunling_storage', './data/template/5_yunling_storage_upload.tpl.php', './source/plugin/yunling_storage/template', 'upload')
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
    !window.jQuery && document.write('<script type = "text/javascript" src ="/source/plugin/yunling_storage/template/webuploader-0.1.5/jquery-1.8.3.min.js"><\/script>');
</script>
<link rel="stylesheet" href="/source/plugin/yunling_storage/webuploader-0.1.5/webuploader.css">
<script src="/source/plugin/yunling_storage/webuploader-0.1.5/webuploader.min.js" type="text/javascript"></script>
<!--<noco mpress>-->
<script>
    function fileDialogComplete(numFilesSelected, numFilesQueued) {
        try {
            if (this.customSettings.uploadSource == 'forum') {
                if (this.customSettings.uploadType == 'attach') {
                    if (typeof switchAttachbutton == "function") {
                        switchAttachbutton('attachlist');
                    }
                    try {
                        if (this.getStats().files_queued) {
                            $('attach_tblheader').style.display = '';
                            $('attach_notice').style.display = '';
                        }
                    } catch (ex) {
                    }
                } else if (this.customSettings.uploadType == 'image') {
                    if (typeof switchimagebutton == "function") {
                        switchImagebutton('imgattachlist');
                    }
                    try {
                        $('imgattach_notice').style.display = '';
                    } catch (ex) {
                    }
                }
                var objId = this.customSettings.uploadType == 'attach' ? 'attachlist' : 'imgattachlist';
                var listObj = $(objId);
                var tableObj = listObj.getElementsByTagName("table");
                if (!tableObj.length) {
                    listObj.innerHTML = "";
                }
            } else if (this.customSettings.uploadType == 'blog') {
                if (typeof switchImagebutton == "function") {
                    switchImagebutton('imgattachlist');
                }
            }
        } catch (ex) {
        }
    }

    function serialize(data, sep) {
        var send_string = '';
        for (_key in data) {
            if (typeof (data[_key]) != 'object' && typeof (data[_key]) != 'array') {
                if (sep) {
                    send_string += sep + '[' + _key + "]=" + data[_key] + "&";
                } else {
                    send_string += _key + "=" + data[_key] + "&";
                }

            } else {
                send_string += serialize(data[_key], _key);
            }
        }
        return send_string;
    }

    function uploadSuccess1(file, serverData, uploadType) {
        if (uploadType.options.customSettings.uploadSource == 'forum') {
            if (uploadType.options.customSettings.uploadType == 'poll') {
                var data = eval('(' + serverData + ')');
                if (parseInt(data.aid)) {
                    var preObj = $(uploadType.options.customSettings.progressTarget);
                    preObj.innerHTML = "";
                    preObj.style.display = '';
                    var img = new Image();
                    img.src = IMGDIR + '/attachimg_2.png';//data.smallimg;
                    var imgObj = document.createElement("img");
                    imgObj.src = img.src;
                    imgObj.className = "cur1";
                    imgObj.onmouseout = function () {
                        hideMenu('poll_img_preview_' + data.aid + '_menu');
                    };//"hideMenu('poll_img_preview_"+data.aid+"_menu');";
                    imgObj.onmouseover = function () {
                        showMenu({
                            'menuid': 'poll_img_preview_' + data.aid + '_menu',
                            'ctrlclass': 'a',
                            'duration': 2,
                            'timeout': 0,
                            'pos': '34'
                        });
                    };
                    //"showMenu({'menuid':'poll_img_preview_"+data.aid+"_menu','ctrlclass':'a','duration':2,'timeout':0,'pos':'34'});";
                    preObj.appendChild(imgObj);
                    var inputObj = document.createElement("input");
                    inputObj.type = 'hidden';
                    inputObj.name = 'pollimage[]';
                    inputObj.id = uploadType.options.customSettings.progressTarget + '_aid';
                    inputObj.value = data.aid;
                    preObj.appendChild(inputObj);
                    var preImgObj = document.createElement("span");
                    preImgObj.style.display = 'none';
                    preImgObj.id = 'poll_img_preview_' + data.aid + '_menu';
                    img = new Image();
                    img.src = data.smallimg;
                    imgObj = document.createElement("img");
                    imgObj.src = img.src;
                    preImgObj.appendChild(imgObj);
                    preObj.appendChild(preImgObj);
                }
            } else {
                aid = parseInt(serverData);
                if (aid > 0) {
                    if (uploadType.options.customSettings.uploadType == 'attach') {
                        ajaxget('forum.php?mod=ajax&action=attachlist&aids=' + aid + (!fid ? '' : '&fid=' + fid) + (typeof resulttype == 'undefined' ? '' : '&result=simple'), file.id);
                    } else if (uploadType.options.customSettings.uploadType == 'image') {
                        var tdObj = getInsertTdId(uploadType.options.customSettings.imgBoxObj, 'image_td_' + aid);
                        ajaxget('forum.php?mod=ajax&action=imagelist&type=single&pid=' + pid + '&aids=' + aid + (!fid ? '' : '&fid=' + fid), tdObj.id);
                        $(file.id).style.display = 'none';
                    }
                } else {
                    // aid = aid < -1 ? Math.abs(aid) : aid;
                    // if(typeof STATUSMSG[aid] == "string") {
                    //     progress.setStatus(STATUSMSG[aid]);
                    //     showDialog(STATUSMSG[aid], 'notice', null, null, 0, null, null, null, null, sdCloseTime);
                    // } else {
                    //     progress.setStatus("取消上传");
                    // }
                    // this.cancelUpload(file.id);
                    // progress.setCancelled();
                    // progress.toggleCancel(true, this);
                    // var stats = this.getStats();
                    // var obj = {'successful_uploads':--stats.successful_uploads, 'upload_cancelled':++stats.upload_cancelled};
                    // this.setStats(obj);
                }
            }
        } else if (uploadType.options.customSettings.uploadType == 'album') {
            var data = serverData;
            if (parseInt(data.picid)) {
                var newTr = document.createElement("TR");
                var newTd = document.createElement("TD");
                var img = new Image();
                img.src = data.url;
                var imgObj = document.createElement("img");
                imgObj.style.maxWidth = "100px";
                imgObj.style.maxHigth = "100px";
                imgObj.src = img.src;
                newTd.className = 'c';
                newTd.appendChild(imgObj);
                newTr.appendChild(newTd);
                newTd = document.createElement("TD");
                newTd.innerHTML = '<strong>' + file.name + '</strong>';
                newTr.appendChild(newTd);
                newTd = document.createElement("TD");
                newTd.className = 'd';
                newTd.innerHTML = '图片描述<br/><textarea name="title[' + data.picid + ']" cols="40" rows="2" class="pt"></textarea>';
                newTr.appendChild(newTd);
                uploadType.options.customSettings.imgBoxObj.appendChild(newTr);
            } else {
                showDialog('图片上传失败', 'notice', null, null, 0, null, null, null, null, sdCloseTime);
            }
            $(file.id).style.display = 'none';
        } else if (uploadType.options.customSettings.uploadType == 'blog') {
            var data = eval('(' + serverData + ')');
            if (parseInt(data.picid)) {
                var tdObj = getInsertTdId(uploadType.options.customSettings.imgBoxObj, 'image_td_' + data.picid);
                var img = new Image();
                img.src = data.url;
                var imgObj = document.createElement("img");
                imgObj.src = img.src;
                imgObj.className = "cur1";
                imgObj.onclick = function () {
                    insertImage(data.bigimg);
                };
                tdObj.appendChild(imgObj);
                var inputObj = document.createElement("input");
                inputObj.type = 'hidden';
                inputObj.name = 'picids[' + data.picid + ']';
                inputObj.value = data.picid;
                tdObj.appendChild(inputObj);
            } else {
                showDialog('图片上传失败', 'notice', null, null, 0, null, null, null, null, sdCloseTime);
            }
            $(file.id).style.display = 'none';
        } else if (uploadType.options.customSettings.uploadSource == 'portal') {
            var data = eval('(' + serverData + ')');
            if (data.aid) {
                if (uploadType.options.customSettings.uploadType == 'attach') {
                    ajaxget('portal.php?mod=attachment&op=getattach&type=attach&id=' + data.aid, file.id);
                    if ($('attach_tblheader')) {
                        $('attach_tblheader').style.display = '';
                    }
                } else {
                    var tdObj = getInsertTdId(uploadType.options.customSettings.imgBoxObj, 'attach_list_' + data.aid);
                    ajaxget('portal.php?mod=attachment&op=getattach&id=' + data.aid, tdObj.id);
                    $(file.id).style.display = 'none';
                }
            } else {
                // showDialog('上传失败', 'notice', null, null, 0, null, null, null, null, sdCloseTime);
                // progress.setStatus("Cancelled");
                // this.cancelUpload(file.id);
                // progress.setCancelled();
                // progress.toggleCancel(true, this);
            }
        } else {
            // progress.setComplete();
            // progress.setStatus("上传完成.");
            // progress.toggleCancel(false);
        }
    }


    jQuery("#e_imgattachlist").find("div").first().before('<div id="uploader-button"><div id="filePicker"></div></div><div id="imgFileList" class="uploader-list"></div>');

    
EOF;
 if($allowpostimg) { 
$return .= <<<EOF

    var imgUpload = new WebUploader.Uploader({
        auto: true,
        swf: 'source/plugin/yunling_storage/template/webuploader-0.1.5/Uploader.swf',

        // 文件接收服务端。
        server: '{$upload_host}',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#filePicker',
        fileSingleSizeLimit: {$_G['group']['maxattachsize']},

        customSettings: {
            progressTarget: "imgUploadProgress",
            uploadSource: '{$_G['basescript']}',
            uploadType: 'image',
            imgBoxObj: $('imgattachlist'),


            singleUpload: $('_btn_local')
        },
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        accept: {
            title: 'Images',
            extensions: imgexts.replace(/\s+/g,""),
            mimeTypes: 'image/*'
        }

    });

    imgUpload.options.formData.key = [];

    // 当有文件被添加进队列的时候
    var imgFileList = jQuery("#imgFileList");
    imgUpload.on('fileQueued', function (file) {
        imgFileList.append('<li id="' + file.id + '" class="statusBar">' +
            '<div class="info">' + file.name + '</div>' +
            '<div id="img-progress" class="progress progress-bar"><span class="percentage" style="width:0%;"></span></div></li>');
    });

    // 文件上传过程中创建进度条实时显示。
    imgUpload.on('uploadProgress', function (file, percentage) {
        percentage = percentage.toFixed(4);
        var li = jQuery('#' + file.id),
            percent = li.find('.progress .progress-bar');
        // 避免重复创建
        // li.find('p.state').text('上传中:');
        jQuery('#' + file.id + ' .percentage').css('width', percentage * 100 + '%');
        jQuery('#' + file.id + ' .percentage').html(percentage * 100 + '%');

    });

    imgUpload.on('uploadBeforeSend', function (block, data) {
        // block为分块数据。
        var tokeninfo;
        var filename = block.file.name;
        filename = filename.replace(/(\(|\)|\s)/g, "");
        jQuery.ajax({
            type: "post",
            url: 'plugin.php?id=yunling_storage:token&filename=' + filename + '&ext=' + block.file.ext,
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
            complete: function (XMLHttpRequest, status) {
            	//请求完成后最终执行参数
                if (status == 'timeout') {
                    console.log('ajax_timeout');
                }
            },
            async: false
        });

        // file为分块对应的file对象。
        var file = block.file;
        // 修改data可以控制发送哪些携带数据。
        data.Filename = file.name;
        data.type = 'image';
        data.hash = '{$swfconfig['hash']}';
        data.filetype = '.' + block.file.ext;
        data.uid = {$_G['uid']};

        if (tokeninfo.apiselect == '1') {
            data['signature'] = tokeninfo.signature;
            data['OSSAccessKeyId'] = tokeninfo.OSSAccessKeyId;
            data['success_action_status'] = '200';
            data['callback'] = '';
            data['filename'] = file.name;
            //保留原来上传的名字
            data['Disposition'] = file.name;
            data['filesize'] = file.size;
            data['policy'] = tokeninfo.policy;
            data['key'] = tokeninfo.key;

        } else if (tokeninfo.apiselect == '2') {
            data['bucket'] = tokeninfo.bucket;
            data['expiration'] = tokeninfo.expiration;
            data['policy'] = tokeninfo.policy;
            data['authorization'] = tokeninfo.authorization;
        }
        imgUpload.options.formData.key.push(tokeninfo.key);
        imgUpload.options.apiselect = tokeninfo.apiselect;
    });


    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    imgUpload.on('uploadSuccess', function (file, data) {

        var filename = file.name;
        filename = filename.replace(/(\(|\)|\s)/g, "");

        jQuery('#' + file.id).addClass('upload-state-done');
        var postData = {};
        var currentId = 'forum';
        postData.Filename = filename;
        postData.type = 'image';
        postData.hash = '{$swfconfig['hash']}';
        postData.filetype = '.' + file.ext;
        postData.uid = {$_G['uid']};
        postData['success_action_status'] = '200';
        postData['callback'] = '';
        postData['filename'] = filename;
        postData['Disposition'] = filename;
        postData['Content-Disposition'] = filename;
        postData['filesize'] = file.size;
        postData['key'] = imgUpload.options.formData.key.shift();
        postData['formhash'] = '{$_G['formhash']}';
        if (imgUpload.options.apiselect == 2) {
            postData['image-width'] = data['image-width'];
            postData['image-height'] = data['image-height'];
        }
        if (jQuery('.current#e_btn_albumlist').length == 1) {
            currentId = 'album';
            imgUpload.options.customSettings.uploadType = currentId;
            imgUpload.options.customSettings.uploadSource = currentId;
            imgUpload.options.customSettings.imgBoxObj = $('albumphoto');
        }
        var _ajax = new Ajax('JSON');
        var send_string = serialize(postData);
        _ajax.post('plugin.php?id=yunling_storage:upload&current=' + currentId + '&operation=upload', send_string, function (res) {
            uploadSuccess1(file, res, imgUpload);
            jQuery('#' + file.id).remove();
        })
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    imgUpload.on('error', function (error) {
        if (error == 'F_EXCEED_SIZE') {
            showDialog('上传附件尺寸过大，超过允许上传最大值', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'F_DUPLICATE') {
            showDialog('此文件已经上传过了，同一个文件只允许上传一次', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_EXCEED_NUM_LIMIT')
        {
            showDialog('添加的文件数量超出', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_EXCEED_SIZE_LIMIT')
        {
            showDialog('添加的文件总大小超出', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_TYPE_DENIED')
        {
            showDialog('文件类型不满足', 'info', '', '', 0, null, '', '', '', 3);
        }
        console.log(error);
    });
    
EOF;
 } 
$return .= <<<EOF


    
EOF;
 if($_G['group']['allowpostattach']) { 
$return .= <<<EOF

    jQuery("#spanButtonPlaceholder").html('<div id="uploader" class="wu-">\
    <div class="btns">\
        <div id="attach_picker"></div>\
    </div>\
    <div id="thelist" class="uploader-list filelist"></div>\
</div>');
    var upload = new WebUploader.Uploader({
        auto: true,
        // swf文件路径
        swf: 'source/plugin/yunling_storage/template/webuploader-0.1.5/Uploader.swf',

        // 文件接收服务端。
        server: '{$upload_host}',

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '#attach_picker',
        fileSingleSizeLimit: {$_G['group']['maxattachsize']},

        customSettings: {
            progressTarget: "fsUploadProgress",
            uploadSource: '{$_G['basescript']}',
            uploadType: 'attach',


            singleUpload: $('_btn_upload')
        },
        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        accept: {
            title: '*',
            extensions: '{$_G['group']['attachextensions']}',
            mimeTypes: '*/*'
        }
    });

    var filelist = jQuery("#unusedattachlist");
    upload.on('fileQueued', function (file) {
        filelist.append('<li id="' + file.id + '" class="statusBar">' +
            '<span class="info">' + file.name + '</span>' +
            '<span id="upload-progress" class="progress"></span>' +
            '</li>');
    });

    // 文件上传过程中创建进度条实时显示。
    upload.on('uploadProgress', function (file, percentage) {
        percentage = percentage.toFixed(4);

        var li = jQuery('#' + file.id),
            percent = li.find('.progress .progress-bar');
        // 避免重复创建
        if (!percent.length) {
            percent = jQuery('<div class="progress progress-striped active">' +
                '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                '</div>' +
                '</div>').appendTo(li).find('.progress-bar');
        }

        // li.find('p.state').text('上传中:');

        jQuery('#upload-progress').html(percentage * 100 + '%');
    });
    upload.options.formData.key = [];
    upload.on('uploadBeforeSend', function (block, data) {
        var tokeninfo;

        var filename = block.file.name;
        filename = filename.replace(/(\(|\)|\s)/g, "");

        jQuery.ajax({
            type: "post",
            url: 'plugin.php?id=yunling_storage:token&filename=' + filename + '&ext=' + block.file.ext,
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
            complete: function (XMLHttpRequest, status) { 
            	//请求完成后最终执行参数
                if (status == 'timeout') {
                    console.log('ajax_timeout');
                }
            },
            async: false
        });

        // block为分块数据。
        // file为分块对应的file对象。
        var file = block.file;

        // 修改data可以控制发送哪些携带数据。
        data.Filename = file.name;
        data.type = 'attach';
        data.hash = '{$swfconfig['hash']}';
        data.filetype = '.' + block.file.ext;
        data.uid = {$_G['uid']};

        if (tokeninfo.apiselect == '1') {
            data['signature'] = tokeninfo.signature;
            data['OSSAccessKeyId'] = tokeninfo.OSSAccessKeyId;
            data['success_action_status'] = '200';
            data['callback'] = '';
            data['filename'] = file.name;
            data['Disposition'] = file.name;
            data['Content-Disposition'] = 'attachment;filename=' + file.name;
            //保留原来上传的名字
            
            data['filesize'] = file.size;
            data['policy'] = tokeninfo.policy;
            data['key'] = tokeninfo.key;

        } else if (tokeninfo.apiselect == '2') {
            data['bucket'] = tokeninfo.bucket;
            data['expiration'] = tokeninfo.expiration;
            data['policy'] = tokeninfo.policy;
            data['authorization'] = tokeninfo.authorization;
        }
        upload.options.formData.key.push(tokeninfo.key);
        upload.options.apiselect = tokeninfo.apiselect;


    });

    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    upload.on('uploadSuccess', function (file, data) {
        jQuery('#attach_tblheader')[0].style.display = '';
        jQuery('#' + file.id).addClass('upload-state-done');
        var postData = {};

        var filename = file.name;
        filename = filename.replace(/(\(|\)|\s)/g, "");

        postData.Filename = filename;
        postData.type = 'attach';
        postData.hash = '{$swfconfig['hash']}';
        postData.filetype = '.' + file.ext;
        postData.fileinfo = file.type;
        postData.uid = {$_G['uid']};
        postData['success_action_status'] = '200';
        postData['callback'] = '';
        postData['filename'] = filename;
        postData['Disposition'] = filename;
        postData['filesize'] = file.size;
        postData['formhash'] = '{$_G['formhash']}';
        postData['key'] = upload.options.formData.key.shift();
        var _ajax = new Ajax('JSON');
        var send_string = serialize(postData);
        _ajax.post('plugin.php?id=yunling_storage:upload&current=forum&operation=upload', send_string, function (res) {

            uploadSuccess1(file, res, upload);
        })
    });
    // 文件上传成功，给item添加成功class, 用样式标记上传成功。
    upload.on('error', function (error) {
        if (error == 'F_EXCEED_SIZE') {
            showDialog('上传附件尺寸过大，超过允许上传最大值', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'F_DUPLICATE') {
            showDialog('此文件已经上传过了，同一个文件只允许上传一次', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_EXCEED_NUM_LIMIT')
        {
            showDialog('添加的文件数量超出', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_EXCEED_SIZE_LIMIT')
        {
            showDialog('添加的文件总大小超出', 'info', '', '', 0, null, '', '', '', 3);
        }
        else if (error == 'Q_TYPE_DENIED')
        {
            showDialog('文件类型不满足', 'info', '', '', 0, null, '', '', '', 3);
        }
        console.log(error);
    });
    
EOF;
 } 
$return .= <<<EOF

</script>


EOF;
 if(false) { 
$return .= <<<EOF

<script type="text/javascript">
    //老版本
function randomString(len) {
    len = len || 32;
    var chars = 'ABCDEFGHJKMNPQRSTUVWXYZabcdefhijkmnprstuvwxyz123456789';
    var maxPos = chars.length;
    var pwd = '';
    for (i = 0; i < len; i++) {
        pwd += chars.charAt(Math.floor(Math.random() * maxPos));
    }
    return pwd;
}
function uploadStart(file) {
    try {
        this.addPostParam('filetype', file.type);
        this.addPostParam('filename', file.name);
        this.addPostParam('filesize', file.size);
        this.addPostParam('key', '{$filepath}' + randomString(16) + file.type);
        this.addPostParam('Content-Disposition', 'attachment;filename=' + file.name);
        if(this.customSettings.uploadSource == 'forum' && this.customSettings.uploadType == 'poll') {
            var preObj = $(this.customSettings.progressTarget);
            preObj.style.display = 'none';
            preObj.innerHTML = '';
        }
        var progress = new FileProgress(file, this.customSettings.progressTarget);
        progress.setStatus("上传中...");
        progress.toggleCancel(true, this);
        if(this.customSettings.uploadSource == 'forum') {
            var objId = this.customSettings.uploadType == 'attach' ? 'attachlist' : 'imgattachlist';
            var attachlistObj = $(objId).parentNode;
            attachlistObj.scrollTop = $(file.id).offsetTop - attachlistObj.clientHeight;
        }
    } catch (ex) {
    }

    return true;
}
function fileDialogComplete(numFilesSelected, numFilesQueued) {
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
        // alert(1);
        // _upload.setUploadURL("1");
        var res;
        alert(2);
        jQuery.ajax({
            url:'plugin.php?id=yunling_storage:token&filename='+_upload.getFile().name,
            async:false,
            success:function (res_) {
                alert(res.signature);
                res = res_;
            }
        });

        alert(1);


        if(res.signature){
            _upload.setUploadURL(res.host);
            _upload.setFilePostName('file');
            _upload.settings.post_params['signature'] = res.signature;
            _upload.settings.post_params['OSSAccessKeyId'] = res.OSSAccessKeyId;
            _upload.settings.post_params['success_action_status'] = '200';
            _upload.settings.post_params['callback'] = '';
            // _upload.settings.post_params['filename'] = _upload.getFile().name;
            // _upload.settings.post_params['Content-Disposition'] = 'attachment;filename=' + _upload.getFile().name;
            // _upload.settings.post_params['filesize'] = _upload.getFile().size;
            _upload.settings.post_params['policy'] = res.policy;
            // _upload.settings.post_params['key'] =res.filepath + res.target_filename + _upload.getFile().type;
            _upload.startUpload();
        }
        _ajax.get('plugin.php?id=yunling_storage:token&filename='+_upload.getFile().name,function(res){
            alert(res.signature);
            if(res.signature){
                _upload.setUploadURL(res.host);
                _upload.setFilePostName('file');
                _upload.settings.post_params['signature'] = res.signature;
                _upload.settings.post_params['OSSAccessKeyId'] = res.OSSAccessKeyId;
                _upload.settings.post_params['success_action_status'] = '200';
                _upload.settings.post_params['callback'] = '';
                // _upload.settings.post_params['filename'] = _upload.getFile().name;
                // _upload.settings.post_params['Content-Disposition'] = 'attachment;filename=' + _upload.getFile().name;
                // _upload.settings.post_params['filesize'] = _upload.getFile().size;
                _upload.settings.post_params['policy'] = res.policy;
                // _upload.settings.post_params['key'] =res.filepath + res.target_filename + _upload.getFile().type;
                _upload.startUpload();

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

        function uploadSuccess1(file, serverData) {
            var swfobj = this;
            var _ajax = new Ajax('JSON');
            var postData;
            var send_string = serialize(swfobj.settings.post_params);
            _ajax.post('plugin.php?id=yunling_storage:upload&current=forum&operation=upload',send_string,function(res){
                uploadSuccess.call(swfobj,file, res);
            })
        }

        
EOF;
 if($allowpostimg) { 
$return .= <<<EOF

        var imgUpload = new SWFUpload({
            upload_url: "{$_G['siteurl']}misc.php?mod=swfupload&action=swfupload&operation=upload&fid={$_G['fid']}",
            post_params: {"uid" : "{$_G['uid']}", "hash":"{$swfconfig['hash']}", "type":"image"},
            file_size_limit : "{$swfconfig['max']}",
            file_types : "{$swfconfig['imageexts']['ext']}",
            file_types_description : "{$swfconfig['imageexts']['depict']}",
            file_upload_limit : {$swfconfig['limit']},
            file_queue_limit : 0,
            swfupload_preload_handler : preLoad,
            swfupload_load_failed_handler : loadFailed,
            file_dialog_start_handler : fileDialogStart,
            file_queued_handler : fileQueued,
            file_queue_error_handler : fileQueueError,
            file_dialog_complete_handler : function () {
                jQuery.ajax({
                    url:'plugin.php?id=yunling_storage:token&filename='+_upload.getFile().name,
                    async:false,
                    success:function (res_) {
                        alert(res.signature);
                        res = res_;
                    }
                });
            },
            upload_start_handler : uploadStart,
            upload_progress_handler : uploadProgress,
            upload_error_handler : uploadError,
            upload_success_handler : uploadSuccess1,
            upload_complete_handler : uploadComplete,
            button_image_url : "{$__IMGDIR}/uploadbutton.png",
            button_placeholder_id : "imgSpanButtonPlaceholder",
            button_width: 100,
            button_height: 25,
            button_cursor:SWFUpload.CURSOR.HAND,
            button_window_mode: "transparent",
            custom_settings : {
                progressTarget : "imgUploadProgress",
                uploadSource: 'forum',
                uploadType: 'image',
                imgBoxObj: $('imgattachlist'),
                
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

                
EOF;
 if($swfconfig['filtertype']) { 
$return .= <<<EOF

                filterType: {$swfconfig['filtertype']},
                
EOF;
 } 
$return .= <<<EOF

                singleUpload: $('{$editorid}_btn_local')
            },
            debug: false
        });
        
EOF;
 } 
$return .= <<<EOF

        
EOF;
 if($_G['group']['allowpostattach']) { 
$return .= <<<EOF

        var upload = new SWFUpload({
            upload_url: "{$_G['siteurl']}misc.php?mod=swfupload&action=swfupload&operation=upload&fid={$_G['fid']}",
            post_params: {"uid":"{$_G['uid']}", "hash":"{$swfconfig['hash']}"},
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
            upload_success_handler : uploadSuccess1,
            upload_complete_handler : uploadComplete,
            button_image_url : "{$__IMGDIR}/uploadbutton.png",
            button_placeholder_id : "spanButtonPlaceholder",
            button_width: 100,
            button_height: 25,
            button_cursor:SWFUpload.CURSOR.HAND,
            button_window_mode: "transparent",
            custom_settings : {
                progressTarget : "fsUploadProgress",
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

                
EOF;
 if($swfconfig['filtertype']) { 
$return .= <<<EOF

                filterType: {$swfconfig['filtertype']},
                
EOF;
 } 
$return .= <<<EOF

                singleUpload: $('{$editorid}_btn_upload')
            },

            debug: false
        });
    
EOF;
 } 
$return .= <<<EOF

</script>

EOF;
 } 
$return .= <<<EOF

<!--<nocompress>-->

EOF;
?><?php if(function_exists('yunling_redirect_resource_output')){yunling_redirect_resource_output('doNotMove');}?>