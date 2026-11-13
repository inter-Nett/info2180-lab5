document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.getElementById("lookup");
    const countryInput = document.getElementById("country");
    const resultDiv = document.getElementById("result");

    lookupButton.addEventListener("click", function () {
        const country = countryInput.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response => {
                if (!response.ok) {
                    throw new Error("Unable to retrieve country information.");
                }
                return response.text();
            })
            .then(data => {
                resultDiv.innerHTML = data;
            })
            .catch(error => {
                resultDiv.textContent = error.message;
            });
    });
});