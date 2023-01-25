// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(serial_no, item, description,  remarks, price, total) {
            this.serial_no = serial_no;
            this.item = item;
            this.description = description;
            this.remarks = remarks;
            this.price = price;
            this.total = total;
        }
    }

    let total = 0;
    let items = [];
    $(document).on('click', '#submit_item', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items.push(
            new Item(
                $('#serial_no').val(), $('#item').val(),
                $('#description').val(), $('#remarks').val(),
                $('#price').val(), $('#total').val()
            )
        );

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        let tableBody = document.getElementById('items-table-body');
        tableBody.innerHTML = '';
        total = 0;
        items.forEach(item => {
            let template = `
                <tr>
                    <td>${item.serial_no}</td>
                    <td>${item.item}</td>
                    <td>${item.description}</td>
                    <td>${item.remarks}</td>
                    <td>${item.price}</td>
                    <td>${item.total}</td>
                </tr>
            `;
            total += parseInt(item.total);
            tableBody.innerHTML += template;
            console.table(item);
        });

        $('#items-total').removeClass('d-none');
        $('#items-total').text('Total: ₱' + total);
        $('#total-amount').val(total);
    }

    function resetFields() {
        $('#serial_no').val('');
        $('#item').val('');
        $('#description').val('');
        $('#remarks').val('');
        $('#price').val('');
        $('#total-amount').val('')
    }

    // Computing Total Amount on Price input
    $(document).on('input', '#price', function () {
        $('#total').val($('#price').val() * $(this).val())
    });

    $(document).on('click', '#sumbit-purchase', function () {
        $.ajax({
            url: '/purchase-request/store',
            method: 'POST',
            dataType: 'JSON',
            data: {
                _token: $('#token').val(),
                items: items,
                entity: $('#entity').val(),
                fund_cluster: $('#fund_cluster').val(),
                replace_date: $('#replace_date').val(),
                section: $('#section').val(),
                appendix_no: $('#appendix_no').val(),
                note: $('#note').val(),
                status: $('#status').val(),
                amount: total
            },
            success: function (response) {
                if (response.status == 200) {
                    alert('Purchase Request has been submitted!');
                    location.reload();
                }
            }
        });
    });
});