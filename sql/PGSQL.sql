-- Active: 1675450657549@@127.0.0.1@5432@postgres@tienda
CREATE TABLE IF NOT EXISTS secciones (
    ID BIGSERIAL PRIMARY KEY,
    nombre TEXT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT false,
    id_unica TEXT UNIQUE
);

CREATE TABLE IF NOT EXISTS usuarios (
    ID bigint PRIMARY KEY NOT NULL GENERATED BY DEFAULT AS IDENTITY,
    usuario character varying(50),
    clave character varying(100),
    nombre character varying(50),
    apellido character varying(50),
    email character varying(100),
    rol character varying(20)
);

CREATE TABLE IF NOT EXISTS vinos (
    -- id: Identificador único generado automáticamente por la base de datos para cada registro en la tabla
    ID SERIAL PRIMARY KEY,
    -- nombre: Nombre del vino, cadena de caracteres de longitud máxima de 255
    nombre VARCHAR(255) NOT NULL,
    -- variedad: Variedad de uva utilizada para elaborar el vino, cadena de caracteres de longitud máxima de 255
    variedad VARCHAR(255) NOT NULL,
    -- anada: Año de cosecha de la uva utilizada para elaborar el vino, número entero
    anada INTEGER,
    -- bodega: Nombre de la bodega o viñedo que produce el vino, cadena de caracteres de longitud máxima de 255
    bodega VARCHAR(255) NOT NULL,
    -- pais: País de origen del vino, cadena de caracteres de longitud máxima de 255
    pais VARCHAR(255) NOT NULL,
    -- region: Región vinícola donde se produce el vino, cadena de caracteres de longitud máxima de 255
    region VARCHAR(255) NOT NULL,
    -- precio: Precio del vino, número decimal con una precisión de 10 dígitos y una escala de 2 dígitos
    precio NUMERIC(10, 2),
    -- stock: Cantidad de botellas del vino que están disponibles en el inventario, número entero
    stock INTEGER,
    -- tipo: Tipo de vino (tinto, blanco, rosado, etc.), cadena de caracteres de longitud máxima de 255
    tipo VARCHAR(255),
    -- nivel_alcohol: Porcentaje de alcohol del vino, número decimal con una precisión de 3 dígitos y una escala de 1 dígito
    nivel_alcohol NUMERIC(3, 1),
    -- tipo_barrica: Tipo de barrica en la que se ha criado el vino (roble americano, roble francés, etc.), cadena de caracteres de longitud máxima de 255
    tipo_barrica VARCHAR(255),
    -- notas_cata: Descripción de las características de sabor, aroma, color y cuerpo del vino, campo de texto
    notas_cata TEXT,
    -- temperatura_consumo: Temperatura recomendada para servir el vino, cadena de caracteres de longitud máxima de 255
    temperatura_consumo VARCHAR(255),
    -- maridaje: Lista de platos recomendados para maridar con el vino, campo de texto
    maridaje TEXT,
    -- id_categoria: Identificador de la categoría a la que pertenece el vino, número entero
    id_categoria INTEGER,
    -- activo: Indica si el vino está activo o no, booleano con valor por defecto de false
    activo BOOLEAN DEFAULT false,
    -- id_imagen: Identificador de la imagen asociada al vino, número entero
    id_imagen INTEGER,
    -- mostrar: Indica si el vino debe mostrarse en la lista de productos, booleano con valor por defecto de false
    mostrar BOOLEAN NOT NULL DEFAULT false,
    -- promocion: Indica si el vino está en promoción o no, booleano con valor por defecto de false
    promocion BOOLEAN NOT NULL DEFAULT false
);

INSERT INTO secciones (nombre, activo, id_unica) VALUES
    ('NUESTROS VINOS MAS VENDIDOS', TRUE, '1'),
    ('NUESTROS MEJORES VINOS', TRUE, '2'),
    ('VINOS IMPORTADOS MAS EXQUISITOS', TRUE, '3'),
    ('PROMOCIONES', TRUE, '4');

INSERT INTO usuarios (usuario, clave, nombre, apellido, email, rol) VALUES
    ('persona_1', '12345678', 'tienda',    'online',   'tienda@online.com',           'Administrador'),
    ('persona_2', '12345678', 'Elizabeth', 'Gottlieb', 'Schuyler.Cronin@hotmail.com', 'UsuarioCorriente');

TRUNCATE vinos;

INSERT INTO vinos (nombre, variedad, anada, bodega, pais, region, precio, stock, tipo, nivel_alcohol, tipo_barrica, notas_cata, temperatura_consumo, maridaje, id_categoria, activo, id_imagen, mostrar, promocion)
VALUES

