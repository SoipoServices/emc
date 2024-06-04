import{A as u}from"./ApplicationMark-BPXluH3o.js";import{j as d,o as a,e as s,a as t,c as m,t as l,f as r,b as i,g as c,F as f,h as x}from"./app-ByQfmSEY.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";const w={class:"relative max-w-sm mx-auto mt-16 mt-24 mb-32"},k={class:"overflow-hidden text-white bg-white rounded shadow-md min-h-72 dark:bg-gray-900"},v={class:"absolute flex justify-center w-full -mt-20"},b={class:"w-32 h-32"},y=["src","alt"],_={class:"px-6 mt-16 h-1/4"},g={class:"mb-1 text-3xl font-bold text-center text-gray-800 dark:text-white"},j={key:0,class:"text-sm text-center text-gray-800 dark:text-white"},B={key:1,class:"pt-3 text-sm text-center text-gray-800 dark:text-white"},N=["href"],S={key:2,class:"pt-3 text-sm text-center text-gray-800 dark:text-white"},V=["href"],C={"aria-label":"Email"},F={key:3,class:"pt-3 text-base font-normal text-center text-gray-600 dark:text-white"},A={class:"mb-4 overflow-y-auto h-60"},E=t("hr",null,null,-1),L={class:"flex justify-center pt-5 pb-5 mx-auto text-gray-600 dark:text-white"},T=["href"],q={"aria-label":"Site"},D=["href"],M={"aria-label":"Site"},O=["href"],U={"aria-label":"Linkedin"},Y=["href"],z={"aria-label":"Youtube"},G=["href"],H={"aria-label":"Facebook"},I=["href"],J={"aria-label":"Twitter"},K={class:"flex flex-col justify-center w-full pt-5 pb-5"},P={key:0,class:"items-center justify-center mx-auto"},Z={__name:"UserCard",props:{user:{type:Object,required:!0},locale:{type:String,default:"en"}},setup(e){return(h,Q)=>{const o=d("v-icon");return a(),s("div",null,[t("div",w,[t("div",k,[t("div",v,[t("div",b,[e.user.profile_photo_url?(a(),s("img",{key:0,src:e.user.profile_photo_url,alt:e.user.name,class:"object-cover w-full h-full rounded-full shadow-md"},null,8,y)):(a(),m(u,{key:1,class:"object-cover w-full h-full rounded-full shadow-md"}))])]),t("div",_,[t("h1",g,l(e.user.name),1),e.user.position?(a(),s("p",j,l(e.user.position),1)):r("",!0),e.user.telephone?(a(),s("p",B,[t("a",{href:"tel:"+e.user.telephone},[i(o,{name:"fa-phone-alt",class:"w-4 h-4 mr-2",animation:"wrench",hover:""}),c(" "+l(e.user.telephone),1)],8,N)])):r("",!0),e.user.telephone?(a(),s("p",S,[e.user.email?(a(),s("a",{key:0,href:"mailto:"+e.user.email},[t("div",C,[i(o,{name:"fa-mail-bulk",class:"w-4 h-4 mr-2",animation:"wrench",hover:""}),c(" "+l(e.user.email),1)])],8,V)):r("",!0)])):r("",!0),e.user.bio?(a(),s("p",F,[t("div",A,l(e.user.bio),1),E])):r("",!0),t("div",L,[t("a",{href:h.route("user.vcard",{user:e.user.id}),class:"mx-5"},[t("div",q,[i(o,{name:"fa-download",class:"w-4 h-4",animation:"wrench",hover:""})])],8,T),e.user.site_url?(a(),s("a",{key:0,href:e.user.site_url,class:"mx-5"},[t("div",M,[i(o,{name:"fa-link",class:"w-4 h-4",animation:"wrench",hover:""})])],8,D)):r("",!0),e.user.linkedin_profile_url?(a(),s("a",{key:1,href:e.user.linkedin_profile_url,class:"mx-5"},[t("div",U,[i(o,{name:"fa-linkedin",class:"w-4 h-4",animation:"wrench",hover:""})])],8,O)):r("",!0),e.user.youtube_url?(a(),s("a",{key:2,href:e.user.youtube_url,class:"mx-5"},[t("div",z,[i(o,{name:"fa-youtube",class:"w-4 h-4",animation:"wrench",hover:""})])],8,Y)):r("",!0),e.user.facebook_url?(a(),s("a",{key:3,href:e.user.facebook_url,class:"mx-5"},[t("div",H,[i(o,{name:"fa-facebook",class:"w-4 h-4",animation:"wrench",hover:""})])],8,G)):r("",!0),e.user.twitter_url?(a(),s("a",{key:4,href:e.user.twitter_url,class:"mx-5"},[t("div",J,[i(o,{name:"fa-twitter",class:"w-4 h-4",animation:"wrench",hover:""})])],8,I)):r("",!0)]),t("div",K,[e.user.tags?(a(),s("div",P,[(a(!0),s(f,null,x(e.user.tags,n=>(a(),s("div",{class:"m-1 badge badge-primary",key:n.id},l(n.name[e.locale]),1))),128))])):r("",!0)])])])])])}}};export{Z as default};
