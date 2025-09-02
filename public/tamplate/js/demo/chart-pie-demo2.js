document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("komoditasPieChart");

    if (ctx) {
        const labels = JSON.parse(ctx.getAttribute("data-labels"));
        const dataValues = JSON.parse(ctx.getAttribute("data-values"));

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: [
                        '#ff6384', '#36a2eb', '#ffcd56',
                        '#4bc0c0', '#9966ff'
                    ],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let dataset = context.dataset.data;
                                let total = dataset.reduce((a, b) => a + b, 0);
                                let value = dataset[context.dataIndex];
                                let percentage = ((value / total) * 100).toFixed(1);
                                return `${context.label}: ${value.toLocaleString()} Ton (${percentage}%)`;
                            }
                        }
                    },
                    legend: {
                        display: true,
                        position: 'bottom'
                    }
                },
                cutout: '70%',
            },
        });
    }
});
