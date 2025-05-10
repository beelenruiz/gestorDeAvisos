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

Livewire.on('message', txt => {
    Swal.fire({
        icon: "success",
        title: txt,
        showConfirmButton: false,
        timer: 1500
    });
})