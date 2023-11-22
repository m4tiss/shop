function showExistEmailErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.display = "block";
        errorWarning.textContent = 'Użytkownik z takim emailem już istnieje';
    });
}

function showNotExistEmailErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.display = "block";
        errorWarning.textContent = 'Użytkownik z takim emailem nie istnieje';
    });
}

function showInvalidPasswordMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.display = "block";
        errorWarning.textContent = 'Nieprawidłowe hasło';
    });
}


function showNameErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.textContent = 'Imię nie może być puste';
        errorWarning.style.display = "block";
    });

}
function showSurnameErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.textContent = 'Nazwisko nie może być puste';
        errorWarning.style.display = "block";
    });

}
function showEmailErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.textContent = 'Email nie może być pusty';
        errorWarning.style.display = "block";
    });
}
function showPasswordErrorMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.textContent = 'Hasło nie może być puste';
        errorWarning.style.display = "block";
    });
}

function InsertUserMessage() {
    document.addEventListener("DOMContentLoaded", function() {
        var errorWarning = document.getElementById("errorWarring");
        errorWarning.style.color = "green";
        errorWarning.textContent = 'Udało się! Teraz zaloguj się!';
        errorWarning.style.display = "block";
    });
}

