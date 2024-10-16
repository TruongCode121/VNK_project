let header = document.getElementById("header");
new Swiper(".section_banner_homepage .mySwiper", {
  spaceBetween: 30,
  effect: "fade",
  pagination: {
    el: ".section_banner_homepage .swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 3000,
    disableOnInteraction: false,
  },
  loop: true,
  on: {
    slideChange: function () {
      // Lấy tất cả các phần tử trong slide hiện tại
      const currentSlide =
        this.slides[this.activeIndex].querySelectorAll(".animated-element");
      setTimeout(() => {
        currentSlide.forEach((element) => {
          element.classList.add("action_animate"); // Hiện các phần tử
        });
      }, 500); // Đợi một chút trước khi hiển thị
      if (this.realIndex == 0) {
        header.classList.add("slide_white_active");
        header.classList.remove("slide_color_active");
      } else {
        header.classList.remove("slide_white_active");
        header.classList.add("slide_color_active");
      }
    },
    autoplay: function () {
      // Tắt autoplay sau lượt đầu tiên
      setTimeout(() => {
        this.autoplay.stop();
      }, this.params.autoplay.delay * (this.slides.length - 1));
    },
  },
});
let overLay_bg_header = document.querySelector("#header .overlay_background");
gsap.to(overLay_bg_header, {
  y: "0%", // Dịch header xuống khi cuộn
  duration: 0.4,
  opacity: 1,
  // ease: "power2.out",
  ease: "power2.out",
  scrollTrigger: {
    trigger: ".content", // Element dùng để kích hoạt hiệu ứng
    start: "top top", // Khi phần tử content chạm đến đầu trang
    end: "top -80px", // Khi cuộn cách đầu trang 80px
    toggleActions: "play none none reverse", // Hiệu ứng sẽ chạy khi cuộn xuống và đảo ngược khi cuộn lên
  },
});
//toggle menu
let menu_component = document.querySelectorAll(".section_menu");

let overLay_menu = document.getElementById("overLay_menu");
let toggleMenu = false;
function addClassSectionMenu(className) {
  menu_component.forEach((item) => {
    item.classList.add(className);
  });
}
function removeClassSectionMenu(className) {
  menu_component.forEach((item) => {
    item.classList.remove(className);
  });
}
const handleOnMenu = () => {
  document.body.style.overflow = "hidden";
  addClassSectionMenu("active");
  overLay_menu.classList.add("active");
};
const handleCloseMenu = () => {
  removeClassSectionMenu("active");
  overLay_menu.classList.remove("active");
  document.body.style.overflow = "auto";
};
let menu_item = document.querySelectorAll(".section_menu .nav_menu .menu_item");
menu_item.forEach((item) => {
  item.addEventListener("mouseenter", function () {
    addClassSectionMenu("active_width_menu");
  });
  item.addEventListener("mouseleave", function () {
    removeClassSectionMenu("active_width_menu");
  });
});
