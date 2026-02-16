document.addEventListener('DOMContentLoaded', () => {
    // Current Page Active State
    const currentPath = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPath || (currentPath === '' && link.getAttribute('href') === 'index.html')) {
            link.classList.add('active');
        }
    });

    // Mock functionality for "Export" buttons
    const exportBtns = document.querySelectorAll('.btn-export');
    exportBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            alert('Exporting report... (Mock Functionality)');
        });
    });
});
