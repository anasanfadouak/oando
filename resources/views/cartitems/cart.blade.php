<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap Icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- SimpleLightbox plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('front-end/css/styles.css')}}" rel="stylesheet" />
    <link href="{{asset('front-end/cartitems/css/styles.css')}}" rel="stylesheet" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart items</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="pictures/favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head >
<body>
    @include('front-end.header')
<section class="h-100 gradient-custom">
    <div class="container py-5">
      <div class="row d-flex justify-content-center my-4">
        <div class="col-md-8">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Cart </h5>
            </div>
            <div class="card-body" >
              <!-- Single item -->
              @foreach($cart as $productId => $productDetails)
              <div class="row" data-product-id="{{ $productId }}">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  <!-- Image -->
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="{{ asset('images/'.$productDetails['image']) }}"
                      class="w-100" alt="Blue Jeans Jacket" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  <!-- Image -->
                </div>
  
                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  <!-- Data -->
                  <p><strong>{{$productDetails['name']}}</strong></p>
                  <form action="{{ route('cart.remove', $productId ) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger m-1">Remove</button>
              </form>
                
                  <!-- Data -->
                </div>
                
              
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  <!-- Quantity -->
                  <div class="d-flex mb-4" style="max-width: 300px">
                    <button class="btn btn-primary px-3 me-2 quantity-decrease">
                      <i class="fas fa-minus"></i>
                  </button>
                  
                  
                    <div class="form-outline">
                      <input id="quantity_{{$productId}}" min="0" name="quantity" value="1" type="number" class="form-control quantity-input" />
                      <label class="form-label" for="form1">Quantity</label>
                    </div>
                    <button class="btn btn-primary px-3 ms-2 quantity-increase">
                      <i class="fas fa-plus"></i>
                  </button>
                  </div>
                  <!-- Quantity -->
  
                  <!-- Price -->
                  <p class="item-price" >
                    <strong>${{$productDetails['price']}}</strong>
                  </p>
                  <!-- Price -->
                </div>
              </div>
              <!-- Single item -->
  @endforeach
              <hr class="my-4" />
  
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body">
              <p><strong>We accept</strong></p>
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                alt="Visa" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                alt="American Express" />
              <img class="me-2" width="45px"
                src="https://mdbcdn.b-cdn.net/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                alt="Mastercard" />
              <img class="me-2" width="45px"
                src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/PP_logo_h_200x51.png"
                alt="PayPal acceptance mark" />
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-4">
            <div class="card-header py-3">
              <h5 class="mb-0">Summary</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                @foreach($cart as $productId => $productDetails)
                <li
                  class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  total of  {{$productDetails['name']}}, for x{{$productDetails['quantity']}}
                  <span class="item-total-price">
                    ${{ $productDetails['price'] * $productDetails['quantity'] }}
                  </span>
                </li>
                @endforeach
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Shipping
                  <span>Free</span>
                </li>
                
                @php
  $total = 0;
  foreach($cart as $productId => $productDetails){
      $total += $productDetails['price'] * $productDetails['quantity'];
  }
@endphp
                
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div><strong>Total amount</strong></div>
                    <span class="cart-total-price"><strong>${{$total}}</strong></span>
                  </li>
              </ul>
              <div class="btn btn-primary btn-lg btn-block"><a href="{{route('cart.show')}}">
                Go to total amount
              </a>
              </div>
              <br><br>
              <form action="{{ route('make.payment') }}" method="POST">
                @csrf
                @foreach($cart as $productId => $productDetails)
                <input type="hidden" name="items[{{ $productId }}][name]" value="{{ $productDetails['name'] }}">
                <input type="hidden" name="items[{{ $productId }}][quantity]" value="{{ $productDetails['quantity'] }}">
                @endforeach
                <input type="hidden" name="totalvalue" value="{{ $total}}">
              
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Go to checkout 'paypal'
                </button>
              

              </form>
              <br>
              <form action="{{route('paymentstripe')}}" method="POST" id="payment-form">
                @csrf
                @foreach($cart as $productId => $productDetails)
                <input type="hidden" name="items[{{ $productId }}][name]" value="{{ $productDetails['name'] }}">
                <input type="hidden" name="items[{{ $productId }}][quantity]" value="{{ $productDetails['quantity'] }}">
                @endforeach
                <input type="hidden" name="totalvalue" value="{{ $total}}">
                <div class="form-row">
                    <label for="card-element">Credit or debit card</label>
                    <div id="card-element">
                        
                    
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary btn-lg btn-block"> Go to checkout 'stripe'</button>
            </form>
            
            
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
 
</body>

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SimpleLightbox plugin JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/SimpleLightbox/2.1.0/simpleLightbox.min.js"></script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
<script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    function updateTotals(productId, quantity) {
        var cartItem = $('.row[data-product-id="' + productId + '"]');
        var pricePerItem = parseFloat(cartItem.find('.item-price').text().substring(1));
        var itemTotalPrice = pricePerItem * quantity;
        
        // Update this item's total price
        cartItem.find('.item-total-price').text('$' + itemTotalPrice.toFixed(2));

        // Update the cart's total price
        var cartTotalPrice = 0;
        $('.item-total-price').each(function() {
            cartTotalPrice += parseFloat($(this).text().substring(1));
        });
        $('.cart-total-price').text('$' + cartTotalPrice.toFixed(2));
    }

    // When the quantity input value changes
    $('input[name="quantity"]').on('change', function() {
        var quantity = $(this).val();
        var cartItem = $(this).closest('.row');
        var productId = cartItem.data('product-id');

        // AJAX request to update the quantity in the session
        $.ajax({
            url: '/cart/update/' + productId,
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'quantity': quantity
            },
            success: function() {
                updateTotals(productId, quantity);
            }
        });

    });

    // When the decrease or increase buttons are clicked
    $('.btn.btn-primary.px-3').on('click', function() {
        var quantityInput = $(this).siblings('.form-outline').find('input[name="quantity"]');
        var quantity = parseInt(quantityInput.val());
        var cartItem = $(this).closest('.row');
        var productId = cartItem.data('product-id');

        if ($(this).hasClass('me-2')) {
            quantity = Math.max(0, quantity - 1); // prevent negative quantity
        } else {
            quantity++;
        }

        quantityInput.val(quantity);

        // AJAX request to update the quantity in the session
        $.ajax({
            url: '/cart/update/' + productId,
            type: 'POST',
            data: {
                '_token': $('meta[name="csrf-token"]').attr('content'),
                'quantity': quantity
            },
            success: function() {
                updateTotals(productId, quantity);
            }
        });

    });
});

</script>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env("STRIPE_KEY") }}');
    var elements = stripe.elements();
    var card = elements.create('card');
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                // Inform the user if there was an error
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                // Send the token to your server
                stripeTokenHandler(result.token);
            }
        });
    });

    // Submit the form with the token ID
    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

</body>
</html>