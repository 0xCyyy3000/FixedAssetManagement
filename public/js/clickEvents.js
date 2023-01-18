$(document).ready(function () {
    $(document).on('click', '#select-item', function () {
        let itemId = $(this).val();
        $.ajax({
            url: '/api/item-list/select/' + itemId,
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: itemId
            },
            success: function (response) {
                if (response.status == 200) {
                    window.location = '/ProfileItem/select/' + itemId;
                }

            }
        });
    });

    $(document).on('click', '#edit-item-profile', function () {
        let itemId = $(this).val();
        $.ajax({
            url: '/api/item-list/edit/' + itemId,
            method: 'GET',
            dataType: 'JSON',
            data: {
                id: itemId
            },
            success: function (response) {
                if (response.status == 200) {
                    $('#item_title').val(response.item.title);
                    $('#description').val(response.item.description);
                    $('#inventory_no').val(response.item.inventory_number);
                    $('#date').val(response.item.purchase_date);
                    $('#classification').val(response.item.classification);
                    $('#price').val(response.item.purchase_price);
                    $('#depreciation').val(response.item.depreciation);
                    $('#warranty').val(response.item.warranty);
                    $('#supplier').val(response.item.supplier);
                }
            }
        });
    });
});

