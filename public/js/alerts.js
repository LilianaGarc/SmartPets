function showErrorAlert(message) {
    Swal.fire({
        title: "¡Error!",
        text: "No puedes subir más de 4 imágenes.",
        icon: "error",
        confirmButtonColor: "#e3e3e3",
        locale: 'es'
    });
}

function validateImages() {
    let imagenesSecundarias = document.getElementById('imagenes_secundarias').files;

    if (imagenesSecundarias.length > 4) {
        showErrorAlert("No puedes subir más de 4 imágenes.");
        return false;
    }

    return true;
}



function confirmDeleteAdopcion(adopcionId) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡No podrás revertir esto!",
        imageUrl: "/images/pensando.webp",
        imageWidth: 120,
        imageHeight: 120,
        showCancelButton: true,
        confirmButtonColor: "#e3e3e3",
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
        confirmButtonColor: "#e3e3e3",
        cancelButtonColor: "rgb(255,127,80)",
        confirmButtonText: "Sí, eliminarlo!"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + solicitudId).submit();
        }
    });
}

function confirmarAceptarSolicitud(adopcionId, solicitudId) {
    let mensaje = "¿Aceptar esta solicitud?";
    let descripcion = "Se notificará al dueño de esta solicitud mediante un correo electrónico.";

    if (yaHayAceptada) {
        descripcion = "La solicitud actualmente aceptada volverá a estado pendiente.";
    }

    Swal.fire({
        title: mensaje,
        text: descripcion,
        imageUrl: "/images/pensando.webp",
        showCancelButton: true,
        confirmButtonText: 'Sí, aceptar',
        confirmButtonColor: "#e3e3e3",
        cancelButtonColor: "rgb(255,127,80)",
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-aceptar-' + solicitudId).submit();
        }
    });
}

function confirmarCancelarSolicitud(adopcionId, solicitudId) {
    Swal.fire({
        title: "¿Cancelar solicitud aceptada?",
        text: "La solicitud aceptada volverá a estado pendiente.",
        imageUrl: "/images/pensando.webp",
        imageWidth: 100,
        imageHeight: 100,
        showCancelButton: true,
        confirmButtonColor: "#e3e3e3",
        cancelButtonColor: "rgb(255,127,80)",
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('form-cancelar-' + solicitudId).submit();
        }
    });
}


