-- Active: 1675450657549@@127.0.0.1@5432@postgres@tienda
CREATE TABLE IF NOT EXISTS productos
(
   	ID bigint NOT NULL GENERATED BY DEFAULT AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    nombre character varying,
    sepa character varying,
    descripcion text,
    precio numeric,
    id_categoria bigint,
    activo boolean DEFAULT false,
    producto numeric,
    promocion boolean NOT NULL DEFAULT false,
    mostrar boolean NOT NULL DEFAULT false,
    nuevo_precio numeric,
    porcentaje_descuento bigint DEFAULT '0'::bigint,
    CONSTRAINT productos_pkey PRIMARY KEY (ID)
)

TABLESPACE pg_default;

CREATE TABLE IF NOT EXISTS secciones
(
    id bigint NOT NULL GENERATED BY DEFAULT AS IDENTITY ( INCREMENT 1 START 1 MINVALUE 1 MAXVALUE 9223372036854775807 CACHE 1 ),
    nombre text,
    activo boolean NOT NULL DEFAULT false,
    id_unica text,
    CONSTRAINT table_name_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

insert into productos VALUES  
(1,  'Petirrojo Merlot',               'Merlot',                'Vino Tinto' ,27.000, 1, True, 245726, False, True, NULL, 0),
(2,  'Posta Pizzela',                  'Malbec',                'Vino Tinto' ,50.0,   1, True, 933404, False, True, NULL, 0),
(3,  'Marques de villa de leyva',      'Cabernet Sauvignon',    'vino tinto' ,50.0,   1, True, 948930, False, True, NULL, 0),
(4,  'Don melchor',                    'Cabernet sauvignon',    'vino tinto' ,50.0,   1, True, 543152, False, True, NULL, 0),
(5,  'Purple angel',                   'Carmenere',             'vino tinto' ,50.0,   1, True, 330628, False, True, NULL, 0),
(6,  'Muga',                           'Tempranillo',           'vino tinto' ,50.0,   2, True, 692159, False, True, NULL, 0),
(7,  'Chateu st michelle',             'Cabernet sauvignon',    'vino tinto' ,50.0,   2, True, 323324, False, True, NULL, 0),
(8,  'Maison castel gran reserva',     'Cabernet sauvignon',    'vino tinto' ,50.0,   2, True, 191880, False, True, NULL, 0),
(9,  'santa margherita',               'Pinot grigio',          'vino blanco',50.0,   2, True, 257609, False, True, NULL, 0),
(10, 'Montes alpha M',                 '80% Cabernet Sauvignon','vino tinto' ,50.0,   2, True, 782699, False, True, NULL, 0),
(11, 'Angelica zapata',                'Malbec',                'vino tinto' ,50.0,   3, True, 850550, False, True, NULL, 0),
(12, 'Gran enemigo',                   'Malbec',                'vino tinto' ,50.0,   3, True, 652132, False, True, NULL, 0),
(13, 'Zuccardi serie A',               'Malbec',                'vino tinto' ,50.0,   3, True, 438553, False, True, NULL, 0),
(14, 'Cerro verde',                    'Merlot',                'vino tinto' ,50.0,   3, True, 178631, False, True, NULL, 0),
(15, 'Codice',                         'Tempranillo',           'vino tinto' ,50.0,   3, True, 265178, False, True, NULL, 0);

insert into secciones VALUES
(1,'NUESTROS VINOS MAS VENDIDOS'     ,TRUE, 1),
(2,'NUESTROS MEJORES VINOS'          ,TRUE, 2),
(3,'VINOS IMPORTADOS MAS EXQUISITOS' ,TRUE, 3),
(4,'PROMOCIONES'                     ,TRUE, 4);

TRUNCATE productos;
TRUNCATE secciones;