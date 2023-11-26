define(function(require){

var ResourceField=function(opt)
{
    this.listeners={};
    var thiso=this;
    var errpop;           //!< 错误弹框
    var errmsg;           //!< 错误信息
    var empty=false;      //!< 是否允许为空
    var checkfun;         //!< 自定义校验函数
    var optdivid,popStyle='max-height:100px;';
    var dialogid,tid;
    var dialog;
    var dialogConf = [
        {title:'网络资源'}/*,
        {title:'本地资源'}*/
    ];
    if(opt)
    {
        this.construct(opt);
        if(opt.errmsg) errmsg=opt.errmsg;
        if(opt.checkfun) checkfun=opt.checkfun;
        if(opt.empty) empty=opt.empty;
        dialogid = this.render+"-dialog";
        tid = this.render+'-txt';
        optdivid=this.render+"pop";
        if(opt.popStyle)popStyle=opt.popStyle;

        var imguploader = new mwt.ImageUpload({
            ajaxapi: ajax.getAjaxUrl('uploadImage')
        });
    }

    // 网络资源代码
    function getWebRscCode() {
        var code = '<input id="webrsc-'+dialogid+'" type="text" class="mwt-field" placeholder="请输入网络资源URL" style="margin:5px 0 10px">'+
            '<button class="mwt-btn mwt-btn-primary mwt-btn-xs" id="webrscbtn-'+tid+'">确定</button>';
        return code;
    }

    function createDialog() {
        var ul=[],divs=[];
        for (var i=0;i<dialogConf.length;++i) {
            var im = dialogConf[i];
            ul.push('<li name="dgtabli-'+tid+'" id="dgtabli-'+i+'">'+
                '<a name="dgtab-'+tid+'" data-idx="'+i+'" href="javascript:;">'+im.title+'</a></li>');

            var divcode = i;
            if (im.title=="网络资源"){divcode=getWebRscCode();}
            divs.push('<div name="pmdiv-'+tid+'" id="pmdiv-'+tid+i+'" class="webimgtabdiv">'+divcode+'</div>');
        }
        dialog = new MWT.Dialog({
            title     : '上传资源',
            top : 50,
            width : 400,
            height: 200,
            bodyStyle : 'padding:10px;',
            body : '<div class="webimgtab"><ul class="mwt-nav mwt-nav-tabs">'+ul.join('')+'</ul></div>'+divs.join("")
        });
        dialog.on('open',function () {
            // tab切换
            jQuery('[name=dgtab-'+tid+']').unbind('click').click(function(){
                var idx = jQuery(this).data("idx");
                showTab(idx);
            });
            // 默认显示第一个
            showTab(0);
            // 确定网络资源
            jQuery("#webrscbtn-"+tid).unbind('click').click(function(){
                var url = mwt.get_text_value('webrsc-'+dialogid);
                dialog.close();
                thiso.setValue(url);
            });
        });
    }

    function showTab(idx) {
        jQuery("[name=dgtabli-"+tid+"]").removeClass("mwt-active");
        jQuery('#dgtabli-'+idx).addClass("mwt-active");
        jQuery("[name=pmdiv-"+tid+"]").hide();
        jQuery("#pmdiv-"+tid+idx).show();
    }

    // create
    this.create=function(){
        //1. 创建dom元素
        var code = '<div class="mwt-row mwt-row-flex">'+
              '<div class="mwt-col-fill">'+
                '<a id="field-'+tid+'" class="rscfield" target="_blank"></a>'+
                '<a id="upimgbtn-'+tid+'" href="javascript:;">设置资源</a>'+
              '</div>'+
            '</div>'+
            '<div id="'+optdivid+'" class="mwt-field-pop" style="'+popStyle+'"></div>';
        jQuery("#"+this.render).html(code);
        errpop = new MWT.Popover({anchor:tid,html:errmsg,cls:"mwt-popover-danger"});
        mwt.initImageView();
        this.setValue(this.value);
        //2. 创建弹窗
        createDialog();
        //3. 绑定事件
        jQuery('#upimgbtn-'+tid).unbind('click').click(function(){
            dialog.open();
        });
    };

    function change() {
        errpop.hide();
        thiso.value = mwt.get_value(tid);
        thiso.fire("change");
        if (thiso.value!='') jQuery("#"+tid+'-clear').show();
        thiso.refresh();
    };

    this.setValue=function(v){
        this.value=v;
        jQuery('#field-'+tid).attr("href",v).html(v);
    };

    this.validate=function() {
        errpop.hide();
        // var t = empty ? mwt.get_value(tid) : mwt.get_text_value(tid);
        // if (checkfun && !checkfun(t)) {
        //     errpop.pop();
        //     jQuery("#"+tid).focus();
        //     setTimeout(errpop.hide,2000);
        //     return false;
        // }
        return true;
    };
};
MWT._extends(ResourceField, MWT.Field);

return ResourceField;
});
