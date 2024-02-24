<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
	if (isset($_POST['submit'])) {

		mysqli_query($con,"update orders set 	paymentMethod='".$_POST['paymethod']."' where userId='".$_SESSION['id']."' and paymentMethod is null ");
		unset($_SESSION['cart']);
		header('location:order-history.php');

	}
?>
<!DOCTYPE html>
<style>
    .panel-body {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .payment-option {
        margin-bottom: 15px;
    }

    .payment-option label {
        display: flex;
        align-items: center;
        cursor: pointer;
    }

    .payment-option input[type="radio"] {
        margin-right: 10px;
    }

    .payment-option div {
        display: none;
        margin-top: 10px;
    }
    #totalPrice {
        font-size: 18px;
        margin-top: 15px;
    }

    .btn-primary {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .payment-options-container {
        display: flex;
        justify-content: space-between;
    }

    .payment-option-box {
        flex-basis: calc(33.33% - 20px);
    }

    .payment-option-box label {
        display: block;
        margin-bottom: 10px;
    }

    .payment-option-box input[type="radio"] {
        margin-right: 5px;
    }
</style>
<html lang="en">
<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Shopping Portal | Payment Method</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="assets/css/config.css">
    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/images/favicon.ico">
</head>
<body class="cnt-home">

<header class="header-style-1">
    <?php include('includes/top-header.php');?>
    <?php include('includes/main-header.php');?>
    <?php include('includes/menu-bar.php');?>
</header>

<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Payment Method</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-bd">
    <div class="container">
        <div class="checkout-box faq-page inner-bottom-sm">
            <div class="row">
                <div class="col-md-12">
                    <h2>Choose Payment Method</h2>

                    <form name="payment" method="post">
                        <!-- Payment options and fields go here -->

                        <div class="payment-options-container">
                            <div class="payment-option-box">
                                <div class="panel-body payment-option">
                                    <input type="radio" name="paymethod" id="cod" value="COD" checked="checked">
                                    <label for="cod">Cash on Delivery (COD)</label>
                                </div>
                            </div>

                            <div class="payment-option-box">
                                <div class="panel-body payment-option">
                                    <input type="radio" name="paymethod" id="debitCreditCard" value="Debit / Credit card">
                                    <label for="debitCreditCard">Debit / Credit card</label>
                                    <!-- Additional fields for Debit / Credit card -->
                                    <div id="debitCreditCardFields">
                                        Card Number: <input type="text" name="cardNumber"><br>
                                        Expiry Date: <input type="text" name="expiryDate"><br>
                                        <!-- Add more fields as needed -->
                                    </div>
                                </div>
                            </div>

                            <div class="payment-option-box">
                                <div class="panel-body payment-option">
                                    <input type="radio" name="paymethod" id="bankTransfer" value="Bank Transfer">
                                    <label for="bankTransfer">Bank Transfer</label>
                                    <!-- Account details for Bank Transfer -->
                                    <div id="accountDetailsBankTransfer" class="account-details">
                                        <h4>Account Details for Bank Transfer Payment</h4>
                                        <p>Account Number: 555555555</p>
                                        <p>Bank Name: Transfer Bank</p>
                                        <!-- Add more details as needed -->
                                        <label for="paymentScreenshotBankTransfer">Upload Screenshot:</label>
                                        <input type="file" name="paymentScreenshotBankTransfer" id="paymentScreenshotBankTransfer" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Price Display -->
                        <div id="totalPrice">Total Price: $<?php echo number_format($discountedPrice, 2); ?></div>

                        <input type="submit" value="Submit" name="submit" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
      
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div>
    <!-- /.container -->
</div>
<!-- /.body-content -->
<?php include('includes/footer.php'); ?>
<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/echo.min.js"></script>
<script src="assets/js/jquery.easing-1.3.min.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script>
<script src="assets/js/jquery.rateit.min.js"></script>
<script type="text/javascript" src="assets/js/lightbox.min.js"></script>
<script src="assets/js/bootstrap-select.min.js"></script>
<script src="assets/js/wow.min.js"></script>
<script src="assets/js/scripts.js"></script>
<!-- For demo purposes – can be removed on production -->
<script src="switchstylesheet/switchstylesheet.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to update form based on selected payment method
        function updateForm() {
            var selectedPaymentMethod = document.querySelector('input[name="paymethod"]:checked').value;

            // Show/hide additional fields based on selected payment method
            var debitCreditCardFields = document.getElementById('debitCreditCardFields');
            var accountDetailsBankTransfer = document.getElementById('accountDetailsBankTransfer');

            if (selectedPaymentMethod === 'Debit / Credit card') {
                debitCreditCardFields.style.display = 'block';
                accountDetailsBankTransfer.style.display = 'none';
            } else if (selectedPaymentMethod === 'Bank Transfer') {
                debitCreditCardFields.style.display = 'none';
                accountDetailsBankTransfer.style.display = 'block';
            } else {
                debitCreditCardFields.style.display = 'none';
                accountDetailsBankTransfer.style.display = 'none';
            }

            // Your existing total price calculation logic here
            var totalPrice = 100; // Replace with your actual total price logic

            if (selectedPaymentMethod === 'Debit / Credit card' || selectedPaymentMethod === 'Bank Transfer') {
                totalPrice *= 0.9; // Apply 10% discount for Debit / Credit card or Bank Transfer
            }

            // Update the total price display
            document.getElementById('totalPrice').textContent = 'Total Price: $' + totalPrice.toFixed(2);
        }

        // Attach event listener for radio button change
        var paymentOptions = document.querySelectorAll('input[name="paymethod"]');
        paymentOptions.forEach(function (option) {
            option.addEventListener('change', updateForm);
        });

        // Initial update on page load
        updateForm();
    });
</script>
<!-- For demo purposes – can be removed on production : End -->
</body>
</html>

<?php } ?>
