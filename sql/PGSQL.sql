-- Active: 1681022712039@@db.hijaeegxjbuivzckpijg.supabase.co@5432@postgres@public

-- TABLAS

-- Este código SQL está creando una tabla llamada "secciones" con cuatro columnas: "ID" que es un tipo
-- de datos BIGSERIAL y sirve como clave principal, "nombre" que es un tipo de datos TEXT y no puede
-- ser nulo, "activo" que es un tipo de datos BOOLEAN y no puede ser nulo con un valor predeterminado
-- falso, y "id_unica", que es un tipo de datos de TEXTO y debe ser único. La cláusula "SI NO EXISTE"
-- garantiza que la tabla solo se cree si aún no existe en la base de datos.
CREATE TABLE IF NOT EXISTS secciones (
    ID BIGSERIAL PRIMARY KEY,
    nombre TEXT NOT NULL,
    activo BOOLEAN NOT NULL DEFAULT false,
    id_unica TEXT UNIQUE
);

-- Este código SQL está creando una tabla llamada "usuarios" con seis columnas: "ID" que es un tipo de
-- datos BIGSERIAL y sirve como clave principal, "usuario" que es un tipo de datos que varía de
-- carácter con una longitud máxima de 50, "clave " que es un tipo de dato variable de caracteres con
-- una longitud máxima de 100, "nombre" que es un tipo de dato variable de caracteres con una longitud
-- máxima de 50, "apellido" que es un tipo de dato variable de caracteres con una longitud máxima de
-- 50, " email", que es un tipo de datos de caracteres variables con una longitud máxima de 100, y
-- "rol", que es un tipo de datos de caracteres variables con una longitud máxima de 20. La cláusula
-- "IF NOT EXISTS" garantiza que la tabla solo se crea si no existe ya en la base de datos.
CREATE TABLE IF NOT EXISTS usuarios (
    ID BIGSERIAL PRIMARY KEY,
    usuario character varying(50),
    clave character varying(100),
    nombre character varying(50),
    apellido character varying(50),
    email character varying(100),
    rol character varying(20)
);

-- Este código SQL está creando una tabla llamada "paises" con dos columnas: "ID", que es un tipo de
-- datos BIGSERIAL y sirve como clave principal, y "pais", que es un tipo de datos de TEXTO. La
-- cláusula "SI NO EXISTE" garantiza que la tabla solo se cree si aún no existe en la base de datos.
CREATE TABLE IF NOT EXISTS paises (
    ID BIGSERIAL PRIMARY KEY,
    pais TEXT
);

-- Este código SQL está creando una tabla llamada "variedades" con tres columnas: "ID" que es un tipo
-- de datos SERIAL y sirve como clave principal, "variedad" que es un tipo de datos TEXTO y
-- "pais_origen" que es un dato INTEGER type y sirve como clave externa que hace referencia a la
-- columna "ID" en la tabla "paises". La cláusula "SI NO EXISTE" garantiza que la tabla solo se cree si
-- aún no existe en la base de datos.
CREATE TABLE IF NOT EXISTS variedades (
    ID SERIAL PRIMARY KEY,
    variedad TEXT,
    pais_origen INTEGER,
    Foreign Key (pais_origen) REFERENCES paises(ID)
);

