// wait until document is loaded
document.addEventListener("DOMContentLoaded",e=>{let t=()=>{document.getElementById("profile-avatar-picker")?.classList.toggle("hidden")};// show modal
document.querySelector(".user-profile-picture")?.addEventListener("click",e=>{t()}),// close modal
document.querySelector(".profile-avatar-picker--modal--close")?.addEventListener("click",e=>{t()}),document.querySelector('input[name="profile_avatar"]')?.addEventListener("change",e=>{let t=document.querySelector('label[for="profile_avatar"]'),a=new FormData,r=e.target.files[0],o=document.querySelector('input[name="user_id"]').value;t.classList.remove("success"),a.append("action","setUploadedAvatarUrl"),a.append("avatar",r),a.append("user_id",o),fetch(ams.url,{method:"POST",credentials:"same-origin",body:a}).then(e=>e.json()).then(e=>{if(""!==e.data.avatar_url){let a=document.querySelector("span.profile_avatar_message");document.querySelector('input[name="avatar_url"]').value=e.data.avatar_url,document.querySelector("tr.user-profile-picture td img").remove(),// TODO: fix image live changing
document.querySelector("tr.user-profile-picture td").insertAdjacentHTML("afterbegin",`<img src="${e.data.avatar_url}">`),a.innerText="Avatar are uploaded, you can close modal!",t.classList.add("success")}}).catch(e=>{console.error(e)})})});//# sourceMappingURL=admin.js.map

//# sourceMappingURL=admin.js.map
