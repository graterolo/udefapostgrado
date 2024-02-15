import{_ as b}from"./AuthenticatedLayout-nQ4tBulE.js";import{T as h,o as c,c as l,a as s,u as o,w as r,F as u,Z as g,b as a,d as t,i,r as m,t as f,f as n}from"./app-m9WqPV2z.js";import{_ as y}from"./Pagination-SXE20lBA.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const _={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},w={class:"bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg"},k={class:"w-full whitespace-nowrap"},v=t("thead",null,[t("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"#"),t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Período"),t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Sección"),t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Modalidad"),t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Cupo"),t("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Estado")])],-1),C={class:"border-t"},N={class:"border-t"},V={class:"border-t"},j={key:0,class:"border-t"},A={key:1,class:"border-t"},B={key:2,class:"border-t"},P={class:"border-t"},S={key:3,class:"border-t"},E={key:4,class:"border-t"},F={class:"flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"},M={__name:"Index",props:{infoseccions:{type:Object}},setup(x){return h({id:""}),(d,I)=>(c(),l(u,null,[s(o(g),{title:" Carga Académica"}),s(b,null,{header:r(()=>[a(" Carga Académica ")]),default:r(()=>[t("div",_,[s(o(i),{href:d.route("infoseccions.create"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:r(()=>[a("Nuevo")]),_:1},8,["href"])]),t("div",w,[t("table",k,[v,t("tbody",null,[(c(!0),l(u,null,m(x.infoseccions.data,(e,p)=>(c(),l("tr",{key:e.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[t("td",C,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(f(p+1),1)]),_:2},1032,["href"])]),t("td",N,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(f(e.pnombre),1)]),_:2},1032,["href"])]),t("td",V,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(f(e.nombre),1)]),_:2},1032,["href"])]),e.modalidad==0?(c(),l("td",j,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(" Presencial ")]),_:2},1032,["href"])])):n("",!0),e.modalidad==1?(c(),l("td",A,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(" Semi-Presencial ")]),_:2},1032,["href"])])):n("",!0),e.modalidad==2?(c(),l("td",B,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(" Virtual ")]),_:2},1032,["href"])])):n("",!0),t("td",P,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(f(e.cupo),1)]),_:2},1032,["href"])]),e.activo==0?(c(),l("td",S,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(" Inactivo ")]),_:2},1032,["href"])])):n("",!0),e.activo==1?(c(),l("td",E,[s(o(i),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:d.route("infoseccions.show",e.id)},{default:r(()=>[a(" Activo ")]),_:2},1032,["href"])])):n("",!0)]))),128))])])]),t("div",F,[s(y,{links:x.infoseccions.links},null,8,["links"])])]),_:1})],64))}};export{M as default};
