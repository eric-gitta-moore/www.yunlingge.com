define(function(require){
    /* generated by mengma @2020-01-04 20:38 */
    var dialogid = 'dialog-'+mwt.genId();
    var form,dialog,params,callback;
    
    function init_dialog() 
    {/*{{{*/
        //1. new form
        form = new MWT.Form();
        form.addField('name',new MWT.TextField({
            type        : 'text',
            render      : 'fm-name'+dialogid,
            value       : '', 
            placeholder : '请输入下载类目名称',
            empty       : false,
            errmsg      : "请输入下载类目名称,不超过1024个字符",
            checkfun    : function(v){return v.length<=1024;}
        }));

        //2. new dialog
        dialog = new MWT.Dialog({
            title     : '对话框',
            form      : form,
			width : 400,
            style     : 'height:80px;',
            bodyStyle : 'padding:10px;',
            body : '<table class="mwt-formtab">'+
               '<tr>'+
                 '<td width="100">分类名称 <b style="color:red">*</b></td>'+
                 '<td><div id="fm-name'+dialogid+'"></div></td>'+
                 '<td width="50" class="tips"></td>'+
               '</tr>'+
            '</table>',
            buttons : [
                {label:"确定",cls:'mwt-btn-primary',handler:submitClick},
                {label:"取消",type:'close',cls:'mwt-btn-default'}
            ]
        });
        //3. dialog open event
        dialog.on('open',function(){
            form.reset();
            if (params.id) {
                dialog.setTitle("编辑记录");
                form.set(params);
            } else {
                dialog.setTitle("添加记录");
            }
        });
    }/*}}}*/

    var o={};
    o.open=function(_params,_callback){
        params   = _params;
        callback = _callback;
        if (!dialog) init_dialog();
        dialog.open();
    };  

    /////////////////////////////////////
    // 提交按钮点击事件
    function submitClick() {
        var data = form.getData();
        try {
            data.id = params.id;
            ajax.post('save',data,function(res){
                if (res.retcode!=0) mwt.notify(res.retmsg,1500,'danger');
                else {
                    dialog.close();
                    if (callback) callback();
                }   
            }); 
        } catch (e) {
            mwt.notify(e,1500,'danger');
        }
    }

    return o;
});