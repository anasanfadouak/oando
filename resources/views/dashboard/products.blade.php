<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon-32x32.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        @include('dashboard.nav')
       
        
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      @include('dashboard.header')
      <!--  Header End -->
      <div class="container-fluid">
        <button type="button" class="btn btn-primary m-1" onclick="window.location.href='{{route('products.create')}}';">add new one</button>
        <div class="card">
          <div class="card-body">
            <div class="row">
                @foreach($products as $product)
                <div class="col-md-4">
                  <div class="card mb-4">
                     <div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach ($product->images as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                <img src="{{ asset('images/' . $image->file) }}" class="d-block w-100" alt="Product Image">
            </div>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

                      <div class="card-body">
                          <h5 class="card-title">{{ $product->name }}</h5>
                          <p class="card-text">{{ $product->description }}</p>
                          <p class="card-text"><strong>${{ $product->price }}</strong></p>
                        
                         
                      
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary m-1">Edit</a>

                          <form action="{{ route('products.destroy', $product) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1">Delete</button>
                        </form>
                        
                      </div>
                  </div>
                </div>
            @endforeach
          </div>
        </div> 
      </div>
  </div>
               
                
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('dashboard.script')
  <script>
    $(document).ready(function() {
        $('#carouselExample').carousel();
    });
</script>
</body>

</html>