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