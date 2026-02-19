$(document).ready(function () {

    // 1. Initialize Bootstrap Tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // 2. Audio & Animation Management
    const audio = document.getElementById('stationAudio');
    const animationContainer = $('.aside-animation');

    if (audio) {
        // When audio plays, add a glow effect to the container
        audio.onplay = function () {
            animationContainer.css({
                'border': '2px solid #fbc02d',
                'box-shadow': '0 0 20px rgba(251, 192, 45, 0.4)',
                'transition': 'all 0.5s ease',
                'border-radius': '12px'
            });
        };

        // When audio pauses, remove the effect
        audio.onpause = function () {
            animationContainer.css({
                'border': '2px solid transparent',
                'box-shadow': 'none'
            });
        };
    }

    // 3. Card Hover Effects (jQuery)
    // Adds a subtle lift and highlight when hovering over tip cards
    $('.info-card').hover(
        function () {
            $(this).css('border-color', '#fbc02d'); // Highlight border yellow
            $(this).find('i').addClass('fa-bounce'); // FontAwesome bounce animation for icon
        },
        function () {
            $(this).css('border-color', 'rgba(255, 255, 255, 0.3)'); // Reset border
            $(this).find('i').removeClass('fa-bounce');
        }
    );

    // 4. Download Button Interaction
    $('.btn-primary-custom').on('click', function () {
        // Simulate a system process
        let btn = $(this);
        let originalText = btn.html();

        btn.html('<i class="fas fa-spinner fa-spin"></i> Syncing...');
        btn.addClass('disabled');

        setTimeout(function () {
            alert("Preparing PDF for download... Please wait for synchronization with ISS Database.");
            btn.html(originalText);
            btn.removeClass('disabled');
        }, 1500);
    });

});