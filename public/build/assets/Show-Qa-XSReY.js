import{j as y,o,c as n,a as r,u as a,w as i,Z as v,b as d,d as e,e as h,i as c,f as l,t as f,h as _,k as w,F as k,r as D}from"./app-m9WqPV2z.js";import{_ as S}from"./AuthenticatedLayout-nQ4tBulE.js";import{_ as m}from"./InputLabel-l-dna64y.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const V={class:"overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end"},j={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},F={class:"p-6 border-b border-gray-200"},N={class:"mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},P={class:"sm:col-span-2"},$={class:"mt-2"},B={name:"nombre",id:"nombre",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"},E={class:"sm:col-span-4"},L={class:"mt-2"},A={class:"sm:col-span-2"},C={class:"mt-2"},I={class:"sm:col-span-2"},M={class:"mt-2"},O={key:0,name:"activo",id:"activo",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"},T={key:1,name:"activo",id:"activo",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"},U={class:"justify-between flex flex-row space-x-2 mb-2"},z=e("div",{class:"mt-10 text-2xl text-gray-900 shadow-sm"},"Secciones",-1),Z={class:"mt-10 ml-10 overflow-hidden shadow-sm sm:rounded-lg"},q={class:"mt-6 bg-white rounded shadow overflow-x-auto"},G={class:"w-full whitespace-nowrap"},H=e("tr",{class:"border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500"},[e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Sección"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Modalidad"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Cupo"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Docente"),e("th",{class:"border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"},"Estado")],-1),J={class:"border-t"},K={key:0,class:"border-t"},Q={key:1,class:"border-t"},R={key:2,class:"border-t"},W={class:"border-t"},X={class:"border-t"},Y={key:3,class:"border-t"},ee={key:4,class:"border-t"},te={key:0},se=e("td",{class:"px-6 py-4 border-t",colspan:"4"},"No hay secciones en este período",-1),oe=[se],ne={__name:"Show",props:{periodo:{type:Object},infoseccions:{type:Object}},setup(g){const p=g,x=y(()=>new Date(p.periodo.fecha_ini).toLocaleDateString()),b=y(()=>new Date(p.periodo.fecha_fin).toLocaleDateString());return(s,u)=>(o(),n("div",null,[r(a(v),{title:"Período"}),r(S,null,{header:i(()=>[d(" Período ")]),default:i(()=>[e("div",V,[s.$page.props.auth.user.tipo===2?(o(),h(a(c),{key:0,href:s.route("periodos.edit",g.periodo.id),class:"inline-flex items-right px-4 py-2 gap-0.5 bg-amber-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-amber-500 active:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2 transition ease-in-out duration-150"},{default:i(()=>[d("Editar")]),_:1},8,["href"])):l("",!0),s.$page.props.auth.user.tipo===2?(o(),h(a(c),{key:1,href:s.route("periodos.index"),class:"inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"},{default:i(()=>[d("Listado")]),_:1},8,["href"])):l("",!0)]),e("div",j,[e("div",F,[e("div",N,[e("div",P,[e("div",$,[r(m,{for:"nombre",value:"Período"}),e("textarea",B,f(g.periodo.nombre),1)])]),e("div",E,[e("div",L,[r(m,{for:"fecha_ini",value:"Fecha de Inicio"}),_(e("textarea",{"onUpdate:modelValue":u[0]||(u[0]=t=>x.value=t),name:"fecha",id:"fecha",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",readonly:""},null,512),[[w,x.value]])])]),e("div",A,[e("div",C,[r(m,{for:"fecha_fin",value:"Fecha de Finalización"}),_(e("textarea",{"onUpdate:modelValue":u[1]||(u[1]=t=>b.value=t),name:"fecha2",id:"fecha2",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",readonly:""},null,512),[[w,b.value]])])]),e("div",I,[e("div",M,[r(m,{for:"activo",value:"Estado"}),g.periodo.activo==0?(o(),n("textarea",O,"Inactivo")):(o(),n("textarea",T,"Activo"))])])])])]),e("div",U,[z,e("div",Z,[s.$page.props.auth.user.tipo===2?(o(),h(a(c),{key:0,href:s.route("infoseccions.create"),class:"inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"},{default:i(()=>[d("Agregar +")]),_:1},8,["href"])):l("",!0)])]),e("div",q,[e("table",G,[H,(o(!0),n(k,null,D(g.infoseccions,t=>(o(),n("tr",{key:t.iid,class:"hover:bg-gray-100 focus-within:bg-gray-100"},[e("td",J,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(f(t.nombre),1)]),_:2},1032,["href"])]),t.modalidad===0?(o(),n("td",K,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(" Presencial ")]),_:2},1032,["href"])])):l("",!0),t.modalidad===1?(o(),n("td",Q,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(" Semi-Presencial ")]),_:2},1032,["href"])])):l("",!0),t.modalidad===2?(o(),n("td",R,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(" Virtual ")]),_:2},1032,["href"])])):l("",!0),e("td",W,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(f(t.cupo),1)]),_:2},1032,["href"])]),e("td",X,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(f(t.dnombre),1)]),_:2},1032,["href"])]),t.activo===0?(o(),n("td",Y,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(" Inactivo ")]),_:2},1032,["href"])])):l("",!0),t.activo===1?(o(),n("td",ee,[r(a(c),{class:"flex items-center px-5 py-3 focus:text-indigo-500 text-sm",href:s.route("infoseccions.show",t.iid)},{default:i(()=>[d(" Activo ")]),_:2},1032,["href"])])):l("",!0)]))),128)),g.infoseccions.length===0?(o(),n("tr",te,oe)):l("",!0)])])]),_:1})]))}};export{ne as default};
