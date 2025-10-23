let tablaPendientes, tablaFinalizados, tablaProceso;
const modalPedidos = new bootstrap.Modal(
  document.getElementById("modalPedidos")
  // se escucha la acción del elemento modal de pedidos
);
document.addEventListener("DOMContentLoaded", function () {
  tablaPendientes = $("#tablaPendientes").DataTable({
    // mediante AJAX se utiliza el plugin DataTable para traer los datos de la tabla pedidos del usuario
    ajax: {
      url: base_url + "pedidos/listarPedidos", // se llama al controlador que proporciona los datos
      dataSrc: "",
    },
    columns: [
      // se declaran las columnas de la tabla
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "estado" },
      { data: "fecha" },
      { data: "email" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "direccion" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
  // según el estado de actualización del Administrador AJAX rescata los datos correspondientes a los pedidos en proceso
  tablaProceso = $("#tablaProceso").DataTable({
    ajax: {
      // se llama al controlador Pedidos para utilizar el método listarProceso
      url: base_url + "pedidos/listarProceso",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "estado" },
      { data: "fecha" },
      { data: "email" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "direccion" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
    // según el estado de actualización del Administrador AJAX rescata los datos correspondientes a los pedidos finalizados
  tablaFinalizados = $("#tablaFinalizados").DataTable({
    ajax: {
      // se llama al controlador Pedidos para utilizar el método listarFinalizados
      url: base_url + "pedidos/listarFinalizados",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "estado" },
      { data: "fecha" },
      { data: "email" },
      { data: "nombre" },
      { data: "apellido" },
      { data: "direccion" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
});
// mediante esta funcion es posible cambiar el estado de los pedidos
function cambiarProceso(idPedido, proceso) {
  Swal.fire({
    text: "¿Está seguro de cambiar el estado?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#FF8840",
    cancelButtonColor: "#d33",
    confirmButtonText: "Actualizar",
  }).then((result) => {
    // si la respuesta es afirmativa se mandan los parámetros al controlador Pedidos en su método update
    if (result.isConfirmed) {
      const url = base_url + "pedidos/update/" + idPedido + "/" + proceso;
      const http = new XMLHttpRequest();
      http.open("GET", url, true);
      http.send();
      // se espera la respuesta del servidor
      http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log(this.readyState);
          const res = JSON.parse(this.responseText);
          if (res.icono == "success") {
            // la pagina se refresca
            tablaPendientes.ajax.reload();
            tablaProceso.ajax.reload();
            tablaFinalizados.ajax.reload();
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
// esta función se encarga de poder visualizar los pedidos en el panel Administrativo
function verPedido(idPedido) {
  // recibe de parámetro el id del Pedido seleccionado
  const url = base_url + "clientes/verPedido/" + idPedido;
  // el parámetro se manda al controlador Cliente en su método verPedido para que la actualización se muestre en los pedidos del usuario
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // se recibe la respuesta del servidor y se envian los datos correspindientes al precio del producto para obtener el subtotal de compra en sincronía con los datos proporcionados por el usuario
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((row) => {
        let subtotal = parseFloat(row.precio) * parseInt(row.cantidad);
        // ejecución del codigo html para mostrar la tabla
        html += `
                  <tr>          
                  <td>${row.producto}</td>
                  <td><span class="badge bg-warning">$${
                    res.moneda + " " + row.precio
                  }</span></td>
                  <td><span class="badge bg-primary">${row.cantidad}</span></td>
                  <td>$${subtotal.toFixed(2)}</td>
                  </tr>
                  `;
      });
      document.querySelector("#tablaPedidos tbody").innerHTML = html;
      modalPedidos.show();
    }
  };
}
