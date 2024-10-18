function init() {
  var swiper = new Swiper(".wrap_product_detail .product_image .mySwiper", {
    spaceBetween: 10,
    slidesPerView: 4.3,
    freeMode: true,
    watchSlidesProgress: true,
  });
  new Swiper(".wrap_product_detail .product_image  .mySwiper2", {
    spaceBetween: 10,
    navigation: {
      nextEl: ".wrap_product_detail .product_image .swiper-button-next",
      prevEl: ".wrap_product_detail .product_image .swiper-button-prev",
    },
    thumbs: {
      swiper: swiper,
    },
  });

  // accordion
  const accordion_product_header = document.querySelectorAll(
    ".accordion_product_detail .accordion_product-header"
  );
  const accordion_product_content = document.querySelectorAll(
    ".accordion_product_detail .accordion_product-content"
  );

  if (accordion_product_content.length > 0) {
    accordion_product_content[0].style.height =
      accordion_product_content[0].scrollHeight + "px";
  }
  accordion_product_header.forEach((header, index) => {
    header.addEventListener("click", function () {
      const accordionContent = header.nextElementSibling;

      // Đóng tất cả các accordion khác
      accordion_product_content.forEach((content) => {
        if (content !== accordionContent) {
          content.style.height = null; // Đặt height về null để đóng các accordion khác
          content.previousElementSibling.classList.remove("active");
        }
      });
      header.classList.toggle("active");

      if (header.classList.contains("active")) {
        accordionContent.style.height = accordionContent.scrollHeight + "px";
      } else {
        accordionContent.style.height = null; // Khi đóng lại
      }
    });
  });
  var swiper = new Swiper(".product_detail_page .slide_product .mySwiper", {
    slidesPerView: 6, // Hiển thị 6 phần tử mỗi lần
    spaceBetween: 70, // Khoảng cách giữa các slide
    navigation: {
      nextEl: ".product_detail_page .slide_product .swiper-button-next",
      prevEl: ".product_detail_page .slide_product .swiper-button-prev",
    },
    loop: false, // Không lặp lại
  });
}
window.addEventListener("DOMContentLoaded", init);
