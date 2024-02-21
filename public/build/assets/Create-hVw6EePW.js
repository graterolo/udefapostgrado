import{T as h,o as c,c as m,a as i,u as s,w as n,F as f,Z as b,b as u,d as e,i as x,h as w,j as g,v as p,m as V,n as k,t as v}from"./app-rIty18ko.js";import{_ as S}from"./AuthenticatedLayout-Smr3UiCu.js";import{_ as r}from"./InputError-ngFdGzkP.js";import{_ as a}from"./InputLabel-9Fx6gtGj.js";import{_ as $}from"./PrimaryButton-Eq5VYNt2.js";import{_ as j}from"./TextInput-fP6DTnaF.js";import{_ as y}from"./SelectInput-B3VNemPm.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const q={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},U={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},C={class:"p-6 border-b border-gray-200"},M={class:"mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},O={class:"sm:col-span-3"},A={class:"mt-2"},B=e("option",{value:null,disabled:""},"Selecciona una opción",-1),D=["value"],N={class:"sm:col-span-3"},E={class:"mt-2"},F={class:"sm:col-span-3"},L={class:"mt-2"},P={class:"sm:col-span-2"},T={class:"mt-2"},z=e("option",{value:"0"},"Presencial",-1),G=e("option",{value:"1"},"Semi-presencial",-1),I=e("option",{value:"2"},"Virtual",-1),Z=[z,G,I],H={class:"sm:col-span-2"},J={class:"mt-2"},K={class:"sm:col-span-2"},Q={class:"mt-2"},R=e("option",{value:"0"},"Inactivo",-1),W=e("option",{value:"1"},"Activo",-1),X=[R,W],Y={class:"mt-4 flex flex-col items-end"},ne={__name:"Create",props:{errors:{type:Object},plans:{type:Object},periodos:{type:Object},docentes:{type:Object}},setup(l){const o=h({plan_id:"",periodo_id:"",docente_id:"",modalidad:"",cupo:"",activo:""});return(_,d)=>(c(),m(f,null,[i(s(b),{title:"Agregar Sección"}),i(S,null,{header:n(()=>[u(" Agregar Sección ")]),default:n(()=>[e("div",q,[i(s(x),{href:_.route("infoseccions.index"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:n(()=>[u("Listado")]),_:1},8,["href"])]),e("div",U,[e("div",C,[e("form",{onSubmit:d[6]||(d[6]=w(t=>s(o).post(_.route("infoseccions.store")),["prevent"]))},[e("div",M,[e("div",O,[i(a,{for:"plan_id",value:"Materia"}),e("div",A,[g(e("select",{"onUpdate:modelValue":d[0]||(d[0]=t=>s(o).plan_id=t),class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",required:"",autofocus:""},[B,(c(!0),m(f,null,V(l.plans,t=>(c(),m("option",{key:t.id,value:t.id},v(t.codigo)+" - "+v(t.nombre),9,D))),128))],512),[[p,s(o).plan_id]]),i(r,{class:"mt-2",message:s(o).errors.plan_id},null,8,["message"])])]),e("div",N,[i(a,{for:"periodo_id",value:"Período"}),e("div",E,[i(y,{id:"periodo_id",options:l.periodos,type:"text",modelValue:s(o).periodo_id,"onUpdate:modelValue":d[1]||(d[1]=t=>s(o).periodo_id=t),class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",required:""},null,8,["options","modelValue"]),i(r,{class:"mt-2",message:s(o).errors.periodo_id},null,8,["message"])])]),e("div",F,[i(a,{for:"docente_id",value:"Docente"}),e("div",L,[i(y,{id:"docente_id",options:l.docentes,type:"text",modelValue:s(o).docente_id,"onUpdate:modelValue":d[2]||(d[2]=t=>s(o).docente_id=t),class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",required:""},null,8,["options","modelValue"]),i(r,{class:"mt-2",message:s(o).errors.docente_id},null,8,["message"])])]),e("div",P,[i(a,{for:"modalidad",value:"Modalidad"}),e("div",T,[g(e("select",{id:"modalidad",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6","onUpdate:modelValue":d[3]||(d[3]=t=>s(o).modalidad=t),required:""},Z,512),[[p,s(o).modalidad]]),i(r,{class:"mt-2",message:s(o).errors.modalidad},null,8,["message"])])]),e("div",H,[i(a,{for:"cupo",value:"Cupo"}),e("div",J,[i(j,{id:"cupo",type:"number",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:s(o).cupo,"onUpdate:modelValue":d[4]||(d[4]=t=>s(o).cupo=t),required:"",autocomplete:"cupo"},null,8,["modelValue"]),i(r,{class:"mt-2",message:s(o).errors.cupo},null,8,["message"])])]),e("div",K,[i(a,{for:"activo",value:"Estatus"}),e("div",Q,[g(e("select",{id:"activo",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6","onUpdate:modelValue":d[5]||(d[5]=t=>s(o).activo=t),required:""},X,512),[[p,s(o).activo]]),i(r,{class:"mt-2",message:s(o).errors.activo},null,8,["message"])])])]),e("div",Y,[i($,{class:k(["w-full",{"opacity-25":s(o).processing}]),disabled:s(o).processing},{default:n(()=>[u(" Guardar ")]),_:1},8,["class","disabled"])])],32)])])]),_:1})],64))}};export{ne as default};
