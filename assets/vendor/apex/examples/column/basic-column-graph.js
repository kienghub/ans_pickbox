var options = {
  chart: {
    height: 350,
    type: "bar"
  },
  plotOptions: {
    bar: {
      horizontal: false,
      endingShape: "rounded",
      columnWidth: "40%"
    }
  },
  dataLabels: {
    enabled: true
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"]
  },
  series: [
    {
      name: "ຕົ້ນທາງ",
      data: [44, 55, 57, 56, 61, 58, 63, 60, 66, 100, 79]
    },
    {
      name: "ປາຍທາງ",
      data: [35, 41, 36, 26, 45, 48, 52, 53, 41, 20, 100]
    }
  ],
  xaxis: {
    categories: [
      "ມັງກອນ",
      "ກຸມພາ",
      "ມີນາ",
      "ເມສາ",
      "ພຶດສະພາ",
      "ມີຖຸນາ",
      "ກໍລະກົດ",
      "ສິງຫາ",
      "ຕຸລາ",
      "ພະຈິກ",
      "ທັນວາ"
    ]
  },
  yaxis: {
    title: {
      text: "ຄ່າປຽບທຽບ"
    }
  },
  fill: {
    opacity: 1
  },
  tooltip: {
    y: {
      formatter: function (val) {
        return val + " %";
      }
    }
  },
  grid: {
    row: {
      colors: ["#f5f9fe", "#ffffff"], // takes an array which will be repeated on columns
      opacity: 0.5
    }
  },
  colors: ["#aa0000", "#2b8a3e", "#37b24d", "#ff3333", "#ff7777"]
};
var chart = new ApexCharts(
  document.querySelector("#basic-column-graph"),
  options
);
chart.render();
