import{B as be,d as ae,k as oe,p as h,j as T,x as se,f as E,c as r,s as d,i as Z,t as A,a as I,b as re,g as y,h as s,o as $,r as _,q as b,e as ve,m as ne,l as ge,C as te,y as ie,A as fe,$ as me,n as ye}from"./props-By7h2erF.js";function F(a,e,o,t){var i=a.__style;if(i!==e){var n=be(e);n==null?a.removeAttribute("style"):a.style.cssText=n,a.__style=e}return t}var xe=E('<span class="text-white font-bold text-lg drop-shadow-md">✓</span>'),we=E('<button type="button"><!></button>'),he=E('<div class="absolute top-16 left-0 bg-white border border-gray-300 rounded-lg p-5 shadow-xl z-50 min-w-80"><div class="mb-4"><label class="block"><span class="block font-semibold mb-2 text-gray-700 text-sm">Select Color:</span> <input type="color" class="w-full h-12 border-2 border-gray-300 rounded-lg cursor-pointer"/></label></div> <div class="mb-4"><label class="block"><span class="block font-semibold mb-2 text-gray-700 text-sm">Hex Value:</span> <input type="text" placeholder="#DC2626" class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg text-sm font-mono uppercase focus:outline-none focus:border-primary"/></label></div> <div class="mb-4"><label class="block"><span class="block font-semibold mb-2 text-gray-700 text-sm"> </span> <input type="range" min="0" max="100" step="1" class="w-full h-2 rounded-full cursor-pointer"/></label></div> <div class="mb-4"><span class="block font-semibold mb-2 text-gray-700 text-sm">Preset Colors:</span> <div class="grid grid-cols-6 gap-2"></div></div> <div class="flex gap-2"><button type="button" class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition-colors">Reset</button> <button type="button" class="flex-1 px-4 py-2 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-primary-dark transition-colors">Close</button></div></div>'),_e=E('<div class="relative inline-block w-full"><button type="button" class="w-full h-12 border-2 border-gray-300 rounded-lg cursor-pointer transition-all hover:border-gray-500 flex items-center justify-center font-semibold text-sm"><span class="bg-white bg-opacity-90 px-3 py-1 rounded uppercase tracking-wide"> </span></button> <!></div>');function ke(a,e){oe(e,!0);let o=h(e,"defaultColor",3,"#DC2626"),t=T(se(o())),i=T(!1),n=T(100);const p=["#DC2626","#EA580C","#D97706","#65A30D","#059669","#0891B2","#2563EB","#7C3AED","#C026D3","#E11D48","#475569","#18181B"];function v(l){y(t,l,!0),window.wp&&window.wp.customize&&window.wp.customize(e.settingId,m=>{m.set(l)})}function g(l){v(l.target.value)}function k(l){v(l)}function M(){v(o()),y(n,100)}function q(){y(i,!s(i))}function X(l,m){const z=parseInt(l.slice(1,3),16),x=parseInt(l.slice(3,5),16),c=parseInt(l.slice(5,7),16);return`rgba(${z}, ${x}, ${c}, ${m/100})`}let Y=$(()=>X(s(t),s(n)));var V=_e(),f=r(V);f.__click=q;var U=r(f),B=r(U),j=d(f,2);{var D=l=>{var m=he(),z=r(m),x=r(z),c=d(r(x),2);c.__input=g;var O=d(z,2),R=r(O),C=d(r(R),2);C.__input=g,b(C,"pattern","^#[0-9A-Fa-f]6$");var S=d(O,2),N=r(S),L=r(N),W=r(L),K=d(L,2),u=d(S,2),w=d(r(u),2);ve(w,21,()=>p,ge,(J,H)=>{var P=we();P.__click=()=>k(s(H));var de=r(P);{var pe=Q=>{var ue=xe();I(Q,ue)};Z(de,Q=>{s(t)===s(H)&&Q(pe)})}A(()=>{ne(P,1,`w-10 h-10 border-2 rounded-lg cursor-pointer transition-all hover:scale-110 flex items-center justify-center ${s(t)===s(H)?"border-black shadow-lg":"border-transparent"}`),F(P,`background-color: ${s(H)??""};`)}),I(J,P)});var G=d(u,2),ee=r(G);ee.__click=M;var ce=d(ee,2);ce.__click=q,A(()=>{b(x,"for",`${e.settingId??""}-color`),b(c,"id",`${e.settingId??""}-color`),te(c,s(t)),b(R,"for",`${e.settingId??""}-hex`),b(C,"id",`${e.settingId??""}-hex`),te(C,s(t)),b(N,"for",`${e.settingId??""}-opacity`),_(W,`Opacity: ${s(n)??""}%`),b(K,"id",`${e.settingId??""}-opacity`)}),ie(K,()=>s(n),J=>y(n,J)),I(l,m)};Z(j,l=>{s(i)&&l(D)})}A(()=>{F(f,`background-color: ${s(Y)??""};`),_(B,s(t))}),I(a,V),re()}ae(["click","input"]);var ze=E('<div class="absolute -top-10 bg-primary text-white px-3 py-1 rounded-lg text-sm font-semibold shadow-lg"> </div>'),Ce=E('<div class="range-slider-wrapper"><div class="flex items-center justify-between mb-3"><label class="text-sm font-semibold text-gray-700 dark:text-gray-300"> </label> <span class="text-sm font-bold text-primary px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full"> </span></div> <div class="relative"><input type="range"/> <!></div> <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400"><span> </span> <button type="button" class="text-primary hover:text-primary-dark font-semibold transition-colors">Reset</button> <span> </span></div></div>');function Ie(a,e){oe(e,!0);let o=h(e,"defaultValue",3,50),t=h(e,"min",3,0),i=h(e,"max",3,100),n=h(e,"step",3,1),p=h(e,"unit",3,""),v=h(e,"label",3,"Value"),g=T(se(o())),k=T(!1);function M(u){y(g,u,!0),window.wp&&window.wp.customize&&window.wp.customize(e.settingId,w=>{w.set(u)})}function q(u){M(Number(u.target.value))}function X(){y(k,!0)}function Y(){y(k,!1)}function V(){M(o())}let f=$(()=>(s(g)-t())/(i()-t())*100),U=$(()=>s(k)?"w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full appearance-none cursor-pointer scale-105 transition-all":"w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full appearance-none cursor-pointer transition-all");var B=Ce();fe("mouseup",me,Y);var j=r(B),D=r(j),l=r(D),m=d(D,2),z=r(m),x=d(j,2),c=r(x);c.__input=q,c.__mousedown=X;var O=d(c,2);{var R=u=>{var w=ze(),G=r(w);A(()=>{F(w,`left: ${s(f)??""}%; transform: translateX(-50%);`),_(G,`${s(g)??""}${p()??""}`)}),I(u,w)};Z(O,u=>{s(k)&&u(R)})}var C=d(x,2),S=r(C),N=r(S),L=d(S,2);L.__click=V;var W=d(L,2),K=r(W);A(()=>{b(D,"for",e.settingId),_(l,v()),_(z,`${s(g)??""}${p()??""}`),b(c,"id",e.settingId),b(c,"min",t()),b(c,"max",i()),b(c,"step",n()),ne(c,1,ye(s(U)),"svelte-dtw4q9"),F(c,`background: linear-gradient(to right, var(--color-primary) 0%, var(--color-primary) ${s(f)??""}%, #e5e7eb ${s(f)??""}%, #e5e7eb 100%);`),_(N,`${t()??""}${p()??""}`),_(K,`${i()??""}${p()??""}`)}),ie(c,()=>s(g),u=>y(g,u)),I(a,B),re()}ae(["input","mousedown","click"]);document.addEventListener("DOMContentLoaded",()=>{Ee(),De(),Se(),Le(),Pe()});function Ee(){document.querySelectorAll(".blaze-color-picker").forEach(e=>{const o=e.dataset.setting,t=e.dataset.default||"#DC2626";new ke({target:e,props:{settingId:o,defaultColor:t}})})}function De(){document.querySelectorAll(".blaze-range-slider").forEach(e=>{const o=e.dataset.setting,t=parseInt(e.dataset.min)||0,i=parseInt(e.dataset.max)||100,n=parseInt(e.dataset.step)||1,p=parseInt(e.dataset.default)||50,v=e.dataset.unit||"";new Ie({target:e,props:{settingId:o,min:t,max:i,step:n,defaultValue:p,unit:v}})})}function Se(){document.querySelectorAll(".customize-control").forEach(e=>{const o=e.querySelector(".description");if(!o)return;o.style.display="none";const t=document.createElement("span");t.className="dashicons dashicons-editor-help blaze-tooltip-trigger",t.style.cssText=`
      cursor: pointer;
      margin-left: 5px;
      color: #2271b1;
      transition: color 0.2s;
    `,t.title="Click for help";const i=e.querySelector(".customize-control-title");i&&(i.style.display="flex",i.style.alignItems="center",i.appendChild(t),t.addEventListener("click",n=>{n.preventDefault();const p=o.style.display==="block";o.style.display=p?"none":"block",t.style.color=p?"#2271b1":"#d63638"}),t.addEventListener("mouseenter",()=>{t.style.color="#135e96"}),t.addEventListener("mouseleave",()=>{const n=o.style.display==="block";t.style.color=n?"#d63638":"#2271b1"}))})}function Le(){if(!window.wp||!window.wp.customize)return;const a=document.querySelector("#customize-theme-controls");if(!a)return;const e=document.createElement("div");e.className="blaze-live-preview-toggle",e.innerHTML=`
    <div style="padding: 12px; background: #f0f0f1; margin: 10px; border-radius: 4px;">
      <label style="display: flex; align-items: center; cursor: pointer;">
        <input type="checkbox" id="blaze-live-preview" checked style="margin-right: 8px;">
        <span style="font-weight: 500;">Enable Live Preview</span>
      </label>
      <p style="margin: 8px 0 0 24px; font-size: 12px; color: #646970;">
        Disable for better performance on slower devices
      </p>
    </div>
  `,a.prepend(e);const o=document.getElementById("blaze-live-preview");o.addEventListener("change",i=>{const n=i.target.checked;localStorage.setItem("blaze_live_preview",n?"1":"0"),Object.keys(wp.customize.settings.values).forEach(p=>{if(p.startsWith("blaze_")){const v=wp.customize(p);v&&(v.transport=n?"postMessage":"refresh")}}),le(n?"Live preview enabled":"Live preview disabled",n?"success":"info")}),localStorage.getItem("blaze_live_preview")==="0"&&(o.checked=!1,o.dispatchEvent(new Event("change")))}function Pe(){const a=document.createElement("style");a.textContent=`
    /* Blaze Customizer Enhancements */
    .blaze-color-picker-wrapper {
      margin-top: 8px;
    }
    
    .blaze-range-slider-wrapper {
      margin-top: 8px;
    }
    
    .customize-control-description {
      margin-top: 8px;
      padding: 8px 12px;
      background: #f0f0f1;
      border-left: 3px solid #2271b1;
      border-radius: 2px;
      font-size: 12px;
      line-height: 1.5;
    }
    
    .blaze-tooltip-trigger {
      font-size: 16px;
    }
    
    /* Color Picker Preview */
    .color-preview-btn {
      transition: all 0.2s ease;
    }
    
    .color-preview-btn:hover {
      transform: scale(1.02);
    }
    
    /* Range Slider */
    .range-slider-wrapper {
      position: relative;
    }
    
    .range-slider-track {
      height: 6px;
      border-radius: 3px;
      background: linear-gradient(to right, #e5e7eb, #2271b1);
    }
    
    /* Animations */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .blaze-live-preview-toggle {
      animation: slideIn 0.3s ease;
    }
    
    /* Customizer Tabs */
    .customize-section-description-container {
      margin-bottom: 15px;
    }
    
    /* Improved spacing */
    .customize-control {
      margin-bottom: 20px;
    }
    
    /* Focus styles */
    .customize-control input:focus,
    .customize-control select:focus,
    .customize-control textarea:focus {
      outline: 2px solid #2271b1;
      outline-offset: 2px;
    }
  `,document.head.appendChild(a)}function le(a,e="success"){if(!window.wp||!window.wp.customize)return;const o=document.createElement("div");o.className=`blaze-notification notification-${e}`,o.style.cssText=`
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 20px;
    background: ${e==="success"?"#00a32a":"#2271b1"};
    color: white;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 999999;
    animation: slideIn 0.3s ease;
    font-size: 13px;
    font-weight: 500;
  `,o.textContent=a,document.body.appendChild(o),setTimeout(()=>{o.style.animation="slideOut 0.3s ease",setTimeout(()=>o.remove(),300)},3e3);const t=document.createElement("style");t.textContent=`
    @keyframes slideOut {
      to {
        opacity: 0;
        transform: translateX(20px);
      }
    }
  `,document.head.appendChild(t)}document.addEventListener("keydown",a=>{if((a.ctrlKey||a.metaKey)&&a.key==="s"&&(a.preventDefault(),window.wp&&window.wp.customize&&(window.wp.customize.previewer.save(),le("Changes saved!","success"))),(a.ctrlKey||a.metaKey)&&a.key==="p"){a.preventDefault();const e=document.getElementById("blaze-live-preview");e&&(e.checked=!e.checked,e.dispatchEvent(new Event("change")))}});