-- El código anterior está creando una tabla llamada "vinos" en una base de datos SQL con varias
-- columnas como ID, nombre, variedad, anada, bodega, pais, region, precio, stock, tipo, nivel_alcohol,
-- tipo_barrica, notas_cata, temperatura_consumo, maridaje, id_categoria, activo, id_imagen y
-- promoción. También incluye restricciones de clave externa para garantizar que los valores ingresados
-- en ciertas columnas existan en otras tablas. Esto ayuda a mantener la integridad y coherencia de los
-- datos en la base de datos.
CREATE TABLE IF NOT EXISTS vinos (
    ID BIGSERIAL PRIMARY KEY,-- id: Identificador único generado automáticamente por la base de datos para cada registro en la tabla
    nombre VARCHAR(255) NOT NULL,-- nombre: Nombre del vino, cadena de caracteres de longitud máxima de 255
    variedad INTEGER,-- variedad: Variedad de uva utilizada para elaborar el vino, cadena de caracteres de longitud máxima de 255
    anada INTEGER,-- anada: Año de cosecha de la uva utilizada para elaborar el vino, número entero
    bodega VARCHAR(255) NOT NULL,-- bodega: Nombre de la bodega o viñedo que produce el vino, cadena de caracteres de longitud máxima de 255
    pais INTEGER,-- pais: País de origen del vino, referenciamos con foreign key
    region VARCHAR(255) NOT NULL,-- region: Región vinícola donde se produce el vino, cadena de caracteres de longitud máxima de 255
    precio NUMERIC(10, 2),-- precio: Precio del vino, número decimal con una precisión de 10 dígitos y una escala de 2 dígitos
    stock INTEGER,-- stock: Cantidad de botellas del vino que están disponibles en el inventario, número entero
    tipo VARCHAR(255),-- tipo: Tipo de vino (tinto, blanco, rosado, etc.), cadena de caracteres de longitud máxima de 255
    nivel_alcohol NUMERIC(3, 1),-- nivel_alcohol: Porcentaje de alcohol del vino, número decimal con una precisión de 3 dígitos y una escala de 1 dígito
    tipo_barrica VARCHAR(255),-- tipo_barrica: Tipo de barrica en la que se ha criado el vino (roble americano, roble francés, etc.), cadena de caracteres de longitud máxima de 255
    notas_cata TEXT,-- notas_cata: Descripción de las características de sabor, aroma, color y cuerpo del vino, campo de texto
    temperatura_consumo VARCHAR(255),-- temperatura_consumo: Temperatura recomendada para servir el vino, cadena de caracteres de longitud máxima de 255
    maridaje TEXT,-- maridaje: Lista de platos recomendados para maridar con el vino, campo de texto
    id_categoria INTEGER,-- id_categoria: Identificador de la categoría a la que pertenece el vino, número entero
    activo BOOLEAN NOT NULL DEFAULT false,-- activo: Indica si el vino está activo o no, booleano con valor por defecto de false
    id_imagen INTEGER,-- id_imagen: Identificador de la imagen asociada al vino, número entero
    promocion BOOLEAN NOT NULL DEFAULT false,-- promocion: Indica si el vino está en promoción o no, booleano con valor por defecto de false

    -- Este código crea tres restricciones de clave externa en una tabla de base de datos para asegurar que los valores ingresados en tres columnas específicas existan previamente en otras tablas. Esto ayuda a mantener la integridad y consistencia de los datos en la base de datos.
    Foreign Key (variedad) REFERENCES variedades(ID),
    Foreign Key (pais) REFERENCES paises(ID),
    Foreign Key (id_categoria) REFERENCES secciones(ID)
);

--DATA

INSERT INTO secciones (nombre, activo, id_unica) VALUES
    ('NUESTROS VINOS MAS VENDIDOS', TRUE, '1'),
    ('NUESTROS MEJORES VINOS', TRUE, '2'),
    ('VINOS IMPORTADOS MAS EXQUISITOS', TRUE, '3'),
    ('PROMOCIONES', FALSE, '4');

INSERT INTO usuarios (usuario, clave, nombre, apellido, email, rol) VALUES
    ('persona_1', '12345678', 'tienda',    'online',   'tienda@online.com',           'Administrador'),
    ('persona_2', '12345678', 'Elizabeth', 'Gottlieb', 'Schuyler.Cronin@hotmail.com', 'UsuarioCorriente');

INSERT INTO paises (pais) VALUES 
    ('Argentina'),
    ('Colombia'),
    ('Chile'),
    ('España'),
    ('Italia'),
    ('Francia');

INSERT INTO variedades (variedad, pais_origen) VALUES
    ('Cabernet Franc', 6),
    ('Cabernet Sauvignon', 6),
    ('Carménère', 3),
    ('Malbec', 6),
    ('Merlot', 6),
    ('Pinot Grigio', 5),
    ('Tempranillo', 4);

