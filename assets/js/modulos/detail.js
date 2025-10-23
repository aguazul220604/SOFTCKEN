// en primer instancia se delcaran las constantes encargadas de hacer la selección de clases de los elementos
// html del sistema que el usuario acciona
const btnAddCart = document.querySelector("#btnAddCart");
const cantidad = document.querySelector("#cantidad");
// identificador del producto seleccionado
const idProducto = document.querySelector("#idProducto");
document.addEventListener("DOMContentLoaded", function () {
  // la función escucha los eventos del usuario
  btnAddCart.addEventListener("click", function () {
    // mediante la funcion agregarCarrito se envían los parámetros correspondientes a:
    // idProducto y cantidad provenientes de las constantes declaradas
    agregarCarrito(idProducto.value, cantidad.value);
  });
});
