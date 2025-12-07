<!DOCTYPE html>
<html lang="en">
  
<head>
  <title>Halaman Login</title>
  <link rel="icon" href="../img/Absensi.png" type="image/png">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script type="application/x-javascript"> 
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
    function hideURLbar(){ window.scrollTo(0,1); } 
  </script>
  
  <!-- Custom CSS -->
  <link href="../css/style.css" rel="stylesheet" type="text/css" media="all" />
  <link href="//fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,700,700i" rel="stylesheet">
  
  <!-- Include SweetAlert2 CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  
  <!-- Include SweetAlert2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <style>
    /* Kontainer logo */
    .logo-container {
      text-align: center; /* Pusatkan konten di dalam kontainer */
      margin: 20px 0; /* Jarak atas dan bawah logo */
    }

    /* Gaya untuk gambar logo */
    .logo-container img {
      width: 160px; /* Atur lebar logo */
      height: auto; /* Pertahankan proporsi asli */
      max-width: 100%; /* Agar responsif di layar kecil */
      object-fit: contain; /* Jaga proporsi logo */
      transition: transform 0.3s ease; /* Efek animasi saat hover */
    }

    /* Animasi saat logo dihover */
    .logo-container img:hover {
      transform: scale(1.1); /* Membesarkan sedikit saat dihover */
    }
  </style>
</head>

<body>
  <!-- main -->
  <div class="main-w3layouts wrapper">
    
    <!-- Logo -->
    <div class="logo-container">
      <a href="../index.php">
        <img src="../img/walkot.png" alt="Logo">
      </a>
    </div>

    <div class="main-agileinfo">
      <div class="agileits-top">
        <form action="pro_login.php" method="post">
          <input class="text" type="text" name="username" placeholder="Username" required=""><br>
          <input class="text" type="password" name="password" placeholder="Password" required="">
          <div class="wthree-text">
            <div class="clear"> </div>
          </div>
          <input type="submit" value="Login">
        </form>
      </div>
    </div>
    
    <!-- copyright -->
    <div class="colorlibcopy-agile">
      <p>© 2024 Duhanur All rights reserved | Design by <a href="https://colorlib.com/" target="_blank">Colorlib</a></p>
    </div>
    
    <ul class="colorlib-bubbles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
    </ul>
  </div>
  <!-- //main -->

  <script>
    // Menampilkan notifikasi SweetAlert2 berdasarkan sessionStorage
    window.onload = function() {
        const alertType = sessionStorage.getItem("alertType");
        const alertMessage = sessionStorage.getItem("alertMessage");
        const redirect = sessionStorage.getItem("redirect");

        if (alertType && alertMessage) {
            Swal.fire({
                title: alertType === "success" ? "Berhasil!" : "Oops!",
                text: alertMessage,
                icon: alertType,
                confirmButtonText: 'OK'
            }).then(() => {
                // Redirect setelah menutup notifikasi
                window.location = redirect;
            });

            // Hapus item dari sessionStorage
            sessionStorage.removeItem("alertType");
            sessionStorage.removeItem("alertMessage");
            sessionStorage.removeItem("redirect");
        }
    }
  </script>
</body>

</html>
