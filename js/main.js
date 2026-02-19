/* File: js/main.js */

document.addEventListener("DOMContentLoaded", function () {

    // ==========================================
    // PART 1: UI SETTINGS 
    // ==========================================
    const userSpan = document.getElementById("currentUser");

    if (userSpan) {
        userSpan.innerText = "Guest";
    }

    // ==========================================
    // PART 2: TIPS INTERACTIVITY
    // ==========================================
    const tipBox = document.querySelector(".daily-tip");
    if (tipBox) {
        const tips = [
            "Compress plastic.",
            "Check water filters.",
            "Separate aluminum.",
            "Report leaks.",
            "Secure loose items."
        ];

        tipBox.addEventListener("click", function () {
            tipBox.innerHTML = "<strong>Tip:</strong> " + tips[Math.floor(Math.random() * tips.length)];
        });
    }

    // ==========================================
    // PART 3: TABLE BUTTONS (If present)
    // ==========================================
    const tableButtons = document.querySelectorAll("table button");
    if (tableButtons.length > 0) {
        tableButtons.forEach(function (btn) {
            btn.addEventListener("click", function () {
                // Simple visual feedback if buttons exist inside a table
                btn.innerText = "Done";
                btn.disabled = true;
                btn.style.background = "#ccc";
            });
        });
    }
});