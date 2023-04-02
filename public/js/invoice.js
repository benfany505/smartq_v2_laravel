$(document).ready(function () {
    $('#discount_value_header').val(0);

    // #setDiscountButton on click
    $('#setDiscountButton').click(function () {

        if ($('#discount_type').val() == 'total') {
            // #discount_value == #set_discount_value
            $('#discount_value_header').val($('#set_discount_value').val());
            recalculateGt();
            $('#lableDiscount').text('Discount (IDR)');
        } else if ($('#discount_type').val() == 'percent') {
            $('#discount_value_header').val(0);
            recalculateGt();
            $('#lableDiscount').text('Discount (' + $('#set_discount_value').val() + '%)');
        } else {
            $('#discount_value_header').val(0);
            recalculateGt();
            $('#lableDiscount').text('Discount');
        }

    });

    $('#discount_type').change(function () {
        if ($(this).val() == 'percent') {
            $('#set_discount_value').val(0);
            $('#set_discount_value').prop('disabled', false);
            $('#set_discount_value').focus();
            // add #lableDiscount (%)

        } else if ($(this).val() == 'total') {
            $('#set_discount_value').val(0);
            $('#set_discount_value').prop('disabled', false);
            $('#set_discount_value').focus();

        } else if ($(this).val() == 'not_applied') {
            console.log('not_applied');
            $('#set_discount_value').prop('disabled', true);
            $('#set_discount_value').val('');

        }
    });

    // #discount_value only number
    $('#set_discount_value').keypress(function (e) {
        // allow number and dot only
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            // allow dot
            if (e.which == 46) {
                return true;
            } else {
                return false;
            }
        }

    });

    // #discount_value on keyup
    $('#set_discount_value').keyup(function () {
        if ($('#discount_type').val() == 'percent') {
            //    maximum 100
            if ($(this).val() > 100) {
                $(this).val(100);

            }

        } else if ($('#discount_type').val() == 'total') {
            var val = $(this).val();
            val = val.toString().replace(/,/g, "");
            val = val.split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1,');
            val = val.split('').reverse().join('').replace(/^[\,]/, '');
            $(this).val(val);



        }
    });

    $('#ribbon').hide();

    // add summernote to id hdeader and id footer
    $('#notes').summernote({
        placeholder: 'Enter your note here...',
        tabsize: 1,
        height: 100,
        autoHeight: true,
        disableDragAndDrop: true,
        lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4',
            '1.5', '2.0',
            '3.0'
        ],
        tabDisable: true,
        toolbar: [
            ['fontsize', ['fontsize']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['fullscreen', 'codeview']],
            ['insert', ['link', 'table', 'hr']],




        ]
    });

    $('#status').change(function () {
        if ($(this).val() == '') {
            $('#ribbon').hide();
        } else {
            $('#ribbon').hide();
            $('#ribbon').show('slow');
            // change to selected option text
            $('#ribbon').text($(this).find('option:selected').text());
            // check if selected text = 'published'
            if ($(this).find('option:selected').text() == 'Published') {
                $('#ribbon').addClass('bg-success');
                $('#ribbon').removeClass('bg-secondary');
            } else {
                $('#ribbon').addClass('bg-secondary');
                $('#ribbon').removeClass('bg-success');
            }



        }
    });

    var iCard = 0;
    // get brand list from api
    var brands = [];
    var units = [];
    var customers = [];
    var itemsAndServices = [];

    // ajax get with bearer token and params
    //   $customers = Customer::orderBy('name', 'asc')->get(); 

    // wait until all data is loaded

    $.ajax({
        url: "api/invoices/data",
        type: "GET",
        data: {
            "requestoremail": "{{ Auth::user()->email }}",

        },
        dataType: "json",
        beforeSend: function (xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " +
                "{{ session()->get('tokenJwt') }}");
        },

        success: function (response) {
            datas = response.data;
            console.log(datas);
            brands = datas.brands;
            units = datas.units;
            customers = datas.customers;
            itemsAndServices = datas.products;

            $.each(customers, function (index, value) {
                $('#customer').append(
                    '<option value="' + value.id + '">' + value.company + " | " +
                    value
                    .name + '</option>'
                );
            });

            $.each(itemsAndServices, function (index, value) {
                // check if value.id_item key is exist
                if (value.id_item == null) {
                    value.id_item = value.id_service

                }
                $('#table_find').append(
                    '<tr>' +
                    '<td>' + value.id_item + '</td>' +
                    '<td>' + value.name + '</td>' +
                    '<td>' + value.type + '</td>' +
                    '<td>' + value.brand + '</td>' +
                    '<td>' + value.price + '</td>' +
                    '<td>' + value.unit + '</td>' +
                    '<td class="text-center">' +
                    '<button class="btn btn-primary btn-xs" id="addClick" >Add</button>' +
                    '</td>' +
                    '</tr>'
                );

            });
            $('#table_find').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });



        },
        error: function (error) {
            console.log(error);
        }
    });




    // on select customer fill textarea with customer address
    $('#customer').on('change', function () {
        console.log($(this).val());
        var customer_id = $(this).val();
        var customer_address = '';
        $('#address').text("AAA");
        $.each(customers, function (index, value) {
            if (value.id == customer_id) {
                console.log('sama');
                customer_address += value.address + ", " + value.city + "\n";
                customer_address += value.state + ", " + value.country + ", " + value
                    .zip_code + "\n";
                customer_address += value.phone + " | " + value.email + "\n";
            }
        });
        $('#address').text(customer_address);

    });



    $('#add_sub').click(function (e) {
        e.preventDefault();
        iCard++;
        var summernoteCard =
            '<div class="card card-info " id="card-' + iCard + '">' +
            '                    <div class="card-header ">' +
            '                        <h3 class="card-title ">Invoice Details #' + iCard + ' </h3>' +
            '                    </div>' +
            '                    <div class="card-body " id="sub_items"> {{-- button add sub group --}} <div class="row ">' +
            '                            <div class="col-sm-12 table-responsive ">' +
            '                                <div class="row ">' +
            '                                    <div class="col-sm-5 mb-2 "> <input type="text " class="form-control form-control-sm "' +
            '                                            name="sub_title " id="sub_title" placeholder="Sub Title " required> </div>' +
            '                                    <div class="col-sm-4 mb-2  "> <button type="button " class="btn btn-sm btn-primary "' +
            '                                            id="add_blank_line-' + iCard +
            '"> <i class="      fas fa-plus "></i> Add Line' +
            '                                        </button>' +
            '                                        <button type="button " class="btn btn-sm btn-success " id="find_product-' +
            iCard + '"> <i' +
            '                                                class="fas fa-search "></i> Find Products </button> <button type="button "' +
            '                                            class="btn btn-sm btn-danger " id="delete_card-' +
            iCard + '"> <i' +
            '                                                class="fas fa-trash "></i>' +
            '                                            Remove Sub </button> {{-- delete --}}' +
            '                                    </div>' +
            '                                    {{-- sub total text right --}} {{-- small button add row --}}' +
            '                                </div>' +
            '                                <div class="row ">' +
            '                                    <div class="col-sm-12 ">' +
            '                                        <table class="table text-nowrap table-bordered table-striped table-sm " id="table-' +
            iCard + '">' +
            '                                            <thead class="table-primary ">' +
            '                                                <tr class="text-center ">' +
            '                                                    <th width="35% ">Name</th>' +
            '                                                    <th width="10% ">Type</th>' +
            '                                                    <th width="10% ">Brand</th>' +
            '                                                    <th width="10% ">Price (IDR)</th>' +
            '                                                    <th width="5% ">Qty</th>' +
            '                                                    <th width="5% ">Unit</th>' +
            '                                                    <th width="5% ">Disc(%)</th>' +
            '                                                    <th width="10% ">Amount (IDR)</th>' +
            '                                                </tr>' +
            '                                            </thead>' +
            '                                            <tbody>' +
            // '                                                <tr>' +
            // '                                                    <td style="vertical-align:top">' +
            // '                                                        <div class="input-group ">' +
            // '                                                            <div class="col m-0 p-0">' +
            // '                                                                <div class="input-group">' +
            // '                                                                    <button type="button " class="btn btn-danger btn-xs "' +
            // '                                                                        id="delete_row"><i' +
            // '                                                                            class="fa fa-trash text-xs "></i>' +
            // '                                                                    </button>' +
            // '                                                                    <input type="text "' +
            // '                                                                        class="form-control form-control-sm  " name="name "' +
            // '                                                                        id="name" placeholder="Name ">' +
            // '                                                                    <button type="button" class="btn btn-info btn-xs "' +
            // '                                                                        id="edit_note"><i id="icon_note"' +
            // '                                                                            class="fas fa-edit text-xs "></i>' +
            // '                                                                    </button>' +
            // '' +
            // '                                                                </div>' +
            // '' +
            // '                                                                {{-- summernote --}}' +
            // '                                                                <div class="row" id="note">' +
            // '                                                                    <div class="col-sm-12 ">' +
            // '                                                                        <textarea class="form-control" name="note " id="summernote" rows="3 " placeholder="Note" style="display: none;"></textarea>' +
            // '                                                                    </div>' +
            // '                                                                </div>' +
            // '' +
            // '' +
            // '' +
            // '                                                            </div>' +
            // '' +
            // '                                                        </div>' +
            // '                                                    </td>' +
            // '                                                    <td style="vertical-align:top"> <input type="text " class="form-control form-control-sm "' +
            // '                                                            name="name " id="type" placeholder="Type "> </td>' +
            // '                                                    <td style="vertical-align:top"> <Select class=" form-control form-control-sm " id="brand-' +
            // iCard + '">' +
            // '                                                            <option value=" "></option>' +
            // '                                                            <option value="BROCO ">BROCO</option>' +
            // '                                                            <option value="ETERNA ">ETERNA</option>' +
            // '                                                        </Select> </td>' +
            // '                                                    <td style="vertical-align:top"> <input type="text "' +
            // '                                                            class="form-control form-control-sm text-right " name="price "' +
            // '                                                            id="price" placeholder="Price " value="0 "> </td>' +
            // '                                                    <td style="vertical-align:top"> <input type="text "' +
            // '                                                            class="form-control form-control-sm text-right " name="qty"' +
            // '                                                            id="qty" placeholder="Qty " value="0 "> </td>' +
            // '                                                    <td style="vertical-align:top"> <Select class=" form-control form-control-sm " id="unit-' +
            // iCard + '">' +
            // '                                                            <option value=" "></option>' +
            // '                                                            <option value="BROCO ">pcs</option>' +
            // '                                                            <option value="ETERNA ">mtr</option>' +
            // '                                                            <option value="ETERNA ">roll</option>' +
            // '                                                        </Select> </td>' +
            // '                                                    <td style="vertical-align:top"> <input type="text "' +
            // '                                                            class="form-control form-control-sm text-right " name="item_discount "' +
            // '                                                            id="item_discount" placeholder="Disc " value="0 "> </td>' +
            // '                                                    <td style="vertical-align:top"> <input type="text "' +
            // '                                                            class="form-control form-control-sm text-right " name="ammount "' +
            // '                                                            id="ammount" placeholder="Amount " value="0 " disabled>' +
            // '                                                    </td>' +
            // '                                                </tr>' +
            '                                            </tbody> {{-- footer --}} {{-- tfoot without bo --}} <tfoot>' +
            '                                                <tr>' +
            '                                                    <td colspan="7 " class="text-right  ">Sub Total</td>' +
            '                                                    <td class="text-right "> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right "' +
            '                                                            name="sub_total " id="sub_total" placeholder="Sub Total "' +
            '                                                            value="0 " style="background-color: cyan; font-weight: bold "' +
            '                                                            disabled> </td>' +
            '                                                </tr>' +
            '                                                <tr>' +
            '                                                    <td colspan="7 " class="text-right ">Discount</td>' +
            '                                                    <td class="text-right "> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right "' +
            '                                                            name="sub_discount_value " id="sub_discount_value" placeholder="Discount "' +
            '                                                            value="0 " style="background-color: cyan; font-weight: bold "' +
            '                                                            disabled> </td>' +
            '                                                </tr>' +
            '                                                <tr>' +
            '                                                    <td colspan="7 " class="text-right ">Total</td>' +
            '                                                    <td class="text-right "> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right " name="total "' +
            '                                                            id="total" placeholder="Total " value="0 "' +
            '                                                            style="background-color: cyan; font-weight: bold " disabled>' +
            '                                                    </td>' +
            '                                                </tr>' +
            '                                            </tfoot>' +
            '                                        </table>' +
            '                                    </div>' +
            '                                </div>' +
            '                            </div>' +
            '                        </div>' +
            '                    </div>' +
            '                </div>' +
            '';
        var newCard =
            "<div class=\"card card-info\" id=\"card-" +
            iCard +
            "\">\n                    <div class=\"card-header\">\n                        <h3 class=\"card-title\">Invoice Details #" +
            iCard +
            "</h3>\n                    </div>\n                    <div class=\"card-body\" id=\"sub_items\">\n                        {{-- button add sub group --}}\n                        <div class=\"row\">\n                            <div class=\"col-sm-12 table-responsive\">\n                                <div class=\"row\">\n                                    <div class=\"col-sm-5 mb-2\">\n                                        <input type=\"text\" class=\"form-control form-control-sm\" name=\"sub_title\"\n                                            id=\"sub_title\" placeholder=\"Sub Title\">\n                                    </div>\n                                    <div class=\"col-sm-4 mb-2 \">\n                                        <button type=\"button\" class=\"btn btn-sm btn-primary\" id=\"add_blank_line-" +
            iCard +
            "\">\n                                            <i class=\"fas fa-plus\"></i> Add Line\n                                        </button>\n<button type=\"button\" class=\"btn btn-sm btn-success\" id=\"find_product-" +
            iCard +
            "\">\n                                            <i class=\"fas fa-search\"></i> Find Products\n                                        </button>\n <button type=\"button\" class=\"btn btn-sm btn-danger\" id=\"delete_card-" +
            iCard +
            "\">\n                                            <i class=\"fas fa-trash\"></i> Remove Sub\n                                        </button>\n                                        {{-- delete --}}\n\n                                    </div>\n                                    {{-- sub total text right --}}\n\n\n                                    {{-- small button add row --}}\n\n                                </div>\n\n                                <div class=\"row\">\n                                    <div class=\"col-sm-12\">\n                                        <table class=\"table text-nowrap table-bordered table-striped table-sm\" id=\"table-" +
            iCard +
            "\">\n                                            <thead class=\"table-primary\">\n                                                <tr class=\"text-center\">\n\n                                                    <th width=\"35%\">Name</th>\n                                                    <th width=\"10%\">Type</th>\n                                                    <th width=\"10%\">Brand</th>\n                                                    <th width=\"10%\">Price (IDR)</th>\n                                                    <th width=\"5%\">Qty</th>\n                                                    <th width=\"5%\">Unit</th>\n                                                    <th width=\"5%\">Disc(%)</th>\n                                                    <th width=\"10%\">Amount (IDR)</th>\n\n                                                </tr>\n                                            </thead>\n                                            <tbody>\n                                                <tr>\n                                                    <td>\n                                                        <div class=\"input-group\">\n                                                            <button type=\"button\" class=\"btn btn-danger btn-xs\"\n                                                                id=\"delete_row\"><i class=\"fa fa-trash text-xs\"></i>\n                                                            </button>\n                                                            <input type=\"text\" class=\"form-control form-control-sm \"\n                                                                name=\"name\" id=\"name\" placeholder=\"Name\">\n                                                                                                                  </div>\n\n\n\n                                                    </td>\n                                                    <td>\n\n                                                        <input type=\"text\" class=\"form-control form-control-sm\" name=\"name\"\n                                                            id=\"type\" placeholder=\"Type\">\n\n                                                    </td>\n                                                    <td>\n                                                        <Select class=\" form-control form-control-sm\" id=\"brand-" +
            iCard +
            "\">\n                                                            <option value=\"\"></option>\n                                                            <option value=\"BROCO\">BROCO</option>\n                                                            <option value=\"ETERNA\">ETERNA</option>\n                                                        </Select>\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"price\" id=\"price\" placeholder=\"Price\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"qty\" id=\"qty\" placeholder=\"Qty\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <Select class=\" form-control form-control-sm\" id=\"unit-" +
            iCard +
            "\">\n                                                            <option value=\"\"></option>\n                                                            <option value=\"BROCO\">pcs</option>\n                                                            <option value=\"ETERNA\">mtr</option>\n                                                            <option value=\"ETERNA\">roll</option>\n                                                        </Select>\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"item_discount\" id=\"item_discount\" placeholder=\"Disc\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"ammount\" id=\"ammount\" placeholder=\"Amount\" value=\"0\"\n                                                            disabled>\n                                                    </td>\n                                                </tr>\n                                            </tbody>\n                                            {{-- footer --}}\n                                            {{-- tfoot without bo --}}\n                                            <tfoot>\n                                                <tr>\n                                                    <td colspan=\"7\" class=\"text-right \">Sub Total</td>\n                                                    <td class=\"text-right\">\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"sub_total\" id=\"sub_total\" placeholder=\"Sub Total\"\n                                                            value=\"0\" style=\"background-color: cyan; font-weight: bold\" disabled>\n                                                    </td>\n                                                </tr>\n                                                 <tr>\n                                                    <td colspan=\"7\" class=\"text-right\">Discount</td>\n                                                    <td class=\"text-right\">\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"sub_discount_value\" id=\"sub_discount_value\" placeholder=\"Discount\" value=\"0\"\n                                                            style=\"background-color: cyan; font-weight: bold\" disabled>\n                                                    </td>\n                                                </tr>\n\n                                                <tr>\n                                                    <td colspan=\"7\" class=\"text-right\">Total</td>\n                                                    <td class=\"text-right\">\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"total\" id=\"total\" placeholder=\"Total\" value=\"0\" style=\"background-color: cyan; font-weight: bold\" disabled>\n                                                    </td>\n                                                </tr> \n                                            </tfoot>\n\n\n                                        </table>\n\n                                    </div>\n                                </div>\n                            </div>\n                        </div>\n                    </div>\n\n                </div>";


        // $('#card-' + i).hide('slow', function() {
        //     // remove card from table
        //     $(this).remove();
        // });

        $('#mainContainer').append(summernoteCard);
        // show slow
        // $("#mainContainer").find("#card-" + iCard).show('slow');

        $("#mainContainer").find("#card-" + iCard).hide().show('slow');

        $("#card-" + iCard).find('#note').hide();


        // apply summernote to textarea with id summernote
        $("#card-" + iCard).find('#summernote').summernote({
            placeholder: 'Enter your note here...',
            tabsize: 1,
            height: 100,
            autoHeight: true,
            disableDragAndDrop: true,
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4',
                '1.5', '2.0',
                '3.0'
            ],
            tabDisable: true,
            toolbar: [
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['view', ['fullscreen', 'codeview']],
                ['insert', ['link', 'table', 'hr']],




            ]
        });


        // add each brands['name'] to select in table of append new card
        $('#unit-' + iCard).empty();
        $('#unit-' + iCard).append('<option value=""></option>');
        $.each(units, function (key, value) {
            $('#unit-' + iCard).append(
                '<option value="' + value.name + '">' + value.name + '</option>'
            );
        });

        $('#brand-' + iCard).unbind().empty();
        $('#brand-' + iCard).unbind().append('<option value=""></option>');
        $.each(brands, function (key, value) {
            $('#brand-' + iCard).append(
                '<option value="' + value.name + '">' + value.name + '</option>'
            );
        });


        $('[id^="table-"]').on('keypress', '#price, #qty, #item_discount, #ammount', function (
            e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                // allow dot
                if (e.which == 46) {
                    return true;
                } else {
                    return false;
                }
            }
        });

        $('[id^="table-"]').on('input', '#price, #qty, #item_discount, #ammount', function () {
            console.log('keyup change');
            // var id = $(this).attr('id');
            // var i = id.split('-')[1];
            // console.log($(this).attr('id'));
            var val = $(this).val();
            val = val.toString().replace(/,/g, "");
            val = val.split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1,');
            val = val.split('').reverse().join('').replace(/^[\,]/, '');
            $(this).val(val);

            var tr = $(this).closest('tr');

            var price = parseFloat(tr.find('#price').val().replace(/[^0-9\-]+/g, ""));
            var qty = parseFloat(tr.find('#qty').val().replace(/[^0-9\-]+/g, ""));
            var item_discount = parseFloat(tr.find('#item_discount').val());
            var ammount = price * qty - (price * qty * item_discount / 100);
            // var ammount = (price * qty) * (100 - item_discount) / 100;
            var ammountAfter = ammount;
            ammountAfter = ammountAfter.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            tr.find('#ammount').val(ammountAfter);
            var total = 0;
            // get table id 
            var table = $(this).closest('table');
            // console.log(table.attr('id'));
            // total form table head named ammount
            table.find('tbody tr').each(function () {
                // frum number format to number
                var ammountAfter = parseFloat($(this).find('#ammount').val()
                    .replace(
                        /[^0-9\-]+/g,
                        ""));
                total += ammountAfter;
            });
            // find id #sub_total in this table


            // calculate total sub_discount_value in value not in %
            var totalDisc = 0;
            var ammountBefore = 0
            table.find('tbody tr').each(function () {
                // calculate ammount before sub_discount_value
                var price = parseFloat($(this).find('#price').val().replace(
                    /[^0-9\-]+/g, ""));
                var qty = parseFloat($(this).find('#qty').val().replace(
                    /[^0-9\-]+/g, ""));
                var item_discount = parseFloat($(this).find(
                    '#item_discount').val());
                var ammount = price * qty - (price * qty * item_discount /
                    100);
                // calculate sub_discount_value
                var item_discount = parseFloat($(this).find(
                    '#item_discount').val());
                ammountBefore += price * qty

            });
            totalDisc = ammountBefore - total;
            var subTtl = table.find('#sub_total');
            var discTtl = table.find('#sub_discount_value');


            var totalTtl = table.find('#total');
            subTtl.val(ammountBefore.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));
            discTtl.val(totalDisc.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));
            totalTtl.val(total.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));

            // find id sub_total_header in #mainContainer
            var subTtlHeader = $('#sub_total_header');
            var discTtlHeader = $('#sub_discount_header');
            var grandTtlHeader = $('#grand_total_header');

            // sum all #total in #mainContainer table
            var subTtl = 0;
            var discTtl = 0;
            var grandTtl = 0;
            $('#mainContainer table').each(function () {
                subTtl += parseFloat($(this).find('#sub_total').val()
                    .replace(
                        /[^0-9\-]+/g,
                        ""));
                discTtl += parseFloat($(this).find('#sub_discount_value').val()
                    .replace(
                        /[^0-9\-]+/g,
                        ""));
                grandTtl += parseFloat($(this).find('#total').val()
                    .replace(
                        /[^0-9\-]+/g,
                        ""));
            });

            var discValue = 0;
            if ($('#discount_type').val() == 'total') {
                discValue = parseFloat($('#discount_value_header').val()
                    .replace(
                        /[^0-9\-]+/g,
                        ""));

            } else if ($('#discount_type').val() == 'percent') {
                discValue = (parseFloat($('#set_discount_value').val()) / 100) * grandTtl;
                $('#discount_value_header').val(discValue.toString().replace(
                    /\B(?=(\d{3})+(?!\d))/g, ","));

            }
            grandTtl -= discValue;

            subTtlHeader.val(subTtl.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));
            discTtlHeader.val(discTtl.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));
            grandTtlHeader.val(grandTtl.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));

        });

        // listen if change all input in table by other function




        $('html, body').animate({
            scrollTop: $("#footerButton").offset().top
        }, 300);


    });

    // // fill item based on modal click addItem 
    // $('#addItem').on('click', function() {
    //     console.log('add item');
    // });


    // delete card
    $(document).on('click', '[id^="delete_card-"]', function (e) {
        e.preventDefault();

        var id = $(this).attr('id');
        var i = id.split('-')[1];
        var r = confirm(
            "Are you sure you want to delete this Sub Group? \n All data will be lost.");

        if (r == true) {

            e.preventDefault();
            // hide card with animation
            $('#card-' + i).hide('slow', function () {
                // remove card from table
                $(this).remove();
                recalculateGt();
            });




        } else {
            return false;
        }


    });



    // document on append element
    $(document).on('click', '[id^="add_blank_line-"]', function (e) {
        e.preventDefault();

        var newRowSummernote =
            '                                                <tr>' +
            '                                                    <td style="vertical-align:top">' +
            '                                                        <div class="input-group ">' +
            '                                                            <div class="col m-0 p-0">' +
            '                                                                <div class="input-group">' +
            '                                                                    <button type="button " class="btn btn-danger btn-xs "' +
            '                                                                        id="delete_row"><i' +
            '                                                                            class="fa fa-trash text-xs "></i>' +
            '                                                                    </button>' +
            '                                                                    <input type="text"' +
            '                                                                        class="form-control form-control-sm  " name="id_item " value="custom"' +
            '                                                                        id="id_item" hidden>' +
            '                                                                    <input type="text "' +
            '                                                                        class="form-control form-control-sm  " name="name "' +
            '                                                                        id="name" placeholder="Name " required>' +
            '                                                                    <button type="button" class="btn btn-info btn-xs "' +
            '                                                                        id="edit_note"><i id="icon_note"' +
            '                                                                            class="fas fa-edit text-xs "></i>' +
            '                                                                    </button>' +
            '' +
            '                                                                </div>' +
            '' +
            '                                                                {{-- summernote --}}' +
            '                                                                <div class="row" id="note">' +
            '                                                                    <div class="container-fluid">' +
            '                                                                        <textarea class="form-control" name="note " id="summernote" rows="3 " placeholder="Note" style="display: none;"></textarea>' +
            '                                                                    </div>' +
            '                                                                </div>' +
            '' +
            '' +
            '' +
            '                                                            </div>' +
            '' +
            '                                                        </div>' +
            '                                                    </td>' +
            '                                                    <td style="vertical-align:top"> <input type="text " class="form-control form-control-sm "' +
            '                                                            name="name " id="type" placeholder="Type" required> </td>' +
            '                                                    <td style="vertical-align:top"> <Select class=" form-control form-control-sm " id="brand-' +
            iCard + '" required>' +
            '                                                            <option value=""></option>' +
            '                                                            <option value="BROCO ">BROCO</option>' +
            '                                                            <option value="ETERNA ">ETERNA</option>' +
            '                                                        </Select> </td>' +
            '                                                    <td style="vertical-align:top"> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right " name="price "' +
            '                                                            id="price" placeholder="Price" value="0" required> </td>' +
            '                                                    <td style="vertical-align:top"> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right " name="qty"' +
            '                                                            id="qty" placeholder="Qty " value="0" required> </td>' +
            '                                                    <td style="vertical-align:top"> <Select class=" form-control form-control-sm " id="unit-' +
            iCard + '" required>' +
            '                                                            <option value=""></option>' +
            '                                                            <option value="BROCO ">pcs</option>' +
            '                                                            <option value="ETERNA ">mtr</option>' +
            '                                                            <option value="ETERNA ">roll</option>' +
            '                                                        </Select> </td>' +
            '                                                    <td style="vertical-align:top"> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right " name="item_discount "' +
            '                                                            id="item_discount" placeholder="Disc " value="0" required> </td>' +
            '                                                    <td style="vertical-align:top"> <input type="text "' +
            '                                                            class="form-control form-control-sm text-right " name="ammount "' +
            '                                                            id="ammount" placeholder="Amount" value="0" disabled>' +
            '                                                    </td>' +
            '                                                </tr>';

        var newRow =
            "<tr>\n                                                    <td>\n                                                        <div class=\"input-group\">\n                                                            <button type=\"button\" class=\"btn btn-danger btn-xs\"\n                                                                id=\"delete_row\"><i class=\"fa fa-trash text-xs\"></i>\n                                                            </button>\n                                                            <input type=\"text\" class=\"form-control form-control-sm \"\n                                                                name=\"name\" id=\"name\" placeholder=\"Name\">\n                                                                                                        </div>\n\n\n\n                                                    </td>\n                                                    <td>\n\n                                                        <input type=\"text\" class=\"form-control form-control-sm\" name=\"name\"\n                                                            id=\"name\" placeholder=\"Name\">\n\n                                                    </td>\n                                                    <td>\n                                                        <Select class=\" form-control form-control-sm\" id=\"brand-" +
            iCard +
            "\">\n                                                            <option value=\"\"></option>\n                                                            <option value=\"BROCO\">BROCO</option>\n                                                            <option value=\"ETERNA\">ETERNA</option>\n                                                        </Select>\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"price\" id=\"price\" placeholder=\"Price\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"qty\" id=\"qty\" placeholder=\"Qty\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <Select class=\" form-control form-control-sm\" id=\"unit-" +
            iCard +
            "\">\n                                                            <option value=\"\"></option>\n                                                            <option value=\"BROCO\">pcs</option>\n                                                            <option value=\"ETERNA\">mtr</option>\n                                                            <option value=\"ETERNA\">roll</option>\n                                                        </Select>\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"item_discount\" id=\"item_discount\" placeholder=\"Disc\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"ammount\" id=\"ammount\" placeholder=\"Amount\" value=\"0\"\n                                                            disabled>\n                                                    </td>\n                                                </tr>\n ";


        var id = $(this).attr('id');
        var i = id.split('-')[1];
        $('#table-' + i + ' tbody').append(newRowSummernote);
        // slide down the box
        $('#table-' + i + ' tr:last-child').hide().show('slow');

        // clear last select option with id unit-i
        $('#table-' + i + ' tr:last-child select[id="unit-' + i + '"]').empty();
        // add new option to last select option with id unit-i from units
        $('#table-' + i + ' tr:last-child select[id="unit-' + i + '"]').append(
            '<option value=""></option>');
        $.each(units, function (key, value) {
            $('#table-' + i + ' tr:last-child select[id="unit-' + i + '"]').append(
                '<option value="' + value.name + '">' + value.name + '</option>');
        });
        // clear last select option with id brand-i
        $('#table-' + i + ' tr:last-child select[id="brand-' + i + '"]').empty();
        // add new option to last select option with id brand-i from brands
        $('#table-' + i + ' tr:last-child select[id="brand-' + i + '"]').append(
            '<option value=""></option>');
        $.each(brands, function (key, value) {
            $('#table-' + i + ' tr:last-child select[id="brand-' + i + '"]').append(
                '<option value="' + value.name + '">' + value.name + '</option>');
        });

        $('#table-' + i + ' tr:last-child div[id="note"]').hide();

        $('#table-' + i + ' tr:last-child textarea[id="summernote"]').summernote({
            placeholder: 'Enter your note here...',
            tabsize: 1,
            height: 100,
            autoHeight: true,
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4',
                '1.5', '2.0',
                '3.0'
            ],
            tabDisable: true,
            // hide toolbar
            // airMode: true,
            toolbar: [
                ['fontsize', ['fontsize']],
                ['font', ['bold', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link', 'hr']],
            ]
        });

        // $('#table-' + i + ' tr:last-child button[id="edit_note"]').click(function() {

        //     // animate toggle #note and change icon #icon_note
        //     $('#table-' + i + ' tr:last-child div[id="note"]').slideToggle();
        //     // $('#icon_note').toggleClass('fa-pencil fa-eye');

        // });


    });

    $(document).on('click', '#edit_note', function (e) {
        e.preventDefault();
        console.log('edit note');

        var table = $(this).closest('table');
        $(this).closest('tr').find('div[id="note"]').slideToggle();
        // change icon
        $(this).closest('tr').find('i[id="icon_note"]').toggleClass('fa-pencil fa-eye');





    });


    $(document).on('click', '#delete_row', function (e) {
        // get table id
        var table = $(this).closest('table');
        // var tableId = table.attr('id');



        // alert dialog and captcha
        var r = confirm("Are you sure you want to delete this row?");

        if (r == true) {

            e.preventDefault();
            // anmate delete row
            $(this).closest('tr').hide('slow', function () {
                $(this).remove();
                recalculate(table);
            });

            // $(this).closest('tr').remove();
            // recalculate ammount




        } else {
            return false;
        }
    });

    $(document).on('click', '[id^="find_product-"]', function (e) {
        e.preventDefault();
        console.log('find product');

        var id = $(this).attr('id');
        var i = id.split('-')[1];




        // // open modal to find item 
        $('#modal_find_item').modal('show');

        $('[id="table_find"]').unbind().on('click', '#addClick', function () {
            console.log('addClick');
            // get data from modal
            var randomText = Math.random().toString(36).substring(7);
            var item_id = $(this).closest('tr').find('td:eq(0)').text();
            var item_name = $(this).closest('tr').find('td:eq(1)').text();
            var item_type = $(this).closest('tr').find('td:eq(2)').text();
            var item_brand = $(this).closest('tr').find('td:eq(3)').text();
            var item_price = $(this).closest('tr').find('td:eq(4)').text();
            var item_unit = $(this).closest('tr').find('td:eq(5)').text();
            var val = item_price;
            val = val.toString().replace(/,/g, "");
            val = val.split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,
                '$1,');
            val = val.split('').reverse().join('').replace(/^[\,]/, '');

            var newRowSummernote =
                '                                                <tr>' +
                '                                                    <td style="vertical-align:top">' +
                '                                                        <div class="input-group ">' +
                '                                                            <div class="col m-0 p-0">' +
                '                                                                <div class="input-group">' +
                '                                                                    <button type="button " class="btn btn-danger btn-xs "' +
                '                                                                        id="delete_row"><i' +
                '                                                                            class="fa fa-trash text-xs "></i>' +
                '                                                                    </button>' +
                '                                                                    <input type="text "' +
                '                                                                        class="form-control form-control-sm  " name="id_item "' +
                '                                                                        id="id_item" value="' +
                item_id + '" hidden>' +

                '                                                                    <input type="text "' +
                '                                                                        class="form-control form-control-sm  " name="name "' +
                '                                                                        id="name" placeholder="Name " value="' +
                item_name + '">' +
                '                                                                    <button type="button" class="btn btn-info btn-xs "' +
                '                                                                        id="edit_note"><i id="icon_note"' +
                '                                                                            class="fas fa-edit text-xs "></i>' +
                '                                                                    </button>' +
                '' +
                '                                                                </div>' +
                '' +
                '                                                                {{-- summernote --}}' +
                '                                                                <div class="row" id="note">' +
                '                                                                    <div class="col-sm-12 ">' +
                '                                                                        <textarea class="form-control" name="note " id="summernote" rows="3 " placeholder="Note" style="display: none;"></textarea>' +
                '                                                                    </div>' +
                '                                                                </div>' +
                '' +
                '' +
                '' +
                '                                                            </div>' +
                '' +
                '                                                        </div>' +
                '                                                    </td>' +
                '                                                    <td style="vertical-align:top"> <input type="text " class="form-control form-control-sm "' +
                '                                                            name="name " id="type" placeholder="Type" value="' +
                item_type + '"> </td>' +
                '                                                    <td style="vertical-align:top"> <input class=" form-control form-control-sm " id="brand-' +
                iCard + '" value="' + item_brand + '">' +

                '                                                               </td>' +
                '                                                    <td style="vertical-align:top"> <input type="text "' +
                '                                                            class="form-control form-control-sm text-right " name="price "' +
                '                                                            id="price" placeholder="Price " value="' +
                val + '"> </td>' +
                '                                                    <td style="vertical-align:top"> <input type="text "' +
                '                                                            class="form-control form-control-sm text-right " name="qty"' +
                '                                                            id="qty" placeholder="Qty " value="1 "> </td>' +
                '                                                    <td style="vertical-align:top"> <input class=" form-control form-control-sm " id="unit-' +
                iCard + '" value="' + item_unit + '">' +

                '                                                         </td>' +
                '                                                    <td style="vertical-align:top"> <input type="text "' +
                '                                                            class="form-control form-control-sm text-right " name="item_discount "' +
                '                                                            id="item_discount" placeholder="Disc " value="0"> </td>' +
                '                                                    <td style="vertical-align:top"> <input type="text "' +
                '                                                            class="form-control form-control-sm text-right " name="ammount "' +
                '                                                            id="ammount" placeholder="Amount " value="' +
                val + '" disabled>' +
                '                                                    </td>' +
                '                                                </tr>';


            // append data to table
            var newRow =
                "<tr>\n                                                    <td>\n                                                        <div class=\"input-group\">\n                                                            <button type=\"button\" class=\"btn btn-danger btn-xs\"\n                                                                id=\"delete_row\"><i class=\"fa fa-trash text-xs\"></i>\n                                                            </button>\n                                                            <input  type=\"text\" class=\"form-control form-control-sm \"\n                                                                name=\"name\" id=\"name\" placeholder=\"Name\" value=\"" +
                item_name +
                "\">\n                                                                                                                    </div>\n\n\n\n                                                    </td>\n                                                    <td>\n\n                                                        <input  type=\"text\" class=\"form-control form-control-sm\" name=\"type\"\n                                                            id=\"type\" placeholder=\"Type\" value=\"" +
                item_type +
                "\">\n\n                                                    </td>\n                                                    <td>\n                                                        <input  type=\"text\"  class=\" form-control form-control-sm\" id=\"brand-" +
                iCard +
                "\" value=\"" +
                item_brand +
                "\">\n                                                            </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"price\" id=\"price\" placeholder=\"Price\" value=\"" +
                val +
                "\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"qty\" id=\"qty\" placeholder=\"Qty\" value=\"" +
                1 +
                "\">\n                                                    </td>\n                                                    <td>\n                                                        <Input type=\"text\" class=\" form-control form-control-sm\" id=\"unit-" +
                iCard +
                "\" value=\"" +
                item_unit +
                "\">\n                                                                                                               </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"item_discount\" id=\"item_discount\" placeholder=\"Disc\" value=\"0\">\n                                                    </td>\n                                                    <td>\n                                                        <input type=\"text\" class=\"form-control form-control-sm text-right\"\n                                                            name=\"ammount\" id=\"ammount\" placeholder=\"Amount\" value=\"" +
                val +
                "\"\n                                                           disabled>\n                                                    </td>\n                                                </tr>\n ";
            $('#table-' + i + ' tbody').append(newRowSummernote);
            $('#table-' + i + ' tr:last-child').hide().show('slow');

            $('#table-' + i + ' tr:last-child div[id="note"]').hide();

            $('#table-' + i + ' tr:last-child textarea[id="summernote"]').summernote({
                placeholder: 'Enter your note here...',
                tabsize: 1,
                height: 100,
                autoHeight: true,
                disableDragAndDrop: true,
                lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0',
                    '1.2', '1.4',
                    '1.5', '2.0',
                    '3.0'
                ],
                tabDisable: true,
                toolbar: [
                    ['fontsize', ['fontsize']],
                    ['font', ['bold', 'underline']],
                    ['para', ['ul', 'ol']],
                    ['insert', ['link', 'hr']],
                ]
            });










            // name.val(randomText);
            // get table
            var table = $('#table-' + i);

            // destroy modal
            $('#modal_find_item').modal('hide');
            recalculate(table);

        });




    });







    function recalculateGt() {

        // find id sub_total_header in #mainContainer
        var subTtlHeader = $('#sub_total_header');
        var discTtlHeader = $('#sub_discount_header');
        var grandTtlHeader = $('#grand_total_header');

        // sum all #total in #mainContainer table
        var subTtl = 0;
        var discTtl = 0;
        var grandTtl = 0;
        $('#mainContainer table').each(function () {
            subTtl += parseFloat($(this).find('#sub_total').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
            discTtl += parseFloat($(this).find('#sub_discount_value').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
            grandTtl += parseFloat($(this).find('#total').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
        });

        var discValue = 0;




        if ($('#discount_type').val() == 'total') {

            discValue = parseFloat($('#discount_value_header').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));

        } else if ($('#discount_type').val() == 'percent') {
            discValue = (parseFloat($('#set_discount_value').val()) / 100) * grandTtl;
            $('#discount_value_header').val(discValue.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));

        }
        grandTtl -= discValue;

        subTtlHeader.val(subTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        discTtlHeader.val(discTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        grandTtlHeader.val(grandTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
    }

    // recalculate ammount and total
    function recalculate(table) {
        console.log('Recalculate');




        var total = 0;
        var totalDisc = 0;
        var ammountBefore = 0
        table.find('tbody tr').each(function () {
            // calculate ammount before sub_discount_value
            var price = parseFloat($(this).find('#price').val().replace(
                /[^0-9\-]+/g, ""));
            var qty = parseFloat($(this).find('#qty').val().replace(
                /[^0-9\-]+/g, ""));
            var item_discount = parseFloat($(this).find('#item_discount').val());
            var ammount = price * qty - (price * qty * item_discount / 100);
            // calculate sub_discount_value
            var item_discount = parseFloat($(this).find('#item_discount').val());
            ammountBefore += price * qty
            var ammountField = parseFloat($(this).find('#ammount').val().replace(
                /[^0-9\-]+/g,
                ""));
            total += ammountField;

        });
        totalDisc = ammountBefore - total;
        var subTtl = table.find('#sub_total');
        var discTtl = table.find('#sub_discount_value');
        console.log(ammountBefore);


        var totalTtl = table.find('#total');
        subTtl.val(ammountBefore.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        discTtl.val(totalDisc.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        totalTtl.val(total.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));

        // find id sub_total_header in #mainContainer
        var subTtlHeader = $('#sub_total_header');
        var discTtlHeader = $('#sub_discount_header');
        var grandTtlHeader = $('#grand_total_header');

        // sum all #total in #mainContainer table
        var subTtl = 0;
        var discTtl = 0;
        var grandTtl = 0;
        $('#mainContainer table').each(function () {
            subTtl += parseFloat($(this).find('#sub_total').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
            discTtl += parseFloat($(this).find('#sub_discount_value').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
            grandTtl += parseFloat($(this).find('#total').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));
        });

        var discValue = 0;
        if ($('#discount_type').val() == 'total') {
            discValue = parseFloat($('#discount_value_header').val()
                .replace(
                    /[^0-9\-]+/g,
                    ""));

        } else if ($('#discount_type').val() == 'percent') {
            discValue = (parseFloat($('#set_discount_value').val()) / 100) * grandTtl;
            $('#discount_value_header').val(discValue.toString().replace(
                /\B(?=(\d{3})+(?!\d))/g, ","));

        }
        grandTtl -= discValue;


        subTtlHeader.val(subTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        discTtlHeader.val(discTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));
        grandTtlHeader.val(grandTtl.toString().replace(
            /\B(?=(\d{3})+(?!\d))/g, ","));





    };
});
