/**
 * Zepto 1.2.0 - zepto event ajax form ie detect data selector - zeptojs.com/license
 */
!function(t,e){"function"==typeof define&&define.amd?define(function(){return e(t)}):e(t)}(this,function(t){var e=function(){function k(t){return null==t?String(t):T[j.call(t)]||"object"}function M(t){return"function"==k(t)}function L(t){return null!=t&&t==t.window}function $(t){return null!=t&&t.nodeType==t.DOCUMENT_NODE}function F(t){return"object"==k(t)}function R(t){return F(t)&&!L(t)&&Object.getPrototypeOf(t)==Object.prototype}function _(t){var e=!!t&&"length"in t&&t.length,n=i.type(t);return"function"!=n&&!L(t)&&("array"==n||0===e||"number"==typeof e&&e>0&&e-1 in t)}function q(t){return s.call(t,function(t){return null!=t})}function z(t){return t.length>0?i.fn.concat.apply([],t):t}function Z(t){return t.replace(/::/g,"/").replace(/([A-Z]+)([A-Z][a-z])/g,"$1_$2").replace(/([a-z\d])([A-Z])/g,"$1_$2").replace(/_/g,"-").toLowerCase()}function B(t){return t in l?l[t]:l[t]=new RegExp("(^|\\s)"+t+"(\\s|$)")}function V(t,e){return"number"!=typeof e||h[Z(t)]?e:e+"px"}function I(t){var e,n;return c[t]||(e=f.createElement(t),f.body.appendChild(e),n=getComputedStyle(e,"").getPropertyValue("display"),e.parentNode.removeChild(e),"none"==n&&(n="block"),c[t]=n),c[t]}function H(t){return"children"in t?u.call(t.children):i.map(t.childNodes,function(t){return 1==t.nodeType?t:void 0})}function W(t,e){var n,i=t?t.length:0;for(n=0;i>n;n++)this[n]=t[n];this.length=i,this.selector=e||""}function U(t,i,r){for(n in i)r&&(R(i[n])||D(i[n]))?(R(i[n])&&!R(t[n])&&(t[n]={}),D(i[n])&&!D(t[n])&&(t[n]=[]),U(t[n],i[n],r)):i[n]!==e&&(t[n]=i[n])}function X(t,e){return null==e?i(t):i(t).filter(e)}function J(t,e,n,i){return M(e)?e.call(t,n,i):e}function Y(t,e,n){null==n?t.removeAttribute(e):t.setAttribute(e,n)}function K(t,n){var i=t.className||"",r=i&&i.baseVal!==e;return n===e?r?i.baseVal:i:void(r?i.baseVal=n:t.className=n)}function G(t){try{return t?"true"==t||("false"==t?!1:"null"==t?null:+t+""==t?+t:/^[\[\{]/.test(t)?i.parseJSON(t):t):t}catch(e){return t}}function Q(t,e){e(t);for(var n=0,i=t.childNodes.length;i>n;n++)Q(t.childNodes[n],e)}var e,n,i,r,N,O,o=[],a=o.concat,s=o.filter,u=o.slice,f=t.document,c={},l={},h={"column-count":1,columns:1,"font-weight":1,"line-height":1,opacity:1,"z-index":1,zoom:1},p=/^\s*<(\w+|!)[^>]*>/,d=/^<(\w+)\s*\/?>(?:<\/\1>|)$/,m=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi,v=/^(?:body|html)$/i,g=/([A-Z])/g,y=["val","css","html","text","data","width","height","offset"],b=["after","prepend","before","append"],x=f.createElement("table"),E=f.createElement("tr"),w={tr:f.createElement("tbody"),tbody:x,thead:x,tfoot:x,td:E,th:E,"*":f.createElement("div")},S=/^[\w-]*$/,T={},j=T.toString,C={},P=f.createElement("div"),A={tabindex:"tabIndex",readonly:"readOnly","for":"htmlFor","class":"className",maxlength:"maxLength",cellspacing:"cellSpacing",cellpadding:"cellPadding",rowspan:"rowSpan",colspan:"colSpan",usemap:"useMap",frameborder:"frameBorder",contenteditable:"contentEditable"},D=Array.isArray||function(t){return t instanceof Array};return C.matches=function(t,e){if(!e||!t||1!==t.nodeType)return!1;var n=t.matches||t.webkitMatchesSelector||t.mozMatchesSelector||t.oMatchesSelector||t.matchesSelector;if(n)return n.call(t,e);var i,r=t.parentNode,o=!r;return o&&(r=P).appendChild(t),i=~C.qsa(r,e).indexOf(t),o&&P.removeChild(t),i},N=function(t){return t.replace(/-+(.)?/g,function(t,e){return e?e.toUpperCase():""})},O=function(t){return s.call(t,function(e,n){return t.indexOf(e)==n})},C.fragment=function(t,n,r){var o,a,s;return d.test(t)&&(o=i(f.createElement(RegExp.$1))),o||(t.replace&&(t=t.replace(m,"<$1></$2>")),n===e&&(n=p.test(t)&&RegExp.$1),n in w||(n="*"),s=w[n],s.innerHTML=""+t,o=i.each(u.call(s.childNodes),function(){s.removeChild(this)})),R(r)&&(a=i(o),i.each(r,function(t,e){y.indexOf(t)>-1?a[t](e):a.attr(t,e)})),o},C.Z=function(t,e){return new W(t,e)},C.isZ=function(t){return t instanceof C.Z},C.init=function(t,n){var r;if(!t)return C.Z();if("string"==typeof t)if(t=t.trim(),"<"==t[0]&&p.test(t))r=C.fragment(t,RegExp.$1,n),t=null;else{if(n!==e)return i(n).find(t);r=C.qsa(f,t)}else{if(M(t))return i(f).ready(t);if(C.isZ(t))return t;if(D(t))r=q(t);else if(F(t))r=[t],t=null;else if(p.test(t))r=C.fragment(t.trim(),RegExp.$1,n),t=null;else{if(n!==e)return i(n).find(t);r=C.qsa(f,t)}}return C.Z(r,t)},i=function(t,e){return C.init(t,e)},i.extend=function(t){var e,n=u.call(arguments,1);return"boolean"==typeof t&&(e=t,t=n.shift()),n.forEach(function(n){U(t,n,e)}),t},C.qsa=function(t,e){var n,i="#"==e[0],r=!i&&"."==e[0],o=i||r?e.slice(1):e,a=S.test(o);return t.getElementById&&a&&i?(n=t.getElementById(o))?[n]:[]:1!==t.nodeType&&9!==t.nodeType&&11!==t.nodeType?[]:u.call(a&&!i&&t.getElementsByClassName?r?t.getElementsByClassName(o):t.getElementsByTagName(e):t.querySelectorAll(e))},i.contains=f.documentElement.contains?function(t,e){return t!==e&&t.contains(e)}:function(t,e){for(;e&&(e=e.parentNode);)if(e===t)return!0;return!1},i.type=k,i.isFunction=M,i.isWindow=L,i.isArray=D,i.isPlainObject=R,i.isEmptyObject=function(t){var e;for(e in t)return!1;return!0},i.isNumeric=function(t){var e=Number(t),n=typeof t;return null!=t&&"boolean"!=n&&("string"!=n||t.length)&&!isNaN(e)&&isFinite(e)||!1},i.inArray=function(t,e,n){return o.indexOf.call(e,t,n)},i.camelCase=N,i.trim=function(t){return null==t?"":String.prototype.trim.call(t)},i.uuid=0,i.support={},i.expr={},i.noop=function(){},i.map=function(t,e){var n,r,o,i=[];if(_(t))for(r=0;r<t.length;r++)n=e(t[r],r),null!=n&&i.push(n);else for(o in t)n=e(t[o],o),null!=n&&i.push(n);return z(i)},i.each=function(t,e){var n,i;if(_(t)){for(n=0;n<t.length;n++)if(e.call(t[n],n,t[n])===!1)return t}else for(i in t)if(e.call(t[i],i,t[i])===!1)return t;return t},i.grep=function(t,e){return s.call(t,e)},t.JSON&&(i.parseJSON=JSON.parse),i.each("Boolean Number String Function Array Date RegExp Object Error".split(" "),function(t,e){T["[object "+e+"]"]=e.toLowerCase()}),i.fn={constructor:C.Z,length:0,forEach:o.forEach,reduce:o.reduce,push:o.push,sort:o.sort,splice:o.splice,indexOf:o.indexOf,concat:function(){var t,e,n=[];for(t=0;t<arguments.length;t++)e=arguments[t],n[t]=C.isZ(e)?e.toArray():e;return a.apply(C.isZ(this)?this.toArray():this,n)},map:function(t){return i(i.map(this,function(e,n){return t.call(e,n,e)}))},slice:function(){return i(u.apply(this,arguments))},ready:function(e){if("complete"===f.readyState||"loading"!==f.readyState&&!f.documentElement.doScroll)setTimeout(function(){e(i)},0);else{var n=function(){f.removeEventListener("DOMContentLoaded",n,!1),t.removeEventListener("load",n,!1),e(i)};f.addEventListener("DOMContentLoaded",n,!1),t.addEventListener("load",n,!1)}return this},get:function(t){return t===e?u.call(this):this[t>=0?t:t+this.length]},toArray:function(){return this.get()},size:function(){return this.length},remove:function(){return this.each(function(){null!=this.parentNode&&this.parentNode.removeChild(this)})},each:function(t){return o.every.call(this,function(e,n){return t.call(e,n,e)!==!1}),this},filter:function(t){return M(t)?this.not(this.not(t)):i(s.call(this,function(e){return C.matches(e,t)}))},add:function(t,e){return i(O(this.concat(i(t,e))))},is:function(t){return this.length>0&&C.matches(this[0],t)},not:function(t){var n=[];if(M(t)&&t.call!==e)this.each(function(e){t.call(this,e)||n.push(this)});else{var r="string"==typeof t?this.filter(t):_(t)&&M(t.item)?u.call(t):i(t);this.forEach(function(t){r.indexOf(t)<0&&n.push(t)})}return i(n)},has:function(t){return this.filter(function(){return F(t)?i.contains(this,t):i(this).find(t).size()})},eq:function(t){return-1===t?this.slice(t):this.slice(t,+t+1)},first:function(){var t=this[0];return t&&!F(t)?t:i(t)},last:function(){var t=this[this.length-1];return t&&!F(t)?t:i(t)},find:function(t){var e,n=this;return e=t?"object"==typeof t?i(t).filter(function(){var t=this;return o.some.call(n,function(e){return i.contains(e,t)})}):1==this.length?i(C.qsa(this[0],t)):this.map(function(){return C.qsa(this,t)}):i()},closest:function(t,e){var n=[],r="object"==typeof t&&i(t);return this.each(function(i,o){for(;o&&!(r?r.indexOf(o)>=0:C.matches(o,t));)o=o!==e&&!$(o)&&o.parentNode;o&&n.indexOf(o)<0&&n.push(o)}),i(n)},parents:function(t){for(var e=[],n=this;n.length>0;)n=i.map(n,function(t){return(t=t.parentNode)&&!$(t)&&e.indexOf(t)<0?(e.push(t),t):void 0});return X(e,t)},parent:function(t){return X(O(this.pluck("parentNode")),t)},children:function(t){return X(this.map(function(){return H(this)}),t)},contents:function(){return this.map(function(){return this.contentDocument||u.call(this.childNodes)})},siblings:function(t){return X(this.map(function(t,e){return s.call(H(e.parentNode),function(t){return t!==e})}),t)},empty:function(){return this.each(function(){this.innerHTML=""})},pluck:function(t){return i.map(this,function(e){return e[t]})},show:function(){return this.each(function(){"none"==this.style.display&&(this.style.display=""),"none"==getComputedStyle(this,"").getPropertyValue("display")&&(this.style.display=I(this.nodeName))})},replaceWith:function(t){return this.before(t).remove()},wrap:function(t){var e=M(t);if(this[0]&&!e)var n=i(t).get(0),r=n.parentNode||this.length>1;return this.each(function(o){i(this).wrapAll(e?t.call(this,o):r?n.cloneNode(!0):n)})},wrapAll:function(t){if(this[0]){i(this[0]).before(t=i(t));for(var e;(e=t.children()).length;)t=e.first();i(t).append(this)}return this},wrapInner:function(t){var e=M(t);return this.each(function(n){var r=i(this),o=r.contents(),a=e?t.call(this,n):t;o.length?o.wrapAll(a):r.append(a)})},unwrap:function(){return this.parent().each(function(){i(this).replaceWith(i(this).children())}),this},clone:function(){return this.map(function(){return this.cloneNode(!0)})},hide:function(){return this.css("display","none")},toggle:function(t){return this.each(function(){var n=i(this);(t===e?"none"==n.css("display"):t)?n.show():n.hide()})},prev:function(t){return i(this.pluck("previousElementSibling")).filter(t||"*")},next:function(t){return i(this.pluck("nextElementSibling")).filter(t||"*")},html:function(t){return 0 in arguments?this.each(function(e){var n=this.innerHTML;i(this).empty().append(J(this,t,e,n))}):0 in this?this[0].innerHTML:null},text:function(t){return 0 in arguments?this.each(function(e){var n=J(this,t,e,this.textContent);this.textContent=null==n?"":""+n}):0 in this?this.pluck("textContent").join(""):null},attr:function(t,i){var r;return"string"!=typeof t||1 in arguments?this.each(function(e){if(1===this.nodeType)if(F(t))for(n in t)Y(this,n,t[n]);else Y(this,t,J(this,i,e,this.getAttribute(t)))}):0 in this&&1==this[0].nodeType&&null!=(r=this[0].getAttribute(t))?r:e},removeAttr:function(t){return this.each(function(){1===this.nodeType&&t.split(" ").forEach(function(t){Y(this,t)},this)})},prop:function(t,e){return t=A[t]||t,1 in arguments?this.each(function(n){this[t]=J(this,e,n,this[t])}):this[0]&&this[0][t]},removeProp:function(t){return t=A[t]||t,this.each(function(){delete this[t]})},data:function(t,n){var i="data-"+t.replace(g,"-$1").toLowerCase(),r=1 in arguments?this.attr(i,n):this.attr(i);return null!==r?G(r):e},val:function(t){return 0 in arguments?(null==t&&(t=""),this.each(function(e){this.value=J(this,t,e,this.value)})):this[0]&&(this[0].multiple?i(this[0]).find("option").filter(function(){return this.selected}).pluck("value"):this[0].value)},offset:function(e){if(e)return this.each(function(t){var n=i(this),r=J(this,e,t,n.offset()),o=n.offsetParent().offset(),a={top:r.top-o.top,left:r.left-o.left};"static"==n.css("position")&&(a.position="relative"),n.css(a)});if(!this.length)return null;if(f.documentElement!==this[0]&&!i.contains(f.documentElement,this[0]))return{top:0,left:0};var n=this[0].getBoundingClientRect();return{left:n.left+t.pageXOffset,top:n.top+t.pageYOffset,width:Math.round(n.width),height:Math.round(n.height)}},css:function(t,e){if(arguments.length<2){var r=this[0];if("string"==typeof t){if(!r)return;return r.style[N(t)]||getComputedStyle(r,"").getPropertyValue(t)}if(D(t)){if(!r)return;var o={},a=getComputedStyle(r,"");return i.each(t,function(t,e){o[e]=r.style[N(e)]||a.getPropertyValue(e)}),o}}var s="";if("string"==k(t))e||0===e?s=Z(t)+":"+V(t,e):this.each(function(){this.style.removeProperty(Z(t))});else for(n in t)t[n]||0===t[n]?s+=Z(n)+":"+V(n,t[n])+";":this.each(function(){this.style.removeProperty(Z(n))});return this.each(function(){this.style.cssText+=";"+s})},index:function(t){return t?this.indexOf(i(t)[0]):this.parent().children().indexOf(this[0])},hasClass:function(t){return t?o.some.call(this,function(t){return this.test(K(t))},B(t)):!1},addClass:function(t){return t?this.each(function(e){if("className"in this){r=[];var n=K(this),o=J(this,t,e,n);o.split(/\s+/g).forEach(function(t){i(this).hasClass(t)||r.push(t)},this),r.length&&K(this,n+(n?" ":"")+r.join(" "))}}):this},removeClass:function(t){return this.each(function(n){if("className"in this){if(t===e)return K(this,"");r=K(this),J(this,t,n,r).split(/\s+/g).forEach(function(t){r=r.replace(B(t)," ")}),K(this,r.trim())}})},toggleClass:function(t,n){return t?this.each(function(r){var o=i(this),a=J(this,t,r,K(this));a.split(/\s+/g).forEach(function(t){(n===e?!o.hasClass(t):n)?o.addClass(t):o.removeClass(t)})}):this},scrollTop:function(t){if(this.length){var n="scrollTop"in this[0];return t===e?n?this[0].scrollTop:this[0].pageYOffset:this.each(n?function(){this.scrollTop=t}:function(){this.scrollTo(this.scrollX,t)})}},scrollLeft:function(t){if(this.length){var n="scrollLeft"in this[0];return t===e?n?this[0].scrollLeft:this[0].pageXOffset:this.each(n?function(){this.scrollLeft=t}:function(){this.scrollTo(t,this.scrollY)})}},position:function(){if(this.length){var t=this[0],e=this.offsetParent(),n=this.offset(),r=v.test(e[0].nodeName)?{top:0,left:0}:e.offset();return n.top-=parseFloat(i(t).css("margin-top"))||0,n.left-=parseFloat(i(t).css("margin-left"))||0,r.top+=parseFloat(i(e[0]).css("border-top-width"))||0,r.left+=parseFloat(i(e[0]).css("border-left-width"))||0,{top:n.top-r.top,left:n.left-r.left}}},offsetParent:function(){return this.map(function(){for(var t=this.offsetParent||f.body;t&&!v.test(t.nodeName)&&"static"==i(t).css("position");)t=t.offsetParent;return t})}},i.fn.detach=i.fn.remove,["width","height"].forEach(function(t){var n=t.replace(/./,function(t){return t[0].toUpperCase()});i.fn[t]=function(r){var o,a=this[0];return r===e?L(a)?a["inner"+n]:$(a)?a.documentElement["scroll"+n]:(o=this.offset())&&o[t]:this.each(function(e){a=i(this),a.css(t,J(this,r,e,a[t]()))})}}),b.forEach(function(n,r){var o=r%2;i.fn[n]=function(){var n,s,a=i.map(arguments,function(t){var r=[];return n=k(t),"array"==n?(t.forEach(function(t){return t.nodeType!==e?r.push(t):i.zepto.isZ(t)?r=r.concat(t.get()):void(r=r.concat(C.fragment(t)))}),r):"object"==n||null==t?t:C.fragment(t)}),u=this.length>1;return a.length<1?this:this.each(function(e,n){s=o?n:n.parentNode,n=0==r?n.nextSibling:1==r?n.firstChild:2==r?n:null;var c=i.contains(f.documentElement,s);a.forEach(function(e){if(u)e=e.cloneNode(!0);else if(!s)return i(e).remove();s.insertBefore(e,n),c&&Q(e,function(e){if(!(null==e.nodeName||"SCRIPT"!==e.nodeName.toUpperCase()||e.type&&"text/javascript"!==e.type||e.src)){var n=e.ownerDocument?e.ownerDocument.defaultView:t;n.eval.call(n,e.innerHTML)}})})})},i.fn[o?n+"To":"insert"+(r?"Before":"After")]=function(t){return i(t)[n](this),this}}),C.Z.prototype=W.prototype=i.fn,C.uniq=O,C.deserializeValue=G,i.zepto=C,i}();return t.Zepto=e,void 0===t.$&&(t.$=e),function(e){function h(t){return t._zid||(t._zid=n++)}function p(t,e,n,i){if(e=d(e),e.ns)var r=m(e.ns);return(s[h(t)]||[]).filter(function(t){return t&&(!e.e||t.e==e.e)&&(!e.ns||r.test(t.ns))&&(!n||h(t.fn)===h(n))&&(!i||t.sel==i)})}function d(t){var e=(""+t).split(".");return{e:e[0],ns:e.slice(1).sort().join(" ")}}function m(t){return new RegExp("(?:^| )"+t.replace(" "," .* ?")+"(?: |$)")}function v(t,e){return t.del&&!f&&t.e in c||!!e}function g(t){return l[t]||f&&c[t]||t}function y(t,n,r,o,a,u,f){var c=h(t),p=s[c]||(s[c]=[]);n.split(/\s/).forEach(function(n){if("ready"==n)return e(document).ready(r);var s=d(n);s.fn=r,s.sel=a,s.e in l&&(r=function(t){var n=t.relatedTarget;return!n||n!==this&&!e.contains(this,n)?s.fn.apply(this,arguments):void 0}),s.del=u;var c=u||r;s.proxy=function(e){if(e=T(e),!e.isImmediatePropagationStopped()){e.data=o;var n=c.apply(t,e._args==i?[e]:[e].concat(e._args));return n===!1&&(e.preventDefault(),e.stopPropagation()),n}},s.i=p.length,p.push(s),"addEventListener"in t&&t.addEventListener(g(s.e),s.proxy,v(s,f))})}function b(t,e,n,i,r){var o=h(t);(e||"").split(/\s/).forEach(function(e){p(t,e,n,i).forEach(function(e){delete s[o][e.i],"removeEventListener"in t&&t.removeEventListener(g(e.e),e.proxy,v(e,r))})})}function T(t,n){if(n||!t.isDefaultPrevented){n||(n=t),e.each(S,function(e,i){var r=n[e];t[e]=function(){return this[i]=x,r&&r.apply(n,arguments)},t[i]=E});try{t.timeStamp||(t.timeStamp=Date.now())}catch(r){}(n.defaultPrevented!==i?n.defaultPrevented:"returnValue"in n?n.returnValue===!1:n.getPreventDefault&&n.getPreventDefault())&&(t.isDefaultPrevented=x)}return t}function j(t){var e,n={originalEvent:t};for(e in t)w.test(e)||t[e]===i||(n[e]=t[e]);return T(n,t)}var i,n=1,r=Array.prototype.slice,o=e.isFunction,a=function(t){return"string"==typeof t},s={},u={},f="onfocusin"in t,c={focus:"focusin",blur:"focusout"},l={mouseenter:"mouseover",mouseleave:"mouseout"};u.click=u.mousedown=u.mouseup=u.mousemove="MouseEvents",e.event={add:y,remove:b},e.proxy=function(t,n){var i=2 in arguments&&r.call(arguments,2);if(o(t)){var s=function(){return t.apply(n,i?i.concat(r.call(arguments)):arguments)};return s._zid=h(t),s}if(a(n))return i?(i.unshift(t[n],t),e.proxy.apply(null,i)):e.proxy(t[n],t);throw new TypeError("expected function")},e.fn.bind=function(t,e,n){return this.on(t,e,n)},e.fn.unbind=function(t,e){return this.off(t,e)},e.fn.one=function(t,e,n,i){return this.on(t,e,n,i,1)};var x=function(){return!0},E=function(){return!1},w=/^([A-Z]|returnValue$|layer[XY]$|webkitMovement[XY]$)/,S={preventDefault:"isDefaultPrevented",stopImmediatePropagation:"isImmediatePropagationStopped",stopPropagation:"isPropagationStopped"};e.fn.delegate=function(t,e,n){return this.on(e,t,n)},e.fn.undelegate=function(t,e,n){return this.off(e,t,n)},e.fn.live=function(t,n){return e(document.body).delegate(this.selector,t,n),this},e.fn.die=function(t,n){return e(document.body).undelegate(this.selector,t,n),this},e.fn.on=function(t,n,s,u,f){var c,l,h=this;return t&&!a(t)?(e.each(t,function(t,e){h.on(t,n,s,e,f)}),h):(a(n)||o(u)||u===!1||(u=s,s=n,n=i),(u===i||s===!1)&&(u=s,s=i),u===!1&&(u=E),h.each(function(i,o){f&&(c=function(t){return b(o,t.type,u),u.apply(this,arguments)}),n&&(l=function(t){var i,a=e(t.target).closest(n,o).get(0);return a&&a!==o?(i=e.extend(j(t),{currentTarget:a,liveFired:o}),(c||u).apply(a,[i].concat(r.call(arguments,1)))):void 0}),y(o,t,u,s,n,l||c)}))},e.fn.off=function(t,n,r){var s=this;return t&&!a(t)?(e.each(t,function(t,e){s.off(t,n,e)}),s):(a(n)||o(r)||r===!1||(r=n,n=i),r===!1&&(r=E),s.each(function(){b(this,t,r,n)}))},e.fn.trigger=function(t,n){return t=a(t)||e.isPlainObject(t)?e.Event(t):T(t),t._args=n,this.each(function(){t.type in c&&"function"==typeof this[t.type]?this[t.type]():"dispatchEvent"in this?this.dispatchEvent(t):e(this).triggerHandler(t,n)})},e.fn.triggerHandler=function(t,n){var i,r;return this.each(function(o,s){i=j(a(t)?e.Event(t):t),i._args=n,i.target=s,e.each(p(s,t.type||t),function(t,e){return r=e.proxy(i),i.isImmediatePropagationStopped()?!1:void 0})}),r},"focusin focusout focus blur load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select keydown keypress keyup error".split(" ").forEach(function(t){e.fn[t]=function(e){return 0 in arguments?this.bind(t,e):this.trigger(t)}}),e.Event=function(t,e){a(t)||(e=t,t=e.type);var n=document.createEvent(u[t]||"Events"),i=!0;if(e)for(var r in e)"bubbles"==r?i=!!e[r]:n[r]=e[r];return n.initEvent(t,i,!0),T(n)}}(e),function(e){function p(t,n,i){var r=e.Event(n);return e(t).trigger(r,i),!r.isDefaultPrevented()}function d(t,e,n,r){return t.global?p(e||i,n,r):void 0}function m(t){t.global&&0===e.active++&&d(t,null,"ajaxStart")}function v(t){t.global&&!--e.active&&d(t,null,"ajaxStop")}function g(t,e){var n=e.context;return e.beforeSend.call(n,t,e)===!1||d(e,n,"ajaxBeforeSend",[t,e])===!1?!1:void d(e,n,"ajaxSend",[t,e])}function y(t,e,n,i){var r=n.context,o="success";n.success.call(r,t,o,e),i&&i.resolveWith(r,[t,o,e]),d(n,r,"ajaxSuccess",[e,n,t]),x(o,e,n)}function b(t,e,n,i,r){var o=i.context;i.error.call(o,n,e,t),r&&r.rejectWith(o,[n,e,t]),d(i,o,"ajaxError",[n,i,t||e]),x(e,n,i)}function x(t,e,n){var i=n.context;n.complete.call(i,e,t),d(n,i,"ajaxComplete",[e,n]),v(n)}function E(t,e,n){if(n.dataFilter==w)return t;var i=n.context;return n.dataFilter.call(i,t,e)}function w(){}function S(t){return t&&(t=t.split(";",2)[0]),t&&(t==c?"html":t==f?"json":s.test(t)?"script":u.test(t)&&"xml")||"text"}function T(t,e){return""==e?t:(t+"&"+e).replace(/[&?]{1,2}/,"?")}function j(t){t.processData&&t.data&&"string"!=e.type(t.data)&&(t.data=e.param(t.data,t.traditional)),!t.data||t.type&&"GET"!=t.type.toUpperCase()&&"jsonp"!=t.dataType||(t.url=T(t.url,t.data),t.data=void 0)}function C(t,n,i,r){return e.isFunction(n)&&(r=i,i=n,n=void 0),e.isFunction(i)||(r=i,i=void 0),{url:t,data:n,success:i,dataType:r}}function O(t,n,i,r){var o,a=e.isArray(n),s=e.isPlainObject(n);e.each(n,function(n,u){o=e.type(u),r&&(n=i?r:r+"["+(s||"object"==o||"array"==o?n:"")+"]"),!r&&a?t.add(u.name,u.value):"array"==o||!i&&"object"==o?O(t,u,i,n):t.add(n,u)})}var r,o,n=+new Date,i=t.document,a=/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,s=/^(?:text|application)\/javascript/i,u=/^(?:text|application)\/xml/i,f="application/json",c="text/html",l=/^\s*$/,h=i.createElement("a");h.href=t.location.href,e.active=0,e.ajaxJSONP=function(r,o){if(!("type"in r))return e.ajax(r);var c,p,a=r.jsonpCallback,s=(e.isFunction(a)?a():a)||"Zepto"+n++,u=i.createElement("script"),f=t[s],l=function(t){e(u).triggerHandler("error",t||"abort")},h={abort:l};return o&&o.promise(h),e(u).on("load error",function(n,i){clearTimeout(p),e(u).off().remove(),"error"!=n.type&&c?y(c[0],h,r,o):b(null,i||"error",h,r,o),t[s]=f,c&&e.isFunction(f)&&f(c[0]),f=c=void 0}),g(h,r)===!1?(l("abort"),h):(t[s]=function(){c=arguments},u.src=r.url.replace(/\?(.+)=\?/,"?$1="+s),i.head.appendChild(u),r.timeout>0&&(p=setTimeout(function(){l("timeout")},r.timeout)),h)},e.ajaxSettings={type:"GET",beforeSend:w,success:w,error:w,complete:w,context:null,global:!0,xhr:function(){return new t.XMLHttpRequest},accepts:{script:"text/javascript, application/javascript, application/x-javascript",json:f,xml:"application/xml, text/xml",html:c,text:"text/plain"},crossDomain:!1,timeout:0,processData:!0,cache:!0,dataFilter:w},e.ajax=function(n){var u,f,a=e.extend({},n||{}),s=e.Deferred&&e.Deferred();for(r in e.ajaxSettings)void 0===a[r]&&(a[r]=e.ajaxSettings[r]);m(a),a.crossDomain||(u=i.createElement("a"),u.href=a.url,u.href=u.href,a.crossDomain=h.protocol+"//"+h.host!=u.protocol+"//"+u.host),a.url||(a.url=t.location.toString()),(f=a.url.indexOf("#"))>-1&&(a.url=a.url.slice(0,f)),j(a);var c=a.dataType,p=/\?.+=\?/.test(a.url);if(p&&(c="jsonp"),a.cache!==!1&&(n&&n.cache===!0||"script"!=c&&"jsonp"!=c)||(a.url=T(a.url,"_="+Date.now())),"jsonp"==c)return p||(a.url=T(a.url,a.jsonp?a.jsonp+"=?":a.jsonp===!1?"":"callback=?")),e.ajaxJSONP(a,s);var P,d=a.accepts[c],v={},x=function(t,e){v[t.toLowerCase()]=[t,e]},C=/^([\w-]+:)\/\//.test(a.url)?RegExp.$1:t.location.protocol,N=a.xhr(),O=N.setRequestHeader;if(s&&s.promise(N),a.crossDomain||x("X-Requested-With","XMLHttpRequest"),x("Accept",d||"*/*"),(d=a.mimeType||d)&&(d.indexOf(",")>-1&&(d=d.split(",",2)[0]),N.overrideMimeType&&N.overrideMimeType(d)),(a.contentType||a.contentType!==!1&&a.data&&"GET"!=a.type.toUpperCase())&&x("Content-Type",a.contentType||"application/x-www-form-urlencoded"),a.headers)for(o in a.headers)x(o,a.headers[o]);if(N.setRequestHeader=x,N.onreadystatechange=function(){if(4==N.readyState){N.onreadystatechange=w,clearTimeout(P);var t,n=!1;if(N.status>=200&&N.status<300||304==N.status||0==N.status&&"file:"==C){if(c=c||S(a.mimeType||N.getResponseHeader("content-type")),"arraybuffer"==N.responseType||"blob"==N.responseType)t=N.response;else{t=N.responseText;try{t=E(t,c,a),"script"==c?(1,eval)(t):"xml"==c?t=N.responseXML:"json"==c&&(t=l.test(t)?null:e.parseJSON(t))}catch(i){n=i}if(n)return b(n,"parsererror",N,a,s)}y(t,N,a,s)}else b(N.statusText||null,N.status?"error":"abort",N,a,s)}},g(N,a)===!1)return N.abort(),b(null,"abort",N,a,s),N;var A="async"in a?a.async:!0;if(N.open(a.type,a.url,A,a.username,a.password),a.xhrFields)for(o in a.xhrFields)N[o]=a.xhrFields[o];for(o in v)O.apply(N,v[o]);return a.timeout>0&&(P=setTimeout(function(){N.onreadystatechange=w,N.abort(),b(null,"timeout",N,a,s)},a.timeout)),N.send(a.data?a.data:null),N},e.get=function(){return e.ajax(C.apply(null,arguments))},e.post=function(){var t=C.apply(null,arguments);return t.type="POST",e.ajax(t)},e.getJSON=function(){var t=C.apply(null,arguments);return t.dataType="json",e.ajax(t)},e.fn.load=function(t,n,i){if(!this.length)return this;var s,r=this,o=t.split(/\s/),u=C(t,n,i),f=u.success;return o.length>1&&(u.url=o[0],s=o[1]),u.success=function(t){r.html(s?e("<div>").html(t.replace(a,"")).find(s):t),f&&f.apply(r,arguments)},e.ajax(u),this};var N=encodeURIComponent;e.param=function(t,n){var i=[];return i.add=function(t,n){e.isFunction(n)&&(n=n()),null==n&&(n=""),this.push(N(t)+"="+N(n))},O(i,t,n),i.join("&").replace(/%20/g,"+")}}(e),function(t){t.fn.serializeArray=function(){var e,n,i=[],r=function(t){return t.forEach?t.forEach(r):void i.push({name:e,value:t})};return this[0]&&t.each(this[0].elements,function(i,o){n=o.type,e=o.name,e&&"fieldset"!=o.nodeName.toLowerCase()&&!o.disabled&&"submit"!=n&&"reset"!=n&&"button"!=n&&"file"!=n&&("radio"!=n&&"checkbox"!=n||o.checked)&&r(t(o).val())}),i},t.fn.serialize=function(){var t=[];return this.serializeArray().forEach(function(e){t.push(encodeURIComponent(e.name)+"="+encodeURIComponent(e.value))}),t.join("&")},t.fn.submit=function(e){if(0 in arguments)this.bind("submit",e);else if(this.length){var n=t.Event("submit");this.eq(0).trigger(n),n.isDefaultPrevented()||this.get(0).submit()}return this}}(e),function(){try{getComputedStyle(void 0)}catch(e){var n=getComputedStyle;t.getComputedStyle=function(t,e){try{return n(t,e)}catch(i){return null}}}}(),function(t){function e(t,e){var n=this.os={},i=this.browser={},r=t.match(/Web[kK]it[\/]{0,1}([\d.]+)/),o=t.match(/(Android);?[\s\/]+([\d.]+)?/),a=!!t.match(/\(Macintosh\; Intel /),s=t.match(/(iPad).*OS\s([\d_]+)/),u=t.match(/(iPod)(.*OS\s([\d_]+))?/),f=!s&&t.match(/(iPhone\sOS)\s([\d_]+)/),c=t.match(/(webOS|hpwOS)[\s\/]([\d.]+)/),l=/Win\d{2}|Windows/.test(e),h=t.match(/Windows Phone ([\d.]+)/),p=c&&t.match(/TouchPad/),d=t.match(/Kindle\/([\d.]+)/),m=t.match(/Silk\/([\d._]+)/),v=t.match(/(BlackBerry).*Version\/([\d.]+)/),g=t.match(/(BB10).*Version\/([\d.]+)/),y=t.match(/(RIM\sTablet\sOS)\s([\d.]+)/),b=t.match(/PlayBook/),x=t.match(/Chrome\/([\d.]+)/)||t.match(/CriOS\/([\d.]+)/),E=t.match(/Firefox\/([\d.]+)/),w=t.match(/\((?:Mobile|Tablet); rv:([\d.]+)\).*Firefox\/[\d.]+/),S=t.match(/MSIE\s([\d.]+)/)||t.match(/Trident\/[\d](?=[^\?]+).*rv:([0-9.].)/),T=!x&&t.match(/(iPhone|iPod|iPad).*AppleWebKit(?!.*Safari)/),j=T||t.match(/Version\/([\d.]+)([^S](Safari)|[^M]*(Mobile)[^S]*(Safari))/);(i.webkit=!!r)&&(i.version=r[1]),o&&(n.android=!0,n.version=o[2]),f&&!u&&(n.ios=n.iphone=!0,n.version=f[2].replace(/_/g,".")),s&&(n.ios=n.ipad=!0,n.version=s[2].replace(/_/g,".")),u&&(n.ios=n.ipod=!0,n.version=u[3]?u[3].replace(/_/g,"."):null),h&&(n.wp=!0,n.version=h[1]),c&&(n.webos=!0,n.version=c[2]),p&&(n.touchpad=!0),v&&(n.blackberry=!0,n.version=v[2]),g&&(n.bb10=!0,n.version=g[2]),y&&(n.rimtabletos=!0,n.version=y[2]),b&&(i.playbook=!0),d&&(n.kindle=!0,n.version=d[1]),m&&(i.silk=!0,i.version=m[1]),!m&&n.android&&t.match(/Kindle Fire/)&&(i.silk=!0),x&&(i.chrome=!0,i.version=x[1]),E&&(i.firefox=!0,i.version=E[1]),w&&(n.firefoxos=!0,n.version=w[1]),S&&(i.ie=!0,i.version=S[1]),j&&(a||n.ios||l)&&(i.safari=!0,n.ios||(i.version=j[1])),T&&(i.webview=!0),n.tablet=!!(s||b||o&&!t.match(/Mobile/)||E&&t.match(/Tablet/)||S&&!t.match(/Phone/)&&t.match(/Touch/)),n.phone=!(n.tablet||n.ipod||!(o||f||c||v||g||x&&t.match(/Android/)||x&&t.match(/CriOS\/([\d.]+)/)||E&&t.match(/Mobile/)||S&&t.match(/Touch/)))}e.call(t,navigator.userAgent,navigator.platform),t.__detect=e}(e),function(t){function a(o,a){var u=o[r],f=u&&e[u];if(void 0===a)return f||s(o);if(f){if(a in f)return f[a];var c=i(a);if(c in f)return f[c]}return n.call(t(o),a)}function s(n,o,a){var s=n[r]||(n[r]=++t.uuid),f=e[s]||(e[s]=u(n));return void 0!==o&&(f[i(o)]=a),f}function u(e){var n={};return t.each(e.attributes||o,function(e,r){0==r.name.indexOf("data-")&&(n[i(r.name.replace("data-",""))]=t.zepto.deserializeValue(r.value))}),n}var e={},n=t.fn.data,i=t.camelCase,r=t.expando="Zepto"+ +new Date,o=[];t.fn.data=function(e,n){return void 0===n?t.isPlainObject(e)?this.each(function(n,i){t.each(e,function(t,e){s(i,t,e)})}):0 in this?a(this[0],e):void 0:this.each(function(){s(this,e,n)})},t.data=function(e,n,i){return t(e).data(n,i)},t.hasData=function(n){var i=n[r],o=i&&e[i];return o?!t.isEmptyObject(o):!1},t.fn.removeData=function(n){return"string"==typeof n&&(n=n.split(/\s+/)),this.each(function(){var o=this[r],a=o&&e[o];a&&t.each(n||a,function(t){delete a[n?i(this):t]})})},["remove","empty"].forEach(function(e){var n=t.fn[e];t.fn[e]=function(){var t=this.find("*");return"remove"===e&&(t=t.add(this)),t.removeData(),n.call(this)}})}(e),function(t){function r(e){return e=t(e),!(!e.width()&&!e.height())&&"none"!==e.css("display")}function f(t,e){t=t.replace(/=#\]/g,'="#"]');var n,i,r=a.exec(t);if(r&&r[2]in o&&(n=o[r[2]],i=r[3],t=r[1],i)){var s=Number(i);i=isNaN(s)?i.replace(/^["']|["']$/g,""):s}return e(t,n,i)}var e=t.zepto,n=e.qsa,i=e.matches,o=t.expr[":"]={visible:function(){return r(this)?this:void 0},hidden:function(){return r(this)?void 0:this},selected:function(){return this.selected?this:void 0},checked:function(){return this.checked?this:void 0},parent:function(){return this.parentNode},first:function(t){return 0===t?this:void 0},last:function(t,e){return t===e.length-1?this:void 0},eq:function(t,e,n){return t===n?this:void 0},contains:function(e,n,i){return t(this).text().indexOf(i)>-1?this:void 0},has:function(t,n,i){return e.qsa(this,i).length?this:void 0}},a=new RegExp("(.*):(\\w+)(?:\\(([^)]+)\\))?$\\s*"),s=/^\s*>/,u="Zepto"+ +new Date;e.qsa=function(i,r){return f(r,function(o,a,f){try{var c;!o&&a?o="*":s.test(o)&&(c=t(i).addClass(u),o="."+u+" "+o);var l=n(i,o)}catch(h){throw console.error("error performing selector: %o",r),h}finally{c&&c.removeClass(u)}return a?e.uniq(t.map(l,function(t,e){return a.call(t,e,l,f)})):l})},e.matches=function(t,e){return f(e,function(e,n,r){return(!e||i(t,e))&&(!n||n.call(t,null,r)===t)})}}(e),e});