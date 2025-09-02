document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("komoditasBarChart");

    if (ctx) {
        const dataValues = JSON.parse(ctx.getAttribute("data-values"));
        const bulanMax = parseInt(ctx.getAttribute("data-bulan"));
        const tahun = ctx.getAttribute("data-tahun");
        const komoditas = ctx.getAttribute("data-komoditas");

        const labels = Array.from({ length: bulanMax }, (_, i) =>
            new Date(0, i).toLocaleString('id-ID', { month: 'long' })
        );

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: `Produksi Komoditas (${komoditas}, ${tahun})`,
                    data: dataValues,
                    backgroundColor: '#36b9cc'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // ⬅️ penting biar pas
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return value.toLocaleString() + ' Ton';
                            }
                        }
                    }
                }
            }
        });
    }
});
