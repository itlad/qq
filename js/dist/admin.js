module.exports=function(t){var e={};function n(r){if(e[r])return e[r].exports;var i=e[r]={i:r,l:!1,exports:{}};return t[r].call(i.exports,i,i.exports,n),i.l=!0,i.exports}return n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var i in t)n.d(r,i,function(e){return t[e]}.bind(null,i));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=7)}({0:function(t,e){t.exports=flarum.core.compat["common/app"]},7:function(t,e,n){"use strict";n.r(e);var r=n(0),i=n.n(r);i.a.initializers.add("itlad-qq",(function(){i.a.extensionData.for("itlad-qq").registerSetting({label:i.a.translator.trans("itlad-qq.admin.qq_settings.client_id_label"),setting:"itlad-qq.client_id",type:"text"}).registerSetting({label:i.a.translator.trans("itlad-qq.admin.qq_settings.client_secret_label"),setting:"itlad-qq.client_secret",type:"text"})}))}});
//# sourceMappingURL=admin.js.map