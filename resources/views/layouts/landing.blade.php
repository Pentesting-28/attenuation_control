<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Control de asistencias</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="{{ asset('css/styles_landing.css') }}">

  @livewireStyles

  <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body>
    <nav class="navbar navbar_contact">
        <p>
            <i class="fas fa-phone-alt mx-1"></i>
            Contactos 07 - 4095-644 / 2853-184 / 4102-382 / 099-597-4568
        </p>
    </nav>
    <nav class="navbar navbar_heading">
      <a>
        <img src="{{ asset('images/centrohes.png') }}" class="img-fluid" id="logo"  alt="Hermanos Enderica Salgado">
      </a>
      @if (Route::has('login'))
          <div class="hidden fixed top-0 right-0 px-6 sm:block ">
              <span class="navbar-brand mb-0">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="grow_box grow_box_green btn nav-link">Iniciar sesión</a>
                @endauth
              </span>
          </div>
      @endif
    </nav>

    @yield('content')

    @stack('modals')

    @livewireScripts

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>
