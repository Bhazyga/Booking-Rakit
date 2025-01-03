<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Booking Rakit - Dashboard</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="{{URL::asset('images/icon.png')}}" type="image/png">
</head>

<body style="background-color: #efefef;">

  @if (Auth::user()->gender == '' )
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    Swal.fire(
      // redirect it to the profile page
      'Hmm...!',
      'Tolong Lengkapi Data Diri Anda!',
      'warning'
    ).then(function() {
      window.location = "/profile";
    });
  </script>

  @endif


  @include('comp.userNav')
  @include('comp.sidbar')

  @if(session('status'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


  @endif

  <div id="page-content-wrapper">
    <div class="container mt-5  ">
      <div class="row">
        <div class="col-lg-12">
          <a href="#menu-toggle" class=" text-success " id="menu-toggle"><svg class="mt-2 mb-2"
              xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-toggles"
              viewBox="0 0 16 16">
              <path
                d="M4.5 9a3.5 3.5 0 1 0 0 7h7a3.5 3.5 0 1 0 0-7h-7zm7 6a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm-7-14a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zm2.45 0A3.49 3.49 0 0 1 8 3.5 3.49 3.49 0 0 1 6.95 6h4.55a2.5 2.5 0 0 0 0-5H6.95zM4.5 0h7a3.5 3.5 0 1 1 0 7h-7a3.5 3.5 0 1 1 0-7z" />
            </svg></i></a>

          <h1>Selamat Datang Di Booking Rakit</h1>

          <p>Bagi user yang baru mendaftar anda bisa booking rakit atau cek event lomba kami...</p>

        </div>

      </div>
      <!-- /#page-content-wrapper -->
      <div class="row mb-4">
        {{-- h1 in green top coaches --}}
        <div class="col-12">
          <h1 class="text-dark">Pemilik Rakit <i class="bi bi-chat-square-heart"></i></i></h1>
          <div class="mt-4">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              @foreach ($pemiliks as $item)
              <div class="col">
                <div class="card h-100">
                  <img src="images/{{$item->image}}" class="card-img-top" alt="Skyscrapers" />
                  <div class="card-body">
                    <h5 class="card-title">{{$item->name}}</h5>
                    <p class="card-text">
                      {{$item->description}}}
                    </p>
                  </div>
                  <div class="card-footer d-flex">

                    <small class="text-muted">{{$item->price}} Rupiah</small>
                    <a href="/dashboard/pemilik/{{$item->id}}" class="btn btn-success btn-sm ms-auto"><i
                        class="bi bi-calendar2-check"></i> Booking Sekarang</a>

                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>

          {{-- --}}

          {{-- --}}

        </div>
      </div>

    </div>
    <div class="row">
      {{-- h1 in green top coaches --}}
      {{-- if theres no lomba --}}
      @if (count($lombas) == 0)

      @else

      <div class="col-12">
        <h1 class="text-dark">Event Terbaru <i class="bi bi-chat-square-heart"></i></h1>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @foreach ($lombas as $item)
          <div class="col">
            <div class="card">
              <img src="images/{{$item->image}}" class="card-img-top" alt="Hollywood Sign on The Hill" />
              <div class="card-body">
                <h5 class="card-title">{{$item->name}}</h5>
                <p class="card-text">
                  {{$item->description}}
                </p>
              </div>
              <div class="card-footer d-flex">

                <small class="text-muted"><i class="bi bi-pencil-square "></i> {{$item->author}} </small>
                <a href="{{route('viewLomba',$item->id)}}" class="btn btn-success btn-sm ms-auto"><i
                    class="bi bi-play-circle"></i>Lihat Lomba</a>

              </div>
            </div>
          </div>
          @endforeach
          @endif

        </div>
        {{-- top top lombas --}}

        <!-- /#wrapper -->
        @include('comp.jq')

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>

</body>

</html>
