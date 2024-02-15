import{_ as u}from"./AuthenticatedLayout-nQ4tBulE.js";import{T as g,o as c,c as l,a as s,u as o,w as r,F as x,Z as p,b as a,d as e,i,r as m,t as n,f as b}from"./app-m9WqPV2z.js";import{_ as y}from"./Pagination-SXE20lBA.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const _={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},w={class:"bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg"},k={class:"w-full whitespace-nowrap"},v=e("thead",null,[e("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"#"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Período"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Fecha Inicial"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Fecha Final"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Estado")])],-1),F={class:"border-t"},N={class:"border-t"},V={class:"border-t"},j={class:"border-t"},B={key:0,class:"border-t"},I={key:1,class:"border-t"},P={class:"flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"},D={__name:"Index",props:{periodos:{type:Object}},setup(f){return g({id:""}),(d,A)=>(c(),l(x,null,[s(o(p),{title:"Periodos"}),s(u,null,{header:r(()=>[a(" Períodos Académicos ")]),default:r(()=>[e("div",_,[s(o(i),{href:d.route("periodos.create"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:r(()=>[a("Nuevo")]),_:1},8,["href"])]),e("div",w,[e("table",k,[v,e("tbody",null,[(c(!0),l(x,null,m(f.periodos.data,(t,h)=>(c(),l("tr",{key:t.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",F,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(n(h+1),1)]),_:2},1032,["href"])]),e("td",N,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(n(t.nombre),1)]),_:2},1032,["href"])]),e("td",V,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(n(t.fecha_ini),1)]),_:2},1032,["href"])]),e("td",j,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(n(t.fecha_fin),1)]),_:2},1032,["href"])]),t.activo==0?(c(),l("td",B,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(" Inactivo ")]),_:2},1032,["href"])])):b("",!0),t.activo==1?(c(),l("td",I,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("periodos.show",t.id)},{default:r(()=>[a(" Activo ")]),_:2},1032,["href"])])):b("",!0)]))),128))])])]),e("div",P,[s(y,{links:f.periodos.links},null,8,["links"])])]),_:1})],64))}};export{D as default};
