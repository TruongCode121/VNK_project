gsap.registerPlugin(ScrollTrigger);

if (window && window.innerWidth >= 1024) {
  gsap.from(".about-top", {
    x: -200,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".about-bottom", {
    y: 200,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".homepage__about-right .item1", {
    x: -100,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".homepage__about-right .item2", {
    x: -150,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".homepage__about-right .item3", {
    x: 100,
    y: -60,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });
  gsap.from(".homepage__about-right .item4", {
    x: 10,
    y: 10,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });
  gsap.from(".homepage__about-right .item5", {
    y: 60,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".homepage__about-right .item6", {
    x: 100,
    y: -20,
    autoAlpha: 0,
    duration: 1.5,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });
  gsap.from(".homepage__about-right .item7", {
    x: 80,
    y: -10,
    autoAlpha: 0,
    duration: 1,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });

  gsap.from(".homepage__about-right .item8", {
    x: 20,
    y: -10,
    autoAlpha: 0,
    duration: 1,
    scrollTrigger: {
      trigger: ".homepage__about",
      start: "top 80%",
      once: true,
    },
  });
}

// if (window && window.innerWidth < 768) {
//swiper
var swiper = new Swiper(".bottom__logo-list", {
  slidesPerView: 4,
  spaceBetween: 30,
  autoplay: {
    delay: 1000,
    disableOnInteraction: false,
  },
  speed: 2000,
  loop: true,
});
// }
