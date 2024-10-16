function init() {
  gsap.registerPlugin(ScrollTrigger, ScrollSmoother, ScrollToPlugin);

  ScrollSmoother.create({
    smooth: 1,
    effects: true,
  });
}

window.addEventListener("DOMContentLoaded", init);
