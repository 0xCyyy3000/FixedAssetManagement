// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    let editing = false;

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
    let items_repairs = [];

    $(document).on('click', '#add-item-repair', function (e) {
        e.preventDefault();

        // Validate inputs
        if (
            $('#repair_item option:selected').val() == '' ||
            $('#repair_serial_no option:selected').val() == '' ||
            $('#repair_description').val() == '' ||
            $('#repair_remarks').val() == '' ||
            $('#repair_cost').val() == ''
        ) {
            alert('Fields cannot be empty!');
            return;
        }

        // Adding the item to the items[] array
        if (!editing) {
            items_repairs.push(
                new Item(
                    $('#repair_item option:selected').val(), $('#repair_item option:selected').text(),
                    $('#repair_serial_no option:selected').val(), $('#repair_serial_no option:selected').text(),
                    $('#repair_description').val(), $('#repair_remarks').val(),
                    $('#repair_cost').val()
                )
            );
        } else {
            const selectedItem = items_repairs[items_repairs.findIndex(item => item.serial_id == $('#repair_serial_no').val())];
            selectedItem.description = $('#repair_description').val();
            selectedItem.remarks = $('#repair_remarks').val();
            selectedItem.cost = $('#repair_cost').val();
        }

        loadItems();
        resetFields();
        $('#cancel').click();
    });


    function loadItems() {
        let tableBody = document.getElementById('repair-items-table-body');
        tableBody.innerHTML = '';
        total = 0;

        items_repairs.forEach(items_repairs => {
            let template = `
                <tr>
                    <td>${items_repairs.item}</td>
                    <td>${items_repairs.serial_no}</td>
                    <td>${items_repairs.description}</td>
                    <td>${items_repairs.remarks}</td>
                    <td>₱${items_repairs.cost}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3"> 
                            <button type="button" class="p-0 btn px-3 rounded-3 bg-warning d-flex align-items-center repair_edit"
                            value="${items_repairs.serial_id}">
                                <small class="text-white">Edit</small>
                            </button>
                            <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center repair_remove"
                            value="${items_repairs.serial_id}">
                                <small class="text-white">Remove</small>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            total += parseInt(items_repairs.cost);
            tableBody.innerHTML += template;
        });

        $('#repair-items-total').removeClass('d-none');
        $('#repair-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#repair_item').prop('disabled', false);

        $('#repair_serial_no').val('');
        $('#repair_item').val('');
        $('#repair_description').val('');
        $('#repair_remarks').val('');
        $('#repair_cost').val('0');

        if (!editing) {
            $('#repair').empty().append('<option value=""></option>');
        }
    }

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
                $('#repair_serial_no').empty().append('<option value=""></option>');
                $.each(response.serials, function (index, item) {
                    // Only loading serials that is not found from the list
                    const currentSerial = item.id;
                    const exisiting_index = items_repairs.findIndex(item => item.serial_id == currentSerial);
                    if (exisiting_index == -1) {
                        let template = `<option value="${item.id}">${item.serial_no}</option>`;
                        $('#repair_serial_no').append(template);
                    }
                });
            }
        });
    });

    $(document).on('click', '.repair_edit', function () {
        const currentSerial = $(this).val();
        const selectedItem = items_repairs[items_repairs.findIndex(item => item.serial_id == currentSerial)];

        // Showing the modal
        $('#add-repair-request-item').click();

        // Setting the values
        $('#repair_item').val(selectedItem.id);
        $('#repair_item').prop('disabled', true);

        $('#repair_serial_no').empty().append('<option value="' + selectedItem.serial_id + '">' + selectedItem.serial_no + '</option>');
        $('#repair_description').val(selectedItem.description);
        $('#repair_remarks').val(selectedItem.remarks);
        $('#repair_cost').val(selectedItem.cost);

        editing = true;
    });

    $(document).on('click', '.repair_remove', function () {
        const currentSerial = $(this).val();
        const index = items_repairs.findIndex(item => item.serial_id == currentSerial);
        index >= 0 ? items_repairs.splice(index, 1) : '';
        loadItems();
    });

    $(document).on('click', '#add-repair-request-item', function () {
        // Making sure the fields are empty
        resetFields();
    });


    $(document).on('click', '#submit-repair', function () {
        if (items_repairs.length) {
            $.ajax({
                url: '/repair-request/store',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('#repair_token').val(),
                    items: items_repairs,
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