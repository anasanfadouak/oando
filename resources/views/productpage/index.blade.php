<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>olbert&olbert</title>
    <!-- Stylesheet -->
    <!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/css/bootstrap.min.css" rel="stylesheet">

    <link  href=" {{ asset('front-end/productpage/css/stylepp.css') }}" rel="stylesheet">
    <!---Boxicons CDN Setup for icons
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>-->
</head>
<body >

    <div class="container">
        <div class="single-product">
            <div class="row">
                <div class="col-6">
                    <div class="product-image">
                        <div class="product-image-main">
                            
                            <img src="{{ asset('images/' . $product->images[0]->file) }}"  alt="" id="product_main_image">
                        </div>
                    
                        <div class="product-image-slider">
                            @foreach ($product->images as $image)
                            
                    <img src="{{ asset('images/' . $image->file) }}" alt="" class="image-list">
            
                @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="breadcrumb">
                        <span><a href="{{route('homepage')}}">Home</a></span>
                    </div>
                  
                    <div class="product">
                        <div class="product-title">
                            <h2>{{$product->name}}</h2>
                        </div>
                        <div class="product-price">
                            <span class="offer-price">${{$product->price}}</span>
                        </div>

                        <div class="product-details">
                            <h3>Description</h3>
                            <p>{{$product->description}}</p>
                        </div>
                        
                        <span class="divider"></span>

                        <div class="product-btn-group">
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" id="add-to-cart-form">
                                @csrf
                                <button type="submit"  class="button add-cart" >Add to Cart</button>
                            </form>
                            <div class="button heart"><i class='bx bxs-heart' ></i><a href="{{route('cart.show')}}" target="_blank" >view the cart</a></div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
       
    </div>
   

    <!--script-->
    <script src="{{ asset('front-end/productpage/scriptpp.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script>
        document.getElementById("add-to-cart-form").addEventListener("submit", function(event){
            event.preventDefault();
        
            
            alert("The product has been added to the cart.");
        
          
            this.submit();
        });
        </script>
</body>
</html>