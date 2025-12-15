document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("appointmentsCal");

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: "prevYear,prev,next,nextYear today",
            center: "title",
            right: "dayGridMonth,dayGridWeek,dayGridDay",
        },
        initialDate: "2025-12-01",
        navLinks: true,
        editable: false,
        dayMaxEvents: true,

        // Verwijs naar de route in api.php die jouw controller aanroept
        events: {
            url: '/calendar-data',
            failure: function () {
                alert('Was not able to load the calendar');
            }
        },

        //Redirection naar /all-exercises
        eventClick: function (info) {
            info.jsEvent.preventDefault();
            window.location.href = '/all-exercises';
        }

    });

    calendar.render();
});
