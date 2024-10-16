function init() {
  AOS.init({
    offset: 120, // Khoảng cách để bắt đầu hiệu ứng (mặc định là 120px)
    delay: 0, // Độ trễ khởi tạo hiệu ứng (tính bằng ms)
    duration: 400, // Thời gian hiệu ứng (tính bằng ms)
    easing: "ease", // Loại easing cho hiệu ứng (mặc định là 'ease')
    once: true, // Chạy hiệu ứng một lần hay mỗi lần cuộn
    mirror: false, // Lặp lại hiệu ứng khi cuộn lên/xuống
    anchorPlacement: "top-bottom", // Vị trí của phần tử khi bắt đầu hiệu ứng
  });
}
window.addEventListener("DOMContentLoaded", init);
