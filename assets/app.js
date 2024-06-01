import './bootstrap.js';
import "https://js.stripe.com/v3/"
/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';

console.log('This log comes from assets/app.js - welcome to AssetMapper! 🎉');

function priceChoice(value) {
    fetch(`/filter-products?priceRange=${value}`)
        .then(response => response.json())
        .then(data => {
            const productsContainer = document.querySelector('.products');
            productsContainer.innerHTML = '';

            data.forEach(product => {
                const productDiv = document.createElement('div');
                productDiv.classList.add('products_details');

                productDiv.innerHTML = `
                    <img src="/images/products/${product.imageName}">
                    <h2>${product.name}</h2>
                    <h3>${product.price} €</h3>
                    <a href="/product/${product.id}">
                        <button class='btn btn-primary w-100'>Voir</button>
                    </a>
                `;

                productsContainer.appendChild(productDiv);
            });
        })
        .catch(error => console.error('Error:', error));
}

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