import{r as m,k as y,o as u,c as f,a as r,u as a,w as o,F as p,Z as w,b as d,d as e,j as _,l as k,i as l,m as v,t as i}from"./app-rIty18ko.js";import{_ as C}from"./AuthenticatedLayout-Smr3UiCu.js";import{_ as D}from"./Pagination-s3efSqcz.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const N={class:"flex items-center justify-between mb-6"},T={class:"bg-white grid v-screen overflow-hidden shadow-sm sm:rounded-lg"},j={class:"w-full whitespace-no-wrap"},B=e("thead",null,[e("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"#"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Nombre"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Cédula"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Teléfono"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Celular")])],-1),L={class:"border-t"},V={class:"border-t"},F={class:"border-t"},$={class:"border-t"},E={class:"border-t"},I={class:"flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between"},Z={__name:"Index",props:{docentes:{type:Object}},setup(x){const b=x,c=m(""),g=y(()=>{const s=c.value.toLowerCase();return b.docentes.data.filter(n=>n.nombre.toLowerCase().includes(s)||n.cedula.includes(s))});return(s,n)=>(u(),f(p,null,[r(a(w),{title:"Docentes"}),r(C,null,{header:o(()=>[d(" Docentes ")]),default:o(()=>[e("div",N,[_(e("input",{"onUpdate:modelValue":n[0]||(n[0]=t=>c.value=t),type:"text",class:"w-2/4 mt-4 p-2 border border-gray-300 rounded-md",placeholder:"Buscar docente..."},null,512),[[k,c.value]]),r(a(l),{href:s.route("docentes.create"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:o(()=>[d(" Nuevo ")]),_:1},8,["href"])]),e("div",T,[e("table",j,[B,e("tbody",null,[(u(!0),f(p,null,v(g.value,(t,h)=>(u(),f("tr",{key:t.id,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",L,[r(a(l),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("docentes.show",t.id)},{default:o(()=>[d(i(h+1),1)]),_:2},1032,["href"])]),e("td",V,[r(a(l),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("docentes.show",t.id)},{default:o(()=>[d(i(t.nombre),1)]),_:2},1032,["href"])]),e("td",F,[r(a(l),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("docentes.show",t.id)},{default:o(()=>[d(i(t.cedula),1)]),_:2},1032,["href"])]),e("td",$,[r(a(l),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("docentes.show",t.id)},{default:o(()=>[d(i(t.telefono),1)]),_:2},1032,["href"])]),e("td",E,[r(a(l),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("docentes.show",t.id)},{default:o(()=>[d(i(t.celular),1)]),_:2},1032,["href"])])]))),128))])])]),e("div",I,[r(D,{links:x.docentes.links},null,8,["links"])])]),_:1})],64))}};export{Z as default};