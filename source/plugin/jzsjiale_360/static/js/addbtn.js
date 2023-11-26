function add360(cmd) {
	checkFocus();
	showEditorMenu360(cmd,'');
	return;
}

function Trim(str)
{ 
    return str.replace(/(^\s*)|(\s*$)/g, ""); 
}

function IsImgUrl(str) {
	if (str.length != 0) {
		var reg = /^[a-zA-z]+:\/\/[^\s]*[.]{1}(gif|jpg|png|bmp|jpeg|SS2)$/;
		//var reg = new RegExp(strRegex);
		if (!reg.test(str)) {
			return false;
		}else{
			return true;
		}
	}
}

function IsDouble(str) {
	if (str.length != 0) {
		reg = /^[-\+]?\d+(\.\d+)?$/;
		if (!reg.test(str)) {
			return false;
		}else{
			return true;
		}
	}
}


function showEditorMenu360(tag, params) {
	var sel, selection;
	var str = '', strdialog = 0, stitle = '';
	var ctrlid = editorid + (params ? '_cst' + params + '_' : '_') + tag;
	
	var menu = $(ctrlid + '_menu');
	var pos = [0, 0];
	var menuwidth = 270;
	var menupos = '43!';
	var menutype = 'menu';

	if(BROWSER.ie) {
		sel = wysiwyg ? editdoc.selection.createRange() : document.selection.createRange();
		pos = getCaret();
	}

	selection = sel ? (wysiwyg ? sel.htmlText : sel.text) : getSel();


	stitle = '\u63d2\u5165\u5168\u666f\u56fe\u7247';

	str = '';
	str += '<p class="pbn"><span style="color:red;">\u652f\u6301\u006a\u0070\u0067\u3001\u0070\u006e\u0067\u683c\u5f0f\u7684\u5168\u666f\u56fe\u7247\u3002\u000d\u000a</span></p>';
	str += '<p class="pbn">\u56fe\u7247\u5730\u5740:<input type="text" id="' + ctrlid + '_param_imgurl" class="px" value="" placeholder="\u8bf7\u8f93\u5165\u5168\u666f\u56fe\u7247\u5916\u94fe\u56fe\u7247\u5730\u5740" style="width: 270px;" /></p>';
	str += '<p class="pbn">\u6807\u9898:<input type="text" id="' + ctrlid + '_param_title" class="px" value="" placeholder="\u8bf7\u586b\u5199\u5168\u666f\u56fe\u7247\u7684\u6807\u9898" style="width: 270px;" /></p>';
	str += '<p class="pbn">\u7535\u8111\u7248\u5bbd:<input id="' + ctrlid + '_param_width" style="width: 80px;" value="500" class="px" />&nbsp;&nbsp;px&nbsp;&nbsp;&nbsp;&nbsp;';
	str += '\u7535\u8111\u7248\u9ad8:<input id="' + ctrlid + '_param_height" style="width: 80px;" value="280" class="px" />&nbsp;&nbsp;px</p>';
	str += '<p class="pbn">\u624b\u673a\u7248\u9ad8:<input id="' + ctrlid + '_param_mheight" style="width: 80px;" value="280" class="px" />&nbsp;&nbsp;px</p>';
	str += '<p class="pbn"><span style="color:red;">\u5bbd\u9ad8\u5fc5\u987b\u586b\u5199\u5927\u4e8e\u0030\u7684\u6570\uff0c\u624b\u673a\u7248\u5bbd\u5ea6\u9ed8\u8ba4\u0031\u0030\u0030\u0025</span></p>';




	s = '<style type="text/css">'
	+'.jzsjiale360css input,.pbn {font:12px/1.5 Tahoma,Helvetica,"SimSun",sans-serif !important;}'
	+'.jzsjiale360css input {line-height:17px !important;height:17px !important;padding:4px !important;}'
	+'.jzsjiale360css p{max-width:364px !important;}'
	+'.jzsjiale360css div.c{max-width:384px !important;padding:0 10px !important;}'
	+'.jzsjiale360css h3.flb{max-width:364px !important;padding:10px 10px 8px !important;}'
	+'.jzsjiale360css td.m_c{max-width:364px !important;padding:0px!important;}'
	+'</style>';



	menuwidth = 400;//600
	menupos = '00';
	menutype = 'win';

	var menu = document.createElement('div');
	menu.id = ctrlid + '_menu';
	menu.style.display = 'none';
	menu.className = 'p_pof upf';
	menu.style.width = menuwidth + 'px';
	if(menupos == '00') {
			menu.className = 'fwinmask jzsjiale360css';
			s += '<table width="100%" cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;&nbsp;</td><td class="m_c">'
				+ '<h3 class="flb"><em>' + stitle + '</em><span><a onclick="hideMenu(\''+ctrlid + '_menu\', \'win\');return false;" class="flbc" href="javascript:;">\u5173\u95ed</a></span></h3><div class="c">' + str + '</div>'
				+ '<p class="o pns"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>\u63d0\u4ea4</strong></button></p>'
				+ '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
		} else {
			s += '<div class="p_opt cl"><span class="y" style="margin:-10px -10px 0 0"><a onclick="hideMenu();return false;" class="flbc" href="javascript:;">\u5173\u95ed</a></span><div>' + str + '</div><div class="pns mtn"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>\u63d0\u4ea4</strong></button></div></div>';
		}
	menu.innerHTML = s;
	$(editorid + '_editortoolbar').appendChild(menu);
	showMenu({'ctrlid':ctrlid,'mtype':menutype,'evt':'click','duration':3,'cache':0,'drag':1,'pos':menupos});

	try {
		if($(ctrlid + '_param_imgurl')) {
			$(ctrlid + '_param_imgurl').focus();
		}
	} catch(e) {}
	var objs = menu.getElementsByTagName('*');
	for(var i = 0; i < objs.length; i++) {
		_attachEvent(objs[i], 'keydown', function(e) {
			e = e ? e : event;
			obj = BROWSER.ie ? event.srcElement : e.target;
			if((obj.type == 'text' && e.keyCode == 13) || (obj.type == 'textarea' && e.ctrlKey && e.keyCode == 13)) {
				if($(ctrlid + '_submit') && tag != 'image') $(ctrlid + '_submit').click();
				doane(e);
			} else if(e.keyCode == 27) {
				hideMenu();
				doane(e);
			}
		});
	}
	if($(ctrlid + '_submit')) $(ctrlid + '_submit').onclick = function() {
		checkFocus();
		switch(tag) {
			case 'jzsjiale_360':
				var imgurl = Trim($(ctrlid + '_param_imgurl').value);
				var imgtitle = Trim($(ctrlid + '_param_title').value);
				var imgwidth = Trim($(ctrlid + '_param_width').value);
				var imgheight = Trim($(ctrlid + '_param_height').value);
				var imgmheight = Trim($(ctrlid + '_param_mheight').value);

				if(imgurl == ""){
					alert("\u8bf7\u586b\u5199\u5168\u666f\u56fe\u7247\u94fe\u63a5!");
					return;
				}
				if(!IsImgUrl(imgurl)){
					alert("\u5168\u666f\u56fe\u7247\u94fe\u63a5\u683c\u5f0f\u4e0d\u6b63\u786e!");
					return;
				}

				if(imgtitle == ""){
					imgtitle = "#"
				}

				if(imgwidth != "" && !IsDouble(imgwidth)){
					imgwidth = '500px';
				}else{
					imgwidth = imgwidth+'px';
				}

				if(imgheight != "" && !IsDouble(imgheight)){
					imgheight = '280px';
				}else{
					imgheight = imgheight+'px';
				}

				if(imgmheight != "" && !IsDouble(imgmheight)){
					imgmheight = '280px';
				}else{
					imgmheight = imgmheight+'px';
				}

				str = squarestrip(imgurl)+",="+squarestrip(imgtitle)+",="+squarestrip(imgwidth)+",="+squarestrip(imgheight)+",="+squarestrip(imgmheight);

				var opentag = '[' + tag + ']';
				var closetag = '[/' + tag + ']';

				str = opentag + str + closetag;
				insertText(str, strlen(opentag), strlen(closetag), false, sel);

				hideMenu('', 'win');
				hideMenu();

				break;
			
			default:
				
				break;
		}
		
	};
}