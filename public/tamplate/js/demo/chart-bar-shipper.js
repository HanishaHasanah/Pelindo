document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("myBarChart");

    if (ctx) {
        const dataValues = JSON.parse(ctx.getAttribute("data-values"));
        const bulanMax = parseInt(ctx.getAttribute("data-bulan"));
        const tahun = ctx.getAttribute("data-tahun");
        const shipper = ctx.getAttribute("data-shipper");

        const labels = Array.from({ length: bulanMax }, (_, i) =>
            new Date(0, i).toLocaleString('id-ID', { month: 'long' })
        );

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: `Produksi Shipper (${shipper}, ${tahun})`,
                    data: dataValues,
                    backgroundColor: '#36b9cc'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' Ton';
                            }
                        }
                    }
                }
            }
        });
    }
});
