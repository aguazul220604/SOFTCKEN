// declaración de variables globales por selección de los elementos
const tablaProductos = document.querySelector("#tablaListaProductos tbody");
const tblPendientes = document.querySelector("#tblPendientes");
const estado1 = document.querySelector("#estado1");
const estado2 = document.querySelector("#estado2");
const estado3 = document.querySelector("#estado3");
// escucha de los eventos del usuario
document.addEventListener("DOMContentLoaded", function () {
  //obtencion de datos de la función getListaProductos utilizando AJAX
  if (tablaProductos) {
    getListaProductos();
  }
  $("#tblPendientes").DataTable({
    ajax: {
      url: base_url + "clientes/listarPendientes",
      dataSrc: "",
    },
    columns: [
      { data: "id_transaccion" },
      { data: "monto" },
      { data: "fecha" },
      { data: "accion" },
    ],
    language,
    dom,
    buttons,
  });
  function resultMessage(message) {
    const container = document.querySelector("#result-message");
    container.innerHTML = message;
  }
});
// dclaración de variable de estado del botón Paypal
let paypalButtonCreated = false;
// función encargada de obtener los datos del localStorage para enviarselos al Controlador principal en el método listaProducto
function getListaProductos() {
  let html = "";
  const url = base_url + "principal/listaProducto";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      if (res.totalPaypal > 0) {
        res.productos.forEach((producto) => {
          html += `
  <tr> 
    <td>  
      <img class="img-thumbnail rounded-circle" src="http://localhost/softcken/${
        producto.img
      }" alt="" width="100">
    </td>           
    <td>${producto.nombre}</td>
    <td>
      <span class="precioProducto">$${producto.precio} ${res.moneda}</span>
    </td>
    <td>
      <input type="number" value="${
        producto.cantidad
      }" min="1" max="10" class="bg-warning cantidadInput" style="padding: 8px; border: 3px solid #ccc; border-radius: 15px; font-size: 16px;">
    </td>
    <td>
      <span class="subtotal">$${(producto.cantidad * producto.precio).toFixed(
        2
      )} ${res.moneda}</span>
    </td>
    <td>
      <button class="btn btn-primary btnEliminarProducto" type="button" prod="${
        producto.id
      }"><i class="fas fa-trash"></i></button>
    </td>
  </tr>
`;
        });
        tablaProductos.innerHTML = html;
        btnEliminarProducto();
        const cantidadInputs = document.querySelectorAll(".cantidadInput");

        cantidadInputs.forEach((input) => {
          input.addEventListener("change", function () {
            const cantidad = parseInt(this.value);
            const idProducto = this.closest("tr")
              .querySelector(".btnEliminarProducto")
              .getAttribute("prod");
            const precio = parseFloat(
              this.closest("tr")
                .querySelector(".precioProducto")
                .innerText.split(" ")[0]
                .replace("$", "")
            );
            const subtotalElement =
              this.closest("tr").querySelector(".subtotal");
            const subtotal = cantidad * precio;
            subtotalElement.textContent =
              "$" + subtotal.toFixed(2) + " " + res.moneda;
            const subtotales = document.querySelectorAll(".subtotal");
            const valor = updateTotal(res, subtotales); // Actualizar el total después de cambiar la cantidad
            btnPaypal(valor); // Llamar a btnPaypal con el nuevo valor total
            // Actualizar el texto del total
            const totalText =
              "Total a pagar: $" + valor.toFixed(2) + " " + res.moneda;
            document.querySelector("#totalProducto").textContent = totalText;
            // Actualizar la cantidad en el localStorage
            actualizarCantidadProducto(idProducto, cantidad);
            // Actualizar listaCarrito en el ámbito global
            listaCarrito.forEach((producto) => {
              if (producto.idProducto === idProducto) {
                producto.cantidad = cantidad;
              }
            });
          });
        });

        const subtotales = document.querySelectorAll(".subtotal");
        const valor = updateTotal(res, subtotales);
        if (!paypalButtonCreated) {
          btnPaypal(valor);
          paypalButtonCreated = true;
        }
      } else {
        tablaProductos.innerHTML = `  
          <tr>
            <td colspan="12" class="text-center">
              Carrito vacíopp
            </td>
          </tr>`;
      }
    }
  };
}
// función encargada de modificar la cantidad de producto desde el input de la tabla en sincronía con los datos de listaCarrito en el localStorage
function actualizarCantidadProducto(idProducto, nuevaCantidad) {
  let listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listaCarrito) {
    // Buscar el producto en la lista del carrito
    const productoIndex = listaCarrito.findIndex(
      (producto) => producto.idProducto === idProducto
    );
    if (productoIndex !== -1) {
      // Actualizar la cantidad del producto
      listaCarrito[productoIndex].cantidad = nuevaCantidad;
      // Guardar la lista actualizada en el localStorage
      localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
      // Actualizar el valor del input de cantidad en la tabla
      const inputCantidad = document.querySelector(
        `.cantidadInput[prod="${idProducto}"]`
      );
      if (inputCantidad) {
        inputCantidad.value = nuevaCantidad;
      }
      // Actualizar la cantidad total de productos en el botón
      cantidadProducto();
      // Actualizar el total y el botón de PayPal
      const res = JSON.parse(this.responseText);
      const subtotales = document.querySelectorAll(".subtotal");
      const valor = updateTotal(res, subtotales);
      btnPaypal(valor);
    }
  }
}
// función encargada de atender la acción del botón para eliminar algún producto específico
function btnEliminarProducto() {
  let listaEliminar = document.querySelectorAll(".btnEliminarProducto");
  for (let i = 0; i < listaEliminar.length; i++) {
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      EliminarListaProducto(idProducto);
    });
  }
}
// función encargada de procesar la petición del usuario para eliminar productos
function EliminarListaProducto(idProducto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["idProducto"] == idProducto) {
      listaCarrito.splice(i, 1);
      localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
      getListaProductos();
      cantidadProducto();
      Swal.fire({
        text: "Producto eliminado",
        icon: "success",
        confirmButtonColor: "#FF8840",
      });
      if (listaCarrito.length === 0) {
        location.reload(); // Esto recarga la página
      }

      return; // Importante: Salir de la función después de eliminar el producto
    }
  }
}
// función encargada de sincronizarse con las funciones de eliminación de producto
function cantidadProducto() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listas != null) {
    btnProducto.textContent = listas.length;
  } else {
    btnProducto.textContent = 0;
  }
}
// función encargada de sincronizarse con el cálculo de subtotales y la suma total de venta
function updateTotal(res, subtotales) {
  let totalFinal = 0;
  subtotales.forEach((subtotal) => {
    totalFinal += parseFloat(
      subtotal.textContent.split(" ")[0].replace("$", "")
    );
  });
  const totalText =
    "Total a pagar: $" + totalFinal.toFixed(2) + " " + res.moneda;
  document.querySelector("#totalProducto").textContent = totalText;

  // Llamar a btnPaypal con el nuevo totalFinal
  btnPaypal(totalFinal);

  return totalFinal;
}
// actualización del estado del botón Paypal
let paypalButtonRendered = false;
let currentTotal = 0;
// función encargada de obtener los datos de cuenta Paypal y procesar el pago
function btnPaypal(totalFinal) {
  currentTotal = totalFinal; // Actualizar el valor de currentTotal con el nuevo totalFinal
  if (!paypalButtonRendered) {
    paypal
      .Buttons({
        createOrder: (data, actions) => {
          return actions.order.create({
            purchase_units: [
              {
                amount: {
                  value: currentTotal, // Usar el total actualizado
                },
              },
            ],
          });
        },
        onApprove: (data, actions) => {
          return actions.order.capture().then(function (orderData) {
            // Antes de llamar a registrarPedido, asegurémonos de que listaCarrito esté actualizado
            listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
            registrarPedido(orderData);
          });
        },
      })
      .render("#paypal-button-container");
    paypalButtonRendered = true;
  }
}
// función encargada de registrar los datos del usuario en cuanto a su pedido
function registrarPedido(datos) {
  const url = base_url + "clientes/registrarPedido";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(
    JSON.stringify({
      pedidos: datos,
      productos: listaCarrito,
    })
  );
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      const res = JSON.parse(this.responseText);
      Swal.fire({
        confirmButtonColor: "#FF8840",
        text: res.msg,
        icon: res.icono,
      });
      if (res.icono == "success") {
        localStorage.removeItem("listaCarrito");
        setTimeout(() => {
          window.location.reload();
        }, 2000);
      }
    }
  };
}
// función encargada de mostrar el estado de los pedidos del usuario
function verpedido(idPedido) {
  estado1.classList.remove("services-icon-wap");
  estado2.classList.remove("services-icon-wap");
  estado3.classList.remove("services-icon-wap");

  const modalPedido = new bootstrap.Modal(
    document.getElementById("modalPedido")
  );
  const url = base_url + "clientes/verPedido/" + idPedido;
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      if (res.pedido.proceso == 1) {
        estado1.classList.add("services-icon-wap");
      } else if (res.pedido.proceso == 2) {
        estado2.classList.add("services-icon-wap");
      } else {
        estado3.classList.add("services-icon-wap");
      }
      res.productos.forEach((row) => {
        let subtotal = parseFloat(row.precio) * parseInt(row.cantidad);
        html += `
                    <tr>          
                    <td>${row.producto}</td>
                    <td><span class="badge bg-warning">$${
                      res.moneda + " " + row.precio
                    }</span></td>
                    <td><span class="badge bg-primary">${
                      row.cantidad
                    }</span></td>
                    <td>$${subtotal.toFixed(2)}</td>
                    </tr>
                    `;
      });
      document.querySelector("#tablaPedidos tbody").innerHTML = html;
      modalPedido.show();
    }
  };
}
