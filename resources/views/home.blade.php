<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Divertiti | ¡Diversión sin límites!</title>
  <meta name="description" content="Divertiti, un lugar para aprender, jugar y crecer.">
  <meta name="keywords" content="diversión, niños, juegos, talleres, aprendizaje, recreación">

  <!-- Favicons -->
  <link href="{{ asset('assets2/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('assets2/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets2/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets2/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets2/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('assets2/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets2/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>

<body class="index-page" style="font-family: 'Comic Neue', cursive; background-color: #e0f7f9;">

  <header id="header" class="header d-flex align-items-center fixed-top bg-info shadow">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="{{ url('/home') }}" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1 class="sitename text-white">Divertit<i style="color: green;">i</i></h1> <!-- Título Divertiti -->
        <span class="text-warning ms-2">🌈</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="{{ url('/home') }}">Inicio</a></li>

          @if(auth()->check() && (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'empleado'))
            <li class="dropdown">
              <a href="#">Registro</a>
              <ul>
                <li><a href="{{ url('/registro/nuevo-comprobante') }}">Nuevo Comprobante</a></li>
                <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
                <li><a href="{{ route('ninos.index') }}">Niñ@s</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">Servicios</a>
              <ul>
                <li><a href="{{ url('/alquiler/individual') }}">Individual</a></li>
                <li><a href="{{ url('/alquiler/empresarial') }}">Empresarial</a></li>
              </ul>
            </li>
          @endif

          @if(auth()->check() && (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'cajero'))
            <li><a href="#">Comprobantes</a></li>
            <li><a href="#">Clientes</a></li>
          @endif

          @if(auth()->check() && (auth()->user()->rol == 'administrador' || auth()->user()->rol == 'empleado'))
            <li><a href="#">Gestión de niños</a></li>
          @endif

          @if(auth()->check() && auth()->user()->rol == 'administrador')
            <li><a href="{{ route('personal.index') }}">Personal</a></li>
          @endif
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <!-- Logout -->
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
      <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-warning rounded-pill shadow-sm ms-3">Cerrar sesión</a>
    </div>
  </header>

  <main class="main pt-5">
    <!-- Hero Section -->
    <section id="hero" class="hero section py-5" style="background: linear-gradient(to bottom right, #a2eaf2, #f9fcff);">
      <div class="container text-center" data-aos="fade-up">
        <img src="{{ asset('assets2/img/Logo.jpg') }}" alt="Guardería" class="img-fluid rounded shadow mb-4" style="max-height: 300px; object-fit: cover;">
        <h2 class="text-primary">¡Bienvenidos a <span class="text-warning">Divertiti</span>!</h2> <!-- Título ajustado -->
        <p class="lead mt-3 text-muted">El lugar donde la diversión nunca termina. ¡Jugar, aprender y reír todo el día! 🧸✨</p> <!-- Mensaje ajustado -->
      </div>
    </section>

    <!-- Servicios Destacados -->
    <section class="services section py-5">
      <div class="container">
        <div class="row justify-content-center text-center mb-4">
          <div class="col-lg-8">
            <h3 class="text-info">Nuestros Juegos y Actividades</h3> <!-- Título ajustado -->
            <p class="text-muted">¡Cada día es una nueva aventura llena de diversión y aprendizaje!</p> <!-- Mensaje ajustado -->
          </div>
        </div>
        <div class="row g-4 text-center">
          <div class="col-md-3">
            <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
              <i class="bi bi-brush text-primary display-4"></i>
              <h5 class="mt-3">Talleres Creativos</h5>
              <p>Pintura, arte y mucho más para dar rienda suelta a la creatividad.</p> <!-- Mensaje ajustado -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
              <i class="bi bi-book text-success display-4"></i>
              <h5 class="mt-3">Aventuras Educativas</h5>
              <p>Juegos, lecturas y actividades para aprender jugando.</p> <!-- Mensaje ajustado -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
              <i class="bi bi-balloon text-danger display-4"></i>
              <h5 class="mt-3">Fiestas y Cumpleaños</h5>
              <p>¡Fiestas temáticas con todo el color y alegría que merecen!</p> <!-- Mensaje ajustado -->
            </div>
          </div>
          <div class="col-md-3">
            <div class="p-4 border rounded-4 bg-white shadow-sm h-100">
              <i class="bi bi-camera text-warning display-4"></i>
              <h5 class="mt-3">Galería de Recuerdos</h5>
              <p>Capturamos cada momento de diversión en fotos y videos.</p> <!-- Mensaje ajustado -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <!-- Footer -->
  <footer id="footer" class="footer bg-info text-white py-4">
    <div class="container text-center">
      <p>© {{ date('Y') }} Divertiti. Todos los derechos reservados.</p>
      <p class="small">Hecho con 💖 por el equipo de diversión educativa.</p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center bg-info text-white">
    <i class="bi bi-arrow-up-short"></i>
  </a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets2/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('assets2/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('assets2/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets2/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets2/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets2/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('assets2/vendor/purecounter/purecounter_vanilla.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('assets2/js/main.js') }}"></script>
</body>

</html>
