// assets/js/main.js

document.addEventListener("DOMContentLoaded", function () {
    // Mobile menu toggle
    const navToggle = document.getElementById("navToggle");
    const navMenu = document.getElementById("navMenu");

    if (navToggle && navMenu) {
        navToggle.addEventListener("click", function () {
            navMenu.classList.toggle("show");
        });
    }

    // Scroll to top button (optional)
    const scrollBtn = document.getElementById("scrollTop");
    if (scrollBtn) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 300) {
                scrollBtn.style.display = "block";
            } else {
                scrollBtn.style.display = "none";
            }
        });

        scrollBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // Smooth scroll for anchor links (optional)
    const anchors = document.querySelectorAll('a[href^="#"]');
    anchors.forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
 const quotes = [
    "Your health is an investment, not an expense. 💪",
    "Small steps every day lead to big results. 🚶‍♀️",
    "Eat better, feel better, live better. 🥗",
    "Discipline is choosing what you want most over what you want now. ⏳",
    "Sweat is just fat crying. 🏋️",
    "Hydrate today, shine tomorrow. 💧",
    "Self-care is how you take your power back. 🌸",
    "Fall in love with taking care of yourself. ❤️"
  ];

  // Pick random quote
     const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
       document.getElementById("motivation-text").textContent = randomQuote;

});

