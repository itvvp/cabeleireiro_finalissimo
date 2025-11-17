/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Modern Admin - Clean Bootstrap 4 Dashboard HTML Template
  Author: Pixinvent
  Author URL: hhttp://www.themeforest.net/user/pixinvent
==========================================================================================*/
/*!
 * jQuery blockUI plugin
 * Version 2.70.0-2014.11.23
 * Requires jQuery v1.7 or later
 *
 * Examples at: http://malsup.com/jquery/block/
 * Copyright (c) 2007-2013 M. Alsup
 * Dual licensed under the MIT and GPL licenses:
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.gnu.org/licenses/gpl.html
 *
 * Thanks to Amir-Hossein Sobhi for some excellent contributions!
 */

!function(){"use strict";function e(e){function t(t,n){var s,h,k=t==window,y=n&&void 0!==n.message?n.message:void 0;if(n=e.extend({},e.blockUI.defaults,n||{}),!n.ignoreIfBlocked||!e(t).data("blockUI.isBlocked")){if(n.overlayCSS=e.extend({},e.blockUI.defaults.overlayCSS,n.overlayCSS||{}),s=e.extend({},e.blockUI.defaults.css,n.css||{}),n.onOverlayClick&&(n.overlayCSS.cursor="pointer"),h=e.extend({},e.blockUI.defaults.themedCSS,n.themedCSS||{}),y=void 0===y?n.message:y,k&&p&&o(window,{fadeOut:0}),y&&"string"!=typeof y&&(y.parentNode||y.jquery)){var m=y.jquery?y[0]:y,v={};e(t).data("blockUI.history",v),v.el=m,v.parent=m.parentNode,v.display=m.style.display,v.position=m.style.position,v.parent&&v.parent.removeChild(m)}e(t).data("blockUI.onUnblock",n.onUnblock);var g,I,w,U,x=n.baseZ;g=e(r||n.forceIframe?'<iframe class="blockUI" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;position:absolute;width:100%;height:100%;top:0;left:0" src="'+n.iframeSrc+'"></iframe>':'<div class="blockUI" style="display:none"></div>'),I=e(n.theme?'<div class="blockUI blockOverlay ui-widget-overlay" style="z-index:'+x++ +';display:none"></div>':'<div class="blockUI blockOverlay" style="z-index:'+x++ +';display:none;border:none;margin:0;padding:0;width:100%;height:100%;top:0;left:0"></div>'),n.theme&&k?(U='<div class="blockUI '+n.blockMsgClass+' blockPage ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:fixed">',n.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(n.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):n.theme?(U='<div class="blockUI '+n.blockMsgClass+' blockElement ui-dialog ui-widget ui-corner-all" style="z-index:'+(x+10)+';display:none;position:absolute">',n.title&&(U+='<div class="ui-widget-header ui-dialog-titlebar ui-corner-all blockTitle">'+(n.title||"&nbsp;")+"</div>"),U+='<div class="ui-widget-content ui-dialog-content"></div>',U+="</div>"):U=k?'<div class="blockUI '+n.blockMsgClass+' blockPage" style="z-index:'+(x+10)+';display:none;position:fixed"></div>':'<div class="blockUI '+n.blockMsgClass+' blockElement" style="z-index:'+(x+10)+';display:none;position:absolute"></div>',w=e(U),y&&(n.theme?(w.css(h),w.addClass("ui-widget-content")):w.css(s)),n.theme||I.css(n.overlayCSS),I.css("position",k?"fixed":"absolute"),(r||n.forceIframe)&&g.css("opacity",0);var C=[g,I,w],S=e(k?"body":t);e.each(C,function(){this.appendTo(S)}),n.theme&&n.draggable&&e.fn.draggable&&w.draggable({handle:".ui-dialog-titlebar",cancel:"li"});var O=f&&(!e.support.boxModel||e("object,embed",k?null:t).length>0);if(u||O){if(k&&n.allowBodyStretch&&e.support.boxModel&&e("html,body").css("height","100%"),(u||!e.support.boxModel)&&!k)var E=d(t,"borderTopWidth"),T=d(t,"borderLeftWidth"),M=E?"(0 - "+E+")":0,B=T?"(0 - "+T+")":0;e.each(C,function(e,t){var o=t[0].style;if(o.position="absolute",2>e)k?o.setExpression("height","Math.max(document.body.scrollHeight, document.body.offsetHeight) - (jQuery.support.boxModel?0:"+n.quirksmodeOffsetHack+') + "px"'):o.setExpression("height",'this.parentNode.offsetHeight + "px"'),k?o.setExpression("width",'jQuery.support.boxModel && document.documentElement.clientWidth || document.body.clientWidth + "px"'):o.setExpression("width",'this.parentNode.offsetWidth + "px"'),B&&o.setExpression("left",B),M&&o.setExpression("top",M);else if(n.centerY)k&&o.setExpression("top",'(document.documentElement.clientHeight || document.body.clientHeight) / 2 - (this.offsetHeight / 2) + (blah = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "px"'),o.marginTop=0;else if(!n.centerY&&k){var i=n.css&&n.css.top?parseInt(n.css.top,10):0,s="((document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop) + "+i+') + "px"';o.setExpression("top",s)}})}if(y&&(n.theme?w.find(".ui-widget-content").append(y):w.append(y),(y.jquery||y.nodeType)&&e(y).show()),(r||n.forceIframe)&&n.showOverlay&&g.show(),n.fadeIn){var j=n.onBlock?n.onBlock:c,H=n.showOverlay&&!y?j:c,z=y?j:c;n.showOverlay&&I._fadeIn(n.fadeIn,H),y&&w._fadeIn(n.fadeIn,z)}else n.showOverlay&&I.show(),y&&w.show(),n.onBlock&&n.onBlock.bind(w)();if(i(1,t,n),k?(p=w[0],b=e(n.focusableElements,p),n.focusInput&&setTimeout(l,20)):a(w[0],n.centerX,n.centerY),n.timeout){var W=setTimeout(function(){k?e.unblockUI(n):e(t).unblock(n)},n.timeout);e(t).data("blockUI.timeout",W)}}}function o(t,o){var s,l=t==window,a=e(t),d=a.data("blockUI.history"),c=a.data("blockUI.timeout");c&&(clearTimeout(c),a.removeData("blockUI.timeout")),o=e.extend({},e.blockUI.defaults,o||{}),i(0,t,o),null===o.onUnblock&&(o.onUnblock=a.data("blockUI.onUnblock"),a.removeData("blockUI.onUnblock"));var r;r=l?e("body").children().filter(".blockUI").add("body > .blockUI"):a.find(">.blockUI"),o.cursorReset&&(r.length>1&&(r[1].style.cursor=o.cursorReset),r.length>2&&(r[2].style.cursor=o.cursorReset)),l&&(p=b=null),o.fadeOut?(s=r.length,r.stop().fadeOut(o.fadeOut,function(){0===--s&&n(r,d,o,t)})):n(r,d,o,t)}function n(t,o,n,i){var s=e(i);if(!s.data("blockUI.isBlocked")){t.each(function(e,t){this.parentNode&&this.parentNode.removeChild(this)}),o&&o.el&&(o.el.style.display=o.display,o.el.style.position=o.position,o.el.style.cursor="default",o.parent&&o.parent.appendChild(o.el),s.removeData("blockUI.history")),s.data("blockUI.static")&&s.css("position","static"),"function"==typeof n.onUnblock&&n.onUnblock(i,n);var l=e(document.body),a=l.width(),d=l[0].style.width;l.width(a-1).width(a),l[0].style.width=d}}function i(t,o,n){var i=o==window,l=e(o);if((t||(!i||p)&&(i||l.data("blockUI.isBlocked")))&&(l.data("blockUI.isBlocked",t),i&&n.bindEvents&&(!t||n.showOverlay))){var a="mousedown mouseup keydown keypress keyup touchstart touchend touchmove";t?e(document).bind(a,n,s):e(document).unbind(a,s)}}function s(t){if("keydown"===t.type&&t.keyCode&&9==t.keyCode&&p&&t.data.constrainTabKey){var o=b,n=!t.shiftKey&&t.target===o[o.length-1],i=t.shiftKey&&t.target===o[0];if(n||i)return setTimeout(function(){l(i)},10),!1}var s=t.data,a=e(t.target);return a.hasClass("blockOverlay")&&s.onOverlayClick&&s.onOverlayClick(t),a.parents("div."+s.blockMsgClass).length>0?!0:0===a.parents().children().filter("div.blockUI").length}function l(e){if(b){var t=b[e===!0?b.length-1:0];t&&t.focus()}}function a(e,t,o){var n=e.parentNode,i=e.style,s=(n.offsetWidth-e.offsetWidth)/2-d(n,"borderLeftWidth"),l=(n.offsetHeight-e.offsetHeight)/2-d(n,"borderTopWidth");t&&(i.left=s>0?s+"px":"0"),o&&(i.top=l>0?l+"px":"0")}function d(t,o){return parseInt(e.css(t,o),10)||0}e.fn._fadeIn=e.fn.fadeIn;var c=e.noop||function(){},r=/MSIE/.test(navigator.userAgent),u=/MSIE 6.0/.test(navigator.userAgent)&&!/MSIE 8.0/.test(navigator.userAgent),f=(document.documentMode||0,e.isFunction(document.createElement("div").style.setExpression));e.blockUI=function(e){t(window,e)},e.unblockUI=function(e){o(window,e)},e.growlUI=function(t,o,n,i){var s=e('<div class="growlUI"></div>');t&&s.append("<h1>"+t+"</h1>"),o&&s.append("<h2>"+o+"</h2>"),void 0===n&&(n=3e3);var l=function(t){t=t||{},e.blockUI({message:s,fadeIn:"undefined"!=typeof t.fadeIn?t.fadeIn:700,fadeOut:"undefined"!=typeof t.fadeOut?t.fadeOut:1e3,timeout:"undefined"!=typeof t.timeout?t.timeout:n,centerY:!1,showOverlay:!1,onUnblock:i,css:e.blockUI.defaults.growlCSS})};l();s.css("opacity");s.mouseover(function(){l({fadeIn:0,timeout:3e4});var t=e(".blockMsg");t.stop(),t.fadeTo(300,1)}).mouseout(function(){e(".blockMsg").fadeOut(1e3)})},e.fn.block=function(o){if(this[0]===window)return e.blockUI(o),this;var n=e.extend({},e.blockUI.defaults,o||{});return this.each(function(){var t=e(this);n.ignoreIfBlocked&&t.data("blockUI.isBlocked")||t.unblock({fadeOut:0})}),this.each(function(){"static"==e.css(this,"position")&&(this.style.position="relative",e(this).data("blockUI.static",!0)),this.style.zoom=1,t(this,o)})},e.fn.unblock=function(t){return this[0]===window?(e.unblockUI(t),this):this.each(function(){o(this,t)})},e.blockUI.version=2.7,e.blockUI.defaults={message:"<h1>Please wait...</h1>",title:null,draggable:!0,theme:!1,css:{padding:0,margin:0,width:"30%",top:"40%",left:"35%",textAlign:"center",color:"#000",border:"3px solid #aaa",backgroundColor:"#fff",cursor:"wait"},themedCSS:{width:"30%",top:"40%",left:"35%"},overlayCSS:{backgroundColor:"#000",opacity:.6,cursor:"wait"},cursorReset:"default",growlCSS:{width:"350px",top:"10px",left:"",right:"10px",border:"none",padding:"5px",opacity:.6,cursor:"default",color:"#fff",backgroundColor:"#000","-webkit-border-radius":"10px","-moz-border-radius":"10px","border-radius":"10px"},iframeSrc:/^https/i.test(window.location.href||"")?"javascript:false":"about:blank",forceIframe:!1,baseZ:1e3,centerX:!0,centerY:!0,allowBodyStretch:!0,bindEvents:!0,constrainTabKey:!0,fadeIn:200,fadeOut:400,timeout:0,showOverlay:!0,focusInput:!0,focusableElements:":input:enabled:visible",onBlock:null,onUnblock:null,onOverlayClick:null,quirksmodeOffsetHack:4,blockMsgClass:"blockMsg",ignoreIfBlocked:!1};var p=null,b=[]}"function"==typeof define&&define.amd&&define.amd.jQuery?define(["jquery"],e):e(jQuery)}();

/*
* jquery-match-height 0.7.2 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,n=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),i=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-n(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(i-a))<=o?r[r.length-1]=s.add(e):r.push(e),i=a}),r},i=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=i(e);if(o.remove){var n=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(n)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.2",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=n,r._parseOptions=i,r._apply=function(e,o){var s=i(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),u=h.parents().filter(":hidden");return u.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),u.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),i=0;if(s.target)i=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),n=e.css("display");"inline-block"!==n&&"flex"!==n&&"inline-flex"!==n&&(n="block");var a={
display:n};a[s.property]="",e.css(a),e.outerHeight(!1)>i&&(i=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=n(e.css("border-top-width"))+n(e.css("border-bottom-width")),o+=n(e.css("padding-top"))+n(e.css("padding-bottom"))),e.css(s.property,i-o+"px"))})}),u.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),n=o.attr("data-mh")||o.attr("data-match-height");n in e?e[n]=e[n].add(o):e[n]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(n,a){if(a&&"resize"===a.type){var i=t(window).width();if(i===e)return;e=i;
}n?o===-1&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi);var h=t.fn.on?"on":"bind";t(window)[h]("load",function(t){r._update(!1,t)}),t(window)[h]("resize orientationchange",function(t){r._update(!0,t)})});
/*
 *	jQuery Sliding Menu Plugin
 *	Mobile app list-style navigation in the browser
 *
 *	Written by Ali Zahid
 *	http://designplox.com/jquery-sliding-menu
 */
!function(a){var e=[];a.fn.slidingMenu=function(t){function n(e){var t=a("ul",e),n=[];return a(t).each(function(e,t){var r=a(t),s=r.prev(),l=i();if(1==s.length&&(s.addClass("nav-has-children dropdown-item").attr("href","#menu-panel-"+l),s.append('<i class="ft-arrow-right children-in"></i>')),r.attr("id","menu-panel-"+l),0==e)r.addClass("menu-panel-root");else{r.addClass("menu-panel");var d=(a("<li></li>"),a("<a></a>").addClass("nav-has-parent back primary dropdown-item").attr("href","#menu-panel-back"));r.prepend(d)}n.push(t)}),n}function r(e,t){var n={id:"menu-panel-"+i(),children:[],root:t?!1:!0},s=[];return t&&n.children.push({styleClass:"back",href:"#"+t.id}),a(e).each(function(a,e){if(n.children.push(e),e.children){var t=r(e.children,n);e.href="#"+t[0].id,e.styleClass="nav",s=s.concat(t)}}),[n].concat(s)}function i(){var a;do a=Math.random().toString(36).substring(3,8);while(e.indexOf(a)>=0);return e.push(a),a}function s(){var e=a(".sliding-menu-wrapper"),t=a(".sliding-menu-wrapper ul");t.length&&setTimeout(function(){var n=a(l).width();e.width(t.length*n),t.each(function(e,t){var r=a(t);r.width(n)}),e.css("margin-left","")},300)}var l=this.selector,d=!1;"rtl"==a("html").data("textdirection")&&(d=!0);var h=a.extend({dataJSON:!1,backLabel:"Back"},t);return this.each(function(){var e,t=this,i=a(t);if(i.hasClass("sliding-menu"))return void s();var l=i.outerWidth();e=h.dataJSON?r(h.dataJSON):n(i),i.empty().addClass("sliding-menu");var p;h.dataJSON?a(e).each(function(e,t){var n=a("<ul></ul>");t.root&&(p="#"+t.id),n.attr("id",t.id),n.addClass("menu-panel"),n.width(l),a(t.children).each(function(e,t){var r=a("<a></a>");r.attr("class",t.styleClass),r.attr("href",t.href),r.text(t.label);var i=a("<li></li>");i.append(r),n.append(i)}),i.append(n)}):a(e).each(function(e,t){var n=a(t);n.hasClass("menu-panel-root")&&(p="#"+n.attr("id")),n.width(l),i.append(t)}),p=a(p),p.addClass("menu-panel-root");var c=p;i.height(p.height());var u=a("<div></div>").addClass("sliding-menu-wrapper").width(e.length*l);return i.wrapInner(u),u=a(".sliding-menu-wrapper",i),a("a",t).on("click",function(e){var t=a(this).attr("href"),n=a(this).text();if(u.is(":animated"))return void e.preventDefault();if("#"==t)e.preventDefault();else if(0==t.indexOf("#menu-panel")){var r,s,l=a(t),o=a(this).hasClass("back");d===!0?s=parseInt(u.css("margin-right")):r=parseInt(u.css("margin-left"));var f=i.width();a(this).closest("ul").hasClass("menu-panel-root")&&(c=p),o?("#menu-panel-back"==t&&(l=c.prev()),d===!0?properties={marginRight:s+f}:properties={marginLeft:r+f},u.stop(!0,!0).animate(properties,"fast")):(l.insertAfter(c),h.backLabel===!0?a(".back",l).html('<i class="fa fa-arrow-circle-o-left back-in"></i>'+n):a(".back",l).text(h.backLabel),d===!0?properties={marginRight:s-f}:properties={marginLeft:r-f},u.stop(!0,!0).animate(properties,"fast")),c=l,i.stop(!0,!0).animate({height:l.height()},"fast"),e.preventDefault()}}),this})}}(jQuery);

/*!
* screenfull
* v5.0.0 - 2019-09-09
* (c) Sindre Sorhus; MIT License
*/

!function(){"use strict";var u="undefined"!=typeof window&&void 0!==window.document?window.document:{},e="undefined"!=typeof module&&module.exports,t=function(){for(var e,n=[["requestFullscreen","exitFullscreen","fullscreenElement","fullscreenEnabled","fullscreenchange","fullscreenerror"],["webkitRequestFullscreen","webkitExitFullscreen","webkitFullscreenElement","webkitFullscreenEnabled","webkitfullscreenchange","webkitfullscreenerror"],["webkitRequestFullScreen","webkitCancelFullScreen","webkitCurrentFullScreenElement","webkitCancelFullScreen","webkitfullscreenchange","webkitfullscreenerror"],["mozRequestFullScreen","mozCancelFullScreen","mozFullScreenElement","mozFullScreenEnabled","mozfullscreenchange","mozfullscreenerror"],["msRequestFullscreen","msExitFullscreen","msFullscreenElement","msFullscreenEnabled","MSFullscreenChange","MSFullscreenError"]],l=0,r=n.length,t={};l<r;l++)if((e=n[l])&&e[1]in u){for(l=0;l<e.length;l++)t[n[0][l]]=e[l];return t}return!1}(),r={change:t.fullscreenchange,error:t.fullscreenerror},n={request:function(r){return new Promise(function(e,n){var l=function(){this.off("change",l),e()}.bind(this);this.on("change",l),r=r||u.documentElement,Promise.resolve(r[t.requestFullscreen]()).catch(n)}.bind(this))},exit:function(){return new Promise(function(e,n){if(this.isFullscreen){var l=function(){this.off("change",l),e()}.bind(this);this.on("change",l),Promise.resolve(u[t.exitFullscreen]()).catch(n)}else e()}.bind(this))},toggle:function(e){return this.isFullscreen?this.exit():this.request(e)},onchange:function(e){this.on("change",e)},onerror:function(e){this.on("error",e)},on:function(e,n){var l=r[e];l&&u.addEventListener(l,n,!1)},off:function(e,n){var l=r[e];l&&u.removeEventListener(l,n,!1)},raw:t};t?(Object.defineProperties(n,{isFullscreen:{get:function(){return Boolean(u[t.fullscreenElement])}},element:{enumerable:!0,get:function(){return u[t.fullscreenElement]}},isEnabled:{enumerable:!0,get:function(){return Boolean(u[t.fullscreenEnabled])}}}),e?module.exports=n:window.screenfull=n):e?module.exports={isEnabled:!1}:window.screenfull={isEnabled:!1}}();

/*! pace 1.0.2 */
(function(){var a,b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u,v,w,x,y,z,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X=[].slice,Y={}.hasOwnProperty,Z=function(a,b){function c(){this.constructor=a}for(var d in b)Y.call(b,d)&&(a[d]=b[d]);return c.prototype=b.prototype,a.prototype=new c,a.__super__=b.prototype,a},$=[].indexOf||function(a){for(var b=0,c=this.length;c>b;b++)if(b in this&&this[b]===a)return b;return-1};for(u={catchupTime:100,initialRate:.03,minTime:250,ghostTime:100,maxProgressPerFrame:20,easeFactor:1.25,startOnPageLoad:!0,restartOnPushState:!0,restartOnRequestAfter:500,target:"body",elements:{checkInterval:100,selectors:["body"]},eventLag:{minSamples:10,sampleCount:3,lagThreshold:3},ajax:{trackMethods:["GET"],trackWebSockets:!0,ignoreURLs:[]}},C=function(){var a;return null!=(a="undefined"!=typeof performance&&null!==performance&&"function"==typeof performance.now?performance.now():void 0)?a:+new Date},E=window.requestAnimationFrame||window.mozRequestAnimationFrame||window.webkitRequestAnimationFrame||window.msRequestAnimationFrame,t=window.cancelAnimationFrame||window.mozCancelAnimationFrame,null==E&&(E=function(a){return setTimeout(a,50)},t=function(a){return clearTimeout(a)}),G=function(a){var b,c;return b=C(),(c=function(){var d;return d=C()-b,d>=33?(b=C(),a(d,function(){return E(c)})):setTimeout(c,33-d)})()},F=function(){var a,b,c;return c=arguments[0],b=arguments[1],a=3<=arguments.length?X.call(arguments,2):[],"function"==typeof c[b]?c[b].apply(c,a):c[b]},v=function(){var a,b,c,d,e,f,g;for(b=arguments[0],d=2<=arguments.length?X.call(arguments,1):[],f=0,g=d.length;g>f;f++)if(c=d[f])for(a in c)Y.call(c,a)&&(e=c[a],null!=b[a]&&"object"==typeof b[a]&&null!=e&&"object"==typeof e?v(b[a],e):b[a]=e);return b},q=function(a){var b,c,d,e,f;for(c=b=0,e=0,f=a.length;f>e;e++)d=a[e],c+=Math.abs(d),b++;return c/b},x=function(a,b){var c,d,e;if(null==a&&(a="options"),null==b&&(b=!0),e=document.querySelector("[data-pace-"+a+"]")){if(c=e.getAttribute("data-pace-"+a),!b)return c;try{return JSON.parse(c)}catch(f){return d=f,"undefined"!=typeof console&&null!==console?console.error("Error parsing inline pace options",d):void 0}}},g=function(){function a(){}return a.prototype.on=function(a,b,c,d){var e;return null==d&&(d=!1),null==this.bindings&&(this.bindings={}),null==(e=this.bindings)[a]&&(e[a]=[]),this.bindings[a].push({handler:b,ctx:c,once:d})},a.prototype.once=function(a,b,c){return this.on(a,b,c,!0)},a.prototype.off=function(a,b){var c,d,e;if(null!=(null!=(d=this.bindings)?d[a]:void 0)){if(null==b)return delete this.bindings[a];for(c=0,e=[];c<this.bindings[a].length;)e.push(this.bindings[a][c].handler===b?this.bindings[a].splice(c,1):c++);return e}},a.prototype.trigger=function(){var a,b,c,d,e,f,g,h,i;if(c=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],null!=(g=this.bindings)?g[c]:void 0){for(e=0,i=[];e<this.bindings[c].length;)h=this.bindings[c][e],d=h.handler,b=h.ctx,f=h.once,d.apply(null!=b?b:this,a),i.push(f?this.bindings[c].splice(e,1):e++);return i}},a}(),j=window.Pace||{},window.Pace=j,v(j,g.prototype),D=j.options=v({},u,window.paceOptions,x()),U=["ajax","document","eventLag","elements"],Q=0,S=U.length;S>Q;Q++)K=U[Q],D[K]===!0&&(D[K]=u[K]);i=function(a){function b(){return V=b.__super__.constructor.apply(this,arguments)}return Z(b,a),b}(Error),b=function(){function a(){this.progress=0}return a.prototype.getElement=function(){var a;if(null==this.el){if(a=document.querySelector(D.target),!a)throw new i;this.el=document.createElement("div"),this.el.className="pace pace-active",document.body.className=document.body.className.replace(/pace-done/g,""),document.body.className+=" pace-running",this.el.innerHTML='<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>',null!=a.firstChild?a.insertBefore(this.el,a.firstChild):a.appendChild(this.el)}return this.el},a.prototype.finish=function(){var a;return a=this.getElement(),a.className=a.className.replace("pace-active",""),a.className+=" pace-inactive",document.body.className=document.body.className.replace("pace-running",""),document.body.className+=" pace-done"},a.prototype.update=function(a){return this.progress=a,this.render()},a.prototype.destroy=function(){try{this.getElement().parentNode.removeChild(this.getElement())}catch(a){i=a}return this.el=void 0},a.prototype.render=function(){var a,b,c,d,e,f,g;if(null==document.querySelector(D.target))return!1;for(a=this.getElement(),d="translate3d("+this.progress+"%, 0, 0)",g=["webkitTransform","msTransform","transform"],e=0,f=g.length;f>e;e++)b=g[e],a.children[0].style[b]=d;return(!this.lastRenderedProgress||this.lastRenderedProgress|0!==this.progress|0)&&(a.children[0].setAttribute("data-progress-text",""+(0|this.progress)+"%"),this.progress>=100?c="99":(c=this.progress<10?"0":"",c+=0|this.progress),a.children[0].setAttribute("data-progress",""+c)),this.lastRenderedProgress=this.progress},a.prototype.done=function(){return this.progress>=100},a}(),h=function(){function a(){this.bindings={}}return a.prototype.trigger=function(a,b){var c,d,e,f,g;if(null!=this.bindings[a]){for(f=this.bindings[a],g=[],d=0,e=f.length;e>d;d++)c=f[d],g.push(c.call(this,b));return g}},a.prototype.on=function(a,b){var c;return null==(c=this.bindings)[a]&&(c[a]=[]),this.bindings[a].push(b)},a}(),P=window.XMLHttpRequest,O=window.XDomainRequest,N=window.WebSocket,w=function(a,b){var c,d,e;e=[];for(d in b.prototype)try{e.push(null==a[d]&&"function"!=typeof b[d]?"function"==typeof Object.defineProperty?Object.defineProperty(a,d,{get:function(){return b.prototype[d]},configurable:!0,enumerable:!0}):a[d]=b.prototype[d]:void 0)}catch(f){c=f}return e},A=[],j.ignore=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("ignore"),c=b.apply(null,a),A.shift(),c},j.track=function(){var a,b,c;return b=arguments[0],a=2<=arguments.length?X.call(arguments,1):[],A.unshift("track"),c=b.apply(null,a),A.shift(),c},J=function(a){var b;if(null==a&&(a="GET"),"track"===A[0])return"force";if(!A.length&&D.ajax){if("socket"===a&&D.ajax.trackWebSockets)return!0;if(b=a.toUpperCase(),$.call(D.ajax.trackMethods,b)>=0)return!0}return!1},k=function(a){function b(){var a,c=this;b.__super__.constructor.apply(this,arguments),a=function(a){var b;return b=a.open,a.open=function(d,e){return J(d)&&c.trigger("request",{type:d,url:e,request:a}),b.apply(a,arguments)}},window.XMLHttpRequest=function(b){var c;return c=new P(b),a(c),c};try{w(window.XMLHttpRequest,P)}catch(d){}if(null!=O){window.XDomainRequest=function(){var b;return b=new O,a(b),b};try{w(window.XDomainRequest,O)}catch(d){}}if(null!=N&&D.ajax.trackWebSockets){window.WebSocket=function(a,b){var d;return d=null!=b?new N(a,b):new N(a),J("socket")&&c.trigger("request",{type:"socket",url:a,protocols:b,request:d}),d};try{w(window.WebSocket,N)}catch(d){}}}return Z(b,a),b}(h),R=null,y=function(){return null==R&&(R=new k),R},I=function(a){var b,c,d,e;for(e=D.ajax.ignoreURLs,c=0,d=e.length;d>c;c++)if(b=e[c],"string"==typeof b){if(-1!==a.indexOf(b))return!0}else if(b.test(a))return!0;return!1},y().on("request",function(b){var c,d,e,f,g;return f=b.type,e=b.request,g=b.url,I(g)?void 0:j.running||D.restartOnRequestAfter===!1&&"force"!==J(f)?void 0:(d=arguments,c=D.restartOnRequestAfter||0,"boolean"==typeof c&&(c=0),setTimeout(function(){var b,c,g,h,i,k;if(b="socket"===f?e.readyState<2:0<(h=e.readyState)&&4>h){for(j.restart(),i=j.sources,k=[],c=0,g=i.length;g>c;c++){if(K=i[c],K instanceof a){K.watch.apply(K,d);break}k.push(void 0)}return k}},c))}),a=function(){function a(){var a=this;this.elements=[],y().on("request",function(){return a.watch.apply(a,arguments)})}return a.prototype.watch=function(a){var b,c,d,e;return d=a.type,b=a.request,e=a.url,I(e)?void 0:(c="socket"===d?new n(b):new o(b),this.elements.push(c))},a}(),o=function(){function a(a){var b,c,d,e,f,g,h=this;if(this.progress=0,null!=window.ProgressEvent)for(c=null,a.addEventListener("progress",function(a){return h.progress=a.lengthComputable?100*a.loaded/a.total:h.progress+(100-h.progress)/2},!1),g=["load","abort","timeout","error"],d=0,e=g.length;e>d;d++)b=g[d],a.addEventListener(b,function(){return h.progress=100},!1);else f=a.onreadystatechange,a.onreadystatechange=function(){var b;return 0===(b=a.readyState)||4===b?h.progress=100:3===a.readyState&&(h.progress=50),"function"==typeof f?f.apply(null,arguments):void 0}}return a}(),n=function(){function a(a){var b,c,d,e,f=this;for(this.progress=0,e=["error","open"],c=0,d=e.length;d>c;c++)b=e[c],a.addEventListener(b,function(){return f.progress=100},!1)}return a}(),d=function(){function a(a){var b,c,d,f;for(null==a&&(a={}),this.elements=[],null==a.selectors&&(a.selectors=[]),f=a.selectors,c=0,d=f.length;d>c;c++)b=f[c],this.elements.push(new e(b))}return a}(),e=function(){function a(a){this.selector=a,this.progress=0,this.check()}return a.prototype.check=function(){var a=this;return document.querySelector(this.selector)?this.done():setTimeout(function(){return a.check()},D.elements.checkInterval)},a.prototype.done=function(){return this.progress=100},a}(),c=function(){function a(){var a,b,c=this;this.progress=null!=(b=this.states[document.readyState])?b:100,a=document.onreadystatechange,document.onreadystatechange=function(){return null!=c.states[document.readyState]&&(c.progress=c.states[document.readyState]),"function"==typeof a?a.apply(null,arguments):void 0}}return a.prototype.states={loading:0,interactive:50,complete:100},a}(),f=function(){function a(){var a,b,c,d,e,f=this;this.progress=0,a=0,e=[],d=0,c=C(),b=setInterval(function(){var g;return g=C()-c-50,c=C(),e.push(g),e.length>D.eventLag.sampleCount&&e.shift(),a=q(e),++d>=D.eventLag.minSamples&&a<D.eventLag.lagThreshold?(f.progress=100,clearInterval(b)):f.progress=100*(3/(a+3))},50)}return a}(),m=function(){function a(a){this.source=a,this.last=this.sinceLastUpdate=0,this.rate=D.initialRate,this.catchup=0,this.progress=this.lastProgress=0,null!=this.source&&(this.progress=F(this.source,"progress"))}return a.prototype.tick=function(a,b){var c;return null==b&&(b=F(this.source,"progress")),b>=100&&(this.done=!0),b===this.last?this.sinceLastUpdate+=a:(this.sinceLastUpdate&&(this.rate=(b-this.last)/this.sinceLastUpdate),this.catchup=(b-this.progress)/D.catchupTime,this.sinceLastUpdate=0,this.last=b),b>this.progress&&(this.progress+=this.catchup*a),c=1-Math.pow(this.progress/100,D.easeFactor),this.progress+=c*this.rate*a,this.progress=Math.min(this.lastProgress+D.maxProgressPerFrame,this.progress),this.progress=Math.max(0,this.progress),this.progress=Math.min(100,this.progress),this.lastProgress=this.progress,this.progress},a}(),L=null,H=null,r=null,M=null,p=null,s=null,j.running=!1,z=function(){return D.restartOnPushState?j.restart():void 0},null!=window.history.pushState&&(T=window.history.pushState,window.history.pushState=function(){return z(),T.apply(window.history,arguments)}),null!=window.history.replaceState&&(W=window.history.replaceState,window.history.replaceState=function(){return z(),W.apply(window.history,arguments)}),l={ajax:a,elements:d,document:c,eventLag:f},(B=function(){var a,c,d,e,f,g,h,i;for(j.sources=L=[],g=["ajax","elements","document","eventLag"],c=0,e=g.length;e>c;c++)a=g[c],D[a]!==!1&&L.push(new l[a](D[a]));for(i=null!=(h=D.extraSources)?h:[],d=0,f=i.length;f>d;d++)K=i[d],L.push(new K(D));return j.bar=r=new b,H=[],M=new m})(),j.stop=function(){return j.trigger("stop"),j.running=!1,r.destroy(),s=!0,null!=p&&("function"==typeof t&&t(p),p=null),B()},j.restart=function(){return j.trigger("restart"),j.stop(),j.start()},j.go=function(){var a;return j.running=!0,r.render(),a=C(),s=!1,p=G(function(b,c){var d,e,f,g,h,i,k,l,n,o,p,q,t,u,v,w;for(l=100-r.progress,e=p=0,f=!0,i=q=0,u=L.length;u>q;i=++q)for(K=L[i],o=null!=H[i]?H[i]:H[i]=[],h=null!=(w=K.elements)?w:[K],k=t=0,v=h.length;v>t;k=++t)g=h[k],n=null!=o[k]?o[k]:o[k]=new m(g),f&=n.done,n.done||(e++,p+=n.tick(b));return d=p/e,r.update(M.tick(b,d)),r.done()||f||s?(r.update(100),j.trigger("done"),setTimeout(function(){return r.finish(),j.running=!1,j.trigger("hide")},Math.max(D.ghostTime,Math.max(D.minTime-(C()-a),0)))):c()})},j.start=function(a){v(D,a),j.running=!0;try{r.render()}catch(b){i=b}return document.querySelector(".pace")?(j.trigger("start"),j.go()):setTimeout(j.start,50)},"function"==typeof define&&define.amd?define(["pace"],function(){return j}):"object"==typeof exports?module.exports=j:D.startOnPageLoad&&j.start()}).call(this);

