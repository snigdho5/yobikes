$(document).ready(function () {

    for (let index = 1; index <= 20; index++) {
        $("#comp_id_" + index).select2({
            placeholder: "Select Company",
            allowClear: true
        });

        $("#seg_id_" + index).select2({
            placeholder: "Select Segment",
            allowClear: true
        });

        $("#cycleid_" + index).select2({
            placeholder: "Select Cycle",
            allowClear: true
        });

        $("#color_" + index).select2({
            placeholder: "Select Color",
            allowClear: true
        });
    }



    $(document).on('click', '.del_row', function () {

        var delid = $(this).attr('data-delid');
        var rowname = $(this).attr('data-rowname');


        Swal.fire({
            title: "Are you sure?",
            text: rowname + " will be deleted parmanently!",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then((willDelete) => {
            if (willDelete.isConfirmed == true) {
                $.ajax({

                    type: 'POST',

                    url: BASE_URL + 'delchecklistbill',

                    data: { delid: delid },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Checklist Bill deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Checklist Bill not exists!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });

                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Something went wrong!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                        }

                    }

                });
            } else {
                //Swal.fire("Okay!");
            }
        });

    });

    $(document).on('change', '.seg_id', function () {
        var rowid = $(this).attr('data-rowid');
        var comp_id = $('#comp_id_' + rowid).val();
        var seg_id = $('#seg_id_' + rowid).val();
        if (comp_id != '' && seg_id != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'get_cycle',
                data: {
                    comp_id: comp_id,
                    seg_id: seg_id
                },

                success: function (d) {
                    if (d.list != '') {
                        $('#cycleid_' + rowid).html(d.list);
                    } else {
                        //
                    }
                }
            });

        } else {
            //
        }

    });

    
    $(document).on('change', '.cycleid', function () {
        var rowid = $(this).attr('data-rowid');
        var comp_id = $('#comp_id_' + rowid).val();
        var seg_id = $('#seg_id_' + rowid).val();
        var cycleid = $('#cycleid_' + rowid).val();

        if (comp_id != '' && seg_id != '' && cycleid != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'get_color',
                data: {
                    comp_id: comp_id,
                    seg_id: seg_id,
                    cycleid: cycleid
                },

                success: function (d) {
                    if (d.list != '') {
                        $('#color_' + rowid).html(d.list);
                    } else {
                        //
                    }
                }
            });

        } else {
            //
        }

    });

    $(document).on('change', '.quantity', function () {
        var rowid = $(this).attr('data-qtyid');
        var quantity = $('#quantity_' + rowid).val();
        var comp_id = $('#comp_id_' + rowid).val();
        var seg_id = $('#seg_id_' + rowid).val();
        var cycleid = $('#cycleid_' + rowid).val();
        var color = $('#color_' + rowid).val();

        if (color != '') {
            if (comp_id != '' && seg_id != '' && quantity > 0 && cycleid != '') {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + 'get_multipleof_qty',
                    data: {
                        comp_id: comp_id,
                        seg_id: seg_id,
                        cycleid: cycleid,
                        quantity: quantity,
                        color: color
                    },

                    success: function (d) {
                        if (d.list != '') {
                            let listArr = d.list;
                            //console.log(listArr['carton']);
                            $('#carton_' + rowid).val(listArr['carton']);
                            $('#tyre_' + rowid).val(listArr['tyre']);
                            $('#rim_' + rowid).val(listArr['rim']);
                            $('#busket_' + rowid).val(listArr['busket']);
                            $('#frame_' + rowid).val(listArr['frame']);
                            $('#mudguard_' + rowid).val(listArr['mudguard']);
                            $('#sit_' + rowid).val(listArr['sit']);
                            $('#handle_' + rowid).val(listArr['handle']);
                            $('#carrier_' + rowid).val(listArr['carrier']);
                            // $('#color_' + rowid).val(listArr['color']);
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: d.msg,
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Please enter all the details correctly!',
                    confirmButtonText: 'Close',
                    confirmButtonColor: '#d33',
                    allowOutsideClick: false,
                });
            }
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Please select color!',
                confirmButtonText: 'Close',
                confirmButtonColor: '#d33',
                allowOutsideClick: false,
            });

            $('#quantity_' + rowid).val('0');
        }

    });




    $(document).on('click', '.get-total', function () {

        var tot_qty = 0;
        var tot_carton = 0;
        var tot_tyre = 0;
        var tot_rim = 0;
        var tot_busket = 0;
        var tot_frame = 0;
        var tot_mudguard = 0;
        var tot_sit = 0;
        var tot_handle = 0;
        var tot_carrier = 0;
        var sl_count = 0;

        for (let index = 1; index <= 20; index++) {
            tot_qty += parseFloat($("#quantity_" + index).val());
            tot_carton += parseFloat($("#carton_" + index).val());
            tot_tyre += parseFloat($("#tyre_" + index).val());
            tot_rim += parseFloat($("#rim_" + index).val());
            tot_busket += parseFloat($("#busket_" + index).val());
            tot_frame += parseFloat($("#frame_" + index).val());
            tot_mudguard += parseFloat($("#mudguard_" + index).val());
            tot_sit += parseFloat($("#sit_" + index).val());
            tot_handle += parseFloat($("#handle_" + index).val());
            tot_carrier += parseFloat($("#carrier_" + index).val());
            if (parseFloat($("#quantity_" + index).val()) > 0) {
                sl_count++;
                $("#sl_count").val(sl_count);
            }

        }
        // console.log(tot_qty);
        $("#total_quantity").val(tot_qty);
        $("#total_quantity_carton").val(tot_carton);
        $("#total_quantity_tyre").val(tot_tyre);
        $("#total_quantity_rim").val(tot_rim);
        $("#total_quantity_busket").val(tot_busket);
        $("#total_quantity_frame").val(tot_frame);
        $("#total_quantity_mudguard").val(tot_mudguard);
        $("#total_quantity_sit").val(tot_sit);
        $("#total_quantity_handle").val(tot_handle);
        $("#total_quantity_carrier").val(tot_carrier);

    });

    $("#create_form").submit(function (e) {


        if (parseFloat($("#sl_count").val()) > 0) {
            //submit
        }else{
            
        e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Please click total!',
                confirmButtonText: 'Close',
                confirmButtonColor: '#d33',
                allowOutsideClick: false,
            });
        }

    });



});