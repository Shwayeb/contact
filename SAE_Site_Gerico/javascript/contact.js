document.addEventListener('DOMContentLoaded', function () {
    AOS.init();

    const form = document.getElementById('contactForm');
    form.addEventListener('submit', function (event) {
        event.preventDefault();

        // Simulate form submission
        const modal = new bootstrap.Modal(document.getElementById('success-modal'));
        modal.show();

        // Clear form fields after submission
        form.reset();
    });
});
