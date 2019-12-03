<form id="2checkout" action="https://www.2checkout.com/checkout/spurchase" method="post">
    <input type="hidden" name="sid" value="1817037"/>
    <input type="hidden" name="mode" value="2CO"/>
    <input type="hidden" name="li_0_name" value="Test Product"/>
    <input type="hidden" name="li_0_price" value="0.01"/>
    <input type="submit" value="Click here if you are not redirected automatically" /></form>
<script type="text/javascript">document.getElementById('2checkout').submit();</script>

<div class="payment-frm">
    <h5>Charge $25 USD with 2Checkout</h5>

    <!-- credit card form -->
    <form id="paymentFrm" method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="checkout">
        <div>
            <label>NAME</label>
            <input type="text" name="name" id="name" placeholder="Enter name" required autofocus value="Md Israil Ahmed">
        </div>
        <div>
            <label>EMAIL</label>
            <input type="email" name="email" id="email" placeholder="Enter email" required value="israilahmed5@gmail.com">
        </div>
        <div>
            <label>CARD NUMBER</label>
            <input type="text" name="card_num" id="card_num" placeholder="Enter card number" autocomplete="off" required value="4000000000000002">
        </div>
        <div>
            <label><span>EXPIRY DATE</span></label>
            <input type="number" name="exp_month" id="exp_month" placeholder="MM" required value="10">
            <input type="number" name="exp_year" id="exp_year" placeholder="YY" required value="2020">
        </div>
        <div>
            <label>CVV</label>
            <input type="number" name="cvv" id="cvv" autocomplete="off" required value="123">
        </div>

        <!-- hidden token input -->
        <input id="token" name="token" type="hidden" value="">

        <!-- submit button -->
        <input type="submit" class="btn btn-success" value="Submit Payment">
    </form>
</div>

<!-- 2Checkout JavaScript library -->
<script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>

<script>
    // Called when token created successfully.
    var successCallback = function(data) {
        var myForm = document.getElementById('paymentFrm');

        // Set the token as the value for the token input
        myForm.token.value = data.response.token.token;

        // Submit the form
        myForm.submit();
    };

    // Called when token creation fails.
    var errorCallback = function(data) {
        if (data.errorCode === 200) {
            tokenRequest();
        } else {
            alert(data.errorMsg);
        }
    };

    var tokenRequest = function() {
        // Setup token request arguments
        var args = {
            sellerId: "901416663",
            publishableKey: "EA9936A1-48CB-446B-9FA1-6188D046E348",
            ccNo: $("#card_num").val(),
            cvv: $("#cvv").val(),
            expMonth: $("#exp_month").val(),
            expYear: $("#exp_year").val()
        };

        // Make the token request
        TCO.requestToken(successCallback, errorCallback, args);
    };

    $(function() {
        // Pull in the public encryption key for our environment
        TCO.loadPubKey('sandbox');

        $("#paymentFrm").submit(function(e) {
            // Call our token request function
            tokenRequest();

            // Prevent form from submitting
            return false;
        });
    });
</script>