import{T as f,o as p,c as _,a as o,u as e,w as m,F as b,Z as h,b as c,d as l,e as y,i as x,f as v,g as V,h as w,v as k,n as U}from"./app-m9WqPV2z.js";import{_ as q}from"./AuthenticatedLayout-nQ4tBulE.js";import{_ as d}from"./InputError-TaJx20a4.js";import{_ as i}from"./InputLabel-l-dna64y.js";import{_ as N}from"./PrimaryButton-Lc_ltVlJ.js";import{_ as n}from"./TextInput-AHc5i8tr.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const $={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},C={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},E={class:"p-6 border-b border-gray-200"},A={class:"mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},B={class:"sm:col-span-3"},F={class:"mt-2"},S={class:"sm:col-span-3"},T={class:"mt-2"},j={class:"sm:col-span-3"},D={class:"mt-2"},M={class:"sm:col-span-3"},P={class:"mt-2"},G={class:"sm:col-span-3"},O={class:"mt-2"},z={class:"sm:col-span-3"},L={class:"mt-2"},Z={class:"sm:col-span-2"},H={class:"mt-2"},I=l("option",{value:"0"},"Femenino",-1),J=l("option",{value:"1"},"Masculino",-1),K=[I,J],Q={class:"sm:col-span-4"},R={class:"mt-2"},W={class:"sm:col-span-2"},X={class:"mt-2"},Y={class:"sm:col-span-2"},ee={class:"mt-2"},se={class:"sm:col-span-2"},oe={class:"mt-2"},le={class:"sm:col-span-2"},ae={class:"mt-2"},te={class:"sm:col-span-4"},re={class:"mt-2"},de={class:"mt-4 flex flex-col items-end"},fe={__name:"Edit",props:{errors:{type:Object},alumno:{type:Object}},setup(g){const r=g,s=f({cedula:r.alumno.cedula,nombre1:r.alumno.nombre1,nombre2:r.alumno.nombre2,apellido1:r.alumno.apellido1,apellido2:r.alumno.apellido2,fecha_nac:r.alumno.fecha_nac,sexo:r.alumno.sexo,direc_hab:r.alumno.direc_hab,edo_hab:r.alumno.edo_hab,ciud_hab:r.alumno.ciud_hab,telefono:r.alumno.telefono,celular:r.alumno.celular,titulo:r.alumno.titulo});return(u,a)=>(p(),_(b,null,[o(e(h),{title:"Editar Alumno"}),o(q,null,{header:m(()=>[c(" Editar Datos Personales del Alumno ")]),default:m(()=>[l("div",$,[u.$page.props.auth.user.tipo===2?(p(),y(e(x),{key:0,href:u.route("alumnos.index"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:m(()=>[c("Listado")]),_:1},8,["href"])):v("",!0)]),l("div",C,[l("div",E,[l("form",{onSubmit:a[13]||(a[13]=V(t=>e(s).patch(u.route("alumnos.update",g.alumno)),["prevent"]))},[l("div",A,[l("div",B,[l("div",F,[o(i,{for:"cedula",value:"Cédula"}),o(n,{id:"cedula",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).cedula,"onUpdate:modelValue":a[0]||(a[0]=t=>e(s).cedula=t),required:"",autocomplete:"cedula",readonly:""},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.cedula},null,8,["message"])])]),l("div",S,[l("div",T,[o(i,{for:"nombre1",value:"Primer Nombre"}),o(n,{id:"nombre1",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).nombre1,"onUpdate:modelValue":a[1]||(a[1]=t=>e(s).nombre1=t),required:"",autofocus:"",autocomplete:"nombre1"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.nombre1},null,8,["message"])])]),l("div",j,[l("div",D,[o(i,{for:"nombre2",value:"Segundo Nombre"}),o(n,{id:"nombre2",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).nombre2,"onUpdate:modelValue":a[2]||(a[2]=t=>e(s).nombre2=t),autocomplete:"nombre2"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.nombre2},null,8,["message"])])]),l("div",M,[l("div",P,[o(i,{for:"apellido1",value:"Primer Apellido"}),o(n,{id:"apellido1",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).apellido1,"onUpdate:modelValue":a[3]||(a[3]=t=>e(s).apellido1=t),required:"",autocomplete:"apellido1"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.apellido1},null,8,["message"])])]),l("div",G,[l("div",O,[o(i,{for:"apellido2",value:"Segundo Apellido"}),o(n,{id:"apellido2",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).apellido2,"onUpdate:modelValue":a[4]||(a[4]=t=>e(s).apellido2=t),autocomplete:"apellido2"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.apellido2},null,8,["message"])])]),l("div",z,[l("div",L,[o(i,{for:"fecha_nac",value:"Fecha de Nacimiento"}),o(n,{id:"fecha_nac",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).fecha_nac,"onUpdate:modelValue":a[5]||(a[5]=t=>e(s).fecha_nac=t),required:"",readonly:"",autocomplete:"fecha_nac"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.fecha_nac},null,8,["message"])])]),l("div",Z,[l("div",H,[o(i,{for:"sexo",value:"Género"}),w(l("select",{id:"sexo",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6","onUpdate:modelValue":a[6]||(a[6]=t=>e(s).sexo=t),required:""},K,512),[[k,e(s).sexo]]),o(d,{class:"mt-2",message:e(s).errors.sexo},null,8,["message"])])]),l("div",Q,[l("div",R,[o(i,{for:"direc_hab",value:"Dirección"}),o(n,{id:"direc_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).direc_hab,"onUpdate:modelValue":a[7]||(a[7]=t=>e(s).direc_hab=t),required:"",autocomplete:"direc_hab"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.direc_hab},null,8,["message"])])]),l("div",W,[l("div",X,[o(i,{for:"edo_hab",value:"Estado"}),o(n,{id:"edo_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).edo_hab,"onUpdate:modelValue":a[8]||(a[8]=t=>e(s).edo_hab=t),required:"",autocomplete:"edo_hab"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.edo_hab},null,8,["message"])])]),l("div",Y,[l("div",ee,[o(i,{for:"ciud_hab",value:"Ciudad"}),o(n,{id:"ciud_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).ciud_hab,"onUpdate:modelValue":a[9]||(a[9]=t=>e(s).ciud_hab=t),required:"",autocomplete:"ciud_hab"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.ciud_hab},null,8,["message"])])]),l("div",se,[l("div",oe,[o(i,{for:"telefono",value:"Teléfono"}),o(n,{id:"telefono",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).telefono,"onUpdate:modelValue":a[10]||(a[10]=t=>e(s).telefono=t),required:"",autocomplete:"telefono"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.telefono},null,8,["message"])])]),l("div",le,[l("div",ae,[o(i,{for:"celular",value:"Celular"}),o(n,{id:"celular",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).celular,"onUpdate:modelValue":a[11]||(a[11]=t=>e(s).celular=t),autocomplete:"celular"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.celular},null,8,["message"])])]),l("div",te,[l("div",re,[o(i,{for:"titulo",value:"Título"}),o(n,{id:"celular",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).titulo,"onUpdate:modelValue":a[12]||(a[12]=t=>e(s).titulo=t),required:"",autocomplete:"titulo"},null,8,["modelValue"]),o(d,{class:"mt-2",message:e(s).errors.titulo},null,8,["message"])])])]),l("div",de,[o(N,{class:U(["w-full",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:m(()=>[c(" Guardar ")]),_:1},8,["class","disabled"])])],32)])])]),_:1})],64))}};export{fe as default};