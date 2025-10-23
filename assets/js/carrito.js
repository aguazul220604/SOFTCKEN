// creación de constantes encargadas de añadir productos al carrito
const btnAdd = document.querySelectorAll(".btnAdd");
const btnAddCarrito = document.querySelectorAll(".btnAddCarrito");
const btnAddCarrito1 = document.querySelectorAll(".btnAddCarrito1");
const btnProducto = document.querySelector("#btnCantidadProducto");
const btnCarrito = document.querySelector("#btnCantidadCarrito");
const verCarrito = document.querySelector("#verCarrito");
const tablaListaCarrito = document.querySelector("#tablaListaCarrito tbody");
//ver carrito
const myModal = new bootstrap.Modal(document.getElementById("myModal"));
// elementos de las listas de localStorage para gestionar productos
let listaProducto;
let listaCarrito;
// escucha de los eventos del usuario
document.addEventListener("DOMContentLoaded", function () {
  if (localStorage.getItem("listaProducto") != null) {
    listaProducto = JSON.parse(localStorage.getItem("listaProducto"));
    // obtener y asignar datos a la lista del localStorage listaProducto
  }
  if (localStorage.getItem("listaCarrito") != null) {
    listaCarrito = JSON.parse(localStorage.getItem("listaCarrito"));
    // obtener y asignar datos a la lista del localStorage listaCarrito
  }
  // iteración del botón btnAdd para agregar productos 
  for (let i = 0; i < btnAdd.length; i++) {
    btnAdd[i].addEventListener("click", function () {
      let idProducto = btnAdd[i].getAttribute("prod");
      agregarProducto(idProducto);
    });
  }
  // iteración del botón btnAddCarrito para agregar productos 
  for (let i = 0; i < btnAddCarrito.length; i++) {
    btnAddCarrito[i].addEventListener("click", function () {
      let idProducto = btnAddCarrito[i].getAttribute("prod");
      agregarCarrito(idProducto, 1);
    });
  }
  // iteración del botón btnAddCarrito1 para agregar productos 
  for (let i = 0; i < btnAddCarrito1.length; i++) {
    btnAddCarrito1[i].addEventListener("click", function () {
        let idProducto = btnAddCarrito1[i].getAttribute("prod1");
        let cantidadProd = this.parentElement.querySelector(".cantidadProd");
        // se obtiene la cantidad correspondiente al input con  la clase cantidadProd
        let cantidad1 = cantidadProd.value; 
        agregarCarrito(idProducto, cantidad1);
        // se envían los parámetros correspondientes a la función aregarCarrito
    });
  }
  cantidadProducto();
  cantidadCarrito();
  // comunicación con las funciones que solicitan la cantidad de los productos
  verCarrito.addEventListener("click", function () {
    getListaCarrito();
    myModal.show();
    // el modal de los productos agregados en el carrito se muestran
  });
});
// funcin que agrega productos al carrito segun el parámetro de su id
function agregarProducto(idProducto) {
  if (localStorage.getItem("listaProducto") == null) {
    listaProducto = [];
  } else {
    let listaexiste = JSON.parse(localStorage.getItem("listaProducto"));
    for (let i = 0; i < listaexiste.length; i++) {
      if (listaexiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          confirmButtonColor: "#FF8840",
          text: "El producto ya esta agregado",
          icon: "success",
        });
        return;
      }
      // se corrobora si el producto ya existe
    }
    listaProducto.concat(localStorage.getItem("listaProducto"));
  }
  listaProducto.push({
    idProducto: idProducto,
    cantidad: 1,
  });
  // se añade la cantidad y el id del producto
  localStorage.setItem("listaProducto", JSON.stringify(listaProducto));
  Swal.fire({
    confirmButtonColor: "#FF8840",
    text: "Producto agregado",
    icon: "success",
  });
  cantidadProducto();
}
// función encargada de obtener la cantidad de los productos añadidos
function cantidadProducto() {
  let listas = JSON.parse(localStorage.getItem("listaProducto"));
  if (listas != null) {
    btnProducto.textContent = listas.length;
  } else {
    btnProducto.textContent = 0;
  }
}
// cumple con el propósito de agregar los productos al carrito para procesar su compra
function agregarCarrito(idProducto, cantidad, accion = false) {
  if (localStorage.getItem("listaCarrito") == null) {
    listaCarrito = [];
  } else {
    let listaexiste = JSON.parse(localStorage.getItem("listaCarrito"));
    for (let i = 0; i < listaexiste.length; i++) {
      if (accion) {
        EliminarListaProducto(idProducto);
      }
      if (listaexiste[i]["idProducto"] == idProducto) {
        Swal.fire({
          confirmButtonColor: "#FF8840",
          text: "El producto ya esta en el carrito",
          icon: "success",
        });
        return;
      }
    }
    listaCarrito.concat(localStorage.getItem("listaCarrito"));
  }
  listaCarrito.push({
    idProducto: idProducto,
    cantidad: cantidad,
  });
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  Swal.fire({
    confirmButtonColor: "#FF8840",
    text: "Producto agregado al carrito",
    icon: "success",
  });
  cantidadCarrito();
}
// obtiene la cantidad de los productos en el carrito 
function cantidadCarrito() {
  let listas = JSON.parse(localStorage.getItem("listaCarrito"));
  if (listas != null) {
    btnCarrito.textContent = listas.length;
  } else {
    btnCarrito.textContent = 0;
  }
}
//obtiene la lista del carrito
function getListaCarrito() {
  const url = base_url + "principal/listaProducto";
  const http = new XMLHttpRequest();
  http.open("POST", url, true);
  http.send(JSON.stringify(listaCarrito));
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const res = JSON.parse(this.responseText);
      let html = "";
      res.productos.forEach((producto) => {
        // muestra los datos de solicitud del cliente desde los productos que agrega al carrito
        html += `
                    <tr> 
                    <td>  
                    <img class="img-thumbnail rounded-circle" src="http://localhost/softcken/${
                      producto.img
                    }" alt="" width="100">
                    </td>           
                    <td>${producto.nombre}</td> 
                    <td><span class="badge bg-warning">$${
                      res.moneda + " " + producto.precio
                    }</span></td>
                    <td><span class="badge bg-primary">${
                      producto.cantidad
                    }</span></td>
                    <td><span>$${
                      res.moneda + " " + producto.subtotal
                    }</span></td>
                    <td> 
                    <button class = "btn btn-danger btnDeleteCar" type="button" prod = "${
                      producto.id
                    }"><i class = "fas fa-times-circle"></i></button>
                    </td>
                    </tr>
                    `;
      });
      tablaListaCarrito.innerHTML = html;
      document.querySelector("#totalGeneral").textContent = "$" + res.total;
      btnEliminarCarrito();
    }
  };
}
// función que llama al botón de eliminar producto
function btnEliminarCarrito() {
  let listaEliminar = document.querySelectorAll(".btnDeleteCar");
  for (let i = 0; i < listaEliminar.length; i++) {
    listaEliminar[i].addEventListener("click", function () {
      let idProducto = listaEliminar[i].getAttribute("prod");
      EliminarListaCarrito(idProducto);
    });
  }
}
// funciónn que procesa los productos a eliminar mediante el id del producto
function EliminarListaCarrito(idProducto) {
  for (let i = 0; i < listaCarrito.length; i++) {
    if (listaCarrito[i]["idProducto"] == idProducto) {
      listaCarrito.splice(i, 1);
    }
  }
  localStorage.setItem("listaCarrito", JSON.stringify(listaCarrito));
  getListaCarrito();
  cantidadCarrito();
  Swal.fire({
    confirmButtonColor: "#FF8840",
    text: "Producto eliminado del carrito",
    icon: "success",
  });
}
