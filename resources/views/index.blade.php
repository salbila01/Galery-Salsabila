<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Galery Caca</title>

  <!-- Google Font: Source Sans Pro -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset ('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- AdminLTE css -->
  <link rel="stylesheet" href="{{asset ('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/" class="nav-link">Selamat Datang {{ Session::get('name') }}</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="/logout" role="button">
          <i class="fas fa-th-large"></i>Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Galery Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#baru">Galery Baru</button>
              
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            <div class="timeline">
              
                
              
              <!-- timeline time label -->
              @foreach ($galeries as $item )
              <div class="time-label">
                <span class="bg-red">{{ date('d-M-Y', strtotime($item->created_at)) }}</span>
              </div>
              
              <div>
                <i class="fa fa-camera bg-purple"></i>
                <div class="timeline-item">
                  <span class="time"><i class="fas fa-clock"></i> {{ date('d-M-Y', strtotime($item->created_at)) }}</span>
                  <h3 class="timeline-header"><a href="#">{{ $item->judul }}</a> {{ $item->deskripsi }}</h3>
                  <div class="timeline-body">
                    <img src="{{ Storage::url($item->photo) }}" alt="..." height="300" width="300">
                  </div>
                  <div class="row mb-3">
                <form action="{{ route('galery.destroy', $item->id) }}" method="post">
                @csrf
                @method('DELETE')
                                <a href="#" class="btn btn-warning mr-4 edit" data-toggle="modal" data-target="#edit{{ $item->id }}"><span class="fas fa-pen"></span>Edit</a>

                <button id="delete" class="btn btn-danger" onclick="return confirm('apakah mau hps?')"><span class="fas fa-trash can"></span>Delete</button>
                <a href="{{ Storage::url($item->photo) }}" download="photo" class="btn btn-success mr-3" onclick="return confirm('apakah mau download?')"><span class="fas fa-download"></span>Download</a>
                <a href="{{ Storage::url($item->photo) }}" class="btn btn-primary mr-4"><span class="fas fa-book">Lihat</a>
              </div>
            </form>
              <div class="modal fade" id="edit{{ $item->id }}">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">
                          Galery Edit
                      </h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form action="{{ route('galery.update',$item->id) }}" method="post" enctype="multipart/form-data" id="form post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" id="id">
                    <div class="modal-body">
                      <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul foto" value="{{ $item->judul }}">
                        <span class="text-danger">
                          @error('judul')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi" value="{{ $item->deskripsi }}">
                        <span class="text-danger">
                          @error('deskripsi')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                      <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" name="photo" id="photo" class="form-control" placeholder="Isikan Photo" value="">
                        <img src="{{ Storage::url($item->photo) }}" alt="..." height="300" width="300" >
                        <span class="text-danger">
                          @error('photo')
                            {{ $message }}
                          @enderror
                        </span>
                      </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
              @endforeach
        </div>
      </div>
    </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
    <div class="modal fade" id="baru">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">
                Galery Baru
            </h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="{{ route('galery.store') }}" method="post" enctype="multipart/form-data" id="form post">
          @csrf
          <input type="hidden" name="id" id="id">
          <div class="modal-body">
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" name="judul" id="judul" class="form-control" placeholder="Isikan Judul foto" value="">
              <span class="text-danger">
                @error('judul')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Isikan Deskripsi" value="">
              <span class="text-danger">
                @error('deskripsi')
                  {{ $message }}
                @enderror
              </span>
            </div>
            <div class="form-group">
              <label for="photo">Photo</label>
              <input type="file" name="photo" id="photo" class="form-control" placeholder="Isikan Photo" value="">
              <span class="text-danger">
                @error('photo')
                  {{ $message }}
                @enderror
              </span>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
          </form>
        </div>
      </div>
    </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset ('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset ('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset ('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
</body>
</html>
