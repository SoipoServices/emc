import{_ as p}from"./AppLayout-DhaRAky6.js";import c from"./DeleteUserForm-Ptreqe7M.js";import l from"./LogoutOtherBrowserSessionsForm-CfcjZIXO.js";import{S as s}from"./SectionBorder-BdhkdPOf.js";import f from"./TwoFactorAuthenticationForm-DEy4Lm05.js";import u from"./UpdatePasswordForm-rI1gFW7X.js";import d from"./UpdateProfileInformationForm-CIo60WMP.js";import _ from"./UpdateBioInformationForm-ytCtn8jZ.js";import{o,c as h,w as n,a as i,e as r,b as t,f as a,F as g}from"./app-BOBmOwrE.js";import"./ApplicationMark-BA7E6v4T.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Footer-DKBElDE0.js";import"./DialogModal-D-dEu4Lh.js";import"./SectionTitle-Cruk1LxX.js";import"./DangerButton-DguqA4-5.js";import"./TextInput-D_f_hG_Y.js";import"./SecondaryButton-8SFq132_.js";import"./ActionMessage-o4Te1n-L.js";import"./PrimaryButton-BBXdZeqj.js";import"./InputLabel-4Qwvs_TM.js";import"./FormSection-DWjwY2z1.js";const $=i("h2",{class:"font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"}," Profile ",-1),k={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},y={key:0},w={key:1},v={key:2},B={key:3},L={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,F)=>(o(),h(p,{title:"Profile"},{header:n(()=>[$]),default:n(()=>[i("div",null,[i("div",k,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",y,[t(d,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",v,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",B,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(g,{key:4},[t(s),t(c,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{L as default};