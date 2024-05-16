import{T as _,j as w,o as f,e as c,b as e,u as o,w as i,F as y,Z as h,a as r,g as d,f as k,k as v,n as x,i as b}from"./app-D_L6EQZR.js";import{A as V}from"./AuthenticationCard-DWZ6CNYp.js";import{_ as $}from"./AuthenticationCardLogo-CNA3tvIS.js";import{_ as C}from"./Checkbox-B2zOtShT.js";import{_ as u,a as l}from"./TextInput-CA7mcM9R.js";import{_ as m}from"./InputLabel-BNKvdWcK.js";import{_ as P}from"./PrimaryButton-BRzhd74n.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const q={class:"mt-4"},N={class:"mt-4"},U={class:"mt-4"},A={key:0,class:"mt-4"},F={class:"flex items-center"},T={class:"ms-2"},j=["href"],B=["href"],R={class:"flex items-center justify-end mt-4"},E=["href"],K={__name:"Register",setup(S){const s=_({name:"",email:"",password:"",password_confirmation:"",terms:!1}),g=()=>{s.post(route("register"),{onFinish:()=>s.reset("password","password_confirmation")})};return(n,a)=>{const p=w("v-icon");return f(),c(y,null,[e(o(h),{title:"Register"}),e(V,null,{logo:i(()=>[e($)]),default:i(()=>[r("form",{onSubmit:b(g,["prevent"])},[r("div",null,[e(m,{for:"name",value:"Name"}),e(u,{id:"name",modelValue:o(s).name,"onUpdate:modelValue":a[0]||(a[0]=t=>o(s).name=t),type:"text",class:"block w-full mt-1",required:"",autofocus:"",autocomplete:"name"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.name},null,8,["message"])]),r("div",q,[e(m,{for:"email",value:"Email"}),e(u,{id:"email",modelValue:o(s).email,"onUpdate:modelValue":a[1]||(a[1]=t=>o(s).email=t),type:"email",class:"block w-full mt-1",required:"",autocomplete:"username"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.email},null,8,["message"])]),r("div",N,[e(m,{for:"password",value:"Password"}),e(u,{id:"password",modelValue:o(s).password,"onUpdate:modelValue":a[2]||(a[2]=t=>o(s).password=t),type:"password",class:"block w-full mt-1",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),r("div",U,[e(m,{for:"password_confirmation",value:"Confirm Password"}),e(u,{id:"password_confirmation",modelValue:o(s).password_confirmation,"onUpdate:modelValue":a[3]||(a[3]=t=>o(s).password_confirmation=t),type:"password",class:"block w-full mt-1",required:"",autocomplete:"new-password"},null,8,["modelValue"]),e(l,{class:"mt-2",message:o(s).errors.password_confirmation},null,8,["message"])]),n.$page.props.jetstream.hasTermsAndPrivacyPolicyFeature?(f(),c("div",A,[e(m,{for:"terms"},{default:i(()=>[r("div",F,[e(C,{id:"terms",checked:o(s).terms,"onUpdate:checked":a[4]||(a[4]=t=>o(s).terms=t),name:"terms",required:""},null,8,["checked"]),r("div",T,[d(" I agree to the "),r("a",{target:"_blank",href:n.route("terms.show"),class:"text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},"Terms of Service",8,j),d(" and "),r("a",{target:"_blank",href:n.route("policy.show"),class:"text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},"Privacy Policy",8,B)])]),e(l,{class:"mt-2",message:o(s).errors.terms},null,8,["message"])]),_:1})])):k("",!0),r("div",R,[e(o(v),{href:n.route("login"),class:"text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"},{default:i(()=>[d(" Already registered? ")]),_:1},8,["href"]),e(P,{class:x(["ms-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:i(()=>[d(" Register ")]),_:1},8,["class","disabled"]),r("a",{href:n.route("linkedin.auth"),class:"inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out border border-transparent rounded-md bg-sky-600 hover:bg-sky-700 focus:bg-sky-700 active:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 ms-4"},[e(p,{name:"fa-linkedin",hover:""})],8,E)])],32)]),_:1})],64)}}};export{K as default};
