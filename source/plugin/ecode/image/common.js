function QhShow(num){
	if (document.getElementById('codetxt'+num+'_a').style.display == '') {
		document.getElementById('QhShow'+num).value = "　易代码模式　";
		changecodetext(num);

	} else{
		document.getElementById('QhShow'+num).value = "　纯文本模式　";
		changecodeshow(num);
	}
}


function changecodeshow (num){
	document.getElementById('codetxt'+num+'_a').style.display = "";
	document.getElementById('codetxt'+num+'_b').style.display = "none";
	}

	
function changecodetext (num){
	var s;
	document.getElementById('codetxt'+num+'_a').style.display = "none";
	document.getElementById('codetxt'+num+'_b').style.display = "";	
	s = document.getElementById('ecode_'+num).value;
	s = s.replace(/<br\s\/>/g,'');
	s = s.replace(/\xA0/g,'\x20');
	document.getElementById('ecode_'+num).value = s;
	}

	
function copyecode(num,txt){
	var s;
	s = document.getElementById('ecode_'+num).value;
	s = s.replace(/<br\s\/>/g,'');
	s = s.replace(/\xA0/g,'\x20');
	setCopy(s,txt);
	}
/*
//欢迎大家自己创新编写本插件 . 有更好的思路及代码,也请分享到到我网站里.以便更多人下载使用..
//程序已免费开源,  请不要修改此处版权 谢谢
// 逐优网   http://bbs.zuuu.com
 */
