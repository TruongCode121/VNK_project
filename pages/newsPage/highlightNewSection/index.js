var imgSwiper = new Swiper(".myNewsImgSwiper", {
  slidesPerView: 1,
  allowTouchMove: false,
});
var newsSwiper = new Swiper(".myNewsSwiper", {
  slidesPerView: 1,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".news-swiper-pagination",
  },
  thumbs: {
    swiper: imgSwiper,
  },
});

var newsSwiperMb = new Swiper(".myNewsSwiperMb", {
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
      el: ".news-swiper-pagination-mb",
    },
  });