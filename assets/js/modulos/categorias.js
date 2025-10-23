// declaración de constantes encargadas de seleccionar los elementos html del sistema
const nuevoRegistro = document.querySelector("#nuevoRegistro");
const nuevo = new bootstrap.Modal(document.getElementById("nuevo"));
const frmRegistro = document.querySelector("#frmRegistro");
let tablaCategorias;
const titleModal = document.querySelector("#titleModal");
const btnAction = document.querySelector("#btnAction");
// escucha de los eventos del cliente
document.addEventListener("DOMContentLoaded", function () {
  tablaCategorias = $("#tablaCategorias").DataTable({
    ajax: {
      url: base_url + "categorias/listar",
      dataSrc: "",
    },
    columns: [
      { data: "id" },
      { data: "categoria" },
      { data: "img" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
  // selección de elementos para la creación de un nuevo registro de categoría
  nuevoRegistro.addEventListener("click", function () {
    document.querySelector("#id").value = "";
    document.querySelector("#imagen").value = "";
    document.querySelector("#img_actual").value = "";

    titleModal.textContent = "Nueva categoría";
    btnAction.textContent = "Registrar";
    frmRegistro.reset();
    nuevo.show();
  });
  // función encargada de llamar al controlador Categoria en el método registrar
  frmRegistro.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "categorias/registrar";
    const http = new XMLHttpRequest();
    // se opera mediante una solicitud al servidor
    http.open("POST", url, true);
    http.send(data);
    // los datos se envian mediante el constructor data 
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.readyState);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          // si la respuesta es afirmativa se refresca la página
          nuevo.hide();
          tablaCategorias.ajax.reload();
          document.querySelector("#imagen").value = "";
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
// funcion encargada de eliminar la categoría seleccionada mediante el parámetro idCategoria para su seleccón
function eliminarCategoria(idCategoria) {
  Swal.fire({
    text: "¿Está seguro de eliminar la categoría?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#FF8840",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      const url = base_url + "categorias/delete/" + idCategoria;
      // el parametro se envia junto a la url del controlador
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      // se utiliza el método GET para el envío de los datos
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.readyState);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tablaCategorias.ajax.reload();
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
// funcíon encargada de editar la categoría
function editCategoria(idCategoria) {
  const url = base_url + "categorias/edit/" + idCategoria;
  // el parámetro que recibe se envía junto a la url
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.readyState);
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id;
      document.querySelector("#categoria").value = res.categoria;
      document.querySelector("#img_actual").value = res.img;
      btnAction.textContent = "Actualizar";
      titleModal.textContent = "Actualizar categoría";
      nuevo.show();
    }
  };
}
