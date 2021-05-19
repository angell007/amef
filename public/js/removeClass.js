

// remove invalid style on input entry
$(document).on('keyup change', '.is-invalid', function () {
    let container = $(this).closest('.is-invalid-container');
    container.find('input, select, textarea').removeClass('is-invalid');
    container.removeClass('is-invalid-container');
    container.find('.invalid-feedback').remove();
});


