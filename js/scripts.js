"use strict";

document.addEventListener('DOMContentLoaded', () => {
    console.log('Working...');
});
document.addEventListener('DOMContentLoaded', function() {
    const burgerBtn = document.querySelector('.header__burger-btn');
    const nav = document.querySelector('.header__nav');
  
    burgerBtn.addEventListener('click', function() {
        burgerBtn.classList.toggle('active');
        nav.classList.toggle('active');
    });
  });