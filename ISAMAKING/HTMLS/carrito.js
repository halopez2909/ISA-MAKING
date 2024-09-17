let cart = [];
let total = 0;

function addToCart(productName, price) {
    // Añadir el producto al carrito
    cart.push({ name: productName, price: price });
    
    // Actualizar el carrito en la vista
    updateCart();
}

function updateCart() {
    const cartList = document.getElementById('cart');
    cartList.innerHTML = '';
    
    total = 0;

    cart.forEach((item, index) => {
        const listItem = document.createElement('li');
        listItem.textContent = `${item.name} - $${item.price}`;
        cartList.appendChild(listItem);
        total += item.price;
    });
    
    // Mostrar el total
    document.getElementById('total').textContent = `Total: $${total}`;
}