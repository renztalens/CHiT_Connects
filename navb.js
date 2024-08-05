let btn = document.querySelector('#btn');
let sidebar = document.querySelector('.sidebar');

btn.onclick = function() {
    sidebar.classList.toggle('active');
    
    if (sidebar.classList.contains('active')) {
        document.addEventListener('click', closeSidebarOnClickOutside);
    } else {
        document.removeEventListener('click', closeSidebarOnClickOutside);
    }
};

function closeSidebarOnClickOutside(event) {
    if (!sidebar.contains(event.target) && !btn.contains(event.target)) {
        sidebar.classList.remove('active');
        document.removeEventListener('click', closeSidebarOnClickOutside);
    }
}
