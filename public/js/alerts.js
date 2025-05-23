// alerta confifmDelete orders ---------------------------------------------------------------------------
Livewire.on('onCancelOrder', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.orders', 'yesCancel', id)
        }
    });
});


// alerta confifmDelete notifications ------------------------------------------------------------------
Livewire.on('onCancelNotification', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.notifications', 'yesCancel', id)
        }
    });
});


// borrar articulo del carrito ----------------------------------------------------------------
Livewire.on('onDeleteArticle', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, cancel it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('companies.visualizer-order', 'yesDelete', id)
        }
    });
});


// borrar categoria de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteCategory', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.category.categories', 'yesDelete', id)
        }
    });
});


// borrar machine de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteMachine', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.machine.machines', 'yesDelete', id)
        }
    });
});


// borrar copmany de admin dashboard ----------------------------------------------------------------
Livewire.on('onDeleteCompany', id => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            Livewire.dispatchTo('admin-dashboard.company.companies', 'yesDelete', id)
        }
    });
});



Livewire.on('message', txt => {
    Swal.fire({
        icon: "success",
        title: txt,
        showConfirmButton: false,
        timer: 1500
    });
})