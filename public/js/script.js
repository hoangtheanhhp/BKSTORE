$(document).ready(function() {
    $(".error_msg").delay(3000).slideUp();
});
function xacnhan(msg) {
    if (window.confirm(msg)) {
        return true;
    } 
    return false;
}