function showErrorAlert(message) {
    Swal.fire({
        title: "¡Error!",
        text: "Primero debes subir una imagen.",
        icon: "error",
        confirmButtonColor: "#ff7f50",
    });
}

function confirmDeleteAdopcion(adopcionId) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        imageUrl: "/images/pensando.webp",
        imageWidth: 120,
        imageHeight: 120,
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
        imageUrl: "/images/pensando.webp",
        imageWidth: 120,
        imageHeight: 120,
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
