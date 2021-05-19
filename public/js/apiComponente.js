// document.location.origin + '/gestion-vehiculos' + '/gestion-vehiculos'

document.addEventListener('DOMContentLoaded', function () {

    // datatables settings
    dtComponente = $('#dataTableComponente').DataTable({

        processing: true,
        serverSide: true,
        responsive: true,
        autoWidth: false,
        stateSave: true,

        ajax: "/componentes/",

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
function ajaxFormRegisterComponente(event) {

    event.preventDefault();
    document.getElementById("btnSaveComponente").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    const dataRegister = new FormData(formComponenteRegister);


    fetch(formComponenteRegister.action, {
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
                    dtComponente.draw();
                    document.getElementById("btnSaveComponente").value = "Enviar";
                    $('#formComponenteRegister').trigger("reset");
                    $('#modalComponenteRegister').modal('hide');
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formComponenteRegister.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnSaveComponente").value = "Enviar";
                })
            }
        })
        .catch(res => {
            (console.log('request failed', res))
        });
}




//Eliminar cliente
function eliminarComponente(ente_id) {
    toastr.options.preventDuplicates = true;
    toastr.warning("<br /><button class='btn btn-sm btn-danger m-1' type='button' value='yes'>Yes</button> <button class='btn btn-sm btn-dark m-1' type ='button'  value='no' > No </button>", 'Desea eliminar este elemento ?', {
        allowHtml: true,
        onclick: function (toast) {
            value = toast.target.value
            if (value == 'yes') {
                const url = '/componentes/' + ente_id
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
                                dtComponente.draw();
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
function editarComponente(ente_id) {
    const url = '/componentes/' + ente_id + '/edit'
    const formComponenteUpdate = document.getElementById('formComponenteUpdate');
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
                    formComponenteUpdate.id.value = success.id;
                    formComponenteUpdate.nombre.value = success.nombre;
                    formComponenteUpdate.descripcion.value = success.descripcion;
                    $('#modalComponenteUpdate').modal('show')
                });
            }
        })
        .catch(error => {
            console.log('request failed');
        });
};

//Envio de datos ajax a actualizar
function ajaxFormUpdateComponente(event) {
    event.preventDefault();

    const dataUpdate = new FormData(formComponenteUpdate);
    document.getElementById("btnUpdateComponente").value = "Enviando...";

    if (document.querySelector('.is-invalid')) {

        document.querySelector('.is-invalid').classList.remove('is-invalid');

    }

    fetch(formComponenteUpdate.action, {
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
                    dtComponente.draw();
                    $('#formComponenteUpdate').trigger("reset");
                    $('#modalComponenteUpdate').modal('hide');
                    document.getElementById("btnUpdateComponente").value = "Enviar";
                });
            } else {
                throw response.json().then(error => {
                    for (var clave in error.errors) {
                        let container = formComponenteUpdate.elements.namedItem(clave);
                        container.classList.add('is-invalid');
                        toastr.error(`<li> ${error.errors[clave]} </li>`);
                    }

                    document.getElementById("btnUpdateComponente").value = "Enviar";
                })
            }
        })
        .catch(error => {
            console.log('request failed');
        });
}
