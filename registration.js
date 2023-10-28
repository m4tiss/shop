
// document.addEventListener("DOMContentLoaded", function() {
//     var errorWarning = document.getElementById("errorWarring");
//
//     // Sprawdzamy, czy użytkownik ręcznie odświeżył stronę
//     if (sessionStorage.getItem("manualRefresh")) {
//         // Jeśli tak, ukrywamy etykietę
//         errorWarning.style.display = "none";
//
//         // Po ukryciu, usuwamy zmienną z sessionStorage
//         sessionStorage.removeItem("manualRefresh");
//     }
//
//     // Dodajmy event listener do odświeżania strony
//     window.addEventListener("beforeunload", function() {
//         // Przed odświeżeniem ustawiamy zmienną w sessionStorage
//         sessionStorage.setItem("manualRefresh", "true");
//     });
// });
// document.addEventListener("DOMContentLoaded", function() {
//     var errorWarning = document.getElementById("errorWarring");
//     errorWarning.innerHTML = '';
//     errorWarning.style.display = "none";
// });
function showExistEmailErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.display = "block";
        errorWarning.innerHTML = 'Użytkownik z takim emailem już istnieje';
    });


}
function showNameErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.innerHTML = 'Imię nie może być puste';
        errorWarning.style.display = "block";
    });

}
function showSurnameErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.innerHTML = 'Nazwisko nie może być puste';
        errorWarning.style.display = "block";
    });

}
function showEmailErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.innerHTML = 'Email nie może być pusty';
        errorWarning.style.display = "block";
    });
}
function showPasswordErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.innerHTML = 'Hasło nie może być puste';
        errorWarning.style.display = "block";
    });
}

function InsertUserMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.color = "green";
        errorWarning.innerHTML = 'Udało się! Teraz zaloguj się!';
        errorWarning.style.display = "block";
    });
}

