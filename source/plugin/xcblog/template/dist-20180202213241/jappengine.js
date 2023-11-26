/*url伪地址路由映射, (c) 2016 mawentao */

/* 登录[系统模块], (c) 2016 mawentao */

/* jappengine.js, (c) 2016 mawentao */

define("core/ajax",["require"],function(e){var t={},r={},n=[];return r.getAjaxUrl=function(e){return e.startWith("http")?e:dz.ajaxapi+e},r.abortAll=function(){console.log("abort_all_ajax_requests");for(var e=0;e<n.length;++e){var t=n[e];t.abort()}n=[]},r.ajaxrequest=function(e,t,r,i,o){var a=jQuery.ajax({url:t,type:e,dataType:"json",data:r,async:!o,complete:function(e){},success:function(e){i(e)},error:function(t,r,n){var i="Error("+t.readyState+") : "+r;"abort"==r?console.log("abort ajax: "+e):alert(i)}});n.push(a)},r.post=function(e,t,n,i){var o=r.getAjaxUrl(e);r.ajaxrequest("post",o,t,n,i)},r.get=function(e,t,n,i,o){var a=r.getAjaxUrl(t);r.ajaxrequest("get",a,n,i,o)},r.loadcache=function(e,r,n){t[e]?r(t[e]):this.post(e,{},function(n){t[e]=n,r(n)},noanimation)},r.unsetcache=function(e){t[e]=null},r.clearcache=function(){t={}},r}),define("core/log",["require"],function(e){function t(e,t){var r="["+e+"] "+t;console.log(r)}var r={};return r.debug=function(e){conf.loglevel>=3&&t("DEBUG",e)},r.info=function(e){conf.loglevel>=2&&t("INFO",e)},r.warn=function(e){conf.loglevel>=1&&t("WARN",e)},r}),define("core/extmsg",["require"],function(e){var t={};return t.info=function(e,t){jQuery("#"+e).html('<div class="mwt-alert mwt-alert-info"><i class="fa fa-info-circle" style="font-size:16px;float:left;margin-top:2px;"></i><div style="display:inline-block;margin-left:10px;font-size:13px;">'+t+"</div></div>")},t.warning=function(e,t){jQuery("#"+e).html('<div class="mwt-wall mwt-wall-warning"><i class="fa fa-frown-o" style="font-size:16px;float:left;margin-top:2px;"></i><div style="display:inline-block;margin-left:10px;font-size:13px;">'+t+"</div></div>")},t.danger=function(e,t){jQuery("#"+e).html('<div class="mwt-wall mwt-wall-danger"><i class="icon icon-report" style="font-size:16px;float:left;margin-top:2px;"></i><div style="display:inline-block;margin-left:10px;font-size:13px;">'+t+"</div></div>")},t}),define("er/util",[],function(){var now=+new Date,util={};util.guid=function(){return"er"+now++},util.mix=function(e){for(var t=1;t<arguments.length;t++){var r=arguments[t];if(r)for(var n in r)r.hasOwnProperty(n)&&(e[n]=r[n])}return e};var nativeBind=Function.prototype.bind;util.bind=nativeBind?function(e){return nativeBind.apply(e,[].slice.call(arguments,1))}:function(e,t){var r=[].slice.call(arguments,2);return function(){var n=r.concat([].slice.call(arguments));return e.apply(t,n)}},util.noop=function(){};var dontEnumBug=!{toString:1}.propertyIsEnumerable("toString");util.inherits=function(e,t){var r=function(){};r.prototype=t.prototype;var n=new r,i=e.prototype;e.prototype=n;for(var o in i)n[o]=i[o];return dontEnumBug&&(i.hasOwnProperty("toString")&&(n.toString=i.toString),i.hasOwnProperty("valueOf")&&(n.valueOf=i.valueOf)),e.prototype.constructor=e,e},util.parseJSON=function(text){return text?window.JSON&&"function"==typeof JSON.parse?JSON.parse(text):eval("("+text+")"):void 0};var whitespace=/(^[\s\t\xa0\u3000]+)|([\u3000\xa0\s\t]+$)/g;return util.trim=function(e){return e.replace(whitespace,"")},util.encodeHTML=function(e){return e+="",e.replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#39;")},util.getElement=function(e){return"string"==typeof e&&(e=document.getElementById(e)),e},util}),define("er/Observable",["require","./util"],function(e){function t(){this._events={}}var r="_erObservableGUID";return t.prototype.on=function(t,n){this._events||(this._events={});var i=this._events[t];i||(i=this._events[t]=[]),n.hasOwnProperty(r)||(n[r]=e("./util").guid()),i.push(n)},t.prototype.un=function(e,t){if(this._events){if(!t)return void(this._events[e]=[]);var r=this._events[e];if(r)for(var n=0;n<r.length;n++)r[n]===t&&(r.splice(n,1),n--)}},t.prototype.fire=function(e,t){1===arguments.length&&"object"==typeof e&&(t=e,e=t.type);var n=this["on"+e];if("function"==typeof n&&n.call(this,t),this._events){null==t&&(t={}),"[object Object]"!==Object.prototype.toString.call(t)&&(t={data:t}),t.type=e,t.target=this;var i={},o=this._events[e];if(o){o=o.slice();for(var a=0;a<o.length;a++){var s=o[a];i.hasOwnProperty(s[r])||s.call(this,t)}}if("*"!==e){var l=this._events["*"];if(!l)return;l=l.slice();for(var a=0;a<l.length;a++){var s=l[a];i.hasOwnProperty(s[r])||s.call(this,t)}}}},t.enable=function(e){e._events={},e.on=t.prototype.on,e.un=t.prototype.un,e.fire=t.prototype.fire},t}),define("er/assert",[],function(){if(window.DEBUG){var e=function(e,t){if(!e)throw new Error(t)};return e.has=function(t,r){e(null!=t,r)},e.equals=function(t,r,n){e(t===r,n)},e.hasProperty=function(t,r,n){e(null!=t[r],n)},e.lessThan=function(t,r,n){e(r>t,n)},e.greaterThan=function(t,r,n){e(t>r,n)},e.lessThanOrEquals=function(t,r,n){e(r>=t,n)},e.greaterThanOrEquals=function(t,r,n){e(t>=r,n)},e}var e=function(){};return e.has=e,e.equals=e,e.hasProperty=e,e.lessThan=e,e.greaterThan=e,e.lessThanOrEquals=e,e.greaterThanOrEquals=e,e}),define("er/Deferred",["require","./util","./assert","./Observable"],function(e){function t(e){function t(){for(var t=0;t<r.length;t++){var n=r[t];n.apply(e.promise,e._args)}}if("pending"!==e.state){var r="resolved"===e.state?e._doneCallbacks.slice():e._failCallbacks.slice();e.syncModeEnabled?t():a(t),e._doneCallbacks=[],e._failCallbacks=[]}}function r(e,t,r,i){return function(){if("function"==typeof r){var o=t.resolver,a=r.apply(e.promise,arguments);n.isPromise(a)?a.then(o.resolve,o.reject):o.resolve(a)}else t[i].apply(t,e._args)}}function n(){this.state="pending",this._args=null,this._doneCallbacks=[],this._failCallbacks=[],this.promise={done:i.bind(this.done,this),fail:i.bind(this.fail,this),ensure:i.bind(this.ensure,this),then:i.bind(this.then,this)},this.promise.promise=this.promise,this.resolver={resolve:i.bind(this.resolve,this),reject:i.bind(this.reject,this)}}var i=e("./util"),o=e("./assert"),a="function"==typeof window.setImmediate?function(e){window.setImmediate(e)}:function(e){window.setTimeout(e,0)};return e("./Observable").enable(n),n.isPromise=function(e){return e&&"function"==typeof e.then},n.prototype.syncModeEnabled=!1,n.prototype.resolve=function(){"pending"===this.state&&(this.state="resolved",this._args=[].slice.call(arguments),n.fire("resolve",{deferred:this,args:this._args,reason:this._args[0]}),t(this))},n.prototype.reject=function(){"pending"===this.state&&(this.state="rejected",this._args=[].slice.call(arguments),n.fire("reject",{deferred:this,args:this._args,reason:this._args[0]}),t(this))},n.prototype.done=function(e){return this.then(e)},n.prototype.fail=function(e){return this.then(null,e)},n.prototype.ensure=function(e){return this.then(e,e)},n.prototype.then=function(e,i){var o=new n;return o.syncModeEnabled=this.syncModeEnabled,this._doneCallbacks.push(r(this,o,e,"resolve")),this._failCallbacks.push(r(this,o,i,"reject")),t(this),o.promise},n.all=function(){function e(e){a--,o.greaterThanOrEquals(a,0,"workingCount should be positive");var t=[].slice.call(arguments,1);t.length<=1&&(t=t[0]),l[e]=t,0===a&&c[s].apply(c,l)}function t(){s="reject",e.apply(this,arguments)}var r=[].concat.apply([],arguments),a=r.length;if(!a)return n.resolved();for(var s="resolve",l=[],c=new n,u=0;u<r.length;u++){var d=r[u];d.then(i.bind(e,d,u),i.bind(t,d,u))}return c.promise},n.resolved=function(){var e=new n;return e.resolve.apply(e,arguments),e.promise},n.rejected=function(){var e=new n;return e.reject.apply(e,arguments),e.promise},n.require=function(){var e=[].slice.call(arguments),t=new n;return window.require(e,t.resolver.resolve),t.promise.abort=t.resolver.reject,t.promise},n}),define("er/events",["require","./Observable"],function(e){var t={notifyError:function(e){return"string"==typeof e&&(e=new Error(e)),this.fire("error",{error:e}),e}};return e("./Observable").enable(t),t}),define("er/config",{mainElement:"main",indexURL:"/",systemName:"",noAuthorityLocation:"/401",notFoundLocation:"/404"}),define("er/locator",["require","./config","./events","./Observable"],function(e){function t(){var e=location.href.indexOf("#"),t=-1===e?"":location.href.slice(e);return t}function r(){var e=t();a.redirect(e)}function n(e){window.addEventListener?window.addEventListener("hashchange",r,!1):"onhashchange"in window&&document.documentMode>7?window.attachEvent("onhashchange",r):l=setInterval(r,100),e&&(c=setTimeout(r,0))}function i(){l&&(clearInterval(l),l=null),c&&(clearTimeout(c),c=null),window.removeEventListener?window.removeEventListener("hashchange",r,!1):"onhashchange"in window&&document.documentMode>7&&window.detachEvent("onhashchange",r)}function o(e,r){var o=s!==e;return o&&t()!==e&&(r.silent?(i(),location.hash=e,n(!1)):location.hash=e),s=e,o}var a={},s="",l=0,c=1;return a.start=function(){n(!0)},a.stop=i,a.resolveURL=function(t){return t+="",0===t.indexOf("#")&&(t=t.slice(1)),t&&"/"!==t||(t=e("./config").indexURL),t},a.redirect=function(t,r){r=r||{},t=a.resolveURL(t);var n=s,i=o(t,r);(i||r.force)&&(r.silent||a.fire("redirect",{url:t,referrer:n}),e("./events").fire("redirect",{url:t,referrer:n}))},a.reload=function(){s&&a.redirect(s,{force:!0})},e("./Observable").enable(a),a}),define("er/Action",["require","./util","./Observable","./Deferred","./events","./locator","./locator"],function(e){function t(){for(var e=[],t=0;t<arguments.length;t++){var r=arguments[t];r.success||e.push(r)}return this.handleError(e)}function r(){this.disposed=!1}var n=e("./util"),i=e("./Observable");return r.prototype.context=null,r.prototype.modelType=null,r.prototype.viewType=null,r.prototype.enter=function(r){this.context=r||{},this.fire("enter");var i=r&&r.url&&r.url.getQuery(),o=n.mix({},r,i);if(this.model=this.createModel(o),this.model&&"function"==typeof this.model.load){var a=this.model.load();return a.then(n.bind(this.forwardToView,this),n.bind(t,this))}return this.forwardToView(),e("./Deferred").resolved(this)},r.prototype.handleError=function(e){throw e},r.prototype.createModel=function(e){if(this.modelType){var t=new this.modelType(e);return t}return{}},r.prototype.forwardToView=function(){if(this.disposed)return this;if(this.fire("modelloaded"),this.view=this.createView(),this.view)this.view.model=this.model,this.view.container||(this.view.container=this.context.container),this.fire("beforerender"),this.view.render(),this.fire("rendered"),this.initBehavior(),this.fire("entercomplete");else{var t=e("./events");t.notifyError("No view attached to this action")}return this},r.prototype.createView=function(){return this.viewType?new this.viewType:null},r.prototype.initBehavior=function(){},r.prototype.leave=function(){this.disposed=!0,this.fire("beforeleave"),this.model&&("function"==typeof this.model.dispose&&this.model.dispose(),this.model=null),this.view&&("function"==typeof this.view.dispose&&this.view.dispose(),this.view=null),this.fire("leave")},r.prototype.redirect=function(t,r){var n=e("./locator");n.redirect(t,r)},r.prototype.reload=function(){var t=e("./locator");t.reload()},n.inherits(r,i),r}),define("frame/left_center_layout",["require"],function(e){function t(e){for(var t=e.controller,r=e.menu,n='<ul class="leftmenu" id="nav-'+t+'">',i=0;i<r.length;++i){var o=r[i],a=o.action?"#/"+t+"/"+o.action:"javascript:;",s=o.submenu&&o.submenu.length>0,l=s?'class="menu-open"':"",c=o.icon?o.icon:"fa fa-th-large",u=o.style?o.style:"",d=o.action?'id="navitem-'+t+"-"+o.action+'"':"";if(n+="<li "+l+" style='"+u+"'><a name='navitem' class='lm-menu' href='"+a+"' "+d+'><i class="'+c+'" style="padding-left:0;"></i>&nbsp;'+o.name+"</a>",s){n+="<ul class='submenu'>";for(var f=0;f<o.submenu.length;++f){var p=o.submenu[f],a=p.action?"#/"+t+"/"+p.action:"javascript:;",u=p.style?p.style:"";d=p.action?'id="navitem-'+t+"-"+p.action+'"':"",c=p.icon?p.icon:"fa fa-caret-right",n+="<li style='"+u+"'><a name='navitem' class='lm-item' href='"+a+"' "+d+'><i class="'+c+'" style="padding-left:0;"></i>&nbsp;'+p.name+"</a></li>"}n+="</ul>"}n+="</li>"}n+='<li class="clearfix"></li></ul>',jQuery("#frame-west").html(n),jQuery(".lm-menu").unbind("click").click(function(){var e=jQuery(this).parent().children(".submenu");if(e){var t=e.css("display");t&&("none"==t?(jQuery(this).parent().removeClass("menu-close"),jQuery(this).parent().addClass("menu-open")):(jQuery(this).parent().removeClass("menu-open"),jQuery(this).parent().addClass("menu-close")))}})}var r=new mwt.BorderLayout({render:"frame-body",items:[{id:"frame-west",region:"west",width:180,collapsible:!0,split:!0,html:""},{id:"frame-center",region:"center",style:"padding:5px 10px 20px;font-size:13px;",html:""}]}),n={};return n.init=function(e,n,i){r.init(),t(e),jQuery('[name="navitem"]').removeClass("active"),jQuery("#navitem-"+n+"-"+i).addClass("active")},n}),define("frame/main",["require","./left_center_layout"],function(e){var t,r={},n={};return n.init=function(){},n.addcontroller=function(e){r[e.controller]=e},n.active=function(n,i){if(t==n)return jQuery('[name="navitem"]').removeClass("active"),void jQuery("#navitem-"+n+"-"+i).addClass("active");if(jQuery("#frame-body").html(""),r[n]){var o=r[n];if(o.menu&&o.menu.length>0)e("./left_center_layout").init(o,n,i);else{var a='<div id="frame-center" style="left:0;"></div>';jQuery("#frame-body").html(a)}}},n.showpage=function(e){jQuery("#frame-center").html(e)},n.showloading=function(){var e='<span style="font-size:12px;color:#aaa"><i class="icon icon-loading fa fa-spin"></i> loading...</span>';n.showpage(e)},n}),define("frame",["frame/main"],function(e){return e}),define("core/eraction",["require","er/Action","frame"],function(e){var t=e("er/Action"),r=e("frame"),n=!1,i=new t;return i.on("enter",function(){var t=this.context.url,i=t.getPath(),o="index",a="index",s=i.split("/");s.length>1&&""!=s[1]&&(o=s[1]),s.length>2&&""!=s[2]&&(a=s[2]),n||(r.init(),n=!0,log.debug("init frame")),r.active(o,a);var l="controller/"+o;e([l],function(e){ajax.abortAll(),e[a+"Action"](t)})}),i}),define("er/permission",[],function(){var e={},t={add:function(t){for(var r in t)if(t.hasOwnProperty(r)){var n=t[r];"object"==typeof n?this.add(n):e[r]=n}},isAllow:function(t){return!!e[t]}};return t}),define("er/URL",["require","./util"],function(e){function t(e,n,i){e=e||"/",n=n||"",i=i||"~",this.toString=function(){return n?e+i+n:e},this.getPath=function(){return e},this.getSearch=function(){return n};var o=null;this.getQuery=function(e){return o||(o=t.parseQuery(n)),e?o[e]:r.mix({},o)}}var r=e("./util");return t.parse=function(e,n){var i={querySeparator:"~"};n=r.mix(i,n);var o=e.indexOf(n.querySeparator);return o>=0?new t(e.slice(0,o),e.slice(o+1),n.querySeparator):new t(e,"",n.querySeparator)},t.withQuery=function(e,n,i){e+="";var o={querySeparator:"~"};i=r.mix(o,i);var a=e.indexOf(i.querySeparator)<0?i.querySeparator:"&",s=t.serialize(n),l=e+a+s;return t.parse(l,i)},t.parseQuery=function(e){for(var t=e.split("&"),r={},n=0;n<t.length;n++){var i=t[n];if(i){var o=i.indexOf("="),a=0>o?decodeURIComponent(i):decodeURIComponent(i.slice(0,o)),s=0>o?!0:decodeURIComponent(i.slice(o+1));r.hasOwnProperty(a)?s!==!0&&(r[a]=[].concat(r[a],s)):r[a]=s}}return r},t.serialize=function(e){if(!e)return"";var t="";for(var r in e)if(e.hasOwnProperty(r)){var n=e[r];t+="&"+encodeURIComponent(r)+"="+encodeURIComponent(n)}return t.slice(1)},t.empty=new t,t}),define("er/router",["require","./URL","./events","./locator"],function(e){function t(t){for(var i=e("./URL").parse(t.url),o=i.getPath(),a=0;a<r.length;a++){var s=r[a];if(s.rule instanceof RegExp&&s.rule.test(o)||s.rule===o)return void s.handler.call(null,i)}n&&n.call(null,i),e("./events").fire("route",{url:i})}var r=[],n=null,i={add:function(e,t){r.push({rule:e,handler:t})},setBackup:function(e){n=e},start:function(){e("./locator").on("redirect",t)}};return i}),define("er/controller",["require","./permission","./Observable","./locator","./Deferred","./URL","./config","./events","./util","./assert","./router","./assert","./URL"],function(e){function t(t){if(!t)return!0;"string"==typeof t&&(t=t.split("|"));for(var r=e("./permission"),n=0;n<t.length;n++)if(r.isAllow(t[n]))return!0;return!1}function r(e){var n=e.url.getPath(),i=d[n];if(i&&i.movedTo){g.fire("actionmoved",{url:e.url,config:i,movedTo:i.movedTo});var o=h.parse(i.movedTo);return e.originalURL=e.url,e.url=o,r(e)}if(i&&i.childActionOnly&&!e.isChildAction&&(i=null),!i)return g.fire("actionnotfound",y.mix({failType:"NotFound",reason:"Not found"},e)),e.originalURL=e.url,e.url=h.parse(m.notFoundLocation),d[e.url.getPath()]?r(e):null;var a=t(i.authority);if(!a){g.fire("permissiondenied",y.mix({failType:"PermissionDenied",reason:"Permission denied",config:i},e));var s=i.noAuthorityLocation||m.noAuthorityLocation;return e.originalURL=e.url,e.url=h.parse(s),r(e)}return i}function n(e){var t=r(e);if("function"==typeof w.resolveActionConfig&&(t=w.resolveActionConfig(t,e)),!t){var n=new v;return n.syncModeEnabled=!1,n.reject("no action configured for url "+e.url.getPath()),n.promise}if(e.title=t.title,t.args)for(var i in t.args)t.args.hasOwnProperty(i)&&!e.hasOwnProperty(i)&&(e[i]=t.args[i]);var o=new v;o.syncModeEnabled=!1;var a=o.promise,s=!1;return a.abort=function(){s||(s=!0,g.fire("actionabort",y.mix({},e)))},e.isChildAction||(f=e.url),window.require([t.type],function(r){if(!s){if(!r){var n="No action implement for "+acrtionConfig.type,i=y.mix({failType:"NoModule",config:t,reason:n},e);return g.fire("actionfail",i),g.notifyError(i),void o.reject(n)}if("function"==typeof r)return void o.resolve(new r,e);var a=r;if("function"==typeof a.createRuntimeAction&&(a=a.createRuntimeAction(e),!a)){var n="Action factory returns non-action",i=y.mix({failType:"InvalidFactory",config:t,reason:n,action:a},e);return g.fire("actionfail",i),g.notifyError(i),void o.reject(n)}g.fire("actionloaded",{url:e.url,config:t,action:r}),o.resolve(a,e)}}),a}function i(e,t){if(!t.isChildAction){if(t.url!==f)return;p&&(g.fire("leaveaction",{action:p,to:y.mix({},t)}),"function"==typeof p.leave&&p.leave()),p=e,document.title=t.title||t.documentTitle||m.systemName}g.fire("enteraction",y.mix({action:e},t));var r=e.enter(t);return r.then(function(){g.fire("enteractioncomplete",y.mix({action:e},t))},function(e){var r="";e?e.message?(r=e.message,e.stack&&(r+="\n"+e.stack)):r=window.JSON&&"function"==typeof JSON.stringify?JSON.stringify(e):e:r="Invoke action.enter() causes error";var n=y.mix({failType:"EnterFail",reason:r},t);g.fire("enteractionfail",n),g.notifyError(n)}),r}function o(e,t,r,i){var o={url:e,container:t,isChildAction:!!i};if(i){var a=x[t];o.referrer=a?a.url:null}else o.referrer=f;y.mix(o,r);var s=n(o);return b.has(s,"loadAction should always return a Promise"),s}function a(e){"string"==typeof e&&(e=h.parse(e)),u&&"function"==typeof u.abort&&u.abort(),u=o(e,m.mainElement,null,!1),u.then(i).fail(y.bind(g.notifyError,g))}function s(e,t){var r=x[e.id];r&&(x[e.id]=void 0,r.action&&(t||(t={url:null,referrer:r.url,container:e.id,isChildAction:!0}),g.fire("leaveaction",{action:r.action,to:t}),"function"==typeof r.action.leave&&r.action.leave()))}function l(t,r,n,i){s(t,i);var o={url:i.url,action:r,hijack:n};x[t.id]=o;var a=e("./Observable");r instanceof a&&r.on("leave",function(){s(t)})}function c(t,r){function n(t,n,i){n=n||{};var o=e("./locator"),t=o.resolveURL(t,n);if(n.global){var a=document.getElementById(r.container);return a&&s(a),void o.redirect(t,n)}var l=x[r.container],c=t.toString()!==l.url.toString();(c||n.force)&&(n.silent?l.url=t:w.renderChildAction(t,r.container,i))}function o(e){e=e||window.event;var t=e.target||e.srcElement;if("a"===t.nodeName.toLowerCase()){var r=t.getAttribute("href",2)||"";if("#"===r.charAt(0)){e.preventDefault?e.preventDefault():e.returnValue=!1;var i=r.substring(1),o="global"===t.getAttribute("data-redirect");n(i,{global:o})}}}j[r.container]=null;var a=document.getElementById(r.container);return a?(t.redirect=n,t.reload=function(e){this.redirect(r.url,{force:!0},e)},l(a,t,o,r),i(t,r)):void 0}var u,d={},f=null,p=null,v=e("./Deferred"),h=e("./URL"),m=e("./config"),g=e("./events"),y=e("./util"),b=e("./assert"),w={registerAction:function(e){b.hasProperty(e,"path",'action config should contains a "path" property'),d[e.path]=e},start:function(){m.systemName||(m.systemName=document.title),e("./router").setBackup(a)},resolveActionConfig:function(e){return e}},x={};w.renderAction=a;var j={};return w.renderChildAction=function(t,r,n){var i=e("./assert");i.has(r),"string"==typeof t&&(t=e("./URL").parse(t));var a=j[r];a&&"function"==typeof a.abort&&a.abort();var s=o(t,r,n,!0),l=s.then(c,y.bind(g.notifyError,g));return l.abort=s.abort,j[r]=l,l},w}),define("er/main",["require","./controller","./router","./locator"],function(e){var t={version:"3.0.3",start:function(){e("./controller").start(),e("./router").start(),e("./locator").start()}};return t}),define("er",["er/main"],function(e){return e}),define("core/urlmap",["require","er/main","er/controller"],function(e){var t={},r={};return r.start=function(){e("er/main").start(),this.addmap("/index/index")},r.addmap=function(r){var n=r.lastIndexOf("~");n>=0&&(r=r.substr(0,n));var i=[],o="index",a="index",s=r.split("/");s.length>1&&""!=s[1]&&(o=s[1]),s.length>2&&""!=s[2]&&(a=s[2]),i.push("/"),i.push("/"+o),i.push("/"+o+"/"+a);for(var l=0;l<i.length;++l){var c=i[l];if(!t[c]){var u={path:c,type:"core/eraction"};e("er/controller").registerAction(u),t[c]=!0,log.debug("map url path [#"+c+"] to javascript /controller/"+o+".js#"+a+"Action")}}},r}),define("controller/index",["require","frame"],function(e){function t(e,t){var n={uid:profile.uid,page:t};ajax.post("blog&action=paperlist",n,function(t){0!=t.retcode?mwt.notify(t.retmsg,1500,"danger"):r(e,t.data)})}function r(e,r){if(0==r.root.length){var i='<div class="wall" style="font-size:13px;color:gray;">博主尚未发表过文章</div>';return void jQuery("#"+e).html(i)}for(var o=[],a=0;a<r.root.length;++a){var i=n(r.root[a]);o.push(i)}if(r.nextpage!=r.page){var i='<div id="paperlisdiv-'+r.nextpage+'"><a name="npbtn" class="nextpage" href="javascript:;" data-page="'+r.nextpage+'">下一页 »</a></div>';o.push(i)}jQuery("#"+e).html(o.join("")),jQuery("[name=npbtn]").unbind("click").click(function(){var e=jQuery(this).data("page");t("paperlisdiv-"+e,e)})}function n(e){var t="#/paper~tid="+e.tid,r='<div class="wall list-paper"><a class="title" href="'+t+'">'+e.subject+'</a><span class="subtitle"><i class="sicon-calendar"></i> '+date("Y年m月d日",e.dateline)+'</span><div class="content">'+e.summary+'</div><div class="mwt-row-flex"><div class="mwt-col-wd subtitle" style="width:200px"><i class="sicon-folder-alt"></i> '+e.catename+'</div><div class="mwt-col-fill" style="text-align:right;"><span class="subtitle"><i class="sicon-eye"></i> '+e.views+'</span><span class="subtitle"><i class="icon icon-comment"></i> '+e.replies+"</span></div></div></div>";return r}var i=(e("frame"),{}),o="index";return i.conf={controller:o,path:["/"+o+"/index"]},i.indexAction=function(){scroll(0,0),t("frame-body",1)},i}),define("controller/paper",["require","frame"],function(e){function t(e){var t='<div class="wall" style="font-size:13px;color:#999;">'+e+"</div>";n.showpage(t)}function r(e){var t=e.thread,r=(e.postlist,e.postlist[0]),i=dz.siteurl+"forum.php?mod=post&action=edit&fid="+t.fid+"&tid="+t.tid+"&pid="+r.pid,o='<a class="aedit" href="'+i+'" style="float:right;"><i class="sicon-pencil"></i> 编辑</a>',a='<div class="wall paper"><h1>'+t.subject+'</h1><div><span class="subtitle"><i class="sicon-calendar"></i> '+date("Y年m月d日",e.dateline)+'</span><span class="subtitle"><i class="sicon-user"></i> '+t.author+"</span>"+(profile.uid==dz.uid?o:"")+'</div><div class="content">'+e.postlist[0].message+'</div><div class="mwt-row-flex"><div class="mwt-col-fill" style="text-align:right;"><span class="subtitle"><i class="sicon-eye"></i> '+t.views+'</span><span class="subtitle"><i class="icon icon-comment"></i> '+t.replies+"</span></div></div></div>";n.showpage(a)}var n=e("frame"),i={},o="paper";return i.conf={controller:o,path:["/"+o+"/index"]},i.indexAction=function(e){scroll(0,0);var n=e.getQuery(),i=n.tid?n.tid:0;ajax.post(dz.siteurl+"api/mobile/index.php?version=4&module=viewthread&tid="+i+"&page=1",{},function(e){"mobile_is_closed"==e.error?t("站点未开启手机版访问，请联系站长"):e.Message&&""!=e.Message.messagestr?t(e.Message.messagestr):r(e.Variables)})},i}),define("view/sogrid",["require"],function(e){function t(){if(jQuery("#title-"+i).html(r.annex),0==r.root.length){var e='<p style="font-size:13px;padding:20px 0 60px;color:gray;text-align:center;">未找到相关文章</p>';return void jQuery("#body-"+i).html(e)}for(var t=[],n=0;n<r.root.length;++n){var o=r.root[n],a="#/paper~tid="+o.tid,e='<li><a class="title" href="'+a+'" target="_blank"><i class="sicon-doc"></i> '+o.subject+'</a><span class="time">'+date("Y-m-d",o.dateline)+"</span></li>";t.push(e)}var e='<ul class="soul">'+t.join("")+"</ul>";jQuery("#body-"+i).html(e)}var r,n,i,o={};return o.init=function(e,o){i=e;var a='<h1 id="title-'+e+'"></h1><div id="body-'+e+'"></div><div id="pagebar-'+e+'"></div>';jQuery("#"+e).html(a),r=new mwt.Store({proxy:new mwt.HttpProxy({url:ajax.getAjaxUrl("blog&action=so")})}),r.baseParams=o,r.on("load",function(e){t()}),n=new MWT.PageBar({render:"pagebar-"+e,store:r,pageSize:setting.list_paper_num,pageStyle:2}),n.changePage(1)},o}),define("controller/s",["require","frame","view/sogrid"],function(e){var t=e("frame"),r="s",n={};return n.conf={controller:r,path:["/"+r+"/index"]},n.indexAction=function(r){var n='<div class="wall" id="sodiv" style="min-height:300px;padding:20px 30px;"></div>';t.showpage(n),scroll(0,0);var i=r.getQuery(),o={uid:profile.uid,cateid:i.cateid?i.cateid:0,key:i.key?i.key.trim():"",archive:i.archive?i.archive:""};e("view/sogrid").init("sodiv",o)},n}),define("common/profile",["require"],function(e){var t={};return t.get_gender=function(){var e={1:"男",2:"女"};return e[profile.gender]?e[profile.gender]:"保密"},t.get_age=function(){if(0==profile.birthyear)return"保密";var e=date("Y"),t=profile.birthyear,r=parseInt(e)-parseInt(t);return r+"岁"},t.get_email=function(){return'<a href="mailto:'+profile.email+'">'+profile.email+"</a>"},t.getkey=function(e){return""==profile[e]?"保密":profile[e]},t.get_address=function(){if(""==profile.resideprovince)return"保密";var e=[profile.resideprovince];return""!=profile.residecity&&e.push(profile.residecity),""!=profile.residedist&&e.push(profile.residedist),e.join("")},t.init=function(){},t}),define("controller/resume",["require","frame","common/profile"],function(e){function t(e){for(var t=[["self_introduction","关于我"],["exp_education","教育经历"],["exp_job","工作经历"],["exp_project","项目经历"]],l=[],c=0;c<t.length;++c){var u=t[c][0],d=t[c][1];if(e[u]&&e[u].length>0){var f='<div class="area"><div class="title">'+d+'</div><div class="body" id="resume-'+u+'"></div></div>';l.push(f)}}var f='<div style="padding:10px;" class="resume"><div id="resume-base"></div>'+l.join("")+"</div>";s.showpage(f),r("resume-base");for(var c=0;c<t.length;++c){var u=t[c][0];if(e[u]&&e[u].length>0)switch(u){case"self_introduction":n("resume-"+u,e);break;case"exp_education":i("resume-"+u,e);break;case"exp_job":o("resume-"+u,e);break;case"exp_project":a("resume-"+u,e[u])}}}function r(e){var t=[l.get_gender(),l.get_age(),l.getkey("education"),"现居"+l.get_address()],r='<table><tr><td valign="top" width="150"><div class="resume-avatar"><img src="'+profile.avatar+'"></div></td><td valign="top"><p class="resume-name">'+profile.realname+'</p><p class="resume-sub">'+t.join("&nbsp;&nbsp;")+'</p><p class="resume-sub2">邮箱:&nbsp;&nbsp;'+l.getkey("email")+'</p><p class="resume-sub2">手机:&nbsp;&nbsp;'+l.getkey("mobile")+"</p></td></tr></table>";jQuery("#"+e).html(r)}function n(e,t){for(var r=[],n=0;n<t.self_introduction.length;++n){var i=t.self_introduction[n];r.push("<li>"+i+"</li>")}var o="<ul class='about-ul'>"+r.join("")+"</ul>";jQuery("#"+e).html(o)}function i(e,t){for(var r=[],n=0;n<t.exp_education.length;++n){var i=t.exp_education[n],o='<li><div class="exp-title"><i class="sicon-graduation"></i> '+i.school+'</div><div class="exp-time">'+i.period+'</div><div class="exp-desc">'+i.desc+"</div></li>";r.push(o)}var o="<ul class='expul'>"+r.join("")+"</ul>";jQuery("#"+e).html(o)}function o(e,t){for(var r=[],n=0;n<t.exp_job.length;++n){var i=t.exp_job[n],o='<li><div class="exp-title"><i class="icon icon-job"></i> '+i.company+'</div><div class="exp-sub">'+i.title+'</div><div class="exp-time">'+i.period+'</div><div class="exp-desc">'+i.desc+"</div></li>";r.push(o)}var o="<ul class='expul'>"+r.join("")+"</ul>";jQuery("#"+e).html(o)}function a(e,t){for(var r=[],n=0;n<t.length;++n){var i=t[n],o='<li><div class="exp-title"><i class="sicon-direction"></i> '+i.name+'</div><div class="exp-sub">'+i.role+'</div><div class="exp-time">'+i.period+'</div><div class="exp-desc">'+i.desc+"</div></li>";r.push(o)}var o="<ul class='expul'>"+r.join("")+"</ul>";jQuery("#"+e).html(o)}var s=e("frame"),l=e("common/profile"),c={},u="resume";return c.conf={controller:u,path:["/"+u+"/index"]},c.indexAction=function(){scroll(0,0),ajax.post("blog&action=resume",{uid:profile.uid},function(e){if(0!=e.retcode){var r=e.retmsg;s.showpage(r)}else t(e.data)})},c}),define("controller/login",["require","frame"],function(e){function t(){a=new MWT.Form,a.addField("username",new MWT.TextField({render:"username-div",type:"text",style:"width:91%;padding:5px;border-radius:4px;",value:"",empty:!1,errmsg:"请输入用户名",placeholder:"用户名",checkfun:function(e){return e.length<=50}})),a.addField("userpass",new MWT.TextField({render:"userpass-div",type:"password",style:"width:91%;padding:5px;border-radius:4px;",value:"",empty:!1,errmsg:"请输入密码",placeholder:"密码",checkfun:function(e){return e.length<=50}})),a.addField("seccode",new MWT.TextField({render:"seccode-div",type:"text",style:"width:150px;padding:5px;border-radius:4px;",value:"",empty:!1,errmsg:"请输入验证码",placeholder:"验证码",checkfun:function(e){return e.length>0}})),a.create(),jQuery("#logbtn").click(r),jQuery("input").keyup(function(e){return"13"==e.keyCode?(document.getElementById("logbtn").click(),!1):void 0}),jQuery("#scodebtn").click(function(){jQuery(this).attr("src",dz.seccodeurl+"&tm="+time())})}function r(){jQuery("#errmsgdiv").html("");var e=a.getData();e.username=mwt.get_text_value("username-divtxt"),e.userpass=mwt.get_text_value("userpass-divtxt"),jQuery("#logbtn").unbind("click").html("登录中..."),ajax.post("uc&action=login",e,function(e){jQuery("#logbtn").html("登 录").click(r),0!=e.retcode?jQuery("#errmsgdiv").html(e.retmsg):window.location.reload()})}var n=e("frame"),i="login",o={};o.conf={controller:"login",path:["/"+i+"/index"]},o.indexAction=function(){if(dz.uid>0)return void(window.location="#/");var e='<div class="mwt-dialog" style="display:block;top:50px;"><div id="dg-WdiU4d-modal" class="modaldiv" style="display: block;"></div><div class="dialog-body flipInX" style="top:50px; width:400px; display:inline-block;"><div class="dialog-head"><span>用户登录</span></div><div class="content" style="padding:10px 15px 20px;"><div style="width:80%;font-size:13px;padding:0 0 10px 60px;color:red;" id="errmsgdiv"></div><table class="tablay" style="margin:0;font-size:13px;"><tr height="45"><td width="100">用户名：</td><td colspan="2"><div id="username-div"></div></td></tr><tr height="45"><td>密码：</td><td colspan="2"><div id="userpass-div"></div></td></tr><tr height="45"><td>验证码：</td><td width="200"><div id="seccode-div"></div></td><td><img src="'+dz.seccodeurl+'" id="scodebtn"style="width:120px;height:40px;border-radius:2px;cursor:pointer;"></td></tr><tr height="45"><td></td><td colspan="2"><button id="logbtn" class="mwt-btn mwt-btn-primary radius" style="width:100%;">登 录</button></td></tr></table></div></div></div>';n.showpage(e),t()},o.check=function(){if(0==dz.uid)throw window.location="#/login",new Error("未登录")};var a;return o}),define("common/side",["require","./profile"],function(e){function t(e,t){for(var r=[],n=0;n<t.length;++n){var i=t[n],o='<li><a href="#/paper~tid='+i.tid+'">'+i.subject+"</a></li>";r.push(o)}jQuery("#"+e).html('<ul class="sideul">'+r.join("")+"</ul>")}function r(e,t){for(var r=[],n=0;n<t.length;++n){var i=t[n],o='<li><a href="#/s~cateid='+i.cateid+'">'+i.catename+" ("+i.stat+")</a></li>";
r.push(o)}jQuery("#"+e).html('<ul class="sideul">'+r.join("")+"</ul>")}function n(e,t){for(var r=[],n=0;n<t.length;++n){var i=t[n],o='<li><a href="#/s~archive='+i.time+'">'+i.time+" ("+i.stat+")</a></li>";r.push(o)}jQuery("#"+e).html('<ul class="sideul">'+r.join("")+"</ul>")}var i={};return i.init=function(){e("./profile").init(),ajax.post("blog&action=side",{uid:profile.uid},function(e){0!=e.retcode?extmsg.danger("panel-newpapers",e.retmsg):(t("panel-newpapers",e.data.newpapers),r("panel-categories",e.data.catelist),n("panel-archives",e.data.archives))},!0)},i});var ajax,log,extmsg;define("jappengine",["require","core/ajax","core/log","core/extmsg","core/eraction","core/urlmap","controller/index","controller/paper","controller/s","controller/resume","controller/login","common/side","frame"],function(e){ajax=e("core/ajax"),log=e("core/log"),extmsg=e("core/extmsg"),e("core/eraction");var t=e("core/urlmap"),r=[e("controller/index").conf,e("controller/paper").conf,e("controller/s").conf,e("controller/resume").conf,e("controller/login").conf],n={};return n.start=function(){e("common/side").init(),t.start();for(var n=0;n<r.length;++n){var i=r[n];if(i.controller&&t.addmap("/"+i.controller+"/index"),i.path&&i.path.length>0)for(var o=0;o<i.path.length;++o)t.addmap(i.path[o]);e("frame").addcontroller(i)}},n});