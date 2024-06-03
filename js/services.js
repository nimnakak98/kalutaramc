document.addEventListener('DOMContentLoaded', function () {
    const openButton = document.getElementById('open-btn');
    const closeButton = document.getElementById('close-btn');
    const sidebar = document.getElementById('sidebar');

    openButton.addEventListener('click', function () {
        sidebar.classList.add('open');
    });

    closeButton.addEventListener('click', function () {
        sidebar.classList.remove('open');
    });
});
