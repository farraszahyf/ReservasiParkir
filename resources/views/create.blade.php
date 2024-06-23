<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genius Parking</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!--  Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center">

      <h1 class="logo me-auto"><a href="{{route('landing.page')}}">Genius Parking</a></h1>
      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="{{route('landing.page')}}" class="active">Home</a></li>
          <li><a href="{{route('parkir.create')}}" class="getstarted">Reservasi</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<div class="container mt-3">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <h2 class="text-center mb-4">Form Reservasi Parkir</h2>
            @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
        @endif
        
        <form action="{{ route('parkir.store') }}" method="POST">
        @csrf
          <div class="form-group">
            <label for="nama">Nama Pengguna</label>
            <input type="text" class="form-control" id="nama" name ="nama" placeholder="Masukkan Nama Pengguna" required>
          </div>
          <div class="form-group">
    <label for="nim">NIM</label>
    <input type="number" class="form-control @error('nim') is-invalid @enderror" id="nim" name="nim" placeholder="Masukkan NIM" required>
    @error('nim')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
          <script>
              document.getElementById("nim").addEventListener("input", function() {
                if (this.value.length > 8) {
                this.value = this.value.slice(0, 8);
                }
                });
          </script> 
          <div class="form-group">
            <label for="plat">Nomor Plat Kendaraan</label>
            <input type="text" class="form-control" id="plat" name ="plat" placeholder="Masukkan Nomor Plat Kendaraan" required>
          </div>
          <div class="form-group">
            <label for="nama_motor">Nama Motor</label>
            <input type="text" class="form-control" id="nama_motor" name ="nama_motor" placeholder="Masukkan Nama Motor" required>
          </div>
          <button type="submit" class="btn btn-danger btn-block">Reservasi</button>
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap JS -->
 <!-- Vendor JS Files -->
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>

<!-- Main JS File -->
<script src="assets/js/main.js"></script>
</body>
</html>