import{T as b,o as g,c as p,a as o,u as e,w as m,F as h,Z as y,b as f,d as t,e as x,i as v,f as _,g as V,t as w,h as k,v as U,n as $}from"./app-im3r4HLh.js";import{_ as C}from"./AuthenticatedLayout-o8Z_majW.js";import{_ as i}from"./InputError-YahZcqeF.js";import{_ as r}from"./InputLabel-K0sPL1za.js";import{_ as D}from"./PrimaryButton-FlwJ8Ul7.js";import{_ as n}from"./TextInput-fwJnaqWh.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const E={class:"mt-1 mb-1 grid justify-items-end p-1 border-b border-gray-200"},N={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},B={class:"p-6 border-b border-gray-200"},j={class:"mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},q={class:"sm:col-span-3"},F={class:"mt-2"},M={class:"sm:col-span-3"},S={class:"mt-2"},T={key:0,class:"text-sm text-red-600"},G={class:"sm:col-span-3"},O={class:"mt-2"},z=t("option",{value:"0"},"Femenino",-1),L=t("option",{value:"1"},"Masculino",-1),Z=[z,L],A={class:"sm:col-span-3"},H={class:"mt-2"},I={class:"sm:col-span-3"},J={class:"mt-2"},K={class:"sm:col-span-3"},P={class:"mt-2"},Q={class:"sm:col-span-3"},R={class:"mt-2"},W={class:"sm:col-span-3"},X={class:"mt-2"},Y={class:"mt-4 flex flex-col items-end"},re={__name:"Edit",props:{errors:{type:Object},docente:{type:Object}},setup(c){const d=c,s=b({cedula:d.docente.cedula,nombre:d.docente.nombre,sexo:d.docente.sexo,direc_hab:d.docente.direc_hab,edo_hab:d.docente.edo_hab,ciud_hab:d.docente.ciud_hab,telefono:d.docente.telefono,celular:d.docente.celular});return(u,l)=>(g(),p(h,null,[o(e(y),{title:"Editar Docente"}),o(C,null,{header:m(()=>[f(" Editar Docente ")]),default:m(()=>[t("div",E,[u.$page.props.auth.user.tipo===2?(g(),x(e(v),{key:0,href:u.route("docentes.index"),class:"px-1 py-1 bg-indigo-500 text-white border rounded-md"},{default:m(()=>[f("Listado")]),_:1},8,["href"])):_("",!0)]),t("div",N,[t("div",B,[t("form",{onSubmit:l[8]||(l[8]=V(a=>e(s).patch(u.route("docentes.update",c.docente)),["prevent"]))},[t("div",j,[t("div",q,[o(r,{for:"cedula",value:"Cédula"}),t("div",F,[o(n,{id:"cedula",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).cedula,"onUpdate:modelValue":l[0]||(l[0]=a=>e(s).cedula=a),required:"",autofocus:"",autocomplete:"cedula"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.cedula},null,8,["message"])])]),t("div",M,[o(r,{for:"nombre",value:"Nombre"}),t("div",S,[o(n,{id:"nombre",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).nombre,"onUpdate:modelValue":l[1]||(l[1]=a=>e(s).nombre=a),required:"",autocomplete:"nombre"},null,8,["modelValue"]),c.errors.nombre?(g(),p("div",T,w(c.errors.nombre),1)):_("",!0)])]),t("div",G,[o(r,{for:"sexo",value:"Género"}),t("div",O,[k(t("select",{id:"sexo",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6","onUpdate:modelValue":l[2]||(l[2]=a=>e(s).sexo=a),required:""},Z,512),[[U,e(s).sexo]]),o(i,{class:"mt-2",message:e(s).errors.sexo},null,8,["message"])])]),t("div",A,[o(r,{for:"direc_hab",value:"Direccción"}),t("div",H,[o(n,{id:"direc_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).direc_hab,"onUpdate:modelValue":l[3]||(l[3]=a=>e(s).direc_hab=a),autocomplete:"direc_hab"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.direc_hab},null,8,["message"])])]),t("div",I,[o(r,{for:"edo_hab",value:"Estado"}),t("div",J,[o(n,{id:"edo_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).edo_hab,"onUpdate:modelValue":l[4]||(l[4]=a=>e(s).edo_hab=a),autocomplete:"edo_hab"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.edo_hab},null,8,["message"])])]),t("div",K,[o(r,{for:"ciud_hab",value:"Ciudad"}),t("div",P,[o(n,{id:"ciud_hab",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).ciud_hab,"onUpdate:modelValue":l[5]||(l[5]=a=>e(s).ciud_hab=a),autocomplete:"ciud_hab"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.ciud_hab},null,8,["message"])])]),t("div",Q,[o(r,{for:"telefono",value:"Teléfono"}),t("div",R,[o(n,{id:"telefono",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).telefono,"onUpdate:modelValue":l[6]||(l[6]=a=>e(s).telefono=a),autocomplete:"telefono"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.telefono},null,8,["message"])])]),t("div",W,[o(r,{for:"celular",value:"Celular"}),t("div",X,[o(n,{id:"celular",type:"text",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",modelValue:e(s).celular,"onUpdate:modelValue":l[7]||(l[7]=a=>e(s).celular=a),autocomplete:"celular"},null,8,["modelValue"]),o(i,{class:"mt-2",message:e(s).errors.celular},null,8,["message"])])])]),t("div",Y,[o(D,{class:$(["w-full",{"opacity-25":e(s).processing}]),disabled:e(s).processing},{default:m(()=>[f(" Guardar ")]),_:1},8,["class","disabled"])])],32)])])]),_:1})],64))}};export{re as default};