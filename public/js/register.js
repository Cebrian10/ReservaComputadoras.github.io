document.addEventListener("DOMContentLoaded", function() {
    var alert = document.querySelector('.alerta');
    if (alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000);
    }
});