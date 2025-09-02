<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Custom fonts -->
    <link href="{{ asset('../tamplate/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles-->
    <link href="{{ asset('tamplate/css/sb-admin-2.min.css') }}" rel="stylesheet">

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

                    <!-- === CARD 1: analisis produksi shipper === -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="m-0 font-weight-bold text-primary">Analisis Produksi Shipper</h6>

                            <form method="GET" action="{{ route('analisis.shipper') }}"
                                class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <select name="bulan_bar" class="form-control form-control-sm w-auto">
                                    <option value="">Sampai Semua Bulan</option>
                                    @foreach(range(1, 12) as $b)
                                        <option value="{{ $b }}" {{ ($bulanBar ?? '') == $b ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>

                                <select name="tahun_bar" class="form-control form-control-sm w-auto">
                                    @foreach($listTahun as $th)
                                        <option value="{{ $th }}" {{ $th == $tahunBar ? 'selected' : '' }}>{{ $th }}</option>
                                    @endforeach
                                </select>

                                <select name="shipper_id" class="form-control form-control-sm">
                                    <option value="all" {{ $shipperId == 'all' ? 'selected' : '' }}>Semua Shipper</option>
                                    @foreach($listShipper as $shipper)
                                        <option value="{{ $shipper->id }}" {{ $shipperId == $shipper->id ? 'selected' : '' }}>
                                            {{ $shipper->name }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-sm btn-primary" title="Filter">
                                    <i class="fas fa-fw fa-filter"></i>
                                </button>
                            </form>

                        </div>

                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myBarChart" data-values='@json($dataPriode)'
                                    data-bulan="{{ $bulanBar ?? 12 }}" data-tahun="{{ $tahunBar }}"
                                    data-shipper="{{ $shipperId == 'all' ? 'Semua Shipper' : $listShipper->firstWhere('id', $shipperId)->name }}">
                                </canvas>

                            </div>
                        </div>
                    </div>

                    <!-- === CARD 2: Kontribusi shipper dalam priode tertentu === -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="m-0 font-weight-bold text-primary">Analisis Kontribusi Shipper</h6>

                            <form method="GET" action="{{ route('analisis.shipper') }}"
                                class="d-flex align-items-center gap-2 mt-2 mt-md-0">

                                <select name="tahun_pie" class="form-control form-control-sm w-auto">
                                    @foreach($listTahun as $th)
                                        <option value="{{ $th }}" {{ $th == $tahunPie ? 'selected' : '' }}>{{ $th }}</option>
                                    @endforeach
                                </select>

                                <select name="bulan_pie" class="form-control form-control-sm w-auto">
                                    <option value="">Semua Bulan</option>
                                    @foreach(range(1, 12) as $b)
                                        <option value="{{ $b }}" {{ $bulanPie == $b ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit" class="btn btn-sm btn-primary" title="Filter">
                                    <i class="fas fa-fw fa-filter"></i>
                                </button>
                            </form>


                        </div>

                        <div class="card-body">
                            @if($kontribusi->isEmpty())
                                <div class="text-center p-4">
                                    <div class="alert alert-info mb-0" role="alert">
                                        <i class="fas fa-info-circle"></i> Tidak ada data untuk filter ini.
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <!-- Tabel -->
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Shipper</th>
                                                        <th>Total Produksi (Ton)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($kontribusi as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item->shipper->name }}</td>
                                                            <td>{{ number_format($item->total, 0, ',', '.') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Pie Chart -->
                                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                                        <div style="width: 100%; max-width: 400px; height: 400px;">
                                            <canvas id="myPieChart" data-labels='@json($topShippers->pluck("shipper.name"))'
                                                data-values='@json($topShippers->pluck("total"))'>
                                            </canvas>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('../tamplate/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('../tamplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('../tamplate/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('../tamplate/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('../tamplate/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('../tamplate/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('../tamplate/js/demo/datatables-demo.js') }}"></script>


    <!--bootstrap CDN Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // === Bar Chart Shipper ===
            const ctx = document.getElementById('myBarChart');
            if (ctx) {
                const dataValues = JSON.parse(ctx.dataset.values);
                const bulan = parseInt(ctx.dataset.bulan) || 12;
                const tahun = ctx.dataset.tahun;
                const namaShipper = ctx.dataset.shipper;

                const labels = [
                    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                ].slice(0, bulan);

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: `Produksi Shipper (${namaShipper}, ${tahun})`,
                            data: dataValues.slice(0, bulan),
                            backgroundColor: '#4bc0c0',
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
                                color: '#2a2a2aff',
                                font: { weight: 'bold', size: 10 },
                                formatter: (value) => value > 0 ? value.toLocaleString("id-ID") + " Ton" : ""
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { callback: val => val.toLocaleString("id-ID") }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }

            // === Pie Chart Shipper ===
            const ctxPie = document.getElementById("myPieChart");
            if (ctxPie) {
                const labels = JSON.parse(ctxPie.dataset.labels);
                const values = JSON.parse(ctxPie.dataset.values);
                const totalAll = {{ $totalAllShippers ?? 1 }};

                new Chart(ctxPie, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: ['#ff6384', '#36a2eb', '#ffcd56', '#4bc0c0', '#9966ff'],
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '40%',
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: { boxWidth: 20, padding: 15 }
                            },
                            datalabels: {
                                color: '#fff',
                                font: { weight: 'bold', size: 14 },
                                formatter: (value) => {
                                    const percent = (value / totalAll * 100).toFixed(1);
                                    return percent > 0 ? percent + "%" : "";
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: (context) => {
                                        const val = context.parsed;
                                        const percent = (val / totalAll * 100).toFixed(1);
                                        return `${val.toLocaleString("id-ID")} Ton (${percent}%)`;
                                    }
                                }
                            }
                        }
                    },
                    plugins: [ChartDataLabels]
                });
            }
        });
    </script>

</body>

</html>