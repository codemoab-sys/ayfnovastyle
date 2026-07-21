CREATE DATABASE IF NOT EXISTS catalogobd CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE catalogobd;

CREATE TABLE IF NOT EXISTS ayf_categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(500),
    icono VARCHAR(500),
    color VARCHAR(50) DEFAULT '#e63946',
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_slug (slug)
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ayf_marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    logo VARCHAR(500),
    descripcion TEXT,
    sitio_web VARCHAR(500),
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS ayf_productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria_id INT NOT NULL,
    marca_id INT NOT NULL,
    codigo VARCHAR(100),
    nombre VARCHAR(500) NOT NULL,
    descripcion TEXT,
    material VARCHAR(255),
    genero VARCHAR(50) DEFAULT 'unisex',
    tallas VARCHAR(500),
    colores VARCHAR(500),
    precio DECIMAL(10,2),
    precio_anterior DECIMAL(10,2),
    imagen_principal VARCHAR(500),
    video VARCHAR(500),
    destacado TINYINT(1) DEFAULT 0,
    nuevo TINYINT(1) DEFAULT 0,
    orden INT DEFAULT 0,
    stock INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (categoria_id) REFERENCES ayf_categorias(id) ON DELETE CASCADE,
    FOREIGN KEY (marca_id) REFERENCES ayf_marcas(id) ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ayf_producto_imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    imagen VARCHAR(500) NOT NULL,
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES ayf_productos(id) ON DELETE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ayf_banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    subtitulo VARCHAR(500),
    imagen VARCHAR(500),
    link VARCHAR(500),
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ayf_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','editor') DEFAULT 'editor',
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS ayf_configuracion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clave VARCHAR(100) NOT NULL UNIQUE,
    valor TEXT,
    tipo VARCHAR(50) DEFAULT 'texto',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT IGNORE INTO ayf_configuracion (clave, valor, tipo) VALUES
('site_name', 'AYF Novastyle', 'texto'),
('site_desc', 'Novedades en zapatillas y calzado', 'texto'),
('logo', '', 'imagen'),
('whatsapp', '51995218178', 'texto'),
('whatsapp_msg', 'Hola, quiero más información', 'texto'),
('email', 'ventas@ayfnovastyle.com', 'texto'),
('phone', '953571861', 'texto'),
('address', 'Trujillo, Perú', 'texto'),
('facebook', 'https://facebook.com/', 'texto'),
('instagram', 'https://instagram.com/', 'texto'),
('linkedin', 'https://linkedin.com/', 'texto'),
('tiktok', '', 'texto'),
('youtube', '', 'texto');

INSERT IGNORE INTO ayf_usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@ayfnovastyle.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT IGNORE INTO ayf_banners (titulo, subtitulo, orden, estado) VALUES
('Nuevos Lanzamientos', 'Las mejores zapatillas de la temporada', 1, 1);
