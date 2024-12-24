<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Booking Rakit - Admin</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="{{URL::asset('images/2304226.png')}}" type="image/png">
</head>

<body style="background-color: #efefef;">
  {{-- if session success --}}
  @if (session('success'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    Swal.fire({
      icon: 'success',
      title: 'Good job!',
      text: 'you have accepted the pemilik',
    })
  </script>
  @endif
  @if (session('delete'))
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    Swal.fire({
      icon: 'success',
      title: 'Good job!',
      text: 'you have deleted the pemilik',
    })
  </script>

  @endif
  @include('comp.adminnav')
  @include('comp.adminSide')
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
   </div>

      </div>
      <!-- /#page-content-wrapper -->
      <div class="row mb-4">
        <div class="mt-2">
          <div class="input-group">
            <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
              aria-describedby="search-addon" />
            <button type="button" class="btn btn-outline-success">search</button>
          </div>

        </div>
        {{-- h1
        {{-- h1 in green top pemilikes --}}
        {{-- --}}
        <div class="mt-4">
          <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
              <tr>
                <th>Name</th>
                <th>Pemilik</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              <tr>
                <td>{{$item->name}}</td>
                <td>{{$item->author}}</td>
                <td>
                  {{-- <button class="btn btn-sm btn-outline-success"><i class="bi bi-eye-fill"></i> Read</button> --}}
                  <!-- Button trigger modal -->
                  <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}"
                    class="btn btn-sm btn-outline-success">
                    <i class="bi bi-eye-fill"></i> Read
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 999999999">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-clipboard-fill"></i>
                            Description</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          @csrf
                          <label for="sport">

                            <h5 class="text-success">Description :</h5>
                            <p class="text-muted">{{$item->description}} </p>
                            <h5 class="text-success">link :</h5>
                            <p class="text-muted">{{$item->link}} </p>

                          </label>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
                <td>
                  <a href="{{route('deleteCourse',$item->id)}}" class="btn btn-danger btn-sm"><i
                      class="bi bi-trash3-fill"></i> Delete</a>
                </td>
              </tr>

              @endforeach

            </tbody>

          </table>



        </div>
      </div>
    </div>

  </div>

  </div>
  {{-- top top courses --}}

  <!-- /#wrapper -->
  @include('comp.jq')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>

</body>

</html>

