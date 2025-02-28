
document.addEventListener('DOMContentLoaded', function() {
    const burgerBtn = document.querySelector('.header__burger-btn');
    const nav = document.querySelector('.header__nav');
  
    burgerBtn.addEventListener('click', function() {
        burgerBtn.classList.toggle('active');
        nav.classList.toggle('active');
    });
  });
  
  function animateOpacity(element, targetOpacity, duration) {
    let start = null;
    const startOpacity = parseFloat(element.style.opacity || 0); // Убеждаемся, что берем 0 если opacity не задано
    targetOpacity = parseFloat(targetOpacity);
  
    function step(timestamp) {
      if (!start) start = timestamp;
      const progress = Math.min(1, (timestamp - start) / duration);
      element.style.opacity = (startOpacity + (targetOpacity - startOpacity) * progress);
  
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        element.style.opacity = targetOpacity; // Явно ставим targetOpacity
      }
    }
  
    requestAnimationFrame(step);
  }
  
  const myElement = document.getElementById(' swiper-slide hero-section swiper-slide-visible swiper-slide-active  ');
  myElement.style.opacity = 0; // Начальное значение 0
  animateOpacity(myElement, 1, 500); // Анимация до opacity 1 за 500ms
  element.addEventListener('transitionend', function() {
    element.style.opacity = 1;
});