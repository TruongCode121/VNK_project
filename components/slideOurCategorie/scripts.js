function init() {
  var swiper = new Swiper(".section_our_categorie .slide_product .mySwiper", {
    slidesPerView: 6, // Hiển thị 6 phần tử mỗi lần
    spaceBetween: 70, // Khoảng cách giữa các slide
    navigation: {
      nextEl: ".section_our_categorie .slide_product .swiper-button-next",
      prevEl: ".section_our_categorie .slide_product .swiper-button-prev",
    },
    loop: false, // Không lặp lại
  });
}
window.addEventListener("DOMContentLoaded", init);
