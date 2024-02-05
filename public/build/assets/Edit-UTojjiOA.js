import{q as h,s as v,o as d,c as g,F as _,r as b,t as p,T as y,j as x,a as o,u as r,w as u,Z as w,b as f,d as e,e as k,i as V,f as $,g as j,h as C,k as D,n as N}from"./app-im3r4HLh.js";import{_ as B}from"./AuthenticatedLayout-o8Z_majW.js";import{_ as E}from"./InputError-YahZcqeF.js";import{_ as m}from"./InputLabel-K0sPL1za.js";import{_ as M}from"./PrimaryButton-FlwJ8Ul7.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const S=["value"],F=["value"],L={__name:"SelectInput",props:["modelValue","options"],emits:["update:modelValue"],setup(a,{expose:n}){const t=h(null);return v(()=>{t.value.hasAttribute("autofocus")&&t.value.focus()}),n({focus:()=>t.value.focus()}),(l,i)=>(d(),g("select",{class:"inblock mt-1 w-full rounded-md form-input focus:border-indigo-600",value:a.modelValue,onChange:i[0]||(i[0]=s=>l.$emit("update:modelValue",s.target.value)),ref_key:"input",ref:t},[(d(!0),g(_,null,b(a.options,s=>(d(),g("option",{key:s.id,value:s.id},p(s.nombre),9,F))),128))],40,S))}},O={class:"overflow-hidden shadow-sm sm:rounded-lg flex flex-row space-x-2 mb-2 justify-end"},P={class:"bg-white overflow-hidden shadow-sm sm:rounded-lg"},T={class:"p-6 border-b border-gray-200"},q={class:"mt-1 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"},U={class:"sm:col-span-2"},z={class:"mt-2"},A={name:"cedula",id:"cedula",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",readonly:""},G={class:"sm:col-span-4"},I={class:"mt-2"},R={name:"nombre",id:"nombre",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",readonly:""},Z={class:"sm:col-span-4"},H={class:"mt-2"},J={class:"sm:col-span-2"},K={class:"mt-2"},Q={class:"mt-4 flex flex-col items-end"},oe={__name:"Edit",props:{errors:{type:Object},preinscrito:{type:Object},masters:{type:Object}},setup(a){const n=a,t=y({cedula:n.preinscrito.cedula,master_id:n.preinscrito.master_id}),l=x(()=>new Date(n.preinscrito.updated_at).toLocaleDateString());return(i,s)=>(d(),g(_,null,[o(r(w),{title:"Editar Preinscrito"}),o(B,null,{header:u(()=>[f(" Editar Preinscripción ")]),default:u(()=>[e("div",O,[i.$page.props.auth.user.tipo===2?(d(),k(r(V),{key:0,href:i.route("preinscritos.index"),class:"inline-flex items-right px-4 py-2 gap-0.5 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"},{default:u(()=>[f("Listado")]),_:1},8,["href"])):$("",!0)]),e("div",P,[e("div",T,[e("form",{onSubmit:s[2]||(s[2]=j(c=>r(t).patch(i.route("preinscritos.update",a.preinscrito)),["prevent"]))},[e("div",q,[e("div",U,[e("div",z,[o(m,{for:"cedula",value:"Cédula"}),e("textarea",A,p(a.preinscrito.cedula),1)])]),e("div",G,[e("div",I,[o(m,{for:"nombre",value:"Nombre"}),e("textarea",R,p(i.$page.props.auth.user.name)+" ",1)])]),e("div",Z,[e("div",H,[o(m,{for:"master_id",value:"Postgrado/Maestría"}),o(L,{id:"master_id",options:a.masters,type:"text",modelValue:r(t).master_id,"onUpdate:modelValue":s[0]||(s[0]=c=>r(t).master_id=c),class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",required:""},null,8,["options","modelValue"]),o(E,{class:"mt-2",message:r(t).errors.master_id},null,8,["message"])])]),e("div",J,[e("div",K,[o(m,{for:"fecha",value:"Fecha de Registro"}),C(e("textarea",{"onUpdate:modelValue":s[1]||(s[1]=c=>l.value=c),name:"fecha",id:"fecha",rows:"1",class:"block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6",readonly:""},null,512),[[D,l.value]])])])]),e("div",Q,[o(M,{class:N(["w-full",{"opacity-25":r(t).processing}]),disabled:r(t).processing},{default:u(()=>[f(" Guardar ")]),_:1},8,["class","disabled"])])],32)])])]),_:1})],64))}};export{oe as default};