$(document).ready(function() {
    function loadData() {
        $.ajax({
            url: '../../../handler/vehicle_handler.php',
            type: 'POST',
            data: { action: 'getAll' },
            dataType: 'json',
            success: function(data) {
                $('#vehicle_data').html(data);
            }
        });
    }

    $.fn.bootstrapBtn = $.fn.button.noConflict();

    $('#vehicle_table_dialog').dialog({
        autoOpen: false,
        modal: true,
        width: 400,
        resizable: false,
        classes: {
            "ui-dialog": "ui-corner-all",
        },
        show: {
            effect: 'highlight',
            duration: 1500
        },
        hide: {
            effect: 'fade',
            duration: 800
        }
    });

    $('#add_vehicle').click(function() {
        $('#action').val('save');
        $('#btn_save').val('Adicionar');
        $('#vehicle_table_dialog').dialog('open');

        if ($('#vehicle_table_dialog').dialog('isOpen')) {
            $('#btn_cancel').click(function() {
                $('#vehicle_table_dialog').dialog('close');
            });
        }
    });

    $('#vehicle_form').on('submit', function(event) {
        event.preventDefault();

        if ($('#brand').val() == '') {
            $('#error_brand').text('A marca do veículo deve ser preenchida.');
            $('#brand').css('border-color', '#dc3545');
        } else {
            $('#error_brand').text('');
            $('#brand').css('border-color', '');    
        }
        
        if ($('#model').val() == '') {
            $('#error_model').text('O modelo do veículo deve ser preenchido.');
            $('#model').css('border-color', '#dc3545');
        } else {
            $('#error_model').text('');
            $('#model').css('border-color', '');
        } 
        
        if ($('#year').val() == '') {
            $('#error_year').text('O ano do veículo deve ser preenchido.');
            $('#year').css('border-color', '#dc3545');
        } else {
            $('#error_year').text('');
            $('#year').css('border-color', '');
        }

        if ($('#brand').val() == '' || $('#model').val() == '' || $('#year').val() == '') {
            $('#vehicle_table_dialog').effect('bounce', 'slow');
            return false;
        } else {
            $('#btn_save').attr('disable', 'disable');
            var formData = $(this).serialize();

            $.ajax({
                url: '../../../handler/vehicle_handler.php',
                type: 'POST',
                data: formData,
                success: function(data) {
                    $('#vehicle_table_dialog').dialog('close');
                    $('#action_alert').html(data);
                    $('#action_alert').dialog('open');
                    $('#vehicle_form')[0].reset();
                    loadData();
                    $('#btn_save').attr('disable', false);
                }
            });
        }
    });

    $('#action_alert').dialog({
        autoOpen: false,
        resizable: false,
        show: {
            effect: 'highlight',
            duration: 1500
        },
        hide: {
            effect: 'fade',
            duration: 800
        }
    });

    $(document).on('click','.edit', function() {
        var id = $(this).attr('id');
        $.ajax({
            url: '../../../handler/vehicle_handler.php',
            type: 'POST',
            data: {id: id, action: 'fetchSingle'},
            dataType: 'json',
            success: function(data) {
                $('#brand').val(data.brand);
                $('#model').val(data.model);
                $('#year').val(data.year);

                $('#vehicle_table_dialog').attr('title', 'Editar dados do veículo');
                $('#action').val('update');
                $('#hidden_id').val(id);
                $('#btn_save').val('Atualizar');

                $('#vehicle_table_dialog').dialog('open');

            },
            error: function(request, status, error) {
                console.log(request);
                console.log(status);
                console.log(error);
            }
        });
    });

    $('#delete_confirmation').dialog({
        autoOpen: false,
        modal: true,
        resizable: false,
        buttons: {
            Sim: function() {
                var id = $(this).attr('id');
                console.log(id);

                $.ajax({
                    url: '../../../handler/vehicle_handler.php',
                    type: 'POST',
                    data: {id: id, action: 'delete'},
                    dataType: 'json',
                    success: function(data) {
                        $('#delete_confirmation').dialog('close');
                        $('#action_alert').html(data);
                        $('#action_alert').dialog('open');
                        loadData();
                    }
                });
            },
            Não: function() {
                $(this).css('background', 'bg-danger');
                $(this).dialog('close');
            }
        }
    });

    $(document).on('click', '.delete', function() {
        var id = $(this).attr('id');
        console.log(id);
        $('#delete_confirmation').data('id', id).dialog('open');
    });

    $('#search').on('input', function() {
        var query = $(this).val();

        $.ajax({
            url: '../../../handler/vehicle_handler.php',
            type: 'POST',
            data: {action: 'find', query: query},
            dataType: 'json',
            success: function(data) {
                $('#vehicle_data > tr').remove();
                
                if (data.length > 0) {
                    $('#vehicle_data').html(data);
                } else {
                    loadData();
                }
            }
        });
    });

    loadData();
});