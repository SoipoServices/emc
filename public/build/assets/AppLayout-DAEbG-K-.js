import{Q as N,d as $,x as P,o as s,e as o,n as h,a as e,f as c,t as k,i as w,y as D,z as E,k as j,r as p,A as S,u as m,l as T,B as L,b as u,w as n,C as F,c as y,j as C,Z as O,g,F as x,h as B,O as A}from"./app-D4sn_Whk.js";import{A as V}from"./ApplicationMark-KCTWRws_.js";import{_ as I}from"./Footer-x8goSsdp.js";const R={class:"max-w-screen-xl mx-auto py-2 px-3 sm:px-6 lg:px-8"},H={class:"flex items-center justify-between flex-wrap"},Q={class:"w-0 flex-1 flex items-center min-w-0"},U={key:0,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Z=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),q=[Z],G={key:1,class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},J=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"},null,-1),K=[J],W={class:"ms-3 font-medium text-sm text-white truncate"},X={class:"shrink-0 sm:ms-3"},Y=e("svg",{class:"h-5 w-5 text-white",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M6 18L18 6M6 6l12 12"})],-1),ee=[Y],te={__name:"Banner",setup(d){const a=N(),r=$(!0),l=$("success"),t=$("");return P(async()=>{var v,i;l.value=((v=a.props.jetstream.flash)==null?void 0:v.bannerStyle)||"success",t.value=((i=a.props.jetstream.flash)==null?void 0:i.banner)||"",r.value=!0}),(v,i)=>(s(),o("div",null,[r.value&&t.value?(s(),o("div",{key:0,class:h({"bg-indigo-500":l.value=="success","bg-red-700":l.value=="danger"})},[e("div",R,[e("div",H,[e("div",Q,[e("span",{class:h(["flex p-2 rounded-lg",{"bg-indigo-600":l.value=="success","bg-red-600":l.value=="danger"}])},[l.value=="success"?(s(),o("svg",U,q)):c("",!0),l.value=="danger"?(s(),o("svg",G,K)):c("",!0)],2),e("p",W,k(t.value),1)]),e("div",X,[e("button",{type:"button",class:h(["-me-1 flex p-2 rounded-md focus:outline-none sm:-me-2 transition",{"hover:bg-indigo-600 focus:bg-indigo-600":l.value=="success","hover:bg-red-600 focus:bg-red-600":l.value=="danger"}]),"aria-label":"Dismiss",onClick:i[0]||(i[0]=w(f=>r.value=!1,["prevent"]))},ee,2)])])])],2)):c("",!0)]))}},se={class:"relative"},z={__name:"Dropdown",props:{align:{type:String,default:"right"},width:{type:String,default:"48"},contentClasses:{type:Array,default:()=>["py-1","bg-white dark:bg-gray-700"]}},setup(d){const a=d;let r=$(!1);const l=i=>{r.value&&i.key==="Escape"&&(r.value=!1)};D(()=>document.addEventListener("keydown",l)),E(()=>document.removeEventListener("keydown",l));const t=j(()=>({48:"w-48"})[a.width.toString()]),v=j(()=>a.align==="left"?"ltr:origin-top-left rtl:origin-top-right start-0":a.align==="right"?"ltr:origin-top-right rtl:origin-top-left end-0":"origin-top");return(i,f)=>(s(),o("div",se,[e("div",{onClick:f[0]||(f[0]=M=>S(r)?r.value=!m(r):r=!m(r))},[p(i.$slots,"trigger")]),T(e("div",{class:"fixed inset-0 z-40",onClick:f[1]||(f[1]=M=>S(r)?r.value=!1:r=!1)},null,512),[[L,m(r)]]),u(F,{"enter-active-class":"transition ease-out duration-200","enter-from-class":"transform opacity-0 scale-95","enter-to-class":"transform opacity-100 scale-100","leave-active-class":"transition ease-in duration-75","leave-from-class":"transform opacity-100 scale-100","leave-to-class":"transform opacity-0 scale-95"},{default:n(()=>[T(e("div",{class:h(["absolute z-50 mt-2 rounded-md shadow-lg",[t.value,v.value]]),style:{display:"none"},onClick:f[2]||(f[2]=M=>S(r)?r.value=!1:r=!1)},[e("div",{class:h(["rounded-md ring-1 ring-black ring-opacity-5",d.contentClasses])},[p(i.$slots,"content")],2)],2),[[L,m(r)]])]),_:3})]))}},re={key:0,type:"submit",class:"block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"},oe=["href"],_={__name:"DropdownLink",props:{href:String,as:String},setup(d){return(a,r)=>(s(),o("div",null,[d.as=="button"?(s(),o("button",re,[p(a.$slots,"default")])):d.as=="a"?(s(),o("a",{key:1,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"},[p(a.$slots,"default")],8,oe)):(s(),y(m(C),{key:2,href:d.href,class:"block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out"},{default:n(()=>[p(a.$slots,"default")]),_:3},8,["href"]))]))}},ae={__name:"NavLink",props:{href:String,active:Boolean},setup(d){const a=d,r=j(()=>a.active?"inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out":"inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out");return(l,t)=>(s(),y(m(C),{href:d.href,class:h(r.value)},{default:n(()=>[p(l.$slots,"default")]),_:3},8,["href","class"]))}},b={__name:"ResponsiveNavLink",props:{active:Boolean,href:String,as:String},setup(d){const a=d,r=j(()=>a.active?"block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 dark:border-indigo-600 text-start text-base font-medium text-indigo-700 dark:text-indigo-300 bg-indigo-50 dark:bg-indigo-900/50 focus:outline-none focus:text-indigo-800 dark:focus:text-indigo-200 focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:border-indigo-700 dark:focus:border-indigo-300 transition duration-150 ease-in-out":"block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-700 hover:border-gray-300 dark:hover:border-gray-600 focus:outline-none focus:text-gray-800 dark:focus:text-gray-200 focus:bg-gray-50 dark:focus:bg-gray-700 focus:border-gray-300 dark:focus:border-gray-600 transition duration-150 ease-in-out");return(l,t)=>(s(),o("div",null,[d.as=="button"?(s(),o("button",{key:0,class:h([r.value,"w-full text-start"])},[p(l.$slots,"default")],2)):(s(),y(m(C),{key:1,href:d.href,class:h(r.value)},{default:n(()=>[p(l.$slots,"default")]),_:3},8,["href","class"]))]))}},ne={class:"min-h-screen"},ie={class:"bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700"},le={class:"px-4 mx-auto max-w-7xl sm:px-6 lg:px-8"},de={class:"flex justify-between h-16"},ue={class:"flex"},ce={class:"flex items-center shrink-0"},ge={class:"hidden space-x-8 sm:-my-px sm:ms-10 sm:flex"},he={class:"hidden sm:flex sm:items-center sm:ms-6"},pe={class:"relative ms-3"},fe={class:"inline-flex rounded-md"},me={type:"button",class:"inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700"},ve=e("svg",{class:"ms-2 -me-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"})],-1),ye={class:"w-60"},be=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),ke=e("div",{class:"border-t border-gray-200 dark:border-gray-600"},null,-1),_e=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),xe=["onSubmit"],we={class:"flex items-center"},$e={key:0,class:"w-5 h-5 text-green-400 me-2",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},je=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Ce=[je],Se={class:"relative ms-3"},Me={key:0,class:"flex text-sm transition border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300"},Te=["src","alt"],Le={key:1,class:"inline-flex rounded-md"},Be={type:"button",class:"inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700"},Ae=e("svg",{class:"ms-2 -me-0.5 h-4 w-4",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},[e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M19.5 8.25l-7.5 7.5-7.5-7.5"})],-1),ze=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Account ",-1),Ne=e("div",{class:"border-t border-gray-200 dark:border-gray-600"},null,-1),Pe={class:"flex items-center -me-2 sm:hidden"},De={class:"w-6 h-6",stroke:"currentColor",fill:"none",viewBox:"0 0 24 24"},Ee={class:"pt-2 pb-3 space-y-1"},Fe={class:"pt-4 pb-1 border-t border-gray-200 dark:border-gray-600"},Oe={class:"flex items-center px-4"},Ve={key:0,class:"shrink-0 me-3"},Ie=["src","alt"],Re={class:"text-base font-medium text-gray-800 dark:text-gray-200"},He={class:"text-sm font-medium text-gray-500"},Qe={class:"mt-3 space-y-1"},Ue=e("div",{class:"border-t border-gray-200 dark:border-gray-600"},null,-1),Ze=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Manage Team ",-1),qe=e("div",{class:"border-t border-gray-200 dark:border-gray-600"},null,-1),Ge=e("div",{class:"block px-4 py-2 text-xs text-gray-400"}," Switch Teams ",-1),Je=["onSubmit"],Ke={class:"flex items-center"},We={key:0,class:"w-5 h-5 text-green-400 me-2",xmlns:"http://www.w3.org/2000/svg",fill:"none",viewBox:"0 0 24 24","stroke-width":"1.5",stroke:"currentColor"},Xe=e("path",{"stroke-linecap":"round","stroke-linejoin":"round",d:"M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"},null,-1),Ye=[Xe],et={key:0,class:"bg-white shadow dark:bg-gray-800"},tt={class:"px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8"},at={__name:"AppLayout",props:{title:String},setup(d){const a=$(!1),r=t=>{A.put(route("current-team.update"),{team_id:t.id},{preserveState:!1})},l=()=>{A.post(route("logout"))};return(t,v)=>(s(),o("div",null,[u(m(O),{title:d.title},null,8,["title"]),u(te),e("div",ne,[e("nav",ie,[e("div",le,[e("div",de,[e("div",ue,[e("div",ce,[u(m(C),{href:t.route("dashboard")},{default:n(()=>[u(V,{class:"block w-auto h-9"})]),_:1},8,["href"])]),e("div",ge,[u(ae,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:n(()=>[g(" Dashboard ")]),_:1},8,["href","active"])])]),e("div",he,[e("div",pe,[t.$page.props.jetstream.hasTeamFeatures?(s(),y(z,{key:0,align:"right",width:"60"},{trigger:n(()=>[e("span",fe,[e("button",me,[g(k(t.$page.props.auth.user.current_team.name)+" ",1),ve])])]),content:n(()=>[e("div",ye,[be,u(_,{href:t.route("teams.show",t.$page.props.auth.user.current_team)},{default:n(()=>[g(" Team Settings ")]),_:1},8,["href"]),t.$page.props.jetstream.canCreateTeams?(s(),y(_,{key:0,href:t.route("teams.create")},{default:n(()=>[g(" Create New Team ")]),_:1},8,["href"])):c("",!0),t.$page.props.auth.user.all_teams.length>1?(s(),o(x,{key:1},[ke,_e,(s(!0),o(x,null,B(t.$page.props.auth.user.all_teams,i=>(s(),o("form",{key:i.id,onSubmit:w(f=>r(i),["prevent"])},[u(_,{as:"button"},{default:n(()=>[e("div",we,[i.id==t.$page.props.auth.user.current_team_id?(s(),o("svg",$e,Ce)):c("",!0),e("div",null,k(i.name),1)])]),_:2},1024)],40,xe))),128))],64)):c("",!0)])]),_:1})):c("",!0)]),e("div",Se,[u(z,{align:"right",width:"48"},{trigger:n(()=>[t.$page.props.jetstream.managesProfilePhotos?(s(),o("button",Me,[e("img",{class:"object-cover w-8 h-8 rounded-full",src:t.$page.props.auth.user.profile_photo_url,alt:t.$page.props.auth.user.name},null,8,Te)])):(s(),o("span",Le,[e("button",Be,[g(k(t.$page.props.auth.user.name)+" ",1),Ae])]))]),content:n(()=>[ze,u(_,{href:t.route("profile.show")},{default:n(()=>[g(" Profile ")]),_:1},8,["href"]),t.$page.props.jetstream.hasApiFeatures?(s(),y(_,{key:0,href:t.route("api-tokens.index")},{default:n(()=>[g(" API Tokens ")]),_:1},8,["href"])):c("",!0),Ne,e("form",{onSubmit:w(l,["prevent"])},[u(_,{as:"button"},{default:n(()=>[g(" Log Out ")]),_:1})],32)]),_:1})])]),e("div",Pe,[e("button",{class:"inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400",onClick:v[0]||(v[0]=i=>a.value=!a.value)},[(s(),o("svg",De,[e("path",{class:h({hidden:a.value,"inline-flex":!a.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M4 6h16M4 12h16M4 18h16"},null,2),e("path",{class:h({hidden:!a.value,"inline-flex":a.value}),"stroke-linecap":"round","stroke-linejoin":"round","stroke-width":"2",d:"M6 18L18 6M6 6l12 12"},null,2)]))])])])]),e("div",{class:h([{block:a.value,hidden:!a.value},"sm:hidden"])},[e("div",Ee,[u(b,{href:t.route("dashboard"),active:t.route().current("dashboard")},{default:n(()=>[g(" Dashboard ")]),_:1},8,["href","active"])]),e("div",Fe,[e("div",Oe,[t.$page.props.jetstream.managesProfilePhotos?(s(),o("div",Ve,[e("img",{class:"object-cover w-10 h-10 rounded-full",src:t.$page.props.auth.user.profile_photo_url,alt:t.$page.props.auth.user.name},null,8,Ie)])):c("",!0),e("div",null,[e("div",Re,k(t.$page.props.auth.user.name),1),e("div",He,k(t.$page.props.auth.user.email),1)])]),e("div",Qe,[u(b,{href:t.route("profile.show"),active:t.route().current("profile.show")},{default:n(()=>[g(" Profile ")]),_:1},8,["href","active"]),t.$page.props.jetstream.hasApiFeatures?(s(),y(b,{key:0,href:t.route("api-tokens.index"),active:t.route().current("api-tokens.index")},{default:n(()=>[g(" API Tokens ")]),_:1},8,["href","active"])):c("",!0),e("form",{method:"POST",onSubmit:w(l,["prevent"])},[u(b,{as:"button"},{default:n(()=>[g(" Log Out ")]),_:1})],32),t.$page.props.jetstream.hasTeamFeatures?(s(),o(x,{key:1},[Ue,Ze,u(b,{href:t.route("teams.show",t.$page.props.auth.user.current_team),active:t.route().current("teams.show")},{default:n(()=>[g(" Team Settings ")]),_:1},8,["href","active"]),t.$page.props.jetstream.canCreateTeams?(s(),y(b,{key:0,href:t.route("teams.create"),active:t.route().current("teams.create")},{default:n(()=>[g(" Create New Team ")]),_:1},8,["href","active"])):c("",!0),t.$page.props.auth.user.all_teams.length>1?(s(),o(x,{key:1},[qe,Ge,(s(!0),o(x,null,B(t.$page.props.auth.user.all_teams,i=>(s(),o("form",{key:i.id,onSubmit:w(f=>r(i),["prevent"])},[u(b,{as:"button"},{default:n(()=>[e("div",Ke,[i.id==t.$page.props.auth.user.current_team_id?(s(),o("svg",We,Ye)):c("",!0),e("div",null,k(i.name),1)])]),_:2},1024)],40,Je))),128))],64)):c("",!0)],64)):c("",!0)])])],2)]),t.$slots.header?(s(),o("header",et,[e("div",tt,[p(t.$slots,"header")])])):c("",!0),e("main",null,[p(t.$slots,"default")]),u(I)])]))}};export{at as _};
