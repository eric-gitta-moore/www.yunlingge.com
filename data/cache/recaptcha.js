(function () {
var recptc = $('recptc');
var idhash = recptc.className;
var showid = 'seccode_' + idhash;
var onloadid = 'grecol_' + idhash;
if (BROWSER.ie && BROWSER.ie < 10) {
$('v' + showid).innerHTML = '您的浏览器版本过低，无法加载reCAPTCHA验证码，建议使用非IE浏览器。';
} else {
var data = recptc.innerText;
appendscript('https://www.recaptcha.net/recaptcha/api.js?onload=grec_ol'+idhash, '', 1);
var sectpl = seccheck_tpl[idhash] != '' ? seccheck_tpl[idhash].replace(/<hash>/g, 'code' + idhash).replace(/_menu/g, '_hidden') : '';
var sectplcode = sectpl != '' ? sectpl.split('<sec>') : Array('<br />', ': ', '<br />', '');
var string = sectplcode[0] + "验证码" + sectplcode[1] + '<input name="seccodehash" type="hidden" value="' + idhash + '" /><span id="checkseccodeverify_' + idhash + '" style="display:none"><img src="//r1.lcwz01.top/static/image/common/check_right.gif" width="16" height="16" class="vm"></span><input name="seccodeverify" id="seccodeverify_' + idhash + '" type="hidden" value="' + idhash + '" /><div class="g-recaptcha" data-sitekey="6LfEUNsUAAAAACmaNOTwQQtHu9M4ISoUq9uteGzC"></div><span id="' + onloadid + '"><img src="//r1.lcwz01.top/static/image/common/loading.gif" class="vm"></span>&nbsp;&nbsp;<a href="javascript:;" onclick="updateseccode(\'' + idhash + '\');doane(event);" class="xi2">刷新</a>' + sectplcode[2] + sectplcode[3];
$(showid).innerHTML = string;
setTimeout(function () {
$(onloadid).innerHTML = data;
$(onloadid).innerHTML += '<a class="xi2" style="margin-left:6px" href="misc.php?mod=faq"><img src="//r1.lcwz01.top/static/image/common/info_small.gif" class="vm" onmouseover="showTip(this)" tip="点此查看帮助"></a>';
}, 2000);
var r9=$('seccodeverify_'+idhash).form;
if(r9&&!r9.hasAttribute('data-recaptcha')){
r9.setAttribute('data-recaptcha',idhash);
r9.addEventListener('submit',function(){setTimeout(function(){updateseccode(idhash)}, 2000)});
}
}
window['grec_ol'+idhash] = function () {
display(onloadid);
}
})()