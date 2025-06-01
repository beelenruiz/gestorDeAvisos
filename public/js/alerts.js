// alerta confifmDelete orders ---------------------------------------------------------------------------
Livewire.on('onCancelOrder', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡Si cancelas no recibiras el pedido!",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "Mejor no",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.orders', 'yesCancel', id)
        }
    });
});


// alerta confifmDelete notifications ------------------------------------------------------------------
Livewire.on('onCancelNotification', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Asegurate de que el problema ha desaparecido antes de cancelar",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "Mejor no",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.notifications', 'yesCancel', id)
        }
    });
});


// borrar articulo del carrito ----------------------------------------------------------------
Livewire.on('onDeleteArticle', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Si lo eliminas no recibirás el artículo",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, mantener",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.visualizer-order', 'yesDelete', id)
        }
    });
});


// borrar categoria de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteCategory', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás deshacer esta acción!",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Mejor se queda",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.category.categories', 'yesDelete', id)
        }
    });
});


// borrar machine de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteMachine', id => {
    Swal.fire({
        title: "¿Descatalogar máquina?",
        text: "Esta acción desactivará la máquina, pero no se eliminará definitivamente.",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="10" y1="9" x2="10" y2="15"/>
                <line x1="14" y1="9" x2="14" y2="15"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, descatalogar",
        cancelButtonText: "Mejor no",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.machine.machines', 'yesDelete', id)
        }
    });
});


// borrar company de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteCompany', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esta acción!",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.company.companies', 'yesDelete', id)
        }
    });
});


// borrar worker de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteWorker', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esta acción!",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12" y2="16"/>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.worker.workers', 'yesDelete', id)
        }
    });
});


// borrar articles de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteArticle', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Este artículo será marcado como descatalogado. ¡Podrás revertirlo luego!",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#531919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="7" width="18" height="13" rx="2" ry="2"></rect>
                <polyline points="3 7 12 13 21 7"></polyline>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#531919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, marcar descatalogado",
        cancelButtonText: "Cancelar",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.article.articles', 'yesDelete', id)
        }
    });
});


// cancelar pedidos de admin dashboard ----------------------------------------------------------------
Livewire.on('onCancelOrder', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Estás cancelando un pedido!",
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
        confirmButtonText: "Sí, cancelar pedido",
        cancelButtonText: "Mejor no",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.order.orders', 'yesCancel', id)
        }
    });
});

// borrar pedidos de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteOrder', id => {
    Swal.fire({
        title: "¿Eliminar pedido cancelado?",
        text: "Esta acción borrará el pedido cancelado de la base de datos y no se podrá recuperar.",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#831919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#831919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        color: "#531919",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.order.orders', 'yesDelete', id)
        }
    });
});


// borrar articulo de un pedido ----------------------------------------------------------------
Livewire.on('onDeleteArticle', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Eliminarás el articulo del carrito.",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#831919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#831919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        background: "#fff7f7",
        color: "#531919",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.visualizer-order', 'yesDelete', id)
        }
    });
});


// cancelar avisos de admin dashboard ----------------------------------------------------------------
Livewire.on('onCancelNotification', id => {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Estás cancelando un aviso!",
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
        confirmButtonText: "Sí, cancelar pedido",
        cancelButtonText: "Mejor no",
        background: "#f9f9f9",
        color: "#333",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.notification.notifications', 'yesCancel', id)
        }
    });
});

// borrar avisos de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteNotification', id => {
    Swal.fire({
        title: "¿Eliminar aviso cancelado?",
        text: "Esta acción borrará la información del aviso cancelado de la base de datos.",
        iconHtml: `
            <svg xmlns="http://www.w3.org/2000/svg" class="swal2-icon" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="#831919" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                <path d="M10 11v6"></path>
                <path d="M14 11v6"></path>
                <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
            </svg>
        `,
        showCancelButton: true,
        confirmButtonColor: "#831919",
        cancelButtonColor: "#999999",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        color: "#531919",
        customClass: {
            popup: 'rounded-lg shadow-lg',
            confirmButton: 'px-5 py-2',
            cancelButton: 'px-5 py-2'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.notification.notifications', 'yesDelete', id)
        }
    });
});


Livewire.on('message', txt => {
    Swal.fire({
        title: txt,
        showConfirmButton: false,
        timer: 1500,
        iconHtml: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#531919" viewBox="0 0 24 24"><path d="M20.285 6.709l-11.39 11.39-5.18-5.18 1.415-1.415 3.765 3.765 9.976-9.976z"/></svg>',
        customClass: {
            icon: 'swal2-icon-custom'
        }
    });
})


// alertas cuando añades productos al carrito
document.addEventListener('cart:added', function (e) {
    const { message, article } = e.detail;

    Swal.fire({
        iconHtml: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#531919" viewBox="0 0 24 24"><path d="M20.285 6.709l-11.39 11.39-5.18-5.18 1.415-1.415 3.765 3.765 9.976-9.976z"/></svg>',
        customClass: {
            icon: 'swal2-icon-custom'
        },
        title: message,
        imageUrl: article.image,
        imageWidth: 80,
        imageHeight: 80,
        timer: 2500,
        showConfirmButton: false
    });
});