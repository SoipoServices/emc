import{_ as m}from"./AppLayout-dkNshsh_.js";import _ from"./UserCard-w3vb3xMq.js";import h from"./Search-PZlCd2ft.js";import{o as s,e as r,F as c,h as d,c as n,n as p,u as f,j as b,f as y,d as x,w as o,a,b as i}from"./app-CsLTyiBv.js";import{_ as v}from"./PrimaryButton-BPReKo5S.js";import"./ApplicationMark-F6376eBT.js";import"./_plugin-vue_export-helper-DlAUqK2U.js";import"./Footer-Ced7EdXj.js";const k={key:0,class:"join"},j={__name:"Pagination",props:{items:{type:Object,required:!0}},setup(t){return(l,u)=>t.items.length>3?(s(),r("div",k,[(s(!0),r(c,null,d(t.items,e=>(s(),r("div",null,[e.url?(s(),n(f(b),{class:p(["join-item btn text-white bg-gray-800 dark:bg-gray-200",{"btn-active":e.active}]),href:e.url,key:e.id,innerHTML:e.label},null,8,["href","class","innerHTML"])):(s(),n(v,{class:"join-item btn bg-gray-800 dark:bg-gray-200",key:e.id,innerHTML:e.label,disabled:""},null,8,["innerHTML"]))]))),256))])):y("",!0)}},w=a("h2",{class:"font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"}," Dashboard ",-1),$={class:"py-12"},L={class:"max-w-7xl mx-auto sm:px-6 lg:px-8"},q={class:"bg-gray-200 dark:bg-gray-800 bg-opacity-25 overflow-hidden shadow-xl sm:rounded-lg"},B={class:"grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 p-6 lg:p-8"},H={class:"max-w-lg mx-auto py-10"},M={class:"flex flex-wrap items-center justify-center"},z={__name:"Dashboard",props:{users:{type:Object,required:!0},locale:{type:String,required:!0},search:{type:String},tags:{type:Object,required:!0}},setup(t){const l=t;return x(l.users),(u,e)=>(s(),n(m,{title:"Dashboard"},{header:o(()=>[w]),default:o(()=>[a("div",$,[a("div",L,[a("div",q,[i(h,{class:"pt-10",tags:t.tags,locale:t.locale,search:t.search},null,8,["tags","locale","search"]),a("div",B,[(s(!0),r(c,null,d(l.users.data,g=>(s(),r("div",null,[i(_,{user:g},null,8,["user"])]))),256))]),a("div",H,[a("div",M,[i(j,{items:l.users.links},null,8,["items"])])])])])])]),_:1}))}};export{z as default};