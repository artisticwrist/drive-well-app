const navResponsive = document.querySelector('.nav-responsive');
const hamBurger = document.querySelector('.ham-burger');
const closeBtn = document.querySelector('.close-nav');
const range = document.getElementById('rangeId');
const showAmount = document.getElementById('count-amount')
const incrementHour = document.getElementById('incrementHour');
var pageHeight = '100vh';
var overflowHide = 'hidden'
const page = document.querySelector('body');



function closeNav(){
    navResponsive.style.display ='none'
    closeBtn.style.display ='none'
    hamBurger.style.display ='flex'
    pageHeight = null;
    overflow = null
    page.style.height = pageHeight;
    page.style.overflow = null;
}

function showNav(){
        navResponsive.style.display ='block'
        hamBurger.style.display ='none'
        closeBtn.style.display ='block'
        page.style.height = pageHeight;
        page.style.overflow = overflowHide;
        
}


function updateIncrementedValue(value) {
    const incrementedValue = value * 100;
    incrementHour.textContent = incrementedValue;
}
  
updateIncrementedValue(range.value);

range.addEventListener('input', function(){
    updateIncrementedValue(range.value);
   showAmount.textContent = range.value;
})

