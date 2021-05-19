// document.location.origin + '/gestion-vehiculos' + '/gestion-vehiculos'

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    dtFallaFuncional = $('#dataTableFallaFuncional').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,

        ajax: "/falla-funcionals/",

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
function ajaxFormRegisterFallaFuncional(event) {

    event.preventDefault();
    document.getElementById("btnSaveFallaFuncional").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    const dataRegister = new FormData(formFallaFuncionalRegister);


    fetch(formFallaFuncionalRegister.action, {
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
                    dtFallaFuncional.draw();
                    document.getElementById("btnSaveFallaFuncional").value = "Enviar";
                    $('#formFallaFuncionalRegister').trigger("reset");
                    $('#modalFallaFuncionalRegister').modal('hide');
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFallaFuncionalRegister.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnSaveFallaFuncional").value = "Enviar";
                })
            }
        })
        .catch(res => {
            (console.log('request failed', res))
        });
}




//Eliminar cliente
function eliminarFallaFuncional(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = '/falla-funcionals/' + ente_id
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
                                dtFallaFuncional.draw();
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
function editarFallaFuncional(ente_id) {
    const url = '/falla-funcionals/' + ente_id + '/edit'
    const formFallaFuncionalUpdate = document.getElementById('formFallaFuncionalUpdate');
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
                    formFallaFuncionalUpdate.id.value = success.id;
                    formFallaFuncionalUpdate.nombre.value = success.nombre;
                    formFallaFuncionalUpdate.descripcion.value = success.descripcion;
                    $('#modalFallaFuncionalUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

//Envio de datos ajax a actualizar
function ajaxFormUpdateFallaFuncional(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formFallaFuncionalUpdate);
    document.getElementById("btnUpdateFallaFuncional").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    fetch(formFallaFuncionalUpdate.action, {
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
                    dtFallaFuncional.draw();
                    $('#formFallaFuncionalUpdate').trigger("reset");
                    $('#modalFallaFuncionalUpdate').modal('hide');
                    document.getElementById("btnUpdateFallaFuncional").value = "Enviar";
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formFallaFuncionalUpdate.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnUpdateFallaFuncional").value = "Enviar";
                })
            }
        })
        .catch(error => {
            console.log('request failed');
        });
}
