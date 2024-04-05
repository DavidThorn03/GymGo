<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/shipping.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <script src="js/form-validation.js"></script>
</head>
<body>
    <div class="container2">
        <h2>Checkout</h2>
        <form action="OrderConfirmationController.php" method="post" id="registration">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" required>
            <label for="add" class="space">Address</label>
            <input type="text" name="address" id="add" required>
            <label for="phone" class="space">Mobile Phone</label>
            <input type="tel" placeholder="123-4567899" name="phone" id="phone" required>
            <label for="email" class="space">Email</label>
            <input type="email" name="email" id="email" placeholder="example@hotmail.com" required>
            <label for="payment" class="space">Payment Method</label>
            <select name="payment" id="payment" required>
                <option value="paypal">PayPal</option>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
            </select>
            <input type="checkbox" name="tos" id="tos" required>
            <label for="tos">Read Terms and Conditions</label>
            <button type="submit">Place Order</button>
        </form>
    </div>
</body>
</html>
