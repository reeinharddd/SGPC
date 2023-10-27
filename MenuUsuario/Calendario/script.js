document.addEventListener('DOMContentLoaded', function() {
    const daysInMonth = (month, year) => new Date(year, month, 0).getDate();
    const calendarBody = document.querySelector('.calendar-body');
    const currentMonthYear = document.getElementById('currentMonthYear');
    
    let currentMonth = 9;
    let currentYear = 2023;

    const loadMonth = (month, year) => {
        calendarBody.innerHTML = '';
        
        // Cargar nuevas fechas
        for (let i = 1; i <= daysInMonth(month + 1, year); i++) {
            const dayDiv = document.createElement('div');
            dayDiv.innerText = i;
            dayDiv.addEventListener('click', function() {
                window.location.href = `detalles_fecha.html?day=${i}&month=${currentMonth + 1}&year=${currentYear}`;
            });
            calendarBody.appendChild(dayDiv);
        }

        const monthNames = [
            "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
            "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
        ];
        currentMonthYear.innerText = `${monthNames[month]} ${year}`;
    }

    document.getElementById('prevMonth').addEventListener('click', function() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11; // Diciembre
            currentYear--;
        }
        loadMonth(currentMonth, currentYear);
    });

    document.getElementById('nextMonth').addEventListener('click', function() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0; // Enero
            currentYear++;
        }
        loadMonth(currentMonth, currentYear);
    });

    // Cargar el mes inicial
    loadMonth(currentMonth, currentYear);
});