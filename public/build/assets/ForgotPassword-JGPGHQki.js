import{T as d,l as f,o as i,c as m,a as e,u as t,w as o,F as p,Z as _,t as w,f as g,d as a,n as y,b as x,g as b}from"./app-mhL2alq8.js";import{A as k}from"./ApplicationLogo-eoH2QN6y.js";import{_ as h}from"./GuestLayout-ik06rTY9.js";import{_ as v,a as V}from"./TextInput-LDL9PTDD.js";import{_ as F}from"./InputLabel-eiI6O7FP.js";import{_ as N}from"./PrimaryButton-2h7_bKnj.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const $=a("div",{class:"mb-4 text-sm text-gray-600"}," Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one. ",-1),C={key:0,class:"mb-4 text-sm font-medium text-green-600"},L={class:"flex justify-end items-center mt-4"},z={__name:"ForgotPassword",props:{status:String},setup(l){const s=d({email:""}),n=()=>{s.post(route("password.email"))};return(B,r)=>{const c=f("Link");return i(),m(p,null,[e(t(_),{title:"Forgot Password"}),e(h,null,{default:o(()=>[e(c,{href:"/",class:"flex justify-center items-center mb-4"},{default:o(()=>[e(k,{class:"w-20 h-20 text-gray-500 fill-current"})]),_:1}),$,l.status?(i(),m("div",C,w(l.status),1)):g("",!0),a("form",{onSubmit:b(n,["prevent"])},[a("div",null,[e(F,{for:"email",value:"Email"}),e(v,{id:"email",type:"email",class:"block mt-1 w-full",modelValue:t(s).email,"onUpdate:modelValue":r[0]||(r[0]=u=>t(s).email=u),required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),e(V,{class:"mt-2",message:t(s).errors.email},null,8,["message"])]),a("div",L,[e(N,{class:y(["w-full",{"opacity-25":t(s).processing}]),disabled:t(s).processing},{default:o(()=>[x(" Email Password Reset Link ")]),_:1},8,["class","disabled"])])],32)]),_:1})],64)}}};export{z as default};