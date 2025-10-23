// constantes encargadas de seleccionar los elementos de inicio de sesión
const frm = document.querySelector("#formularioLogin");
const email = document.querySelector("#email");
const clave = document.querySelector("#clave");
// función encargada de escuchar los eventos del usuario en el DOM
document.addEventListener("DOMContentLoaded", function () {
  // al momento de enviar el formulario se inicializa la función para realizar la verificacón de campos
  frm.addEventListener("submit", function (e) {
    e.preventDefault();
    if (email.value == "" || clave.value == "") {
      alertas("Campos incompletos", "warning");
    } else {
      let data = new FormData(this);
      const url = base_url + "admin/validar";
      const http = new XMLHttpRequest();
      http.open("POST", url, true);
      http.send(data);
      // si los datos estan completos, se envían al controlador
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            setTimeout(() => {
              // al recibir la respuesta del servidor se accede al sistema
              window.location = base_url + "admin/home";
            }, 2000);
          }
          alertas(res.msg, res.icono);
        }
      };
    }
  });
});
// función encargada de procesar las alertas del inicio de sesión 
function alertas(msg, icono) {
  Swal.fire({
    confirmButtonColor: "#FF8840",
    text: msg,
    icon: icono,
  });
}
