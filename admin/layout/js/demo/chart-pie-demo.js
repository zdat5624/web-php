// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");

// Kiểm tra nếu không có dữ liệu
if (!productByCategory || productByCategory.length === 0) {
  ctx.parentElement.innerHTML = '<p class="text-center">Chưa có dữ liệu để hiển thị</p>';
} else {
  // Tạo mảng màu sắc động
  const colors = [
    '#4e73df',  // Màu xanh dương
    '#1cc88a',  // Màu xanh lá
    '#36b9cc',  // Màu xanh lam
    '#f6c23e',  // Màu vàng
    '#e74a3b',  // Màu đỏ
    '#858796'   // Màu xám
  ];

  const hoverColors = [
    '#2e59d9',  // Màu xanh dương đậm
    '#17a673',  // Màu xanh lá đậm
    '#2c9faf',  // Màu xanh lam đậm
    '#dda20a',  // Màu vàng đậm
    '#d32f2f',  // Màu đỏ đậm
    '#6c757d'   // Màu xám đậm
  ];

  // Lấy nhãn và dữ liệu từ productByCategory
  const labels = productByCategory.map(item => item.name);
  const data = productByCategory.map(item => item.total_quantity);
  // Tạo mảng màu sắc tương ứng với số lượng danh mục
  const backgroundColors = data.map((_, index) => colors[index % colors.length]);
  const hoverBackgroundColors = data.map((_, index) => hoverColors[index % hoverColors.length]);

  var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: labels, // Nhãn từ dữ liệu động
      datasets: [{
        data: data, // Dữ liệu từ dữ liệu động
        backgroundColor: backgroundColors, // Màu sắc động
        hoverBackgroundColor: hoverBackgroundColors, // Màu khi hover
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function (tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
            return chart.labels[tooltipItem.index] + ': ' + datasetLabel + ' sản phẩm';
          }
        }
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });
}