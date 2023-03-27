const gridContainer = document.querySelector('.container-products');
const itemsPerPage = 5;
let currentPage = 1;
const prevBtn = document.querySelector('#prev-btn1');
const nextBtn = document.querySelector('#next-btn1');
const prevBtn2 = document.querySelector('#prev-btn2');
const nextBtn2 = document.querySelector('#next-btn2');
const prevBtn3 = document.querySelector('#prev-btn3');
const nextBtn3 = document.querySelector('#next-btn3');

// Función para mostrar los items de la página actual
function showItems(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const itemsToShow = Array.from(gridContainer.children);
    itemsToShow.forEach((item, index) => {
        if (index >= startIndex && index < endIndex) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });
}

// Mostrar los items de la primera página al cargar la página
showItems(currentPage);

function buttonClickHandler(nextBtn, prevBtn) {
    const totalPages = calculateTotalPages();
    return () => {
        currentPage = (currentPage + 1) > totalPages ? 1 : (currentPage + 1);
        showItems(currentPage);
    };
}

function addButtonListener(nextBtn, prevBtn) {
    nextBtn.addEventListener('click', function () {
        buttonClickHandler(nextBtn, prevBtn);
    });
    prevBtn.addEventListener('click', function () {
        buttonClickHandler(nextBtn, prevBtn);
    });
}

// Asignar eventos de click para el primer grupo de botones
addButtonListener(nextBtn, prevBtn);

// Asignar eventos de click para el segundo grupo de botones
addButtonListener(nextBtn2, prevBtn2);

// Asignar eventos de click para el tercer grupo de botones
addButtonListener(nextBtn3, prevBtn3);

// Función para calcular el número total de páginas
function calculateTotalPages() {
    return Math.ceil(gridContainer.children.length / itemsPerPage);
}