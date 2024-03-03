import{_ as u}from"./AuthenticatedLayout--C68QHzL.js";import{T as p,o as l,c,a as s,u as o,w as r,F as x,Z as h,b as a,d as e,i,r as m,t as n,g}from"./app-EENgHAwL.js";import{_ as y}from"./Pagination-IkT0GjKU.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const _={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},w={class:"bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg"},k={class:"w-full whitespace-nowrap"},v=e("thead",null,[e("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"#"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Siglas"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Maestría/Postg."),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Estado")])],-1),N={class:"border-t"},V={class:"border-t"},j={class:"border-t"},B={key:0,class:"border-t"},M={key:1,class:"border-t"},C={class:"flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"},T={__name:"Index",props:{masters:{type:Object}},setup(f){return p({id:""}),(d,E)=>(l(),c(x,null,[s(o(h),{title:"Masters"}),s(u,null,{header:r(()=>[a(" Maestrias y Postgrados ")]),default:r(()=>[e("div",_,[s(o(i),{href:d.route("masters.create"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:r(()=>[a("Nuevo")]),_:1},8,["href"])]),e("div",w,[e("table",k,[v,e("tbody",null,[(l(!0),c(x,null,m(f.masters.data,(t,b)=>(l(),c("tr",{key:t.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",N,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("masters.show",t.id)},{default:r(()=>[a(n(b+1),1)]),_:2},1032,["href"])]),e("td",V,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("masters.show",t.id)},{default:r(()=>[a(n(t.siglas),1)]),_:2},1032,["href"])]),e("td",j,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("masters.show",t.id)},{default:r(()=>[a(n(t.nombre),1)]),_:2},1032,["href"])]),t.activo==0?(l(),c("td",B,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("masters.show",t.id)},{default:r(()=>[a(" Inactivo ")]),_:2},1032,["href"])])):g("",!0),t.activo==1?(l(),c("td",M,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("masters.show",t.id)},{default:r(()=>[a(" Activo ")]),_:2},1032,["href"])])):g("",!0)]))),128))])])]),e("div",C,[s(y,{links:f.masters.links},null,8,["links"])])]),_:1})],64))}};export{T as default};