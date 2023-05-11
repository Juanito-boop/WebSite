// Seleccionar los contenedores y botones necesarios para mostrar los productos
const container1 = document.querySelector('#container1');
const container2 = document.querySelector('#container2');
const container3 = document.querySelector('#container3');

const prevBtn1 = document.querySelector('#prev-btn1');
const prevBtn2 = document.querySelector('#prev-btn2');
const prevBtn3 = document.querySelector('#prev-btn3');

const nextBtn1 = document.querySelector('#next-btn1');
const nextBtn2 = document.querySelector('#next-btn2');
const nextBtn3 = document.querySelector('#next-btn3');

// Establecer la cantidad de productos a mostrar por página
const itemsPerPage = 4;

// Inicializar el número de página actual para cada contenedor
let currentPage1 = 1;
let currentPage2 = 1;
let currentPage3 = 1;

// Función que calcula el número total de páginas necesarias para mostrar los productos en un contenedor
function calculateTotalPages(container) {
    // Filtrar solo los elementos del contenedor que son productos
    const items = Array.from(container.children).filter(child => child.classList.contains('product'));
    // Calcular el número total de páginas necesarias para mostrar todos los productos
    return Math.ceil(items.length / itemsPerPage);
}

// Función que muestra los productos en una página determinada
function showItems(container, page) {
    // Calcular los índices de inicio y fin de la página actual
    const startIndex = (page - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;

    // Eliminar objetos nulos antes de calcular el número de páginas
    // (los objetos nulos se agregan para completar la última página)
    Array.from(container.children).forEach(child => {
        if (child.classList.contains('null-item')) {
            child.remove();
        }
    });

    // Mostrar solo los productos correspondientes a la página actual
    const itemsToShow = Array.from(container.children).filter(child => child.classList.contains('product'));
    itemsToShow.forEach((item, index) => {
        if (index >= startIndex && index < endIndex) {
            item.style.display = 'block';
        } else {
            item.style.display = 'none';
        }
    });

    // Agregar objetos nulos al final de la página si es necesario
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

    // Asegurar que la página actual no sea mayor que el número total de páginas
    // ni menor que 1 (circular)
    if (page > totalPages) {
        page = 1;
        showItems(container, page);
    } else if (page < 1) {
        page = totalPages;
        showItems(container, page);
    }

    // Devolver el número de página actualizado
    return page;
}
// Función que añade un event listener al botón "siguiente" de un contenedor de productos
// Cuando se hace click en el botón, se aumenta la página actual en 1 y se llama a la función showItems para mostrar los productos correspondientes
// Recibe como parámetros el botón, el contenedor y la página actual
function addNextButtonListener(nextBtn, container, currentPage) {
    nextBtn.addEventListener('mouseup', function () {
        currentPage++;
        currentPage = showItems(container, currentPage);
        console.log('Current Page:', currentPage);
    });
}

// Función que añade un event listener al botón "anterior" de un contenedor de productos
function addPrevButtonListener(prevBtn, container, currentPage) {
    // Cuando se hace click en el botón, se disminuye la página actual en 1 y se llama a la función showItems para mostrar los productos correspondientes
    prevBtn.addEventListener('mousedown', function () {
        // Si la página actual es la primera, se muestra la última página
        if (currentPage > 1) {
            currentPage--;
            currentPage = showItems(container, currentPage);
        } else {
            // Recibe como parámetros el botón, el contenedor y la página actual
            currentPage = calculateTotalPages(container);
            currentPage = showItems(container, currentPage);
        }
    });
}

// Añade event listeners a los botones de "siguiente" y "anterior" y llama a la función showItems para mostrar los productos del contenedor correspondiente
// Recibe como parámetros los botones, el contenedor y la página actual de cada uno de los 3 contenedores
addNextButtonListener(nextBtn1, container1, currentPage1);
addNextButtonListener(nextBtn2, container2, currentPage2);
addNextButtonListener(nextBtn3, container3, currentPage3);

addPrevButtonListener(prevBtn1, container1, currentPage1);
addPrevButtonListener(prevBtn2, container2, currentPage2);
addPrevButtonListener(prevBtn3, container3, currentPage3);

showItems(container1, currentPage1);
showItems(container2, currentPage2);
showItems(container3, currentPage3);