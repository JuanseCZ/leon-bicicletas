INSERT INTO
    producto (
        nomProd, imgProd, descripcionProd, precioProd, stock, idCat
    )
VALUES (
        'Bicicleta de montaña 26x4.50', 'bike2.jpeg', 'Bicicleta de montaña 26x4.5 con marco de aluminio en color azul claro componentes Shimano y frenos de disco.', 17990, 5, 1
    ),
    (
        'Bicicleta de ruta 700x28', 'bike3.jpeg', 'Bicicleta de ruta 700x28 con marco de aluminio en color verde claro componentes Shimano y frenos de disco.', 15663, 7, 1
    ),
    (
        'Bicicleta de montaña 29x2.125', 'bike4.jpeg', 'Bicicleta de montaña 29x2.125 con marco de aluminio en color azul claro componentes Shimano y frenos de disco.', 8399, 13, 1
    ),
    (
        'Bicicleta de ruta 700x23', 'bike5.jpeg', 'Bicicleta de ruta 700x23 con marco de aluminio en color blanco componentes Shimano y frenos de aluminio shimano. ', 9499, 6, 1
    ),
    (
        'Bicicleta tipo balona 20x2.125', 'bike6.jpeg', 'Bicicleta tipo balona 20x2.125 con marco metálico en color rojo componentes Shimano y freno retro pedal.', 3599, 29, 1
    ),
    (
        'Rin 26x2.125', 'refaccion1.jpeg', 'Par de rines rodada 26 de 36 rayos con aro de aluminio.', 590, 36, 3
    ),
    (
        'Juegos de frenos de disco', 'refaccion2.jpeg', 'Juego freno de disco: incluye maza trasera, delantera, par de discos mediada 160" y manivelas de aluminio.', 1295, 19, 3
    ),
    (
        'Juegos de cambios', 'refaccion3.jpeg', 'Juego de cambios marca Shimano 21 velocidades y manivelas de freno.', 610, 31, 3
    ),
    (
        'Cámara R29', 'refaccion4.jpeg', 'Cámara rodada 29 x 2.10 con válvula americana a 64mm de bronce con liquido antiponchaduras incluido.', 230, 239, 3
    ),
    (
        'Llantas 29 X 2.35', 'refaccion5.jpeg', 'Llanta 29x2.30 tubeless mtb todo terreno.', 1550, 18, 3
    ),
    (
        'Eje centro Octalink', 'refaccion6.jpeg', 'Eje de centro 68mm de balero sellado con rasurado octalink para un mejor agarre.', 460, 21, 3
    ),
    (
        'Pedales 1/2 Aluminio', 'refaccion7.jpeg', 'Par de pedales de 1/2 con cuerpo de aluminio y rodamiento sellado', 599, 37, 3
    ),
    (
        'Asiento mtb', 'refaccion8.jpeg', 'Asiento de gel con recubrimiento de piel sintética sin abrazadera.', 485, 16, 3
    ),
    (
        'Parches', 'refaccion9.jpeg', 'Caja de parches 48 piezas vulcanizado en frio.', 40, 102, 3
    ),
    (
        'Cables', 'refaccion10.jpeg', 'Juego de cables acerado mtb delantero, trasero y forro con teflon.', 115, 1018, 3
    ),
    (
        'Casco', 'accesorio1.jpeg', 'Casco para mtb o cross con cubierta de fibra de carbono, ventilación y ajuste 360º.', 825, 11, 2
    ),
    (
        'Linterna', 'accesorio2.jpeg', 'Linterna recargable de 1500 lúmenes con cambio de intensidad, estrobo y claxon integrado.', 389, 9, 2
    ),
    (
        'Bolsa', 'accesorio3.jpeg', 'Bolsa impermeable universal con soporte para celulares.', 390, 15, 2
    ),
    (
        'Diablos', 'accesorio4.jpeg', 'Diablos traseros con cuerpo de aluminio torneado.', 135, 24, 2
    ),
    (
        'Corneta', 'accesorio5.jpeg', 'Corneta de acero con abrazadera ajustable a múltiples posiciones.', 145, 25, 2
    ),
    (
        'Engrasado general', 'servicio8.jpeg', 'Engrasado completo de rodamientos, incluye ambos rines, centro, horquilla, limpieza de componentes y cuadro', 390, 100000, 4
    ),
    (
        'Ajuste de freno', 'servicio13.jpeg', 'Ajuste de frenos, incluye cables y lubricación de lineas', 150, 100000, 4
    ),
    (
        'Ajuste de cambio', 'servicio14.jpeg', 'Ajuste de cambios, incluye cables y lubricación de lineas', 150, 100000, 4
    ),
    (
        'Nivelación', 'servicio9.jpeg', 'Nivelación de rin', 120, 100000, 4
    ),
    (
        'Desponchado y carga de líquido antiponchaduras', 'servicio15.jpeg', 'Desponchado con parches de alta calidad de vulcanizado en frío y carga de liquido sellador', 140, 100000, 4
    );

INSERT INTO
    categoria (nomCat, descripcionCat)
VALUES (
        'Bicicletas', 'Bicicletas completas y armadas'
    ),
    (
        'Accesorios', 'Accesorios para ti y para tú bicicleta'
    ),
    (
        'Refacciones', 'Refacciones y repuestos para bicicletas'
    ),
    (
        'Servicios', 'Servicios de taller y mantenimiento para bicicletas'
    );

INSERT INTO
    empleados (
        nomEmple, apeEmple, isadmin, usr, passwd
    )
