
<<<<<<< HEAD

=======
>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
//
// sales_funnel
//
var options = {
    chart: {
      type: "area",
      height: 208,
      sparkline: {
        enabled: true,
      },
    },
    series: [
      {
        data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54],
      },
    ],
    stroke: {
      width: 2,
      curve: "smooth",
    },
    fill: {
      type: "gradient",
      gradient: {
        shade: "light",
        type: "vertical",
        opacityFrom: 0.4,
        opacityTo: 0,
        stops: [0, 100],
      },
    },
<<<<<<< HEAD
  
=======

>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
    markers: {
      size: 0,
    },
    colors: ["#FF6C2F"],
    tooltip: {
      fixed: {
        enabled: false,
      },
      x: {
        show: false,
      },
      y: {
        title: {
          formatter: function (seriesName) {
            return "";
          },
        },
      },
      marker: {
        show: false,
      },
    },
  };
  var chart = new ApexCharts(document.querySelector("#chart2"), options);
  chart.render();
<<<<<<< HEAD
  
=======
>>>>>>> 17d4d96a776f010598a17eafd006c45f04996fff
