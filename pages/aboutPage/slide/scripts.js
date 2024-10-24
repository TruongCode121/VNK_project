// function init() {
let isSyncing = false;

// function bindSwipers(...swiperList) {
//   for (const swiper of swiperList) {
//     swiper.slideTo = function (index, speed, runCallbacks, doNotPropagate) {
//       if (doNotPropagate) {
//         Swiper.prototype.slideTo.apply(this, arguments);
//       } else {
//         for (const swiper of swiperList) {
//           swiper.slideTo(index, speed, runCallbacks, true);
//         }
//       }
//     };
//   }
// }
var swiper1 = new Swiper(".slideWrapper .slideWiper1", {
  direction: "vertical", // Set to vertical
  loop: true,
  slidesPerView: 5, // Show 3 slides at a time
  centeredSlides: true, // Center the active
  navigation: {
    nextEl: ".slideWrapper .slider_button_prev", // Down arrow button
    prevEl: ".slideWrapper .slider_button_next", // Up arrow button
  },
  spaceBetween: 25, // Space between the slides
  on: {
    slideChange: function () {
      if (swiper3 && swiper4) {
        if (!isSyncing) {
          isSyncing = true;
          swiper3.slideTo(this.realIndex);
          swiper4.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});
// }
// window.addEventListener("DOMContentLoaded", init);
var swiper2 = new Swiper(".slideWrapper .slideWiperdot", {
  direction: "vertical", // Set to vertical
  loop: true,
  slidesPerView: 5, // Show 3 slides at a time
  centeredSlides: true, // Center the active slide
  navigation: {
    nextEl: ".slideWrapper .slider_button_prev", // Down arrow button
    prevEl: ".slideWrapper .slider_button_next", // Up arrow button
  },
  on: {
    slideChange: function () {
      if (swiper1 && swiper3 && swiper4) {
        if (!isSyncing) {
          isSyncing = true;
          swiperSlideContent.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});

var swiper3 = new Swiper(".slideWrapper .groupSlide .slideWiperyear2", {
  direction: "vertical", // Set to vertical
  loop: true,
  slidesPerView: 3, // Show 3 slides at a time
  centeredSlides: true, // Center the active slide
  navigation: {
    nextEl: ".slideWrapper .slider_button_prev", // Down arrow button
    prevEl: ".slideWrapper .slider_button_next", // Up arrow button
  },
  spaceBetween: 20, // Space between the slides
  on: {
    slideChange: function () {
      if (swiper1 && swiper4) {
        if (!isSyncing) {
          isSyncing = true;
          swiper1.slideTo(this.realIndex);
          swiper4.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});
var swiper4 = new Swiper(".slideWrapper .groupSlide .slideWiperText", {
  direction: "vertical", // Set to vertical
  loop: true,
  slidesPerView: 3, // Show 3 slides at a time
  centeredSlides: true, // Center the active slide
  navigation: {
    nextEl: ".slideWrapper .slider_button_prev", // Down arrow button
    prevEl: ".slideWrapper .slider_button_next", // Up arrow button
  },
  spaceBetween: 20, // Space between the slides
  on: {
    slideChange: function () {
      if (swiper1 && swiper3) {
        if (!isSyncing) {
          isSyncing = true;
          swiper1.slideTo(this.realIndex);
          swiper3.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});
// if (swiper1 && swiper2 && swiper3 && swiper4) {
//   swiper1.controller.control = [swiper2, swiper3, swiper4];
//   swiper2.controller.control = [swiper1, swiper3, swiper4];
//   // swiper3.controller.control = [swiper1, swiper2, swiper4];
//   // swiper4.controller.control = [swiper1, swiper2, swiper3];
// }
// bindSwipers(swiper1, swiper3, swiper4);
