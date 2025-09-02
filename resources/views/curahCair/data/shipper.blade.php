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
    <link href="{{ asset('../tamplate/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('../tamplate/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('../tamplate/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">


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

                    <!-- Alert Message -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Card Data Shipper -->
                    <div id="shipper-table" class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="m-0 font-weight-bold text-primary">TABEL SHIPPER TERDAFTAR</h6>
                            <a href="{{ route('shippername.create') }}" class="btn btn-sm btn-success">+ Tambah
                                Data</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Shipper</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($shippers as $index => $shipper)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $shipper->name }}</td>
                                                <td class="text-center">
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('shippername.edit', $shipper->id) }}"
                                                            class="btn btn-warning btn-sm" title="Edit"><i
                                                                class="fas fa-fw fa-edit"></i></a>
                                                        <form action="{{ route('shippername.destroy', $shipper->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                title="Hapus"> <i class="fas fa-fw fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Shipper Produksi Table-->
                    <div id="shipper-table" class="card shadow mb-4">
                        <div class="card-header py-2 d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center gap-2">
                                <h6 class="m-0 font-weight-bold text-primary">TABEL PRODUKSI</h6>
                                <a href="{{ route('shipper.create') }}" class="btn btn-sm btn-success">+ Tambah Data</a>
                            </div>

                            <form method="GET" action="{{ route('Data_CC') }}#shipper-table"
                                class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                                <input type="hidden" name="type" value="shipper">

                                <select name="bulan" class="form-control form-control-sm">
                                    <option value="">Semua Bulan</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('bulan') == $i && request('type') == 'shipper' ? 'selected' : '' }}>
                                            Bulan {{ $i }}
                                        </option>
                                    @endfor
                                </select>

                                <select name="tahun" class="form-control form-control-sm">
                                    <option value="">Semua Tahun</option>
                                    @for ($i = 2024; $i <= now()->year; $i++)
                                        <option value="{{ $i }}" {{ request('tahun') == $i && request('type') == 'shipper' ? 'selected' : '' }}>
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>

                                <button type="submit" class="btn btn-sm btn-primary" title="Filter"><i
                                        class="fas fa-fw fa-filter"></i></button>
                            </form>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTableShipper" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Shipper</th>
                                            <th>Bulan</th>
                                            <th>Tahun</th>
                                            <th>Produksi (Ton)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($produksi as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $item->shipper->name ?? '-' }}</td>
                                                <td>{{ $item->bulan }}</td>
                                                <td>{{ $item->tahun }}</td>
                                                <td>{{ number_format($item->produksi, 3, ',', '.') }}</td>
                                                <td>
                                                    <a href="{{ route('shipper.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning" title="Edit"><i
                                                            class="fas fa-fw fa-edit"></i></a>
                                                    <form action="{{ route('shipper.destroy', $item->id) }}" method="POST"
                                                        class="d-inline"
                                                        onsubmit="return confirm('Yakin ingin menghapus?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-danger" title="Hapus"><i
                                                                class="fas fa-fw fa-trash"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
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
    <script src="{{ asset('../tamplate/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('../tamplate/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('../tamplate/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('../tamplate/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('../tamplate/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('../tamplate/js/demo/datatables-demo.js') }}"></script>

    <!--bootstrap CDN Link-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            $('#dataTableShipper').DataTable(); // buat table shipper
            $('#dataTableCommodity').DataTable(); // buat table commodity
            $('#tableShipperName').DataTable();
            $('#tableCommodityName').DataTable();
        });
    </script>

</body>

<script>
    // Auto-hide alert after 10 seconds (10000 ms)
    setTimeout(() => {
        const alert = document.querySelector('.alert');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500); // Remove element after fade-out
        }
    }, 10000);
</script>