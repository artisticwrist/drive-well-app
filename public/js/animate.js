// Scroll Animation
const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show");
      } else {
        entry.target.classList.remove("show");
      }
    });
  });
  
  const hiddenElements = document.querySelectorAll(".hidden");
  hiddenElements.forEach((el) => observer.observe(el));
  
  //slide up animation
  const observerSlide = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show-slide-up");
      } else {
        entry.target.classList.remove("show-slide-up");
      }
    });
  });
  
  const hiddenElementSlide = document.querySelectorAll(".hidden-slide");
  hiddenElementSlide.forEach((el) => observerSlide.observe(el));
  
  
  //slide up animation
  const observerBlur = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show-blur");
      } else {
        entry.target.classList.remove("show-blur");
      }
    });
  });
  
  const hiddenElementBlur = document.querySelectorAll(".hidden-blur");
  hiddenElementBlur.forEach((el) => observerBlur.observe(el));
  