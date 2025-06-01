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
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': CSRF_TOKEN,
        },
        body: JSON.stringify({
            article_id: articleId,
            quantity: quantity,
        })
    })
    .then(res => res.json())
    .then(data => {
        const event = new CustomEvent('cart:added', {
            detail: {
                message: data.message,
                article: data.added_article
            }
        });
        document.dispatchEvent(event);
    })
    .catch(() => {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudo agregar al carrito.',
        });
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
                    
                    Swal.fire({
                        iconHtml: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#531919" viewBox="0 0 24 24"><path d="M20.285 6.709l-11.39 11.39-5.18-5.18 1.415-1.415 3.765 3.765 9.976-9.976z"/></svg>',
                        customClass: {
                            icon: 'swal2-icon-custom'
                        },
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    showCartPageNotification(data.message || 'Error al actualizar cantidad.', 'error');
                }
            })
            .catch(errorData => {
                let errorMessage = "Error al actualizar cantidad.";
                if (errorData && errorData.message) errorMessage = errorData.message;
                else if (errorData && errorData.error) errorMessage = errorData.error;
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage
                });
            });
        });
    });


    // eliminar articulo
    document.querySelectorAll('.btn-remove-from-cart').forEach(button => {
        button.addEventListener('click', function () {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Eliminarás este producto del carrito.",
                iconHtml: `
                    <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                `,
                showCancelButton: true,
                confirmButtonColor: "#531919",
                cancelButtonColor: "#999999",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Mejor no",
                background: "#f9f9f9",
                color: "#333",
                customClass: {
                    popup: 'rounded-lg shadow-lg',
                    confirmButton: 'px-5 py-2',
                    cancelButton: 'px-5 py-2'
                }
            }).then(result => {
                if (!result.isConfirmed) {
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
                        return response.json().then(err => { throw err; });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            iconHtml: `
                                <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#831919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                </svg>
                            `,
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    } else {
                        showCartPageNotification(data.message || 'Error al eliminar artículo.', 'error');
                    }
                })
                .catch(errorData => {
                    console.error('Remove item CATCH error:', errorData);
                    let errorMessage = "Error de red o servidor al eliminar artículo.";
                    if (errorData && errorData.message) errorMessage = errorData.message;
                    else if (errorData && errorData.error) errorMessage = errorData.error;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMessage
                    });
                });
            });
        });
    });


    // vaciar carrito
    const btnEmptyCart = document.getElementById('btn-empty-cart');
    if (btnEmptyCart) {
        btnEmptyCart.addEventListener('click', function () {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "El carrito quedará varío!",
                iconHtml: `
                    <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                    </svg>
                `,
                showCancelButton: true,
                confirmButtonColor: "#531919",
                cancelButtonColor: "#999999",
                confirmButtonText: "Sí, vacialo",
                cancelButtonText: "Mejor no",
                background: "#f9f9f9",
                color: "#333",
                customClass: {
                    popup: 'rounded-lg shadow-lg',
                    confirmButton: 'px-5 py-2',
                    cancelButton: 'px-5 py-2'
                }
            }).then(result => {
                if (result.isConfirmed) {
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
                        Swal.fire({
                            iconHtml: `
                                <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#831919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                </svg>
                            `,
                            title: data.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            window.location.reload();
                        });
                    })
                    .catch(errorData => {
                        console.error('Empty cart error:', errorData);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorData?.message || errorData?.error || 'Error al vaciar el carrito.'
                        });
                    });
                }
            });
        });
    }
});