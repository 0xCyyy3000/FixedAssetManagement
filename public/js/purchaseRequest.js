// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(item, description, qty, price, total) {
            this.item = item;
            this.description = description;
            this.qty = qty;
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
                $('#item').val(), $('#description').val(),
                $('#qty').val(), $('#price').val(), $('#total').val()
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
                    <td>${item.item}</td>
                    <td>${item.description}</td>
                    <td>${item.qty}x</td>
                    <td>₱${item.price}</td>
                    <td>₱${item.total}</td>
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
        $('#item').val('');
        $('#description').val('');
        $('#qty').val('');
        $('#price').val('');
        $('#total').val('')
    }

    // Computing Total Amount on Price input
    $(document).on('input', '#price', function () {
        if ($('#qty').val())
            $('#total').val($(this).val() * $('#qty').val());
    });

    $(document).on('input', '#qty', function () {
        if ($('#price').val())
            $('#total').val($('#price').val() * $(this).val());
    });

    $(document).on('click', '#submit-purchase', function () {
        console.log('hi this is purchase request!');
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