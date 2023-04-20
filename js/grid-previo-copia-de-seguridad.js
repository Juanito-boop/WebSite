const container1 = document.querySelector('#container1');
const container2 = document.querySelector('#container2');
const container3 = document.querySelector('#container3');

const prevBtn1 = document.querySelector('#prev-btn1');
const prevBtn2 = document.querySelector('#prev-btn2');
const prevBtn3 = document.querySelector('#prev-btn3');

const nextBtn1 = document.querySelector('#next-btn1');
const nextBtn2 = document.querySelector('#next-btn2');
const nextBtn3 = document.querySelector('#next-btn3');

const itemsPerPage = 5;

let currentPage1 = 1;
let currentPage2 = 1;
let currentPage3 = 1;

function calculateTotalPages(container) {
    const items = Array.from(container.children).filter(child => child.classList.contains('product'));
    return Math.ceil(items.length / itemsPerPage);
}

function showItems(container, page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    const itemsToShow = Array.from(container.children).filter(child => child.classList.contains('product'));
    itemsToShow.forEach((item, index) => {
        if (index >= startIndex && index < endIndex) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    const totalPages = calculateTotalPages(container);
    if (page > totalPages) {
        page = 1;
        showItems(container, page);
    } else if (page < 1) {
        page = totalPages;
        showItems(container, page);
    }

    return page;
}

function addNextButtonListener(nextBtn, container, currentPage) {
    nextBtn.addEventListener('click', function () {
        currentPage++;
        currentPage = showItems(container, currentPage);
        console.log('Current Page:', currentPage);
    });
}

function addPrevButtonListener(prevBtn, container, currentPage) {
    prevBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            currentPage = showItems(container, currentPage);
            console.log('Current Page:', currentPage);
        } else {
            currentPage = calculateTotalPages(container);
            currentPage = showItems(container, currentPage);
            console.log('Current Page:', currentPage);
        }
    });
}

addNextButtonListener(nextBtn1, container1, currentPage1);
addPrevButtonListener(prevBtn1, container1, currentPage1);

addNextButtonListener(nextBtn2, container2, currentPage2);
addPrevButtonListener(prevBtn2, container2, currentPage2);

addNextButtonListener(nextBtn3, container3, currentPage3);
addPrevButtonListener(prevBtn3, container3, currentPage3);

showItems(container1, currentPage1);
showItems(container2, currentPage2);
showItems(container3, currentPage3);
