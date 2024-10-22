new Swiper(".global_expansition .slide_expansiton", {
  loop: true,

  navigation: {
    nextEl: ".slideWrapper .slider_button_prev", // Down arrow button
    prevEl: ".slideWrapper .slider_button_next", // Up arrow button
  },
  breakpoints: {
    0: {
      slidesPerView: 1.2,
      spaceBetween: 12,
    },
    769: {
      slidesPerView: 3, // Show 3 slides at a time
      centeredSlides: false, //
      spaceBetween: 24,
    },
  },
});
