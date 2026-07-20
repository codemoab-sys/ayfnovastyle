# -*- coding: utf-8 -*-
import os

def main():
    sql = """SET FOREIGN_KEY_CHECKS = 0;
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
('Antis\u00e9pticos, Desinfectantes y Accesorios', 'antisepticos-desinfectantes-y-accesorios', '#009933', 1, 1),
('Bioseguridad - EPP', 'bioseguridad-epp', '#009933', 2, 1),
('Drenaje y Ostom\u00edas (Bolsas y Accesorios)', 'drenaje-y-ostomias', '#009933', 3, 1),
('Enteral e Irrigaci\u00f3n', 'enteral-e-irrigacion', '#009933', 4, 1),
('Equipos Biom\u00e9dicos', 'equipos-biomedicos', '#009933', 5, 1),
('Infusi\u00f3n y Acceso Venoso', 'infusion-y-acceso-venoso', '#009933', 6, 1),
('Inyecci\u00f3n y Punción (Agujas y Accesorios)', 'inyeccion-y-puncion', '#009933', 7, 1),
('Limpieza e Higiene', 'limpieza-e-higiene', '#009933', 8, 1),
('Material de Curaci\u00f3n', 'material-de-curacion', '#009933', 9, 1),
('Material de vidrio', 'material-de-vidrio', '#009933', 10, 1),
('Medicamentos - Anest\u00e9sicos y bloqueo', 'medicamentos-anestesicos-y-bloqueo', '#009933', 11, 1),
('Medicamentos - Antibióticos', 'medicamentos-antibioticos', '#009933', 12, 1),
('Nutrici\u00f3n Parenteral', 'nutricion-parenteral', '#009933', 13, 1),
('Quir\u00fargicos', 'quirurgicos', '#009933', 14, 1),
('Rehidrataci\u00f3n Oral', 'rehidratacion-oral', '#009933', 15, 1),
('Respiratorio', 'respiratorio', '#009933', 16, 1),
('Ropa Médica y Barreras Quir\u00fargicas', 'ropa-medica-y-barreras-quirurgicas', '#009933', 17, 1),
('Soluciones y Sueros', 'soluciones-y-sueros', '#009933', 18, 1),
('Solventes / Diluyentes (parenteral)', 'solventes-diluyentes-parenteral', '#009933', 19, 1),
('Sondas', 'sondas', '#009933', 20, 1);

INSERT INTO marcas (nombre, estado) VALUES
('3M',1),('ALFYMEDIX',1),('ALKOFARMA',1),('ALKHOFAR',1),('B BRAUN',1),
('Bio-Protech Inc.',1),('Biosafe',1),('Coloplast',1),('COPPON',1),
('Favetex',1),('FRESENIUS KABI PERU S.A',1),('Gasatex',1),('Gen\u00e9rico',1),
('HULK',1),('MEDEX',1),('Medifarma',1),('NIPRO',1),('ONE JECT',1),
('PharmaGen',1),('QUIROFANO',1),('QuiMedic Plus',1),('R&G',1),
('RIESTER',1),('Roker Per\u00fa S.A.',1),('SALVISAFE',1),('Sanderson S.A.',1),
('SIGMA',1),('SONY',1),('SUPERIOR',1),('T-C',1),('Tagum',1),
('Venofix',1),('WESTERN',1);
"""

    with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'w', encoding='utf-8') as f:
        f.write(sql)
    print('Written families and brands OK')

    # Verify
    with open('C:/laragon/www/catalogopdaweb/sql/complete.sql', 'r', encoding='utf-8') as f:
        content = f.read()
    if 'Antisépticos' in content and 'Ostomías' in content and 'Irrigación' in content:
        print('Accents verified OK')
    else:
        print('WARNING: accents missing!')

if __name__ == '__main__':
    main()
