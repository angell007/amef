// document.location.origin + '/gestion-vehiculos' + '/gestion-vehiculos'

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    dtParte = $('#dataTableParte').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,

        ajax: "/partes/",

        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex',
            orderable: false,
            searchable: false
        },
        {
            data: 'nombre',
            name: 'nombre'
        },
        {
            data: 'descripcion',
            name: 'descripcion'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false
        },
        ],
        order: [
            [0, 'asc']
        ]

    });

});


//Envio de datos ajax
function ajaxFormRegisterParte(event) {

    event.preventDefault();
    document.getElementById("btnSaveParte").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    const dataRegister = new FormData(formParteRegister);


    fetch(formParteRegister.action, {
        method: 'POST',
        body: dataRegister,
        mode: "cors",
        headers: {
            accept: "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success:', success);
                    dtParte.draw();
                    document.getElementById("btnSaveParte").value = "Enviar";
                    $('#formParteRegister').trigger("reset");
                    $('#modalParteRegister').modal('hide');
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formParteRegister.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnSaveParte").value = "Enviar";
                })
            }
        })
        .catch(res => {
            (console.log('request failed', res))
        });
}




//Eliminar cliente
function eliminarParte(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = '/partes/' + ente_id
                fetch(url, {
                    method: 'DELETE',
                    mode: "cors",
                    headers: {
                        accept: "application/json",
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                    .then(response => {
                        if (response.ok) {
                            response.text().then(success => {
                                dtParte.draw();
                                toastr.remove()
                                toastr.info('Success:', success);
                            });
                        }
                    })
                    .catch(error => {
                        console.log('request failed');
                    });
            } else {
                toastr.remove()
            }
        }
    });
}

// Traer datos de cliente
function editarParte(ente_id) {
    const url = '/partes/' + ente_id + '/edit'
    const formParteUpdate = document.getElementById('formParteUpdate');
    fetch(url, {
        method: 'GET',
        mode: "cors",
        headers: {
            accept: "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        .then(response => {
            if (response.ok) {
                response.json().then(success => {
                    console.log(success);
                    formParteUpdate.id.value = success.id;
                    formParteUpdate.nombre.value = success.nombre;
                    formParteUpdate.descripcion.value = success.descripcion;
                    $('#modalParteUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

//Envio de datos ajax a actualizar
function ajaxFormUpdateParte(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formParteUpdate);
    document.getElementById("btnUpdateParte").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    fetch(formParteUpdate.action, {
        method: 'POST',
        body: dataUpdate,
        mode: "cors",
        headers: {
            accept: "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
        .then(response => {
            if (response.ok) {
                response.text().then(success => {
                    toastr.info('Success:', success);
                    dtParte.draw();
                    $('#formParteUpdate').trigger("reset");
                    $('#modalParteUpdate').modal('hide');
                    document.getElementById("btnUpdateParte").value = "Enviar";
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formParteUpdate.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnUpdateParte").value = "Enviar";
                })
            }
        })
        .catch(error => {
            console.log('request failed');
        });
}
