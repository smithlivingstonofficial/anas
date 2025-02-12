// Example JavaScript for future functionality
document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll('.sidebar a');
    const sections = document.querySelectorAll('.main-content section');
    
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            // Hide all sections
            sections.forEach(section => {
                section.style.display = 'none';
            });
            
            // Show the selected section
            const target = document.querySelector(button.getAttribute('href'));
            if (target) target.style.display = 'block';
        });
    });

    // Default show first section
    if (sections.length > 0) {
        sections[0].style.display = 'block';
    }
});
