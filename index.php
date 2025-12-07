<?php
session_start();
include ("koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Absent - Home</title>
	<link rel="icon" href="img/Absensi.png" type="image/png">

  <link rel="stylesheet" href="vendors/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="vendors/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="vendors/linericon/style.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.theme.default.min.css">
  <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <!--================Header Menu Area =================-->
  <header class="header_area">
    <div class="main_menu">
      <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container box_1620">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.html"><img src="img/" alt=""></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
            <ul class="nav navbar-nav menu_nav justify-content-end">
              <li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
              <li class="nav-item"><a class="nav-link" href="#visi-misi" rel="page-scroll">Profil</a></li>
              <li class="nav-item"><a class="nav-link" href="karyawan/login_karyawan.php" rel="page-scroll">Login</a></li>
            </ul>

            
          </div> 
        </div>
      </nav>
    </div>
  </header>
  <!--================Header Menu Area =================-->


  <main class="side-main">
    <!--================ Hero sm Banner start =================-->      
    <section class="hero-banner mb-30px">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <div class="hero-banner__img">
              <img class="img-fluid" src="img/walkot.png" alt="">
            </div>
          </div>
          <div class="col-lg-5 pt-5">
            <div class="hero-banner__content">
              <h1>Absent 1.0</h1>
              <p>Website ini berfungsi sebagai Aplikasi absensi karyawan dan sistem informasi karyawan Suku Dinas Pendidikan Wilayah 1 Kota Administrasi Jakarta Timur.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--================ Hero sm Banner end =================-->

<!--================ Visi dan Misi section start =================-->      
<section class="section-margin">
  <div class="container">
    <div class="section-intro pb-85px text-center" id="visi-misi">
      <h1 class="section-intro__title">Visi dan Misi</h1>
      <p class="section-intro__subtitle">Tujuan dan komitmen KamI</p>
    </div>

    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0 visi-misi-card">
            <h3 class="card-feature__title">Visi</h3>
            <p class="card-feature__subtitle">
              Mewujudkan Pendidikan yang Tuntas dan Berkualitas Untuk Semua.
            </p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card card-feature text-center text-lg-left mb-4 mb-lg-0 visi-misi-card">
            <h3 class="card-feature__title">Misi</h3>
            <p class="card-feature__subtitle">
            1.	Mewujudkan akses yang merata dan berkeadilan<br>
            2.	Mewujudkan pembelajaran yang bermutu<br>
            3.	Mewujudkan efektivitas birokrasi dalam pelayanan pendidikan<br>
            4.	Meningkatkan kualitas dan kuantitas sarana dan prasarana pendidikan
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================ Visi dan Misi section end =================-->


  <!-- ================ start footer Area ================= -->
  <footer class="footer-area section-gap" style="padding: 5px 0px 5px;">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-md-8 mb-4 mb-xl-0 single-footer-widget">
                <div class="info"></div>
            </div>
        </div>
        <div class="footer row align-items-center text-center text-lg-left">
            <p class="footer-text m-0 col-lg-8 col-md-12" style="font-size: 16px;">
                Copyright &copy;<script>document.write(new Date().getFullYear());</script> 
                Duhanur All rights reserved | made with <i class="fa fa-heart" aria-hidden="true"></i> 
                by <a href="https://colorlib.com" target="_blank">Colorlib</a>
            </p>
            <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                <a href="https://www.instagram.com/den_p_1003/" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://wa.me/6281383913978" target="_blank">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="mailto:duhanp17@gmail.com" target="_blank">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>
    </div>
</footer>

  <!-- ================ End footer Area ================= -->

  <script src="vendors/jquery/jquery-3.2.1.min.js"></script>
  <script src="vendors/bootstrap/bootstrap.bundle.min.js"></script>
  <script src="vendors/owl-carousel/owl.carousel.min.js"></script>
  <script src="js/jquery.ajaxchimp.min.js"></script>
  <script src="js/mail-script.js"></script>
  <script src="js/main.js"></script>
</body>
</html>