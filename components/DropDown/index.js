function toggleDropdown() {
  var dropdownContent = document.querySelector(".dropdown .dropdown-content");
  if (dropdownContent.style.visibility === "visible") {
    dropdownContent.style.visibility = "hidden";
    dropdownContent.style.opacity = "0";
  } else {
    dropdownContent.style.visibility = "visible";
    dropdownContent.style.opacity = "1";
  }
}

/* Đóng dropdown nếu nhấp ngoài vùng dropdown */
//   window.onclick = function (event) {
//     if (!event.target.matches(".dropdown-button")) {
//       var dropdowns = document.querySelectorAll(".dropdown-content");
//       dropdowns.forEach(function (dropdown) {
//         if (dropdown.style.visibility === "visible") {
//           dropdown.style.visibility = "hidden";
//           dropdown.style.opacity = '0';
//         }
//       });
//     }
//   };
