(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["48c7bbd9"],{"02fa":function(e,t,n){var a=n("268f"),r=n("e265"),o=n("a4bb"),i=n("c47a");function s(e){for(var t=1;t<arguments.length;t++){var n=null!=arguments[t]?arguments[t]:{},s=o(n);"function"===typeof r&&(s=s.concat(r(n).filter(function(e){return a(n,e).enumerable}))),s.forEach(function(t){i(e,t,n[t])})}return e}e.exports=s},"268f":function(e,t,n){e.exports=n("fde4")},"32a6":function(e,t,n){var a=n("241e"),r=n("c3a1");n("ce7e")("keys",function(){return function(e){return r(a(e))}})},"454f":function(e,t,n){n("46a7");var a=n("584a").Object;e.exports=function(e,t,n){return a.defineProperty(e,t,n)}},"46a7":function(e,t,n){var a=n("63b6");a(a.S+a.F*!n("8e60"),"Object",{defineProperty:n("d9f6").f})},"85f2":function(e,t,n){e.exports=n("454f")},"86dd":function(e,t,n){"use strict";n.r(t);var a=function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("q-scroll-area",{staticStyle:{height:"calc(100vh - 56px)"},attrs:{"thumb-style":e.getThumbStyle}},[n("q-page",{staticClass:"admin__page__genres"},[n("div",{staticClass:"q-pa-md"},[n("q-breadcrumbs",{attrs:{"active-color":"teal"}},[n("q-breadcrumbs-el",{attrs:{icon:"home",label:"Home",to:"/"}}),n("q-breadcrumbs-el",{attrs:{label:"Dashboard",to:"/admin"}}),n("q-breadcrumbs-el",{attrs:{label:"Genres",to:"/admin/genres"}}),n("q-breadcrumbs-el",{attrs:{label:"Show"}})],1)],1),n("div",{staticClass:"q-pa-md q-gutter-y-md"},[n("q-card",{staticClass:"q-pa-md q-gutter-y-md"},[n("q-list",{attrs:{bordered:"",separator:""}},[n("q-item",[n("q-item-section",[e._v("name"+e._s(e.genre["name_"+e.$t("lang_code")]))])],1),n("q-item",{attrs:{clickable:""}},[n("q-item-section",[n("q-item-label",{staticClass:"py-2"},[e._v("description"+e._s(e.genre["description_"+e.$t("lang_code")]))]),n("q-expansion-item",{staticClass:"expand",attrs:{"expand-separator":"",label:"Children","header-class":"text-grey","default-opened":""}},e._l(e.genre.children,function(t,a){return n("q-item",{key:a,attrs:{dense:""}},[n("q-item-section",[n("q-item-label",[e._v(e._s(t.name))])],1)],1)}),1)],1)],1)],1)],1)],1)])],1)},r=[],o=(n("28a5"),n("02fa")),i=n.n(o),s=n("2f62"),c={name:"GenresShow",data:function(){return{id:null,loading:!1,count:1,columns:[{name:"name",align:"center",label:"Name",field:"name",sortable:!0},{name:"cover",label:"Image",field:"cover"},{name:"actions",label:"Actions",field:"action"}],genre:[]}},computed:i()({},Object(s["c"])(["getToken","getLangPr","mobileDetect","getThumbStyle"])),beforeMount:function(){var e=this;this.id=this.$route.params.id,this.$axios.get(this.getDomain+this.getLangPr.split("-")[0]+"/genres/"+this.id).then(function(t){e.genre=t.data})},mounted:function(){var e=this;this.$store.subscribe(function(t,n){switch(t.type){case"CHANGE_LANG":setTimeout(function(){e.$axios.get(e.domains+e.$t("lang_code")+"/genres/"+e.id).then(function(t){e.genre=t.data})},100);break}})},methods:{deleteBook:function(e){var t=this;console.log(e),this.$q.dialog({title:"Подтвердите",message:"Вы точно хотите удалить?",cancel:!0,persistent:!0}).onOk(function(){t.$axios.defaults.headers={"x-api-key":"18f057d42feadf59b4943b7fb4c064fcd626778f","x-session-token":t.getToken},t.$axios.delete(t.domains+t.$t("lang_code")+"/genres/"+e).then(function(){t.genres.forEach(function(n,a){if(n.id===e)return t.genres.splice(a,1)}),t.$q.notify({color:"teal",icon:"check_circle",message:"Deleted",position:"top",timeout:200})})})},view:function(e){this.$router.push("/genres/show/"+e)}}},l=c,u=n("2877"),f=Object(u["a"])(l,a,r,!1,null,"a1cee008",null);t["default"]=f.exports},"8aae":function(e,t,n){n("32a6"),e.exports=n("584a").Object.keys},a4bb:function(e,t,n){e.exports=n("8aae")},bf90:function(e,t,n){var a=n("36c3"),r=n("bf0b").f;n("ce7e")("getOwnPropertyDescriptor",function(){return function(e,t){return r(a(e),t)}})},c47a:function(e,t,n){var a=n("85f2");function r(e,t,n){return t in e?a(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}e.exports=r},ce7e:function(e,t,n){var a=n("63b6"),r=n("584a"),o=n("294c");e.exports=function(e,t){var n=(r.Object||{})[e]||Object[e],i={};i[e]=t(n),a(a.S+a.F*o(function(){n(1)}),"Object",i)}},e265:function(e,t,n){e.exports=n("ed33")},ed33:function(e,t,n){n("014b"),e.exports=n("584a").Object.getOwnPropertySymbols},fde4:function(e,t,n){n("bf90");var a=n("584a").Object;e.exports=function(e,t){return a.getOwnPropertyDescriptor(e,t)}}}]);
