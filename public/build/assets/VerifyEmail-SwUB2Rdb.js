import{T as p,l as g,o,c as r,a as e,u as t,w as s,F as h,Z as y,i as n,g as _,d as a,n as v,b as l,h as x}from"./app-EENgHAwL.js";import{A as b}from"./ApplicationLogo-ZoRT1n25.js";import{G as k}from"./GuestLayout-csJ3STIW.js";import{_ as w}from"./PrimaryButton-_CQi0vx3.js";import"./_plugin-vue_export-helper-x3n3nnut.js";const V=a("div",{class:"mb-4 text-sm text-gray-600"}," Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email, we will gladly send you another. ",-1),B={key:0,class:"mb-4 text-sm font-medium text-green-600"},E={class:"mt-4 flex items-center justify-between"},T={__name:"VerifyEmail",props:{status:String},setup(c){const d=c,i=p(),m=()=>{i.post(route("verification.send"))},u=g(()=>d.status==="verification-link-sent");return(f,L)=>(o(),r(h,null,[e(t(y),{title:"Email Verification"}),e(k,null,{default:s(()=>[e(t(n),{href:"/",class:"mb-4 flex items-center justify-center"},{default:s(()=>[e(b,{class:"h-20 w-20 fill-current text-gray-500"})]),_:1}),V,u.value?(o(),r("div",B," A new verification link has been sent to the email address you provided during registration. ")):_("",!0),a("form",{onSubmit:x(m,["prevent"])},[a("div",E,[e(w,{class:v({"opacity-25":t(i).processing}),disabled:t(i).processing},{default:s(()=>[l(" Resend Verification Email ")]),_:1},8,["class","disabled"]),e(t(n),{href:f.route("logout"),method:"post",as:"button",class:"text-sm text-gray-600 underline hover:text-gray-900"},{default:s(()=>[l(" Log Out ")]),_:1},8,["href"])])],32)]),_:1})],64))}};export{T as default};