// Internationalization
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).i18next=t()}(this,function(){"use strict";function e(t){return(e="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(t)}function t(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function n(e,t){for(var n=0;n<t.length;n++){var r=t[n];r.enumerable=r.enumerable||!1,r.configurable=!0,"value"in r&&(r.writable=!0),Object.defineProperty(e,r.key,r)}}function r(e,t,r){return t&&n(e.prototype,t),r&&n(e,r),e}function o(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}function i(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},r=Object.keys(n);"function"==typeof Object.getOwnPropertySymbols&&(r=r.concat(Object.getOwnPropertySymbols(n).filter(function(e){return Object.getOwnPropertyDescriptor(n,e).enumerable}))),r.forEach(function(t){o(e,t,n[t])})}return e}function a(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&u(e,t)}function s(e){return(s=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function u(e,t){return(u=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}function l(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}function c(e,t){return!t||"object"!=typeof t&&"function"!=typeof t?l(e):t}function f(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var n=[],r=!0,o=!1,i=void 0;try{for(var a,s=e[Symbol.iterator]();!(r=(a=s.next()).done)&&(n.push(a.value),!t||n.length!==t);r=!0);}catch(e){o=!0,i=e}finally{try{r||null==s.return||s.return()}finally{if(o)throw i}}return n}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance")}()}function p(e){return function(e){if(Array.isArray(e)){for(var t=0,n=new Array(e.length);t<e.length;t++)n[t]=e[t];return n}}(e)||function(e){if(Symbol.iterator in Object(e)||"[object Arguments]"===Object.prototype.toString.call(e))return Array.from(e)}(e)||function(){throw new TypeError("Invalid attempt to spread non-iterable instance")}()}var g={type:"logger",log:function(e){this.output("log",e)},warn:function(e){this.output("warn",e)},error:function(e){this.output("error",e)},output:function(e,t){var n;console&&console[e]&&(n=console)[e].apply(n,p(t))}},h=new(function(){function e(n){var r=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t(this,e),this.init(n,r)}return r(e,[{key:"init",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.prefix=t.prefix||"i18next:",this.logger=e||g,this.options=t,this.debug=t.debug}},{key:"setDebug",value:function(e){this.debug=e}},{key:"log",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return this.forward(t,"log","",!0)}},{key:"warn",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return this.forward(t,"warn","",!0)}},{key:"error",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return this.forward(t,"error","")}},{key:"deprecate",value:function(){for(var e=arguments.length,t=new Array(e),n=0;n<e;n++)t[n]=arguments[n];return this.forward(t,"warn","WARNING DEPRECATED: ",!0)}},{key:"forward",value:function(e,t,n,r){return r&&!this.debug?null:("string"==typeof e[0]&&(e[0]="".concat(n).concat(this.prefix," ").concat(e[0])),this.logger[t](e))}},{key:"create",value:function(t){return new e(this.logger,i({},{prefix:"".concat(this.prefix,":").concat(t,":")},this.options))}}]),e}()),d=function(){function e(){t(this,e),this.observers={}}return r(e,[{key:"on",value:function(e,t){var n=this;return e.split(" ").forEach(function(e){n.observers[e]=n.observers[e]||[],n.observers[e].push(t)}),this}},{key:"off",value:function(e,t){var n=this;this.observers[e]&&this.observers[e].forEach(function(){if(t){var r=n.observers[e].indexOf(t);r>-1&&n.observers[e].splice(r,1)}else delete n.observers[e]})}},{key:"emit",value:function(e){for(var t=arguments.length,n=new Array(t>1?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];this.observers[e]&&[].concat(this.observers[e]).forEach(function(e){e.apply(void 0,n)});this.observers["*"]&&[].concat(this.observers["*"]).forEach(function(t){t.apply(t,[e].concat(n))})}}]),e}();function v(){var e,t,n=new Promise(function(n,r){e=n,t=r});return n.resolve=e,n.reject=t,n}function y(e){return null==e?"":""+e}function m(e,t,n){function r(e){return e&&e.indexOf("###")>-1?e.replace(/###/g,"."):e}function o(){return!e||"string"==typeof e}for(var i="string"!=typeof t?[].concat(t):t.split(".");i.length>1;){if(o())return{};var a=r(i.shift());!e[a]&&n&&(e[a]=new n),e=e[a]}return o()?{}:{obj:e,k:r(i.shift())}}function b(e,t,n){var r=m(e,t,Object);r.obj[r.k]=n}function k(e,t){var n=m(e,t),r=n.obj,o=n.k;if(r)return r[o]}function x(e){return e.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g,"\\$&")}var S={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#x2F;"};function w(e){return"string"==typeof e?e.replace(/[&<>"'\/]/g,function(e){return S[e]}):e}var O=function(e){function n(e){var r,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{ns:["translation"],defaultNS:"translation"};return t(this,n),r=c(this,s(n).call(this)),d.call(l(l(r))),r.data=e||{},r.options=o,void 0===r.options.keySeparator&&(r.options.keySeparator="."),r}return a(n,d),r(n,[{key:"addNamespaces",value:function(e){this.options.ns.indexOf(e)<0&&this.options.ns.push(e)}},{key:"removeNamespaces",value:function(e){var t=this.options.ns.indexOf(e);t>-1&&this.options.ns.splice(t,1)}},{key:"getResource",value:function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{},o=void 0!==r.keySeparator?r.keySeparator:this.options.keySeparator,i=[e,t];return n&&"string"!=typeof n&&(i=i.concat(n)),n&&"string"==typeof n&&(i=i.concat(o?n.split(o):n)),e.indexOf(".")>-1&&(i=e.split(".")),k(this.data,i)}},{key:"addResource",value:function(e,t,n,r){var o=arguments.length>4&&void 0!==arguments[4]?arguments[4]:{silent:!1},i=this.options.keySeparator;void 0===i&&(i=".");var a=[e,t];n&&(a=a.concat(i?n.split(i):n)),e.indexOf(".")>-1&&(r=t,t=(a=e.split("."))[1]),this.addNamespaces(t),b(this.data,a,r),o.silent||this.emit("added",e,t,n,r)}},{key:"addResources",value:function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{silent:!1};for(var o in n)"string"!=typeof n[o]&&"[object Array]"!==Object.prototype.toString.apply(n[o])||this.addResource(e,t,o,n[o],{silent:!0});r.silent||this.emit("added",e,t,n)}},{key:"addResourceBundle",value:function(e,t,n,r,o){var a=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{silent:!1},s=[e,t];e.indexOf(".")>-1&&(r=n,n=t,t=(s=e.split("."))[1]),this.addNamespaces(t);var u=k(this.data,s)||{};r?function e(t,n,r){for(var o in n)o in t?"string"==typeof t[o]||t[o]instanceof String||"string"==typeof n[o]||n[o]instanceof String?r&&(t[o]=n[o]):e(t[o],n[o],r):t[o]=n[o];return t}(u,n,o):u=i({},u,n),b(this.data,s,u),a.silent||this.emit("added",e,t,n)}},{key:"removeResourceBundle",value:function(e,t){this.hasResourceBundle(e,t)&&delete this.data[e][t],this.removeNamespaces(t),this.emit("removed",e,t)}},{key:"hasResourceBundle",value:function(e,t){return void 0!==this.getResource(e,t)}},{key:"getResourceBundle",value:function(e,t){return t||(t=this.options.defaultNS),"v1"===this.options.compatibilityAPI?i({},{},this.getResource(e,t)):this.getResource(e,t)}},{key:"getDataByLanguage",value:function(e){return this.data[e]}},{key:"toJSON",value:function(){return this.data}}]),n}(),R={processors:{},addPostProcessor:function(e){this.processors[e.name]=e},handle:function(e,t,n,r,o){var i=this;return e.forEach(function(e){i.processors[e]&&(t=i.processors[e].process(t,n,r,o))}),t}},j=function(n){function o(e){var n,r,i,a,u=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return t(this,o),n=c(this,s(o).call(this)),d.call(l(l(n))),r=["resourceStore","languageUtils","pluralResolver","interpolator","backendConnector","i18nFormat"],i=e,a=l(l(n)),r.forEach(function(e){i[e]&&(a[e]=i[e])}),n.options=u,void 0===n.options.keySeparator&&(n.options.keySeparator="."),n.logger=h.create("translator"),n}return a(o,d),r(o,[{key:"changeLanguage",value:function(e){e&&(this.language=e)}},{key:"exists",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{interpolation:{}},n=this.resolve(e,t);return n&&void 0!==n.res}},{key:"extractFromKey",value:function(e,t){var n=t.nsSeparator||this.options.nsSeparator;void 0===n&&(n=":");var r=void 0!==t.keySeparator?t.keySeparator:this.options.keySeparator,o=t.ns||this.options.defaultNS;if(n&&e.indexOf(n)>-1){var i=e.split(n);(n!==r||n===r&&this.options.ns.indexOf(i[0])>-1)&&(o=i.shift()),e=i.join(r)}return"string"==typeof o&&(o=[o]),{key:e,namespaces:o}}},{key:"translate",value:function(t,n){var r=this;if("object"!==e(n)&&this.options.overloadTranslationOptionHandler&&(n=this.options.overloadTranslationOptionHandler(arguments)),n||(n={}),null==t)return"";Array.isArray(t)||(t=[String(t)]);var o=void 0!==n.keySeparator?n.keySeparator:this.options.keySeparator,a=this.extractFromKey(t[t.length-1],n),s=a.key,u=a.namespaces,l=u[u.length-1],c=n.lng||this.language,f=n.appendNamespaceToCIMode||this.options.appendNamespaceToCIMode;if(c&&"cimode"===c.toLowerCase()){if(f){var p=n.nsSeparator||this.options.nsSeparator;return l+p+s}return s}var g=this.resolve(t,n),h=g&&g.res,d=g&&g.usedKey||s,v=g&&g.exactUsedKey||s,y=Object.prototype.toString.apply(h),m=void 0!==n.joinArrays?n.joinArrays:this.options.joinArrays,b=!this.i18nFormat||this.i18nFormat.handleAsObject;if(b&&h&&("string"!=typeof h&&"boolean"!=typeof h&&"number"!=typeof h)&&["[object Number]","[object Function]","[object RegExp]"].indexOf(y)<0&&("string"!=typeof m||"[object Array]"!==y)){if(!n.returnObjects&&!this.options.returnObjects)return this.logger.warn("accessing an object - but returnObjects options is not enabled!"),this.options.returnedObjectHandler?this.options.returnedObjectHandler(d,h,n):"key '".concat(s," (").concat(this.language,")' returned an object instead of string.");if(o){var k="[object Array]"===y,x=k?[]:{},S=k?v:d;for(var w in h)if(Object.prototype.hasOwnProperty.call(h,w)){var O="".concat(S).concat(o).concat(w);x[w]=this.translate(O,i({},n,{joinArrays:!1,ns:u})),x[w]===O&&(x[w]=h[w])}h=x}}else if(b&&"string"==typeof m&&"[object Array]"===y)(h=h.join(m))&&(h=this.extendTranslation(h,t,n));else{var R=!1,j=!1;if(!this.isValidLookup(h)&&void 0!==n.defaultValue){if(R=!0,void 0!==n.count){var L=this.pluralResolver.getSuffix(c,n.count);h=n["defaultValue".concat(L)]}h||(h=n.defaultValue)}this.isValidLookup(h)||(j=!0,h=s);var N=n.defaultValue&&n.defaultValue!==h&&this.options.updateMissing;if(j||R||N){this.logger.log(N?"updateKey":"missingKey",c,l,s,N?n.defaultValue:h);var P=[],C=this.languageUtils.getFallbackCodes(this.options.fallbackLng,n.lng||this.language);if("fallback"===this.options.saveMissingTo&&C&&C[0])for(var E=0;E<C.length;E++)P.push(C[E]);else"all"===this.options.saveMissingTo?P=this.languageUtils.toResolveHierarchy(n.lng||this.language):P.push(n.lng||this.language);var F=function(e,t){r.options.missingKeyHandler?r.options.missingKeyHandler(e,l,t,N?n.defaultValue:h,N,n):r.backendConnector&&r.backendConnector.saveMissing&&r.backendConnector.saveMissing(e,l,t,N?n.defaultValue:h,N,n),r.emit("missingKey",e,l,t,h)};if(this.options.saveMissing){var A=void 0!==n.count&&"string"!=typeof n.count;this.options.saveMissingPlurals&&A?P.forEach(function(e){r.pluralResolver.getPluralFormsOfKey(e,s).forEach(function(t){return F([e],t)})}):F(P,s)}}h=this.extendTranslation(h,t,n,g),j&&h===s&&this.options.appendNamespaceToMissingKey&&(h="".concat(l,":").concat(s)),j&&this.options.parseMissingKeyHandler&&(h=this.options.parseMissingKeyHandler(h))}return h}},{key:"extendTranslation",value:function(e,t,n,r){var o=this;if(this.i18nFormat&&this.i18nFormat.parse)e=this.i18nFormat.parse(e,n,r.usedLng,r.usedNS,r.usedKey,{resolved:r});else if(!n.skipInterpolation){n.interpolation&&this.interpolator.init(i({},n,{interpolation:i({},this.options.interpolation,n.interpolation)}));var a=n.replace&&"string"!=typeof n.replace?n.replace:n;this.options.interpolation.defaultVariables&&(a=i({},this.options.interpolation.defaultVariables,a)),e=this.interpolator.interpolate(e,a,n.lng||this.language,n),!1!==n.nest&&(e=this.interpolator.nest(e,function(){return o.translate.apply(o,arguments)},n)),n.interpolation&&this.interpolator.reset()}var s=n.postProcess||this.options.postProcess,u="string"==typeof s?[s]:s;return null!=e&&u&&u.length&&!1!==n.applyPostProcessor&&(e=R.handle(u,e,t,n,this)),e}},{key:"resolve",value:function(e){var t,n,r,o,i,a=this,s=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};return"string"==typeof e&&(e=[e]),e.forEach(function(e){if(!a.isValidLookup(t)){var u=a.extractFromKey(e,s),l=u.key;n=l;var c=u.namespaces;a.options.fallbackNS&&(c=c.concat(a.options.fallbackNS));var f=void 0!==s.count&&"string"!=typeof s.count,p=void 0!==s.context&&"string"==typeof s.context&&""!==s.context,g=s.lngs?s.lngs:a.languageUtils.toResolveHierarchy(s.lng||a.language,s.fallbackLng);c.forEach(function(e){a.isValidLookup(t)||(i=e,g.forEach(function(n){if(!a.isValidLookup(t)){o=n;var i,u,c=l,g=[c];if(a.i18nFormat&&a.i18nFormat.addLookupKeys)a.i18nFormat.addLookupKeys(g,l,n,e,s);else f&&(i=a.pluralResolver.getSuffix(n,s.count)),f&&p&&g.push(c+i),p&&g.push(c+="".concat(a.options.contextSeparator).concat(s.context)),f&&g.push(c+=i);for(;u=g.pop();)a.isValidLookup(t)||(r=u,t=a.getResource(n,e,u,s))}}))})}}),{res:t,usedKey:n,exactUsedKey:r,usedLng:o,usedNS:i}}},{key:"isValidLookup",value:function(e){return!(void 0===e||!this.options.returnNull&&null===e||!this.options.returnEmptyString&&""===e)}},{key:"getResource",value:function(e,t,n){var r=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{};return this.i18nFormat&&this.i18nFormat.getResource?this.i18nFormat.getResource(e,t,n,r):this.resourceStore.getResource(e,t,n,r)}}]),o}();function L(e){return e.charAt(0).toUpperCase()+e.slice(1)}var N=function(){function e(n){t(this,e),this.options=n,this.whitelist=this.options.whitelist||!1,this.logger=h.create("languageUtils")}return r(e,[{key:"getScriptPartFromCode",value:function(e){if(!e||e.indexOf("-")<0)return null;var t=e.split("-");return 2===t.length?null:(t.pop(),this.formatLanguageCode(t.join("-")))}},{key:"getLanguagePartFromCode",value:function(e){if(!e||e.indexOf("-")<0)return e;var t=e.split("-");return this.formatLanguageCode(t[0])}},{key:"formatLanguageCode",value:function(e){if("string"==typeof e&&e.indexOf("-")>-1){var t=["hans","hant","latn","cyrl","cans","mong","arab"],n=e.split("-");return this.options.lowerCaseLng?n=n.map(function(e){return e.toLowerCase()}):2===n.length?(n[0]=n[0].toLowerCase(),n[1]=n[1].toUpperCase(),t.indexOf(n[1].toLowerCase())>-1&&(n[1]=L(n[1].toLowerCase()))):3===n.length&&(n[0]=n[0].toLowerCase(),2===n[1].length&&(n[1]=n[1].toUpperCase()),"sgn"!==n[0]&&2===n[2].length&&(n[2]=n[2].toUpperCase()),t.indexOf(n[1].toLowerCase())>-1&&(n[1]=L(n[1].toLowerCase())),t.indexOf(n[2].toLowerCase())>-1&&(n[2]=L(n[2].toLowerCase()))),n.join("-")}return this.options.cleanCode||this.options.lowerCaseLng?e.toLowerCase():e}},{key:"isWhitelisted",value:function(e){return("languageOnly"===this.options.load||this.options.nonExplicitWhitelist)&&(e=this.getLanguagePartFromCode(e)),!this.whitelist||!this.whitelist.length||this.whitelist.indexOf(e)>-1}},{key:"getFallbackCodes",value:function(e,t){if(!e)return[];if("string"==typeof e&&(e=[e]),"[object Array]"===Object.prototype.toString.apply(e))return e;if(!t)return e.default||[];var n=e[t];return n||(n=e[this.getScriptPartFromCode(t)]),n||(n=e[this.formatLanguageCode(t)]),n||(n=e.default),n||[]}},{key:"toResolveHierarchy",value:function(e,t){var n=this,r=this.getFallbackCodes(t||this.options.fallbackLng||[],e),o=[],i=function(e){e&&(n.isWhitelisted(e)?o.push(e):n.logger.warn("rejecting non-whitelisted language code: ".concat(e)))};return"string"==typeof e&&e.indexOf("-")>-1?("languageOnly"!==this.options.load&&i(this.formatLanguageCode(e)),"languageOnly"!==this.options.load&&"currentOnly"!==this.options.load&&i(this.getScriptPartFromCode(e)),"currentOnly"!==this.options.load&&i(this.getLanguagePartFromCode(e))):"string"==typeof e&&i(this.formatLanguageCode(e)),r.forEach(function(e){o.indexOf(e)<0&&i(n.formatLanguageCode(e))}),o}}]),e}(),P=[{lngs:["ach","ak","am","arn","br","fil","gun","ln","mfe","mg","mi","oc","pt","pt-BR","tg","ti","tr","uz","wa"],nr:[1,2],fc:1},{lngs:["af","an","ast","az","bg","bn","ca","da","de","dev","el","en","eo","es","et","eu","fi","fo","fur","fy","gl","gu","ha","hi","hu","hy","ia","it","kn","ku","lb","mai","ml","mn","mr","nah","nap","nb","ne","nl","nn","no","nso","pa","pap","pms","ps","pt-PT","rm","sco","se","si","so","son","sq","sv","sw","ta","te","tk","ur","yo"],nr:[1,2],fc:2},{lngs:["ay","bo","cgg","fa","id","ja","jbo","ka","kk","km","ko","ky","lo","ms","sah","su","th","tt","ug","vi","wo","zh"],nr:[1],fc:3},{lngs:["be","bs","dz","hr","ru","sr","uk"],nr:[1,2,5],fc:4},{lngs:["ar"],nr:[0,1,2,3,11,100],fc:5},{lngs:["cs","sk"],nr:[1,2,5],fc:6},{lngs:["csb","pl"],nr:[1,2,5],fc:7},{lngs:["cy"],nr:[1,2,3,8],fc:8},{lngs:["fr"],nr:[1,2],fc:9},{lngs:["ga"],nr:[1,2,3,7,11],fc:10},{lngs:["gd"],nr:[1,2,3,20],fc:11},{lngs:["is"],nr:[1,2],fc:12},{lngs:["jv"],nr:[0,1],fc:13},{lngs:["kw"],nr:[1,2,3,4],fc:14},{lngs:["lt"],nr:[1,2,10],fc:15},{lngs:["lv"],nr:[1,2,0],fc:16},{lngs:["mk"],nr:[1,2],fc:17},{lngs:["mnk"],nr:[0,1,2],fc:18},{lngs:["mt"],nr:[1,2,11,20],fc:19},{lngs:["or"],nr:[2,1],fc:2},{lngs:["ro"],nr:[1,2,20],fc:20},{lngs:["sl"],nr:[5,1,2,3],fc:21},{lngs:["he"],nr:[1,2,20,21],fc:22}],C={1:function(e){return Number(e>1)},2:function(e){return Number(1!=e)},3:function(e){return 0},4:function(e){return Number(e%10==1&&e%100!=11?0:e%10>=2&&e%10<=4&&(e%100<10||e%100>=20)?1:2)},5:function(e){return Number(0===e?0:1==e?1:2==e?2:e%100>=3&&e%100<=10?3:e%100>=11?4:5)},6:function(e){return Number(1==e?0:e>=2&&e<=4?1:2)},7:function(e){return Number(1==e?0:e%10>=2&&e%10<=4&&(e%100<10||e%100>=20)?1:2)},8:function(e){return Number(1==e?0:2==e?1:8!=e&&11!=e?2:3)},9:function(e){return Number(e>=2)},10:function(e){return Number(1==e?0:2==e?1:e<7?2:e<11?3:4)},11:function(e){return Number(1==e||11==e?0:2==e||12==e?1:e>2&&e<20?2:3)},12:function(e){return Number(e%10!=1||e%100==11)},13:function(e){return Number(0!==e)},14:function(e){return Number(1==e?0:2==e?1:3==e?2:3)},15:function(e){return Number(e%10==1&&e%100!=11?0:e%10>=2&&(e%100<10||e%100>=20)?1:2)},16:function(e){return Number(e%10==1&&e%100!=11?0:0!==e?1:2)},17:function(e){return Number(1==e||e%10==1?0:1)},18:function(e){return Number(0==e?0:1==e?1:2)},19:function(e){return Number(1==e?0:0===e||e%100>1&&e%100<11?1:e%100>10&&e%100<20?2:3)},20:function(e){return Number(1==e?0:0===e||e%100>0&&e%100<20?1:2)},21:function(e){return Number(e%100==1?1:e%100==2?2:e%100==3||e%100==4?3:0)},22:function(e){return Number(1===e?0:2===e?1:(e<0||e>10)&&e%10==0?2:3)}};var E=function(){function e(n){var r,o=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};t(this,e),this.languageUtils=n,this.options=o,this.logger=h.create("pluralResolver"),this.rules=(r={},P.forEach(function(e){e.lngs.forEach(function(t){r[t]={numbers:e.nr,plurals:C[e.fc]}})}),r)}return r(e,[{key:"addRule",value:function(e,t){this.rules[e]=t}},{key:"getRule",value:function(e){return this.rules[e]||this.rules[this.languageUtils.getLanguagePartFromCode(e)]}},{key:"needsPlural",value:function(e){var t=this.getRule(e);return t&&t.numbers.length>1}},{key:"getPluralFormsOfKey",value:function(e,t){var n=this,r=[],o=this.getRule(e);return o?(o.numbers.forEach(function(o){var i=n.getSuffix(e,o);r.push("".concat(t).concat(i))}),r):r}},{key:"getSuffix",value:function(e,t){var n=this,r=this.getRule(e);if(r){var o=r.noAbs?r.plurals(t):r.plurals(Math.abs(t)),i=r.numbers[o];this.options.simplifyPluralSuffix&&2===r.numbers.length&&1===r.numbers[0]&&(2===i?i="plural":1===i&&(i=""));var a=function(){return n.options.prepend&&i.toString()?n.options.prepend+i.toString():i.toString()};return"v1"===this.options.compatibilityJSON?1===i?"":"number"==typeof i?"_plural_".concat(i.toString()):a():"v2"===this.options.compatibilityJSON?a():this.options.simplifyPluralSuffix&&2===r.numbers.length&&1===r.numbers[0]?a():this.options.prepend&&o.toString()?this.options.prepend+o.toString():o.toString()}return this.logger.warn("no plural rule found for: ".concat(e)),""}}]),e}(),F=function(){function e(){var n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};t(this,e),this.logger=h.create("interpolator"),this.init(n,!0)}return r(e,[{key:"init",value:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};(arguments.length>1?arguments[1]:void 0)&&(this.options=e,this.format=e.interpolation&&e.interpolation.format||function(e){return e}),e.interpolation||(e.interpolation={escapeValue:!0});var t=e.interpolation;this.escape=void 0!==t.escape?t.escape:w,this.escapeValue=void 0===t.escapeValue||t.escapeValue,this.useRawValueToEscape=void 0!==t.useRawValueToEscape&&t.useRawValueToEscape,this.prefix=t.prefix?x(t.prefix):t.prefixEscaped||"{{",this.suffix=t.suffix?x(t.suffix):t.suffixEscaped||"}}",this.formatSeparator=t.formatSeparator?t.formatSeparator:t.formatSeparator||",",this.unescapePrefix=t.unescapeSuffix?"":t.unescapePrefix||"-",this.unescapeSuffix=this.unescapePrefix?"":t.unescapeSuffix||"",this.nestingPrefix=t.nestingPrefix?x(t.nestingPrefix):t.nestingPrefixEscaped||x("$t("),this.nestingSuffix=t.nestingSuffix?x(t.nestingSuffix):t.nestingSuffixEscaped||x(")"),this.maxReplaces=t.maxReplaces?t.maxReplaces:1e3,this.resetRegExp()}},{key:"reset",value:function(){this.options&&this.init(this.options)}},{key:"resetRegExp",value:function(){var e="".concat(this.prefix,"(.+?)").concat(this.suffix);this.regexp=new RegExp(e,"g");var t="".concat(this.prefix).concat(this.unescapePrefix,"(.+?)").concat(this.unescapeSuffix).concat(this.suffix);this.regexpUnescape=new RegExp(t,"g");var n="".concat(this.nestingPrefix,"(.+?)").concat(this.nestingSuffix);this.nestingRegexp=new RegExp(n,"g")}},{key:"interpolate",value:function(e,t,n,r){var o,i,a,s=this;function u(e){return e.replace(/\$/g,"$$$$")}var l=function(e){if(e.indexOf(s.formatSeparator)<0)return k(t,e);var r=e.split(s.formatSeparator),o=r.shift().trim(),i=r.join(s.formatSeparator).trim();return s.format(k(t,o),i,n)};this.resetRegExp();var c=r&&r.missingInterpolationHandler||this.options.missingInterpolationHandler;for(a=0;(o=this.regexpUnescape.exec(e))&&(i=l(o[1].trim()),e=e.replace(o[0],i),this.regexpUnescape.lastIndex=0,!(++a>=this.maxReplaces)););for(a=0;o=this.regexp.exec(e);){if(void 0===(i=l(o[1].trim())))if("function"==typeof c){var f=c(e,o,r);i="string"==typeof f?f:""}else this.logger.warn("missed to pass in variable ".concat(o[1]," for interpolating ").concat(e)),i="";else"string"==typeof i||this.useRawValueToEscape||(i=y(i));if(i=this.escapeValue?u(this.escape(i)):u(i),e=e.replace(o[0],i),this.regexp.lastIndex=0,++a>=this.maxReplaces)break}return e}},{key:"nest",value:function(e,t){var n,r,o=i({},arguments.length>2&&void 0!==arguments[2]?arguments[2]:{});function a(e,t){if(e.indexOf(",")<0)return e;var n=e.split(",");e=n.shift();var r=n.join(",");r=(r=this.interpolate(r,o)).replace(/'/g,'"');try{o=JSON.parse(r),t&&(o=i({},t,o))}catch(t){this.logger.error("failed parsing options string in nesting for key ".concat(e),t)}return e}for(o.applyPostProcessor=!1;n=this.nestingRegexp.exec(e);){if((r=t(a.call(this,n[1].trim(),o),o))&&n[0]===e&&"string"!=typeof r)return r;"string"!=typeof r&&(r=y(r)),r||(this.logger.warn("missed to resolve ".concat(n[1]," for nesting ").concat(e)),r=""),e=e.replace(n[0],r),this.regexp.lastIndex=0}return e}}]),e}();var A=function(e){function n(e,r,o){var i,a=arguments.length>3&&void 0!==arguments[3]?arguments[3]:{};return t(this,n),i=c(this,s(n).call(this)),d.call(l(l(i))),i.backend=e,i.store=r,i.languageUtils=o.languageUtils,i.options=a,i.logger=h.create("backendConnector"),i.state={},i.queue=[],i.backend&&i.backend.init&&i.backend.init(o,a.backend,a),i}return a(n,d),r(n,[{key:"queueLoad",value:function(e,t,n,r){var o=this,i=[],a=[],s=[],u=[];return e.forEach(function(e){var r=!0;t.forEach(function(t){var s="".concat(e,"|").concat(t);!n.reload&&o.store.hasResourceBundle(e,t)?o.state[s]=2:o.state[s]<0||(1===o.state[s]?a.indexOf(s)<0&&a.push(s):(o.state[s]=1,r=!1,a.indexOf(s)<0&&a.push(s),i.indexOf(s)<0&&i.push(s),u.indexOf(t)<0&&u.push(t)))}),r||s.push(e)}),(i.length||a.length)&&this.queue.push({pending:a,loaded:{},errors:[],callback:r}),{toLoad:i,pending:a,toLoadLanguages:s,toLoadNamespaces:u}}},{key:"loaded",value:function(e,t,n){var r=f(e.split("|"),2),o=r[0],i=r[1];t&&this.emit("failedLoading",o,i,t),n&&this.store.addResourceBundle(o,i,n),this.state[e]=t?-1:2;var a={};this.queue.forEach(function(n){var r,s,u,l,c,f;r=n.loaded,s=i,l=m(r,[o],Object),c=l.obj,f=l.k,c[f]=c[f]||[],u&&(c[f]=c[f].concat(s)),u||c[f].push(s),function(e,t){for(var n=e.indexOf(t);-1!==n;)e.splice(n,1),n=e.indexOf(t)}(n.pending,e),t&&n.errors.push(t),0!==n.pending.length||n.done||(Object.keys(n.loaded).forEach(function(e){a[e]||(a[e]=[]),n.loaded[e].length&&n.loaded[e].forEach(function(t){a[e].indexOf(t)<0&&a[e].push(t)})}),n.done=!0,n.errors.length?n.callback(n.errors):n.callback())}),this.emit("loaded",a),this.queue=this.queue.filter(function(e){return!e.done})}},{key:"read",value:function(e,t,n){var r=this,o=arguments.length>3&&void 0!==arguments[3]?arguments[3]:0,i=arguments.length>4&&void 0!==arguments[4]?arguments[4]:250,a=arguments.length>5?arguments[5]:void 0;return e.length?this.backend[n](e,t,function(s,u){s&&u&&o<5?setTimeout(function(){r.read.call(r,e,t,n,o+1,2*i,a)},i):a(s,u)}):a(null,{})}},{key:"prepareLoading",value:function(e,t){var n=this,r=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{},o=arguments.length>3?arguments[3]:void 0;if(!this.backend)return this.logger.warn("No backend was added via i18next.use. Will not load resources."),o&&o();"string"==typeof e&&(e=this.languageUtils.toResolveHierarchy(e)),"string"==typeof t&&(t=[t]);var i=this.queueLoad(e,t,r,o);if(!i.toLoad.length)return i.pending.length||o(),null;i.toLoad.forEach(function(e){n.loadOne(e)})}},{key:"load",value:function(e,t,n){this.prepareLoading(e,t,{},n)}},{key:"reload",value:function(e,t,n){this.prepareLoading(e,t,{reload:!0},n)}},{key:"loadOne",value:function(e){var t=this,n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"",r=f(e.split("|"),2),o=r[0],i=r[1];this.read(o,i,"read",null,null,function(r,a){r&&t.logger.warn("".concat(n,"loading namespace ").concat(i," for language ").concat(o," failed"),r),!r&&a&&t.logger.log("".concat(n,"loaded namespace ").concat(i," for language ").concat(o),a),t.loaded(e,r,a)})}},{key:"saveMissing",value:function(e,t,n,r,o){var a=arguments.length>5&&void 0!==arguments[5]?arguments[5]:{};this.backend&&this.backend.create&&this.backend.create(e,t,n,r,null,i({},a,{isUpdate:o})),e&&e[0]&&this.store.addResource(e[0],t,n,r)}}]),n}();function T(e){return"string"==typeof e.ns&&(e.ns=[e.ns]),"string"==typeof e.fallbackLng&&(e.fallbackLng=[e.fallbackLng]),"string"==typeof e.fallbackNS&&(e.fallbackNS=[e.fallbackNS]),e.whitelist&&e.whitelist.indexOf("cimode")<0&&(e.whitelist=e.whitelist.concat(["cimode"])),e}function V(){}return new(function(n){function o(){var e,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},r=arguments.length>1?arguments[1]:void 0;if(t(this,o),e=c(this,s(o).call(this)),d.call(l(l(e))),e.options=T(n),e.services={},e.logger=h,e.modules={external:[]},r&&!e.isInitialized&&!n.isClone){if(!e.options.initImmediate)return e.init(n,r),c(e,l(l(e)));setTimeout(function(){e.init(n,r)},0)}return e}return a(o,d),r(o,[{key:"init",value:function(){var t=this,n=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},r=arguments.length>1?arguments[1]:void 0;function o(e){return e?"function"==typeof e?new e:e:null}if("function"==typeof n&&(r=n,n={}),this.options=i({},{debug:!1,initImmediate:!0,ns:["translation"],defaultNS:["translation"],fallbackLng:["dev"],fallbackNS:!1,whitelist:!1,nonExplicitWhitelist:!1,load:"all",preload:!1,simplifyPluralSuffix:!0,keySeparator:".",nsSeparator:":",pluralSeparator:"_",contextSeparator:"_",partialBundledLanguages:!1,saveMissing:!1,updateMissing:!1,saveMissingTo:"fallback",saveMissingPlurals:!0,missingKeyHandler:!1,missingInterpolationHandler:!1,postProcess:!1,returnNull:!0,returnEmptyString:!0,returnObjects:!1,joinArrays:!1,returnedObjectHandler:function(){},parseMissingKeyHandler:!1,appendNamespaceToMissingKey:!1,appendNamespaceToCIMode:!1,overloadTranslationOptionHandler:function(t){var n={};if("object"===e(t[1])&&(n=t[1]),"string"==typeof t[1]&&(n.defaultValue=t[1]),"string"==typeof t[2]&&(n.tDescription=t[2]),"object"===e(t[2])||"object"===e(t[3])){var r=t[3]||t[2];Object.keys(r).forEach(function(e){n[e]=r[e]})}return n},interpolation:{escapeValue:!0,format:function(e,t,n){return e},prefix:"{{",suffix:"}}",formatSeparator:",",unescapePrefix:"-",nestingPrefix:"$t(",nestingSuffix:")",maxReplaces:1e3}},this.options,T(n)),this.format=this.options.interpolation.format,r||(r=V),!this.options.isClone){this.modules.logger?h.init(o(this.modules.logger),this.options):h.init(null,this.options);var a=new N(this.options);this.store=new O(this.options.resources,this.options);var s=this.services;s.logger=h,s.resourceStore=this.store,s.languageUtils=a,s.pluralResolver=new E(a,{prepend:this.options.pluralSeparator,compatibilityJSON:this.options.compatibilityJSON,simplifyPluralSuffix:this.options.simplifyPluralSuffix}),s.interpolator=new F(this.options),s.backendConnector=new A(o(this.modules.backend),s.resourceStore,s,this.options),s.backendConnector.on("*",function(e){for(var n=arguments.length,r=new Array(n>1?n-1:0),o=1;o<n;o++)r[o-1]=arguments[o];t.emit.apply(t,[e].concat(r))}),this.modules.languageDetector&&(s.languageDetector=o(this.modules.languageDetector),s.languageDetector.init(s,this.options.detection,this.options)),this.modules.i18nFormat&&(s.i18nFormat=o(this.modules.i18nFormat),s.i18nFormat.init&&s.i18nFormat.init(this)),this.translator=new j(this.services,this.options),this.translator.on("*",function(e){for(var n=arguments.length,r=new Array(n>1?n-1:0),o=1;o<n;o++)r[o-1]=arguments[o];t.emit.apply(t,[e].concat(r))}),this.modules.external.forEach(function(e){e.init&&e.init(t)})}["getResource","addResource","addResources","addResourceBundle","removeResourceBundle","hasResourceBundle","getResourceBundle","getDataByLanguage"].forEach(function(e){t[e]=function(){var n;return(n=t.store)[e].apply(n,arguments)}});var u=v(),l=function(){t.changeLanguage(t.options.lng,function(e,n){t.isInitialized=!0,t.logger.log("initialized",t.options),t.emit("initialized",t.options),u.resolve(n),r(e,n)})};return this.options.resources||!this.options.initImmediate?l():setTimeout(l,0),u}},{key:"loadResources",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:V;if(!this.options.resources||this.options.partialBundledLanguages){if(this.language&&"cimode"===this.language.toLowerCase())return t();var n=[],r=function(t){t&&e.services.languageUtils.toResolveHierarchy(t).forEach(function(e){n.indexOf(e)<0&&n.push(e)})};if(this.language)r(this.language);else this.services.languageUtils.getFallbackCodes(this.options.fallbackLng).forEach(function(e){return r(e)});this.options.preload&&this.options.preload.forEach(function(e){return r(e)}),this.services.backendConnector.load(n,this.options.ns,t)}else t(null)}},{key:"reloadResources",value:function(e,t,n){var r=v();return e||(e=this.languages),t||(t=this.options.ns),n||(n=V),this.services.backendConnector.reload(e,t,function(e){r.resolve(),n(e)}),r}},{key:"use",value:function(e){return"backend"===e.type&&(this.modules.backend=e),("logger"===e.type||e.log&&e.warn&&e.error)&&(this.modules.logger=e),"languageDetector"===e.type&&(this.modules.languageDetector=e),"i18nFormat"===e.type&&(this.modules.i18nFormat=e),"postProcessor"===e.type&&R.addPostProcessor(e),"3rdParty"===e.type&&this.modules.external.push(e),this}},{key:"changeLanguage",value:function(e,t){var n=this,r=v(),o=function(e){e&&(n.language=e,n.languages=n.services.languageUtils.toResolveHierarchy(e),n.translator.language||n.translator.changeLanguage(e),n.services.languageDetector&&n.services.languageDetector.cacheUserLanguage(e)),n.loadResources(function(o){!function(e,o){n.translator.changeLanguage(o),o&&(n.emit("languageChanged",o),n.logger.log("languageChanged",o)),r.resolve(function(){return n.t.apply(n,arguments)}),t&&t(e,function(){return n.t.apply(n,arguments)})}(o,e)})};return e||!this.services.languageDetector||this.services.languageDetector.async?!e&&this.services.languageDetector&&this.services.languageDetector.async?this.services.languageDetector.detect(o):o(e):o(this.services.languageDetector.detect()),r}},{key:"getFixedT",value:function(t,n){var r=this,o=function t(n,o){var a=i({},o);if("object"!==e(o)){for(var s=arguments.length,u=new Array(s>2?s-2:0),l=2;l<s;l++)u[l-2]=arguments[l];a=r.options.overloadTranslationOptionHandler([n,o].concat(u))}return a.lng=a.lng||t.lng,a.lngs=a.lngs||t.lngs,a.ns=a.ns||t.ns,r.t(n,a)};return"string"==typeof t?o.lng=t:o.lngs=t,o.ns=n,o}},{key:"t",value:function(){var e;return this.translator&&(e=this.translator).translate.apply(e,arguments)}},{key:"exists",value:function(){var e;return this.translator&&(e=this.translator).exists.apply(e,arguments)}},{key:"setDefaultNamespace",value:function(e){this.options.defaultNS=e}},{key:"loadNamespaces",value:function(e,t){var n=this,r=v();return this.options.ns?("string"==typeof e&&(e=[e]),e.forEach(function(e){n.options.ns.indexOf(e)<0&&n.options.ns.push(e)}),this.loadResources(function(e){r.resolve(),t&&t(e)}),r):(t&&t(),Promise.resolve())}},{key:"loadLanguages",value:function(e,t){var n=v();"string"==typeof e&&(e=[e]);var r=this.options.preload||[],o=e.filter(function(e){return r.indexOf(e)<0});return o.length?(this.options.preload=r.concat(o),this.loadResources(function(e){n.resolve(),t&&t(e)}),n):(t&&t(),Promise.resolve())}},{key:"dir",value:function(e){if(e||(e=this.languages&&this.languages.length>0?this.languages[0]:this.language),!e)return"rtl";return["ar","shu","sqr","ssh","xaa","yhd","yud","aao","abh","abv","acm","acq","acw","acx","acy","adf","ads","aeb","aec","afb","ajp","apc","apd","arb","arq","ars","ary","arz","auz","avl","ayh","ayl","ayn","ayp","bbz","pga","he","iw","ps","pbt","pbu","pst","prp","prd","ur","ydd","yds","yih","ji","yi","hbo","men","xmn","fa","jpr","peo","pes","prs","dv","sam"].indexOf(this.services.languageUtils.getLanguagePartFromCode(e))>=0?"rtl":"ltr"}},{key:"createInstance",value:function(){return new o(arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},arguments.length>1?arguments[1]:void 0)}},{key:"cloneInstance",value:function(){var e=this,t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{},n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:V,r=i({},this.options,t,{isClone:!0}),a=new o(r);return["store","services","language"].forEach(function(t){a[t]=e[t]}),a.translator=new j(a.services,a.options),a.translator.on("*",function(e){for(var t=arguments.length,n=new Array(t>1?t-1:0),r=1;r<t;r++)n[r-1]=arguments[r];a.emit.apply(a,[e].concat(n))}),a.init(r,n),a.translator.options=a.options,a}}]),o}())});

// I18n XHR Backend
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.i18nextXHRBackend=e()}(this,function(){"use strict";function t(t){return r.call(s.call(arguments,1),function(e){if(e)for(var n in e)void 0===t[n]&&(t[n]=e[n])}),t}function e(t,e){if(e&&"object"===(void 0===e?"undefined":l(e))){var n="",o=encodeURIComponent;for(var i in e)n+="&"+o(i)+"="+o(e[i]);if(!n)return t;t=t+(-1!==t.indexOf("?")?"&":"?")+n.slice(1)}return t}function n(t,n,o,i,a){i&&"object"===(void 0===i?"undefined":l(i))&&(a||(i._t=new Date),i=e("",i).slice(1)),n.queryStringParams&&(t=e(t,n.queryStringParams));try{var r;r=XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("MSXML2.XMLHTTP.3.0"),r.open(i?"POST":"GET",t,1),n.crossDomain||r.setRequestHeader("X-Requested-With","XMLHttpRequest"),r.withCredentials=!!n.withCredentials,i&&r.setRequestHeader("Content-type","application/x-www-form-urlencoded"),r.overrideMimeType&&r.overrideMimeType("application/json");var s=n.customHeaders;if(s)for(var u in s)r.setRequestHeader(u,s[u]);r.onreadystatechange=function(){r.readyState>3&&o&&o(r.responseText,r)},r.send(i)}catch(t){console&&console.log(t)}}function o(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")}function i(){return{loadPath:"/locales/{{lng}}/{{ns}}.json",addPath:"/locales/add/{{lng}}/{{ns}}",allowMultiLoading:!1,parse:JSON.parse,crossDomain:!1,ajax:n}}var a=[],r=a.forEach,s=a.slice,l="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},u=function(){function t(t,e){for(var n=0;n<e.length;n++){var o=e[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(t,o.key,o)}}return function(e,n,o){return n&&t(e.prototype,n),o&&t(e,o),e}}(),c=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};o(this,e),this.init(t,n),this.type="backend"}return u(e,[{key:"init",value:function(e){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.services=e,this.options=t(n,this.options||{},i())}},{key:"readMulti",value:function(t,e,n){var o=this.options.loadPath;"function"==typeof this.options.loadPath&&(o=this.options.loadPath(t,e));var i=this.services.interpolator.interpolate(o,{lng:t.join("+"),ns:e.join("+")});this.loadUrl(i,n)}},{key:"read",value:function(t,e,n){var o=this.options.loadPath;"function"==typeof this.options.loadPath&&(o=this.options.loadPath([t],[e]));var i=this.services.interpolator.interpolate(o,{lng:t,ns:e});this.loadUrl(i,n)}},{key:"loadUrl",value:function(t,e){var n=this;this.options.ajax(t,this.options,function(o,i){if(i.status>=500&&i.status<600)return e("failed loading "+t,!0);if(i.status>=400&&i.status<500)return e("failed loading "+t,!1);var a=void 0,r=void 0;try{a=n.options.parse(o,t)}catch(e){r="failed parsing "+t+" to json"}if(r)return e(r,!1);e(null,a)})}},{key:"create",value:function(t,e,n,o){var i=this;"string"==typeof t&&(t=[t]);var a={};a[n]=o||"",t.forEach(function(t){var n=i.services.interpolator.interpolate(i.options.addPath,{lng:t,ns:e});i.options.ajax(n,i.options,function(t,e){},a)})}}]),e}();return c.type="backend",c});

// Language detector i18n
!function(e,o){"object"==typeof exports&&"undefined"!=typeof module?module.exports=o():"function"==typeof define&&define.amd?define(o):e.i18nextBrowserLanguageDetector=o()}(this,function(){"use strict";function e(e){return a.call(i.call(arguments,1),function(o){if(o)for(var t in o)void 0===e[t]&&(e[t]=o[t])}),e}function o(e,o){if(!(e instanceof o))throw new TypeError("Cannot call a class as a function")}function t(){return{order:["querystring","cookie","localStorage","navigator","htmlTag"],lookupQuerystring:"lng",lookupCookie:"i18next",lookupLocalStorage:"i18nextLng",caches:["localStorage"],excludeCacheFor:["cimode"]}}var n=[],a=n.forEach,i=n.slice,r={create:function(e,o,t,n){var a=void 0;if(t){var i=new Date;i.setTime(i.getTime()+60*t*1e3),a="; expires="+i.toGMTString()}else a="";n=n?"domain="+n+";":"",document.cookie=e+"="+o+a+";"+n+"path=/"},read:function(e){for(var o=e+"=",t=document.cookie.split(";"),n=0;n<t.length;n++){for(var a=t[n];" "===a.charAt(0);)a=a.substring(1,a.length);if(0===a.indexOf(o))return a.substring(o.length,a.length)}return null},remove:function(e){this.create(e,"",-1)}},u={name:"cookie",lookup:function(e){var o=void 0;if(e.lookupCookie&&"undefined"!=typeof document){var t=r.read(e.lookupCookie);t&&(o=t)}return o},cacheUserLanguage:function(e,o){o.lookupCookie&&"undefined"!=typeof document&&r.create(o.lookupCookie,e,o.cookieMinutes,o.cookieDomain)}},c={name:"querystring",lookup:function(e){var o=void 0;if("undefined"!=typeof window)for(var t=window.location.search.substring(1),n=t.split("&"),a=0;a<n.length;a++){var i=n[a].indexOf("=");if(i>0){var r=n[a].substring(0,i);r===e.lookupQuerystring&&(o=n[a].substring(i+1))}}return o}},l=void 0;try{l="undefined"!==window&&null!==window.localStorage;window.localStorage.setItem("i18next.translate.boo","foo"),window.localStorage.removeItem("i18next.translate.boo")}catch(e){l=!1}var s={name:"localStorage",lookup:function(e){var o=void 0;if(e.lookupLocalStorage&&l){var t=window.localStorage.getItem(e.lookupLocalStorage);t&&(o=t)}return o},cacheUserLanguage:function(e,o){o.lookupLocalStorage&&l&&window.localStorage.setItem(o.lookupLocalStorage,e)}},d={name:"navigator",lookup:function(e){var o=[];if("undefined"!=typeof navigator){if(navigator.languages)for(var t=0;t<navigator.languages.length;t++)o.push(navigator.languages[t]);navigator.userLanguage&&o.push(navigator.userLanguage),navigator.language&&o.push(navigator.language)}return o.length>0?o:void 0}},f={name:"htmlTag",lookup:function(e){var o=void 0,t=e.htmlTag||("undefined"!=typeof document?document.documentElement:null);return t&&"function"==typeof t.getAttribute&&(o=t.getAttribute("lang")),o}},g={name:"path",lookup:function(e){var o=void 0;if("undefined"!=typeof window){var t=window.location.pathname.match(/\/([a-zA-Z-]*)/g);if(t instanceof Array)if("number"==typeof e.lookupFromPathIndex){if("string"!=typeof t[e.lookupFromPathIndex])return;o=t[e.lookupFromPathIndex].replace("/","")}else o=t[0].replace("/","")}return o}},p={name:"subdomain",lookup:function(e){var o=void 0;if("undefined"!=typeof window){var t=window.location.href.match(/(?:http[s]*\:\/\/)*(.*?)\.(?=[^\/]*\..{2,5})/gi);t instanceof Array&&(o="number"==typeof e.lookupFromSubdomainIndex?t[e.lookupFromSubdomainIndex].replace("http://","").replace("https://","").replace(".",""):t[0].replace("http://","").replace("https://","").replace(".",""))}return o}},h=function(){function e(e,o){for(var t=0;t<o.length;t++){var n=o[t];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(o,t,n){return t&&e(o.prototype,t),n&&e(o,n),o}}(),v=function(){function n(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};o(this,n),this.type="languageDetector",this.detectors={},this.init(e,t)}return h(n,[{key:"init",value:function(o){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{},a=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};this.services=o,this.options=e(n,this.options||{},t()),this.options.lookupFromUrlIndex&&(this.options.lookupFromPathIndex=this.options.lookupFromUrlIndex),this.i18nOptions=a,this.addDetector(u),this.addDetector(c),this.addDetector(s),this.addDetector(d),this.addDetector(f),this.addDetector(g),this.addDetector(p)}},{key:"addDetector",value:function(e){this.detectors[e.name]=e}},{key:"detect",value:function(e){var o=this;e||(e=this.options.order);var t=[];e.forEach(function(e){if(o.detectors[e]){var n=o.detectors[e].lookup(o.options);n&&"string"==typeof n&&(n=[n]),n&&(t=t.concat(n))}});var n=void 0;if(t.forEach(function(e){if(!n){var t=o.services.languageUtils.formatLanguageCode(e);o.services.languageUtils.isWhitelisted(t)&&(n=t)}}),!n){var a=this.i18nOptions.fallbackLng;"string"==typeof a&&(a=[a]),a||(a=[]),n="[object Array]"===Object.prototype.toString.apply(a)?a[0]:a[0]||a.default&&a.default[0]}return n}},{key:"cacheUserLanguage",value:function(e,o){var t=this;o||(o=this.options.caches),o&&(this.options.excludeCacheFor&&this.options.excludeCacheFor.indexOf(e)>-1||o.forEach(function(o){t.detectors[o]&&t.detectors[o].cacheUserLanguage(e,t.options)}))}}]),n}();return v.type="languageDetector",v});

// I18n Jquery
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):t.jqueryI18next=e()}(this,function(){"use strict";function t(t,a){function i(n,a,i){function r(t,n){return f.parseDefaultValueFromContent?e({},t,{defaultValue:n}):t}if(0!==a.length){var o="text";if(0===a.indexOf("[")){var l=a.split("]");a=l[1],o=l[0].substr(1,l[0].length-1)}if(a.indexOf(";")===a.length-1&&(a=a.substr(0,a.length-2)),"html"===o)n.html(t.t(a,r(i,n.html())));else if("text"===o)n.text(t.t(a,r(i,n.text())));else if("prepend"===o)n.prepend(t.t(a,r(i,n.html())));else if("append"===o)n.append(t.t(a,r(i,n.html())));else if(0===o.indexOf("data-")){var s=o.substr("data-".length),d=t.t(a,r(i,n.data(s)));n.data(s,d),n.attr(o,d)}else n.attr(o,t.t(a,r(i,n.attr(o))))}}function r(t,n){var r=t.attr(f.selectorAttr);if(r||void 0===r||!1===r||(r=t.text()||t.val()),r){var o=t,l=t.data(f.targetAttr);if(l&&(o=t.find(l)||t),n||!0!==f.useOptionsAttr||(n=t.data(f.optionsAttr)),n=n||{},r.indexOf(";")>=0){var s=r.split(";");a.each(s,function(t,e){""!==e&&i(o,e.trim(),n)})}else i(o,r,n);if(!0===f.useOptionsAttr){var d={};d=e({clone:d},n),delete d.lng,t.data(f.optionsAttr,d)}}}function o(t){return this.each(function(){r(a(this),t),a(this).find("["+f.selectorAttr+"]").each(function(){r(a(this),t)})})}var f=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};f=e({},n,f),a[f.tName]=t.t.bind(t),a[f.i18nName]=t,a.fn[f.handleName]=o}var e=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var a in n)Object.prototype.hasOwnProperty.call(n,a)&&(t[a]=n[a])}return t},n={tName:"t",i18nName:"i18n",handleName:"localize",selectorAttr:"data-i18n",targetAttr:"i18n-target",optionsAttr:"i18n-options",useOptionsAttr:!1,parseDefaultValueFromContent:!0};return{init:t}});



