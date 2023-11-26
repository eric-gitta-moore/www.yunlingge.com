define(function(require){

var WebImageField=function(opt)
{
    this.listeners={};
    var thiso=this;
    var tid;
    var type="text";      //!< 
    var placeholder="输入图片链接";
    var errpop;           //!< 错误弹框
    var errmsg;           //!< 错误信息
    var empty=false;      //!< 是否允许为空
    var checkfun;         //!< 自定义校验函数
    var optdivid,popStyle='max-height:100px;';
    var storekey;         //!< localStorage存储的key

    var dialog;
    var dataPath = dz.pluginPath+"/template/static/";
    var dialogConf = [
        {title:'内置图片',data:dz.sysimgs},
        {title:'网络图片'}
    ];
    if(opt)
    {
        this.construct(opt);
        if(opt.type) type=opt.type;
        if(opt.placeholder) placeholder=opt.placeholder;
        if(opt.errmsg) errmsg=opt.errmsg;
        if(opt.checkfun) checkfun=opt.checkfun;
        if(opt.empty) empty=opt.empty;
        tid=this.render+"txt";
        optdivid=this.render+"pop";
        if(opt.popStyle)popStyle=opt.popStyle;
        storekey=this.render+"skey";

        var imguploader = new mwt.ImageUpload({
            ajaxapi: ajax.getAjaxUrl('uploadImage')
        });
    }

    // 内置图片选择代码
    function getImageSelectCode(data) {
        var imgs = [];
        for (var i=0;i<data.length;++i) {
            var img = '<img name="nzimg-'+tid+'" data-url="'+data[i]+'" src="'+data[i]+'" class="nzimg">';
            imgs.push(img);
        }
        return imgs.join('');
    }

    // 网络图片代码
    function getImageWebCode() {
        var code = '<input id="webimgtxt-'+tid+'" type="text" class="mwt-field" placeholder="图片地址" style="margin:5px 0 10px">'+
                '<button class="mwt-btn mwt-btn-primary mwt-btn-xs" id="webimgbtn-'+tid+'">确定</button>';
        return code;
    }

    function createDialog() {
        var ul=[],divs=[];
        for (var i=0;i<dialogConf.length;++i) {
            var im = dialogConf[i];
            ul.push('<li name="dgtabli-'+tid+'" id="dgtabli-'+i+'">'+
                '<a name="dgtab-'+tid+'" data-idx="'+i+'" href="javascript:;">'+im.title+'</a></li>');

            var divcode = i;
            if (im.title=="内置图片") { divcode=getImageSelectCode(im.data); }
            else if(im.title=="网络图片") divcode=getImageWebCode();
            divs.push('<div name="pmdiv-'+tid+'" id="pmdiv-'+i+'" class="webimgtabdiv">'+divcode+'</div>');
        }
        dialog = new MWT.Dialog({
            title     : '选择图片',
            top : 50,
            width : 400,
            height: 250,
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
            // 选择内置图片
            jQuery("[name=nzimg-"+tid+"]").unbind('click').click(function(){
                var imgurl = jQuery(this).data("url");
                dialog.close();
                thiso.setValue(imgurl);
            });
            // 确定网络图片
            jQuery("#webimgbtn-"+tid).unbind('click').click(function(){
                var imgurl = mwt.get_text_value('webimgtxt-'+tid);
                dialog.close();
                thiso.setValue(imgurl);
            });
        });
    }

    function showTab(idx) {
        jQuery("[name=dgtabli-"+tid+"]").removeClass("mwt-active");
        jQuery('#dgtabli-'+idx).addClass("mwt-active");
        jQuery("[name=pmdiv-"+tid+"]").hide();
        jQuery("#pmdiv-"+idx).show();
    }

    // create
    this.create=function(){
        //1. 创建dom元素
        var code = '<div class="mwt-row mwt-row-flex">'+
              '<div class="mwt-col-fill">'+
                '<img id="img-'+tid+'" src="" class="mwt-image-view nzimg">'+
                '<a id="upimgbtn-'+tid+'" href="javascript:;">选择图片</a>'+
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
        // mwt.set_value(tid,v);
        this.value=v;
        // this.refresh();
        jQuery('#img-'+tid).attr('src',v);
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
MWT._extends(WebImageField, MWT.Field);

return WebImageField;
});
