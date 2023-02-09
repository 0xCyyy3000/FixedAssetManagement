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
    let items_returns = [];

    $(document).on('click', '#add-item-return', function (e) {
        e.preventDefault();

        // Validate inputs
        if (
            $('#return_item option:selected').val() == '' ||
            $('#return_serial_no option:selected').val() == '' ||
            $('#return_description').val() == '' ||
            $('#return_remarks').val() == '' ||
            $('#return_cost').val() == ''
        ) {
            alert('Fields cannot be empty!');
            return;
        }

        // Adding the item to the items[] array
        if (!editing) {
            items_returns.push(
                new Item(
                    $('#return_item option:selected').val(), $('#return_item option:selected').text(),
                    $('#return_serial_no option:selected').val(), $('#return_serial_no option:selected').text(),
                    $('#return_description').val(), $('#return_remarks').val(),
                    $('#return_cost').val()
                )
            );
        } else {
            const selectedItem = items_returns[items_returns.findIndex(item => item.serial_id == $('#return_serial_no').val())];
            selectedItem.description = $('#return_description').val();
            selectedItem.remarks = $('#return_remarks').val();
            selectedItem.cost = $('#return_cost').val();
        }

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        let tableBody = document.getElementById('return-items-table-body');
        tableBody.innerHTML = '';
        total = 0;

        items_returns.forEach(items_returns => {
            let template = `
                <tr>
                    <td>${items_returns.item}</td>
                    <td>${items_returns.serial_no}</td>
                    <td>${items_returns.description}</td>
                    <td>${items_returns.remarks}</td>
                    <td>₱${items_returns.cost}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3"> 
                            <button type="button" class="p-0 btn px-3 rounded-3 bg-warning d-flex align-items-center return_edit"
                            value="${items_returns.serial_id}">
                                <small class="text-white">Edit</small>
                            </button>
                            <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center return_remove"
                            value="${items_returns.serial_id}">
                                <small class="text-white">Remove</small>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            total += parseInt(items_returns.cost);
            tableBody.innerHTML += template;
        });

        $('#return-items-total').removeClass('d-none');
        $('#return-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#return_item').prop('disabled', false);

        $('#return_serial_no').val('');
        $('#return_item').val('');
        $('#return_description').val('');
        $('#return_remarks').val('');
        $('#return_cost').val('0');

        if (!editing) {
            $('#return_serial_no').empty().append('<option value=""></option>');
        }
    }

    $(document).on('click', '.return_edit', function () {
        const currentSerial = $(this).val();
        const selectedItem = items_returns[items_returns.findIndex(item => item.serial_id == currentSerial)];

        // Showing the modal
        $('#add-return-request-item').click();

        // Setting the values
        $('#return_item').val(selectedItem.id);
        $('#return_item').prop('disabled', true);

        $('#return_serial_no').empty().append('<option value="' + selectedItem.serial_id + '">' + selectedItem.serial_no + '</option>');
        $('#return_description').val(selectedItem.description);
        $('#return_remarks').val(selectedItem.remarks);
        $('#return_cost').val(selectedItem.cost);

        editing = true;
    });

    $(document).on('click', '.return_remove', function () {
        const currentSerial = $(this).val();
        const index = items_returns.findIndex(item => item.serial_id == currentSerial);
        index >= 0 ? items_returns.splice(index, 1) : '';
        loadItems();
    });

    $(document).on('click', '#add-return-request-item', function () {
        // Making sure the fields are empty
        resetFields();
    });

    $(document).on('change', '#return_item', function () {
        // Terminating request if no selected item
        if ($(this).val() == '') {
            $('#return_serial_no').empty().append('<option></option>');
            return;
        }

        $.ajax({
            url: '/api/serials/index/',
            method: 'GET',
            data: {
                reference_no: $(this).val()
            },
            success: function (response) {
                $('#return_serial_no').empty().append('<option value=""></option>');
                $.each(response.serials, function (index, item) {
                    // Only loading serials that is not found from the list
                    const currentSerial = item.id;
                    const exisiting_index = items_returns.findIndex(item => item.serial_id == currentSerial);
                    if (exisiting_index == -1) {
                        let template = `<option value="${item.id}">${item.serial_no}</option>`;
                        $('#return_serial_no').append(template);
                    }
                });
            }
        });
    });

    $(document).on('click', '#submit-return', function () {
        if (items_returns.length) {
            $.ajax({
                url: '/return-request/store',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('#return_token').val(),
                    items: items_returns,
                    entity: $('#entity').val(),
                    fund_cluster: $('#fund_cluster').val(),
                    return_date: $('#return_date').val(),
                    section: $('#section').val(),
                    appendix_no: $('#appendix_no').val(),
                    note: $('#note').val(),
                    status: $('#status').val(),
                    amount: total
                },
                success: function (response) {
                    if (response.status == 200) {
                        alert('Return Request has been submitted!');
                        location.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '#delete-return', function () {
        $('#return_remove_id').val($(this).val());
    });
});