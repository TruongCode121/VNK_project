function init() {
  let overLay_bg_header = document.querySelector(
    ".header_menu_component #header .overlay_background"
  );
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
  let menu_component = document.querySelectorAll(
    ".header_menu_component .section_menu"
  );

  let overLay_menu = document.getElementById("overLay_menu");
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
  let on_menu_btn = document.querySelectorAll(".onMenuBtn");
  let close_menu_btn = document.querySelectorAll(".closeMenuBtn");

  on_menu_btn.forEach((item) => {
    item.addEventListener("click", function () {
      document.body.style.overflow = "hidden";
      addClassSectionMenu("active");
      overLay_menu.classList.add("active");
    });
  });
  close_menu_btn.forEach((item) => {
    item.addEventListener("click", function () {
      removeClassSectionMenu("active");
      overLay_menu.classList.remove("active");
      document.body.style.overflow = "auto";
    });
  });
  let menu_item = document.querySelectorAll(
    ".section_menu .nav_menu .menu_item"
  );
  menu_item.forEach((item) => {
    item.addEventListener("mouseenter", function () {
      addClassSectionMenu("active_width_menu");
    });
    item.addEventListener("mouseleave", function () {
      removeClassSectionMenu("active_width_menu");
    });
  });
}
window.addEventListener("DOMContentLoaded", init);
