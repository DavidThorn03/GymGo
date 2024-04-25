function confirmCheckout() {
    if (confirm("Are you sure you want to proceed to checkout?")) {
        return true;
    } else {
        return false;
    }
}