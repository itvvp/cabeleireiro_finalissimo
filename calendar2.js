document.addEventListener('DOMContentLoaded', function() {

    var url ='./';
    var initialLocaleCode = 'pt';
    var localeSelectorEl = document.getElementById('locale-selector');

    $('body').on('click', '.datetimepicker', function() {
        $(this).not('.hasDateTimePicker').datetimepicker({
            controlType: 'select',
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            timeFormat: 'HH:mm:ss',
            yearRange: "1900:+10",
            showOn:'focus',
            firstDay: 1
        }).focus();
    });

    $(".colorpicker").colorpicker();
    
    var calendarEl = document.getElementById('calendar');

    var today = new Date();
var dd = String(today.getDate()).padStart(2, '0');
var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
var yyyy = today.getFullYear();
today = yyyy + '-' + mm + '-' + dd;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['timeGrid', 'list'],
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'listMonth'
        },
        defaultView: 'listMonth',
        initialView: 'listMonth',
        locale: 'pt',
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
       defaultDate: today,
        events: url+'api/load_ind.php',
        eventDrop: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            if (arg.event.end == null) {
                end = start;
            } else {
                var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();
            }

            $.ajax({
              url:url+"api/update_ind.php",
              type:"POST",
              data:{id:arg.event.id, start:start, end:end},
            });
        },
        eventResize: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();

            $.ajax({
              url:url+"api/update_ind.php",
              type:"POST",
              data:{id:arg.event.id, start:start, end:end},
            });
        },
        eventClick: function(arg) {
            var id = arg.event.id;
            
            $('#editEventId').val(id);
            $('#deleteEvent').attr('data-id', id); 
         // console.log("id:"+id);
            $.ajax({
              url:url+"api/getevent_ind.php?id="+id,
              type:"POST",
              dataType: 'json',
              data:{id:id},
              success: function(data) {
                    $('#startdate_editar').val(data[0].data_inicio);
                    $('#starttime_editar').val(data[0].hora_inicio);
                    $('#endtime_editar').val(data[0].hora_fim);
                    $('#notashospede').val(data[0].notas);
                    $('#editeventmodal').modal();
                }
            });

            $('body').on('click', '#deleteEvent', function() {
               // if(confirm("Tem a certeza que deseja remover este registo?")) {
                    $.ajax({
                        url:url+"api/delete_ind.php",
                        type:"POST",
                        data:{id:arg.event.id},
                    }); 

                    //close model
                    $('#editeventmodal').modal('hide');

                    //refresh calendar
                    calendar.refetchEvents();         
               // }
            });
            
            calendar.refetchEvents();
        }
    });
  //  calendar.setOption('locale', 'pt');
    calendar.render();

    $('#createEvent').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text

        // process the form
        $.ajax({
            type        : "POST",
            url         : url+'api/insert_ind.php',
            data        : $(this).serialize(),
            dataType    : 'json',
            encode      : true
        }).done(function(data) {
           // console.log(data);
          //  console.log("Sucesso:" + data.success);
            // insert worked
            if (data.success) {
                $('#erro_inserir').hide();
                //remove any form data
                $('#createEvent').trigger("reset");

                //close model
                $('#addeventmodal').modal('hide');

                //refresh calendar
                calendar.refetchEvents();

            } else {
                //if error exists update html
               
                if (data.errors.totalRegistos) {
                    $('#erro_inserir').show();
                  //  console.log("Erro total de registos");
                    $('#erro').addClass('has-error');
                    $('#erro').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.totalImpedimentos) {
                    $('#erro_inserir_sem').show();
                 //   console.log("Erro total de registos");
                    $('#erro').addClass('has-error');
                    $('#erro').append('<div class="help-block">' + data.errors.date + '</div>');
                }
                

                //if error exists update html
                if (data.errors.date) {
                    $('#date-group').addClass('has-error');
                    $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.title) {
                    $('#title-group').addClass('has-error');
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                }

            }

        });
    });

    $('#editEvent').submit(function(event) {

        // stop the form refreshing the page
        event.preventDefault();

        $('.form-group').removeClass('has-error'); // remove the error class
        $('.help-block').remove(); // remove the error text
        
        //form data
        var id = $('#editEventId').val();
        var startdate_editar = $('#startdate_editar').val();
        var starttime_editar = $('#starttime_editar').val();
        var endtime_editar = $('#endtime_editar').val();
        var notashospede = $('#notashospede').val();

        // process the form
        $.ajax({
            type        : "POST",
            url         : url+'api/update_ind.php',
            data        : {
                id:id, 
                startdate_editar:startdate_editar, 
                starttime_editar:starttime_editar,
                endtime_editar:endtime_editar
            },
            dataType    : 'json',
            encode      : true
        }).done(function(data) {
            console.log(data);
            // insert worked
            if (data.success) {
                
                //remove any form data
                $('#editEvent').trigger("reset");

                //close model
                $('#editeventmodal').modal('hide');

                //refresh calendar
                calendar.refetchEvents();

            } else {

                if (data.errors.totalRegistos) {
                    $('#erro_editar').show();
                    console.log("Erro total de registos");
                    $('#erro').addClass('has-error');
                    $('#erro').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.totalImpedimentos) {
                    $('#erro_editar_sem').show();
                 //   console.log("Erro total de registos");
                    $('#erro').addClass('has-error');
                    $('#erro').append('<div class="help-block">' + data.errors.date + '</div>');
                }
                //if error exists update html
                if (data.errors.date) {
                    $('#date-group').addClass('has-error');
                    $('#date-group').append('<div class="help-block">' + data.errors.date + '</div>');
                }

                if (data.errors.title) {
                    $('#title-group').addClass('has-error');
                    $('#title-group').append('<div class="help-block">' + data.errors.title + '</div>');
                }

            }

        });
    });
});