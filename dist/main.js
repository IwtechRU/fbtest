(()=>{"use strict";var e={607:function(e,n,t){var r=this&&this.__importDefault||function(e){return e&&e.__esModule?e:{default:e}};Object.defineProperty(n,"__esModule",{value:!0}),r(t(211)).default(".nfbp")},211:(e,n)=>{Object.defineProperty(n,"__esModule",{value:!0}),n.default=function(e){jQuery("body").on("submit",e,(function(e){e.preventDefault();let n=jQuery(this),t=function(e){let n=e.serializeArray(),t={};return jQuery.map(n,(function(e){t[e.name]=e.value})),t}(n);var r;(r=t,new Promise((e=>jQuery.ajax({url:nfbp.ajaxurl,method:"post",data:{action:"nfbpForm",nonce:nfbp.nonce,formData:r,agent:navigator.userAgent},success:function(n){e(n)}})))).then((e=>{var t,r;t=e,(r=n).find(".nfbpmessage").remove(),!1===t.success?r.prepend('<div class="nfbpmessage nfbp-error">'+t.data+"</div>"):r.prepend('<div class="nfbpmessage nfbp-success">'+t.data+"</div>")}))}))}}},n={};!function t(r){var a=n[r];if(void 0!==a)return a.exports;var s=n[r]={exports:{}};return e[r].call(s.exports,s,s.exports,t),s.exports}(607)})();