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

                    url: BASE_URL + 'delchecklist2bill',

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
                url: BASE_URL + 'get_color2',
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
                    url: BASE_URL + 'get_multipleof_qty2',
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
                            $('#frame_etc_' + rowid).val(listArr['frame_etc']);
                            $('#mudguard_etc_' + rowid).val(listArr['mudguard_etc']);
                            $('#rim_etc_' + rowid).val(listArr['rim_etc']);
                            $('#sit_etc_' + rowid).val(listArr['sit_etc']);
                            $('#chaincover_etc_' + rowid).val(listArr['chaincover_etc']);
                            $('#ball_racer_etc_' + rowid).val(listArr['ball_racer_etc']);
                            $('#ch_wheel_etc_' + rowid).val(listArr['ch_wheel_etc']);
                            $('#pedal_etc_' + rowid).val(listArr['pedal_etc']);
                            $('#chain_etc_' + rowid).val(listArr['chain_etc']);
                            $('#bb_axle_etc_' + rowid).val(listArr['bb_axle_etc']);
                            $('#colter_join_etc_' + rowid).val(listArr['colter_join_etc']);
                            $('#break_set_etc_' + rowid).val(listArr['break_set_etc']);
                            $('#busket_etc_' + rowid).val(listArr['busket_etc']);
                            $('#stand_etc_' + rowid).val(listArr['stand_etc']);
                            $('#mud_screw_etc_' + rowid).val(listArr['mud_screw_etc']);
                            $('#dress_guard_etc_' + rowid).val(listArr['dress_guard_etc']);
                            $('#spock_etc_' + rowid).val(listArr['spock_etc']);
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
        var tot_frame_etc_ = 0;
        var tot_mudguard_etc_ = 0;
        var tot_rim_etc_ = 0;
        var tot_sit_etc_ = 0;
        var tot_chaincover_etc_ = 0;
        var tot_ball_racer_etc_ = 0;
        var tot_ch_wheel_etc_ = 0;
        var tot_pedal_etc_ = 0;
        var tot_chain_etc_ = 0;
        var tot_bb_axle_etc_ = 0;
        var tot_colter_join_etc_ = 0;
        var tot_break_set_etc_ = 0;
        var tot_busket_etc_ = 0;
        var tot_stand_etc_ = 0;
        var tot_mud_screw_etc_ = 0;
        var tot_dress_guard_etc_ = 0;
        var tot_spock_etc_ = 0;
        var sl_count = 0;

        for (let index = 1; index <= 20; index++) {
            tot_qty += parseFloat($("#quantity_" + index).val());
            tot_frame_etc_ += parseFloat($("#frame_etc_" + index).val());
            tot_mudguard_etc_ += parseFloat($("#mudguard_etc_" + index).val());
            tot_rim_etc_ += parseFloat($("#rim_etc_" + index).val());
            tot_sit_etc_ += parseFloat($("#sit_etc_" + index).val());
            tot_chaincover_etc_ += parseFloat($("#chaincover_etc_" + index).val());
            tot_ball_racer_etc_ += parseFloat($("#ball_racer_etc_" + index).val());
            tot_ch_wheel_etc_ += parseFloat($("#ch_wheel_etc_" + index).val());
            tot_pedal_etc_ += parseFloat($("#pedal_etc_" + index).val());
            tot_chain_etc_ += parseFloat($("#chain_etc_" + index).val());
            tot_bb_axle_etc_ += parseFloat($("#bb_axle_etc_" + index).val());
            tot_colter_join_etc_ += parseFloat($("#colter_join_etc_" + index).val());
            tot_break_set_etc_ += parseFloat($("#break_set_etc_" + index).val());
            tot_busket_etc_ += parseFloat($("#busket_etc_" + index).val());
            tot_stand_etc_ += parseFloat($("#stand_etc_" + index).val());
            tot_mud_screw_etc_ += parseFloat($("#mud_screw_etc_" + index).val());
            tot_dress_guard_etc_ += parseFloat($("#dress_guard_etc_" + index).val());
            tot_spock_etc_ += parseFloat($("#spock_etc_" + index).val());
            if (parseFloat($("#quantity_" + index).val()) > 0) {
                sl_count++;
                $("#sl_count").val(sl_count);
            }

        }
        // console.log(tot_qty);
        $("#total_quantity").val(tot_qty);
        $("#total_quantity_frame_etc").val(tot_frame_etc_);
        $("#total_quantity_mudguard_etc").val(tot_mudguard_etc_);
        $("#total_quantity_rim_etc").val(tot_rim_etc_);
        $("#total_quantity_sit_etc").val(tot_sit_etc_);
        $("#total_quantity_chaincover_etc").val(tot_chaincover_etc_);
        $("#total_quantity_ball_racer_etc").val(tot_ball_racer_etc_);
        $("#total_quantity_ch_wheel_etc").val(tot_ch_wheel_etc_);
        $("#total_quantity_pedal_etc").val(tot_pedal_etc_);
        $("#total_quantity_chain_etc").val(tot_chain_etc_);
        $("#total_quantity_bb_axle_etc").val(tot_bb_axle_etc_);
        $("#total_quantity_colter_join_etc").val(tot_colter_join_etc_);
        $("#total_quantity_break_set_etc").val(tot_break_set_etc_);
        $("#total_quantity_busket_etc").val(tot_busket_etc_);
        $("#total_quantity_stand_etc").val(tot_stand_etc_);
        $("#total_quantity_mud_screw_etc").val(tot_mud_screw_etc_);
        $("#total_quantity_dress_guard_etc").val(tot_dress_guard_etc_);
        $("#total_quantity_spock_etc").val(tot_spock_etc_);

    });

    $("#create_form").submit(function (e) {


        if (parseFloat($("#sl_count").val()) > 0) {
            //submit
        } else {

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