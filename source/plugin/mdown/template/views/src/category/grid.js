define(function(require){
	var ajax=require("ajax");
	var dialog=require('./dialog');
	var store,grid,isie=inIE();
    var o={};
    o.init = function(){
		store = new window.mwt.Store({
            proxy: new window.mwt.HttpProxy({
                url: ajax.getAjaxUrl("query")
            })
        });
		grid = new window.MWT.Grid({
			cls: 'categrid',
            render      : 'grid-div',
            store       : store,
            pagebar     : false,
//            pageSize    : 20,
			noheader    : false,
            multiSelect : false, 
            bordered    : false,
            striped     : false,     //!< 斑马纹
			bodyStyle   : '',
			tbarStyle   : 'margin-bottom:5px;background:#fff;border:none;',
			tbar: [
				{label:'<i class="sicon-plus"></i> 新增分类',cls:'mwt-btn-success',
				 handler:function(){
					dialog.open({id:0},o.query);
				}}
			],
            cm: new MWT.Grid.ColumnModel([
			  {head:'显示顺序',dataIndex:'displayorder',width:100,align:'center',sort:false,render:function(v,item){
                var code = '<input name="dorder" type="text" data-id="'+item.id+'" '+
					'class="mwt-field txt" style="text-align:center;" value="'+v+'"/>';
				return code;
              }},
              {head:'分类名称',dataIndex:"name",align:'left',width:200,sort:false,render:function(v,item){
				return v;
			  }},
              {head:'',dataIndex:"id",align:'left',hide:isie,render:function(id,item){
				var btncls = '';//'mwt-btn mwt-btn-default mwt-btn-xs';
                var setbtn = '<a name="setbtn" class="'+btncls+'" data-id="'+id+'" href="javascript:;">编辑</a>';
                var delbtn = '<a name="delbtn" class="'+btncls+'" data-id="'+id+'" href="javascript:;">删除</a>';
                var btns = [setbtn,delbtn];
				if (v.uid!=item.uid) btns=[setbtn];
                return btns.join("&nbsp;&nbsp;");
              }}
            ])
        });
        grid.create();
		store.on('load',function(){
			mwt.initImageView();
			// 启用开关
			jQuery('[name=dorder]').unbind('change').change(function(){
                var id = jQuery(this).data('id');
                var v = jQuery(this).val();
                ajax.post('setDisplayorder',{id:id,displayorder:v},function(res){
                    if (res.retcode!=0) mwt.notify(res.retmsg,1500,'danger');
                    //mwt.notify('已保存',1500,'success');
					else {
						grid.load();
					}
                });
            });
			// 删除按钮
			jQuery('[name=delbtn]').unbind('click').click(function(){
				var id = jQuery(this).data('id');
				mwt.confirm('确定要删除吗?',function(res){
					if (res) {
						ajax.post('remove',{id:id},function(res){
							if (res.retcode!=0) mwt.alert(res.retmsg);
							else grid.load();
						});
					}
				});
			});
			// 编辑按钮
            jQuery('[name=setbtn]').unbind('click').click(function(){
				var id = jQuery(this).data('id');
				var item = grid.getRecord('id',id);
				dialog.open(item,o.query);
			});

		});

		if (isie) {
			var msg = "请使用Chrome或Firefox浏览器打开此页面";
			jQuery('#tbar-grid-div').hide();
			jQuery('#msg-div').html(msg);
		}		

		o.query();
    };

	o.query=function() {
		store.baseParams = {
           // enable : mwt.get_select_value("enable-sel"),
           // key  : mwt.get_value("so-key")
        };
        grid.load();
	};

    return o;
});
