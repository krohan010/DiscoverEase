let navs = document.querySelectorAll('.nav');
navs.forEach(a => {
    a.addEventListener("click", () => {
        // Remove 'active' class from all elements
        navs.forEach(nav => nav.classList.remove("active"));

        // Add 'active' class to the clicked element
        a.classList.add("active");
    });
});