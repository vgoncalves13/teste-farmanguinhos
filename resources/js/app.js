require('./bootstrap');
// Import sweetalert2
import Swal from 'sweetalert2';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



// Sweetalert2 to confirm delete button
const deleteButton = document.querySelectorAll('#delete-button');
deleteButton.forEach(button => {
    button.addEventListener('click', function() {
        Swal.fire({
            title: 'Tem certeza?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, delete isso!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deletado!',
                    'O usuário foi deletado.',
                    'success'
                )
                this.parentNode.submit();
            }
        })
    })
});
