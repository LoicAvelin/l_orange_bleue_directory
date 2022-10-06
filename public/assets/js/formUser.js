// For add dynamic fields
/* window.onload = () => {
  // on va chercher le rôle
  let rôle = document.querySelector("#users_roles_0");

  rôle.addEventListener("change", function(){
    let form = this.closest("form");
    let data = this.name + "=" + this.value;
    
    fetch(form.action, {
      method: form.getAttribute("method"),
      body: data,
      headers: {
        "Content-Type": "application/x-www-form-urlencoded; charset: utf-8"
      }
    })
    .then(response => response.text())
    .then(html => {
      let content = document.createElement("html");
      content.innerHTML = html;
      let newSelect = content.querySelector("#users_structures");
      document.querySelector("#users_structures").replaceWith(newSelect);
    })
    .catch(error => {
      console.log(error);
    })
  });
} */