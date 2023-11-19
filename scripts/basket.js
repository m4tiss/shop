
function changeColor() {
    const button = document.getElementById('addToBasket');
    button.style.backgroundColor = 'green';
    button.innerHTML = 'Dodano';
    button.classList.add('moveUpDown');

    setTimeout(function () {
        button.style.backgroundColor = '';
        button.innerHTML = 'Dodaj do koszyka';
        button.classList.remove('moveUpDown');
    }, 1000);
}

async function addToBasketSession(productId) {

    console.log(productId);
    const selectedSizeInput = document.querySelector('input[name="selectedSize"]:checked');
    const selectedSizeValue = selectedSizeInput.value;
    try {
        const response = await fetch("addToBasketSession.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: "idProduct=" + productId + "&size=" + selectedSizeValue,
        });

        if (!response.ok) {
            console.log("Error podczas wysłania")
        }

        const data = await response.text();
        console.log(data)
    } catch (error) {
        console.error(error);
    }
}