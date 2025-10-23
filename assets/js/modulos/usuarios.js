// constanntes a utilizar para el acceso de usuarios
const nuevoRegistro = document.querySelector("#nuevoRegistro");
const nuevo = new bootstrap.Modal(document.getElementById("nuevo"));
const frmRegistro = document.querySelector("#frmRegistro");
let tablaUsuarios;
const titleModal = document.querySelector("#titleModal");
const btnAction = document.querySelector("#btnAction");
// se escucha a los eventos del usuario
document.addEventListener("DOMContentLoaded", function () {
  tablaUsuarios = $("#tablaUsuarios").DataTable({
    ajax: {
      // se llama al controlador Usuarios
      url: base_url + "usuarios/listar",
      dataSrc: "",
    },
    // mediante AJAX se crean las columnas para mostrar los datos de los usuarios con acceso al panel administrativo
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "correo" },
      { data: "perfil" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
  // seleccionar el botón de crear un nuevo registro
  nuevoRegistro.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    titleModal.textContent = "Nuevo usuario";
    btnAction.textContent = "Registrar";
    frmRegistro.reset();
    document.querySelector("#clave").removeAttribute("readonly");
    nuevo.show();
  });
  // formulario para la creación de un nuevo usuario
  frmRegistro.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "usuarios/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.readyState);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          nuevo.hide();
          tablaUsuarios.ajax.reload();
        }
        Swal.fire({
          confirmButtonColor: "#FF8840",
          text: res.msg,
          icon: res.icono,
        });
      }
    };
  });
});
// función encargada de eliminar usuarios del panel Administrativo
function eliminarUsuario(idUser) {
  Swal.fire({
    text: "¿Está seguro de eliminar el registro?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#FF8840",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "usuarios/delete/" + idUser;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.readyState);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tablaUsuarios.ajax.reload();
          }
          Swal.fire({
            confirmButtonColor: "#FF8840",
            text: res.msg,
            icon: res.icono,
          });
        }
      };
    }
  });
}
// función que edita los datos del usuario
function editUser(idUser) {
  const url = base_url + "usuarios/edit/" + idUser;
  const http = new XMLHttpRequest();
  // se comunica con el controlador Usuarios en el método edit
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // recibe la respuesta y el estado del servidor para realizar actualizaciones
      console.log(this.readyState);
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id;
      document.querySelector("#nombre").value = res.nombre;
      document.querySelector("#apellido").value = res.apellido;
      document.querySelector("#correo").value = res.correo;
      document.querySelector("#clave").setAttribute("readonly", "readonly");
      btnAction.textContent = "Actualizar";
      titleModal.textContent = "Actualizar usuario";
      nuevo.show();
    }
  };
}
