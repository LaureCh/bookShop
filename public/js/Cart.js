$(document).ready(function() {
  alert('hello');

    /* Set rates + misc */
    var fadeTime = 300;
     
     
    /* Assign actions */
    $('.product-quantity input').change( 
        function() {
            alert('hello');
            updateQuantity(this);
    });
     
     
     
    /* Recalculate cart */
    function recalculateCart()
    {
      var subtotal = 0;
       
      /* Sum up row totals */
      $('.product').each(function () {
        subtotal += parseFloat($(this).children('.product-line-price').text());
      });
           
      /* Update totals display */
      $('.totals-value').fadeOut(fadeTime, function() {
        $('#cart-subtotal').html(subtotal.toFixed(2));
        if(subtotal == 0){
          $('.checkout').fadeOut(fadeTime);
        }else{
          $('.checkout').fadeIn(fadeTime);
        }
        $('.totals-value').fadeIn(fadeTime);
      });
    }
     
     
    /* Update quantity */
    function updateQuantity(quantityInput)
    {
      /* Calculate line price */
      var productRow = $(quantityInput).parent().parent();
      var price = parseFloat(productRow.children('.product-price').text());
      var quantity = $(quantityInput).val();
      var linePrice = price * quantity;
       
      /* Update line price display and recalc cart totals */
      productRow.children('.product-line-price').each(function () {
        $(this).fadeOut(fadeTime, function() {
          $(this).text(linePrice.toFixed(2));
          recalculateCart();
          $(this).fadeIn(fadeTime);
        });
      });  
    }
    });
     