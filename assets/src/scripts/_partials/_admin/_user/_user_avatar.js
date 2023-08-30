// wait until document is loaded
document.addEventListener('DOMContentLoaded', e => {
  const toggleModalView = () => {
    document.getElementById("profile-avatar-picker")?.classList.toggle("hidden");
  }
  // show modal
  document.querySelector('.user-profile-picture')?.addEventListener('click', e => {
    toggleModalView()
  })
  // close modal
  document.querySelector('.profile-avatar-picker--modal--close')?.addEventListener('click', e => {
    toggleModalView()
  })

  document.querySelector('input[name="profile_avatar"]')?.addEventListener('change', e => {
    const avatarLabel = document.querySelector('label[for="profile_avatar"]');
    const data = new FormData();
    let selectedFile = e.target.files[0];
    let currentEditUserId = document.querySelector('input[name="user_id"]').value;
    avatarLabel.classList.remove("success");
    data.append("action", "setUploadedAvatarUrl");
    data.append("avatar", selectedFile);
    data.append("user_id", currentEditUserId);

    fetch(ams.url, {
      method: "POST",
      credentials: 'same-origin',
      body: data
    })
      .then(response => response.json())
      .then(resp => {
        if (resp.data.avatar_url !== "") {
          let avatarMessage = document.querySelector('span.profile_avatar_message');
          document.querySelector('input[name="avatar_url"]').value = resp.data.avatar_url;
          document.querySelector('tr.user-profile-picture td img').remove()
          // TODO: fix image live changing
          document.querySelector('tr.user-profile-picture td').insertAdjacentHTML("afterbegin", `<img src="${resp.data.avatar_url}">`);
          avatarMessage.innerText = "Avatar are uploaded, you can close modal!";
          avatarLabel.classList.add("success");
        }
      })
      .catch(error => {
        console.error(error);
      });
  })
})
