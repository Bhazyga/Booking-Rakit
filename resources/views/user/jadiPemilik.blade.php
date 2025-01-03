<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Booking Rakit - Daftar Menjadi Pemilik</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="{{URL::asset('images/icon.png')}}" type="image/png">
</head>

<body style="background-color: #efefef;">

  @include('comp.userNav')
  @include('comp.sidbar')
  @if (Auth::user()->gender == '' )
  <script>
    window.location = "/dashboard";
  </script>

  @endif

  {{-- if theres data count > 1 sweat alert--}}
  @if (count($data) > 1)

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Anda Sudah menjadi pemiik',
    })
  </script>
  @endif

  {{-- if success a sweat alert --}}

  @if (session('success'))
  {{-- cdn sweet alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // image in the sweet alert
    Swal.fire({
      icon: 'success',
      title: 'Kerja Bagus!',
      text: 'Tunggu Konfirmasi Admin',
    })
  </script>
  @endif
  {{-- if success a sweat alert --}}

  {{-- if success a sweat alert --}}

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

          {{-- <h1>Welcome to Your Coaching Dashboard</h1>

                <p>From here, you can manage your coaching schedule, review your progress, and book new coaching sessions or online courses. Use the menu on the left to access different parts of your dashboard, or click on the quick links to jump to specific actions. We hope you find our platform helpful in achieving your sports goals, and we look forward to seeing your progress!</p> --}}
        </div>

      </div>
      <!-- /#page-content-wrapper -->
      <div class="row mb-4">

        <div class="mt-2">

        </div>
        {{-- h1 in green top coaches --}}
        {{-- --}}
        @if (count($data) > 0)
        <div class="col-md-12">
          <h1 class="text-success">Aplikasi pemilik rakit</h1>
          <p class="text-dark">Anda telah mendaftar menjadi pemilik. Tunggu konfirmasi admin.</p>
        </div>
        <div class="imageGif">
          <img
            src="https://64.media.tumblr.com/20bc582f7f3d22b8b3c65408bdffa7bb/fb0eba7a92a04691-54/s540x810/93301ec2be5458211b6a8f1432fe2204a91fb9c1.gif"
            alt="" class="img-fluid ">
        </div>

        @else

        <div class="">
          <div class="firstSection" id="home">
            <div class="container ">
              <div class="row align-items-center">
                <div class="col-md-6">
                  <img src="../images/PemilikRakit2.png" alt="" class="img-fluid ">
                </div>
                <div class="col-md-6 ">
                  <h2 class="text-success ">Ingin Menjadi Pemilik ? </h2>
                  <p class="text-dark">Menjadi pemilik dan menyewakan rakit melalui aplikasi yang kami sediakan</p>
                  <button data-bs-toggle="modal" data-bs-target="#exampleModal"
                    class="btn btn-success w-75  mt-3 shadow rounded-3">Segera daftarkan !</button>

                </div>
              </div>
            </div>
            <div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>

  </div>
  {{-- top top courses --}}
  @endif
  <!-- /#wrapper -->
  @include('comp.jq')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>

  {{-- modal --}}

  <!-- Button trigger modal -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    style="z-index: 999999999">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-clipboard-fill"></i> Daftar menjadi pemilik !
          </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{route('jadiPemilik')}}" method="post">
            @csrf
            <label for="sport">
              <h5 class="text-success">Jenis :</h5>
              <input type="text" name="jenis" class="form-control" id="sport" placeholder="Jenis Rakit">
            </label>
            {{-- years of experience --}}
            <label for="experience">
              <h5 class="text-success">Pengalaman :</h5>
              <input type="number" class="form-control" name="yearsofexperience" id="experience"
                placeholder="Berapa Tahun Pengalaman?">
            </label>
            {{-- localitaion --}}
            <label for="location">
              <h5 class="text-success">Lokasi :</h5>
              <select class="form-select" aria-label="Default select example" name="location">
                <option selected>Pilih Lokasi</option>
                {{-- morocco citys as options value is the name of city --}}
                <option value="Jakarta">Jakarta</option>
                <option value="Bekasi">Bekasi</option>
              </select>
            </label>
            {{-- price par hour --}}
            <label for="price">
              <h5 class="text-success">Harga Per Jam :</h5>
              <input type="number" class="form-control" id="price" name="price" placeholder="Rupiah">
            </label>
            <label for="motivation">
              <h5 class="text-success">Deskripsi :</h5>
              <textarea class="form-control" name="description"
                placeholder="Tulis Disini"
                id="exampleFormControlTextarea1" rows="8" cols="50"></textarea>
            </label>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-success">Apply</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>

</html>
