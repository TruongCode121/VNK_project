let isSyncing = false;
var swiperSlide = new Swiper(".aboutUs_sliderMb .slideWiperMb", {
  loop: true,
  slidesPerView: 2, // Show 3 slides at a time
  centeredSlides: true, // Center the active
  on: {
    slideChange: function () {
      if (swiperSlideContent) {
        if (!isSyncing) {
          isSyncing = true;
          swiperSlideContent.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});
var swiperSlideContent = new Swiper(".aboutUs_sliderMb .slideWiperContentMb", {
  loop: true,
  slidesPerView: 1, // Show 3 slides at a time
  centeredSlides: true, // Center the active
  on: {
    slideChange: function () {
      if (swiperSlide) {
        if (!isSyncing) {
          console.log(this.realIndex);

          isSyncing = true;
          swiperSlide.slideTo(this.realIndex);
          isSyncing = false;
        }
      }
    },
  },
});
// bindSwipers(swiperSlide, swiperSlideContent);
const btnSeeMores = document.querySelectorAll(
  ".aboutUs_sliderMb .slideWiperContentMb .swiper-slide .inner-slide .seeMore"
);
btnSeeMores.forEach((item) => {
  const contentSlide = item.previousElementSibling;
  item.addEventListener("click", function () {
    this.classList.add("hidden");
    contentSlide.style.height = "fit-content";
  });
});
