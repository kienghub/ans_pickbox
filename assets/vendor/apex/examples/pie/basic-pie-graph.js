var options = {
  chart: {
    width: 400,
    type: "pie"
  },
  labels: [
    "ຈຳນວນຮັບເຂົ້າສາງ",
    "ນ້ຳໜັກ",
    "ຈ່າຍຄ່າບໍລິການຕົ້ນທາງ",
    "ຈ່າຍຄ່າບໍລິການປາຍທາງ"
  ],
  series: [90, 20, 50, 20],
  responsive: [
    {
      breakpoint: 480,
      options: {
        chart: {
          width: 200
        },
        legend: {
          position: "bottom"
        }
      }
    }
  ],
  stroke: {
    width: 0
  },
  colors: ["#aa0000", "#fcc419", "#37b24d", "#ff3333", "#ff7777"]
};
var chart = new ApexCharts(document.querySelector("#basic-pie-graph"), options);
chart.render();
