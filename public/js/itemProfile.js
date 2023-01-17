// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(serial_no) {
            this.serial_no = serial_no;
        }
    }
    let items = [];
    $(document).on('click', '#btn_serial', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items.push(
            new Item(
                $('#serial_no').val()
            )
        );

        loadItems();
        resetFields();
    });

    function loadItems() {
        let tableBody = document.getElementById('items-table-body');
        tableBody.innerHTML = '';
        total = 0;
        items.forEach(item => {
                `
                <tr>
                    <td>${item.serial_no}</td>
                </tr>
            `;
        });
    }

    function resetFields() {
        $('#serial_no').val('');
    }


    $(document).on('click', '#sumbit-reg', function () {
        $.ajax({
            url: '/ProfileItem/store',
            method: 'POST',
            dataType: 'JSON',
            data: {
                _token: $('#token').val(),
                items: items,
                purchase_date: $('#purchase_date').val(),
                purchase_price: $('#purchase_price').val(),
                inventory_number: $('#inventory_number').val(),
                type: $('#type').val(),
                classification: $('#classification').val(),
                lifespan: $('#lifespan').val(),
                department: $('#department').val(),
                year: $('#year').val(),
                title: $('#title').val(),
                depreciation: $('#depreciation').val(),
                description: $('#description').val(),
                type: $('#condition').val(),
                notes: $('#notes').val(),
            },
            success: function (response) {
                if (response.status == 200) {
                    alert('Item has been submitted!');
                    location.reload();
                }
            }
        });
    });
});