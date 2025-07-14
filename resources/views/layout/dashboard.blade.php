<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>DASHBOARD</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"> 
  <link href="{{ asset('style2.css') }}" rel="stylesheet">
</head>
<body>

    <!--navbar fixed-->
    <nav class="navbar navbar-expand-md bg-body-tertiary rounded-3">
        <div class="container">
            <div class="navbar-brand">
            <img src="{{ asset('tamplate/img/pelindo_logo.png') }}" alt="NACHA Logo" style="height: 40px; "> 
        </div>
   
    <!-- Toggler hanya muncul di layar kecil -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu kanan (collapse di HP) -->
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="Dasboard.php">Profil</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
      </ul>
    </div>

  </div>
</nav>

<!-- Section -->
<section>
  <div>
    <section class="py-5">
      <div class="d-flex justify-content-center">
        <dotlottie-wc src="https://lottie.host/540280e8-41e9-4f56-935b-747c4f363d43/0JICxzr57r.lottie" style="width: 300px;height: 300px" speed="1" autoplay loop></dotlottie-wc>
      </div>
    </section>

    <!-- Kontainer utama -->
    <div class="container text-center">
      <h2 class="mb-4">@ SPMT Produksi</h2>
      <p class="mb-5">Pilih jenis layanan untuk mengakses data produksi dan analisis terminal secara menyeluruh</p>

      <!-- Tombol menu dalam kontainer -->
      <div class="row text-center">
        <div class="col-md-6 mb-2">
          <a href="{{ route('curah.cair') }}" class="btn btn-warning btn-lg w-100 py-3 text-wrap">Curah Cair</a>
        </div>
        <div class="col-md-6 mb-2">
          <a href="{{ route('curah.kering') }}" class="btn btn-warning btn-lg w-100 py-3 text-wrap">Curah Kering</a>
        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-6 mb-2">
          <a href="{{ route('peti.Kemas') }}" class="btn btn-warning btn-lg w-100 py-3 text-wrap">Peti Kemas</a>
        </div>
        <div class="col-md-6 mb-2">
          <a href="{{ route('general.Cargo') }}" class="btn btn-warning btn-lg w-100 py-3 text-wrap">General Cargo</a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/@lottiefiles/dotlottie-wc@0.6.2/dist/dotlottie-wc.js" type="module"></script>

</body>
</html>
