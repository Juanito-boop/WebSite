const iconos = ['img/image-removebg-preview.svg'];

const archivosEstilo = [
    'css/aside.css', 'css/Global.css', 'css/Hamburguer.css', 'css/Header.css', 'css/Products.css', 'css/Slider.css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', 'https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap'
];

const archivosPreconnect = ['https://fonts.googleapis.com', 'https://fonts.gstatic.com'];

for (let i = 0; i < iconos.length; i++) {
    const link = document.createElement('link');
    link.rel = 'icon';
    link.type = 'image/png';
    link.href = iconos[i];
    document.head.appendChild(link);
}

for (let i = 0; i < archivosEstilo.length; i++) {
    const link = document.createElement('link');
    link.rel = 'stylesheet';
    link.href = archivosEstilo[i];
    document.head.appendChild(link);
}

for (let i = 0; i < archivosPreconnect.length; i++) {
    const link = document.createElement('link');
    link.rel = 'preconnect';
    link.href = archivosPreconnect[i];
    document.head.appendChild(link);
}

