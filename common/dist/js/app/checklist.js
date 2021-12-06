$(document).ready(function () {

    $("#comp_id").select2({
        placeholder: "Select Company",
        allowClear: true
    });

    $("#seg_id").select2({
        placeholder: "Select Segment",
        allowClear: true
    });

    $("#cycleid").select2({
        placeholder: "Select Cycle",
        allowClear: true
    });


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

                    url: BASE_URL + 'delchecklist',

                    data: { delid: delid },

                    success: function (d) {

                        if (d.deleted == 'success') {

                            Swal.fire({
                                icon: 'success',
                                title: 'Checklist deleted!',
                                confirmButtonText: 'Close',
                                confirmButtonColor: '#d33',
                                allowOutsideClick: false,
                            });
                            window.location.reload();

                        }
                        else if (d.deleted == 'not_exists') {

                            Swal.fire({
                                icon: 'error',
                                title: 'Checklist not exists!',
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

    $(document).on('keyup', '#name', function () {
        var name = $('#name').val();
        if (name != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'duplicate_check_checklist',
                data: {
                    name: name
                },

                success: function (d) {
                    if (d.if_exists == 1) {
                        $('#chk_name').show();
                        $('#chk_name').html('<i class="icofont-close-squared-alt"></i> Checklist already exists..!!');
                        $("#chk_name").css("color", "red");
                        return false;
                    } else {
                        $('#chk_name').show();
                        $('#chk_name').html('<i class="icofont-tick-boxed"></i> Checklist available.');
                        $("#chk_name").css("color", "green");
                    }
                }
            });

        } else {
            $('#chk_name').hide();
        }

    });


    $(document).on('change', '#seg_id', function() {
        var comp_id = $('#comp_id').val();
        var seg_id = $('#seg_id').val();
        if (comp_id != '' && seg_id != '') {
            $.ajax({
                type: "POST",
                url: BASE_URL + 'get_cycle',
                data: {
                    comp_id: comp_id,
                    seg_id: seg_id
                },

                success: function(d) {
                    if (d.list != '') {
                        $('#cycleid').html(d.list);
                    } else {
                        //
                    }
                }
            });

        } else {
            //
        }

    });


    $("#create_form").submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: BASE_URL + 'createchecklist',
            cache: false,
            data: $('#create_form').serialize(),
            beforeSend: function () {
                $('#btn_submit').html('Creating..').prop('disabled', true);
            },
            success: function (d) {
                if (d.added == "rule_error") {

                    Swal.fire({
                        icon: 'error',
                        title: 'Validation Error',
                        html: d.errors,
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);

                } else if (d.added == 'success') {

                    Swal.fire({
                        icon: 'success',
                        title: 'Checklist added!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });

                    setTimeout(function () {
                        window.location.reload();
                    }, 100);

                } else if (d.added == 'already_exists') {

                    Swal.fire({
                        icon: 'error',
                        title: 'Checklist already exists!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        confirmButtonText: 'Close',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false,
                    });
                    $('#btn_submit').html('Submit').prop('disabled', false);
                }
            }
        });

    });



});