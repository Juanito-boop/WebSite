const iconoMenu = document.querySelector('#icono-menu'),
  menu = document.querySelector('#menu')

iconoMenu.addEventListener('click', (e) => {
  // Alternamos estilos para el menu y body
  menu.classList.toggle('active')
  document.body.classList.toggle('opacity')

  // Alternamos su atributo 'src' para el ícono del menú
  const rutaActual = e.target.getAttribute('src')

  if (rutaActual === './img/icono-menu.svg') {
    e.target.setAttribute('./img/icono-menu.svg')
  } else {
    e.target.setAttribute('./img/icono-menu.svg')
  }
})