INSERT INTO vinos (nombre, variedad, anada, bodega, pais, region, precio, stock, tipo, nivel_alcohol, tipo_barrica, notas_cata, temperatura_consumo, maridaje, id_categoria, activo, id_imagen, promocion) VALUES

    ('Petirrojo', 5, 2019, 'Viñedos Petirrojo', 3, 'Valle Central', 11.99, 40, 'Tinto', 13.5, 'Crianza en barrica de roble', 'Notas de frutas rojas y especias, con cuerpo medio y taninos suaves.', '16-18°C', 'Carnes rojas y quesos.', 1, true, 245726, false),

    ('Posta Pizzella', 4, 2019, 'Bodega La Posta', 1, 'Valle de Uco, Mendoza', 22.99,  50, 'Tinto', 14.5, 'Roble francés', 'Intenso y profundo, con notas de frutos negros, violetas y vainilla. En boca es jugoso, equilibrado y persistente.', '16-18°C', 'Carnes rojas asadas, pastas con salsas picantes, quesos fuertes', 1, true, 933404, false),

    ('Marquez de villa de leyva', 2, 2017, 'Viñedo Marquez', 2, 'Villa de Leyva', 25.99,  50, 'Tinto', 13.5, 'Roble francés', 'Notas a frutas maduras y especias. Cuerpo medio con taninos suaves', '16-18°C', 'Carnes rojas, quesos fuertes y chocolate negro', 1, true, 948930, false),

    ('Don Melchor', 2, 2018, 'Concha y Toro', 3, 'Maipo', 125.99, 50, 'Tinto', 14.5, 'Roble francés', 'Vino de color rojo intenso con aromas a cassis, cereza y notas a especias, clavo de olor y nuez moscada. En boca es un vino estructurado y de taninos redondos.', '16-18°C', 'Carnes rojas, guisos y quesos maduros.', 1, true, 543152, false),

    ('Purple Angel', 3, 2018, 'Montes Wines', 3, 'Colchagua Valley', 45.99, 50, 'Tinto', 14.5, 'Roble francés', 'Notas de frutas negras y especias, taninos firmes y redondos, final largo y persistente', '16-18°C', 'Asados de cordero, carnes rojas y quesos maduros', 1, true, 330628, false),

    ('Muga', 6, 2016, 'Bodegas Muga', 4, 'Rioja', 29.99, 50, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 2, true, 692159, false),

    ('Reserva de la Tierra', 2, 2015, 'Bodegas Reserva de la Tierra', 3, 'Valle del Maipo', 19.99, 100, 'tinto', 14.0, 'roble americano', 'Notas de frutas rojas y negras, especias y toques de chocolate. Elegante y equilibrado', '18-20°C', 'Carnes rojas a la parrilla, platos con salsas intensas y quesos maduros', 2, true, 323324, false),

    ('Maison Castel Gran Reserva', 6, 2015, 'Maison Castel', 4, 'Cariñena', 19.99, 80, 'tinto', 13.5, 'roble americano', 'Notas de frutas negras maduras, especias y madera tostada. Taninos sedosos y final persistente.', '16-18°C', 'Carnes rojas, asados, quesos curados', 2, true, 191880, false),

    ('Santa Margherita', 6, 2020, 'Santa Margherita', 5, 'Alto Adige', 21.99, 120, 'blanco', 12.5, 'acero inoxidable', 'Notas de manzana verde, pera y flores blancas. Fresco y equilibrado con un final persistente.', '8-10°C', 'Ensaladas, mariscos, pescados y platos vegetarianos', 2, true, 257609, false),

    ('Montes Alpha M', 2, 2017, 'Viña Montes', 3, 'Valle de Colchagua', 49.99, 40, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y chocolate. Gran estructura y taninos firmes.', '18-20°C', 'Carnes rojas, caza, platos con salsas fuertes y quesos maduros', 2, true, 782699, false),

    ('Angelica Zapata', 4, 2016, 'Catena Zapata', 1, 'Mendoza', 54.99, 20, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 850550, false),

    ('Gran Enemigo', 1, 2012, 'Bodega Aleanna', 1, 'Mendoza', 149.99, 10, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 652132, false),

    ('Zuccardi Serie A', 4, 2019, 'Zuccardi Wines', 1, 'Valle de Uco', 17.99, 80, 'tinto', 13.5, 'sin barrica', 'Notas de frutas rojas y negras, especias y flores. Buena acidez y frescura.', '14-16°C', 'Empanadas, asados y carnes a la parrilla', 3, true, 438553, false),

    ('Cerro Verde', 4, 2017, 'Lagarde', 1, 'Mendoza', 26.99, 40, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 178631, false),

    ('Codice', 4, 2018, 'Bodega Códice', 1, 'Mendoza', 23.99, 80, 'tinto', 14.5, 'roble francés', 'Notas de frutas rojas y negras, especias y vainilla. Final persistente y equilibrado', '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados', 3, true, 265178, false);
