$(document).ready(function () {
    // this variable is from the script of layout blade
    if (hasErrors) {
        $('#staticBackdrop5').modal('show');
    }

    $(document).on('click', '.edit-serial', function () {
        $.ajax({
            url: '/api/serial/select/' + $(this).val(),
            method: 'GET',
            data: {
                id: $(this).val()
            },
            success: function (response) {
                $('#serial-id').val(response.id);
                $('#edit-serial_no').val(response.serial_no);
                $('#edit-condition').val(response.condition);
                $('#edit-color').val(response.color);
                $('#edit-location').val(response.location);
                $('#edit-lifespan').val(response.lifespan);
                $('#edit-price').val(response.price);
                $('#edit-date').val(response.date);
                $('#edit-warranty').val(response.warranty);
                $('#edit-supplier').val(response.supplier);
                $('#staticBackdrop6').modal('show');
            }
        });
    });

    $(document).on('click', '.remove-serial', function () {
        $('#remove-serial-id').val($(this).val());
        $('#staticBackdrop7').modal('show');
    });
});