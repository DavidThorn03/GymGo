function confirmCancel() {
    if (confirm("Are you sure you want to remove this booking?")) {
        return true;
    } else {
        return false;
    }
}