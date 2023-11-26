define(function(require){
	var ajax=require("ajax");
	// var dialog=require('./dialog');
	var store,grid,isie=inIE();
    var o={};
    o.init = function(){
		store = new window.mwt.Store({
            proxy: new window.mwt.HttpProxy({
                url: ajax.getAjaxUrl("queryDownlog")
            })
        });
		grid = new window.MWT.Grid({
			cls: 'categrid',
            render      : 'grid-div',
            store       : store,
            pagebar     : true,
            pageSize    : 20,
			noheader    : false,
            multiSelect : false, 
            bordered    : false,
            striped     : true,     //!< 斑马纹
			filename    : "资源下载记录",
			bodyStyle   : '',
			tbarStyle   : 'margin:2px 0 5px;background:#f1f2f3;',
			tbar: [
				{label:"日期",id:'dt2',type:"daterangepicker",float:'left',value:0,handler:o.query},
				{type:'search',id:'so-key',width:300,placeholder:'查询用户名和资源',handler:o.query}
			],
            cm: new MWT.Grid.ColumnModel([
            	{head:'下载时间',dataIndex:"downtime",align:'left',width:150,sort:true},
				{head:'下载资源',dataIndex:"rscid",align:'left',width:200,sort:true,render:function(v,item){
					return item.rsctitle;
				}},
				{head:'用户',dataIndex:"uid",align:'left',width:120,sort:true,render:function(v,item){
					return v==0 ? "<i>游客</i>" : item.username;
				}},
				{head:'IP地址',dataIndex:"clientip",align:'left',width:150,sort:true},
				{head:'明细',dataIndex:"extinfo",align:'left',sort:false}
            ])
        });
        grid.create();
		store.on('load',function(){
			mwt.initImageView();
		});
		if (isie) {
			var msg = "请使用Chrome或Firefox浏览器打开此页面";
			jQuery('#tbar-grid-div').hide();
			jQuery('#msg-div').html(msg);
		}
		o.query();
    };

	o.query=function() {
		var dr = mwt.get_value('dt2');
		var arr = dr.split(' ~ ');
		store.baseParams = {
			key: mwt.get_value("so-key"),
			sday: arr[0],
			eday: arr[1]
        };
        grid.load();
	};

    return o;
});
