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
    let items_replaces = [];

    $(document).on('click', '#add-item-replace', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        items_replaces.push(
            new Item(
                $('#replace_item option:selected').val(), $('#replace_item option:selected').text(),
                $('#replace_serial_no option:selected').val(), $('#replace_serial_no option:selected').text(),
                $('#replace_description').val(), $('#replace_remarks').val(),
                $('#replace_cost').val()
            )
        );

        loadItems();
        resetFields();
        $('#cancel').click();
    });

    function loadItems() {
        console.table(items_replaces);
        let tableBody = document.getElementById('replace-items-table-body');
        tableBody.innerHTML = '';
        total = 0;

        items_replaces.forEach(items_replaces => {
            let template = `
                <tr>
                    <td>${items_replaces.item}</td>
                    <td>${items_replaces.serial_no}</td>
                    <td>${items_replaces.description}</td>
                    <td>${items_replaces.remarks}</td>
                    <td>₱${items_replaces.cost}</td>
                </tr>
            `;
            total += parseInt(items_replaces.cost);
            tableBody.innerHTML += template;
            console.table(items_replaces);
        });

        $('#replace-items-total').removeClass('d-none');
        $('#replace-items-total').text('Total cost: ₱' + total);
    }

    function resetFields() {
        $('#replace_serial_no').val('');
        $('#replace_item').val('');
        $('#replace_description').val('');
        $('#replace_remarks').val('');
        $('#replace_cost').val('0');
    }

    // Cascading Select options
    // $(document).on('change', '#replace_item', function () {
    //     // Terminating request if no selected item
    //     if ($(this).val() == '') {
    //         $('#replace_serial_no').empty().append('<option></option>');
    //         return;
    //     }

    $(document).on('change', '#replace_item', function () {
        // Terminating request if no selected item
        if ($(this).val() == '') {
            $('#replace_serial_no').empty().append('<option></option>');
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
                    $('#replace_serial_no').append(template);
                });
            }
        });

        // $.ajax({
        //     url: '/api/serials/index/',
        //     method: 'GET',
        //     data: {
        //         reference_no: $(this).val()
        //     },
        //     success: function (response) {
        //         $('#replace_serial_no').empty().append('<option></option>');
        //         response.forEach(item => {
        //             let template = `<option value="${item.id}">${item.serial_no}</option>`;
        //             $('#replace_serial_no').append(template);
        //         });
        //     }
        // });
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
});