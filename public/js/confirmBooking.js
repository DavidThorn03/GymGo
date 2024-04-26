function confirmBooking() {
    if (confirm("Are you sure you want to book this lesson?")) {
        return true;
    } else {
        return false;
    }
}