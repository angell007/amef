// document.location.origin + '/gestion-vehiculos' + '/gestion-vehiculos'

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    dtFuncionSubsistema = $('#dataTableFuncionSubsistema').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,

        ajax: "/funcion-subsistemas/",

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
function ajaxFormRegisterFuncionSubsistema(event) {

    event.preventDefault();
    document.getElementById("btnSaveFuncionSubsistema").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    const dataRegister = new FormData(formFuncionSubsistemaRegister);


    fetch(formFuncionSubsistemaRegister.action, {
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
                    dtFuncionSubsistema.draw();
                    document.getElementById("btnSaveFuncionSubsistema").value = "Enviar";
                    $('#formFuncionSubsistemaRegister').trigger("reset");
                    $('#modalFuncionSubsistemaRegister').modal('hide');
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFuncionSubsistemaRegister.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnSaveFuncionSubsistema").value = "Enviar";
                })
            }
        })
        .catch(res => {
            (console.log('request failed', res))
        });
}




//Eliminar cliente
function eliminarFuncionSubsistema(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = '/funcion-subsistemas/' + ente_id
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
                                dtFuncionSubsistema.draw();
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
function editarFuncionSubsistema(ente_id) {
    const url = '/funcion-subsistemas/' + ente_id + '/edit'
    const formFuncionSubsistemaUpdate = document.getElementById('formFuncionSubsistemaUpdate');
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
                    formFuncionSubsistemaUpdate.id.value = success.id;
                    formFuncionSubsistemaUpdate.nombre.value = success.nombre;
                    formFuncionSubsistemaUpdate.descripcion.value = success.descripcion;
                    $('#modalFuncionSubsistemaUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

//Envio de datos ajax a actualizar
function ajaxFormUpdateFuncionSubsistema(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formFuncionSubsistemaUpdate);
    document.getElementById("btnUpdateFuncionSubsistema").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    fetch(formFuncionSubsistemaUpdate.action, {
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
                    dtFuncionSubsistema.draw();
                    $('#formFuncionSubsistemaUpdate').trigger("reset");
                    $('#modalFuncionSubsistemaUpdate').modal('hide');
                    document.getElementById("btnUpdateFuncionSubsistema").value = "Enviar";
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFuncionSubsistemaUpdate.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnUpdateFuncionSubsistema").value = "Enviar";
                })
            }
        })
        .catch(error => {
            console.log('request failed');
        });
}
