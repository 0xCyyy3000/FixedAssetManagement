// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(id, item, serial_id, serial_no, description, remarks, cost) {
            this.id = id;
            this.item = item;
            this.serial_id = serial_id;
            this.serial_no = serial_no;
            this.description = description;
            this.remarks = remarks;
            this.cost = cost;
        }
    }

    let total = 0;
    let items = [];

    $(document).on('click', '#add-item-purchase', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items.push(
            new Item(
                $('#purchase_item option:selected').val(), $('#purchase_item option:selected').text(),
                $('#purchase_serial_no option:selected').val(), $('#purchase_serial_no option:selected').text(),
                $('#purchase_description').val(), $('#purchase_remarks').val(),
                $('#purchase_cost').val()
            )
        );

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        console.table(items);
        let tableBody = document.getElementById('purchase-items-table-body');
        tableBody.innerHTML = '';
        total = 0;

        items.forEach(item => {
            let template = `
                <tr>
                    <td>${item.item}</td>
                    <td>${item.serial_no}</td>
                    <td>${item.description}</td>
                    <td>${item.remarks}</td>
                    <td>₱${item.cost}</td>
                </tr>
            `;
            total += parseInt(item.cost);
            tableBody.innerHTML += template;
            console.table(item);
        });

        $('#purchase-items-total').removeClass('d-none');
        $('#purchase-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#purchase_serial_no').val('');
        $('#purchase_item').val('');
        $('#purchase_description').val('');
        $('#purchase_remarks').val('');
        $('#purchase_cost').val('0');
    }

    // Cascading Select options
    $(document).on('change', '#purchase_item', function () {
        // Terminating request if no selected item
        if ($(this).val() == '') {
            $('#purchase_serial_no').empty().append('<option></option>');
            return;
        }

        $.ajax({
            url: '/api/serials/index/',
            method: 'GET',
            data: {
                reference_no: $(this).val()
            },
            success: function (response) {
                $('#purchase_serial_no').empty().append('<option></option>');
                response.forEach(item => {
                    let template = `<option value="${item.id}">${item.serial_no}</option>`;
                    $('#purchase_serial_no').append(template);
                });
            }
        });
    });

    $(document).on('click', '#submit-purchase', function () {
        if (items.length) {
            $.ajax({
                url: '/purchase-request/store',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('#purchase_token').val(),
                    items: items,
                    entity: $('#entity').val(),
                    fund_cluster: $('#fund_cluster').val(),
                    purchase_date: $('#purchase_date').val(),
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
        }
    });

    $(document).on('click', '#delete-purchase', function () {
        $('#purchase_remove_id').val($(this).val());
    });
});