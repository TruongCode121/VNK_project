var btnTop = document.querySelector(".ontop");
window.addEventListener("scroll", function () {
  var y = window.scrollY;
  if (y > 200) {
    btnTop.classList.add("show");
    btnTop.removeAttribute("disabled");
  } else {
    btnTop.classList.remove("show");
  }
});
btnTop.addEventListener("click", function () {
  window.scroll({ top: 0, behavior: "smooth" });
});
