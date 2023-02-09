// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    let editing = false;
    let selectedRow = 0;
    class Item {
        constructor(id, item, description, qty, price, total) {
            this.id = id;
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

        // Validate inputs
        if (
            $('#item').val() == '' ||
            $('#description').val() == '' ||
            $('#qty').val() == '' ||
            $('#price').val() == '' ||
            $('#total').val() == ''
        ) {
            alert('Fields cannot be empty!');
            return;
        }

        // Adding the item to the items[] array
        if (!editing) {
            const id = $('#item').val() + $('#description').val() + $('#qty').val() + $('#price').val() + $('#qty').val() + $('#total').val();
            items.push(
                new Item(
                    id, $('#item').val(), $('#description').val(), $('#qty').val(), $('#price').val(), $('#total').val()
                )
            );
        } else {
            const selectedItem = items[items.findIndex(item => item.id == selectedRow)];
            selectedItem.item = $('#item').val();
            selectedItem.description = $('#description').val();
            selectedItem.qty = $('#qty').val();
            selectedItem.price = $('#price').val();
            selectedItem.total = $('#total').val();
        }

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
                    <td>
                        <div class="d-flex align-items-center gap-3"> 
                            <button type="button" class="p-0 btn px-3 rounded-3 bg-warning d-flex align-items-center purchase_edit"
                            value="${item.id}">
                                <small class="text-white">Edit</small>
                            </button>
                            <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center purchase_remove"
                            value="${item.id}">
                                <small class="text-white">Remove</small>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            total += parseInt(item.total);
            tableBody.innerHTML += template;
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
        selectedRow = 0;

        editing = false;
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

    $(document).on('click', '.purchase_edit', function () {
        const currentItem = $(this).val();
        const selectedItem = items[items.findIndex(item => item.id == currentItem)];
        selectedRow = currentItem;

        // Showing the modal
        $('#add-purchase-request-item').click();

        // Setting the values
        $('#item').val(selectedItem.item);
        $('#description').val(selectedItem.description);
        $('#qty').val(selectedItem.qty);
        $('#price').val(selectedItem.price);
        $('#total').val(selectedItem.total);

        editing = true;
    });

    $(document).on('click', '.purchase_remove', function () {
        const currentItem = $(this).val();
        const index = items.findIndex(item => item.id == currentItem);
        index >= 0 ? items.splice(index, 1) : '';
        loadItems();
    });

    $(document).on('click', '#submit-purchase', function () {
        const itemsCount = items.length;
        if ($('#entity').val() == '' || $('#fund_cluster').val() == '' || $('#replace_date').val() == '' ||
            $('#section').val() == '' || $('#appendix_no').val() == '' || $('#note').val() == ''
        ) {
            alert('Fields cannot be empty!');
            return;
        } else if (itemsCount == 0) {
            alert('Items cannot be empty!');
            return;
        }

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