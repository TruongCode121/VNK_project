function init() {
  new Swiper(".section_our_categorie .slide_product .mySwiper", {
    slidesPerView: 6, // Hiển thị 6 phần tử mỗi lần
    spaceBetween: 70, // Khoảng cách giữa các slide
    navigation: {
      nextEl: ".section_our_categorie .slide_product .swiper-button-next",
      prevEl: ".section_our_categorie .slide_product .swiper-button-prev",
    },
    speed: 600,
    breakpoints: {
      // Khi độ rộng màn hình >= 640px
      0: {
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: "auto",
        spaceBetween: 60,
      },
      // Khi độ rộng màn hình >= 768px
      769: {
        slidesPerView: 6,
        spaceBetween: 40,
      },
      1200: {
        slidesPerView: 6,
        spaceBetween: 70,
      },
    },
    loop: false, // Không lặp lại
  });
}
window.addEventListener("DOMContentLoaded", init);