('Petirrojo', 'Merlot', 2019, 'Viñedos Petirrojo', 'Chile', 'Valle Central', 11.99, 40, 'Tinto', 13.5, 'Crianza en barrica de roble', 'Notas de frutas rojas y especias, con cuerpo medio y taninos suaves.', '16-18°C', 'Carnes rojas y quesos.', 1, true, 245726, true, false),

('Posta Pizzella', 'Malbec', 2019, 'Bodega La Posta', 'Argentina', 'Valle de Uco, Mendoza', 22.99,  50, 'Tinto', 14.5, 'Roble francés', 'Intenso y profundo, con notas de frutos negros, violetas y vainilla. En boca es jugoso, equilibrado y persistente.', '16-18°C', 'Carnes rojas asadas, pastas con salsas picantes, quesos fuertes', 1, true, 933404, true, false),

('Marquez de villa de leyva', 'Cabernet Sauvignon', 2017, 'Viñedo Marquez', 'Colombia', 'Villa de Leyva', 25.99,  50, 'Tinto', 13.5, 'Roble francés', 'Notas a frutas maduras y especias. Cuerpo medio con taninos suaves', '16-18°C', 'Carnes rojas, quesos fuertes y chocolate negro', 1, true, 948930, true, false),

('Don Melchor', 'Cabernet Sauvignon', 2018, 'Concha y Toro', 'Chile', 'Maipo', 125.99, 50, 'Tinto', 14.5, 'Roble francés', 'Vino de color rojo intenso con aromas a cassis, cereza y notas a especias, clavo de olor y nuez moscada. En boca es un vino estructurado y de taninos redondos.', '16-18°C', 'Carnes rojas, guisos y quesos maduros.', 1, true, 543152, true, false),

('Purple Angel', 'Carménère', 2018, 'Montes Wines', 'Chile', 'Colchagua Valley', 45.99, 50, 'Tinto', 14.5, 'Roble francés', 'Notas de frutas negras y especias, taninos firmes y redondos, final largo y persistente', '16-18°C', 'Asados de cordero, carnes rojas y quesos maduros', 1, true, 330628, true, false),

('Muga', 'Tempranillo', 2016, 'Bodegas Muga', 'España', 'Rioja', 29.99, 50, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 2, true, 692159, true, false),

('Reserva de la Tierra', 'Cabernet Sauvignon', 2015, 'Bodegas Reserva de la Tierra', 'Chile', 'Valle del Maipo', 19.99, 100, 'tinto', 14.0, 'roble americano', 'Notas de frutas rojas y negras, especias y toques de chocolate. Elegante y equilibrado', '18-20°C', 'Carnes rojas a la parrilla, platos con salsas intensas y quesos maduros', 2, true, 323324, true, false),

('Maison Castel Gran Reserva', 'Tempranillo', 2015, 'Maison Castel', 'España', 'Cariñena', 19.99, 80, 'tinto', 13.5, 'roble americano', 'Notas de frutas negras maduras, especias y madera tostada. Taninos sedosos y final persistente.', '16-18°C', 'Carnes rojas, asados, quesos curados', 2, true, 191880, true, false),

('Santa Margherita', 'Pinot Grigio', 2020, 'Santa Margherita', 'Italia', 'Alto Adige', 21.99, 120, 'blanco', 12.5, 'acero inoxidable', 'Notas de manzana verde, pera y flores blancas. Fresco y equilibrado con un final persistente.', '8-10°C', 'Ensaladas, mariscos, pescados y platos vegetarianos', 2, true, 257609, true, false),

('Montes Alpha M', 'Cabernet Sauvignon', 2017, 'Viña Montes', 'Chile', 'Valle de Colchagua', 49.99, 40, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y chocolate. Gran estructura y taninos firmes.', '18-20°C', 'Carnes rojas, caza, platos con salsas fuertes y quesos maduros', 2, true, 782699, true, false),

('Angelica Zapata', 'Malbec', 2016, 'Catena Zapata', 'Argentina', 'Mendoza', 54.99, 20, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 850550, true, false),

('Gran Enemigo', 'Cabernet Franc', 2012, 'Bodega Aleanna', 'Argentina', 'Mendoza', 149.99, 10, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 652132, true, false),

('Zuccardi Serie A', 'Malbec', 2019, 'Zuccardi Wines', 'Argentina', 'Valle de Uco', 17.99, 80, 'tinto', 13.5, 'sin barrica', 'Notas de frutas rojas y negras, especias y flores. Buena acidez y frescura.', '14-16°C', 'Empanadas, asados y carnes a la parrilla', 3, true, 438553, true, false),

('Cerro Verde', 'Malbec', 2017, 'Lagarde', 'Argentina', 'Mendoza', 26.99, 40, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 178631, true, false),

('Codice', 'Malbec', 2018, 'Bodega Códice', 'Argentina', 'Mendoza', 23.99, 80, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Final persistente y equilibrado', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 265178, true, false);