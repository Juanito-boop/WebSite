const gridContainers = document.querySelectorAll('.container-products');

const itemsPerPage = 5;

let currentPage = 1;

const prevBtn1 = document.querySelector('#prev-btn1');
const prevBtn2 = document.querySelector('#prev-btn2');
const prevBtn3 = document.querySelector('#prev-btn3');

const nextBtn1 = document.querySelector('#next-btn1');
const nextBtn2 = document.querySelector('#next-btn2');
const nextBtn3 = document.querySelector('#next-btn3');

function calculateTotalPages() {
    let totalItems = 0;
    let totalContainers = 0;
    gridContainers.forEach(container => {
        const items = Array.from(container.children).filter(child => child.classList.contains('product'));
        totalItems += items.length;
        totalContainers++;
    });
    return Math.ceil(totalItems / (itemsPerPage * totalContainers));
}

function showItems(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    gridContainers.forEach(container => {
        const itemsToShow = Array.from(container.children).filter(child => child.classList.contains('product'));
        itemsToShow.forEach((item, index) => {
            if (index >= startIndex && index < endIndex) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    });


    if (page > calculateTotalPages()) {
        currentPage = 1;
        showItems(currentPage);
    } else if (page < 1) {

        currentPage = calculateTotalPages();
        showItems(currentPage);
    }
}

function addNextButtonListener(nextBtn) {
    nextBtn.addEventListener('click', function () {
        currentPage++;
        showItems(currentPage);
        console.log('Current Page:', currentPage);
    });
}

function addPrevButtonListener(prevBtn) {
    prevBtn.addEventListener('click', function () {
        if (currentPage > 1) {
            currentPage--;
            showItems(currentPage);
            console.log('Current Page:', currentPage);
        } else {
            currentPage = calculateTotalPages();
            showItems(currentPage);
            console.log('Current Page:', currentPage);
        }
    });
}

addNextButtonListener(nextBtn1);
addPrevButtonListener(prevBtn1);

addNextButtonListener(nextBtn2);
addPrevButtonListener(prevBtn2);

addNextButtonListener(nextBtn3);
addPrevButtonListener(prevBtn3);

showItems(currentPage);
