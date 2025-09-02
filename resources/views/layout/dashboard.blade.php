<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DASHBOARD</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* Background gambar full page */
    body {
      margin: 0;
      padding: 0;
      background: url('{{ asset('tamplate/img/pelindo_batik.png') }}') center/cover no-repeat fixed;
      color: white;
      min-height: 100vh;
    }

    /* Navbar transparan */
    .navbar {
      background-color: rgba(255, 255, 255, 0.1) !important;
      backdrop-filter: blur(10px);
    }

    .navbar .nav-link {
      color: white !important;
      font-weight: 500;
    }

    /* Card besar transparan */
    .dashboard-card {
      background-color: rgba(0, 0, 0, 0.4);
      /* transparan tanpa blur */
      border-radius: 20px;
      padding: 40px;
      color: white;
      max-width: 900px;
      margin: auto;
    }

    /* Logo tengah sudut tumpul */
    .logo-center img {
      height: 100px;
      margin-bottom: 20px;
      border-radius: 15px;
    }

    /* Tombol menu */
    .menu-btn {
      background-color: rgba(255, 255, 255, 0.15);
      border: 2px solid white;
      color: white;
      padding: 15px;
      font-size: 1.1rem;
      border-radius: 15px;
      text-align: center;
      transition: 0.3s;
      display: block;
      text-decoration: none;
    }

    .menu-btn:hover {
      background-color: white;
      color: #004d99;
      transform: scale(1.05);
      text-decoration: none;
    }
  </style>

</head>

<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-md fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('tamplate/img/pelindo_logo.png') }}" alt="Pelindo Logo" style="height: 40px;">
      </a>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Konten utama dalam card -->
  <div class="container" style="margin-top: 120px;">
    <div class="dashboard-card text-center shadow-lg">
      <div class="logo-center">
        <img src="{{ asset('tamplate/img/pelindo_logo.jpg') }}" alt="Pelindo Logo">
      </div>
      <h2 class="fw-bold">@SPMT Produksi</h2>
      <p class="mb-5">Pilih jenis layanan untuk mengakses data produksi dan analisis terminal secara menyeluruh</p>

      <!-- Tombol menu sejajar -->
      <div class="row g-3 justify-content-center">
        <div class="col-md-3 col-6">
          <a href="{{ route('curah.cair') }}" class="menu-btn">Curah Cair</a>
        </div>
        <div class="col-md-3 col-6">
          <a href="{{ route('curah.kering') }}" class="menu-btn">Curah Kering</a>
        </div>
        <div class="col-md-3 col-6">
          <a href="{{ route('peti.Kemas') }}" class="menu-btn">Peti Kemas</a>
        </div>
        <div class="col-md-3 col-6">
          <a href="{{ route('general.Cargo') }}" class="menu-btn">General Cargo</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>