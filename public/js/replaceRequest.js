// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    let editing = false;

    class Item {
        constructor(id, item, serial_id, serial_no, remarks, cost) {
            this.id = id;
            this.item = item;
            this.serial_id = serial_id;
            this.serial_no = serial_no;
            this.remarks = remarks;
            this.cost = cost;
        }
    }

    let total = 0;
    let items_replaces = [];

    $(document).on('click', '#add-item-replace', function (e) {
        e.preventDefault();

        // Validate inputs
        if (
            $('#replace_item option:selected').val() == '' ||
            $('#replace_serial_no option:selected').val() == '' ||
            $('#replace_remarks').val() == '' ||
            $('replace_cost').val() == ''
        ) {
            alert('Fields cannot be empty!');
            return;
        }

        // Adding the item to the items[] array
        if (!editing) {
            items_replaces.push(
                new Item(
                    $('#replace_item option:selected').val(), $('#replace_item option:selected').text(),
                    $('#replace_serial_no option:selected').val(), $('#replace_serial_no option:selected').text(),
                    $('#replace_remarks').val(),
                    $('#replace_cost').val()
                )
            );
        } else {
            const selectedItem = items_replaces[items_replaces.findIndex(item => item.serial_id == $('#replace_serial_no').val())];
            selectedItem.remarks = $('#replace_remarks').val();
            selectedItem.cost = $('#replace_cost').val();
        }

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        let tableBody = document.getElementById('replace-items-table-body');
        tableBody.innerHTML = '';
        total = 0;
        editing = false;

        items_replaces.forEach(items_replaces => {
            let template = `
                <tr>
                    <td>${items_replaces.item}</td>
                    <td>${items_replaces.serial_no}</td>
                    <td>${items_replaces.remarks}</td>
                    <td>₱${items_replaces.cost}</td>
                    <td>
                        <div class="d-flex align-items-center gap-3"> 
                            <button type="button" class="p-0 btn px-3 rounded-3 bg-warning d-flex align-items-center replace_edit"
                            value="${items_replaces.serial_id}">
                                <small class="text-white">Edit</small>
                            </button>
                            <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center replace_remove"
                            value="${items_replaces.serial_id}">
                                <small class="text-white">Remove</small>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            total += parseInt(items_replaces.cost);
            tableBody.innerHTML += template;
        });

        $('#replace-items-total').removeClass('d-none');
        $('#replace-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#replace_item').prop('disabled', false);

        $('#replace_serial_no').val('');
        $('#replace_item').val('');
        $('#replace_remarks').val('');
        $('#replace_cost').val('1');

        if (!editing) {
            $('#replace_serial_no').empty().append('<option value=""></option>');
        }
    }

    $(document).on('change', '#replace_item', function () {
        // Terminating request if no selected item
        if ($(this).val() == '') {
            $('#replace_serial_no').empty().append('<option value=""></option>');
            return;
        }

        $.ajax({
            url: '/api/serials/index/',
            method: 'GET',
            data: {
                reference_no: $(this).val()
            },
            success: function (response) {
                $('#replace_serial_no').empty().append('<option value=""></option>');
                $.each(response.serials, function (index, item) {
                    // Only loading serials that is not found from the list
                    const currentSerial = item.id;
                    const exisiting_index = items_replaces.findIndex(item => item.serial_id == currentSerial);
                    if (exisiting_index == -1) {
                        let template = `<option value="${item.id}">${item.serial_no}</option>`;
                        $('#replace_serial_no').append(template);
                    }
                });
            }
        });
    });

    $(document).on('click', '#submit-replace', function () {
        if (items_replaces.length) {
            $.ajax({
                url: '/replace-request/store',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: $('#replace_token').val(),
                    items: items_replaces,
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
                        alert('Replace Request has been submitted!');
                        location.reload();
                    }
                }
            });
        }
    });

    $(document).on('click', '#delete-replace', function () {
        $('#replace_remove_id').val($(this).val());
    });

    $(document).on('click', '.replace_edit', function () {
        const currentSerial = $(this).val();
        const selectedItem = items_replaces[items_replaces.findIndex(item => item.serial_id == currentSerial)];

        // Showing the modal
        $('#add-item-request').click();

        // Setting the values
        $('#replace_item').val(selectedItem.id);
        $('#replace_item').prop('disabled', true);

        $('#replace_serial_no').empty().append('<option value="' + selectedItem.serial_id + '">' + selectedItem.serial_no + '</option>');
        $('#replace_remarks').val(selectedItem.remarks);
        $('#replace_cost').val(selectedItem.cost);

        editing = true;
    });

    $(document).on('click', '.replace_remove', function () {
        const currentSerial = $(this).val();
        const index = items_replaces.findIndex(item => item.serial_id == currentSerial);
        index >= 0 ? items_replaces.splice(index, 1) : '';
        loadItems();
    });

    $(document).on('click', '#add-item-request', function () {
        // Making sure the fields are empty
        resetFields();
    });
});