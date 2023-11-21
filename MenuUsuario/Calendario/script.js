document.addEventListener('DOMContentLoaded', function() {
    const calendarContainer = document.getElementById('calendar');
    const monthYear = document.getElementById('month-year');
    const prevMonthBtn = document.getElementById('prev-month');
    const nextMonthBtn = document.getElementById('next-month');

    let currentDate = new Date();

    const popup = document.getElementById('popup');
    const fechaInfo = document.getElementById('fecha-info');
    const closeBtn = document.querySelector('.close-btn');

    closeBtn.onclick = () => popup.style.display = 'none';

    function loadPopupContent(date) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'detalles_fecha.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status === 200) {
                fechaInfo.innerHTML = this.responseText;
            } else {
                fechaInfo.textContent = 'Error al cargar proyectos';
            }
        };
        xhr.send('fecha=' + date);
    }
    const loadCalendar = (date) => {
        const year = date.getFullYear();
        const month = date.getMonth();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        calendarContainer.innerHTML = '';
        monthYear.textContent = `${date.toLocaleString('es', { month: 'long' })} ${year}`;

        for (let i = 1; i <= daysInMonth; i++) {
            const dayElem = document.createElement('div');
            dayElem.classList.add('day');
            dayElem.textContent = i;
            dayElem.onclick = () => {
                const selectedDate = `${year}-${month + 1}-${i}`; // Formato de fecha Año-Mes-Día
                loadPopupContent(selectedDate);
                popup.style.display = 'block';
            };
            calendarContainer.appendChild(dayElem);
        }
    }

    prevMonthBtn.onclick = () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        loadCalendar(currentDate);
    }

    nextMonthBtn.onclick = () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        loadCalendar(currentDate);
    }

    loadCalendar(currentDate);
});