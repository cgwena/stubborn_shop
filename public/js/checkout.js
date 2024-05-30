// public/assets/js/checkout.js

document.addEventListener("DOMContentLoaded", function () {
    var stripe = Stripe("pk_test_51HkPZdCc8KoQEaMIDql30GSBanEj8aJDGTNpJIotdao7SMlshLBjXON95ms5igDRNeYiVa9NnlDoLIIScoN5s1MH00PB5BDRsh");
    var checkoutButton = document.getElementById("checkout-button");
    checkoutButton.addEventListener("click", function () {
        var totalAmount = document.querySelector('input[name="totalAmount"]').value;

        fetch("/stripe", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ totalAmount: totalAmount }),
        })
            .then(function (response) {
                return response.json();
            })
            .then(function (session) {
                return stripe.redirectToCheckout({ sessionId: session.id });
            })
            .then(function (result) {
                if (result.error) {
                    alert(result.error.message);
                }
            })
            .catch(function (error) {
                console.error("Error:", error);
            });
    });
});
