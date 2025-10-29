/*
    * Script principal
    * Se encarga del manejo de carrito
*/

document.addEventListener('DOMContentLoaded', () => {

    // Intentar cargar el carrito desde localStorage
    let fab_cart = JSON.parse(localStorage.getItem('fab_cart_foodexpress')) || [];

    const fab_cart_count_el = document.getElementById('fab-cart-count');


    function fab_update_cart_display() {
        if (fab_cart_container) {
            fab_cart_container.innerHTML = ""; // Limpiar vista
        }
        
        let fab_total = 0;
        let fab_total_items = 0;

        fab_cart.forEach(item => {
            const subtotal = item.price * item.quantity;
            fab_total += subtotal;
            fab_total_items += item.quantity;
        });

        // Actualizar contador
        if (fab_cart_count_el) {
            fab_cart_count_el.textContent = fab_total_items;
        }

        // Guardar en localStorage
        localStorage.setItem('fab_cart_foodexpress', JSON.stringify(fab_cart));
    }

    /**
     * Función para añadir (o sumar) un item
     */
    function fab_add_item_to_cart(id, name, price) {
        const existing_item_index = fab_cart.findIndex(item => item.id === id);

        if (existing_item_index > -1) {
            // Item ya existe, sumar cantidad
            fab_cart[existing_item_index].quantity++;
        } else {
            // Item nuevo
            fab_cart.push({ id, name, price, quantity: 1 });
        }
        fab_update_cart_display();
    }

    document.body.addEventListener('click', (e) => {
        // Clic en "Agregar al Carrito"
        if (e.target && e.target.classList.contains('fab-add-to-cart')) {
            e.preventDefault();

            const button = e.target;
            const item_id = button.dataset.id;
            const item_name = button.dataset.name;
            const item_price = parseFloat(button.dataset.price);

            fab_add_item_to_cart(item_id, item_name, item_price);
        }
    });

    // Cargar el carrito al iniciar la página
    fab_update_cart_display();


    // Limpiar carrito si el pedido fue exitoso (detectado por PHP)
    const fab_success_message = document.querySelector('.fab-feedback-success');
    if (fab_success_message) {
        localStorage.removeItem('fab_cart_foodexpress');
        fab_cart = [];
        fab_update_cart_display();
    }
});