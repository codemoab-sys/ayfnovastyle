SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE producto_imagenes;
TRUNCATE TABLE productos;
TRUNCATE TABLE marcas;
TRUNCATE TABLE familias;
TRUNCATE TABLE banners;
SET FOREIGN_KEY_CHECKS = 1;

USE micatalogo;
SET NAMES utf8mb4;
SET CHARACTER SET utf8mb4;

INSERT INTO familias (nombre, slug, color, orden, estado) VALUES
('Antisépticos, Desinfectantes y Accesorios', 'antisepticos-desinfectantes-y-accesorios', '#009933', 1, 1),
('Bioseguridad - EPP', 'bioseguridad-epp', '#009933', 2, 1),
('Drenaje y Ostomías (Bolsas y Accesorios)', 'drenaje-y-ostomias', '#009933', 3, 1),
('Enteral e Irrigación', 'enteral-e-irrigacion', '#009933', 4, 1),
('Equipos Biomédicos', 'equipos-biomedicos', '#009933', 5, 1),
('Infusión y Acceso Venoso', 'infusion-y-acceso-venoso', '#009933', 6, 1),
('Inyección y Punción (Agujas y Accesorios)', 'inyeccion-y-puncion', '#009933', 7, 1),
('Limpieza e Higiene', 'limpieza-e-higiene', '#009933', 8, 1),
('Material de Curación', 'material-de-curacion', '#009933', 9, 1),
('Material de vidrio', 'material-de-vidrio', '#009933', 10, 1),
('Medicamentos - Anestésicos y bloqueo', 'medicamentos-anestesicos-y-bloqueo', '#009933', 11, 1),
('Medicamentos - Antibióticos', 'medicamentos-antibioticos', '#009933', 12, 1),
('Nutrición Parenteral', 'nutricion-parenteral', '#009933', 13, 1),
('Quirúrgicos', 'quirurgicos', '#009933', 14, 1),
('Rehidratación Oral', 'rehidratacion-oral', '#009933', 15, 1),
('Respiratorio', 'respiratorio', '#009933', 16, 1),
('Ropa Médica y Barreras Quirúrgicas', 'ropa-medica-y-barreras-quirurgicas', '#009933', 17, 1),
('Soluciones y Sueros', 'soluciones-y-sueros', '#009933', 18, 1),
('Solventes / Diluyentes (parenteral)', 'solventes-diluyentes-parenteral', '#009933', 19, 1),
('Sondas', 'sondas', '#009933', 20, 1);

INSERT INTO marcas (nombre, estado) VALUES
('3M',1),('ALFYMEDIX',1),('ALKOFARMA',1),('ALKHOFAR',1),('B BRAUN',1),
('Bio-Protech Inc.',1),('Biosafe',1),('Coloplast',1),('COPPON',1),
('Favetex',1),('FRESENIUS KABI PERU S.A',1),('Gasatex',1),('Genérico',1),
('HULK',1),('MEDEX',1),('Medifarma',1),('NIPRO',1),('ONE JECT',1),
('PharmaGen',1),('QUIROFANO',1),('QuiMedic Plus',1),('R&G',1),
('RIESTER',1),('Roker Perú S.A.',1),('SALVISAFE',1),('Sanderson S.A.',1),
('SIGMA',1),('SONY',1),('SUPERIOR',1),('T-C',1),('Tagum',1),
('Venofix',1),('WESTERN',1);

-- Variables de familias
SET @ant = (SELECT id FROM familias WHERE slug='antisepticos-desinfectantes-y-accesorios');
SET @bio = (SELECT id FROM familias WHERE slug='bioseguridad-epp');
SET @dre = (SELECT id FROM familias WHERE slug='drenaje-y-ostomias');
SET @ent = (SELECT id FROM familias WHERE slug='enteral-e-irrigacion');
SET @equ = (SELECT id FROM familias WHERE slug='equipos-biomedicos');
SET @inf = (SELECT id FROM familias WHERE slug='infusion-y-acceso-venoso');
SET @iny = (SELECT id FROM familias WHERE slug='inyeccion-y-puncion');
SET @lim = (SELECT id FROM familias WHERE slug='limpieza-e-higiene');
SET @mat = (SELECT id FROM familias WHERE slug='material-de-curacion');
SET @vid = (SELECT id FROM familias WHERE slug='material-de-vidrio');
SET @meda = (SELECT id FROM familias WHERE slug='medicamentos-anestesicos-y-bloqueo');
SET @medb = (SELECT id FROM familias WHERE slug='medicamentos-antibioticos');
SET @nut = (SELECT id FROM familias WHERE slug='nutricion-parenteral');
SET @qui = (SELECT id FROM familias WHERE slug='quirurgicos');
SET @reh = (SELECT id FROM familias WHERE slug='rehidratacion-oral');
SET @res = (SELECT id FROM familias WHERE slug='respiratorio');
SET @rop = (SELECT id FROM familias WHERE slug='ropa-medica-y-barreras-quirurgicas');
SET @sol = (SELECT id FROM familias WHERE slug='soluciones-y-sueros');
SET @solv = (SELECT id FROM familias WHERE slug='solventes-diluyentes-parenteral');
SET @son = (SELECT id FROM familias WHERE slug='sondas');

