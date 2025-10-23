// se invocan a las funciones encargadas de mostrar la disposición de los productos en cuanto al stock
productosMinimos();
productosTop();
function productosMinimos() {
  const url = base_url + "admin/productosMinimos";
  // se comunica al controlador Admin en el método productosMinimos
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.readyState);
      const res = JSON.parse(this.responseText);
      // se recibe la respuesta del servidor
      let nombre = [];
      let cantidad = [];
      // se crean arrays para obtener los datos de los productos
      for (let i = 0; i < res.length; i++) {
        // a los arrays se les asigna la respuesta del servidor
        nombre.push(res[i]["nombre"]);
        cantidad.push(res[i]["cantidad"]);
      }
      // se crea una nueva tabla (gráfico de tipo pastel)
      new Chart(document.getElementById("productosMinimos"), {
        type: "pie",
        data: {
          labels: nombre,
          // se asignan los nombres de las secciones
          datasets: [
            {
              backgroundColor: [
                "#FF2A20",
                "#FF4520",
                "#FF6019",
                "#FF8218",
                "#FFAA20",
              ],
              data: cantidad,
              // se coordinan los datos del gráfico
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
        },
      });
    }
  };
}
// función encargada de mostrar los productos más vendidos
function productosTop() {
  const url = base_url + "admin/productosTop";
  // se comunica con el controlador Admin en el método productosTop
  const http = new XMLHttpRequest();
  http.open("GET", url, true);
  http.send();
  http.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // se recibe la respuesta del servidor
      console.log(this.readyState);
      const res = JSON.parse(this.responseText);
      let nombre = [];
      let cantidad = [];
      // se asignan los arrays correspondientes
      for (let i = 0; i < res.length; i++) {
        nombre.push(res[i]["producto"]);
        cantidad.push(res[i]["total"]);
      }
      // se procede con la creación del gráfico
      var ctx = document.getElementById("productosTop").getContext("2d");
      var chart = new Chart(ctx, {
        type: "bar",
        data: {
          labels: nombre,
          datasets: [
            {
              backgroundColor: [
                "#FF2A20",
                "#FF4520",
                "#FF6019",
                "#FF8218",
                "#FFAA20",
              ],
              data: cantidad,
            },
          ],
        },
        options: {
          maintainAspectRatio: false,
          legend: {
            display: false,
            labels: {
              fontColor: "#585757",
              boxWidth: 40,
            },
          },
          tooltips: {
            enabled: true,
          },
          scales: {
            xAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontColor: "#585757",
                },
                gridLines: {
                  display: true,
                  color: "rgba(0, 0, 0, 0.07)",
                },
              },
            ],
            yAxes: [
              {
                ticks: {
                  beginAtZero: true,
                  fontColor: "#585757",
                },
                gridLines: {
                  display: true,
                  color: "rgba(0, 0, 0, 0.07)",
                },
              },
            ],
          },
        },
      });
    }
  };
}
