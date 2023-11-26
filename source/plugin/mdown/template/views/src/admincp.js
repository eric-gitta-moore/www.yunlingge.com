var ajax,dict;
define('app',function(require){
	var o={};
	ajax = require('ajax');
	dict = require('dict');
	var pages = {
		'category': require('./category/page'),
		'resource': require('./resource/page'),
		'downlog': require('./downlog/page')
	};
	o.exec=function(page){
		if (!pages[page]) alert("找不到"+page);
		else pages[page].execute();
	};
	return o;
});

var admincp = {
	init: function(baseUrl) {
		require.config({
			baseUrl: baseUrl
		});
	},
	run: function(page) {
		require(['app'], function(app){
			app.exec(page);
		});
	},
	forbidIE: function(domid) {
		if(inIE()) {
			var code = '<p style="color:red;line-height:30px;">请使用 chrome 或 firefox 浏览器打开此后台管理页面</p>';
			jQuery('#'+domid).html(code);
			throw "forbidIE";
		}
	}
};

/* dz提交数据特殊字符转义 */
function dz_post_encode(str)
{/*{{{*/
	var res = str.replace(/"/g,'&quot;');
	res = res.replace(/'/g,'&apos;');
	res = res.replace(/</g,'&lt;');
	res = res.replace(/>/g,'&gt;');
	res = res.replace(/\(/g,'&lk;');
	res = res.replace(/\)/g,'&gk;');
	return res;
}/*}}}*/

// 判断浏览器类型
var BROWSER = {};
var USERAGENT = navigator.userAgent.toLowerCase();
browserVersion({'ie':'msie','firefox':'','chrome':'','opera':'','safari':'','mozilla':'','webkit':'','maxthon':'','qq':'qqbrowser','rv':'rv'});
if(BROWSER.safari || BROWSER.rv) {
    BROWSER.firefox = true;
}
BROWSER.opera = BROWSER.opera ? opera.version() : 0; 
HTMLNODE = document.getElementsByTagName('head')[0].parentNode;
if(BROWSER.ie) {
    BROWSER.iemode = parseInt(typeof document.documentMode != 'undefined' ? document.documentMode : BROWSER.ie);
    HTMLNODE.className = 'ie_all ie' + BROWSER.iemode;
}
function inIE() {return BROWSER.ie!=0;}
