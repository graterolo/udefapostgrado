import{q as r,s as i,o,c as u,F as d,r as c,t as m}from"./app-m9WqPV2z.js";const f=["value"],p=["value"],_={__name:"SelectInput",props:["modelValue","options"],emits:["update:modelValue"],setup(s,{expose:n}){const t=r(null);return i(()=>{t.value.hasAttribute("autofocus")&&t.value.focus()}),n({focus:()=>t.value.focus()}),(l,a)=>(o(),u("select",{class:"inblock mt-1 w-full rounded-md form-input focus:border-indigo-600",value:s.modelValue,onChange:a[0]||(a[0]=e=>l.$emit("update:modelValue",e.target.value)),ref_key:"input",ref:t},[(o(!0),u(d,null,c(s.options,e=>(o(),u("option",{key:e.id,value:e.id},m(e.nombre),9,p))),128))],40,f))}};export{_};
