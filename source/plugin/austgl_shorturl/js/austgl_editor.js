function austglurl_showEditorMenu(tag,params){
	checkFocus();
	var sel, selection;
	var str = '', strdialog = 0,stitle = '';
	var ctrlid = editorid + (params ? '_cst' + params + '_' : '_') + tag;
	var menu = $(ctrlid + '_menu');
	var pos = [0, 0];
	var menuwidth = 450;
	var menupos = '00';
	var menutype = 'menu';

	if(BROWSER.ie) {
		sel = wysiwyg ? editdoc.selection.createRange() : document.selection.createRange();
		pos = getCaret();
	}

	selection = sel ? (wysiwyg ? sel.htmlText : sel.text) : getSel();
	str = '<p class="pbn">'+austgl_insert+'</p><p class="pbn"><input type="text" id="' + ctrlid + '_param_1" class="px" value="" style="width: 400px;" /></p><br /><p class="pbn"></p><p class="xg2 pbn">'+ austgl_example +'</p>';
	menutype = 'win';
	var menu = document.createElement('div');
	menu.id = ctrlid + '_menu';
	menu.style.display = 'none';
	menu.className = 'p_pof upf';
	menu.style.width = menuwidth + 'px';
	if(menupos == '00') {
			menu.className = 'fwinmask';
			s = '<table width="100%" cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;&nbsp;</td><td class="m_c">'
				+ '<h3 class="flb"><em>' + stitle + '</em><span><a onclick="hideMenu(\'\', \'win\');return false;" class="flbc" href="javascript:;">'+ austgl_shutdown +'</a></span></h3><div class="c">' + str + '</div>'
				+ '<p class="o pns"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>'+ austgl_submit +'</strong></button></p>'
				+ '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
		}
	menu.innerHTML = s;
	$(editorid + '_editortoolbar').appendChild(menu);
	showMenu({'ctrlid':ctrlid,'mtype':menutype,'evt':'click','duration':3,'cache':0,'drag':1,'pos':menupos});
	$(ctrlid + '_param_1').focus();
	var objs = menu.getElementsByTagName('*');
	for(var i = 0; i < objs.length; i++) {
		_attachEvent(objs[i], 'keydown', function(e) {
			e = e ? e : event;
			obj = BROWSER.ie ? event.srcElement : e.target;
			if((obj.type == 'text' && e.keyCode == 13) || (obj.type == 'textarea' && e.ctrlKey && e.keyCode == 13)) {
				if($(ctrlid + '_submit') && tag != 'image') $(ctrlid + '_submit').click();
				doane(e);
			} else if(e.keyCode == 27) {
				hideMenu('', 'win');
				hideMenu();
				doane(e);
			}
		});
	}

	if($(ctrlid + '_submit')) $(ctrlid + '_submit').onclick = function() {
		checkFocus();
		if(BROWSER.ie && wysiwyg) {
			setCaret(pos[0]);
		}
		if(wysiwyg){
			$(ctrlid + '_param_1').value=$(ctrlid + '_param_1').value.replace(/</g,'&lt;').replace(/\r?\n/g, '<br />');
		}
		if($(ctrlid + '_param_1').value){
			insertText('[glurl]' + squarestrip($(ctrlid + '_param_1').value) + '[/glurl]', 7, 8, false, sel);
		}
		hideMenu('', 'win');
		hideMenu();
	}
}