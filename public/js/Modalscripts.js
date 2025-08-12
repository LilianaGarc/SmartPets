document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById("imageModal");
    var modalImg = document.getElementById("modalImage");
    var closeBtn = document.getElementsByClassName("close")[0];

    var images = document.querySelectorAll('.card-containerverX .adopcion-imgX');

    function openImageModal() {
        modal.style.display = "block";
    }

    images.forEach(function (image) {
        image.addEventListener('click', function () {
            modal.style.display = "block";
            modalImg.src = image.src;
        });
    });

    closeBtn.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    };
});

function pedirMotivoCancelar(idAdopcion, idSolicitud) {
    if (!document.getElementById('no-resize-style')) {
        const style = document.createElement('style');
        style.id = 'no-resize-style';
        style.textContent = `
            .swal2-textarea {
                resize: none !important;
            }
        `;
        document.head.appendChild(style);
    }

    Swal.fire({
        title: 'Cancelar solicitud aceptada',
        input: 'textarea',
        inputLabel: '¿Cuál es el motivo de la cancelación?',
        inputPlaceholder: 'Escribe aquí el motivo...',
        inputAttributes: {
            maxlength: 160
        },
        showCancelButton: true,
        confirmButtonText: 'Cancelar solicitud',
        cancelButtonText: 'Volver',
        cancelButtonColor: '#dcdcdc',
        confirmButtonColor: '#ff7f50',
        inputValidator: (value) => {
            if (!value) {
                return 'Debes escribir un motivo para poder cancelarla.';
            }
        }
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`motivo-cancelacion-${idSolicitud}`).value = result.value;
            document.getElementById(`form-cancelar-${idSolicitud}`).submit();
        }
    });
}
