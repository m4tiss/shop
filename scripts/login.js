document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();

        const email = document.forms["loginForm"]["email"].value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(email)) {
            console.log("Poprawny adres e-mail: " + email);
        } else {
            console.log("Niepoprawny adres e-mail: " + email);
            alert("Niepoprawny adres e-mail");
        }
    });
});