function colorRGB2Hex(color) {
    var rgb = color.split(',');
    var r = parseInt(rgb[0].split('(')[1]);
    var g = parseInt(rgb[1]);
    var b = parseInt(rgb[2].split(')')[0]);
 
    var hex = "#" + ((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1);
    return hex;
 }

//把RGB颜色转换为标准颜色名
function boan_rgbToStandard(rgb){
	var coloroptions = ['Black', 'Sienna', 'DarkOliveGreen', 'DarkGreen', 'DarkSlateBlue', 'Navy', 'Indigo', 'DarkSlateGray', 'DarkRed', 'DarkOrange', 'Olive', 'Green', 'Teal', 'Blue', 'SlateGray', 'DimGray', 'Red', 'SandyBrown', 'YellowGreen', 'SeaGreen', 'MediumTurquoise', 'RoyalBlue', 'Purple', 'Gray', 'Magenta', 'Orange', 'Yellow', 'Lime', 'Cyan', 'DeepSkyBlue', 'DarkOrchid', 'Silver', 'Pink', 'Wheat', 'LemonChiffon', 'PaleGreen', 'PaleTurquoise', 'LightBlue', 'Plum', 'White'];
	var rgb1 = ['rgb(0,0,0)','rgb(160,82,45)','rgb(85,107,47)','rgb(0,100,0)','rgb(72,61,139)','rgb(0,0,128)','rgb(75,0,130)','rgb(47,79,79)',
			   'rgb(139,0,0)','rgb(255,140,0)','rgb(128,128,0)','rgb(0,128,0)','rgb(72,209,204)','rgb(0,0,255)','rgb(112,128,144)','rgb(105,105,105)',
			   'rgb(255,0,0)','rgb(244,164,96)','rgb(154,205,50)','rgb(46,139,87)','rgb(72,209,204)','rgb(65,105,225)','rgb(128,0,128)','rgb(128,128,128)',
			   'rgb(255,0,255)','rgb(255,165,0)','rgb(255,255,0)','rgb(0,255,0)','rgb(0,255,255)','rgb(0,191,255)','rgb(153,50,204)','rgb(192,192,192)',
			   'rgb(255,192,203)','rgb(245,222,179)','rgb(255,250,205)','rgb(152,251,152)','rgb(175,238,238)','rgb(173,216,230)','rgb(221,160,221)','rgb(255,255,255)',
	];
	var rgb2 = [0,2970272,3107669,25660,9125192,8388608,8519755,5197615,
	            139,36095,32896,32768,9125192,16711680,9470064,6908265,
				255,6333684,3329434,5737262,13422920,14772545,8388736,8421504,
				16711935,42495,65535,65280,16776960,16760576,13382297,12632256,
				13353215,11788021,13499135,10025880,15658671,15128749,14524637,16777215,
				];
	rgb += '';
	rgb = rgb.replace(/\s+/g,'');
	if(!rgb) return 'transparent';
	var i=0;
	if((rgb + '').indexOf('rgb') == -1) {
		for( i = 0; i < 40; i++){
			if(rgb2[i] == rgb) return coloroptions[i];
		}
	} else {
		for( i = 0; i < 40; i++){
			if(rgb1[i] == rgb) return coloroptions[i];
		}
	}
	return colorRGB2Hex(rgb);		
}

//获得当前选择区的字体、颜色等状态
function boan_getSelectionValue(cmd) {
	var rtn = false;
	
	if( cmd == 'forecolor' ) {
		rtn = editdoc.queryCommandValue('foreColor');
		//alert(rtn);
		rtn = boan_rgbToStandard(rtn);
		//alert(rtn);
	} else if(cmd == 'backcolor' ) {
		rtn = editdoc.queryCommandValue('backColor');
		rtn = boan_rgbToStandard(rtn);
	} else 	if(!isUndefined($(editorid + '_' + cmd))){
		switch(cmd) {
		case 'font' : 
			rtn = $(editorid + '_font' ).fontstate;
			rtn = rtn != '字体' ? rtn : false;
			break;
		case 'size' : 
			rtn = $(editorid + '_size' ).sizestate;
			rtn = rtn != '大小' ? rtn : false;
			break;
		default :
			rtn = $(editorid + '_' + cmd ).state;
		}
	}
	return rtn;
	
}

//显示颜色框 ctrlid为编辑器按纽ID，颜色框将显示在此按钮的下方;func是选择颜色后要调用的函数名，此函数必须要有一个参数用来接收颜色。
function boan_showColorBox(ctrlid,func) {
	if(!$(ctrlid + '_menu')){
		var menu = document.createElement('div');
		menu.id=ctrlid + '_menu';
		menu.className  = 'p_pop colorbox';
		menu.unselectable = true;
		menu.style.display='none';
		var coloroptions = ['Black', 'Sienna', 'DarkOliveGreen', 'DarkGreen', 'DarkSlateBlue', 'Navy', 'Indigo', 'DarkSlateGray', 'DarkRed', 'DarkOrange', 'Olive', 'Green', 'Teal', 'Blue', 'SlateGray', 'DimGray', 'Red', 'SandyBrown', 'YellowGreen', 'SeaGreen', 'MediumTurquoise', 'RoyalBlue', 'Purple', 'Gray', 'Magenta', 'Orange', 'Yellow', 'Lime', 'Cyan', 'DeepSkyBlue', 'DarkOrchid', 'Silver', 'Pink', 'Wheat', 'LemonChiffon', 'PaleGreen', 'PaleTurquoise', 'LightBlue', 'Plum', 'White'];
		var colortexts = ['黑色', '赭色', '暗橄榄绿色', '暗绿色', '暗灰蓝色', '海军色', '靛青色', '墨绿色', '暗红色', '暗桔黄色', '橄榄色', '绿色', '水鸭色', '蓝色', '灰石色', '暗灰色', '红色', '沙褐色', '黄绿色', '海绿色', '间绿宝石', '皇家蓝', '紫色', '灰色', '红紫色', '橙色', '黄色', '酸橙色', '青色', '深天蓝色', '暗紫色', '银色', '粉色', '浅黄色', '柠檬绸色', '苍绿色', '苍宝石绿', '亮蓝色', '洋李色', '白色'];
		
		var str = '';
		for(var i = 0; i < 40;i++) {
			str += '<input type="button" style="background-color:' + coloroptions[i] + '"' + (typeof setEditorTip == 'function' ? ' onmouseover="setEditorTip(\'' + colortexts[i] + '\')" cnmouseout="setEditorTip(\'\')"' : '' ) + ' onclick="'
			+ func + '(\'' + coloroptions[i] + '\')'  + '" title="' + colortexts[i] + '"/>' + ( i< 39 && ( i+1 )% 8==0 ? '<br/>' : '');
		}
		menu.innerHTML = str;
		$('append_parent').appendChild(menu);
	}
	showMenu({'ctrlid':ctrlid,'evt':'click','layer':1});
}

function cc(color){
	//设置发光字代码,如是即视模式则显示真实效果，否则显示代码
	var sel=getSel();
	if(wysiwyg && sel){
		var fname =  boan_getSelectionValue('font') ;
		var fsize =  boan_getSelectionValue('size') ;;
		var fcolor = boan_getSelectionValue('forecolor');	
		var bcolor =  boan_getSelectionValue('backcolor');
		addSnapshot(getEditorContents());
		try{
			var opentag = '';
	     	var closetag = '';
			if(BROWSER.ie){
				throw 'insertHTML Err';
			}
			if(fname || fsize || fcolor || bcolor){
				opentag = '<font ';
				fname && (opentag = opentag + ' face="' + fname + '"');
				fsize && (opentag = opentag + ' size="' + fsize + '"');
				fcolor && (opentag = opentag + ' color="' + fcolor + '"');
				bcolor && bcolor!='transparent' && (opentag = opentag + ' style="background-color:' + bcolor + '"');
				opentag += '>';
				closetag = '</font>';
			}
  			sel = sel.replace(/\<[\s\S]*?\>/ig,'');			
			var text='<span style="display:inline-block; text-shadow:1px 0 4px ';
			text += color + ',0 1px 4px ' + color + ',0 -1px 4px ' + color + ',-1px 0 4px '+ color +  ';filter:glow(color=' + color + ',strength=3)">' + sel + '</span>';
		 	editdoc.execCommand('removeformat');
			if(!editdoc.execCommand('insertHTML', false, opentag + text + closetag)) {
				throw 'insertHTML Err';
			}
		} catch (e){
			alert('浏览器不支持发光字设置，请更换其它浏览器或者在纯文本下编辑');
		}
	}else if(!wysiwyg) {
		var sel = getSel();
		var opentag = '[glow=' + color + ']';
		var closetag = '[/glow]';
		addSnapshot(getEditorContents());
		sel = stripSimple('glow', sel);
		sel = stripComplex('glow', sel);
		insertText(opentag + sel + closetag,strlen(opentag),strlen(closetag));
	}
	hideMenu();
}

function boan_glow_bbcodetohtml(){
	
	var str=EXTRASTR;
	var Rxp = /\[glow=([\w#\(\),\s]+?)\]([\s\S]+?)\[\/glow\]/ig;
	if(BROWSER.ie){
		return str;
	}
	while(Rxp.test(str)){
		str=str.replace(Rxp, function ($1,$2,$3){
				var text = '<span style="display:inline-block; text-shadow:1px 0 4px ';
				text += $2 + ',0 1px 4px ' + $2 + ',0 -1px 4px ' + $2 + ',-1px 0 4px '+ $2 +  ';filter:glow(color=' + $2 + ',strength=3)" >' + $3 + '</span>';
				return $3 ? text : '';
			 }
		 );
	}
	return str;
}

function boan_glow_htmltobbcode(){
	var str=EXTRASTR;
	var closetag = '';
	//var Rxp = /\<span[\s\S^\<^\>]*?filter:glow\(color=([\w#\s]+?),[\s\S]*?\>([\s\S]+?)\<\/span\>/ig;
	var Rxp = /\<span[\S\s^\<]*?text-shadow:([\s\S]*?)\>([\s\S]+?)\<\/span\>/ig;
	var cRxp = /[\s\S]*?filter:glow\(color=([\w#\s]+?),[\s\S]*?"/ig;
	//console.log(str);
	if(BROWSER.ie){
		return str;
	}
	
	/*str = str.replace(/\<span[\S\s^\<]*?text-shadow:([\D\s]+?)\dpx[\s\S]*?\>([\s\S]+?)\<\/span\>/ig,function ($1,$2,$3){
			var text='[glow=' + trim($2) + ']' + $3 + '[/glow]';
			return $3 ? text : '';
		 }
	);*/
	
	while(Rxp.test(str)){
		str = str.replace(Rxp,function ($1,$2,$3){
				//var text='[glow=' + $2 + ']' + $3 + '[/glow]';
				var color = '';
				var intext = $3;
				var flag = false;
				var text ='' ;
				$2=trim($2);
				if(cRxp.test($2)){
					color = $2.replace(cRxp,function($1,$2,$3){
						return $2;
					})
				}else{
					color = $2.substr(0,$2.indexOf(' '));
				}
				
				//console.log(color);
				
				intext = intext.replace(/(<font.*?>)+/ig,function($1,$2){
					flag = true;
					return  $1 + '[glow=' + color + ']';
				});
				//console.log($2);
			//	console.log(intext + 'test1');
				intext = intext.replace(/(<\/font.*?>)+/ig,function($1,$2){
					return '[/glow]' + $1;
				});
				//console.log(intext + 'test2');
				intext = intext.replace(/\[glow=[\s\S]+?\]([\s\S].*)\[\/glow\]/ig,function($1,$2){
					//console.log($2);
					return $2 ? $1 : '';
				});
				//text += intext +'[/glow]';
				
				return flag ? intext : '[glow=' + color + ']' + $3 + '[/glow]';
			 }
		);
		
	}
	//console.log('第一次');
	//console.log(str);
	
	
	
	return str;
}
_attachEvent($('e_boan_glow'),'click', function(e) {
	boan_showColorBox('e_boan_glow','cc');
	doane();
});


EXTRAFUNC['bbcode2html']['boan_glow_bbcodetohtml']='boan_glow_bbcodetohtml';
EXTRAFUNC['html2bbcode']['boan_glow_htmltobbcode']='boan_glow_htmltobbcode';
