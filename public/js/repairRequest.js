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

    $(document).on('click', '#add-item-repair', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items.push(
            new Item(
                $('#repair_item option:selected').val(), $('#repair_item option:selected').text(),
                $('#repair_serial_no option:selected').val(), $('#repair_serial_no option:selected').text(),
                $('#repair_description').val(), $('#repair_remarks').val(),
                $('#repair_cost').val()
            )
        );

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        console.table(items);
        let tableBody = document.getElementById('repair-items-table-body');
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

        $('#repair-items-total').removeClass('d-none');
        $('#repair-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#repair_serial_no').val('');
        $('#repair_item').val('');
        $('#repair_description').val('');
        $('#repair_remarks').val('');
        $('#repair_cost').val('0');
    }

    // Cascading Select options
    $(document).on('change', '#repair_item', function () {
        // Terminating request if no selected item
        if ($(this).val() == '') {
            $('#repair_serial_no').empty().append('<option></option>');
            return;
        }

        $.ajax({
            url: '/api/serials/index/',
            method: 'GET',
            data: {
                reference_no: $(this).val()
            },
            success: function (response) {
                $('#repair_serial_no').empty().append('<option></option>');
                response.forEach(item => {
                    let template = `<option value="${item.id}">${item.serial_no}</option>`;
                    $('#repair_serial_no').append(template);
                });
            }
        });
    });

    $(document).on('click', '#submit-repair', function () {
        if (items.length) {
            $.ajax({
                url: '/repair-request/store',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('#repair_token').val(),
                    items: items,
                    entity: $('#entity').val(),
                    fund_cluster: $('#fund_cluster').val(),
                    repair_date: $('#repair_date').val(),
                    section: $('#section').val(),
                    appendix_no: $('#appendix_no').val(),
                    note: $('#note').val(),
                    status: $('#status').val(),
                    amount: total
                },
                success: function (response) {
                    if (response.status == 200) {
                        alert('Repair Request has been submitted!');
                        location.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '#delete-repair', function () {
        $('#repair_remove_id').val($(this).val());
    });
});