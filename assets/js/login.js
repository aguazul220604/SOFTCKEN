const btnRegisto = document.querySelector("#btnRegisto");
const btnLogin = document.querySelector("#btnLogin");
const frmLogin = document.querySelector("#frmLogin");
const frmRegistro = document.querySelector("#frmRegistro");
const registro = document.querySelector("#registro");
const login = document.querySelector("#login");

const nombreRegistro = document.querySelector("#nombreRegistro");
const correoRegistro = document.querySelector("#correoRegistro");
const claveRegistro = document.querySelector("#claveRegistro");
const claveConfirmar = document.querySelector("#claveConfirmar");



const correoLogin = document.querySelector("#correoLogin");
const claveLogin = document.querySelector("#claveLogin");

const inputSearch = document.querySelector("#inputSearch");

const ModalLogin = new bootstrap.Modal(document.getElementById("ModalLogin"));

document.addEventListener("DOMContentLoaded", function () {
  btnRegisto.addEventListener("click", function () {
    frmLogin.classList.add("d-none");
    frmRegistro.classList.remove("d-none");
  });
  btnLogin.addEventListener("click", function () {
    frmRegistro.classList.add("d-none");
    frmLogin.classList.remove("d-none");
  });
  //registro
  registro.addEventListener("click", function () {
    if (
      nombreRegistro.value == "" ||
      correoRegistro.value == "" ||
      claveRegistro.value == "" ||
      claveConfirmar.value == ""
    ) {
      Swal.fire({
        confirmButtonColor: "#FF8840",
        text: "Campos incompletos",
        icon: "warning",
      });
    } else if (claveRegistro.value !== claveConfirmar.value) {
      Swal.fire({
          confirmButtonColor: "#FF8840",
          text: "Las contraseñas no coinciden",
          icon: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("nombre", nombreRegistro.value);
      formData.append("correo", correoRegistro.value);
      formData.append("password", claveRegistro.value);

      const url = base_url + "clientes/registroDirecto";

      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire({
            confirmButtonColor: "#FF8840",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            setTimeout(() => {
              enviarCorreo(correoRegistro.value, res.token);
            }, 2000);
          }
        }
      };
    }
  });
  //login directo
  login.addEventListener("click", function () {
    if (correoLogin.value == "" || claveLogin.value == "") {
      Swal.fire({
        confirmButtonColor: "#FF8840",
        text: "Campos incompletos",
        icon: "warning",
      });
    } else {
      let formData = new FormData();
      formData.append("correoLogin", correoLogin.value);
      formData.append("passwordLogin", claveLogin.value);
      const url = base_url + "clientes/loginDirecto";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(formData);
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          Swal.fire({
            confirmButtonColor: "#FF8840",
            text: res.msg,
            icon: res.icono,
          });
          if (res.icono == "success") {
            setTimeout(() => {
              window.location.reload();
            }, 2000);
          }
        }
      };
    }
  });
  //buscar productos
  inputSearch.addEventListener("keyup", function (e) {
    const url = base_url + "principal/busqueda/" + e.target.value;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
        const res = JSON.parse(this.responseText);
        let html = "";
        res.forEach((producto) => {
          let nombreConSaltosDeLinea = producto.nombre.replace(/\n/g, "<br>");
          html += `<div class="col-md-6 col-lg-3 col-xl-3">
                <div class="rounded position-relative fruite-item">
                <div class="fruite-img">
                <img src="${base_url + producto.img}" width="300px" height="300px">
                </div>
                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                <h4>${nombreConSaltosDeLinea}</h4>
                <div class="d-flex justify-content-between flex-lg-wrap">
                <p class="text-dark fs-5 fw-bold mb-0">$${producto.precio}</p>
                <a href="http://localhost/softcken/principal/Shop" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Agregar</a>
                </div>
                </div>
                </div>
                </div>`;
        });

        document.querySelector("#resultadoBusqueda").innerHTML = html;
      }
    };
  });
});

function enviarCorreo(correo, token) {
  let formData = new FormData();
  formData.append("token", token);
  formData.append("correo", correo);
  const url = base_url + "clientes/Enviarcorreo";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(formData);
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      Swal.fire({
        confirmButtonColor: "#FF8840",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}

function abrirModalLogin() {
  myModal.hide();
  ModalLogin.show();
}
