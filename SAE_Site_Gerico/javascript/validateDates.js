function validateDates() {
    const startDate = new Date(document.getElementById('start-date').value);
    const endDate = new Date(document.getElementById('end-date').value);
    const today = new Date();

    if (startDate < today || endDate < today) {
        alert("Les dates de congé ne peuvent pas être dans le passé.");
        return false;
    }

    if (startDate > endDate) {
        alert("La date de début ne peut pas être après la date de fin.");
        return false;
    }

    const holidays = [
        '2024-01-01',
        '2024-04-21',
        '2024-05-01',
        '2024-05-08',
        '2024-05-30',
        '2024-07-14',
        '2024-08-15',
        '2024-11-01',
        '2024-11-11',
        '2024-12-25'
    ];

    const isWeekendOrHoliday = (date) => {
        const day = date.getDay();
        const formattedDate = date.toISOString().split('T')[0];
        return day === 0 || day === 6 || holidays.includes(formattedDate);
    };

    for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
        if (isWeekendOrHoliday(d)) {
            alert("Les dates de congé ne peuvent pas inclure les week-ends ou les jours fériés.");
            return false;
        }
    }

    return true; 
}