VALUES (
        'Juan', 'Cardona', '1', 'root', '4813494d137e1631bba301d5acab6e7bb7aa74ce1185d456565ef51d737677b2' -- root
    ),
    (
        'Eduardo', 'Nuñez', '1', 'jnunez01', '5b112d8e1dcb00581a6f61d3d15611bf' -- %nT5&2N6JRN6  
    ),
    (
        'Hugo', 'Chaparro', '1', 'hchaparro01', 'e0b00ad8dbc8da960037c2638ca9cd54' -- uCSEyZ74228%  
    ),
    (
        'Luis', 'Perez', '0', 'luisp', '1bd9e55d25f043417c98d2516185592b' -- R3Z$B!7spD9i  
    ),
    (
        'Maria', 'Gonzalez', '0', 'mariag', '94bcba1f3c979123429e3a72d1b336e2' -- nat5%$A&7y4y 
    ),
    (
        'Pedro', 'Garcia', '0', 'pedrog', '	a4d8e8af54e200b745f70df292b94a10' -- 92hSAO8sr#oD
    );

-- producto en ingles

INSERT INTO
    products (
        productName, productImage, productDescription, price, quantityAvailable, categoryId
    )
VALUES (
        '26x2.125 Rim', 'refaccion1.jpeg', 'Pair of 26-inch rims with 36 spokes and aluminum rim.', 590, 36, 2
    ),
    (
        'Disc Brake Sets', 'refaccion2.jpeg', 'Disc brake set: includes rear hub, front hub, pair of 160" diameter discs, and aluminum cranks.', 1295, 19, 2
    ),
    (
        'Gear Sets', 'refaccion3.jpeg', 'Gear set by Shimano with 21 speeds and brake levers.', 610, 31, 2
    ),
    (
        'R29 Tube', 'refaccion4.jpeg', 'Tube for 29 x 2.10 tire with American valve at 64mm, made of bronze with included anti-puncture liquid.', 230, 239, 2
    ),
    (
        '29 X 2.35 Tires', 'refaccion5.jpeg', '29x2.30 tubeless all-terrain MTB tire.', 1550, 18, 2
    ),
    (
        'Octalink Bottom Bracket', 'refaccion6.jpeg', '68mm sealed bearing bottom bracket with octalink shaving for better grip.', 460, 21, 2
    ),
    (
        'Aluminum 1/2 Pedals', 'refaccion7.jpeg', 'Pair of 1/2 pedals with aluminum body and sealed bearings.', 599, 37, 2
    ),
    (
        'MTB Saddle', 'refaccion8.jpeg', 'Gel saddle with synthetic leather covering, without clamp.', 485, 16, 2
    ),
    (
        'Patches', 'refaccion9.jpeg', 'Box of 48 cold vulcanized patches.', 40, 102, 2
    ),
    (
        'Cables', 'refaccion10.jpeg', 'MTB steel cable set: front, rear, and teflon-coated housing.', 115, 1018, 2
    ),
    (
        'Helmet', 'accesorio1.jpeg', 'MTB or cross helmet with carbon fiber shell, ventilation, and 360º adjustment.', 825, 11, 3
    ),
    (
        'Flashlight', 'accesorio2.jpeg', 'Rechargeable flashlight with 1500 lumens, adjustable intensity, strobe, and integrated horn.', 389, 9, 3
    ),
    (
        'Bag', 'accesorio3.jpeg', 'Universal waterproof bag with cellphone holder.', 390, 15, 3
    ),
    (
        'Rear Kickstands', 'accesorio4.jpeg', 'Rear kickstands with turned aluminum body.', 135, 24, 3
    ),
    (
        'Horn', 'accesorio5.jpeg', 'Steel horn with adjustable clamp for multiple positions.', 145, 25, 3
    ),
    (
        'General Greasing', 'servicio8.jpeg', 'Complete greasing of bearings, including both rims, hub, fork, component cleaning, and frame.', 390, 100000, 4
    ),
    (
        'Brake Adjustment', 'servicio13.jpeg', 'Brake adjustment, including cable service and lubrication.', 150, 100000, 4
    ),
    (
        'Gear Adjustment', 'servicio14.jpeg', 'Gear adjustment, including cable service and lubrication.', 150, 100000, 4
    ),
    (
        'Wheel Truing', 'servicio9.jpeg', 'Wheel truing.', 120, 100000, 4
    ),
    (
        'Patch and Anti-Puncture Liquid Application', 'servicio15.jpeg', 'High-quality cold vulcanized patch application and sealant filling.', 140, 100000, 4
    ),
    (
        'Mountain Bike 26x4.50', 'bike2.jpeg', 'Mountain Bike 26x4.5 with aluminum frame in light blue color, Shimano components, and disc brakes.', 17990, 5, 1
    ),
    (
        'Road Bike 700x28', 'bike3.jpeg', 'Road Bike 700x28 with aluminum frame in light green color, Shimano components, and disc brakes.', 15663, 7, 1
    ),
    (
        'Mountain Bike 29x2.125', 'bike4.jpeg', 'Mountain Bike 29x2.125 with aluminum frame in light blue color, Shimano components, and disc brakes.', 8399, 13, 1
    ),
    (
        'Road Bike 700x23', 'bike5.jpeg', 'Road Bike 700x23 with aluminum frame in white color, Shimano components, and aluminum Shimano brakes.', 9499, 6, 1
    ),
    (
        'Balloon-type Bike 20x2.125', 'bike6.jpeg', 'Balloon-type Bike 20x2.125 with metallic frame in red color, Shimano components, and coaster brake.', 3599, 29, 1
    );