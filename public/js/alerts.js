function confirmDeleteAdopcion(adopcionId) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1e4183",
        cancelButtonColor: "rgb(255,127,80)",
        confirmButtonText: "Sí, eliminarlo!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + adopcionId).submit();
        }
    });
}

function confirmDeleteSolicitud(adopcionId, solicitudId) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#1e4183",
        cancelButtonColor: "rgb(255,127,80)",
        confirmButtonText: "Sí, eliminarlo!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + solicitudId).submit();
        }
    });
}
