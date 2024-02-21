import{Q as g,T as y,o as l,c as n,d as s,a,u as e,b as c,w as m,j as x,y as h,g as f,z as V,h as b,i as k}from"./app-rIty18ko.js";import{_ as p}from"./InputError-ngFdGzkP.js";import{_ as v}from"./InputLabel-9Fx6gtGj.js";import{_ as w}from"./PrimaryButton-Eq5VYNt2.js";import{_}from"./TextInput-fP6DTnaF.js";const S=s("header",null,[s("h2",{class:"text-lg font-medium text-gray-900"},"Información del Perfil"),s("p",{class:"mt-1 text-sm text-gray-600"}," Actualice la información del perfil y la dirección de correo electrónico de su cuenta. ")],-1),N={key:0},$={class:"text-sm mt-2 text-gray-800"},B={class:"mt-2 font-medium text-sm text-green-600"},q={class:"flex items-center gap-4"},C={key:0,class:"text-sm text-gray-600"},P={__name:"UpdateProfileInformationForm",props:{mustVerifyEmail:{type:Boolean},status:{type:String}},setup(u){const r=g().props.auth.user,t=y({name:r.name,email:r.email});return(d,o)=>(l(),n("section",null,[S,s("form",{onSubmit:o[2]||(o[2]=b(i=>e(t).patch(d.route("profile.update")),["prevent"])),class:"mt-6 space-y-6"},[s("div",null,[a(v,{for:"name",value:"Nombre"}),a(_,{id:"name",type:"text",class:"mt-1 block w-full",modelValue:e(t).name,"onUpdate:modelValue":o[0]||(o[0]=i=>e(t).name=i),required:"",autofocus:"",autocomplete:"nombre"},null,8,["modelValue"]),a(p,{class:"mt-2",message:e(t).errors.name},null,8,["message"])]),s("div",null,[a(v,{for:"email",value:"Correo"}),a(_,{id:"email",type:"email",class:"mt-1 block w-full",modelValue:e(t).email,"onUpdate:modelValue":o[1]||(o[1]=i=>e(t).email=i),required:"",autocomplete:"username"},null,8,["modelValue"]),a(p,{class:"mt-2",message:e(t).errors.email},null,8,["message"])]),u.mustVerifyEmail&&e(r).email_verified_at===null?(l(),n("div",N,[s("p",$,[c(" Su dirección de correo electrónico no está verificada. "),a(e(k),{href:d.route("verification.send"),method:"post",as:"button",class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[c(" Haga clic aquí para volver a enviar el correo electrónico de verificación. ")]),_:1},8,["href"])]),x(s("div",B," Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico. ",512),[[h,u.status==="verification-link-sent"]])])):f("",!0),s("div",q,[a(w,{disabled:e(t).processing},{default:m(()=>[c("Guardar")]),_:1},8,["disabled"]),a(V,{"enter-active-class":"transition ease-in-out","enter-from-class":"opacity-0","leave-active-class":"transition ease-in-out","leave-to-class":"opacity-0"},{default:m(()=>[e(t).recentlySuccessful?(l(),n("p",C,"Guardado.")):f("",!0)]),_:1})])],32)]))}};export{P as default};
