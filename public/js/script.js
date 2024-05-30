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

function checkoutSession() {
    
}