<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="{{ asset('assets_home/layout/styles/layout.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('assets_home/layout/styles/vets.css') }}" rel="stylesheet" type="text/css">
    <link rel="icon" href="img/LogoPatitasFelices.png" type="image/x-icon">
</head>

<body id="top" class="hold-transition layout-top-nav">
    <div class="bgded overlay"
        style="background-image:url('{{ asset('assets_home/images/backgrounds/background_vet.jpg') }}');">
        <div class="wrapper row0">
            <div id="topbar" class="hoc clear">
                <div class="fl_left">
                    <ul class="nospace">
                        <li><a href="https://wa.me/5215623640302" target="_blank">56 2364 0302</a></li>
                        <li><a href="mailto:info@rootheim.com">info@rootheim.com</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="wrapper row1">
            <header id="header" class="hoc clear">
                <nav class="main-header navbar navbar-expand-lg navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
                            <span class="navbar-toggler-icon">&#9776;</span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarCollapse">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="home" class="nav-link home-link">Inicio</a>
                                </li>
                                <li class="nav-item active">
                                    <a href="vetsView" class="nav-link">Veterinarias</a>
                                </li>
                                <li class="nav-item">
                                    <a href="/login" class="nav-link">Ingresar</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
        </div>

            <div id="pageintro" class="hoc clear">
                <article class="center">
                    <h3 class="heading underline">Catálogo de Veterinarias</h3>
                    <p>Conoce las veterinarias que confían en "Patitas Felices" para la gestión y cuidado de sus mascotas.
                    </p>
                </article>
            </div>
        </div>
    </div>

    <div class="wrapper row3">
        <main class="hoc container clear">
            <section id="vets" class="group">
                <div class="content">
                    @foreach ($vets as $vet)
                        <div class="vet-card">
                            @if ($vet->getMedia('logos')->isNotEmpty())
                                @php
                                    $logo = $vet->getFirstMedia('logos');
                                @endphp
                                <img src="{{ $logo->getUrl() }}" alt="{{ $vet->name }}">
                            @else
                                <img src="{{ asset('img/vetdefault.png') }}" alt="Default logo">
                            @endif
                            <h4>{{ $vet->name }}</h4>
                            <p>Teléfono: {{ $vet->phone }}</p>
                            @if ($vet->facebook)
                                <p><a href="{{ $vet->facebook }}" target="_blank">Facebook</a></p>
                            @endif
                            @if ($vet->tiktok)
                                <p><a href="{{ $vet->tiktok }}" target="_blank">TikTok</a></p>
                            @endif
                        </div>
                    @endforeach
                </div>
            </section>
            <div class="clear"></div>
        </main>
    </div>

    <div class="wrapper row4">
        <footer id="footer" class="hoc clear">
            <div class="center btmspace-50">
                <h6 class="heading">Patitas Felices</h6>
                <nav>
                    <ul class="nospace inline pushright uppercase">
                        <li><a href="home">Inicio</a></li>
                        <li><a href="vetsView">Veterinarias</a></li>
                        <li><a href="/login">Ingresar</a></li>
                    </ul>
                </nav>
            </div>
            <hr class="btmspace-50">
            <div>
                <h6 class="heading">Contacto</h6>
                <ul class="nospace btmspace-30 linklist contact">
                    <li><a href="https://wa.me/5215623640302" target="_blank">56 2364 0302</a></li>
                    <li><a href="mailto:info@rootheim.com">info@rootheim.com</a></li>
                </ul>
            </div>
        </footer>
    </div>

    <div class="wrapper row5">
        <div id="copyright" class="hoc clear">
            <p class="fl_left">Copyright &copy; 2024 - Todos los derechos reservados - <a href="#">Patitas
                    Felices</a></p>
        </div>
    </div>

    <script>
        function toggleNavbar() {
            var navbarCollapse = document.getElementById('navbarCollapse');
            if (navbarCollapse.classList.contains('show')) {
                navbarCollapse.classList.remove('show');
            } else {
                navbarCollapse.classList.add('show');
            }
        }
    </script>

</body>

</html>
