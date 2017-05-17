/* Modernizr 2.6.2 (Custom Build) | MIT & BSD
 * Build: http://modernizr.com/download/#-fontface-backgroundsize-borderimage-borderradius-boxshadow-flexbox-flexboxlegacy-hsla-multiplebgs-opacity-rgba-textshadow-cssanimations-csscolumns-generatedcontent-cssgradients-cssreflections-csstransforms-csstransforms3d-csstransitions-applicationcache-canvas-canvastext-draganddrop-hashchange-history-audio-video-indexeddb-input-inputtypes-localstorage-postmessage-sessionstorage-websockets-websqldatabase-webworkers-geolocation-inlinesvg-smil-svg-svgclippaths-touch-webgl-shiv-cssclasses-teststyles-testprop-testallprops-hasevent-prefixes-domprefixes-load
 */
;window.Modernizr=function(a,b,c){function C(a){j.cssText=a}function D(a,b){return C(n.join(a+";")+(b||""))}function E(a,b){return typeof a===b}function F(a,b){return!!~(""+a).indexOf(b)}function G(a,b){for(var d in a){var e=a[d];if(!F(e,"-")&&j[e]!==c)return b=="pfx"?e:!0}return!1}function H(a,b,d){for(var e in a){var f=b[a[e]];if(f!==c)return d===!1?a[e]:E(f,"function")?f.bind(d||b):f}return!1}function I(a,b,c){var d=a.charAt(0).toUpperCase()+a.slice(1),e=(a+" "+p.join(d+" ")+d).split(" ");return E(b,"string")||E(b,"undefined")?G(e,b):(e=(a+" "+q.join(d+" ")+d).split(" "),H(e,b,c))}function J(){e.input=function(c){for(var d=0,e=c.length;d<e;d++)u[c[d]]=c[d]in k;return u.list&&(u.list=!!b.createElement("datalist")&&!!a.HTMLDataListElement),u}("autocomplete autofocus list placeholder max min multiple pattern required step".split(" ")),e.inputtypes=function(a){for(var d=0,e,f,h,i=a.length;d<i;d++)k.setAttribute("type",f=a[d]),e=k.type!=="text",e&&(k.value=l,k.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(f)&&k.style.WebkitAppearance!==c?(g.appendChild(k),h=b.defaultView,e=h.getComputedStyle&&h.getComputedStyle(k,null).WebkitAppearance!=="textfield"&&k.offsetHeight!==0,g.removeChild(k)):/^(search|tel)$/.test(f)||(/^(url|email)$/.test(f)?e=k.checkValidity&&k.checkValidity()===!1:e=k.value!=l)),t[a[d]]=!!e;return t}("search tel url email datetime date month week time datetime-local number range color".split(" "))}var d="2.6.2",e={},f=!0,g=b.documentElement,h="modernizr",i=b.createElement(h),j=i.style,k=b.createElement("input"),l=":)",m={}.toString,n=" -webkit- -moz- -o- -ms- ".split(" "),o="Webkit Moz O ms",p=o.split(" "),q=o.toLowerCase().split(" "),r={svg:"http://www.w3.org/2000/svg"},s={},t={},u={},v=[],w=v.slice,x,y=function(a,c,d,e){var f,i,j,k,l=b.createElement("div"),m=b.body,n=m||b.createElement("body");if(parseInt(d,10))while(d--)j=b.createElement("div"),j.id=e?e[d]:h+(d+1),l.appendChild(j);return f=["&#173;",'<style id="s',h,'">',a,"</style>"].join(""),l.id=h,(m?l:n).innerHTML+=f,n.appendChild(l),m||(n.style.background="",n.style.overflow="hidden",k=g.style.overflow,g.style.overflow="hidden",g.appendChild(n)),i=c(l,a),m?l.parentNode.removeChild(l):(n.parentNode.removeChild(n),g.style.overflow=k),!!i},z=function(){function d(d,e){e=e||b.createElement(a[d]||"div"),d="on"+d;var f=d in e;return f||(e.setAttribute||(e=b.createElement("div")),e.setAttribute&&e.removeAttribute&&(e.setAttribute(d,""),f=E(e[d],"function"),E(e[d],"undefined")||(e[d]=c),e.removeAttribute(d))),e=null,f}var a={select:"input",change:"input",submit:"form",reset:"form",error:"img",load:"img",abort:"img"};return d}(),A={}.hasOwnProperty,B;!E(A,"undefined")&&!E(A.call,"undefined")?B=function(a,b){return A.call(a,b)}:B=function(a,b){return b in a&&E(a.constructor.prototype[b],"undefined")},Function.prototype.bind||(Function.prototype.bind=function(b){var c=this;if(typeof c!="function")throw new TypeError;var d=w.call(arguments,1),e=function(){if(this instanceof e){var a=function(){};a.prototype=c.prototype;var f=new a,g=c.apply(f,d.concat(w.call(arguments)));return Object(g)===g?g:f}return c.apply(b,d.concat(w.call(arguments)))};return e}),s.flexbox=function(){return I("flexWrap")},s.flexboxlegacy=function(){return I("boxDirection")},s.canvas=function(){var a=b.createElement("canvas");return!!a.getContext&&!!a.getContext("2d")},s.canvastext=function(){return!!e.canvas&&!!E(b.createElement("canvas").getContext("2d").fillText,"function")},s.webgl=function(){return!!a.WebGLRenderingContext},s.touch=function(){var c;return"ontouchstart"in a||a.DocumentTouch&&b instanceof DocumentTouch?c=!0:y(["@media (",n.join("touch-enabled),("),h,")","{#modernizr{top:9px;position:absolute}}"].join(""),function(a){c=a.offsetTop===9}),c},s.geolocation=function(){return"geolocation"in navigator},s.postmessage=function(){return!!a.postMessage},s.websqldatabase=function(){return!!a.openDatabase},s.indexedDB=function(){return!!I("indexedDB",a)},s.hashchange=function(){return z("hashchange",a)&&(b.documentMode===c||b.documentMode>7)},s.history=function(){return!!a.history&&!!history.pushState},s.draganddrop=function(){var a=b.createElement("div");return"draggable"in a||"ondragstart"in a&&"ondrop"in a},s.websockets=function(){return"WebSocket"in a||"MozWebSocket"in a},s.rgba=function(){return C("background-color:rgba(150,255,150,.5)"),F(j.backgroundColor,"rgba")},s.hsla=function(){return C("background-color:hsla(120,40%,100%,.5)"),F(j.backgroundColor,"rgba")||F(j.backgroundColor,"hsla")},s.multiplebgs=function(){return C("background:url(https://),url(https://),red url(https://)"),/(url\s*\(.*?){3}/.test(j.background)},s.backgroundsize=function(){return I("backgroundSize")},s.borderimage=function(){return I("borderImage")},s.borderradius=function(){return I("borderRadius")},s.boxshadow=function(){return I("boxShadow")},s.textshadow=function(){return b.createElement("div").style.textShadow===""},s.opacity=function(){return D("opacity:.55"),/^0.55$/.test(j.opacity)},s.cssanimations=function(){return I("animationName")},s.csscolumns=function(){return I("columnCount")},s.cssgradients=function(){var a="background-image:",b="gradient(linear,left top,right bottom,from(#9f9),to(white));",c="linear-gradient(left top,#9f9, white);";return C((a+"-webkit- ".split(" ").join(b+a)+n.join(c+a)).slice(0,-a.length)),F(j.backgroundImage,"gradient")},s.cssreflections=function(){return I("boxReflect")},s.csstransforms=function(){return!!I("transform")},s.csstransforms3d=function(){var a=!!I("perspective");return a&&"webkitPerspective"in g.style&&y("@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}",function(b,c){a=b.offsetLeft===9&&b.offsetHeight===3}),a},s.csstransitions=function(){return I("transition")},s.fontface=function(){var a;return y('@font-face {font-family:"font";src:url("https://")}',function(c,d){var e=b.getElementById("smodernizr"),f=e.sheet||e.styleSheet,g=f?f.cssRules&&f.cssRules[0]?f.cssRules[0].cssText:f.cssText||"":"";a=/src/i.test(g)&&g.indexOf(d.split(" ")[0])===0}),a},s.generatedcontent=function(){var a;return y(["#",h,"{font:0/0 a}#",h,':after{content:"',l,'";visibility:hidden;font:3px/1 a}'].join(""),function(b){a=b.offsetHeight>=3}),a},s.video=function(){var a=b.createElement("video"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('video/ogg; codecs="theora"').replace(/^no$/,""),c.h264=a.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/,""),c.webm=a.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/,"")}catch(d){}return c},s.audio=function(){var a=b.createElement("audio"),c=!1;try{if(c=!!a.canPlayType)c=new Boolean(c),c.ogg=a.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/,""),c.mp3=a.canPlayType("audio/mpeg;").replace(/^no$/,""),c.wav=a.canPlayType('audio/wav; codecs="1"').replace(/^no$/,""),c.m4a=(a.canPlayType("audio/x-m4a;")||a.canPlayType("audio/aac;")).replace(/^no$/,"")}catch(d){}return c},s.localstorage=function(){try{return localStorage.setItem(h,h),localStorage.removeItem(h),!0}catch(a){return!1}},s.sessionstorage=function(){try{return sessionStorage.setItem(h,h),sessionStorage.removeItem(h),!0}catch(a){return!1}},s.webworkers=function(){return!!a.Worker},s.applicationcache=function(){return!!a.applicationCache},s.svg=function(){return!!b.createElementNS&&!!b.createElementNS(r.svg,"svg").createSVGRect},s.inlinesvg=function(){var a=b.createElement("div");return a.innerHTML="<svg/>",(a.firstChild&&a.firstChild.namespaceURI)==r.svg},s.smil=function(){return!!b.createElementNS&&/SVGAnimate/.test(m.call(b.createElementNS(r.svg,"animate")))},s.svgclippaths=function(){return!!b.createElementNS&&/SVGClipPath/.test(m.call(b.createElementNS(r.svg,"clipPath")))};for(var K in s)B(s,K)&&(x=K.toLowerCase(),e[x]=s[K](),v.push((e[x]?"":"no-")+x));return e.input||J(),e.addTest=function(a,b){if(typeof a=="object")for(var d in a)B(a,d)&&e.addTest(d,a[d]);else{a=a.toLowerCase();if(e[a]!==c)return e;b=typeof b=="function"?b():b,typeof f!="undefined"&&f&&(g.className+=" "+(b?"":"no-")+a),e[a]=b}return e},C(""),i=k=null,function(a,b){function k(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function l(){var a=r.elements;return typeof a=="string"?a.split(" "):a}function m(a){var b=i[a[g]];return b||(b={},h++,a[g]=h,i[h]=b),b}function n(a,c,f){c||(c=b);if(j)return c.createElement(a);f||(f=m(c));var g;return f.cache[a]?g=f.cache[a].cloneNode():e.test(a)?g=(f.cache[a]=f.createElem(a)).cloneNode():g=f.createElem(a),g.canHaveChildren&&!d.test(a)?f.frag.appendChild(g):g}function o(a,c){a||(a=b);if(j)return a.createDocumentFragment();c=c||m(a);var d=c.frag.cloneNode(),e=0,f=l(),g=f.length;for(;e<g;e++)d.createElement(f[e]);return d}function p(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return r.shivMethods?n(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+l().join().replace(/\w+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(r,b.frag)}function q(a){a||(a=b);var c=m(a);return r.shivCSS&&!f&&!c.hasCSS&&(c.hasCSS=!!k(a,"article,aside,figcaption,figure,footer,header,hgroup,nav,section{display:block}mark{background:#FF0;color:#000}")),j||p(a,c),a}var c=a.html5||{},d=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,e=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,f,g="_html5shiv",h=0,i={},j;(function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",f="hidden"in a,j=a.childNodes.length==1||function(){b.createElement("a");var a=b.createDocumentFragment();return typeof a.cloneNode=="undefined"||typeof a.createDocumentFragment=="undefined"||typeof a.createElement=="undefined"}()}catch(c){f=!0,j=!0}})();var r={elements:c.elements||"abbr article aside audio bdi canvas data datalist details figcaption figure footer header hgroup mark meter nav output progress section summary time video",shivCSS:c.shivCSS!==!1,supportsUnknownElements:j,shivMethods:c.shivMethods!==!1,type:"default",shivDocument:q,createElement:n,createDocumentFragment:o};a.html5=r,q(b)}(this,b),e._version=d,e._prefixes=n,e._domPrefixes=q,e._cssomPrefixes=p,e.hasEvent=z,e.testProp=function(a){return G([a])},e.testAllProps=I,e.testStyles=y,g.className=g.className.replace(/(^|\s)no-js(\s|$)/,"$1$2")+(f?" js "+v.join(" "):""),e}(this,this.document),function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}}(this,document),Modernizr.load=function(){yepnope.apply(window,[].slice.call(arguments,0))};
/*!
 * Bootstrap v3.1.1 (http://getbootstrap.com)
 * Copyright 2011-2014 Twitter, Inc.
 * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one(a.support.transition.end,function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b()})}(jQuery),+function(a){"use strict";var b='[data-dismiss="alert"]',c=function(c){a(c).on("click",b,this.close)};c.prototype.close=function(b){function c(){f.trigger("closed.bs.alert").remove()}var d=a(this),e=d.attr("data-target");e||(e=d.attr("href"),e=e&&e.replace(/.*(?=#[^\s]*$)/,""));var f=a(e);b&&b.preventDefault(),f.length||(f=d.hasClass("alert")?d:d.parent()),f.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one(a.support.transition.end,c).emulateTransitionEnd(150):c())};var d=a.fn.alert;a.fn.alert=function(b){return this.each(function(){var d=a(this),e=d.data("bs.alert");e||d.data("bs.alert",e=new c(this)),"string"==typeof b&&e[b].call(d)})},a.fn.alert.Constructor=c,a.fn.alert.noConflict=function(){return a.fn.alert=d,this},a(document).on("click.bs.alert.data-api",b,c.prototype.close)}(jQuery),+function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.DEFAULTS,d),this.isLoading=!1};b.DEFAULTS={loadingText:"loading..."},b.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",f.resetText||d.data("resetText",d[e]()),d[e](f[b]||this.options[b]),setTimeout(a.proxy(function(){"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},b.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")&&(c.prop("checked")&&this.$element.hasClass("active")?a=!1:b.find(".active").removeClass("active")),a&&c.prop("checked",!this.$element.hasClass("active")).trigger("change")}a&&this.$element.toggleClass("active")};var c=a.fn.button;a.fn.button=function(c){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof c&&c;e||d.data("bs.button",e=new b(this,f)),"toggle"==c?e.toggle():c&&e.setState(c)})},a.fn.button.Constructor=b,a.fn.button.noConflict=function(){return a.fn.button=c,this},a(document).on("click.bs.button.data-api","[data-toggle^=button]",function(b){var c=a(b.target);c.hasClass("btn")||(c=c.closest(".btn")),c.button("toggle"),b.preventDefault()})}(jQuery),+function(a){"use strict";var b=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=this.sliding=this.interval=this.$active=this.$items=null,"hover"==this.options.pause&&this.$element.on("mouseenter",a.proxy(this.pause,this)).on("mouseleave",a.proxy(this.cycle,this))};b.DEFAULTS={interval:5e3,pause:"hover",wrap:!0},b.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},b.prototype.getActiveIndex=function(){return this.$active=this.$element.find(".item.active"),this.$items=this.$active.parent().children(),this.$items.index(this.$active)},b.prototype.to=function(b){var c=this,d=this.getActiveIndex();return b>this.$items.length-1||0>b?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){c.to(b)}):d==b?this.pause().cycle():this.slide(b>d?"next":"prev",a(this.$items[b]))},b.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},b.prototype.next=function(){return this.sliding?void 0:this.slide("next")},b.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},b.prototype.slide=function(b,c){var d=this.$element.find(".item.active"),e=c||d[b](),f=this.interval,g="next"==b?"left":"right",h="next"==b?"first":"last",i=this;if(!e.length){if(!this.options.wrap)return;e=this.$element.find(".item")[h]()}if(e.hasClass("active"))return this.sliding=!1;var j=a.Event("slide.bs.carousel",{relatedTarget:e[0],direction:g});return this.$element.trigger(j),j.isDefaultPrevented()?void 0:(this.sliding=!0,f&&this.pause(),this.$indicators.length&&(this.$indicators.find(".active").removeClass("active"),this.$element.one("slid.bs.carousel",function(){var b=a(i.$indicators.children()[i.getActiveIndex()]);b&&b.addClass("active")})),a.support.transition&&this.$element.hasClass("slide")?(e.addClass(b),e[0].offsetWidth,d.addClass(g),e.addClass(g),d.one(a.support.transition.end,function(){e.removeClass([b,g].join(" ")).addClass("active"),d.removeClass(["active",g].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger("slid.bs.carousel")},0)}).emulateTransitionEnd(1e3*d.css("transition-duration").slice(0,-1))):(d.removeClass("active"),e.addClass("active"),this.sliding=!1,this.$element.trigger("slid.bs.carousel")),f&&this.cycle(),this)};var c=a.fn.carousel;a.fn.carousel=function(c){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},b.DEFAULTS,d.data(),"object"==typeof c&&c),g="string"==typeof c?c:f.slide;e||d.data("bs.carousel",e=new b(this,f)),"number"==typeof c?e.to(c):g?e[g]():f.interval&&e.pause().cycle()})},a.fn.carousel.Constructor=b,a.fn.carousel.noConflict=function(){return a.fn.carousel=c,this},a(document).on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",function(b){var c,d=a(this),e=a(d.attr("data-target")||(c=d.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"")),f=a.extend({},e.data(),d.data()),g=d.attr("data-slide-to");g&&(f.interval=!1),e.carousel(f),(g=d.attr("data-slide-to"))&&e.data("bs.carousel").to(g),b.preventDefault()}),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var b=a(this);b.carousel(b.data())})})}(jQuery),+function(a){"use strict";var b=function(c,d){this.$element=a(c),this.options=a.extend({},b.DEFAULTS,d),this.transitioning=null,this.options.parent&&(this.$parent=a(this.options.parent)),this.options.toggle&&this.toggle()};b.DEFAULTS={toggle:!0},b.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},b.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b=a.Event("show.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.$parent&&this.$parent.find("> .panel > .in");if(c&&c.length){var d=c.data("bs.collapse");if(d&&d.transitioning)return;c.collapse("hide"),d||c.data("bs.collapse",null)}var e=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[e](0),this.transitioning=1;var f=function(){this.$element.removeClass("collapsing").addClass("collapse in")[e]("auto"),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return f.call(this);var g=a.camelCase(["scroll",e].join("-"));this.$element.one(a.support.transition.end,a.proxy(f,this)).emulateTransitionEnd(350)[e](this.$element[0][g])}}},b.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"),this.transitioning=1;var d=function(){this.transitioning=0,this.$element.trigger("hidden.bs.collapse").removeClass("collapsing").addClass("collapse")};return a.support.transition?void this.$element[c](0).one(a.support.transition.end,a.proxy(d,this)).emulateTransitionEnd(350):d.call(this)}}},b.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()};var c=a.fn.collapse;a.fn.collapse=function(c){return this.each(function(){var d=a(this),e=d.data("bs.collapse"),f=a.extend({},b.DEFAULTS,d.data(),"object"==typeof c&&c);!e&&f.toggle&&"show"==c&&(c=!c),e||d.data("bs.collapse",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.collapse.Constructor=b,a.fn.collapse.noConflict=function(){return a.fn.collapse=c,this},a(document).on("click.bs.collapse.data-api","[data-toggle=collapse]",function(b){var c,d=a(this),e=d.attr("data-target")||b.preventDefault()||(c=d.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,""),f=a(e),g=f.data("bs.collapse"),h=g?"toggle":d.data(),i=d.attr("data-parent"),j=i&&a(i);g&&g.transitioning||(j&&j.find('[data-toggle=collapse][data-parent="'+i+'"]').not(d).addClass("collapsed"),d[f.hasClass("in")?"addClass":"removeClass"]("collapsed")),f.collapse(h)})}(jQuery),+function(a){"use strict";function b(b){a(d).remove(),a(e).each(function(){var d=c(a(this)),e={relatedTarget:this};d.hasClass("open")&&(d.trigger(b=a.Event("hide.bs.dropdown",e)),b.isDefaultPrevented()||d.removeClass("open").trigger("hidden.bs.dropdown",e))})}function c(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}var d=".dropdown-backdrop",e="[data-toggle=dropdown]",f=function(b){a(b).on("click.bs.dropdown",this.toggle)};f.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=c(e),g=f.hasClass("open");if(b(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click",b);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;f.toggleClass("open").trigger("shown.bs.dropdown",h),e.focus()}return!1}},f.prototype.keydown=function(b){if(/(38|40|27)/.test(b.keyCode)){var d=a(this);if(b.preventDefault(),b.stopPropagation(),!d.is(".disabled, :disabled")){var f=c(d),g=f.hasClass("open");if(!g||g&&27==b.keyCode)return 27==b.which&&f.find(e).focus(),d.click();var h=" li:not(.divider):visible a",i=f.find("[role=menu]"+h+", [role=listbox]"+h);if(i.length){var j=i.index(i.filter(":focus"));38==b.keyCode&&j>0&&j--,40==b.keyCode&&j<i.length-1&&j++,~j||(j=0),i.eq(j).focus()}}}};var g=a.fn.dropdown;a.fn.dropdown=function(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new f(this)),"string"==typeof b&&d[b].call(c)})},a.fn.dropdown.Constructor=f,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=g,this},a(document).on("click.bs.dropdown.data-api",b).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",e,f.prototype.toggle).on("keydown.bs.dropdown.data-api",e+", [role=menu], [role=listbox]",f.prototype.keydown)}(jQuery),+function(a){"use strict";var b=function(b,c){this.options=c,this.$element=a(b),this.$backdrop=this.isShown=null,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};b.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},b.prototype.toggle=function(a){return this[this.isShown?"hide":"show"](a)},b.prototype.show=function(b){var c=this,d=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(d),this.isShown||d.isDefaultPrevented()||(this.isShown=!0,this.escape(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.backdrop(function(){var d=a.support.transition&&c.$element.hasClass("fade");c.$element.parent().length||c.$element.appendTo(document.body),c.$element.show().scrollTop(0),d&&c.$element[0].offsetWidth,c.$element.addClass("in").attr("aria-hidden",!1),c.enforceFocus();var e=a.Event("shown.bs.modal",{relatedTarget:b});d?c.$element.find(".modal-dialog").one(a.support.transition.end,function(){c.$element.focus().trigger(e)}).emulateTransitionEnd(300):c.$element.focus().trigger(e)}))},b.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").attr("aria-hidden",!0).off("click.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one(a.support.transition.end,a.proxy(this.hideModal,this)).emulateTransitionEnd(300):this.hideModal())},b.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.focus()},this))},b.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keyup.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keyup.dismiss.bs.modal")},b.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.removeBackdrop(),a.$element.trigger("hidden.bs.modal")})},b.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},b.prototype.backdrop=function(b){var c=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var d=a.support.transition&&c;if(this.$backdrop=a('<div class="modal-backdrop '+c+'" />').appendTo(document.body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus.call(this.$element[0]):this.hide.call(this))},this)),d&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;d?this.$backdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()}else!this.isShown&&this.$backdrop?(this.$backdrop.removeClass("in"),a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one(a.support.transition.end,b).emulateTransitionEnd(150):b()):b&&b()};var c=a.fn.modal;a.fn.modal=function(c,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},b.DEFAULTS,e.data(),"object"==typeof c&&c);f||e.data("bs.modal",f=new b(this,g)),"string"==typeof c?f[c](d):g.show&&f.show(d)})},a.fn.modal.Constructor=b,a.fn.modal.noConflict=function(){return a.fn.modal=c,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(b){var c=a(this),d=c.attr("href"),e=a(c.attr("data-target")||d&&d.replace(/.*(?=#[^\s]+$)/,"")),f=e.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(d)&&d},e.data(),c.data());c.is("a")&&b.preventDefault(),e.modal(f,this).one("hide",function(){c.is(":visible")&&c.focus()})}),a(document).on("show.bs.modal",".modal",function(){a(document.body).addClass("modal-open")}).on("hidden.bs.modal",".modal",function(){a(document.body).removeClass("modal-open")})}(jQuery),+function(a){"use strict";var b=function(a,b){this.type=this.options=this.enabled=this.timeout=this.hoverState=this.$element=null,this.init("tooltip",a,b)};b.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1},b.prototype.init=function(b,c,d){this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d);for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},b.prototype.getDefaults=function(){return b.DEFAULTS},b.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},b.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},b.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);return clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show()},b.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type);return clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide()},b.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){if(this.$element.trigger(b),b.isDefaultPrevented())return;var c=this,d=this.tip();this.setContent(),this.options.animation&&d.addClass("fade");var e="function"==typeof this.options.placement?this.options.placement.call(this,d[0],this.$element[0]):this.options.placement,f=/\s?auto?\s?/i,g=f.test(e);g&&(e=e.replace(f,"")||"top"),d.detach().css({top:0,left:0,display:"block"}).addClass(e),this.options.container?d.appendTo(this.options.container):d.insertAfter(this.$element);var h=this.getPosition(),i=d[0].offsetWidth,j=d[0].offsetHeight;if(g){var k=this.$element.parent(),l=e,m=document.documentElement.scrollTop||document.body.scrollTop,n="body"==this.options.container?window.innerWidth:k.outerWidth(),o="body"==this.options.container?window.innerHeight:k.outerHeight(),p="body"==this.options.container?0:k.offset().left;e="bottom"==e&&h.top+h.height+j-m>o?"top":"top"==e&&h.top-m-j<0?"bottom":"right"==e&&h.right+i>n?"left":"left"==e&&h.left-i<p?"right":e,d.removeClass(l).addClass(e)}var q=this.getCalculatedOffset(e,h,i,j);this.applyPlacement(q,e),this.hoverState=null;var r=function(){c.$element.trigger("shown.bs."+c.type)};a.support.transition&&this.$tip.hasClass("fade")?d.one(a.support.transition.end,r).emulateTransitionEnd(150):r()}},b.prototype.applyPlacement=function(b,c){var d,e=this.tip(),f=e[0].offsetWidth,g=e[0].offsetHeight,h=parseInt(e.css("margin-top"),10),i=parseInt(e.css("margin-left"),10);isNaN(h)&&(h=0),isNaN(i)&&(i=0),b.top=b.top+h,b.left=b.left+i,a.offset.setOffset(e[0],a.extend({using:function(a){e.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),e.addClass("in");var j=e[0].offsetWidth,k=e[0].offsetHeight;if("top"==c&&k!=g&&(d=!0,b.top=b.top+g-k),/bottom|top/.test(c)){var l=0;b.left<0&&(l=-2*b.left,b.left=0,e.offset(b),j=e[0].offsetWidth,k=e[0].offsetHeight),this.replaceArrow(l-f+j,j,"left")}else this.replaceArrow(k-g,k,"top");d&&e.offset(b)},b.prototype.replaceArrow=function(a,b,c){this.arrow().css(c,a?50*(1-a/b)+"%":"")},b.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},b.prototype.hide=function(){function b(){"in"!=c.hoverState&&d.detach(),c.$element.trigger("hidden.bs."+c.type)}var c=this,d=this.tip(),e=a.Event("hide.bs."+this.type);return this.$element.trigger(e),e.isDefaultPrevented()?void 0:(d.removeClass("in"),a.support.transition&&this.$tip.hasClass("fade")?d.one(a.support.transition.end,b).emulateTransitionEnd(150):b(),this.hoverState=null,this)},b.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},b.prototype.hasContent=function(){return this.getTitle()},b.prototype.getPosition=function(){var b=this.$element[0];return a.extend({},"function"==typeof b.getBoundingClientRect?b.getBoundingClientRect():{width:b.offsetWidth,height:b.offsetHeight},this.$element.offset())},b.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},b.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},b.prototype.tip=function(){return this.$tip=this.$tip||a(this.options.template)},b.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},b.prototype.validate=function(){this.$element[0].parentNode||(this.hide(),this.$element=null,this.options=null)},b.prototype.enable=function(){this.enabled=!0},b.prototype.disable=function(){this.enabled=!1},b.prototype.toggleEnabled=function(){this.enabled=!this.enabled},b.prototype.toggle=function(b){var c=b?a(b.currentTarget)[this.type](this.getDelegateOptions()).data("bs."+this.type):this;c.tip().hasClass("in")?c.leave(c):c.enter(c)},b.prototype.destroy=function(){clearTimeout(this.timeout),this.hide().$element.off("."+this.type).removeData("bs."+this.type)};var c=a.fn.tooltip;a.fn.tooltip=function(c){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof c&&c;(e||"destroy"!=c)&&(e||d.data("bs.tooltip",e=new b(this,f)),"string"==typeof c&&e[c]())})},a.fn.tooltip.Constructor=b,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=c,this}}(jQuery),+function(a){"use strict";var b=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");b.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),b.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),b.prototype.constructor=b,b.prototype.getDefaults=function(){return b.DEFAULTS},b.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content")[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},b.prototype.hasContent=function(){return this.getTitle()||this.getContent()},b.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},b.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")},b.prototype.tip=function(){return this.$tip||(this.$tip=a(this.options.template)),this.$tip};var c=a.fn.popover;a.fn.popover=function(c){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof c&&c;(e||"destroy"!=c)&&(e||d.data("bs.popover",e=new b(this,f)),"string"==typeof c&&e[c]())})},a.fn.popover.Constructor=b,a.fn.popover.noConflict=function(){return a.fn.popover=c,this}}(jQuery),+function(a){"use strict";function b(c,d){var e,f=a.proxy(this.process,this);this.$element=a(a(c).is("body")?window:c),this.$body=a("body"),this.$scrollElement=this.$element.on("scroll.bs.scroll-spy.data-api",f),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||(e=a(c).attr("href"))&&e.replace(/.*(?=#[^\s]+$)/,"")||"")+" .nav li > a",this.offsets=a([]),this.targets=a([]),this.activeTarget=null,this.refresh(),this.process()}b.DEFAULTS={offset:10},b.prototype.refresh=function(){var b=this.$element[0]==window?"offset":"position";this.offsets=a([]),this.targets=a([]);{var c=this;this.$body.find(this.selector).map(function(){var d=a(this),e=d.data("target")||d.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[b]().top+(!a.isWindow(c.$scrollElement.get(0))&&c.$scrollElement.scrollTop()),e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){c.offsets.push(this[0]),c.targets.push(this[1])})}},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.$scrollElement[0].scrollHeight||this.$body[0].scrollHeight,d=c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(b>=d)return g!=(a=f.last()[0])&&this.activate(a);if(g&&b<=e[0])return g!=(a=f[0])&&this.activate(a);for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(!e[a+1]||b<=e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,a(this.selector).parentsUntil(this.options.target,".active").removeClass("active");var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")};var c=a.fn.scrollspy;a.fn.scrollspy=function(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=c,this},a(window).on("load",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);b.scrollspy(b.data())})})}(jQuery),+function(a){"use strict";var b=function(b){this.element=a(b)};b.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a")[0],f=a.Event("show.bs.tab",{relatedTarget:e});if(b.trigger(f),!f.isDefaultPrevented()){var g=a(d);this.activate(b.parent("li"),c),this.activate(g,g.parent(),function(){b.trigger({type:"shown.bs.tab",relatedTarget:e})})}}},b.prototype.activate=function(b,c,d){function e(){f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"),b.addClass("active"),g?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu")&&b.closest("li.dropdown").addClass("active"),d&&d()}var f=c.find("> .active"),g=d&&a.support.transition&&f.hasClass("fade");g?f.one(a.support.transition.end,e).emulateTransitionEnd(150):e(),f.removeClass("in")};var c=a.fn.tab;a.fn.tab=function(c){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new b(this)),"string"==typeof c&&e[c]()})},a.fn.tab.Constructor=b,a.fn.tab.noConflict=function(){return a.fn.tab=c,this},a(document).on("click.bs.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"]',function(b){b.preventDefault(),a(this).tab("show")})}(jQuery),+function(a){"use strict";var b=function(c,d){this.options=a.extend({},b.DEFAULTS,d),this.$window=a(window).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(c),this.affixed=this.unpin=this.pinnedOffset=null,this.checkPosition()};b.RESET="affix affix-top affix-bottom",b.DEFAULTS={offset:0},b.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(b.RESET).addClass("affix");var a=this.$window.scrollTop(),c=this.$element.offset();return this.pinnedOffset=c.top-a},b.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},b.prototype.checkPosition=function(){if(this.$element.is(":visible")){var c=a(document).height(),d=this.$window.scrollTop(),e=this.$element.offset(),f=this.options.offset,g=f.top,h=f.bottom;"top"==this.affixed&&(e.top+=d),"object"!=typeof f&&(h=g=f),"function"==typeof g&&(g=f.top(this.$element)),"function"==typeof h&&(h=f.bottom(this.$element));var i=null!=this.unpin&&d+this.unpin<=e.top?!1:null!=h&&e.top+this.$element.height()>=c-h?"bottom":null!=g&&g>=d?"top":!1;if(this.affixed!==i){this.unpin&&this.$element.css("top","");var j="affix"+(i?"-"+i:""),k=a.Event(j+".bs.affix");this.$element.trigger(k),k.isDefaultPrevented()||(this.affixed=i,this.unpin="bottom"==i?this.getPinnedOffset():null,this.$element.removeClass(b.RESET).addClass(j).trigger(a.Event(j.replace("affix","affixed"))),"bottom"==i&&this.$element.offset({top:c-h-this.$element.height()}))}}};var c=a.fn.affix;a.fn.affix=function(c){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof c&&c;e||d.data("bs.affix",e=new b(this,f)),"string"==typeof c&&e[c]()})},a.fn.affix.Constructor=b,a.fn.affix.noConflict=function(){return a.fn.affix=c,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var b=a(this),c=b.data();c.offset=c.offset||{},c.offsetBottom&&(c.offset.bottom=c.offsetBottom),c.offsetTop&&(c.offset.top=c.offsetTop),b.affix(c)})})}(jQuery);
jQuery.easing["jswing"]=jQuery.easing["swing"];jQuery.extend(jQuery.easing,{def:"easeOutQuad",swing:function(x,t,b,c,d){return jQuery.easing[jQuery.easing.def](x,t,b,c,d)},easeInQuad:function(x,t,b,c,d){return c*(t/=d)*t+b},easeOutQuad:function(x,t,b,c,d){return-c*(t/=d)*(t-2)+b},easeInOutQuad:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t+b;return-c/2*(--t*(t-2)-1)+b},easeInCubic:function(x,t,b,c,d){return c*(t/=d)*t*t+b},easeOutCubic:function(x,t,b,c,d){return c*((t=t/d-1)*t*t+1)+b},easeInOutCubic:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t+b;return c/2*((t-=2)*t*t+2)+b},easeInQuart:function(x,t,b,c,d){return c*(t/=d)*t*t*t+b},easeOutQuart:function(x,t,b,c,d){return-c*((t=t/d-1)*t*t*t-1)+b},easeInOutQuart:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t+b;return-c/2*((t-=2)*t*t*t-2)+b},easeInQuint:function(x,t,b,c,d){return c*(t/=d)*t*t*t*t+b},easeOutQuint:function(x,t,b,c,d){return c*((t=t/d-1)*t*t*t*t+1)+b},easeInOutQuint:function(x,t,b,c,d){if((t/=d/2)<1)return c/2*t*t*t*t*t+b;return c/2*((t-=2)*t*t*t*t+2)+b},easeInSine:function(x,t,b,c,d){return-c*Math.cos(t/d*(Math.PI/2))+c+b},easeOutSine:function(x,t,b,c,d){return c*Math.sin(t/d*(Math.PI/2))+b},easeInOutSine:function(x,t,b,c,d){return-c/2*(Math.cos(Math.PI*t/d)-1)+b},easeInExpo:function(x,t,b,c,d){return t==0?b:c*Math.pow(2,10*(t/d-1))+b},easeOutExpo:function(x,t,b,c,d){return t==d?b+c:c*(-Math.pow(2,-10*t/d)+1)+b},easeInOutExpo:function(x,t,b,c,d){if(t==0)return b;if(t==d)return b+c;if((t/=d/2)<1)return c/2*Math.pow(2,10*(t-1))+b;return c/2*(-Math.pow(2,-10*--t)+2)+b},easeInCirc:function(x,t,b,c,d){return-c*(Math.sqrt(1-(t/=d)*t)-1)+b},easeOutCirc:function(x,t,b,c,d){return c*Math.sqrt(1-(t=t/d-1)*t)+b},easeInOutCirc:function(x,t,b,c,d){if((t/=d/2)<1)return-c/2*(Math.sqrt(1-t*t)-1)+b;return c/2*(Math.sqrt(1-(t-=2)*t)+1)+b},easeInElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return-(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b},easeOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d)==1)return b+c;if(!p)p=d*.3;if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);return a*Math.pow(2,-10*t)*Math.sin((t*d-s)*(2*Math.PI)/p)+c+b},easeInOutElastic:function(x,t,b,c,d){var s=1.70158;var p=0;var a=c;if(t==0)return b;if((t/=d/2)==2)return b+c;if(!p)p=d*(.3*1.5);if(a<Math.abs(c)){a=c;var s=p/4}else var s=p/(2*Math.PI)*Math.asin(c/a);if(t<1)return-.5*(a*Math.pow(2,10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p))+b;return a*Math.pow(2,-10*(t-=1))*Math.sin((t*d-s)*(2*Math.PI)/p)*.5+c+b},easeInBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*(t/=d)*t*((s+1)*t-s)+b},easeOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;return c*((t=t/d-1)*t*((s+1)*t+s)+1)+b},easeInOutBack:function(x,t,b,c,d,s){if(s==undefined)s=1.70158;if((t/=d/2)<1)return c/2*(t*t*(((s*=1.525)+1)*t-s))+b;return c/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+b},easeInBounce:function(x,t,b,c,d){return c-jQuery.easing.easeOutBounce(x,d-t,0,c,d)+b},easeOutBounce:function(x,t,b,c,d){if((t/=d)<1/2.75){return c*(7.5625*t*t)+b}else if(t<2/2.75){return c*(7.5625*(t-=1.5/2.75)*t+.75)+b}else if(t<2.5/2.75){return c*(7.5625*(t-=2.25/2.75)*t+.9375)+b}else{return c*(7.5625*(t-=2.625/2.75)*t+.984375)+b}},easeInOutBounce:function(x,t,b,c,d){if(t<d/2)return jQuery.easing.easeInBounce(x,t*2,0,c,d)*.5+b;return jQuery.easing.easeOutBounce(x,t*2-d,0,c,d)*.5+c*.5+b}});
//# sourceMappingURL=./js/jquery.easing.1.3.min.map
/*! WOW - v0.1.4 - 2014-02-12
* Copyright (c) 2014 Matthieu Aussaguel; Licensed MIT */(function(){var a,b=[].slice,c=function(a,b){return function(){return a.apply(b,arguments)}};a=function(){var c,d,e,f,g,h,i,j,k;for(e=arguments[0],c=2<=arguments.length?b.call(arguments,1):[],g=e||{},i=0,j=c.length;j>i;i++){f=c[i],k=f||{};for(d in k)h=k[d],"object"==typeof g[d]?g[d]=a(g[d],h):g[d]||(g[d]=h)}return g},this.WOW=function(){function b(b){null==b&&(b={}),this.scrollCallback=c(this.scrollCallback,this),this.scrollHandler=c(this.scrollHandler,this),this.start=c(this.start,this),this.config=a(b,this.defaults),this.scrolled=!0}return b.prototype.defaults={boxClass:"wow",animateClass:"animated",offset:0},b.prototype.init=function(){var a;return"interactive"===(a=document.readyState)||"complete"===a?this.start():document.addEventListener("DOMContentLoaded",this.start)},b.prototype.start=function(){var a,b,c,d;if(this.element=window.document.documentElement,this.boxes=this.element.getElementsByClassName(this.config.boxClass),this.boxes.length){for(d=this.boxes,b=0,c=d.length;c>b;b++)a=d[b],this.applyStyle(a,!0);return window.addEventListener("scroll",this.scrollHandler,!1),window.addEventListener("resize",this.scrollHandler,!1),this.interval=setInterval(this.scrollCallback,50)}},b.prototype.stop=function(){return window.removeEventListener("scroll",this.scrollHandler,!1),window.removeEventListener("resize",this.scrollHandler,!1),null!=this.interval?clearInterval(this.interval):void 0},b.prototype.show=function(a){return this.applyStyle(a),a.className=""+a.className+" "+this.config.animateClass},b.prototype.applyStyle=function(a,b){var c,d,e;return d=a.getAttribute("data-wow-duration"),c=a.getAttribute("data-wow-delay"),e=a.getAttribute("data-wow-iteration"),a.setAttribute("style",this.customStyle(b,d,c,e))},b.prototype.customStyle=function(a,b,c,d){var e;return e=a?"visibility: hidden; -webkit-animation-name: none; -moz-animation-name: none; animation-name: none;":"visibility: visible;",b&&(e+="-webkit-animation-duration: "+b+"; -moz-animation-duration: "+b+"; animation-duration: "+b+";"),c&&(e+="-webkit-animation-delay: "+c+"; -moz-animation-delay: "+c+"; animation-delay: "+c+";"),d&&(e+="-webkit-animation-iteration-count: "+d+"; -moz-animation-iteration-count: "+d+"; animation-iteration-count: "+d+";"),e},b.prototype.scrollHandler=function(){return this.scrolled=!0},b.prototype.scrollCallback=function(){var a;return this.scrolled&&(this.scrolled=!1,this.boxes=function(){var b,c,d,e;for(d=this.boxes,e=[],b=0,c=d.length;c>b;b++)a=d[b],a&&(this.isVisible(a)?this.show(a):e.push(a));return e}.call(this),!this.boxes.length)?this.stop():void 0},b.prototype.offsetTop=function(a){var b;for(b=a.offsetTop;a=a.offsetParent;)b+=a.offsetTop;return b},b.prototype.isVisible=function(a){var b,c,d,e,f;return c=a.getAttribute("data-wow-offset")||this.config.offset,f=window.pageYOffset,e=f+this.element.clientHeight-c,d=this.offsetTop(a),b=d+a.clientHeight,e>=d&&b>=f},b}()}).call(this);
!function(e){var t={animation:"dissolve",separator:",",speed:2e3};e.fx.step.textShadowBlur=function(t){e(t.elem).prop("textShadowBlur",t.now).css({textShadow:"0 0 "+Math.floor(t.now)+"px black"})};e.fn.textrotator=function(n){var r=e.extend({},t,n);return this.each(function(){var t=e(this);var n=[];e.each(t.text().split(r.separator),function(e,t){n.push(t)});t.text(n[0]);var i=function(){switch(r.animation){case"dissolve":t.animate({textShadowBlur:20,opacity:0},500,function(){s=e.inArray(t.text(),n);if(s+1==n.length)s=-1;t.text(n[s+1]).animate({textShadowBlur:0,opacity:1},500)});break;case"flip":if(t.find(".back").length>0){t.html(t.find(".back").html())}var i=t.text();var s=e.inArray(i,n);if(s+1==n.length)s=-1;t.html("");e("<span class='front'>"+i+"</span>").appendTo(t);e("<span class='back'>"+n[s+1]+"</span>").appendTo(t);t.wrapInner("<span class='rotating' />").find(".rotating").hide().addClass("flip").show().css({"-webkit-transform":" rotateY(-180deg)","-moz-transform":" rotateY(-180deg)","-o-transform":" rotateY(-180deg)",transform:" rotateY(-180deg)"});break;case"flipUp":if(t.find(".back").length>0){t.html(t.find(".back").html())}var i=t.text();var s=e.inArray(i,n);if(s+1==n.length)s=-1;t.html("");e("<span class='front'>"+i+"</span>").appendTo(t);e("<span class='back'>"+n[s+1]+"</span>").appendTo(t);t.wrapInner("<span class='rotating' />").find(".rotating").hide().addClass("flip up").show().css({"-webkit-transform":" rotateX(-180deg)","-moz-transform":" rotateX(-180deg)","-o-transform":" rotateX(-180deg)",transform:" rotateX(-180deg)"});break;case"flipCube":if(t.find(".back").length>0){t.html(t.find(".back").html())}var i=t.text();var s=e.inArray(i,n);if(s+1==n.length)s=-1;t.html("");e("<span class='front'>"+i+"</span>").appendTo(t);e("<span class='back'>"+n[s+1]+"</span>").appendTo(t);t.wrapInner("<span class='rotating' />").find(".rotating").hide().addClass("flip cube").show().css({"-webkit-transform":" rotateY(180deg)","-moz-transform":" rotateY(180deg)","-o-transform":" rotateY(180deg)",transform:" rotateY(180deg)"});break;case"flipCubeUp":if(t.find(".back").length>0){t.html(t.find(".back").html())}var i=t.text();var s=e.inArray(i,n);if(s+1==n.length)s=-1;t.html("");e("<span class='front'>"+i+"</span>").appendTo(t);e("<span class='back'>"+n[s+1]+"</span>").appendTo(t);t.wrapInner("<span class='rotating' />").find(".rotating").hide().addClass("flip cube up").show().css({"-webkit-transform":" rotateX(180deg)","-moz-transform":" rotateX(180deg)","-o-transform":" rotateX(180deg)",transform:" rotateX(180deg)"});break;case"spin":if(t.find(".rotating").length>0){t.html(t.find(".rotating").html())}s=e.inArray(t.text(),n);if(s+1==n.length)s=-1;t.wrapInner("<span class='rotating spin' />").find(".rotating").hide().text(n[s+1]).show().css({"-webkit-transform":" rotate(0) scale(1)","-moz-transform":"rotate(0) scale(1)","-o-transform":"rotate(0) scale(1)",transform:"rotate(0) scale(1)"});break;case"fade":t.fadeOut(r.speed,function(){s=e.inArray(t.text(),n);if(s+1==n.length)s=-1;t.text(n[s+1]).fadeIn(r.speed)});break}};setInterval(i,r.speed)})}}(window.jQuery)
document.documentElement.className += ' js_active ';
document.documentElement.className += 'ontouchstart' in document.documentElement ? ' vc_mobile ' : ' vc_desktop ';
(function () {
  var prefix = ['-webkit-', '-o-', '-moz-', '-ms-', ""];
  for (var i in prefix) {
    if (prefix[i] + 'transform' in document.documentElement.style) document.documentElement.className += " vc_transform ";
  }
})();
/*
 On document ready jQuery will fire set of functions.
 If you want to override function behavior then copy it to your theme js file
 with the same name.
 */

jQuery(window).load(function () {


});
var vc_js = function () {
  vc_twitterBehaviour();
  // vc_toggleBehaviour();
  vc_tabsBehaviour();
  vc_accordionBehaviour();
  vc_teaserGrid();
  vc_carouselBehaviour();
  vc_slidersBehaviour();
  vc_prettyPhoto();
  vc_googleplus();
  vc_pinterest();
  vc_progress_bar();
  vc_plugin_flexslider();
  vc_google_fonts();
  window.setTimeout(vc_waypoints, 1500);
};
jQuery(document).ready(function ($) {
  window.vc_js();
}); // END jQuery(document).ready

if (typeof window['vc_plugin_flexslider'] !== 'function') {
  function vc_plugin_flexslider($parent) {
    var $slider = $parent ? $parent.find('.wpb_flexslider') : jQuery('.wpb_flexslider');
    $slider.each(function () {
      var this_element = jQuery(this);
      var sliderSpeed = 800,
        sliderTimeout = parseInt(this_element.attr('data-interval')) * 1000,
        sliderFx = this_element.attr('data-flex_fx'),
        slideshow = true;
      if (sliderTimeout == 0) slideshow = false;

      this_element.is(':visible') && this_element.flexslider({
        animation:sliderFx,
        slideshow:slideshow,
        slideshowSpeed:sliderTimeout,
        sliderSpeed:sliderSpeed,
        smoothHeight:true
      });
    });
  }
}

/* Twitter
 ---------------------------------------------------------- */
if (typeof window['vc_twitterBehaviour'] !== 'function') {
  function vc_twitterBehaviour() {
    jQuery('.wpb_twitter_widget .tweets').each(function (index) {
      var this_element = jQuery(this),
        tw_name = this_element.attr('data-tw_name');
      tw_count = this_element.attr('data-tw_count');

      this_element.tweet({
        username:tw_name,
        join_text:"auto",
        avatar_size:0,
        count:tw_count,
        template:"{avatar}{join}{text}{time}",
        auto_join_text_default:"",
        auto_join_text_ed:"",
        auto_join_text_ing:"",
        auto_join_text_reply:"",
        auto_join_text_url:"",
        loading_text:'<span class="loading_tweets">loading tweets...</span>'
      });
    });
  }
}

/* Google plus
 ---------------------------------------------------------- */
if (typeof window['vc_googleplus'] !== 'function') {
  function vc_googleplus() {
    if (jQuery('.wpb_googleplus').length > 0) {
      (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'https://apis.google.com/js/plusone.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
      })();
    }
  }
}

/* Pinterest
 ---------------------------------------------------------- */
if (typeof window['vc_pinterest'] !== 'function') {
  function vc_pinterest() {
    if (jQuery('.wpb_pinterest').length > 0) {
      (function () {
        var po = document.createElement('script');
        po.type = 'text/javascript';
        po.async = true;
        po.src = 'http://assets.pinterest.com/js/pinit.js';
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(po, s);
        //<script type="text/javascript" src="//assets.pinterest.com/js/pinit.js"></script>
      })();
    }
  }
}

/* Progress bar
 ---------------------------------------------------------- */
if (typeof window['vc_progress_bar'] !== 'function') {
  function vc_progress_bar() {
    if (typeof jQuery.fn.waypoint !== 'undefined') {

      jQuery('.vc_progress_bar').waypoint(function () {
        jQuery(this).find('.vc_single_bar').each(function (index) {
          var $this = jQuery(this),
            bar = $this.find('.vc_bar'),
            val = bar.data('percentage-value');

          setTimeout(function () {
            bar.css({"width":val + '%'});
          }, index * 200);
        });
      }, { offset:'85%' });
    }
  }
}

/* Waypoints magic
 ---------------------------------------------------------- */
if (typeof window['vc_waypoints'] !== 'function') {
  function vc_waypoints() {
    if (typeof jQuery.fn.waypoint !== 'undefined') {
      jQuery('.wpb_animate_when_almost_visible:not(.wpb_start_animation)').waypoint(function () {
        jQuery(this).addClass('wpb_start_animation');
      }, { offset:'85%' });
    }
  }
}

/* Toggle
 ---------------------------------------------------------- */
// if (typeof window['vc_toggleBehaviour'] !== 'function') {
//   function vc_toggleBehaviour() {
//     jQuery(".wpb_toggle").unbind('click').click(function (e) {
//       if (jQuery(this).next().is(':animated')) {
//         return false;
//       }
//       if (jQuery(this).hasClass('wpb_toggle_title_active')) {
//         jQuery(this).removeClass('wpb_toggle_title_active').next().slideUp(500);
//       } else {
//         jQuery(this).addClass('wpb_toggle_title_active').next().slideDown(500);
//       }
//     });
//     jQuery('.wpb_toggle_content').each(function (index) {
//       if (jQuery(this).next().is('h4.wpb_toggle') == false) {
//         jQuery('<div class="last_toggle_el_margin"></div>').insertAfter(this);
//       }
//     });
//   }
// }

/* Tabs + Tours
 ---------------------------------------------------------- */
if (typeof window['vc_tabsBehaviour'] !== 'function') {
  function vc_tabsBehaviour($tab) {
    jQuery(function ($) {
      $(document.body).off('click.preview', 'a')
    });
    var $call = $tab || jQuery('.wpb_tabs, .wpb_tour'),
      ver = jQuery.ui && jQuery.ui.version ? jQuery.ui.version.split('.') : '1.10',
      old_version = parseInt(ver[0]) == 1 && parseInt(ver[1]) < 9;
    // if($call.hasClass('ui-widget')) $call.tabs('destroy');
    $call.each(function (index) {
      var $tabs,
        interval = jQuery(this).attr("data-interval"),
        tabs_array = [];
      //
      $tabs = jQuery(this).find('.wpb_tour_tabs_wrapper').tabs({
        show:function (event, ui) {
          wpb_prepare_tab_content(event, ui);
        },
        beforeActivate: function(event, ui) {
          ui.newPanel.index() !== 1 && ui.newPanel.find('.vc_pie_chart:not(.vc_ready)');
        },
        activate:function (event, ui) {
          wpb_prepare_tab_content(event, ui);
        }
      }).tabs('rotate', interval * 1000);

      jQuery(this).find('.wpb_tab').each(function () {
        tabs_array.push(this.id);
      });

      jQuery(this).find('.wpb_tabs_nav a').click(function (e) {
        e.preventDefault();
        if (jQuery.inArray(jQuery(this).attr('href'), tabs_array)) {
          if (old_version) {
            $tabs.tabs("select", jQuery(this).attr('href'));
          } else {
            $tabs.tabs("option", "active", jQuery(jQuery(this).attr('href')).index() - 1);
          }
          return false;
        }
      });

      jQuery(this).find('.wpb_prev_slide a, .wpb_next_slide a').click(function (e) {
        e.preventDefault();
        if (old_version) {
          var index = $tabs.tabs('option', 'selected');
          if (jQuery(this).parent().hasClass('wpb_next_slide')) {
            index++;
          }
          else {
            index--;
          }
          if (index < 0) {
            index = $tabs.tabs("length") - 1;
          }
          else if (index >= $tabs.tabs("length")) {
            index = 0;
          }
          $tabs.tabs("select", index);
        } else {
          var index = $tabs.tabs("option", "active"),
            length = $tabs.find('.wpb_tab').length;

          if (jQuery(this).parent().hasClass('wpb_next_slide')) {
            index = (index + 1) >= length ? 0 : index + 1;
          } else {
            index = index - 1 < 0 ? length - 1 : index - 1;
          }

          $tabs.tabs("option", "active", index);
        }

      });

    });
  }
}

/* Tabs + Tours
 ---------------------------------------------------------- */
if (typeof window['vc_accordionBehaviour'] !== 'function') {
  function vc_accordionBehaviour() {
    jQuery('.wpb_accordion').each(function (index) {
      var $tabs,
        interval = jQuery(this).attr("data-interval"),
        active_tab = !isNaN(jQuery(this).data('active-tab')) && parseInt(jQuery(this).data('active-tab')) > 0 ? parseInt(jQuery(this).data('active-tab')) - 1 : false,
        collapsible = active_tab === false || jQuery(this).data('collapsible') === 'yes';
      //
      $tabs = jQuery(this).find('.wpb_accordion_wrapper').accordion({
        header:"> div > h3",
        autoHeight:false,
        heightStyle:"content",
        active:active_tab,
        collapsible:collapsible,
        navigation:true,
        activate: vc_accordionActivate,
        change:function (event, ui) {
          if (jQuery.fn.isotope != undefined) {
            ui.newContent.find('.isotope').isotope("layout");
          }
          vc_carouselBehaviour(ui.newPanel);
        }
      });
      //.tabs().tabs('rotate', interval*1000, true);
    });
  }
}

/* Teaser grid: isotope
 ---------------------------------------------------------- */
if (typeof window['vc_teaserGrid'] !== 'function') {
  function vc_teaserGrid() {
    var layout_modes = {
      fitrows:'fitRows',
      masonry:'masonry'
    }
    jQuery('.wpb_grid .teaser_grid_container:not(.wpb_carousel), .wpb_filtered_grid .teaser_grid_container:not(.wpb_carousel)').each(function () {
      var $container = jQuery(this);
      var $thumbs = $container.find('.wpb_thumbnails');
      var layout_mode = $thumbs.attr('data-layout-mode');
      $thumbs.isotope({
        // options
        itemSelector:'.isotope-item',
        layoutMode:(layout_modes[layout_mode] == undefined ? 'fitRows' : layout_modes[layout_mode])
      });
      $container.find('.categories_filter a').data('isotope', $thumbs).click(function (e) {
        e.preventDefault();
        var $thumbs = jQuery(this).data('isotope');
        jQuery(this).parent().parent().find('.active').removeClass('active');
        jQuery(this).parent().addClass('active');
        $thumbs.isotope({filter:jQuery(this).attr('data-filter')});
      });
      jQuery(window).bind('load resize', function () {
        $thumbs.isotope("layout");
      });
    });

    /*
     var isotope = jQuery('.wpb_grid ul.thumbnails');
     if ( isotope.length > 0 ) {
     isotope.isotope({
     // options
     itemSelector : '.isotope-item',
     layoutMode : 'fitRows'
     });
     jQuery(window).load(function() {
     isotope.isotope("layout");
     });
     }
     */
  }
}

if (typeof window['vc_carouselBehaviour'] !== 'function') {
  function vc_carouselBehaviour($parent) {
    var $carousel = $parent ? $parent.find(".wpb_carousel") : jQuery(".wpb_carousel");
    $carousel.each(function () {
      var $this = jQuery(this);
      if ($this.data('carousel_enabled') !== true && $this.is(':visible')) {
        $this.data('carousel_enabled', true);
        var carousel_width = jQuery(this).width(),
          visible_count = getColumnsCount(jQuery(this)),
          carousel_speed = 500;
        if (jQuery(this).hasClass('columns_count_1')) {
          carousel_speed = 900;
        }
        /* Get margin-left value from the css grid and apply it to the carousele li items (margin-right), before carousele initialization */
        var carousele_li = jQuery(this).find('.wpb_thumbnails-fluid li');
        carousele_li.css({"margin-right":carousele_li.css("margin-left"), "margin-left":0 });

        jQuery(this).find('.wpb_wrapper:eq(0)').jCarouselLite({
          btnNext:jQuery(this).find('.next'),
          btnPrev:jQuery(this).find('.prev'),
          visible:visible_count,
          speed:carousel_speed
        })
          .width('100%');//carousel_width

        var fluid_ul = jQuery(this).find('ul.wpb_thumbnails-fluid');
        fluid_ul.width(fluid_ul.width() + 300);

        jQuery(window).resize(function () {
          var before_resize = screen_size;
          screen_size = getSizeName();
          if (before_resize != screen_size) {
            window.setTimeout('location.reload()', 20);
          }
        });
      }

    });
    /*
     if(jQuery.fn.bxSlider !== undefined ) {
     jQuery('.bxslider').each(function(){
     var $slider = jQuery(this);
     $slider.bxSlider($slider.data('settings'));
     });
     }
     */
    if (window.Swiper !== undefined) {

      jQuery('.swiper-container').each(function () {
        var $this = jQuery(this),
          my_swiper,
          max_slide_size = 0,
          options = jQuery(this).data('settings');

        if (options.mode === 'vertical') {
          $this.find('.swiper-slide').each(function () {
            var height = jQuery(this).outerHeight(true);
            if (height > max_slide_size) max_slide_size = height;
          });
          $this.height(max_slide_size);
          $this.css('overflow', 'hidden');
        }
        jQuery(window).resize(function () {
          $this.find('.swiper-slide').each(function () {
            var height = jQuery(this).outerHeight(true);
            if (height > max_slide_size) max_slide_size = height;
          });
          $this.height(max_slide_size);
        });
        my_swiper = jQuery(this).swiper(jQuery.extend(options, {
          onFirstInit:function (swiper) {
            if (swiper.slides.length < 2) {
              $this.find('.vc_arrow-left,.vc_arrow-right').hide();
            } else if (swiper.activeIndex === 0 && swiper.params.loop !== true) {
              $this.find('.vc_arrow-left').hide();
            } else {
              $this.find('.vc_arrow-left').show();
            }
          },
          onSlideChangeStart:function (swiper) {
            if (swiper.slides.length > 1 && swiper.params.loop !== true) {
              if (swiper.activeIndex === 0) {
                $this.find('.vc_arrow-left').hide();
              } else {
                $this.find('.vc_arrow-left').show();
              }
              if (swiper.slides.length - 1 === swiper.activeIndex) {
                $this.find('.vc_arrow-right').hide();
              } else {
                $this.find('.vc_arrow-right').show();
              }
            }
          }
        }));
        $this.find('.vc_arrow-left').click(function (e) {
          e.preventDefault();
          my_swiper.swipePrev();
        });
        $this.find('.vc_arrow-right').click(function (e) {
          e.preventDefault();
          my_swiper.swipeNext();
        });
        my_swiper.reInit();
      });

    }

  }
}

if (typeof window['vc_slidersBehaviour'] !== 'function') {
  function vc_slidersBehaviour() {
    //var sliders_count = 0;
    jQuery('.wpb_gallery_slides').each(function (index) {
      var this_element = jQuery(this);
      var ss_count = 0;

      /*if ( this_element.hasClass('wpb_slider_fading') ) {
       var sliderSpeed = 500, sliderTimeout = this_element.attr('data-interval')*1000, slider_fx = 'fade';
       var current_ss;

       function slideshowOnBefore(currSlideElement, nextSlideElement, options) {
       jQuery(nextSlideElement).css({"position" : "absolute" });
       jQuery(nextSlideElement).find("div.description").animate({"opacity": 0}, 0);
       }

       function slideshowOnAfter(currSlideElement, nextSlideElement, options) {
       jQuery(nextSlideElement).find("div.description").animate({"opacity": 1}, 2000);

       jQuery(nextSlideElement).css({"position" : "static" });
       var new_h = jQuery(nextSlideElement).find('img').height();
       if ( jQuery.isNumeric(new_h) ) {
       //this_element.animate({ "height" : new_h }, sliderSpeed );
       }
       }

       this_element.find('ul')
       .before('<div class="ss_nav ss_nav_'+ss_count+'"></div><div class="wpb_fading_nav"><a id="next_'+ss_count+'" href="#next"></a> <a id="prev_'+ss_count+'" href="#prev"></a></div>')
       .cycle({
       fx: slider_fx, // choose your transition type, ex: fade, scrollUp, shuffle, etc...
       pause: 1,
       speed: sliderSpeed,
       timeout: sliderTimeout,
       delay: -ss_count * 1000,
       before: slideshowOnBefore,
       after:slideshowOnAfter,
       pager:  '.ss_nav_'+ss_count
       });
       //.find('.description').width(jQuery(this).width() - 20);
       ss_count++;
       }
       else*/
      if (this_element.hasClass('wpb_slider_nivo')) {
        var sliderSpeed = 800,
          sliderTimeout = this_element.attr('data-interval') * 1000;

        if (sliderTimeout == 0) sliderTimeout = 9999999999;

        this_element.find('.nivoSlider').nivoSlider({
          effect:'boxRainGrow,boxRain,boxRainReverse,boxRainGrowReverse', // Specify sets like: 'fold,fade,sliceDown'
          slices:15, // For slice animations
          boxCols:8, // For box animations
          boxRows:4, // For box animations
          animSpeed:sliderSpeed, // Slide transition speed
          pauseTime:sliderTimeout, // How long each slide will show
          startSlide:0, // Set starting Slide (0 index)
          directionNav:true, // Next & Prev navigation
          directionNavHide:true, // Only show on hover
          controlNav:true, // 1,2,3... navigation
          keyboardNav:false, // Use left & right arrows
          pauseOnHover:true, // Stop animation while hovering
          manualAdvance:false, // Force manual transitions
          prevText:'Prev', // Prev directionNav text
          nextText:'Next' // Next directionNav text
        });
      }
      else if (this_element.hasClass('wpb_flexslider') && 1 == 2) { /* TODO: remove this */
        /*
         var sliderSpeed = 800,
         sliderTimeout = this_element.attr('data-interval')*1000,
         sliderFx = this_element.attr('data-flex_fx'),
         slideshow = true;
         if ( sliderTimeout == 0 ) slideshow = false;

         this_element.flexslider({
         animation: sliderFx,
         slideshow: slideshow,
         slideshowSpeed: sliderTimeout,
         sliderSpeed: sliderSpeed,
         smoothHeight: true

         });
         */

        /*
         var $first_object = this_element.find('li:first').show().find('*:not(a)');

         $first_object.bind('load', function() {
         if(!this_element.find('.flex-control-nav').is('ol')) {
         this_element.flexslider({
         animation: sliderFx,
         slideshow: slideshow,
         slideshowSpeed: sliderTimeout,
         sliderSpeed: sliderSpeed,
         smoothHeight: true
         });
         }
         });

         window.setTimeout(function(){
         if(!this_element.find('.flex-control-nav').is('ol')) {
         this_element.flexslider({
         animation: sliderFx,
         slideshow: slideshow,
         slideshowSpeed: sliderTimeout,
         sliderSpeed: sliderSpeed,
         smoothHeight: true
         });
         }
         }, 5000);
         */
      }
      else if (this_element.hasClass('wpb_image_grid')) {
        var isotope = this_element.find('.wpb_image_grid_ul');
        isotope.isotope({
          // options
          itemSelector:'.isotope-item',
          layoutMode:'fitRows'
        });
        jQuery(window).load(function () {
          isotope.isotope("layout");
        });
      }
    });
  }
}

if (typeof window['vc_prettyPhoto'] !== 'function') {
  function vc_prettyPhoto() {
    try {
      // just in case. maybe prettyphoto isnt loaded on this site
      jQuery('a.prettyphoto, .gallery-icon a[href*=".jpg"]').prettyPhoto({
        animationSpeed:'normal', /* fast/slow/normal */
        padding:15, /* padding for each side of the picture */
        opacity:0.7, /* Value betwee 0 and 1 */
        showTitle:true, /* true/false */
        allowresize:true, /* true/false */
        counter_separator_label:'/', /* The separator for the gallery counter 1 "of" 2 */
        //theme: 'light_square', /* light_rounded / dark_rounded / light_square / dark_square */
        hideflash:false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
        deeplinking:false, /* Allow prettyPhoto to update the url to enable deeplinking. */
        modal:false, /* If set to true, only the close button will close the window */
        callback:function () {
          var url = location.href;
          var hashtag = (url.indexOf('#!prettyPhoto')) ? true : false;
          if (hashtag) location.hash = "!";
        } /* Called when prettyPhoto is closed */,
        social_tools:''
      });
    } catch (err) {
    }
  }
}

if ( typeof window['vc_google_fonts'] !== 'function' ) {
    function vc_google_fonts() {
        return;
    }
}
/* Helper
 ---------------------------------------------------------- */
function getColumnsCount(el) {
  var find = false,
    i = 1;

  while (find == false) {
    if (el.hasClass('columns_count_' + i)) {
      find = true;
      return i;
    }
    i++;
  }
}

var screen_size = getSizeName();
function getSizeName() {
  var screen_size = '',
    screen_w = jQuery(window).width();

  if (screen_w > 1170) {
    screen_size = "desktop_wide";
  }
  else if (screen_w > 960 && screen_w < 1169) {
    screen_size = "desktop";
  }
  else if (screen_w > 768 && screen_w < 959) {
    screen_size = "tablet";
  }
  else if (screen_w > 300 && screen_w < 767) {
    screen_size = "mobile";
  }
  else if (screen_w < 300) {
    screen_size = "mobile_portrait";
  }
  return screen_size;
}


function loadScript(url, $obj, callback) {

  var script = document.createElement("script")
  script.type = "text/javascript";

  if (script.readyState) {  //IE
    script.onreadystatechange = function () {
      if (script.readyState == "loaded" ||
        script.readyState == "complete") {
        script.onreadystatechange = null;
        callback();
      }
    };
  } else {  //Others
    /*
     script.onload = function(){

     callback();
     };
     */
  }

  script.src = url;
  $obj.get(0).appendChild(script);
}

/**
 * Prepare html to correctly display inside tab container
 *
 * @param event - ui tab event 'show'
 * @param ui - jquery ui tabs object
 */

function wpb_prepare_tab_content(event, ui) {
  var panel = ui.panel || ui.newPanel,
      $pie_charts = panel.find('.vc_pie_chart:not(.vc_ready)'),
      $carousel = panel.find('[data-ride="vc_carousel"]'),
      $ui_panel, $google_maps;
  vc_carouselBehaviour();
  vc_plugin_flexslider(panel);
  $pie_charts.length && jQuery.fn.vcChat && $pie_charts.vcChat();
  $carousel.length && jQuery.fn.carousel && $carousel.carousel('resizeAction');
  $ui_panel = panel.find('.isotope');
  $google_maps = panel.find('.wpb_gmaps_widget');
  if ($ui_panel.length > 0) {
    $ui_panel.isotope("layout");
  }
  if ($google_maps.length && !$google_maps.is('.map_ready')) {
    var $frame = $google_maps.find('iframe');
    $frame.attr('src', $frame.attr('src'));
    $google_maps.addClass('map_ready');
  }
  if(panel.parents('.isotope').length) {
    panel.parents('.isotope').each(function(){
      jQuery(this).isotope("layout");
    });
  }
}
var vc_accordionActivate = function(event, ui) {
  var $pie_charts = ui.newPanel.find('.vc_pie_chart:not(.vc_ready)'),
    $carousel = ui.newPanel.find('[data-ride="vc_carousel"]');
  if (jQuery.fn.isotope != undefined) {
    ui.newPanel.find('.isotope').isotope("layout");
  }
  vc_carouselBehaviour(ui.newPanel);
  vc_plugin_flexslider(ui.newPanel);
  $pie_charts.length && jQuery.fn.vcChat && $pie_charts.vcChat();
  $carousel.length && jQuery.fn.carousel && $carousel.carousel('resizeAction');
  if(ui.newPanel.parents('.isotope').length) {
    ui.newPanel.parents('.isotope').each(function(){
      jQuery(this).isotope("layout");
    });
  }
}


function triangleSetup(){"use strict";var e=document.querySelectorAll(".square-right");if(e.length>0){var t=jQuery(window).outerWidth();var n=jQuery(".main .container").outerWidth();var r=(t-(n+200))/2;r=r<=0?0:r;var i=document.querySelectorAll(".main .triangle-up-right");if(n+200>t){var s=(t-n)/2;[].forEach.call(i,function(e,t){e.setAttribute("style","width: "+s+"px;"+"right: "+"-"+s+"px; ")});[].forEach.call(e,function(e){e.style.width="0px";e.style.right="0px"})}else{[].forEach.call(i,function(e,t){e.setAttribute("style","width: 100px;"+"right: -100px;")});[].forEach.call(e,function(e){e.style.width=r+"px";e.style.right="-"+(r+100)+"px"})}}}var plethoraUtils=plethoraUtils||{};plethoraUtils.checkBool=function(e){return{1:1,"true":1,on:1,yes:1}[((typeof e!=="number"?e:e>0)+"").toLowerCase()]?true:false};jQuery(document).ready(function(e){"use strict";triangleSetup();var t=e("header").outerHeight();var n=e(window).outerHeight();var r=e(".full_page_photo").outerHeight();var i=r-100;var s=e(".sticky_header header");e(window).scroll(function(){if(e(this).scrollTop()>4){e(".sticky_header .full_page_photo .flexslider .flex-control-nav").removeClass("show").addClass("disappear");e(".sticky_header #big-video-control-container").removeClass("show").addClass("disappear");e(".sticky_header .full_page_photo .flexslider .flex-direction-nav").hide()}else{e(".full_page_photo .flexslider .flex-control-nav").removeClass("disappear").addClass("show");e("#big-video-control-container").removeClass("disappear").addClass("show");e(".full_page_photo .flexslider .flex-direction-nav").show()}});e(window).scroll(function(){if(e(this).scrollTop()>i){s.addClass("stuck")}else{s.removeClass("stuck")}});var o=e(window).scrollTop();if(o>r){s.addClass("stuck")}else{s.removeClass("stuck")}e(".sticky_header .main").css("top",t-1);if(e.isFunction(e().UItoTop)){e().UItoTop({easingType:"easeOutQuart"})}jQuery(".full_page_photo .hgroup .hgroup_title").addClass("wait_for_photo_load").hide();jQuery(".full_page_photo .hgroup .hgroup_subtitle").addClass("wait_for_photo_load").hide();if(jQuery(".wpb_googleplus").length>0){(function(){var e=document.createElement("script");e.type="text/javascript";e.async=true;e.src="https://apis.google.com/js/platform.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})()}});jQuery(window).load(function(){"use strict";window.cleanstartSlider=function(){var t=jQuery("header").outerHeight();var n=jQuery(".full_page_photo").outerHeight();var videoContainer=document.getElementById("big-video-vid_html5_api");if(videoContainer===null){jQuery(".sticky_header .main").css("top",n);};if(jQuery(".admin-bar").length){var r=jQuery("#wpadminbar").outerHeight();jQuery(".sticky_header .main").css("top",n-r)}if(jQuery(".sticky_header #lang_sel_footer").length){jQuery(".sticky_header #lang_sel_footer").css("top",n)}jQuery(".touch .sticky_header .overflow_wrapper").css("padding-bottom",n);jQuery(".flex-active-slide .container .carousel-caption").addClass("show");var i=jQuery(window).scrollTop();if(i<4){jQuery(".full_page_photo .flexslider .flex-control-nav").addClass("show");jQuery("#big-video-control-container").addClass("show")}jQuery(".full_page_photo .hgroup .hgroup_title").removeClass("wait_for_photo_load").show();jQuery(".full_page_photo .hgroup .hgroup_subtitle").removeClass("wait_for_photo_load").show();jQuery(".flexslider .carousel-caption.show").removeClass("wait_for_photo_load").show()};cleanstartSlider();var e=jQuery(window);jQuery(".parallax").each(function(){var t=jQuery(this);e.scroll(function(){if(e.scrollTop()+e.outerHeight()>=t.offset().top){var n=(e.scrollTop()+e.outerHeight()-t.offset().top)/10;var r="50% "+(100-n/1.2)+"%"}t.css({backgroundPosition:r})})});if(jQuery(".no-touch").length){var t=new WOW({animateClass:"animated",offset:100});t.init()}var n=function(){jQuery('<div id="imagelightbox-loading"><div></div></div>').appendTo("body")},r=function(){jQuery("#imagelightbox-loading").remove()},i=function(){jQuery('<div id="imagelightbox-overlay"></div>').appendTo("body")},s=function(){jQuery("#imagelightbox-overlay").remove()},o=function(e){jQuery('<a href="#" id="imagelightbox-close">Close</a>').appendTo("body").on("click",function(){jQuery(this).remove();e.quitImageLightbox();return false})},u=function(){jQuery("#imagelightbox-close").remove()},a=function(){var e=jQuery('a[href="'+jQuery("#imagelightbox").attr("src")+'"] img').attr("alt")||"";if(e.length>0)jQuery('<div id="imagelightbox-caption">'+e+"</div>").appendTo("body")},f=function(){var e=jQuery('a[href="'+jQuery("#imagelightbox").attr("src")+'"]').attr("title")||"";if(e.length>0)jQuery('<div id="imagelightbox-caption">'+e+"</div>").appendTo("body")},l=function(){var e=jQuery('a[href="'+jQuery("#imagelightbox").attr("src")+'"]')||"";if(e.attr("data-description")!=="undefined"&&e.attr("data-description")!==""){e=e.attr("data-description")}else if(e.attr("datas-caption")!=="undefined"&&e.attr("datas-caption")!==""){e=e.attr("data-caption")}if(e.length>0)jQuery('<div id="imagelightbox-caption">'+e+"</div>").appendTo("body")},c=function(){jQuery("#imagelightbox-caption").remove()};var h=function(e,t){if(e.count>3){var n=jQuery('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');n.appendTo("body");n.on("click touchend",function(n){n.preventDefault();var r=jQuery(this),i=jQuery(t+'[href="'+jQuery("#imagelightbox").attr("src")+'"]'),s=i.index(t);if(r.hasClass("imagelightbox-arrow-left")){s=s-1;if(!jQuery(t).eq(s).length)s=jQuery(t).length}else{s=s+1;if(!jQuery(t).eq(s).length)s=0}e.switchImageLightbox(s);return false})}},p=function(){jQuery(".imagelightbox-arrow").remove()};if(jQuery().imageLightbox){var d='a[data-imagelightbox="gallery"]';var v=jQuery("a.lightbox_gallery").imageLightbox({onStart:function(){h(v,d);i();o(v)},onEnd:function(){p();s();c();u();r()},onLoadEnd:function(){jQuery(".imagelightbox-arrow").css("display","block");l();r()},onLoadStart:function(){c();n()}});var m='a[data-imagelightbox="gallery"]';var g=jQuery("a.lightbox_single").imageLightbox({onStart:function(){h(g,m);i();o(g)},onEnd:function(){p();s();c();u();r()},onLoadEnd:function(){jQuery(".imagelightbox-arrow").css("display","block");f();r()},onLoadStart:function(){c();n()}})}});jQuery(window).resize(function(){"use strict";cleanstartSlider();waitForFinalEvent(function(){triangleSetup()},50,"setup triangles placing")});(function(){"use strict";var e="flipUp";var t=6e3;var n=",";if(typeof textRotatorOptions!=="undefined"){t=textRotatorOptions.speed!==undefined?textRotatorOptions.speed:t}if(navigator.userAgent.indexOf("Safari")!=-1&&navigator.userAgent.indexOf("Chrome")==-1){e="dissolve";jQuery(".rotate").textrotator({animation:e,separator:n,speed:t})}else{if(jQuery().textrotator){if(navigator.appName=="Microsoft Internet Explorer"||window.navigator.userAgent.indexOf("MSIE ")>0||!!navigator.userAgent.match(/Trident.*rv\:11\./)||!!/rv:11.0/i.test(navigator.userAgent)){e="dissolve"}else{e="flipUp"}jQuery(".rotate").textrotator({animation:e,separator:n,speed:t})}}})();var waitForFinalEvent=function(){var e={};return function(t,n,r){if(!r){r="Don't call this twice without a uniqueId"}if(e[r]){clearTimeout(e[r])}e[r]=setTimeout(t,n)}}()