const gridContainer = document.querySelector('.container-products');
const prevBtn = document.querySelector('#prev-btn');
const nextBtn = document.querySelector('#next-btn');
const itemsPerPage = 15;
let currentPage = 1;

// Función para mostrar los items de la página actual
function showItems(page) {
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    const itemsToShow = Array.from(gridContainer.children).slice(startIndex, endIndex);
    gridContainer.innerHTML = '';
    itemsToShow.forEach(item => gridContainer.appendChild(item));
    console.log(itemsToShow);
}

// Mostrar los items de la primera página al cargar la página
showItems(currentPage);

// Evento para avanzar a la siguiente página

nextBtn.addEventListener('click', () => {
    const totalPages = calculateTotalPages();
    currentPage = (currentPage + 1) > totalPages ? (currentPage + 1) : 1;
    console.log(currentPage);
    showItems(currentPage);
});

function calculateTotalPages() {
    return Math.ceil(gridContainer.children.length / itemsPerPage);
}

//Evento para retroceder a la página anterior
prevBtn.addEventListener('click', () => {
    const totalPages = calculateTotalPages();
    currentPage = (currentPage - 1) < 1 ? totalPages : (currentPage - 1);
    console.log(currentPage);
    showItems(currentPage);
});

function calculateTotalPages() {
    return Math.ceil(gridContainer.children.length / itemsPerPage);
}
