
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>olbert&olbert</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="pictures/favicon.ico" />
        <!-- Bootstrap Icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
        <!-- SimpleLightbox plugin CSS-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="front-end/css/styles.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        @include('front-end.header')
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 h-100">
                <div class="row gx-4 gx-lg-5 h-100 align-items-center justify-content-center text-center">
                    <div class="col-lg-8 align-self-end">
                        <h1 class="text-white font-weight-bold ">o&o</h1>
                        <hr class="divider" />
                    </div>
                    <div class="col-lg-8 align-self-baseline">
                        <p class=" mb-5 p1">Reveal your blooming beauty with our oils: o&o</p>
                    </div>
                </div>
            </div>
        </header>
        <!-- Our Products-->
        <section class="page-section bg-primary" id="Our Products">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">Our Products</h2>
        <hr class="divider" />
        <div class="row text-center mt-5">
            <div class="col-md-3">
                <a href="{{ route('singlepage', ['name' => 'penis']) }}" class="text-white mt-0 ap ap:hover" name="h2premiere" target="_blank">Penis</a>
            </div>
            <div class="col-md-3">
                <a  href="{{ route('singlepage', ['name' => 'booty']) }}" class="text-white mt-0 ap ap:hover" name="h2premiere" target="_blank">Booty</a>
            </div>
            <div class="col-md-3">
            <a href="{{ route('singlepage', ['name' => 'breats']) }}" class="text-white mt-0 ap ap:hover" name="h2premiere" target="_blank">Breast</a>
            </div>
            <div class="col-md-3">
            <a href="{{ route('singlepage', ['name' => 'lubricant']) }}" class="text-white mt-0 ap ap:hover" name="h2premiere" target="_blank">Lubricant</a>
            </div>
        </div>
    </div>
</section>
        <!-- Video-->
<section class="page-section" id="Admission">
    <div class="container px-4 px-lg-5">
        <h2 class="text-center mt-0">Video</h2>
        <hr class="divider" />
        <div class="row">
            <div class="col-md-4">
                <div style="margin-bottom: 20px;">
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/lk3FjO7_7Mc?autoplay=1&mute=1&loop=1&playlist=lk3FjO7_7Mc" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div style="margin-bottom: 20px;">
                    <iframe width="100%" height="500" src="https://www.youtube.com/embed/076T8S4N2HU?autoplay=1&mute=1&loop=1&playlist=076T8S4N2HU" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div style="margin-bottom: 20px;">
                <iframe width="100%" height="500" src="https://www.youtube.com/embed/vkjUOuYkTnE?autoplay=1&mute=1&loop=1&playlist=vkjUOuYkTnE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</section>
        <!-- Footer-->
        @include('front-end.footer')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- SimpleLightbox plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
