window.mobilecheck = function() {
    var check = false;
    (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
    return check;
  };
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
        plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        locale: 'pt',
        
        navLinks: true, // can click day/week names to navigate views
        businessHours: true, // display business hours
        editable: true,
       defaultDate: today,
        events: url+'api/load.php',
        eventDrop: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            if (arg.event.end == null) {
                end = start;
            } else {
                var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();
            }

            $.ajax({
              url:url+"api/update.php",
              type:"POST",
              data:{id:arg.event.id, start:start, end:end},
            });
        },
        eventResize: function(arg) {
            var start = arg.event.start.toDateString()+' '+arg.event.start.getHours()+':'+arg.event.start.getMinutes()+':'+arg.event.start.getSeconds();
            var end = arg.event.end.toDateString()+' '+arg.event.end.getHours()+':'+arg.event.end.getMinutes()+':'+arg.event.end.getSeconds();

            $.ajax({
              url:url+"api/update.php",
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
              url:url+"api/getevent.php?id="+id,
              type:"POST",
              dataType: 'json',
              data:{id:id},
              success: function(data) {
                  var id_tratamento=data[0].id_tratamento;
                    if(id_tratamento!=9999)
                    {
                        $('#marcacao_normal').show();
                        $('#marcacao_bloqueio').hide();
                      //  $('#marcacao_normal').style.display='block';
                      //  $('#marcacao_bloqueio').style.display='none';
                        $('#tratamento_editar').val(data[0].tratamento);
                    
                        $('#nomehospede').val(data[0].nome_hospede);
                        $('#quartohospede').val(data[0].quarto);
                        $('#notashospede').val(data[0].notas);
                        $('#notasbloqueio').val(data[0].notas);
                        $('#startdate').val(data[0].data_inicio);
                        $('#starttime').val(data[0].hora_inicio);
                        //if(id_tratamento!='9999')
                            $('#editeventmodal').modal();
                    }
                    else
                    {
                        $('#marcacao_normal').hide();
                        $('#marcacao_bloqueio').show();
                    //    $('#marcacao_normal').style.display='none';
                    //    $('#marcacao_bloqueio').style.display='block';
                        $('#tratamento_editar').val(data[0].tratamento);
                    
                        $('#nomehospede').val(data[0].nome_hospede);
                        $('#quartohospede').val(data[0].quarto);
                        $('#notashospede').val(data[0].notas);
                        $('#notasbloqueio').val(data[0].notas);
                        $('#startdate').val(data[0].data_inicio);
                        $('#starttime').val(data[0].hora_inicio);
                        //if(id_tratamento!='9999')
                            $('#editeventmodal').modal();
                    }

                }
            });

            $('body').on('click', '#deleteEvent', function() {
                if(confirm("Tem a certeza que deseja remover esta marcação?")) {
                    $.ajax({
                        url:url+"api/delete.php",
                        type:"POST",
                        data:{id:arg.event.id},
                    }); 

                    //close model
                    $('#editeventmodal').modal('hide');

                    //refresh calendar
                    calendar.refetchEvents();         
                }
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
            url         : url+'api/insert.php',
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
        var nomehospede = $('#nomehospede').val();
        var quartohospede = $('#quartohospede').val();
        var notashospede = $('#notashospede').val();
        var startdate = $('#startdate').val();
        var starttime = $('#starttime').val();

        // process the form
        $.ajax({
            type        : "POST",
            url         : url+'api/update.php',
            data        : {
                id:id, 
                nomehospede:nomehospede, 
                quartohospede:quartohospede,
                notashospede:notashospede,
                startdate:startdate,
                starttime:starttime
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