// document.location.origin + '/gestion-vehiculos' + '/gestion-vehiculos'

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    dtFuncion = $('#dataTableFuncion').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,

        ajax: "/funcions/",

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
function ajaxFormRegisterFuncion(event) {

    event.preventDefault();
    document.getElementById("btnSaveFuncion").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    const dataRegister = new FormData(formFuncionRegister);


    fetch(formFuncionRegister.action, {
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
                    dtFuncion.draw();
                    document.getElementById("btnSaveFuncion").value = "Enviar";
                    $('#formFuncionRegister').trigger("reset");
                    $('#modalFuncionRegister').modal('hide');
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFuncionRegister.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnSaveFuncion").value = "Enviar";
                })
            }
        })
        .catch(res => {
            (console.log('request failed', res))
        });
}




//Eliminar cliente
function eliminarFuncion(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = '/funcions/' + ente_id
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
                                dtFuncion.draw();
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
function editarFuncion(ente_id) {
    const url = '/funcions/' + ente_id + '/edit'
    const formFuncionUpdate = document.getElementById('formFuncionUpdate');
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
                    formFuncionUpdate.id.value = success.id;
                    formFuncionUpdate.nombre.value = success.nombre;
                    formFuncionUpdate.descripcion.value = success.descripcion;
                    $('#modalFuncionUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

//Envio de datos ajax a actualizar
function ajaxFormUpdateFuncion(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formFuncionUpdate);
    document.getElementById("btnUpdateFuncion").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    fetch(formFuncionUpdate.action, {
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
                    dtFuncion.draw();
                    $('#formFuncionUpdate').trigger("reset");
                    $('#modalFuncionUpdate').modal('hide');
                    document.getElementById("btnUpdateFuncion").value = "Enviar";
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFuncionUpdate.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnUpdateFuncion").value = "Enviar";
                })
            }
        })
        .catch(error => {
            console.log('request failed');
        });
}
