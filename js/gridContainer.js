let container1, container2, container3, prevBtn1, prevBtn2, prevBtn3, nextBtn1, nextBtn2, nextBtn3;

container1 = document.querySelector('#container1');
container2 = document.querySelector('#container2');
container3 = document.querySelector('#container3');

prevBtn1 = document.querySelector('#prev-btn1');
prevBtn2 = document.querySelector('#prev-btn2');
prevBtn3 = document.querySelector('#prev-btn3');

nextBtn1 = document.querySelector('#next-btn1');
nextBtn2 = document.querySelector('#next-btn2');
nextBtn3 = document.querySelector('#next-btn3');

let currentPage1 = 1;
let currentPage2 = 1;
let currentPage3 = 1;

let itemsPerPage;

function updateItemsPerPage() {
    let windowWidth = window.innerWidth;


    if (windowWidth > 1330) {
        itemsPerPage = 5;
    } else if (windowWidth >= 1070) {
        itemsPerPage = 4;
    } else {
        itemsPerPage = 3;
    }

    currentPage1 = showItems(container1, currentPage1);
    currentPage2 = showItems(container2, currentPage2);
    currentPage3 = showItems(container3, currentPage3);
}


function calculateTotalPages(container) {
    const items = Array.from(container.children).filter(child => child.classList.contains('product'));
    return Math.ceil(items.length / itemsPerPage);
}

function showItems(container, page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    Array.from(container.children).forEach(child => {
        if (child.classList.contains('null-item')) {
            child.remove();
        }
    });
    const itemsToShow = Array.from(container.children).filter(child => child.classList.contains('product'));
    itemsToShow.forEach((item, index) => {
        if (index >= startIndex && index < endIndex) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });
    const totalPages = calculateTotalPages(container);
    const items = Array.from(container.children).filter(child => child.classList.contains('product'));
    const numItems = items.length;
    const itemsToFill = (numItems % itemsPerPage === 0) ? 0 : itemsPerPage - (numItems % itemsPerPage);
    if (itemsToFill > 0 && page === totalPages) {
        for (let i = 0; i < itemsToFill; i++) {
            const nullItem = document.createElement('div');
            nullItem.classList.add('null-item');
            nullItem.style.border = 'none';
            container.appendChild(nullItem);
        }
    }
    if (page > totalPages) {
        page = 1;
        showItems(container, page);
    } else if (page < 1) {
        page = totalPages;
        showItems(container, page);
    }
    return page;
}


window.addEventListener('resize', updateItemsPerPage);

updateItemsPerPage();

function addNextButtonListener(nextBtn, container, currentPage) {
    nextBtn.addEventListener('mouseup', function () {
        currentPage++;
        currentPage = showItems(container, currentPage);
    });
}

function addPrevButtonListener(prevBtn, container, currentPage) {
    prevBtn.addEventListener('mousedown', function () {
        if (currentPage > 1) {
            currentPage--;
            currentPage = showItems(container, currentPage);
        } else {
            currentPage = calculateTotalPages(container);
            currentPage = showItems(container, currentPage);
        }
    });
}

addNextButtonListener(nextBtn1, container1, currentPage1);
addNextButtonListener(nextBtn2, container2, currentPage2);
addNextButtonListener(nextBtn3, container3, currentPage3);

addPrevButtonListener(prevBtn1, container1, currentPage1);
addPrevButtonListener(prevBtn2, container2, currentPage2);
addPrevButtonListener(prevBtn3, container3, currentPage3);

showItems(container1, currentPage1);
showItems(container2, currentPage2);
showItems(container3, currentPage3);