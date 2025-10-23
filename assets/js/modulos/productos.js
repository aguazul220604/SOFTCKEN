// se delcaran como constantes al formulario y el botón que lo acciona
const frmRegistro = document.querySelector("#frmRegistro");
const btnAction = document.querySelector("#btnAction");
let tablaProductos;
// se declaran las variables encargadas de seleccionar el modal de los productos
var firstTabEl = document.querySelector("#myTab li:last-child button");
var firstTab = new bootstrap.Tab(firstTabEl);
// se escucha a los eventos del usuario
document.addEventListener("DOMContentLoaded", function () {
  tablaProductos = $("#tablaProductos").DataTable({
    ajax: {
      // AJAX comunica al controlador Productos en el método listar
      url: base_url + "productos/listar",
      dataSrc: "",
    },
    // se declaran las columnas de la tabla que muestra los datos de los productos al Administrador
    columns: [
      { data: "id" },
      { data: "nombre" },
      { data: "precio" },
      { data: "cantidad" },
      { data: "img" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
  // enviar datos de productos a la base de datos
  frmRegistro.addEventListener("submit", function (e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "productos/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        console.log(this.readyState);
        const res = JSON.parse(this.responseText);
        if (res.icono == "success") {
          frmRegistro.reset();
          tablaProductos.ajax.reload();
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
// funcion encargada de eliminar los productos de la tabla
function eliminarProducto(idProducto) {
  Swal.fire({
    text: "¿Está seguro de eliminar el producto?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#FF8840",
    cancelButtonColor: "#d33",
    confirmButtonText: "Eliminar",
  }).then((result) => {
    if (result.isConfirmed) {
      // en caso afirmativo se manda el parámetro del id del producto
      const url = base_url + "productos/delete/" + idProducto;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.readyState);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            tablaProductos.ajax.reload();
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
// si se desea editar el producto se envia su id hacia el controlador Producto en el método edit
function editProducto(idProducto) {
  const url = base_url + "productos/edit/" + idProducto;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    // los datos se envian al controlador para poder realizar actualizaciones
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.readyState);
      const res = JSON.parse(this.responseText);
      document.querySelector("#id").value = res.id;
      document.querySelector("#nombre").value = res.nombre;
      document.querySelector("#descripcion").value = res.descripcion;
      document.querySelector("#precio").value = res.precio;
      document.querySelector("#cantidad").value = res.cantidad;
      document.querySelector("#img_actual").value = res.img;
      document.querySelector("#categoria").value = res.id_categoria;
      btnAction.textContent = "Actualizar";
      firstTab.show();
    }
  };
}
