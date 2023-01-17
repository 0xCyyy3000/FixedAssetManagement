// $(document).ready(function () {
//     $(document).on('click', '#edit-item-list', function () {
//         console.log(this.value);
//         $.ajax({
//             url: '/api/item-list/select/' + $(this).val(),
//             method: 'GET',
//             dataType: 'JSON',
//             data: {
//                 _token: '{{csrf_token()}}',
//                 id: $(this).val()
//             },
//             success: function (response) {
//                 console.table(response);
//                 $('#transaction_number').val(response.transaction_number);
//                 $('#date').val(response.purchase_date);
//                 $('#price').val(response.purchase_price);
//                 $('#inventory_number').val(response.inventory_number);
//                 $('#type').val(response.type);
//                 $('#salvage_value').val(response.salvage_value);
//                 $('#serial_number').val(response.serial_number);
//                 $('#classification').val(response.classification);
//                 $('#lifespan').val(response.lifespan);
//                 $('#department').val(response.department);
//                 $('#qty').val(response.quantity);
//                 $('#operating_cost').val(response.annual_operating_cost);
//                 $('#year').val(response.year);
//                 $('#replacement_value').val(response.replacement_value);
//                 $('#title').val(response.title);
//                 $('#trade_in_value').val(response.trade_in_value);
//                 $('#body').val(response.body);
//                 $('#present_value').val(response.present_value);
//                 $('#comment').val(response.comments);
//                 $('#note').val(response.notes);

//             }
//         });
//     });
// });

// $('#updateForm').on('submit', function (e) {
//     e.preventDefault();
//     $.ajax({
//         type: 'POST',
//         url: '/update',
//         data: $('#updateForm').serialize(),
//         success: function (response) {
//             console.log(response);
//         }
//     });
// });

