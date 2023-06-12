<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon-32x32.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
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
        <button type="button" class="btn btn-primary m-1" onclick="window.location.href='{{route('users.create')}}';">add new one</button>
      <div class="col-lg-8 d-flex align-items-stretch">
       
        <div class="card w-100">
          <div class="card-body p-4">
            <h5 class="card-title fw-semibold mb-4">all admins</h5>
            <div class="table-responsive">
              <table class="table text-nowrap mb-0 align-middle">
                <thead class="text-dark fs-4">
                  <tr>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">Id</h6>
                    </th>
                    <th class="border-bottom-0">
                      <h6 class="fw-semibold mb-0">email</h6>
                    </th>
                    <th class="border-bottom-0">
                      
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user )
                    
                
                  <tr>
                    <td class="border-bottom-0"><h6 class="fw-semibold mb-0">1</h6></td>
                    <td class="border-bottom-0">
                        <h6 class="fw-semibold mb-1">{{$user->email}}</h6>
                      <td class="border-bottom-0">
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger m-1">Delete</button>
                      </form>
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
    </div>
  </div>
  @include('dashboard.script')
</body>

</html>
