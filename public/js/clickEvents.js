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
                    $('#classification').val(response.item.classification);
                    $('#price').val(response.item.purchase_price);
                    $('#depreciation').val(response.item.depreciation);
                }
            }
        });
    });

    $(document).on('change', '#thumbnail', function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-thumbnail').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('change', '#media1', function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-media1').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('change', '#media2', function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-media2').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });

    $(document).on('change', '#media3', function () {
        let reader = new FileReader();
        reader.onload = (e) => {
            $('#preview-media3').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
});

