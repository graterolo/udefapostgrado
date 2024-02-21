import{l as x,j as v,p as k,o as i,c,T as b,a as t,u as s,w as d,F as y,Z as V,t as C,g as p,d as o,f as B,b as f,i as $,n as N,h as S}from"./app-rfy-ajLB.js";import{G as U}from"./GuestLayout-L7MfZPDT.js";import{_}from"./InputError-RjyZuPhB.js";import{_ as g}from"./InputLabel-Q3qrlNOF.js";import{_ as j}from"./PrimaryButton-kQbeH4oR.js";import{_ as w}from"./TextInput-9NKpXMk-.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const q=["value"],F={__name:"Checkbox",props:{checked:{type:[Array,Boolean],default:!1},value:{default:null}},emits:["update:checked"],setup(r,{emit:e}){const m=e,n=r,a=x({get(){return n.checked},set(l){m("update:checked",l)}});return(l,u)=>v((i(),c("input",{type:"checkbox",value:r.value,"onUpdate:modelValue":u[0]||(u[0]=h=>a.value=h),class:"text-indigo-600"},null,8,q)),[[k,a.value]])}},L=o("div",{class:"flex items-center"},[o("img",{class:"limg",src:"/images/logop.jpg",alt:""})],-1),P={key:0,class:"mb-4 text-sm font-medium text-green-600"},R={class:"mt-3"},D={class:"mt-4 flex justify-between"},G={class:"inline-flex items-center"},M=o("span",{class:"mx-2 text-sm text-gray-600"},"Recordarme",-1),T={class:"mt-6"},J={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(r){const e=b({email:"",password:"",remember:!1}),m=()=>{e.post(route("login"),{onFinish:()=>e.reset("password")})};return(n,a)=>(i(),c(y,null,[t(s(V),{title:"Log in"}),t(U,null,{default:d(()=>[L,r.status?(i(),c("div",P,C(r.status),1)):p("",!0),o("form",{onSubmit:S(m,["prevent"])},[o("div",null,[t(g,{for:"email",value:"Correo"}),t(w,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=l=>s(e).email=l),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(_,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),o("div",R,[t(g,{for:"password",value:"Password"}),t(w,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=l=>s(e).password=l),required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(_,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),o("div",D,[o("label",G,[t(F,{name:"remember",checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=l=>s(e).remember=l)},null,8,["checked"]),M]),r.canResetPassword?(i(),B(s($),{key:0,href:n.route("password.request"),class:"text-sm text-gray-600 underline hover:text-gray-900"},{default:d(()=>[f(" Olvidaste tu password? ")]),_:1},8,["href"])):p("",!0)]),o("div",T,[t(j,{class:N(["w-full",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:d(()=>[f(" Iniciar Sesión ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64))}};export{J as default};