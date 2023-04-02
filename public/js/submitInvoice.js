const myForm = document.getElementById("form-1");
myForm.addEventListener("submit", function (e) {
    e.preventDefault();
    var isValid = true;
    // get input form form-1 except for id #note
    var inputs = document.querySelectorAll(
        "#form-1 input:not([id^='note-'],#discount_value, #form-1 select)");
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].value == "") {
            isValid = false;
            console.log(inputs[i]);
        }
    }
    if (isValid) {
        myForm.method = "POST";
        myForm.action = "api/invoices/create_invoice";



        // get selected select2 #customer 
        var customer = $('#customer').val();
        var address = $('#address').val();
        var quotations = $('#quot').val();
        var notes = $('#notes').val();
        var title = $('#title').val();
        var status = $('#status').val();
        var inv_date = $('#inv_date').val();
        var job_date = $('#job_date').val();
        var due_date = $('#due_date').val();
        var sub_total = parseFloat($('#sub_total_header').val().replace(
            /[^0-9\-]+/g,
            ""));
        var sub_discount_value = parseFloat($('#sub_discount_header').val().replace(
            /[^0-9\-]+/g,
            ""));
        var grand_total = parseFloat($('#grand_total_header').val().replace(
            /[^0-9\-]+/g,
            ""));
        var discount_type = $('#discount_type').val();
        var discount_value = 0;
        var discount = 0;
        if ($('#discount_type').val() == 'total') {
            discount_value = parseFloat($('#discount_value_header').val().replace(
                /[^0-9\-]+/g,
                ""));
            discount = discount_value / (discount_value + grand_total);
        } else if ($('#discount_type').val() == 'percent') {
            discount = parseFloat($('#set_discount_value').val());
            discount_value = (discount / 100) * grand_total;
        }

        // convert string date to date
        // var inv_date = new Date(inv_date);
        // var job_date = new Date(job_date);
        // var due_date = new Date(due_date);


        var myJson = {
            "requestoremail": "benfany.aditia@gmail.com",
            "customer": customer,
            "address": address,
            "quotations": quotations,
            "notes": notes,
            "title": title,
            "status": status,
            "inv_date": inv_date,
            "job_date": job_date,
            "due_date": due_date,
            "sub_total": sub_total,
            "sub_discount_value": sub_discount_value,
            "discount_type": discount_type,
            "discount_value": discount_value,
            "discount": discount,
            "grand_total": grand_total,
            "data": []
        };

        var data = [];
        var cardIds = [];
        // get how many id^=card- in #mainContainer save in array 
        $('#mainContainer [id^="card-"]').each(function () {
            cardIds.push($(this).attr('id'));
        });
        // console.log(cardIds);

        // get data from each card
        for (var i = 0; i < cardIds.length; i++) {
            var card = $('#' + cardIds[i]);
            var subData = {
                "sub_title": card.find('#sub_title').val(),
                "sub_id": cardIds[i],
                "details": []
            };
            var rowCount = card.find('tbody tr').length;
            if (rowCount > 0) {
                // get data from each row in table if #name is not empty
                card.find('tbody tr').each(function () {

                    var tr = $(this);
                    var item = {};
                    // id_item
                    item.id_item = tr.find('#id_item').val();

                    item.name = tr.find('#name').val();
                    item.type = tr.find('#type').val();
                    item.brand = tr.find('[id^="brand-"]').val();
                    item.price = parseFloat(tr.find('#price').val().replace(
                        /[^0-9\-]+/g,
                        ""));
                    item.qty = parseFloat(tr.find('#qty').val().replace(
                        /[^0-9\-]+/g,
                        ""));
                    item.unit = tr.find('[id^="unit-"]').val();
                    item.item_discount = parseFloat(tr.find('#item_discount').val());
                    item.ammount = parseFloat(tr.find('#ammount').val().replace(
                        /[^0-9\-]+/g,
                        ""));
                    // get summernote content
                    tr.find('#summernote').summernote('code') != "<p><br></p>" ? item
                        .note = tr.find(
                            '#summernote').summernote('code') : item.note = "";
                    // if item is not empty
                    if (item.name != '') {

                        subData.details.push(item);
                    }
                });
            }
            data.push(subData);


        }
        myJson.data = data;

        myJson.data = data;
        var data_json = JSON.stringify(myJson);
        console.log(data_json);

        const formData = new FormData(myForm);
        const xhr = new XMLHttpRequest();
        var token = "Bearer " + "{{ session()->get('tokenJwt') }}";
        // console.log(token);

        xhr.open(myForm.method, myForm.action);
        xhr.setRequestHeader("Authorization", "Bearer " +
            "{{ session()->get('tokenJwt') }}");

        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.send(data_json);
        // on sending show circular progress



        xhr.onload = function () {

            if (xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                console.log(response);

                // sweetalert2 on ok back to list
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(function () {
                    window.location.href = "/list_invoices";
                });



            } else {
                // alert response.message;
                console.log(xhr.responseText);
                // sweetalert2
                Swal.fire({
                    title: 'Error!',
                    text: xhr.responseText,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });

            }
        };




    } else {
        // show alert and tell whivh field is not valid
        Swal.fire({
            title: 'Error!',
            text: 'Please fill all required field',
            icon: 'error',
            confirmButtonText: 'Ok'
        });




    }
});
