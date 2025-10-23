// constante encargada de seleccionar el elemento tabla de productos mediante la clase correspondiente y su elemento
const tablaProductos = document.querySelector("#tablaProductos tbody");
document.addEventListener("DOMContentLoaded", function () {
  getListaProductos();
  // se invica a la función getListarProductos
});
// función encargada de vincularse con la lista de los productos del usuario
function getListaProductos() {
  const url = base_url + "principal/listaProducto";
  // se envian los datos al controlador Principal en el método listaProducto
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaProducto));
  // se envian los datos de la variable listaProducto
  http.onreadystatechange = function () {
    // se espera la respuesta del servidor y se procede a mostrar los datos de la lista de productos en la tabla
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((producto) => {
        html += `
                    <tr> 
                    <td>  
                    <img class="img-thumbnail rounded-circle" src="../${
                      producto.img
                    }" alt="" width="100">
                    </td>           
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-warning">$${
                      res.moneda + " " + producto.precio
                    }</span></td>
                    <td>
                    <button class="btn btn-primary btnEliminarProducto" type="button" prod="${
                      producto.id
                    }"><i class="fas fa-trash"></i></button>
                    <button class="btn btn-primary btnAddCart" type="button" prod="${
                      producto.id
                    }"><i class="fas fa-cart-plus"></i></button>
                    </td>
                    </tr>
                    `;
      });
      tablaProductos.innerHTML = html;
      // se llaman a las funciones para poder eliminar un producto o agregarlo al carrito
      btnEliminarProducto();
      btnAgregarProducto();
    }
  };
}
// función encargada de seleccionar los elementos con la clase del botón eliminar
function btnEliminarProducto() {
  let listaEliminar = document.querySelectorAll(".btnEliminarProducto");
  for (let i = 0; i < listaEliminar.length; i++) {
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      EliminarListaProducto(idProducto);
    });
  }
}
// función encargada de eliminar los prductos de la lista
function EliminarListaProducto(idProducto) {
  for (let i = 0; i < listaProducto.length; i++) {
    if (listaProducto[i]["idProducto"] == idProducto) {
      listaProducto.splice(i, 1);
    }
  }
  localStorage.setItem("listaProducto", JSON.stringify(listaProducto));
  getListaProductos();
  cantidadProducto();
  Swal.fire({
    confirmButtonColor: "#FF8840",
    text: "Producto eliminado",
    icon: "success",
  });
}
//agregar a carrito desde lista de productos
function btnAgregarProducto() {
  let listaAgregar = document.querySelectorAll(".btnAddCart");
  for (let i = 0; i < listaAgregar.length; i++) {
    listaAgregar[i].addEventListener("click", function () {
      let idProducto = listaAgregar[i].getAttribute("prod");
      agregarCarrito(idProducto, 1, true);
    });
  }
}