-- Variables de marcas
SET @m3m = (SELECT id FROM marcas WHERE nombre='3M');
SET @alf = (SELECT id FROM marcas WHERE nombre='ALFYMEDIX');
SET @alkf = (SELECT id FROM marcas WHERE nombre='ALKOFARMA');
SET @alkh = (SELECT id FROM marcas WHERE nombre='ALKHOFAR');
SET @bb = (SELECT id FROM marcas WHERE nombre='B BRAUN');
SET @bp = (SELECT id FROM marcas WHERE nombre='Bio-Protech Inc.');
SET @bio_s = (SELECT id FROM marcas WHERE nombre='Biosafe');
SET @colo = (SELECT id FROM marcas WHERE nombre='Coloplast');
SET @copp = (SELECT id FROM marcas WHERE nombre='COPPON');
SET @fav = (SELECT id FROM marcas WHERE nombre='Favetex');
SET @fres = (SELECT id FROM marcas WHERE nombre='FRESENIUS KABI PERU S.A');
SET @gas = (SELECT id FROM marcas WHERE nombre='Gasatex');
SET @gen = (SELECT id FROM marcas WHERE nombre='Genérico');
SET @hulk = (SELECT id FROM marcas WHERE nombre='HULK');
SET @medx = (SELECT id FROM marcas WHERE nombre='MEDEX');
SET @medi = (SELECT id FROM marcas WHERE nombre='Medifarma');
SET @nip = (SELECT id FROM marcas WHERE nombre='NIPRO');
SET @onej = (SELECT id FROM marcas WHERE nombre='ONE JECT');
SET @pharm = (SELECT id FROM marcas WHERE nombre='PharmaGen');
SET @qro = (SELECT id FROM marcas WHERE nombre='QUIROFANO');
SET @qmp = (SELECT id FROM marcas WHERE nombre='QuiMedic Plus');
SET @rg = (SELECT id FROM marcas WHERE nombre='R&G');
SET @ries = (SELECT id FROM marcas WHERE nombre='RIESTER');
SET @roker = (SELECT id FROM marcas WHERE nombre='Roker Perú S.A.');
SET @salv = (SELECT id FROM marcas WHERE nombre='SALVISAFE');
SET @sand = (SELECT id FROM marcas WHERE nombre='Sanderson S.A.');
SET @sigma = (SELECT id FROM marcas WHERE nombre='SIGMA');
SET @sony = (SELECT id FROM marcas WHERE nombre='SONY');
SET @sup = (SELECT id FROM marcas WHERE nombre='SUPERIOR');
SET @tc = (SELECT id FROM marcas WHERE nombre='T-C');
SET @tag = (SELECT id FROM marcas WHERE nombre='Tagum');
SET @veno = (SELECT id FROM marcas WHERE nombre='Venofix');
SET @west = (SELECT id FROM marcas WHERE nombre='WESTERN');

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ant, @roker, 'ANT-001', 'HIBICLEN AV ESPUMA 2%', 'HIBICLEN AV. 2% C/DISPENS. C.C X1L', 'GLUCONATO CLORHEXIDINA, COCOAMIDA PROPIL BETAÍNA, ALOE VERA, PROPILEN GLICOL, GLICERINA', 'Frasco de Polietileno de alta densidad (PEAD) con tapa tipo caño de PCV/PEAD', 'Antiséptico líquido al 2% con dispensador, utilizado para la limpieza y desinfección de la piel lavado y antisepsia de manos', 'X 1 LITRO', 'ROCKER PERU S.A.', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ant, @roker, 'ANT-002', 'HIBICLEN AV ESPUMA 4%', 'HIBICLEN AV ESPUMA 4% X1L', 'Gluconato de Clorhexidina 4%, Propilenglicol, Glicerina y Aloe vera > a 2%.', 'Frasco de polietileno de alta densidad (PEAD)', 'Jabón Antiséptico a base Gluconato de Clorhexidina PARA PROCEDIMIENTOS Y/O LAVADO DE MANOS QUIRURGICO', 'X 1 LITRO', 'ROCKER PERU S.A.', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ant, @roker, 'ANT-003', 'HIBICLEN 4% C. CERRADO', 'HIBICLEN AV 4% C/DISPENS. C.C X1L', 'Gluconato de Clorhexidina 4%, Propilenglicol, Glicerina y Aloe vera > a 2%.', 'Frasco de Frasco de polietileno de alta densidad (PEAD) con tapa tipo caño de PCV/PEAD Y dispensador de polipropileno', 'Jabón Antiséptico a base Gluconato de Clorhexidina INDICADO PARA PROCEDIMIENTOS Y/O LAVADO DE MANOS QUIRURGICO', 'X 1 LITRO', 'ROCKER PERU S.A.', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@bio, @alkh, 'BIO-001', 'GUANTE DE LATEX PARA EXAMEN', 'GUANTE P/EXAMEN "M" X100UND', '', 'Latex de Caucho Natural', 'Guantes desechables utilizados para protección del personal de salud y prevención de contaminación cruzada.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@bio, @qmp, 'BIO-002', 'GUANTE QUIRÚRGICO ESTÉRIL N°7', 'GUANTE QUIRURGICO ESTERIL N°7', '', 'Latex', 'Guante Quirúrgico Estéril descartable. Presentación bilateral. Debe ser usado en procedimientos quirúrgicos para protección del paciente y del personal de salud.', 'PAR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@bio, @qmp, 'BIO-003', 'GUANTE QUIRÚRGICO ESTÉRIL N°6.5', 'GUANTE QUIRURGICO ESTERIL N°6 1/2', '', 'Latex', 'Guante Quirúrgico Estéril descartable. Presentación bilateral. Debe ser usado en procedimientos quirúrgicos para protección del paciente y del personal de salud.', 'PAR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@bio, @qmp, 'BIO-004', 'GUANTE QUIRÚRGICO ESTÉRIL N°8', 'GUANTE QUIRURGICO ESTERIL N°8', '', 'Latex', 'Guante Quirúrgico Estéril descartable. Presentación bilateral. Debe ser usado en procedimientos quirúrgicos para protección del paciente y del personal de salud.', 'PAR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@bio, @qmp, 'BIO-005', 'GUANTE QUIRÚRGICO ESTÉRIL N°7.5', 'GUANTE QUIRURGICO ESTERIL N°7 1/2', '', 'Latex', 'Guante Quirúrgico Estéril descartable. Presentación bilateral. Debe ser usado en procedimientos quirúrgicos para protección del paciente y del personal de salud.', 'PAR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-001', 'BOLSA OSTOMÍA COLOPLAST 10614', 'BOLSA DE OSTOMIA 10614 COLOPLAST SENSURA X', '', 'Film de poliuretano multicapa con filtro de carbón', 'Bolsa de ostomía con filtro de carbón integrado, barrera de protección cutánea, diseño convexo. Cierre inferior. Transparente.', 'CAJA X 10 UND', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-002', 'BOLSA OSTOMÍA COLOPLAST 11554', 'BOLSA DE OSTOMIA 11554 COLOPLAST SENSURA X', '', 'Film de poliuretano multicapa con filtro de carbón', 'Bolsa de ostomía con filtro de carbón integrado, barrera de protección cutánea, diseño convexo. Cierre inferior. Opaca.', 'CAJA X 10 UND', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-003', 'BOLSA OSTOMÍA COLOPLAST 1699', 'BOLSA DE OSTOMIA 1699 COLOPLAST SENSURA X', '', 'Film de poliuretano multicapa', 'Bolsa de ostomía drenable. Barrera de protección cutánea. Cierre inferior con clip. Transparente.', 'CAJA X 10 UND', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-004', 'BOLSA OSTOMÍA COLOPLAST 1689', 'BOLSA DE OSTOMIA 1689 COLOPLAST SENSURA X', '', 'Film de poliuretano multicapa', 'Bolsa de ostomía drenable. Barrera de protección cutánea. Cierre inferior con clip. Opaca.', 'CAJA X 10 UND', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-005', 'BOLSA OSTOMÍA COLOPLAST 10485', 'BOLSA DE OSTOMIA 10485 COLOPLAST SENSURA X', '', 'Film de poliuretano multicapa con filtro de carbón', 'Bolsa de ostomía con filtro de carbón. Barrera de protección cutánea. Convexidad profunda. Cierre inferior. Opaca.', 'CAJA X 10 UND', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-006', 'PASTA PROTECTORA COLOPLAST 12050', 'PASTA PROTECTORA 12050 COLOPLAST', 'PECTINA, CMC, GELATINA, POLIISOBUTILENO', 'Tubo de aluminio', 'Pasta protectora para rellenar irregularidades de la piel alrededor del estoma. Crea una superficie uniforme para la adhesión de la bolsa.', 'TUBO X 60 G', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@dre, @colo, 'DRE-007', 'POLVO PROTECTOR COLOPLAST 12034', 'POLVO PROTECTOR 12034 COLOPLAST', 'PECTINA, CMC, GELATINA', 'Frasco de polietileno', 'Polvo protector para absorber la humedad y proteger la piel periestomal. Crear una barrera seca para la adhesión.', 'FRASCO X 28 G', 'COLOPLAST', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ent, @gen, 'ENT-001', 'ALMIDÓN DE MAÍZ', 'ALMIDON DE MAIZ', 'Almidón de maíz puro', 'Bolsa de polietileno', 'Polvo fino utilizado como espesante para preparaciones enterales y alimentación por sonda.', 'BOLSA X 250 GR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ent, @bb, 'ENT-002', 'AGUA DESTILADA 1L', 'AGUA DESTILADA X 1L', 'Agua purificada por destilación.', 'Frasco de vidrio o polietileno', 'Agua destilada estéril para irrigación, lavado de heridas y procedimientos médicos.', 'X 1 LITRO', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ent, @bb, 'ENT-003', 'AGUA DESTILADA 500 ML', 'AGUA DESTILADA X 500 ML', 'Agua purificada por destilación.', 'Frasco de vidrio o polietileno', 'Agua destilada estéril para irrigación, lavado de heridas y procedimientos médicos.', 'X 500 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ent, @bb, 'ENT-004', 'AGUA DESTILADA 250 ML', 'AGUA DESTILADA X 250 ML', 'Agua purificada por destilación.', 'Frasco de vidrio o polietileno', 'Agua destilada estéril para irrigación, lavado de heridas y procedimientos médicos.', 'X 250 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@ent, @gen, 'ENT-005', 'SUERO DE REHIDRATACIÓN ORAL', 'SUERO DE REHIDRATACION ORAL', 'Glucosa anhidra 20g, Cloruro de Sodio 3.5g, Citrato de Sodio 2.9g, Cloruro de Potasio 1.5g', 'Sobre de papel aluminio multicapa', 'Polvo para reconstituir. Indicado para prevenir y tratar la deshidratación causada por diarrea aguda.', 'SOBRE X 27.9 G', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @sony, 'EQU-001', 'IMPRESORA TÉRMICA SONY', 'IMPRESORA TERMICA SONY', '', 'Plástico ABS, componentes electrónicos', 'Impresora térmica de alta velocidad para equipos de ultrasonido, monitoreo y diagnóstico por imágenes.', 'UNIDAD', 'SONY', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @sony, 'EQU-002', 'PAPEL TÉRMICO SONY', 'PAPEL TERMICO SONY', 'Papel térmico sensible al calor', 'Rollo de papel', 'Papel térmico de alta calidad para impresoras de equipos biomédicos. Impresión nítida y duradera.', 'ROLLO', 'SONY', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @qro, 'EQU-003', 'LÁMPARA QUIROFANO LED', 'LAMPARA QUIROFANO LED', '', 'Aluminio, acero inoxidable, lentes de vidrio templado', 'Lámpara quirúrgica LED de alta intensidad con temperatura de color regulable. Sistema de iluminación sin sombras.', 'UNIDAD', 'QUIROFANO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @qro, 'EQU-004', 'LÁMPARA CURA LED', 'LAMPARA CURA LED', '', 'Aluminio, acero inoxidable', 'Lámpara para procedimientos y curaciones con luz LED. Brazo articulado móvil.', 'UNIDAD', 'QUIROFANO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @medx, 'EQU-005', 'ELECTROCARDIOGRAFO MEDEX', 'ELECTROCARDIOGRAFO MEDEX', '', 'Plástico ABS, componentes electrónicos', 'Electrocardiógrafo de 12 derivaciones con interpretación automática. Pantalla LCD a color.', 'UNIDAD', 'MEDEX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @medx, 'EQU-006', 'MONITOR DE SIGNOS VITALES', 'MONITOR DE SIGNOS VITALES MEDEX', '', 'Plástico ABS, componentes electrónicos', 'Monitor multiparámetro para ECG, SpO2, NIBP, temperatura. Pantalla táctil a color.', 'UNIDAD', 'MEDEX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @medx, 'EQU-007', 'DESFIBRILADOR MEDEX', 'DESFIBRILADOR MEDEX', '', 'Plástico ABS, componentes electrónicos', 'Desfibrilador externo automático (DEA) con instrucciones de voz. Bifásico.', 'UNIDAD', 'MEDEX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @medx, 'EQU-008', 'BOMBA DE INFUSIÓN MEDEX', 'BOMBA DE INFUSION MEDEX', '', 'Plástico ABS, componentes electrónicos', 'Bomba de infusión volumétrica para administración precisa de líquidos intravenosos.', 'UNIDAD', 'MEDEX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @medx, 'EQU-009', 'ASPIRADOR DE SECRECIONES MEDEX', 'ASPIRADOR DE SECRECIONES MEDEX', '', 'Plástico ABS, acero inoxidable', 'Aspirador de secreciones portátil para procedimientos de succión. Incluye frasco colector.', 'UNIDAD', 'MEDEX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@equ, @qro, 'EQU-010', 'NEBULIZADOR QUIROFANO', 'NEBULIZADOR QUIROFANO', '', 'Plástico ABS, componentes electrónicos', 'Nebulizador ultrasónico portátil para administración de medicamentos inhalados.', 'UNIDAD', 'QUIROFANO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @nip, 'INF-001', 'EQUIPO DE MICROGOTEO NIPRO', 'EQUIPO DE MICROGOTEO NIPRO', '', 'PVC libre de látex, conector Luer Lock', 'Equipo de infusión para administración de líquidos intravenosos con cámara de goteo. Regulador de flujo.', 'UNIDAD', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @nip, 'INF-002', 'EQUIPO DE MACROGOTEO NIPRO', 'EQUIPO DE MACROGOTEO NIPRO', '', 'PVC libre de látex, conector Luer Lock', 'Equipo de infusión macrogotas para administración rápida de líquidos intravenosos.', 'UNIDAD', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @bb, 'INF-003', 'CATÉTER INTRAVENOSO N°18', 'CATETER INTRAVENOSO N° 18', '', 'Teflón (PTFE), aguja de acero inoxidable', 'Catéter intravenoso periférico con alas. Diseño para venopunción segura.', 'UNIDAD', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @bb, 'INF-004', 'CATÉTER INTRAVENOSO N°20', 'CATETER INTRAVENOSO N° 20', '', 'Teflón (PTFE), aguja de acero inoxidable', 'Catéter intravenoso periférico con alas. Diseño para venopunción segura.', 'UNIDAD', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @bb, 'INF-005', 'CATÉTER INTRAVENOSO N°22', 'CATETER INTRAVENOSO N° 22', '', 'Teflón (PTFE), aguja de acero inoxidable', 'Catéter intravenoso periférico con alas. Diseño para venopunción segura.', 'UNIDAD', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @bb, 'INF-006', 'CATÉTER INTRAVENOSO N°24', 'CATETER INTRAVENOSO N° 24', '', 'Teflón (PTFE), aguja de acero inoxidable', 'Catéter intravenoso periférico con alas. Diseño para venopunción segura.', 'UNIDAD', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @veno, 'INF-007', 'VENDA DE YESO VENOFIX 4"', 'VENDA YESO VENOFIX 4" X 3 YDS', '', 'Yeso ortopédico de alta resistencia', 'Venda de yeso para inmovilización y férulas. Fraguado rápido.', 'UNIDAD', 'VENOFIX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@inf, @veno, 'INF-008', 'VENDA DE YESO VENOFIX 6"', 'VENDA YESO VENOFIX 6" X 3 YDS', '', 'Yeso ortopédico de alta resistencia', 'Venda de yeso para inmovilización y férulas. Fraguado rápido.', 'UNIDAD', 'VENOFIX', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-001', 'JERINGA 10 ML NIPRO', 'JERINGA 10 ML NIPRO X 100 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 3 cuerpos, estéril, desechable. Sin aguja.', 'CAJA X 100 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-002', 'JERINGA 5 ML NIPRO', 'JERINGA 5 ML NIPRO X 100 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 3 cuerpos, estéril, desechable. Sin aguja.', 'CAJA X 100 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-003', 'JERINGA 3 ML NIPRO', 'JERINGA 3 ML NIPRO X 100 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 3 cuerpos, estéril, desechable. Sin aguja.', 'CAJA X 100 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-004', 'JERINGA 20 ML NIPRO', 'JERINGA 20 ML NIPRO X 50 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 3 cuerpos, estéril, desechable. Sin aguja.', 'CAJA X 50 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-005', 'JERINGA 60 ML NIPRO', 'JERINGA 60 ML NIPRO X 30 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 3 cuerpos, estéril, desechable. Sin aguja.', 'CAJA X 30 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @nip, 'INY-006', 'JERINGA 1 ML NIPRO', 'JERINGA 1 ML NIPRO X 100 UND', '', 'Polipropileno, émbolo de polietileno', 'Jeringa de 1 ml para insulina/tuberculina. Estéril, desechable.', 'CAJA X 100 UND', 'NIPRO', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @alkh, 'INY-007', 'AGUJA HIPODÉRMICA N°18', 'AGUJA HIPODERMICA N° 18 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ALKHOFAR', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @alkh, 'INY-008', 'AGUJA HIPODÉRMICA N°20', 'AGUJA HIPODERMICA N° 20 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ALKHOFAR', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @alkh, 'INY-009', 'AGUJA HIPODÉRMICA N°21', 'AGUJA HIPODERMICA N° 21 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ALKHOFAR', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @alkh, 'INY-010', 'AGUJA HIPODÉRMICA N°22', 'AGUJA HIPODERMICA N° 22 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ALKHOFAR', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @alkh, 'INY-011', 'AGUJA HIPODÉRMICA N°23', 'AGUJA HIPODERMICA N° 23 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ALKHOFAR', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @onej, 'INY-012', 'AGUJA HIPODÉRMICA N°25', 'AGUJA HIPODERMICA N° 25 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ONE JECT', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @onej, 'INY-013', 'AGUJA HIPODÉRMICA N°26', 'AGUJA HIPODERMICA N° 26 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ONE JECT', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@iny, @onej, 'INY-014', 'AGUJA HIPODÉRMICA N°30', 'AGUJA HIPODERMICA N° 30 X 100 UND', '', 'Acero inoxidable, hub de polipropileno', 'Aguja hipodérmica estéril, desechable. Bisel tri-corte.', 'CAJA X 100 UND', 'ONE JECT', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-001', 'ALCOHOL 70° X 1L', 'ALCOHOL 70° X 1 LITRO', 'Alcohol etílico 70°', 'Frasco de polietileno de alta densidad', 'Alcohol antiséptico para desinfección de piel, superficies y materiales.', 'X 1 LITRO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-002', 'ALCOHOL 70° X 500 ML', 'ALCOHOL 70° X 500 ML', 'Alcohol etílico 70°', 'Frasco de polietileno de alta densidad', 'Alcohol antiséptico para desinfección de piel, superficies y materiales.', 'X 500 ML', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-003', 'ALCOHOL 70° X 250 ML', 'ALCOHOL 70° X 250 ML', 'Alcohol etílico 70°', 'Frasco de polietileno de alta densidad', 'Alcohol antiséptico para desinfección de piel, superficies y materiales.', 'X 250 ML', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-004', 'ALCOHOL 96° X 1L', 'ALCOHOL 96° X 1 LITRO', 'Alcohol etílico 96°', 'Frasco de polietileno de alta densidad', 'Alcohol de alta concentración para desinfección y limpieza de equipos.', 'X 1 LITRO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-005', 'AGUA OXIGENADA 10 VOL X 120 ML', 'AGUA OXIGENADA 10 VOL X 120 ML', 'Peróxido de hidrógeno 3%', 'Frasco de polietileno', 'Agua oxigenada para limpieza de heridas y antisepsia.', 'X 120 ML', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-006', 'AGUA OXIGENADA 10 VOL X 1L', 'AGUA OXIGENADA 10 VOL X 1L', 'Peróxido de hidrógeno 3%', 'Frasco de polietileno', 'Agua oxigenada para limpieza de heridas y antisepsia.', 'X 1 LITRO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-007', 'ALCOHOL GEL 70° X 1L', 'ALCOHOL GEL 70° X 1 LITRO', 'Alcohol etílico 70°, Carbopol, Glicerina', 'Frasco dispensador de polietileno', 'Alcohol gel antiséptico para higiene de manos. Con glicerina humectante.', 'X 1 LITRO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-008', 'ALCOHOL GEL 70° X 500 ML', 'ALCOHOL GEL 70° X 500 ML', 'Alcohol etílico 70°, Carbopol, Glicerina', 'Frasco dispensador de polietileno', 'Alcohol gel antiséptico para higiene de manos. Con glicerina humectante.', 'X 500 ML', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-009', 'ALCOHOL GEL 70° X 250 ML', 'ALCOHOL GEL 70° X 250 ML', 'Alcohol etílico 70°, Carbopol, Glicerina', 'Frasco dispensador de polietileno', 'Alcohol gel antiséptico para higiene de manos. Con glicerina humectante.', 'X 250 ML', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-010', 'JABÓN LÍQUIDO ANTISÉPTICO X 1L', 'JABON LIQUIDO ANTISEPTICO X 1L', 'Clorhexidina 0.5%, tensoactivos suaves', 'Frasco de polietileno con dispensador', 'Jabón líquido antiséptico para lavado de manos quirúrgico y rutinario.', 'X 1 LITRO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-011', 'PAÑOS HUMEDOS DESECHABLES X 100', 'PAÑOS HUMEDOS DESECHABLES X 100 UND', 'Agua purificada, propilenglicol, surfactantes suaves', 'Paquete de polietileno con tapa flip-top', 'Paños húmedos desechables para higiene del paciente. Hipoalergénicos.', 'PAQUETE X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-012', 'PAÑALES PARA ADULTO TALLA M', 'PAÑAL PARA ADULTO TALLA M X 10 UND', 'Pulpa de celulosa, polímero superabsorbente', 'Paquete de plástico', 'Pañal desechable para adulto con núcleo absorbente y barreras anti-fugas.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-013', 'PAÑALES PARA ADULTO TALLA L', 'PAÑAL PARA ADULTO TALLA L X 10 UND', 'Pulpa de celulosa, polímero superabsorbente', 'Paquete de plástico', 'Pañal desechable para adulto con núcleo absorbente y barreras anti-fugas.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-014', 'PAÑALES PARA ADULTO TALLA XG', 'PAÑAL PARA ADULTO TALLA XG X 10 UND', 'Pulpa de celulosa, polímero superabsorbente', 'Paquete de plástico', 'Pañal desechable para adulto con núcleo absorbente y barreras anti-fugas.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@lim, @gen, 'LIM-015', 'PAÑALES PARA ADULTO TALLA G', 'PAÑAL PARA ADULTO TALLA G X 10 UND', 'Pulpa de celulosa, polímero superabsorbente', 'Paquete de plástico', 'Pañal desechable para adulto con núcleo absorbente y barreras anti-fugas.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-001', 'APÓSITO TRANSPARENTE 3M 1624W', 'APOSITO TRANSPARENTE 3M TEGADERM 1624W', 'Adhesivo acrílico hipoalergénico', 'Película de poliuretano transparente', 'Apósito transparente semipermeable para protección de catéteres y heridas. Permite la transpiración.', 'CAJA X 100 UND', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-002', 'APÓSITO TRANSPARENTE 3M 1626W', 'APOSITO TRANSPARENTE 3M TEGADERM 1626W', 'Adhesivo acrílico hipoalergénico', 'Película de poliuretano transparente', 'Apósito transparente semipermeable para protección de catéteres y heridas. Tamaño 6x7 cm.', 'CAJA X 100 UND', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-003', 'MICROPORE 3M 1"', 'MICROPORE 3M 1" X 10 YDS', 'Adhesivo acrílico hipoalergénico', 'Papel no tejido', 'Cinta quirúrgica microporosa hipoalergénica para fijación de apósitos.', 'UNIDAD', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-004', 'MICROPORE 3M 2"', 'MICROPORE 3M 2" X 10 YDS', 'Adhesivo acrílico hipoalergénico', 'Papel no tejido', 'Cinta quirúrgica microporosa hipoalergénica para fijación de apósitos.', 'UNIDAD', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-005', 'LEUCOPLAST 3M 1"', 'LEUCOPLAST 3M 1" X 5 YDS', 'Adhesivo acrílico', 'Tela adhesiva de alta resistencia', 'Cinta adhesiva de tela para fijación de vendajes y apósitos en zonas de alta movilidad.', 'UNIDAD', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-006', 'LEUCOPLAST 3M 2"', 'LEUCOPLAST 3M 2" X 5 YDS', 'Adhesivo acrílico', 'Tela adhesiva de alta resistencia', 'Cinta adhesiva de tela para fijación de vendajes y apósitos en zonas de alta movilidad.', 'UNIDAD', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-007', 'MICROPORE 3M 1/2"', 'MICROPORE 3M 1/2" X 10 YDS', 'Adhesivo acrílico hipoalergénico', 'Papel no tejido', 'Cinta quirúrgica microporosa hipoalergénica para fijación de apósitos de pequeño tamaño.', 'UNIDAD', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-008', 'VENDA ELÁSTICA 4"', 'VENDA ELASTICA 4" X 5 YDS', 'Algodón y elastano', 'Rollo de venda', 'Venda de compresión elástica para soporte y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-009', 'VENDA ELÁSTICA 3"', 'VENDA ELASTICA 3" X 5 YDS', 'Algodón y elastano', 'Rollo de venda', 'Venda de compresión elástica para soporte y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-010', 'VENDA ELÁSTICA 2"', 'VENDA ELASTICA 2" X 5 YDS', 'Algodón y elastano', 'Rollo de venda', 'Venda de compresión elástica para soporte y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-011', 'VENDA DE GASA 4"', 'VENDA DE GASA 4" X 5 YDS', 'Gasa 100% algodón', 'Rollo de venda', 'Venda de gasa para limpieza, absorción y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-012', 'VENDA DE GASA 3"', 'VENDA DE GASA 3" X 5 YDS', 'Gasa 100% algodón', 'Rollo de venda', 'Venda de gasa para limpieza, absorción y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-013', 'VENDA DE GASA 2"', 'VENDA DE GASA 2" X 5 YDS', 'Gasa 100% algodón', 'Rollo de venda', 'Venda de gasa para limpieza, absorción y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-014', 'VENDA DE GASA 6"', 'VENDA DE GASA 6" X 5 YDS', 'Gasa 100% algodón', 'Rollo de venda', 'Venda de gasa para limpieza, absorción y fijación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-015', 'ALGODÓN HIDRÓFILO X 500 GR', 'ALGODON HIDROFILO X 500 GR', 'Algodón 100% puro', 'Paquete de papel kraft', 'Algodón hidrófilo absorbente para limpieza y curación de heridas.', 'PAQUETE X 500 GR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-016', 'ALGODÓN HIDRÓFILO X 100 GR', 'ALGODON HIDROFILO X 100 GR', 'Algodón 100% puro', 'Paquete de papel kraft', 'Algodón hidrófilo absorbente para limpieza y curación de heridas.', 'PAQUETE X 100 GR', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-017', 'GASA ESTÉRIL 10X10 CM X 8 CAPAS', 'GASA ESTERIL 10X10 CM X 8 CAPAS', 'Gasa 100% algodón', 'Paquete individual estéril', 'Gasa estéril para curación de heridas y procedimientos quirúrgicos.', 'PAQUETE X 5 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-018', 'GASA ESTÉRIL 7.5X7.5 CM X 8 CAPAS', 'GASA ESTERIL 7.5X7.5 CM X 8 CAPAS', 'Gasa 100% algodón', 'Paquete individual estéril', 'Gasa estéril para curación de heridas y procedimientos quirúrgicos.', 'PAQUETE X 5 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-019', 'GASA ESTÉRIL 5X5 CM X 8 CAPAS', 'GASA ESTERIL 5X5 CM X 8 CAPAS', 'Gasa 100% algodón', 'Paquete individual estéril', 'Gasa estéril para curación de heridas y procedimientos quirúrgicos.', 'PAQUETE X 5 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-020', 'ESPARADRAPO QUIRÚRGICO 1"', 'ESPARADRAPO QUIRURGICO 1" X 10 YDS', 'Adhesivo acrílico', 'Tela quirúrgica', 'Esparadrapo quirúrgico de tela para fijación de apósitos y vendajes.', 'ROLLO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-021', 'ESPARADRAPO QUIRÚRGICO 2"', 'ESPARADRAPO QUIRURGICO 2" X 10 YDS', 'Adhesivo acrílico', 'Tela quirúrgica', 'Esparadrapo quirúrgico de tela para fijación de apósitos y vendajes.', 'ROLLO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-022', 'ESPARADRAPO QUIRÚRGICO 3"', 'ESPARADRAPO QUIRURGICO 3" X 10 YDS', 'Adhesivo acrílico', 'Tela quirúrgica', 'Esparadrapo quirúrgico de tela para fijación de apósitos y vendajes.', 'ROLLO', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-023', 'VENDA DE YESO 4"', 'VENDA DE YESO 4" X 3 YDS', 'Yeso ortopédico', 'Venda de gasa impregnada', 'Venda de yeso para inmovilización y férulas.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-024', 'VENDA DE YESO 6"', 'VENDA DE YESO 6" X 3 YDS', 'Yeso ortopédico', 'Venda de gasa impregnada', 'Venda de yeso para inmovilización y férulas.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-025', 'VENDA DE YESO 8"', 'VENDA DE YESO 8" X 3 YDS', 'Yeso ortopédico', 'Venda de gasa impregnada', 'Venda de yeso para inmovilización y férulas.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @gen, 'CUR-026', 'VENDA DE YESO 3"', 'VENDA DE YESO 3" X 3 YDS', 'Yeso ortopédico', 'Venda de gasa impregnada', 'Venda de yeso para inmovilización y férulas.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-027', 'CINTA QUIRÚRGICA 3M 1"', 'CINTA QUIRURGICA 3M 1" X 10 YDS', 'Adhesivo acrílico', 'Papel no tejido', 'Cinta quirúrgica para fijación de apósitos y dispositivos médicos.', 'ROLLO', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-028', 'CINTA QUIRÚRGICA 3M 2"', 'CINTA QUIRURGICA 3M 2" X 10 YDS', 'Adhesivo acrílico', 'Papel no tejido', 'Cinta quirúrgica para fijación de apósitos y dispositivos médicos.', 'ROLLO', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@mat, @m3m, 'CUR-029', 'APÓSITO DE GASA 3M 10X10', 'APOSITO DE GASA 3M 10X10 CM ESTERIL', 'Gasa 100% algodón', 'Paquete individual estéril', 'Apósito de gasa estéril para curación de heridas.', 'PAQUETE X 5 UND', '3M', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-001', 'PROBETA DE VIDRIO 100 ML', 'PROBETA DE VIDRIO 100 ML', '', 'Vidrio borosilicato', 'Probeta graduada de vidrio para medición de líquidos en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-002', 'PROBETA DE VIDRIO 250 ML', 'PROBETA DE VIDRIO 250 ML', '', 'Vidrio borosilicato', 'Probeta graduada de vidrio para medición de líquidos en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-003', 'PROBETA DE VIDRIO 500 ML', 'PROBETA DE VIDRIO 500 ML', '', 'Vidrio borosilicato', 'Probeta graduada de vidrio para medición de líquidos en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-004', 'PROBETA DE VIDRIO 1000 ML', 'PROBETA DE VIDRIO 1000 ML', '', 'Vidrio borosilicato', 'Probeta graduada de vidrio para medición de líquidos en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-005', 'VASO PRECIPITADO 100 ML', 'VASO PRECIPITADO 100 ML', '', 'Vidrio borosilicato', 'Vaso de precipitado de vidrio para uso en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-006', 'VASO PRECIPITADO 250 ML', 'VASO PRECIPITADO 250 ML', '', 'Vidrio borosilicato', 'Vaso de precipitado de vidrio para uso en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-007', 'VASO PRECIPITADO 500 ML', 'VASO PRECIPITADO 500 ML', '', 'Vidrio borosilicato', 'Vaso de precipitado de vidrio para uso en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-008', 'VASO PRECIPITADO 1000 ML', 'VASO PRECIPITADO 1000 ML', '', 'Vidrio borosilicato', 'Vaso de precipitado de vidrio para uso en laboratorio.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-009', 'FRASCO DE VIDRIO ÁMBAR 100 ML', 'FRASCO DE VIDRIO AMBAR 100 ML', '', 'Vidrio borosilicato ámbar', 'Frasco de vidrio ámbar para protección de fármacos fotosensibles.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-010', 'FRASCO DE VIDRIO ÁMBAR 250 ML', 'FRASCO DE VIDRIO AMBAR 250 ML', '', 'Vidrio borosilicato ámbar', 'Frasco de vidrio ámbar para protección de fármacos fotosensibles.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-011', 'FRASCO DE VIDRIO ÁMBAR 500 ML', 'FRASCO DE VIDRIO AMBAR 500 ML', '', 'Vidrio borosilicato ámbar', 'Frasco de vidrio ámbar para protección de fármacos fotosensibles.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@vid, @gen, 'VID-012', 'FRASCO DE VIDRIO ÁMBAR 1000 ML', 'FRASCO DE VIDRIO AMBAR 1000 ML', '', 'Vidrio borosilicato ámbar', 'Frasco de vidrio ámbar para protección de fármacos fotosensibles.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@meda, @medi, 'MEDA-001', 'LIDOCAÍNA 2%', 'LIDOCAINA 2% X 20 ML', 'Lidocaína clorhidrato 2%', 'Ampolla de vidrio', 'Anestésico local para infiltración y bloqueo nervioso.', 'AMP X 20 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@meda, @medi, 'MEDA-002', 'LIDOCAÍNA 1%', 'LIDOCAINA 1% X 20 ML', 'Lidocaína clorhidrato 1%', 'Ampolla de vidrio', 'Anestésico local para infiltración y bloqueo nervioso.', 'AMP X 20 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@meda, @medi, 'MEDA-003', 'BUPIVACAÍNA 0.5%', 'BUPIVACAINA 0.5% X 20 ML', 'Bupivacaína clorhidrato 0.5%', 'Ampolla de vidrio', 'Anestésico local de larga duración para bloqueo epidural y regional.', 'AMP X 20 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@meda, @medi, 'MEDA-004', 'LIDOCAÍNA 2% CON EPINEFRINA', 'LIDOCAINA 2% C/EPINEFRINA X 20 ML', 'Lidocaína clorhidrato 2%, Epinefrina 1:200,000', 'Ampolla de vidrio', 'Anestésico local con vasoconstrictor para procedimientos quirúrgicos.', 'AMP X 20 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@medb, @medi, 'MEDB-001', 'CEFTRIAXONA 1G', 'CEFTRIAXONA 1G POLVO', 'Ceftriaxona sódica 1g', 'Vial de vidrio', 'Antibiótico cefalosporina de tercera generación. Vía IM/IV.', 'VIAL X 1G', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@medb, @medi, 'MEDB-002', 'CEFTRIAXONA 500 MG', 'CEFTRIAXONA 500 MG POLVO', 'Ceftriaxona sódica 500 mg', 'Vial de vidrio', 'Antibiótico cefalosporina de tercera generación. Vía IM/IV.', 'VIAL X 500 MG', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@medb, @medi, 'MEDB-003', 'GENTAMICINA 80 MG', 'GENTAMICINA 80 MG X 2 ML', 'Gentamicina sulfato 80 mg', 'Ampolla de vidrio', 'Antibiótico aminoglucósido para infecciones bacterianas graves. Vía IM/IV.', 'AMP X 2 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@medb, @medi, 'MEDB-004', 'METRONIDAZOL 500 MG', 'METRONIDAZOL 500 MG X 100 ML', 'Metronidazol 500 mg', 'Frasco de vidrio', 'Antibiótico para infecciones anaeróbicas. Vía IV.', 'FRASCO X 100 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@medb, @medi, 'MEDB-005', 'CLINDAMICINA 600 MG', 'CLINDAMICINA 600 MG X 4 ML', 'Clindamicina fosfato 600 mg', 'Ampolla de vidrio', 'Antibiótico para infecciones por anaerobios y estafilococos. Vía IM/IV.', 'AMP X 4 ML', 'MEDIFARMA', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@nut, @fres, 'NUT-001', 'SOLUCIÓN DE AMINOÁCIDOS 10%', 'SOLUCION DE AMINOACIDOS 10% X 500 ML', 'Aminoácidos esenciales y no esenciales 10%', 'Frasco de vidrio', 'Solución de aminoácidos para nutrición parenteral.', 'FRASCO X 500 ML', 'FRESENIUS KABI PERU S.A', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@nut, @fres, 'NUT-002', 'SOLUCIÓN DE AMINOÁCIDOS 8%', 'SOLUCION DE AMINOACIDOS 8% X 500 ML', 'Aminoácidos esenciales y no esenciales 8%', 'Frasco de vidrio', 'Solución de aminoácidos para nutrición parenteral.', 'FRASCO X 500 ML', 'FRESENIUS KABI PERU S.A', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@nut, @fres, 'NUT-003', 'LÍPIDOS IV 20%', 'LIPIDOS IV 20% X 250 ML', 'Aceite de soja 20%, lecitina de huevo, glicerol', 'Frasco de vidrio', 'Emulsión lipídica para nutrición parenteral. Aporte calórico y de ácidos grasos esenciales.', 'FRASCO X 250 ML', 'FRESENIUS KABI PERU S.A', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@nut, @fres, 'NUT-004', 'GLUCOSA 50% 20 ML', 'GLUCOSA 50% X 20 ML', 'Glucosa 50%', 'Ampolla de vidrio', 'Solución hipertónica de glucosa para aporte calórico en nutrición parenteral.', 'AMP X 20 ML', 'FRESENIUS KABI PERU S.A', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@nut, @fres, 'NUT-005', 'GLUCOSA 50% 250 ML', 'GLUCOSA 50% X 250 ML', 'Glucosa 50%', 'Frasco de vidrio', 'Solución hipertónica de glucosa para aporte calórico en nutrición parenteral.', 'FRASCO X 250 ML', 'FRESENIUS KABI PERU S.A', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-001', 'BISTURÍ N°15', 'BISTURI N° 15', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas precisas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-002', 'BISTURÍ N°11', 'BISTURI N° 11', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-003', 'BISTURÍ N°10', 'BISTURI N° 10', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-004', 'BISTURÍ N°12', 'BISTURI N° 12', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-005', 'BISTURÍ N°20', 'BISTURI N° 20', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-006', 'BISTURÍ N°21', 'BISTURI N° 21', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-007', 'BISTURÍ N°22', 'BISTURI N° 22', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-008', 'BISTURÍ N°23', 'BISTURI N° 23', '', 'Acero inoxidable quirúrgico', 'Hoja de bisturí estéril para incisiones quirúrgicas.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-009', 'MANGO DE BISTURÍ N°3', 'MANGO DE BISTURI N° 3', '', 'Acero inoxidable', 'Mango de bisturí reutilizable para hojas N°10-15.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-010', 'MANGO DE BISTURÍ N°4', 'MANGO DE BISTURI N° 4', '', 'Acero inoxidable', 'Mango de bisturí reutilizable para hojas N°20-23.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-011', 'SUTURA SEDA 000', 'SUTURA SEDA 000 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-012', 'SUTURA SEDA 00', 'SUTURA SEDA 00 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-013', 'SUTURA SEDA 0', 'SUTURA SEDA 0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-014', 'SUTURA SEDA 1', 'SUTURA SEDA 1 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-015', 'SUTURA SEDA 2', 'SUTURA SEDA 2 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-016', 'SUTURA SEDA 2/0', 'SUTURA SEDA 2/0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-017', 'SUTURA SEDA 3/0', 'SUTURA SEDA 3/0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-018', 'SUTURA SEDA 4/0', 'SUTURA SEDA 4/0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-019', 'SUTURA NYLON 000', 'SUTURA NYLON 000 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-020', 'SUTURA NYLON 00', 'SUTURA NYLON 00 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-021', 'SUTURA NYLON 0', 'SUTURA NYLON 0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-022', 'SUTURA NYLON 1', 'SUTURA NYLON 1 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-023', 'SUTURA NYLON 2', 'SUTURA NYLON 2 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-024', 'SUTURA NYLON 2/0', 'SUTURA NYLON 2/0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-025', 'SUTURA NYLON 3/0', 'SUTURA NYLON 3/0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-026', 'SUTURA NYLON 4/0', 'SUTURA NYLON 4/0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-027', 'SUTURA CATGUT CRÓMICO 000', 'SUTURA CATGUT CROMICO 000 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-028', 'SUTURA CATGUT CRÓMICO 00', 'SUTURA CATGUT CROMICO 00 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-029', 'SUTURA CATGUT CRÓMICO 0', 'SUTURA CATGUT CROMICO 0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-030', 'SUTURA CATGUT CRÓMICO 1', 'SUTURA CATGUT CROMICO 1 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-031', 'SUTURA CATGUT CRÓMICO 2', 'SUTURA CATGUT CROMICO 2 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-032', 'SUTURA CATGUT CRÓMICO 2/0', 'SUTURA CATGUT CROMICO 2/0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-033', 'SUTURA CATGUT CRÓMICO 3/0', 'SUTURA CATGUT CROMICO 3/0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-034', 'SUTURA CATGUT CRÓMICO 4/0', 'SUTURA CATGUT CROMICO 4/0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-035', 'SUTURA VICRYL 000', 'SUTURA VICRYL 000 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-036', 'SUTURA VICRYL 00', 'SUTURA VICRYL 00 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-037', 'SUTURA VICRYL 0', 'SUTURA VICRYL 0 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-038', 'SUTURA VICRYL 1', 'SUTURA VICRYL 1 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-039', 'SUTURA VICRYL 2', 'SUTURA VICRYL 2 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-040', 'SUTURA VICRYL 2/0', 'SUTURA VICRYL 2/0 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-041', 'SUTURA VICRYL 3/0', 'SUTURA VICRYL 3/0 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-042', 'SUTURA VICRYL 4/0', 'SUTURA VICRYL 4/0 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-043', 'SUTURA SEDA 5/0', 'SUTURA SEDA 5/0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-044', 'SUTURA NYLON 5/0', 'SUTURA NYLON 5/0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-045', 'SUTURA CATGUT CRÓMICO 5/0', 'SUTURA CATGUT CROMICO 5/0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-046', 'SUTURA VICRYL 5/0', 'SUTURA VICRYL 5/0 X 75 CM', 'Poliglactina 910', 'Sobres estériles', 'Sutura absorbible sintética de ácido poliglicólico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-047', 'SUTURA SEDA 6/0', 'SUTURA SEDA 6/0 X 75 CM', 'Seda negra trenzada', 'Sobres estériles', 'Sutura de seda con aguja. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-048', 'SUTURA NYLON 6/0', 'SUTURA NYLON 6/0 X 75 CM', 'Nylon monofilamento', 'Sobres estériles', 'Sutura de nylon monofilamento. No absorbible.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@qui, @gen, 'QUI-049', 'SUTURA CATGUT CRÓMICO 6/0', 'SUTURA CATGUT CROMICO 6/0 X 75 CM', 'Catgut crómico', 'Sobres estériles', 'Sutura absorbible de catgut crómico.', 'CAJA X 12 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@reh, @gen, 'REH-001', 'SUERO DE REHIDRATACIÓN ORAL SABOR', 'SUERO DE REHIDRATACION ORAL SABOR', 'Glucosa anhidra 20g, Cloruro de Sodio 3.5g, Citrato de Sodio 2.9g, Cloruro de Potasio 1.5g', 'Sobre de papel aluminio', 'Polvo para reconstituir. Saborizado. Indicado para prevenir y tratar la deshidratación.', 'SOBRE', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@reh, @gen, 'REH-002', 'SUERO DE REHIDRATACIÓN ORAL', 'SUERO DE REHIDRATACION ORAL', 'Glucosa anhidra 20g, Cloruro de Sodio 3.5g, Citrato de Sodio 2.9g, Cloruro de Potasio 1.5g', 'Sobre de papel aluminio', 'Polvo para reconstituir. Indicado para prevenir y tratar la deshidratación causada por diarrea aguda.', 'SOBRE X 27.9 G', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-001', 'MASCARILLA DE OXÍGENO ADULTO', 'MASCARILLA DE OXIGENO ADULTO', '', 'PVC libre de látex', 'Mascarilla de oxígeno con tubo de conexión. Cómoda y ajustable.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-002', 'MASCARILLA DE OXÍGENO PEDIÁTRICA', 'MASCARILLA DE OXIGENO PEDIATRICA', '', 'PVC libre de látex', 'Mascarilla de oxígeno pediátrica con tubo de conexión.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-003', 'CÁNULA BINASAL ADULTO', 'CANULA BINASAL ADULTO', '', 'PVC libre de látex', 'Cánula binasal para administración de oxígeno. Cómoda y desechable.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-004', 'CÁNULA BINASAL PEDIÁTRICA', 'CANULA BINASAL PEDIATRICA', '', 'PVC libre de látex', 'Cánula binasal pediátrica para administración de oxígeno.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-005', 'NEBULIZADOR ADULTO', 'NEBULIZADOR ADULTO', '', 'PVC, polipropileno', 'Nebulizador tipo jet para administración de medicamentos inhalados.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-006', 'NEBULIZADOR PEDIÁTRICO', 'NEBULIZADOR PEDIATRICO', '', 'PVC, polipropileno', 'Nebulizador tipo jet pediátrico para administración de medicamentos inhalados.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-007', 'RESUCITADOR MANUAL ADULTO', 'RESUCITADOR MANUAL ADULTO', '', 'PVC, silicona', 'Resucitador manual tipo ambú para reanimación. Incluye mascarilla.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-008', 'RESUCITADOR MANUAL PEDIÁTRICO', 'RESUCITADOR MANUAL PEDIATRICO', '', 'PVC, silicona', 'Resucitador manual tipo ambú pediátrico para reanimación.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-009', 'TUBO DE MAYO ADULTO', 'TUBO DE MAYO ADULTO', '', 'PVC, polipropileno', 'Cánula orofaríngea para mantenimiento de vía aérea.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@res, @gen, 'RES-010', 'TUBO DE MAYO PEDIÁTRICO', 'TUBO DE MAYO PEDIATRICO', '', 'PVC, polipropileno', 'Cánula orofaríngea pediátrica para mantenimiento de vía aérea.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-001', 'MANDILÓN QUIRÚRGICO DESCARTABLE TALLA M', 'MANDILON QUIRURGICO DESCARTABLE TALLA M', '', 'Tela no tejida (TNT) 45g/m2', 'Mandilón quirúrgico descartable para protección del personal de salud.', 'CAJA X 50 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-002', 'MANDILÓN QUIRÚRGICO DESCARTABLE TALLA L', 'MANDILON QUIRURGICO DESCARTABLE TALLA L', '', 'Tela no tejida (TNT) 45g/m2', 'Mandilón quirúrgico descartable para protección del personal de salud.', 'CAJA X 50 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-003', 'MANDILÓN QUIRÚRGICO DESCARTABLE TALLA XG', 'MANDILON QUIRURGICO DESCARTABLE TALLA XG', '', 'Tela no tejida (TNT) 45g/m2', 'Mandilón quirúrgico descartable para protección del personal de salud.', 'CAJA X 50 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-004', 'GORRO QUIRÚRGICO DESCARTABLE', 'GORRO QUIRURGICO DESCARTABLE', '', 'Tela no tejida (TNT)', 'Gorro quirúrgico desechable para protección del cabello en áreas estériles.', 'CAJA X 100 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-005', 'CUBREBOCAS QUIRÚRGICO 3 CAPAS', 'CUBREBOCAS QUIRURGICO 3 CAPAS', 'Tela no tejida 3 capas', 'TNT, filtro meltblown', 'Cubrebocas quirúrgico desechable de 3 capas con barrera de fluidos.', 'CAJA X 50 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-006', 'BATA QUIRÚRGICA ESTÉRIL TALLA M', 'BATA QUIRURGICA ESTERIL TALLA M', '', 'Tela no tejida SMS 45g/m2', 'Bata quirúrgica estéril con refuerzo en mangas y pecho.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-007', 'BATA QUIRÚRGICA ESTÉRIL TALLA L', 'BATA QUIRURGICA ESTERIL TALLA L', '', 'Tela no tejida SMS 45g/m2', 'Bata quirúrgica estéril con refuerzo en mangas y pecho.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-008', 'BATA QUIRÚRGICA ESTÉRIL TALLA XG', 'BATA QUIRURGICA ESTERIL TALLA XG', '', 'Tela no tejida SMS 45g/m2', 'Bata quirúrgica estéril con refuerzo en mangas y pecho.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-009', 'CAMPO QUIRÚRGICO 50X50 CM', 'CAMPO QUIRURGICO 50X50 CM', '', 'TNT con barrera de polietileno', 'Campo quirúrgico desechable con adhesivo hipoalergénico.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@rop, @gen, 'ROP-010', 'CAMPO QUIRÚRGICO 75X50 CM', 'CAMPO QUIRURGICO 75X50 CM', '', 'TNT con barrera de polietileno', 'Campo quirúrgico desechable con adhesivo hipoalergénico.', 'PAQUETE X 10 UND', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-001', 'CLORURO DE SODIO 0.9% 100 ML', 'CLORURO DE SODIO 0.9% X 100 ML', 'Cloruro de sodio 0.9% en agua', 'Frasco de vidrio o polipropileno', 'Solución salina isotónica para hidratación y reposición de electrolitos.', 'X 100 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-002', 'CLORURO DE SODIO 0.9% 250 ML', 'CLORURO DE SODIO 0.9% X 250 ML', 'Cloruro de sodio 0.9% en agua', 'Frasco de vidrio o polipropileno', 'Solución salina isotónica para hidratación y reposición de electrolitos.', 'X 250 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-003', 'CLORURO DE SODIO 0.9% 500 ML', 'CLORURO DE SODIO 0.9% X 500 ML', 'Cloruro de sodio 0.9% en agua', 'Frasco de vidrio o polipropileno', 'Solución salina isotónica para hidratación y reposición de electrolitos.', 'X 500 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-004', 'CLORURO DE SODIO 0.9% 1000 ML', 'CLORURO DE SODIO 0.9% X 1000 ML', 'Cloruro de sodio 0.9% en agua', 'Frasco de vidrio o polipropileno', 'Solución salina isotónica para hidratación y reposición de electrolitos.', 'X 1000 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-005', 'DEXTROSA 5% 500 ML', 'DEXTROSA 5% X 500 ML', 'Dextrosa 5% en agua', 'Frasco de vidrio o polipropileno', 'Solución glucosada para aporte calórico e hidratación.', 'X 500 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-006', 'DEXTROSA 5% 1000 ML', 'DEXTROSA 5% X 1000 ML', 'Dextrosa 5% en agua', 'Frasco de vidrio o polipropileno', 'Solución glucosada para aporte calórico e hidratación.', 'X 1000 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-007', 'DEXTROSA 5% 250 ML', 'DEXTROSA 5% X 250 ML', 'Dextrosa 5% en agua', 'Frasco de vidrio o polipropileno', 'Solución glucosada para aporte calórico e hidratación.', 'X 250 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-008', 'RINGER LACTATO 500 ML', 'RINGER LACTATO X 500 ML', 'Cloruro de sodio 0.6%, Cloruro de potasio 0.03%, Cloruro de calcio 0.02%, Lactato de sodio 0.3%', 'Frasco de vidrio o polipropileno', 'Solución balanceada de electrolitos para reposición de líquidos.', 'X 500 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-009', 'RINGER LACTATO 1000 ML', 'RINGER LACTATO X 1000 ML', 'Cloruro de sodio 0.6%, Cloruro de potasio 0.03%, Cloruro de calcio 0.02%, Lactato de sodio 0.3%', 'Frasco de vidrio o polipropileno', 'Solución balanceada de electrolitos para reposición de líquidos.', 'X 1000 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@sol, @bb, 'SOL-010', 'RINGER LACTATO 250 ML', 'RINGER LACTATO X 250 ML', 'Cloruro de sodio 0.6%, Cloruro de potasio 0.03%, Cloruro de calcio 0.02%, Lactato de sodio 0.3%', 'Frasco de vidrio o polipropileno', 'Solución balanceada de electrolitos para reposición de líquidos.', 'X 250 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-001', 'AGUA ESTÉRIL 10 ML', 'AGUA ESTERIL X 10 ML', 'Agua purificada estéril', 'Ampolla de vidrio', 'Agua estéril para inyección, utilizada como solvente para reconstituir medicamentos.', 'AMP X 10 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-002', 'AGUA ESTÉRIL 20 ML', 'AGUA ESTERIL X 20 ML', 'Agua purificada estéril', 'Ampolla de vidrio', 'Agua estéril para inyección, utilizada como solvente para reconstituir medicamentos.', 'AMP X 20 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-003', 'AGUA ESTÉRIL 500 ML', 'AGUA ESTERIL X 500 ML', 'Agua purificada estéril', 'Frasco de vidrio o polipropileno', 'Agua estéril para irrigación y uso parenteral.', 'X 500 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-004', 'AGUA ESTÉRIL 1000 ML', 'AGUA ESTERIL X 1000 ML', 'Agua purificada estéril', 'Frasco de vidrio o polipropileno', 'Agua estéril para irrigación y uso parenteral.', 'X 1000 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-005', 'AGUA ESTÉRIL 250 ML', 'AGUA ESTERIL X 250 ML', 'Agua purificada estéril', 'Frasco de vidrio o polipropileno', 'Agua estéril para irrigación y uso parenteral.', 'X 250 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@solv, @bb, 'SLV-006', 'AGUA ESTÉRIL 100 ML', 'AGUA ESTERIL X 100 ML', 'Agua purificada estéril', 'Frasco de vidrio o polipropileno', 'Agua estéril para irrigación y uso parenteral.', 'X 100 ML', 'B BRAUN', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-001', 'SONDA NASOGASTRICA N° 14', 'SONDA NASOGASTRICA N° 14', '', 'PVC libre de látex, silicona', 'Sonda de alimentación y aspiración. Punta cerrada con orificios laterales.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-002', 'SONDA NASOGASTRICA N° 16', 'SONDA NASOGASTRICA N° 16', '', 'PVC libre de látex, silicona', 'Sonda de alimentación y aspiración. Punta cerrada con orificios laterales.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-003', 'SONDA NASOGASTRICA N° 18', 'SONDA NASOGASTRICA N° 18', '', 'PVC libre de látex, silicona', 'Sonda de alimentación y aspiración. Punta cerrada con orificios laterales.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-004', 'SONDA FOLEY N° 16', 'SONDA FOLEY N° 16 2 VIAS', '', 'Silicona 100%, látex', 'Sonda vesical de 2 vías con balón de retención.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-005', 'SONDA FOLEY N° 18', 'SONDA FOLEY N° 18 2 VIAS', '', 'Silicona 100%, látex', 'Sonda vesical de 2 vías con balón de retención.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-006', 'SONDA FOLEY N° 20', 'SONDA FOLEY N° 20 2 VIAS', '', 'Silicona 100%, látex', 'Sonda vesical de 2 vías con balón de retención.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-007', 'SONDA FOLEY N° 22', 'SONDA FOLEY N° 22 2 VIAS', '', 'Silicona 100%, látex', 'Sonda vesical de 2 vías con balón de retención.', 'UNIDAD', '', 1);

INSERT INTO productos (familia_id, marca_id, codigo, nombre_comercial, nombre_producto, composicion, materiales, descripcion, presentacion, laboratorio, estado) VALUES

(@son, @gen, 'SON-008', 'SONDA FOLEY N° 24', 'SONDA FOLEY N° 24 2 VIAS', '', 'Silicona 100%, látex', 'Sonda vesical de 2 vías con balón de retención.', 'UNIDAD', '', 1);

