<script>
    $(function() {
        $('.demo').each(function() {

            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                change: function(hex, opacity) {
                    if (!hex)
                        return;
                    if (opacity)
                        hex += ', ' + opacity;
                    try {
                        console.log(hex);
                    } catch (e) {
                    }
                },
                theme: 'bootstrap'
            });

        });
        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
            //console.log(ele);
            ele.each(function() {

                // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
                // it doesn't need to have a start or end
                var eventObject = {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    room: $(this).data('room'),
                    backgroundColor: $(this).data('color'),
                    borderColor: "#f56954", //red
                    name: $(this).data('name'),
                    priority: $(this).data('priority')
                };

                // store the Event Object in the DOM element so we can get to it later
                $(this).data('eventObject', eventObject);

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1070,
                    revert: true, // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
                m = date.getMonth(),
                y = date.getFullYear();
        /* Set event generation values */
        function set_event_generation_values(event_id, bg_color, name, priority, room_id) {
            $('#txt_current_event').val(event_id);
            $('#txt_background_color').minicolors('value',bg_color);
            $('#new-event').val(name);
            $('#pri-event').val(priority);
            $("#room-event option[value='" + room_id + "']").attr('selected', 'selected');
        }
        /* Initialise event clicks */
        function calendar_event_clicked(cal_event, js_event, view) {
            //Set generation values
            set_event_generation_values(cal_event.id, cal_event.backgroundColor, cal_event.name, cal_event.priority, cal_event.room_id);
        }
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            buttonText: {//This is to add icons to the visible buttons
                prev: "<span class='fa fa-caret-left'></span>",
                next: "<span class='fa fa-caret-right'></span>",
                today: 'Hôm nay',
                month: 'tháng',
                week: 'tuần',
                day: 'ngày'
            },
            //Random default events
            /*events: [
             {
             url: "<?php //echo Router::url('/', true) . 'courses_rooms/add';                    ?>",
             title: 'All Day Event',
             start: new Date(y, m, 1),
             room: 'Phòng B8',
             backgroundColor: "#f56954", //red 
             borderColor: "#f56954" //red
             },
             {
             title: 'Birthday Party',
             //url:,
             start: new Date(y, m, d + 1, 19, 0),
             end: new Date(y, m, d + 1, 22, 30),
             allDay: false,
             room: 'Phòng B12',
             backgroundColor: "#00a65a", //Success (green)
             borderColor: "#00a65a" //Success (green)
             }
             
             ],*/
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            eventRender: function(event, element) {
                var stDate = $.fullCalendar.formatDate(event.start, "hh:mm ngày dd-MM-yyyy");
                var content = '<h3>' + event.name + '</h3>' +
                        '<p><b>Bắt đầu:</b> ' + stDate + '<br />' +
                        (event.room && '<p><b>Địa điểm:</b> ' + event.room + '</p>' || '');
                element.qtip({
                    content: {
                        text: content

                    }



                });
            },
            drop: function(date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');
                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);
                // assign it the date that was reported
                copiedEventObject.id = $(this).data("id");
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).data("color");
                copiedEventObject.borderColor = $(this).css("border-color");
                copiedEventObject.room_id = $(this).data("room_id");
                copiedEventObject.room = $(this).data("room");
                copiedEventObject.name = $(this).data("name");

                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                $(this).remove();

            },
            eventClick: function(calEvent, jsEvent, view) {
                //console.log(calEvent);
                calendar_event_clicked(calEvent, jsEvent, view);
            }
        });

        /* ADDING EVENTS */
        var currColor = "#f56954"; //Red by default
        //Color chooser button         var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function(e) {
            e.preventDefault();
            //Save color
            currColor = $(this).css("color");
            //Add color effect to button
            colorChooser
                    .css({"background-color": currColor, "border-color": currColor})
                    .html($(this).text() + ' <span class="caret"></span>');
        });
        var form = $('#addBuoiForm');
        form.on('submit', function(e) {
            $(this).append('<input type="hidden" name="data[CoursesRoom][course_id]" value="<?php echo $course_id; ?>">');
            e.preventDefault();

            $(this).ajaxSubmit({
                url: '/courses_rooms/add.json',
                success: addBuoiResponse
            });
            return false;
        });

        function addBuoiResponse(responseText, statusText, xhr, $form) {
            if (responseText.response.status) {
                var event = $("<div />");
                event.css(
                        {
                            "id": responseText.response.id,
                            "background-color": responseText.response.currColor,
                            "border-color": responseText.response.currColor,
                            "color": "#fff"}).addClass("external-event");
                event.attr('data-room', responseText.response.room);
                event.attr('data-name', responseText.response.name);
                event.attr('data-room_id', responseText.response.room_id);
                event.attr('data-priority', responseText.response.priority);
                event.attr('data-color', responseText.response.currColor);

                event.html(responseText.response.name);
                $('#external-events').prepend(event);
                //Thêm khả năng kéo thả
                ini_events(event);
            } else {
                var error = responseText.response.message;
                $('#message').html(error);
            }
            return true;
        }


    });
</script>