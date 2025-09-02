<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('tamplate/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('tamplate/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="{{ asset('tamplate/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <!--css bootstrap CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include("curahCair.sidebar")
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Navbar -->
                @include('curahCair.navbar')
                <!-- End of Navbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <div class="row">

                        <!-- total shipper -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Shipper</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalShippers }}
                                                Shipper</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Rentang Tahun -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Commodity</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCommodities }}
                                                Commodity</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Produksi -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Rentang Tahun</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">2024-2025</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Shipper produktif-->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Produksi</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                {{ number_format($totalProduksi, 3) }} Ton
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- === CARD PERBANDINGAN PRODUKSI === -->
                    <div class="card shadow mb-4" id="cardComparison">
                        <div class="card-header">
                            <h6 class="m-0 font-weight-bold text-primary">Perbandingan Produksi</h6>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="{{ url('curah-cair') }}#cardComparison"
                                class="row g-3 align-items-end">

                                <!-- Pilih jenis -->
                                <div class="col-12">
                                    <label class="fw-bold">Pilih data yang akan dibandingkan:</label><br>
                                    <input type="radio" name="jenis" value="shipper" {{ $jenis == 'shipper' ? 'checked' : '' }}> Shipper
                                    <input type="radio" name="jenis" value="commodity" {{ $jenis == 'commodity' ? 'checked' : '' }}> Komoditas
                                </div>

                                <!-- Grafik 1 -->
                                <div class="col-md-4">
                                    <label>Grafik 1 - Nama</label>
                                    <select name="id1" class="form-control">
                                        @foreach($listNama as $item)
                                            <option value="{{ $item->id }}" {{ $id1 == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun</label>
                                    <select name="tahun1" class="form-control">
                                        @foreach($listTahun as $th)
                                            <option value="{{ $th }}" {{ $tahun1 == $th ? 'selected' : '' }}>{{ $th }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Grafik 2 -->
                                <div class="col-md-4">
                                    <label>Grafik 2 - Nama</label>
                                    <select name="id2" class="form-control">
                                        @foreach($listNama as $item)
                                            <option value="{{ $item->id }}" {{ $id2 == $item->id ? 'selected' : '' }}>
                                                {{ $item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label>Tahun</label>
                                    <select name="tahun2" class="form-control">
                                        @foreach($listTahun as $th)
                                            <option value="{{ $th }}" {{ $tahun2 == $th ? 'selected' : '' }}>{{ $th }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Periode -->
                                <div class="col-md-3">
                                    <label>Periode</label>
                                    <select name="bulan" class="form-control">
                                        @foreach(range(1, 12) as $b)
                                            <option value="{{ $b }}" {{ $bulanFilter == $b ? 'selected' : '' }}>
                                                {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Tombol -->
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Tampilkan</button>
                                </div>
                            </form>

                            <!-- Grafik -->
                            <div class="row mt-4">
                                <!-- Grafik 1 -->
                                <div class="col-md-6">
                                    <h6 class="text-center">
                                        Grafik 1
                                        <small class="text-muted">(Total:
                                            {{ number_format(array_sum($data1), 0, ',', '.') }} Ton)</small>
                                    </h6>
                                    @if(array_sum($data1) == 0)
                                        <div class="alert alert-warning text-center">Data tidak tersedia</div>
                                    @else
                                        <div style="height:400px">
                                            <canvas id="compareChart1" data-values='@json($data1)'
                                                data-tahun="{{ $tahun1 }}"
                                                data-label="{{ optional($listNama->firstWhere('id', $id1))->name }}">
                                            </canvas>
                                        </div>
                                    @endif
                                </div>

                                <!-- Grafik 2 -->
                                <div class="col-md-6">
                                    <h6 class="text-center">
                                        Grafik 2
                                        <small class="text-muted">(Total:
                                            {{ number_format(array_sum($data2), 0, ',', '.') }} Ton)</small>
                                    </h6>
                                    @if(array_sum($data2) == 0)
                                        <div class="alert alert-warning text-center">Data tidak tersedia</div>
                                    @else
                                        <div style="height:400px">
                                            <canvas id="compareChart2" data-values='@json($data2)'
                                                data-tahun="{{ $tahun2 }}"
                                                data-label="{{ optional($listNama->firstWhere('id', $id2))->name }}">
                                            </canvas>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <!-- Pie Chart: Top 5 Shipper -->
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Shipper</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartShipper" style="max-width: 400px; max-height: 400px;"></canvas>
                                    <div class="alert alert-info mt-3 mb-0 p-2" style="font-size: 0.85rem;">
                                        📊 Data diambil dari seluruh tahun yang tersedia
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pie Chart: Top 5 Commodity -->
                        <div class="col-6">
                            <div class="card shadow mb-4">
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Top 5 Komoditas</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="chartCommodity" style="max-width: 400px; max-height: 400px;"></canvas>
                                    <div class="alert alert-info mt-3 mb-0 p-2" style="font-size: 0.85rem;">
                                        📊 Data diambil dari seluruh tahun yang tersedia
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">
                            <!-- Bar Chart -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Tren Produksi per Tahun</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar" style="height:400px;">
                                        <canvas id="myBarChart" data-labels='@json($labels)'
                                            data-values='@json($dataProduksi)'>
                                        </canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">

                        </div>
                    </div>

                    <!-- /.Page Content -->

                </div>
                <!-- /.Main Content -->

            </div>
            <!-- /.Content Wrapper -->

        </div>
        <!-- /.Page Wrapper -->


        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('tamplate/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('tamplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('tamplate/js/sb-admin-2.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('tamplate/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level plugins -->
        <script src="{{ asset('tamplate/vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('tamplate/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('tamplate/js/demo/datatables-demo.js') }}"></script>

        <!--bootstrap CDN Link-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>


        <script>
            const totalProduksiShipper = {{ $topShippers->sum('total') }};
            const totalProduksiCommodity = {{ $topCommodities->sum('total') }};

            // Fungsi untuk membuat chart Doughnut
            function createDoughnutChart(canvasId, labels, data, totalProduksi) {
                return new Chart(document.getElementById(canvasId), {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: data,
                            backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
                            borderWidth: 2,
                        }]
                    },
                    options: {
                        responsive: true,
                        cutout: '40%', // biar lubang di tengah besar
                        plugins: {
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 20,
                                    padding: 15
                                }
                            },
                            datalabels: {
                                color: '#f7f7f7ff',
                                font: { weight: 'bold', size: 12 },
                                formatter: (value) => {
                                    const percent = (value / totalProduksi * 100).toFixed(1);
                                    return percent + '%';
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function (context) {
                                        const value = context.parsed;
                                        return `${value.toLocaleString()} Ton`;
                                    }
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

            // Chart untuk Shipper
            createDoughnutChart(
                'chartShipper',
                {!! json_encode($topShippers->pluck('shipper.name')) !!},
                {!! json_encode($topShippers->pluck('total')) !!},
                totalProduksiShipper
            );

            // Chart untuk Commodity
            createDoughnutChart(
                'chartCommodity',
                {!! json_encode($topCommodities->pluck('commodity.name')) !!},
                {!! json_encode($topCommodities->pluck('total')) !!},
                totalProduksiCommodity
            );
        </script>

        <script>
            $(document).ready(function () {
                $('#tableShipperName').DataTable();
                $('#tableCommodityName').DataTable();
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var ctx = document.getElementById("myBarChart");
                if (!ctx) return;

                var labels = JSON.parse(ctx.getAttribute('data-labels'));
                var values = JSON.parse(ctx.getAttribute('data-values'));

                var colors = [
                    "#3958a1ff", "#82a8ffff", "#baceffff", "#9d92e2ff", "#fba9f5ff"
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
                                    label: function (context) {
                                        let val = context.raw;
                                        return 'Produksi (Ton): ' +
                                            (val >= 1000000 ? (val / 1000000).toFixed(2) + 'M' : val.toLocaleString());
                                    }
                                }
                            },
                            datalabels: {
                                anchor: 'end',
                                align: 'end',
                                offset: 4,
                                color: '#2a2a2a',
                                font: { weight: 'bold', size: 10 },
                                formatter: function (value) {
                                    return value > 0
                                        ? (value >= 1000000 ? (value / 1000000).toFixed(2) + "M" : value.toLocaleString("id-ID")) + " Ton"
                                        : "";
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
                                    callback: function (value) {
                                        return value >= 1000000 ? (value / 1000000) + 'M' : value.toLocaleString();
                                    }
                                },
                                grid: {
                                    color: "rgb(234, 236, 244)",
                                    borderDash: [2],
                                    drawBorder: false
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            });
        </script>

        <script>
            document.addEventListener("DOMContentLoaded", function () {

                // Auto submit kalau radio "jenis" berubah
                document.querySelectorAll("input[name='jenis']").forEach(radio => {
                    radio.addEventListener("change", function () {
                        this.closest("form").submit();
                    });
                });

                function renderComparisonChart(canvasId, color) {
                    const ctx = document.getElementById(canvasId);
                    if (!ctx) return;

                    const dataValues = JSON.parse(ctx.dataset.values);
                    const tahun = ctx.dataset.tahun;
                    const nama = ctx.dataset.label;

                    const labels = [
                        "Jan", "Feb", "Mar", "Apr", "Mei", "Jun",
                        "Jul", "Agus", "Sept", "Okt", "Nov", "Des"
                    ].slice(0, dataValues.length);

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: `Produksi (${nama}, ${tahun})`,
                                data: dataValues,
                                backgroundColor: color,
                                borderRadius: 6
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { position: 'top' },
                                datalabels: {
                                    anchor: 'end',
                                    align: 'end',
                                    offset: 4,
                                    color: '#000',
                                    font: { weight: 'bold', size: 9 },
                                    formatter: (value) => value > 0 ? value.toLocaleString("id-ID") + " Ton" : ""
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: (val) => val.toLocaleString("id-ID")
                                    }
                                }
                            }
                        },
                        plugins: [ChartDataLabels]
                    });
                }

                renderComparisonChart("compareChart1", "#36a2eb");
                renderComparisonChart("compareChart2", "#ff6384");
            });
        </script>



</body>

</html>