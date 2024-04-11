<?php require 'templates/header.php'; ?>

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
<?php require 'templates/footer.php'; ?>
