document.addEventListener("DOMContentLoaded", function () {
    // Set today's date automatically when the page loads
    const dateInput = document.getElementById('wasteDate');
    if (dateInput) { 
        dateInput.valueAsDate = new Date(); 
    }

    const form = document.getElementById('wasteForm');
    if (form) {
        form.addEventListener('submit', function (e) {
            const typeInput = document.getElementById('wasteType');
            const weightInput = document.getElementById('wasteWeight');
            const notesInput = document.getElementById('wasteNotes');
            const dateInput = document.getElementById('wasteDate');

            let isValid = true;
            let errorMessage = "";

            // 1. Validation: Weight must be positive and not too high
            let weightVal = parseFloat(weightInput.value);
            if (isNaN(weightVal) || weightVal <= 0) {
                isValid = false;
                errorMessage += "- Weight must be positive.\n";
            }

            if (!isValid) {
                e.preventDefault(); // Stop the form from submitting
                alert(errorMessage);
                return;
            }

            // 2. Save to LocalStorage (optional - only if you want data to persist without page refresh)
            const newEntry = {
                date: dateInput.value,
                type: typeInput.value,
                weight: weightInput.value,
                notes: notesInput.value || '-'
            };

            let wasteList = JSON.parse(localStorage.getItem('spaceEcoData')) || [];
            wasteList.push(newEntry);
            localStorage.setItem('spaceEcoData', JSON.stringify(wasteList));

            // 3. Form continues to db-process-log.php automatically
            console.log("Validation passed. Saving to database...");
        });
    }
});