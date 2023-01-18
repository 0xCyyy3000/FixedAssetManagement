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
        if ($('#serial_no').val()) {
            items.push(new Item($('#serial_no').val()));
            console.table(items);

            loadItems();
            resetFields();
        }
    });

    function loadItems() {
        let tableBody = document.getElementById('serials-table-body');
        tableBody.innerHTML = '';
        console.log('hello');
        items.forEach(item => {
            let template =
                `   <tr>
                        <td>${item.serial_no}</td>
                     </tr>
                `;
            tableBody.innerHTML += template;
        });
    }

    function resetFields() {
        $('#serial_no').val('');
    }


    $(document).on('click', '#sumbit-reg', function () {
        items.forEach(item => {
            let serial = `<input type="hidden" name="serials[]" value="${item.serial_no}">`;
            let serialInput = document.getElementById('serial_input');
            serialInput.innerHTML += serial;
        });
        //     url: '/ProfileItem/store',
        //     method: 'POST',
        //     dataType: 'JSON',
        //     data: {
        //         _token: $('#token').val(),
        //         items: items,
        //         purchase_date: $('#purchase_date').val(),
        //         purchase_price: $('#purchase_price').val(),
        //         inventory_number: $('#inventory_number').val(),
        //         type: $('#type').val(),
        //         classification: $('#classification').val(),
        //         lifespan: $('#lifespan').val(),
        //         department: $('#department').val(),
        //         year: $('#year').val(),
        //         title: $('#title').val(),
        //         depreciation: $('#depreciation').val(),
        //         description: $('#description').val(),
        //         type: $('#condition').val(),
        //         notes: $('#notes').val(),
        //     },
        //     success: function (response) {
        //         if (response.status == 200) {
        //             alert('Item has been submitted!');
        //             location.reload();
        //         }
        //     }
        // });
    });
});