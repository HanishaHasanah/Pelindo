document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("myAreaChart");

    if (ctx) {
        const dataValues = JSON.parse(ctx.getAttribute("data-values"));
        const tahun = ctx.getAttribute("data-tahun");
        const shipperName = ctx.getAttribute("data-shipper");

        const myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ],
                datasets: [{
                    label: `Produksi (${shipperName}) Tahun ${tahun}`,
                    lineTension: 0.3,
                    backgroundColor: "rgba(78, 115, 223, 0.05)",
                    borderColor: "rgba(78, 115, 223, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointBorderColor: "rgba(78, 115, 223, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                    pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: dataValues,
                }],
            },
            options: {
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: `Produksi ${shipperName} (${tahun})`,
                        font: {
                            size: 16,
                            weight: 'bold'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let value = context.raw || 0;
                                return `Produksi: ${value.toLocaleString()} Ton`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
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
