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
    let items_repairs = [];

    $(document).on('click', '#add-item-repair', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items_repairs.push(
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
        console.table(items_repairs);
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
                </tr>
            `;
            total += parseInt(items_repairs.cost);
            tableBody.innerHTML += template;
            console.table(items_repairs);
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
    // $(document).on('change', '#repair_item', function () {
    //     // Terminating request if no selected item
    //     if ($(this).val() == '') {
    //         $('#repair_serial_no').empty().append('<option></option>');
    //         return;
    //     }

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
            success: function(response) {
                $.each(response.serials, function(index, item) {
                    let template = `<option value="${item.id}">${item.serial_no}</option>`;
                    $('#repair_serial_no').append(template);
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
    //             $('#repair_serial_no').empty().append('<option></option>');
    //             response.forEach(item => {
    //                 let template = `<option value="${item.id}">${item.serial_no}</option>`;
    //                 $('#repair_serial_no').append(template);
    //             });
    //         }
    //     });
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