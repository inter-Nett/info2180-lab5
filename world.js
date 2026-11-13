document.addEventListener("DOMContentLoaded", function () {
    const lookupButton = document.getElementById("lookup");
    const citiesButton = document.getElementById("lookup-cities");
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
citiesButton.addEventListener("click", function () {
    const country = countryInput.value.trim();

    fetch("world.php?country=" + encodeURIComponent(country) + "&lookup=cities")
        .then(response => {
            if (!response.ok) {
                throw new Error("Unable to retrieve city information.");
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
