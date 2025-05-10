// funcion que cambia el valor de la cantidad en la vista de articulos
function adjustQuantity(articleId, num) {
    const input = document.getElementById(`quantity-${articleId}`);
    let newValue = parseInt(input.value) + num;
    input.value = newValue > 0 ? newValue : 1;
}


// añade un articulo al carrito
function add(articleId) {
    const quantityInput = document.getElementById(`quantity-${articleId}`);
    const quantity = parseInt(quantityInput.value) || 1;

    fetch(CART_ADD_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json", //lo mandamos en json
            "X-CSRF-TOKEN": CSRF_TOKEN
        },
        body: JSON.stringify({
            article_id: articleId,
            quantity: quantity
        })
    })
    .then()
    .catch(errorData => {
        let errorMessage = "Error al añadir al carrito.";
    });
}


// -----------------------------------------------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function () {

    //actualizar cantidad
    document.querySelectorAll('.btn-update-quantity').forEach(button => {
        button.addEventListener('click', function () {
            const articleId = this.dataset.articleId;
            const operation = parseInt(this.dataset.operation);
            const url = `${CART_UPDATE_URL_BASE}/${articleId}`;

            fetch(url, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ num: operation })
            })
            .then(response => {
                if (!response.ok) return response.json().then(err => { throw err; });
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // showCartPageNotification(data.message, 'success');
                    
                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    showCartPageNotification(data.message || 'Error al actualizar cantidad.', 'error');
                }
            })
            .catch(errorData => {
                let errorMessage = "Error al actualizar cantidad.";
                if (errorData && errorData.message) errorMessage = errorData.message;
                else if (errorData && errorData.error) errorMessage = errorData.error;
                console.error('Error update quantity:', errorData);
            });
        });
    });


    // eliminar articulo
    document.querySelectorAll('.btn-remove-from-cart').forEach(button => {
        button.addEventListener('click', function () {
            if (!confirm('¿Estás seguro de que quieres eliminar este artículo del carrito?')) {
                return;
            }
            const articleId = this.dataset.articleId;
            const url = `${CART_DESTROY_URL_BASE}/${articleId}`;

            fetch(url, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    //showCartPageNotification(data.message, 'success');

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                } else {
                    showCartPageNotification(data.message || 'Error al eliminar artículo.', 'error');
                }
            })
            .catch(errorData => {
                console.error('Remove item CATCH error:', errorData); // Log
                let errorMessage = "Error de red o servidor al eliminar artículo.";
                if (errorData && errorData.message) errorMessage = errorData.message;
                else if (errorData && errorData.error) errorMessage = errorData.error;
            });
        });
    });


    // vaciar carrito
    const btnEmptyCart = document.getElementById('btn-empty-cart');
    if (btnEmptyCart) {
        btnEmptyCart.addEventListener('click', function () {
            if (!confirm('¿Estás seguro de que quieres vaciar todo el carrito?')) {
                return;
            }
            const url = CART_EMPTY_URL;

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => {
                        throw err;
                    });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    //showCartPageNotification(data.message, 'success');

                    setTimeout(() => {
                        window.location.reload();
                    }, 500);
                }
            })
            .catch(errorData => {
                console.error('Empty cart CATCH error:', errorData); // Log
                let errorMessage = "Error de red o servidor al vaciar el carrito.";
                if (errorData && errorData.message) errorMessage = errorData.message;
                else if (errorData && errorData.error) errorMessage = errorData.error;
            });
        });
    }
});