document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById("myBarChart");

    var labels = JSON.parse(ctx.getAttribute('data-labels'));
    var values = JSON.parse(ctx.getAttribute('data-values'));

    var colors = [
        "#3958a1ff", "#82a8ffff", "#baceffff","#9d92e2ff", "#fba9f5ff"
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: "Produksi (Ton)",
                backgroundColor: colors.slice(0, values.length),
                borderRadius: 6,
                data: values,
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: { left: 10, right: 25, top: 25, bottom: 0 }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let val = context.raw;
                            return 'Produksi (Ton): ' + 
                                   (val >= 1000000 ? (val/1000000).toFixed(2) + 'M' : val.toLocaleString());
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: { maxRotation: 0, minRotation: 0 }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value >= 1000000 ? (value/1000000) + 'M' : value.toLocaleString();
                        }
                    },
                    grid: {
                        color: "rgb(234, 236, 244)",
                        borderDash: [2],
                        drawBorder: false
                    }
                }
            }
        }
    });
});


