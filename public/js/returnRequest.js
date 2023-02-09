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
    let items_returns = [];

    $(document).on('click', '#add-item-return', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items_returns.push(
            new Item(
                $('#return_item option:selected').val(), $('#return_item option:selected').text(),
                $('#return_serial_no option:selected').val(), $('#return_serial_no option:selected').text(),
                $('#return_description').val(), $('#return_remarks').val(),
                $('#return_cost').val()
            )
        );

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        console.table(items_returns);
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
                        <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center remove"
                        value="${items_returns.id}">
                            <small class="text-white">Remove</small>
                        </button>
                    </div>
                </td>
                </tr>
            `;
            total += parseInt(items_returns.cost);
            tableBody.innerHTML += template;
            console.table(items_returns);
        });

        $('#return-items-total').removeClass('d-none');
        $('#return-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#return_serial_no').val('');
        $('#return_item').val('');
        $('#return_description').val('');
        $('#return_remarks').val('');
        $('#return_cost').val('0');
    }

    $(document).on('click', '.remove', function () {
        currentId = $(this).val();
        const index = items_returns.findIndex(items_returns => items_returns.id == currentId);
        if (index >= 0) {
            items_returns.splice(index, 1);
        }
    });

    // Cascading Select options
    // $(document).on('change', '#return_item', function () {
    //     // Terminating request if no selected item
    //     if ($(this).val() == '') {
    //         $('#return_serial_no').empty().append('<option></option>');
    //         return;
    //     }

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
            success: function(response) {
                $.each(response.serials, function(index, item) {
                    let template = `<option value="${item.id}">${item.serial_no}</option>`;
                    $('#return_serial_no').append(template);
                });
            }
        });
    //     $.ajax({
    //         url: '/api/serials/index/',
    //         method: 'GET',
    //         data: {
    //             reference_no: $(this).val()
    //         },
    //         success: function (response) {
    //             $('#return_serial_no').empty().append('<option></option>');
    //             response.forEach(item => {
    //                 let template = `<option value="${item.id}">${item.serial_no}</option>`;
    //                 $('#return_serial_no').append(template);
    //             });
    //         }
    //     });
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