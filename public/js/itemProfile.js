// window.onbeforeunload = function () {
//     return "Data will be lost if you leave the page, are you sure?";
// };

$(document).ready(function () {
    class Item {
        constructor(id, serial_no, lifespan, condition, location, color) {
            this.id = id
            this.serial_no = serial_no;
            this.lifespan = lifespan;
            this.condition = condition;
            this.location = location;
            this.color = color;
        }
    }
    let items = [];
    let editing = false;
    let currentId = 0;

    $(document).on('click', '#btn_serial', function (e) {
        e.preventDefault();

        // Adding the item to the items[] array
        if ($('#serial_no').val() && $('#lifespan').val()
            && $('#location').val() && $('#color').val()) {
            const existing = items[items.findIndex(item => item.id == $('#serial_no').val())];
            if (editing) {
                const selectedItem = items[items.findIndex(item => item.id == currentId)];
                selectedItem.id = $('#serial_no').val();
                selectedItem.serial_no = $('#serial_no').val();
                selectedItem.lifespan = $('#lifespan').val();
                selectedItem.condition = $('#condition').val();
                selectedItem.location = $('#location').val();
                selectedItem.color = $('#color').val();
            } else if (existing && !editing) {
                alert('Serial number must be unique!');
            }
            else {
                items.push(
                    new Item($('#serial_no').val(), $('#serial_no').val(), $('#lifespan').val(),
                        $('#condition').val(), $('#location').val(), $('#color').val())
                );
            }

            loadItems();
            resetFields();
        } else alert('Please provide the required fields!');
    });

    function loadItems() {
        let tableBody = document.getElementById('serials-table-body');
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
                        <td>${item.lifespan}</td>
                        <td>${item.location}</td>
                        <td>${item.color}</td>
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
        $('#serial_no').val('');
        $('#condition').val('Functional');
        $('#lifespan').val('');
        $('#location').val('');
        $('#color').val('');

        editing = false;
        $('#btn_serial').text('Add item');
        $('#btn_cancel').addClass('d-none');
    }

    $(document).on('click', '#sumbit-reg', function () {
        items.forEach(item => {
            let serial = `<input type="hidden" name="serials[]" value="${item.serial_no}">`;
            let condition = `<input type="hidden" name="conditions[]" value="${item.condition}">`;
            let lifespan = `<input type="hidden" name="lifespans[]" value="${item.lifespan}">`;
            let location = `<input type="hidden" name="locations[]" value="${item.location}">`;
            let color = `<input type="hidden" name="colors[]" value="${item.color}">`;
            let serialInput = document.getElementById('serial_input');
            serialInput.innerHTML += serial;
            serialInput.innerHTML += condition;
            serialInput.innerHTML += lifespan;
            serialInput.innerHTML += location;
            serialInput.innerHTML += color;
        });
        //     url: '/ProfileItem/store',
        //     method: 'POST',
        //     dataType: 'JSON',
        //     data: {
        //         _token: $('#token').val(),
        //         items: items,
        //         purchase_date: $('#purchase_date').val(),
        //         purchase_price: $('#purchase_price').val(),
        //         inventory_number: $('#inventory_number').val(),
        //         type: $('#type').val(),
        //         classification: $('#classification').val(),
        //         lifespan: $('#lifespan').val(),
        //         department: $('#department').val(),
        //         year: $('#year').val(),
        //         title: $('#title').val(),
        //         depreciation: $('#depreciation').val(),
        //         description: $('#description').val(),
        //         type: $('#condition').val(),
        //         notes: $('#notes').val(),
        //     },
        //     success: function (response) {
        //         if (response.status == 200) {
        //             alert('Item has been submitted!');
        //             location.reload();
        //         }
        //     }
        // });
    });

    $(document).on('click', '.edit', function () {
        $('#btn_cancel').removeClass('d-none');
        $('#btn_serial').text('Save changes');
        editing = true;
        currentId = $(this).val();
        const selectedItem = items[items.findIndex(item => item.id == currentId)];

        $('#serial_no').val(selectedItem.serial_no);
        $('#condition').val(selectedItem.condition);
        $('#lifespan').val(selectedItem.lifespan);
        $('#location').val(selectedItem.location);
        $('#color').val(selectedItem.color);
    });

    $(document).on('click', '#btn_cancel', function () {
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

});