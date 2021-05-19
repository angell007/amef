(function inicio() {
    const formRegister = document.querySelector('#formRepuestoUpdate')
    const vBIva = formRegister.querySelector('[name=valor_before_iva]')
    const impuesto = formRegister.querySelector('[name=impuesto]')
    const costoIn = formRegister.querySelector('[name=costo_in]')
    const cantidad = formRegister.querySelector('[name=cantidad]')
    const costo_total = formRegister.querySelector('[name=costo_total]')
    let iva = 0;

    vBIva.addEventListener('keyup', calcular)
    impuesto.addEventListener('keyup', calcular)
    cantidad.addEventListener('keyup', calcular)

    vBIva.addEventListener('change', calcular)
    impuesto.addEventListener('change', calcular)
    cantidad.addEventListener('change', calcular)

    function calcular() {

        if (isNaN(vBIva) && isNaN(impuesto) && isNaN(cantidad)) {
            iva = parseFloat(impuesto.value / 100)
            costoIn.value = (parseFloat(vBIva.value) + parseFloat(iva * vBIva.value))
            costo_total.value = parseFloat(cantidad.value * costoIn.value)
        }
    }
})()