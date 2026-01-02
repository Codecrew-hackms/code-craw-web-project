'use strict';
//Slider
const slides = document.querySelectorAll('.slide');
const btnLeft = document.querySelector('.slider__btn--left');
const btnRight = document.querySelector('.slider__btn--right');
const dotContainer = document.querySelector('.dots');

const slider = document.querySelector('.slider');

let curSlide = 0;
const maxslide = slides.length;

slider.style.transform = 'scale(1)';
slider.style.overflow = 'hidden';

const createDots = function() {
  slides.forEach(function(_, i) {
    dotContainer.insertAdjacentHTML('beforeend',
      `<button class="dots__dot" data-slide="${i}"></button>`
    );
  });
};
createDots();

const activateDot = function(slide) {
  document.querySelectorAll('.dots__dot').forEach(dot => dot.classList.remove('dots__dot--active'));

  document.querySelector(`.dots__dot[data-slide="${slide}"]`).classList.add('dots__dot--active');
};
activateDot(0);

const goToSlide = function(slide){
  slides.forEach((s, i) => (s.style.transform = `translateX(${100 * (i - slide)}%)`));
};

goToSlide(0);

//Next slide
const nextSlide = function() {
  if (curSlide === maxslide - 1) {
    curSlide = 0;
  } else {
    curSlide++;
  }

  goToSlide(curSlide);
  activateDot(curSlide);
};

const preSlide = function(){
  if (curSlide == 0){
    curSlide = maxslide - 1;
  } else {
    curSlide--;
  }
  goToSlide(curSlide);
  activateDot(curSlide);
}; 

btnRight.addEventListener('click', nextSlide);
btnLeft.addEventListener('click', preSlide);

document.addEventListener('keydown', function(e) {
  if(e.key === 'ArrowLeft') preSlide();
  e.key === 'ArrowRight' && nextSlide();
});

dotContainer.addEventListener('click', function(e) {
  if(e.target.classList.contains('dots__dot')){
    const{slide} = e.target.dataset;
    goToSlide(slide);
    activateDot(slide);
  }
});

//scroll
const aboutLink = document.querySelector('#about-link');
const footer = document.querySelector('#footer');

aboutLink.addEventListener('click', function (e) {
  e.preventDefault();

  footer.scrollIntoView({
    behavior: 'smooth'
  });
});