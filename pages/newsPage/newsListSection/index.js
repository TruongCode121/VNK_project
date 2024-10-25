/*!
 * Author: kKao4
 */

function kKao4IsInViewport({ el, onScroll, fill = 1, runAfterInit = false }) {
  const element = typeof el === "string" ? document.querySelector(el) : el;
  let interval,
    count = 0;

  function detectInView() {
    const { bottom } = element.getBoundingClientRect();

    const inView = bottom >= 0;
    onScroll(inView);
  }

  function startInterval() {
    interval = setInterval(() => {
      count++ < 4 ? detectInView() : clearInterval(interval);
    }, 400);
  }

  runAfterInit && detectInView();
  window.addEventListener("scroll", () => {
    detectInView();
    clearInterval(interval);
    count = 0;
    startInterval();
  });
}

const floatFilter = document.querySelector('.float_filter_container');
const filterMbOption = document.querySelector('.filter_mb_option');

kKao4IsInViewport({
  el: ".dropdown_mb",
  onScroll: (inView) => {
    if(inView){
        floatFilter.classList.remove('show_news_filter')
    }else{
        floatFilter.classList.add('show_news_filter')
        filterMbOption.classList.remove('show_filter_mb_option')
    }
  },
});

const showFilterMbOption = ()=>{
    console.log(filterMbOption)
    filterMbOption.classList.toggle('show_filter_mb_option')
}
