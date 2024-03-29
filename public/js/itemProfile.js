// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(id, serial_no, condition, location, color, price, date, supplier, warranty, address, contact_no) {
            this.id = id
            this.serial_no = serial_no;
            this.condition = condition;
            this.location = location;
            this.color = color;
            this.price = price;
            this.date = date;
            this.supplier = supplier;
            this.warranty = warranty;
            this.address = address;
            this.contact_no = contact_no;
        }
    }
    let items = [];
    let editing = false;
    let currentId = 0;

    $(document).on('click', '#ip_btn_serial', function (e) {
        e.preventDefault();
        // Adding the item to the items[] array
        console.log($('#ip_serial_no').val());
        // console.log($('#ip_lifespan').val());
        console.log($('#ip_location').val());
        console.log($('#ip_color').val());
        console.log($('#ip_date').val());
        console.log($('#ip_warranty').val());
        console.log($('#ip_supplier').val());
        console.log($('#ip_condition').val());
        console.log($('#ip_address').val());
        console.log($('#ip_contact_no').val());
        if ($('#ip_serial_no').val()  && $('#ip_location').val() && $('#ip_color').val()
            && $('#ip_date').val() && $('#ip_warranty').val() && $('#ip_supplier').val() && $('#ip_contact_no').val() && $('#ip_address').val()) {
            let existing;
            const found = items[items.findIndex(item => item.id == $('#ip_serial_no').val())]
            items.length && found ? existing = true : existing = false;

            if (editing) {
                const selectedItem = items[items.findIndex(item => item.id == currentId)];
                selectedItem.id = $('#ip_serial_no').val();
                selectedItem.serial_no = $('#ip_serial_no').val();
                // selectedItem.lifespan = $('#ip_lifespan').val();
                selectedItem.condition = $('#ip_condition').val();
                selectedItem.location = $('#ip_location').val();
                selectedItem.date = $('#ip_date').val();
                selectedItem.warranty = $('#ip_warranty').val();
                selectedItem.supplier = $('#ip_supplier').val();
                selectedItem.color = $('#ip_color').val();
                selectedItem.price = $('#ip_price').val();
                selectedItem.supplier = $('#ip_address').val();
                selectedItem.supplier = $('#ip_contact_no').val();
            } else if (existing && !editing) {
                alert('Serial number must be unique!');
            }
            else {
                items.push(new Item($('#ip_serial_no').val(), $('#ip_serial_no').val(),
                    $('#ip_condition').val(), $('#ip_location').val(), $('#ip_color').val(), $('#ip_price').val(),
                    $('#ip_date').val(), $('#ip_supplier').val(), $('#ip_warranty').val(), $('#ip_address').val(), 
                    $('#ip_contact_no').val(),
                ));
            }

            console.log('clearing ' + $('#ip_serial_no').val() + '...');;
            $.ajax({
                url: '/api/barcode-scanner.php?action=destroy&data=' + $('#ip_serial_no').val(),
                type: 'GET',
                success: function (data) {
                    if (data) {
                        console.log(data);
                    }
                }
            });

            loadItems();
            resetFields();

        } else alert('Please provide the required fields!');
    });

    function loadItems() {
        let tableBody = document.getElementById('ip_serials-table-body');
        let color = '';
        tableBody.innerHTML = '';
        items.forEach(item => {
            item.condition.toUpperCase() == 'FUNCTIONAL' ? color = 'my-text-success' : color = 'text-danger';

            let template =
                `   <tr>
                        <td>${item.serial_no}</td>
                        <td>
                            <div class="d-flex align-items-center align-self-center">
                                <span
                                    class="material-icons-sharp fs-6 me-1 ${color}">
                                    circle
                                </span>
                                ${item.condition}
                            </div>
                        </td>
                        <td>${item.location}</td>
                        <td>${item.warranty}</td>
                        <td>${item.date}</>
                        <td>${item.color}</td>
                        <td>${item.price}</td>
                        <td>${item.supplier}</td>
                        <td>${item.address}</td>
                        <td>${item.contact_no}</td>
                        <td>
                            <div class="d-flex align-items-center gap-3"> 
                                <button type="button" class="p-0 btn px-3 rounded-3 bg-warning d-flex align-items-center edit"
                                value="${item.id}">
                                    <small class="text-white">Edit</small>
                                </button>
                                <button type="button" class="p-0 btn px-3 rounded-3 my-bg-danger d-flex align-items-center remove"
                                value="${item.id}">
                                    <small class="text-white">Remove</small>
                                </button>
                            </div>
                        </td>
                     </tr>
                `;
            tableBody.innerHTML += template;
        });
    }

    function resetFields() {
        $('#ip_serial_no').val('');
        $('#ip_condition').val('Functional');
        $('#ip_location').val('');
        $('#ip_color').val('');
        // $('#price').val('');

        editing = false;
        $('#ip_btn_serial').text('Add item');
        $('#ip_btn_cancel').addClass('d-none');
    }

    $(document).on('click', '#ip_sumbit-reg', function () {
        items.forEach(item => {
            let serial = `<input type="hidden" name="serials[]" value="${item.serial_no}">`;
            let condition = `<input type="hidden" name="conditions[]" value="${item.condition}">`;
            let location = `<input type="hidden" name="locations[]" value="${item.location}">`;
            let color = `<input type="hidden" name="colors[]" value="${item.color}">`;
            let price = `<input type="hidden" name="prices[]" value="${item.price}">`;
            let date = `<input type="hidden" name="date[]" value="${item.date}">`;
            let warranty = `<input type="hidden" name="warranty[]" value="${item.warranty}">`;
            let supplier = `<input type="hidden" name="supplier[]" value="${item.supplier}">`;
            let contact_no = `<input type="hidden" name="contact_no[]" value="${item.contact_no}">`;
            let address = `<input type="hidden" name="address[]" value="${item.address}">`;
            let serialInput = document.getElementById('ip_serial_input');
            serialInput.innerHTML += serial;
            serialInput.innerHTML += condition;
            serialInput.innerHTML += location;
            serialInput.innerHTML += color;
            serialInput.innerHTML += date;
            serialInput.innerHTML += warranty;
            serialInput.innerHTML += supplier;
            serialInput.innerHTML += price;
            serialInput.innerHTML += address;
            serialInput.innerHTML += contact_no;
        });
    });

    $(document).on('click', '.edit', function () {
        $('#ip_btn_cancel').removeClass('d-none');
        $('#ip_btn_serial').text('Save changes');
        editing = true;
        currentId = $(this).val();
        const selectedItem = items[items.findIndex(item => item.id == currentId)];

        $('#ip_serial_no').val(selectedItem.serial_no);
        $('#ip_condition').val(selectedItem.condition);
        $('#ip_location').val(selectedItem.location);
        $('#ip_date').val(selectedItem.date);
        $('#ip_warranty').val(selectedItem.warranty);
        $('#ip_supplier').val(selectedItem.supplier);
        $('#ip_color').val(selectedItem.color);
        $('#ip_price').val(selectedItem.price);
        $('#ip_contact_no').val(selectedItem.contact_no);
        $('#ip_address').val(selectedItem.address);
    });

    $(document).on('click', '#ip_btn_cancel', function () {
        resetFields();
    });

    $(document).on('click', '.remove', function () {
        currentId = $(this).val();
        const index = items.findIndex(item => item.id == currentId);
        if (index >= 0) {
            items.splice(index, 1);
        }

        loadItems()
        resetFields();
    });

    $(document).on('click', '#btn-listen', function () {
        $.ajax({
            url: '/api/barcode-scanner.php?action=get',
            type: 'GET',
            success: function (data) {
                if (data) {
                    console.log(data);
                    $('#ip_serial_no').val(data);
                } else {
                    console.log('listening...');
                    console.log('\n');
                    $.ajax(this);
                }
            }
        });
    })

});