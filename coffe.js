let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');

// config param
let countItem = items.length;
let itemActive = 0;

// event next click
next.addEventListener('click', () => {
    itemActive = (itemActive + 1) % countItem;
    showSlider();
});

// event prev click
prev.addEventListener('click', () => {
    itemActive = (itemActive - 1 + countItem) % countItem;
    showSlider();
});

// auto run slider
let refreshInterval = setInterval(() => {
    next.click();
}, 10000);

function showSlider() {
    // remove active class from the old item
    let itemActiveOld = document.querySelector('.slider .list .item.active');
    if (itemActiveOld) itemActiveOld.classList.remove('active');

    // add active class to the new item
    items[itemActive].classList.add('active');

    // Adjust the position of the slider using transform
    let sliderList = document.querySelector('.slider .list');
    sliderList.style.transform = `translateX(-${itemActive * 100}%)`;

    // reset the auto slide interval
    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => {
        next.click();
    }, 10000);
}
let count = 0;

function increment(button) {
    let counter = button.parentElement.querySelector('.counter');
    count = parseInt(counter.value);
    counter.value = ++count;
}

function decrement(button) {
    let counter = button.parentElement.querySelector('.counter');
    count = parseInt(counter.value);
    if (count > 0) {
        counter.value = --count;
    }
}

function sendData(button) {
    let form = button.closest('form');
    let counter = form.querySelector('.counter').value;
    form.querySelector('#counterValue').value = counter;
}