(function (window, document, $) {
  'use strict';
  var $html = $('html');
  var $body = $('body');


  $(window).on('load', function () {
    var rtl;
    var compactMenu = false; // Set it to true, if you want default menu to be compact

    if ($body.hasClass("menu-collapsed")) {
      compactMenu = true;
    }

    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    }

    setTimeout(function () {
      $html.removeClass('loading').addClass('loaded');
    }, 1200);

    $.app.menu.init(compactMenu);

    // Navigation configurations
    var config = {
      speed: 300 // set speed to expand / collpase menu
    };
    if ($.app.nav.initialized === false) {
      $.app.nav.init(config);
    }

    Unison.on('change', function (bp) {
      $.app.menu.change();
    });

    // Tooltip Initialization
    $('[data-toggle="tooltip"]').tooltip({
      container: 'body'
    });

    // Top Navbars - Hide on Scroll
    if ($(".navbar-hide-on-scroll").length > 0) {
      $(".navbar-hide-on-scroll.fixed-top").headroom({
        "offset": 205,
        "tolerance": 5,
        "classes": {
          // when element is initialised
          initial: "headroom",
          // when scrolling up
          pinned: "headroom--pinned-top",
          // when scrolling down
          unpinned: "headroom--unpinned-top",
        }
      });
      // Bottom Navbars - Hide on Scroll
      $(".navbar-hide-on-scroll.fixed-bottom").headroom({
        "offset": 205,
        "tolerance": 5,
        "classes": {
          // when element is initialised
          initial: "headroom",
          // when scrolling up
          pinned: "headroom--pinned-bottom",
          // when scrolling down
          unpinned: "headroom--unpinned-bottom",
        }
      });
    }

    //Match content & menu height for content menu
    setTimeout(function () {
      if ($('body').hasClass('vertical-content-menu')) {
        setContentMenuHeight();
      }
    }, 500);

    function setContentMenuHeight() {
      var menuHeight = $('.main-menu').height();
      var bodyHeight = $('.content-body').height();
      if (bodyHeight < menuHeight) {
        $('.content-body').css('height', menuHeight);
      }
    }

    // Collapsible Card
    $('a[data-action="collapse"]').on('click', function (e) {
      e.preventDefault();
      $(this).closest('.card').children('.card-content').collapse('toggle');
      $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ft-plus ft-minus');

    });

    // Toggle fullscreen
    $('a[data-action="expand"]').on('click', function (e) {
      e.preventDefault();
      $(this).closest('.card').find('[data-action="expand"] i').toggleClass('ft-maximize ft-minimize');
      $(this).closest('.card').toggleClass('card-fullscreen');
    });

    //  Notifications & messages scrollable
    if ($('.scrollable-container').length > 0) {
      $('.scrollable-container').each(function () {
        var scrollable_container = new PerfectScrollbar($(this)[0], {
          wheelPropagation: false
        });

      });
    }

    // Reload Card
    $('a[data-action="reload"]').on('click', function () {
      var block_ele = $(this).closest('.card');

      // Block Element
      block_ele.block({
        message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
        timeout: 2000, //unblock after 2 seconds
        overlayCSS: {
          backgroundColor: '#FFF',
          cursor: 'wait',
        },
        css: {
          border: 0,
          padding: 0,
          backgroundColor: 'none'
        }
      });
    });

    // Close Card
    $('a[data-action="close"]').on('click', function () {
      $(this).closest('.card').removeClass().slideUp('fast');
    });

    // Match the height of each card in a row
    setTimeout(function () {
      $('.row.match-height').each(function () {
        $(this).find('.card').not('.card .card').matchHeight(); // Not .card .card prevents collapsible cards from taking height
      });
    }, 500);


    $('.card .heading-elements a[data-action="collapse"]').on('click', function () {
      var $this = $(this),
        card = $this.closest('.card');
      var cardHeight;

      if (parseInt(card[0].style.height, 10) > 0) {
        cardHeight = card.css('height');
        card.css('height', '').attr('data-height', cardHeight);
      } else {
        if (card.data('height')) {
          cardHeight = card.data('height');
          card.css('height', cardHeight).attr('data-height', '');
        }
      }
    });

    // Add Menu Collapsed Open class to the parents of active menu item
    $(".main-menu-content")
      .find("li.active")
      .parents("li")
      .addClass("menu-collapsed-open")

    // Add open class to parent list item if subitem is active except compact menu
    var menuType = $body.data('menu');
    if (menuType != 'vertical-compact-menu' && menuType != 'horizontal-menu' && compactMenu === false) {
       $(".main-menu-content").find('li.active').parents('li').addClass('open');
    }
    if (menuType == 'vertical-compact-menu' || menuType == 'horizontal-menu') {
      $(".main-menu-content").find('li.active').parents('li:not(.nav-item)').addClass('open');
      $(".main-menu-content").find('li.active').parents('li').addClass('active');
    }

    //card heading actions buttons small screen support
    $(".heading-elements-toggle").on("click", function () {
      $(this).parent().children(".heading-elements").toggleClass("visible");
    });

    //  Dynamic height for the chartjs div for the chart animations to work
    var chartjsDiv = $('.chartjs'),
      canvasHeight = chartjsDiv.children('canvas').attr('height');
    chartjsDiv.css('height', canvasHeight);


    /************** search *******************/
    var $filename = $(".search-input input").data("search")
    // Navigation Search area Open
    $(".nav-link-search").on("click", function () {
      var $this = $(this)
      var searchInput = $(this)
        .parent(".nav-search")
        .find(".search-input")
      searchInput.addClass("open");
      setTimeout(function () {
        $(".search-input.open .input").focus()
      }, 50)
      $(".search-input .search-list li").remove()
      $(".search-input .search-list").addClass("show")
    })

    // Navigation Search area Close
    $(".search-input-close i").on("click", function () {
      var $this = $(this),
        searchInput = $(this).closest(".search-input")
      if (searchInput.hasClass("open")) {
        searchInput.removeClass("open")
        $(".search-input input").val("")
        $(".search-input input").blur()
        $(".search-input .search-list").removeClass("show")
        if ($(".app-content").hasClass("show-overlay")) {
          $(".app-content").removeClass("show-overlay")
        }
      }
    })

    // Navigation Search area Close on click of app-content
    $(".app-content").on("click", function () {
      var $this = $(".search-input-close"),
        searchInput = $($this).parent(".search-input"),
        searchList = $(".search-list")
      if (searchInput.hasClass("open")) {
        searchInput.removeClass("open")
      }
      if (searchList.hasClass("show")) {
        searchList.removeClass("show")
      }
      if ($(".app-content").hasClass("show-overlay")) {
        $(".app-content").removeClass("show-overlay")
      }
    })

    // Filter
    $(".search-input .input").on("keyup", function (e) {

      if (e.keyCode !== 38 && e.keyCode !== 40 && e.keyCode !== 13) {
        if (e.keyCode == 27) {
          // $(".app-content").removeClass("show-overlay")

          $(".search-input input").val("")
          $(".search-input input").blur()
          $(".search-input").removeClass("open")
          if ($(".search-list").hasClass("show")) {
            $(this).removeClass("show")
            $(".search-input").removeClass("show")
          }
        }

        // Define variables
        var value = $(this)
          .val()
          .toLowerCase(), //get values of inout on keyup
          activeClass = "",
          liList = $("ul.search-list li") // get all the list items of the search
        liList.remove()

        // If input value is blank
        if (value != "") {
          $(".app-content").addClass("show-overlay")


          var $startList = "",
            $otherList = "",
            $htmlList = "",
            $activeItemClass = "",
            a = 0

          // getting json data from file for search results
          $.getJSON("../../../app-assets/data/" + $filename + ".json", function (
            data
          ) {
            for (var i = 0; i < data.listItems.length; i++) {

              // Search list item start with entered letters and create list
              if (
                data.listItems[i].name.toLowerCase().indexOf(value) == 0 &&
                a < 10 || !(data.listItems[i].name.toLowerCase().indexOf(value) == 0) &&
                data.listItems[i].name.toLowerCase().indexOf(value) > -1 &&
                a < 10
              ) {
                if (a === 0) {
                  $activeItemClass = "current_item"
                } else {
                  $activeItemClass = ""
                }
                $startList +=
                  '<li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer ' +
                  $activeItemClass +
                  '">' +
                  '<a class="d-flex align-items-center justify-content-between w-100" href=' +
                  data.listItems[i].url +
                  ">" +
                  '<div class="d-flex justify-content-start">' +
                  '<span class="mr-75 ' +
                  data.listItems[i].icon +
                  '"></span>' +
                  "<span>" +
                  data.listItems[i].name +
                  "</span>" +
                  "</div>"
                a++
              }
            }
            if ($startList == "" && $otherList == "") {
              $otherList =
                '<li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer">' +
                '<a class="d-flex align-items-center justify-content-between w-100">' +
                '<div class="d-flex justify-content-start">' +
                '<span class="mr-75"></span>' +
                "<span>No results found.</span>" +
                "</div>" +
                "</a>" +
                "</li>"
            }

            $htmlList = $startList.concat($otherList) // merging start with and other list
            $("ul.search-list").html($htmlList) // Appending list to <ul>
          })
        } else {
          // if search input blank, hide overlay
          if ($(".app-content").hasClass("show-overlay")) {
            $(".app-content").removeClass("show-overlay")
          }
        }
      }
    })

    // If we use up key(38) Down key (40) or Enter key(13)
    $(window).on("keydown", function (e) {
      var $current = $(".search-list li.current_item"),
        $next,
        $prev
      if (e.keyCode === 40) {
        $next = $current.next()
        $current.removeClass("current_item")
        $current = $next.addClass("current_item")
      } else if (e.keyCode === 38) {
        $prev = $current.prev()
        $current.removeClass("current_item")
        $current = $prev.addClass("current_item")
      }

      if (e.keyCode === 13 && $(".search-list li.current_item").length > 0) {
        var selected_item = $(".search-list li.current_item a")
        window.location = selected_item.attr("href")
        $(selected_item).trigger("click")
      }
    })

    // Add class on hover of the list
    $(document).on("mouseenter", ".search-list li", function (e) {
      $(this)
        .siblings()
        .removeClass("current_item")
      $(this).addClass("current_item")
    })
    $(document).on("click", ".search-list li", function (e) {
      e.stopPropagation()
    })
  });

  // Hide overlay menu on content overlay click on small screens
  $(document).on('click', '.sidenav-overlay', function (e) {
    // Hide menu
    $.app.menu.hide();
    return false;
  });

  // Execute below code only if we find hammer js for touch swipe feature on small screen
  if (typeof Hammer !== 'undefined') {

    var rtl;
    if ($('html').data('textdirection') == 'rtl') {
      rtl = true;
    }

    // Swipe menu gesture
    var swipeInElement = document.querySelector('.drag-target'),
    swipeInAction = 'panright',
    swipeOutAction = 'panleft';

    if(rtl === true){
      swipeInAction = 'panleft';
      swipeOutAction = 'panright';
    }

    if ($(swipeInElement).length > 0) {
      var swipeInMenu = new Hammer(swipeInElement);

      swipeInMenu.on(swipeInAction, function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.open();
          return false;
        }
      });
    }

    // menu swipe out gesture
    setTimeout(function () {
      var swipeOutElement = document.querySelector('.main-menu');
      var swipeOutMenu;

      if ($(swipeOutElement).length > 0) {
        swipeOutMenu = new Hammer(swipeOutElement);

        swipeOutMenu.get('pan').set({
          direction: Hammer.DIRECTION_ALL,
          threshold: 100
        });

        swipeOutMenu.on(swipeOutAction, function (ev) {
          if ($body.hasClass('vertical-overlay-menu')) {
            $.app.menu.hide();
            return false;
          }
        });
      }
    }, 300);

    // menu overlay swipe out gestrue
    var swipeOutOverlayElement = document.querySelector('.sidenav-overlay');

    if ($(swipeOutOverlayElement).length > 0) {

      var swipeOutOverlayMenu = new Hammer(swipeOutOverlayElement);

      swipeOutOverlayMenu.on(swipeOutAction, function (ev) {
        if ($body.hasClass('vertical-overlay-menu')) {
          $.app.menu.hide();
          return false;
        }
      });
    }
  }

  $(document).on('click', '.menu-toggle, .modern-nav-toggle', function (e) {
    e.preventDefault();

    // Hide dropdown of user profile section for material templates
    if ($('.user-profile .user-info .dropdown').hasClass('show')) {
      $('.user-profile .user-info .dropdown').removeClass('show');
      $('.user-profile .user-info .dropdown .dropdown-menu').removeClass('show');
    }

    // Toggle menu
    $.app.menu.toggle();

    setTimeout(function () {
      $(window).trigger("resize");
    }, 200);

    if ($('#collapsed-sidebar').length > 0) {
      setTimeout(function () {
        if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
          $('#collapsed-sidebar').prop('checked', false);
        } else {
          $('#collapsed-sidebar').prop('checked', true);
        }
      }, 1000);
    }

    // Hides dropdown on click of menu toggle
    // $('[data-toggle="dropdown"]').dropdown('hide');

    // Hides collapse dropdown on click of menu toggle
    if ($('.vertical-overlay-menu .navbar-with-menu .navbar-container .navbar-collapse').hasClass('show')) {
      $('.vertical-overlay-menu .navbar-with-menu .navbar-container .navbar-collapse').removeClass('show');
    }

    return false;
  });

  $(document).on('click', '.open-navbar-container', function (e) {

    var currentBreakpoint = Unison.fetch.now();
  });

  // Add Children Class
  $('.navigation').find('li').has('ul').addClass('has-sub');

  $('.carousel').carousel({
    interval: 2000
  });

  // Page full screen
  $('.nav-link-expand').on('click', function (e) {
    if (typeof screenfull != 'undefined') {
      if (screenfull.isEnabled) {
        screenfull.toggle();
      }
    }
  });
  if (typeof screenfull != 'undefined') {
    if (screenfull.isEnabled) {
      $(document).on(screenfull.raw.fullscreenchange, function () {
        if (screenfull.isFullscreen) {
          $('.nav-link-expand').find('i').toggleClass('ft-minimize ft-maximize');
        } else {
          $('.nav-link-expand').find('i').toggleClass('ft-maximize ft-minimize');
        }
      });
    }
  }

  $(document).on('click', '.mega-dropdown-menu', function (e) {
    e.stopPropagation();
  });

  $(document).ready(function () {

    /**********************************
     *   Form Wizard Step Icon
     **********************************/
    $('.step-icon').each(function () {
      var $this = $(this);
      if ($this.siblings('span.step').length > 0) {
        $this.siblings('span.step').empty();
        $(this).appendTo($(this).siblings('span.step'));
      }
    });
  });

  // Update manual scroller when window is resized
  $(window).resize(function () {
    $.app.menu.manualScroller.updateHeight();
    // clear search if width is greater than 768
    if ($(window).width() > 768) {
      $(".search-input input").val("")
      $(".search-input input").blur()
      $(".search-input").removeClass("open")
      if ($(".header-navbar").find(".search-list.show")) {
        $(".header-navbar").find(".search-list.show").removeClass("show")
      }
      $(".app-content").removeClass("show-overlay")
    }
  });

  $('#sidebar-page-navigation').on('click', 'a.nav-link', function (e) {
    e.preventDefault();
    e.stopPropagation();
    var $this = $(this),
      href = $this.attr('href');
    var offset = $(href).offset();
    var scrollto = offset.top - 80; // minus fixed header height
    $('html, body').animate({
      scrollTop: scrollto
    }, 0);
    setTimeout(function () {
      $this.parent('.nav-item').siblings('.nav-item').children('.nav-link').removeClass('active');
      $this.addClass('active');
    }, 100);
  });
  // main menu internationalization

  // init i18n and load language file
  i18next
    .use(window.i18nextXHRBackend)
    .init({
      debug: false,
      fallbackLng: "en",
      backend: {
        loadPath: "../../../app-assets/data/locales/{{lng}}.json",
      },
      returnObjects: true
    },
      function (err, t) {
        // resources have been loaded
        jqueryI18next.init(i18next, $);
      });

  // change language according to data-language of dropdown item
  $(".dropdown-language .dropdown-item").on("click", function () {
    var $this = $(this);
    $this.siblings(".selected").removeClass("selected")
    $this.addClass("selected");
    var selectedLang = $this.text()
    var selectedFlag = $this.find(".flag-icon").attr("class");
    $("#dropdown-flag .selected-language").text(selectedLang);
    $("#dropdown-flag .flag-icon").removeClass().addClass(selectedFlag);
    var currentLanguage = $this.data("language");
    i18next.changeLanguage(currentLanguage, function (err, t) {
      $(".main-menu , .navbar-horizontal").localize();
    });
  })
})(window, document, jQuery);
