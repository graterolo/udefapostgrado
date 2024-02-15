import{T as f,o as y,c as _,a as e,u as s,w as m,F as b,Z as h,b as g,d as r,i as x,g as v,n as V}from"./app-m9WqPV2z.js";import{_ as w}from"./AuthenticatedLayout-nQ4tBulE.js";import{_ as i}from"./InputError-TaJx20a4.js";import{_ as n}from"./InputLabel-l-dna64y.js";import{_ as k}from"./PrimaryButton-Lc_ltVlJ.js";import{_ as U}from"./SelectInput-OHssneIs.js";import{D as $}from"./DangerButton-p6hKzfbv.js";import{_ as d}from"./TextInput-AHc5i8tr.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const P={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},E={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},j={class:"p-6 border-b border-gray-200"},q={class:"mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},C={class:"sm:col-span-3"},B={class:"mt-2"},M={class:"sm:col-span-2"},N={class:"mt-2"},O={class:"sm:col-span-3"},T={class:"mt-2"},A={class:"sm:col-span-2"},D={class:"mt-2"},F={class:"sm:col-span-2"},H={class:"mt-2"},S={class:"sm:col-span-1"},z={class:"mt-2"},G={class:"sm:col-span-1"},L={class:"mt-2"},Z={class:"sm:col-span-1"},I={class:"mt-2"},J={class:"sm:col-span-1"},K={class:"mt-2"},Q={class:"mt-4 flex flex-col items-end"},R={class:"overflow-hidden mt-2 sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end"},te={__name:"Edit",props:{errors:{type:Object},plan:{type:Object},masters:{type:Object}},setup(u){const t=u,o=f({master_id:t.plan.master_id,codigo:t.plan.codigo,nombre:t.plan.nombre,prelacion1:t.plan.prelacion1,prelacion2:t.plan.prelacion2,semestre:t.plan.semestre,uc:t.plan.uc,horast:t.plan.horast,horasp:t.plan.horasp}),p=c=>{confirm("Está seguro de eliminar esta materia del plan de estudios?")&&o.delete(route("plans.destroy",c))};return(c,a)=>(y(),_(b,null,[e(s(h),{title:"Agregar Plan de Estudio"}),e(w,null,{header:m(()=>[g(" Agregar Plan de Estudio ")]),default:m(()=>[r("div",P,[e(s(x),{href:c.route("plans.index"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:m(()=>[g("Listado")]),_:1},8,["href"])]),r("div",E,[r("div",j,[r("form",{onSubmit:a[9]||(a[9]=v(l=>s(o).patch(c.route("plans.update",u.plan)),["prevent"]))},[r("div",q,[r("div",C,[e(n,{for:"master_id",value:"Mastría o Postgrado"}),r("div",B,[e(U,{id:"master_id",options:u.masters,type:"text",modelValue:s(o).master_id,"onUpdate:modelValue":a[0]||(a[0]=l=>s(o).master_id=l),class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",required:"",autofocus:""},null,8,["options","modelValue"]),e(i,{class:"mt-2",message:s(o).errors.master_id},null,8,["message"])])]),r("div",M,[e(n,{for:"codigo",value:"Código"}),r("div",N,[e(d,{id:"codigo",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).codigo,"onUpdate:modelValue":a[1]||(a[1]=l=>s(o).codigo=l),required:"",autocomplete:"codigo"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.codigo},null,8,["message"])])]),r("div",O,[e(n,{for:"nombre",value:"Materia"}),r("div",T,[e(d,{id:"nombre",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).nombre,"onUpdate:modelValue":a[2]||(a[2]=l=>s(o).nombre=l),required:"",autocomplete:"nombre"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.nombre},null,8,["message"])])]),r("div",A,[e(n,{for:"prelacion1",value:"Prelación 1"}),r("div",D,[e(d,{id:"prelacion1",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).prelacion1,"onUpdate:modelValue":a[3]||(a[3]=l=>s(o).prelacion1=l),autocomplete:"prelacion1"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.prelacion1},null,8,["message"])])]),r("div",F,[e(n,{for:"prelacion2",value:"Prelación 2"}),r("div",H,[e(d,{id:"prelacion2",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).prelacion2,"onUpdate:modelValue":a[4]||(a[4]=l=>s(o).prelacion2=l),autocomplete:"prelacion2"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.prelacion2},null,8,["message"])])]),r("div",S,[e(n,{for:"semestre",value:"Semestre"}),r("div",z,[e(d,{id:"semestre",type:"number",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).semestre,"onUpdate:modelValue":a[5]||(a[5]=l=>s(o).semestre=l),required:"",autocomplete:"semestre"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.semestre},null,8,["message"])])]),r("div",G,[e(n,{for:"uc",value:"UC"}),r("div",L,[e(d,{id:"uc",type:"number",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).uc,"onUpdate:modelValue":a[6]||(a[6]=l=>s(o).uc=l),required:"",autocomplete:"uc"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.uc},null,8,["message"])])]),r("div",Z,[e(n,{for:"horast",value:"Horas T."}),r("div",I,[e(d,{id:"horast",type:"number",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).horast,"onUpdate:modelValue":a[7]||(a[7]=l=>s(o).horast=l),autocomplete:"horast"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.horast},null,8,["message"])])]),r("div",J,[e(n,{for:"horasp",value:"Horas P."}),r("div",K,[e(d,{id:"horasp",type:"number",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).horasp,"onUpdate:modelValue":a[8]||(a[8]=l=>s(o).horasp=l),autocomplete:"horasp"},null,8,["modelValue"]),e(i,{class:"mt-2",message:s(o).errors.horasp},null,8,["message"])])])]),r("div",Q,[e(k,{class:V(["w-full",{"opacity-25":s(o).processing}]),disabled:s(o).processing},{default:m(()=>[g(" Guardar ")]),_:1},8,["class","disabled"])])],32)]),r("div",R,[e($,{onClick:a[10]||(a[10]=l=>p(u.plan.id))},{default:m(()=>[g(" Eliminar ")]),_:1})])])]),_:1})],64))}};export{te as default};
