<?php 

include_once 'header.php';

require_once 'config.php'; 
?>
<!DOCTYPE html>
<html lang ="en-US">
    <head>
       
        <meta charset = "utf-8">

        <script src="https://js.stripe.com/v3/"></script>

</head>


<body>
<div class="container">
    <h1>  Payment </h1>
    <div class="panel">
    
    <div class="panel-body">
        <!-- Display errors returned by createToken -->
        <div id="paymentResponse"></div>
        
        <!-- Payment form -->
        <form action="payment.php?confirmreserve='test'" method="POST" id="paymentFrm">
            <div class="form-group">
                <label>NAME</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter name" required="" autofocus="">
            </div>
            
            <div class="form-group">
                <label for="email">Email Address:</label>
                <input type="email" name="email" class="form-control-plaintext" id="firste" placeholder="Enter email" required="">
            </div>
                            
            <div class="form-group">
                <label>CARD NUMBER</label>
                <div id="card_number" class="form-control"></div>
            </div>
            <div class="row g-2 justify-content-start">
                
                    <div class="col-sm-5">
                        <label>EXPIRY DATE</label>
                        <div id="card_expiry" class="form-control"></div>
                    
                        <label>CVC CODE</label>
                        <div id="card_cvc" class="form-control"></div>
                    </div>

            </div>
            <section id ="finalBtn">
                <button type="submit" class="btn btn-success" name="confirmreserve" id="payBtn">Confirm Reservation</button>
                <button type="submit" class="btn btn-success" name="confirmreserve" id="reviewBtn">Review Reservation</button>
</section>

        </form>
        
    </div>
</div>
</div>
            <section id ="twobutt">
                 <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"/>
                    <label class="form-check-label" id="terms"  >
                        I certify that I have read and accept the  Terms of Use and Privacy Statement and I have read and understand the Rate Description and Rate Tules for my reservation..
                    </label>
                </div>
            </section>

<script>
// Create an instance of the Stripe object
// Set your publishable API key
var stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

// Create an instance of elements
var elements = stripe.elements();



var style = {
    base: {
        fontWeight: 400,
        fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
        fontSize: '16px',
        lineHeight: '1.4',
        color: 'grey',
        backgroundColor: '#fff',
        '::placeholder': {
            color: '#888',
        },
    },
    invalid: {
        color: '#eb1c26',
    }
};

var cardElement = elements.create('cardNumber', {
    style: style
});
cardElement.mount('#card_number');

var exp = elements.create('cardExpiry', {
    'style': style
});
exp.mount('#card_expiry');

var cvc = elements.create('cardCvc', {
    'style': style
});
cvc.mount('#card_cvc');

// Validate input of the card elements
var resultContainer = document.getElementById('paymentResponse');
cardElement.addEventListener('change', function(event) {
    if (event.error) {
        resultContainer.innerHTML = '<p>'+event.error.message+'</p>';
    } else {
        resultContainer.innerHTML = '';
    }
});

// Get payment form element
var form = document.getElementById('paymentFrm');

// Create a token when the form is submitted.
form.addEventListener('submit', function(e) {
    e.preventDefault();
    createToken();
});

// Create single-use token to charge the user
function createToken() {
    stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
    });
}

// Callback to handle the response from stripe
function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
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

