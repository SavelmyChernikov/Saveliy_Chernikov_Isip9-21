"use strict";

function reveal() {
  var reveals = document.querySelectorAll(".feature-card, .story, .services-block, .feedback-container-oc");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("show");
    } else {
      reveals[i].classList.remove("show");
    }
  }
}

window.addEventListener("scroll", reveal);

// Проверяем видимость элементов при загрузке страницы и при прокрутке
window.addEventListener('load', checkVisibility);
window.addEventListener('scroll', checkVisibility);


