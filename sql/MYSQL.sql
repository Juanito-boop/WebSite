-- Active: 1682675737840@@127.0.0.1@3306@inventario

-- TABLAS
CREATE TABLE IF NOT EXISTS secciones (
    ID       BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre   TEXT      NOT NULL,
    activo   BOOLEAN   NOT NULL DEFAULT false,
    id_unica BIGINT UNSIGNED UNIQUE
);

CREATE TABLE IF NOT EXISTS usuarios (
    ID       BIGINT  UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    usuario  VARCHAR(50),
    clave    VARCHAR(100),
    nombre   VARCHAR(50),
    apellido VARCHAR(50),
    email    VARCHAR(100),
    rol      VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS paises (
    ID   BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    pais TEXT
);


CREATE TABLE IF NOT EXISTS variedades (
    ID          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    variedad    TEXT,
    pais_origen BIGINT UNSIGNED
);

CREATE TABLE IF NOT EXISTS vinos (
    ID                  BIGINT  UNSIGNED AUTO_INCREMENT PRIMARY KEY,-- id: Identificador único generado automáticamente por la base de datos para cada registro en la tabla
    nombre              VARCHAR(255) NOT NULL,-- nombre: Nombre del vino, cadena de caracteres de longitud máxima de 255
    variedad            BIGINT  UNSIGNED,-- variedad: Variedad de uva utilizada para elaborar el vino, cadena de caracteres de longitud máxima de 255
    anada               INT,-- anada: Año de cosecha de la uva utilizada para elaborar el vino, número entero
    bodega              VARCHAR(255) NOT NULL,-- bodega: Nombre de la bodega o viñedo que produce el vino, cadena de caracteres de longitud máxima de 255
    pais_vino           BIGINT  UNSIGNED,-- pais_vino: País de origen del vino, referenciamos con foreign key
    region              VARCHAR(255) NOT NULL,-- region: Región vinícola donde se produce el vino, cadena de caracteres de longitud máxima de 255
    precio              DECIMAL(10, 2),-- precio: Precio del vino, número decimal con una precisión de 10 dígitos y una escala de 2 dígitos
    stock               INT,-- stock: Cantidad de botellas del vino que están disponibles en el inventario, número entero
    tipo                VARCHAR(255),-- tipo: Tipo de vino (tinto, blanco, rosado, etc.), cadena de caracteres de longitud máxima de 255
    nivel_alcohol       DECIMAL(3, 1),-- nivel_alcohol: Porcentaje de alcohol del vino, número decimal con una precisión de 3 dígitos y una escala de 1 dígito
    tipo_barrica        VARCHAR(255),-- tipo_barrica: Tipo de barrica en la que se ha criado el vino (roble americano, roble francés, etc.), cadena de caracteres de longitud máxima de 255
    notas_cata          TEXT,-- notas_cata: Descripción de las características de sabor, aroma, color y cuerpo del vino, campo de texto
    temperatura_consumo VARCHAR(255),-- temperatura_consumo: Temperatura recomendada para servir el vino, cadena de caracteres de longitud máxima de 255
    maridaje            TEXT,-- maridaje: Lista de platos recomendados para maridar con el vino, campo de texto
    id_categoria        BIGINT  UNSIGNED,-- id_categoria: Identificador de la categoría a la que pertenece el vino, número entero
    activo              BOOLEAN NOT NULL DEFAULT false,-- activo: Indica si el vino está activo o no, booleano con valor por defecto de false
    id_imagen           BIGINT  UNSIGNED,-- id_imagen: Identificador de la imagen asociada al vino, número entero
    promocion           BOOLEAN NOT NULL DEFAULT false,-- promocion: Indica si el vino está en promoción o no, booleano con valor por defecto de false
    busqueda            BIGINT  UNSIGNED-- busqueda: Identificador de cada producto para organizarlos cuando se haga una busqueda
);

drop table vinos;

-- FOREIGN KEYS

ALTER TABLE variedades ADD CONSTRAINT variedad_pais FOREIGN KEY (pais_origen) REFERENCES paises (ID);
ALTER TABLE vinos ADD CONSTRAINT vinos_variedad FOREIGN KEY (variedad) REFERENCES variedades (ID);
ALTER TABLE vinos ADD CONSTRAINT vinos_pais FOREIGN KEY (pais_vino) REFERENCES paises (ID);
ALTER TABLE vinos ADD CONSTRAINT vinos_categoria FOREIGN KEY (id_categoria) REFERENCES secciones (ID);

-- DATA

INSERT INTO secciones (nombre, activo) VALUES
    ('NUESTROS VINOS MAS VENDIDOS'     , TRUE),
    ('NUESTROS MEJORES VINOS'          , TRUE),
    ('VINOS IMPORTADOS MAS EXQUISITOS' , TRUE),
    ('RESULTADOS DE LA BUSQUEDA'       , TRUE);

INSERT INTO usuarios (usuario, clave, nombre, apellido, email, rol) VALUES
    ('persona_1', '12345678', 'tienda'   , 'online'  , 'tienda@online.com'          , 'Administrador'   ),
    ('persona_2', '12345678', 'Elizabeth', 'Gottlieb', 'Schuyler.Cronin@hotmail.com', 'UsuarioCorriente');

INSERT INTO paises (pais) VALUES 
    ('Argentina'),
    ('Colombia' ),
    ('Chile'    ),
    ('España'   ),
    ('Italia'   ),
    ('Francia'  );

INSERT INTO variedades (variedad, pais_origen) VALUES
    ('Cabernet Franc'    , 6),
    ('Cabernet Sauvignon', 6),
    ('Carménère'         , 3),
    ('Malbec'            , 6),
    ('Merlot'            , 6),
    ('Pinot Grigio'      , 5),
    ('Tempranillo'       , 4);

INSERT INTO vinos (nombre, variedad, anada, bodega, pais_vino, region, precio, stock, tipo, nivel_alcohol, tipo_barrica, notas_cata, temperatura_consumo, maridaje, id_categoria, activo, id_imagen, promocion, busqueda) VALUES
    
    ('Petirrojo'                 , 5, 2019, 'Viñedos Petirrojo'           , 3, 'Valle Central'        , 11.99 , 40 , 'Tinto' , 13.5, 'Crianza en barrica de roble', 'Notas de frutas rojas y especias, con cuerpo medio y taninos suaves.'                                                                                           , '16-18°C', 'Carnes rojas y quesos.'                                                 , 1, true, 245726, false, 4),
    ('Posta Pizzella'            , 4, 2019, 'Bodega La Posta'             , 1, 'Valle de Uco, Mendoza', 22.99 , 50 , 'Tinto' , 14.5, 'Roble francés'              , 'Intenso y profundo, con notas de frutos negros, violetas y vainilla. En boca es jugoso, equilibrado y persistente.'                                             , '16-18°C', 'Carnes rojas asadas, pastas con salsas picantes, quesos fuertes'        , 1, true, 933404, false, 4),
    ('Marquez de villa de leyva' , 2, 2017, 'Viñedo Marquez'              , 2, 'Villa de Leyva'       , 25.99 , 50 , 'Tinto' , 13.5, 'Roble francés'              , 'Notas a frutas maduras y especias. Cuerpo medio con taninos suaves'                                                                                             , '16-18°C', 'Carnes rojas, quesos fuertes y chocolate negro'                         , 1, true, 948930, false, 4),
    ('Don Melchor'               , 2, 2018, 'Concha y Toro'               , 3, 'Maipo'                , 125.99, 50 , 'Tinto' , 14.5, 'Roble francés'              , 'Vino de color rojo intenso con aromas a cassis, cereza y notas a especias, clavo de olor y nuez moscada. En boca es un vino estructurado y de taninos redondos.', '16-18°C', 'Carnes rojas, guisos y quesos maduros.'                                 , 1, true, 543152, false, 4),
    ('Purple Angel'              , 3, 2018, 'Montes Wines'                , 3, 'Colchagua Valley'     , 45.99 , 50 , 'Tinto' , 14.5, 'Roble francés'              , 'Notas de frutas negras y especias, taninos firmes y redondos, final largo y persistente'                                                                        , '16-18°C', 'Asados de cordero, carnes rojas y quesos maduros'                       , 1, true, 330628, false, 4),
    ('Muga'                      , 6, 2016, 'Bodegas Muga'                , 4, 'Rioja'                , 29.99 , 50 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados'                                                                 , '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados'                         , 2, true, 692159, false, 4),
    ('Reserva de la Tierra'      , 2, 2015, 'Bodegas Reserva de la Tierra', 3, 'Valle del Maipo'      , 19.99 , 100, 'tinto' , 14.0, 'roble americano'            , 'Notas de frutas rojas y negras, especias y toques de chocolate. Elegante y equilibrado'                                                                         , '18-20°C', 'Carnes rojas a la parrilla, platos con salsas intensas y quesos maduros', 2, true, 323324, false, 4),
    ('Maison Castel Gran Reserva', 6, 2015, 'Maison Castel'               , 4, 'Cariñena'             , 19.99 , 80 , 'tinto' , 13.5, 'roble americano'            , 'Notas de frutas negras maduras, especias y madera tostada. Taninos sedosos y final persistente.'                                                                , '16-18°C', 'Carnes rojas, asados, quesos curados'                                   , 2, true, 191880, false, 4),
    ('Santa Margherita'          , 6, 2020, 'Santa Margherita'            , 5, 'Alto Adige'           , 21.99 , 120, 'blanco', 12.5, 'acero inoxidable'           , 'Notas de manzana verde, pera y flores blancas. Fresco y equilibrado con un final persistente.'                                                                  , '8-10°C' , 'Ensaladas, mariscos, pescados y platos vegetarianos'                    , 2, true, 257609, false, 4),
    ('Montes Alpha M'            , 2, 2017, 'Viña Montes'                 , 3, 'Valle de Colchagua'   , 49.99 , 40 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y chocolate. Gran estructura y taninos firmes.'                                                                        , '18-20°C', 'Carnes rojas, caza, platos con salsas fuertes y quesos maduros'         , 2, true, 782699, false, 4),
    ('Angelica Zapata'           , 4, 2016, 'Catena Zapata'               , 1, 'Mendoza'              , 54.99 , 20 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados'                                                                 , '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados'                         , 3, true, 850550, false, 4),
    ('Gran Enemigo'              , 1, 2012, 'Bodega Aleanna'              , 1, 'Mendoza'              , 149.99, 10 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados'                                                                 , '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados'                         , 3, true, 652132, false, 4),
    ('Zuccardi Serie A'          , 4, 2019, 'Zuccardi Wines'              , 1, 'Valle de Uco'         , 17.99 , 80 , 'tinto' , 13.5, 'sin barrica'                , 'Notas de frutas rojas y negras, especias y flores. Buena acidez y frescura.'                                                                                    , '14-16°C', 'Empanadas, asados y carnes a la parrilla'                               , 3, true, 438553, false, 4),
    ('Cerro Verde'               , 4, 2017, 'Lagarde'                     , 1, 'Mendoza'              , 26.99 , 40 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y vainilla. Buena estructura y taninos aterciopelados'                                                                 , '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados'                         , 3, true, 178631, false, 4),
    ('Codice'                    , 4, 2018, 'Bodega Códice'               , 1, 'Mendoza'              , 23.99 , 80 , 'tinto' , 14.5, 'roble francés'              , 'Notas de frutas rojas y negras, especias y vainilla. Final persistente y equilibrado'                                                                           , '16-18°C', 'Carnes rojas, cordero, guisos y quesos curados'                         , 3, true, 265178, false, 4);
