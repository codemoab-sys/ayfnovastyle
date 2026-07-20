CREATE DATABASE IF NOT EXISTS micatalogo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE micatalogo;

CREATE TABLE IF NOT EXISTS familias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL,
    descripcion TEXT,
    imagen VARCHAR(500),
    icono VARCHAR(500),
    color VARCHAR(50) DEFAULT '#009933',
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    UNIQUE KEY unique_slug (slug)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS marcas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    logo VARCHAR(500),
    descripcion TEXT,
    sitio_web VARCHAR(500),
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    familia_id INT NOT NULL,
    marca_id INT NOT NULL,
    codigo VARCHAR(100),
    sku VARCHAR(100),
    nombre_comercial VARCHAR(500) NOT NULL,
    nombre_producto VARCHAR(500) NOT NULL,
    descripcion TEXT,
    composicion TEXT,
    materiales TEXT,
    presentacion VARCHAR(500),
    beneficios TEXT,
    modo_uso TEXT,
    indicaciones TEXT,
    contraindicaciones TEXT,
    registro_sanitario VARCHAR(255),
    laboratorio VARCHAR(255),
    pais_origen VARCHAR(255),
    imagen_principal VARCHAR(500),
    ficha_tecnica VARCHAR(500),
    video VARCHAR(500),
    peso DECIMAL(10,2),
    alto DECIMAL(10,2),
    ancho DECIMAL(10,2),
    largo DECIMAL(10,2),
    destacado TINYINT(1) DEFAULT 0,
    nuevo TINYINT(1) DEFAULT 0,
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (familia_id) REFERENCES familias(id) ON DELETE CASCADE,
    FOREIGN KEY (marca_id) REFERENCES marcas(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS producto_imagenes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT NOT NULL,
    imagen VARCHAR(500) NOT NULL,
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS banners (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255),
    subtitulo VARCHAR(500),
    imagen VARCHAR(500),
    link VARCHAR(500),
    orden INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('admin','editor') DEFAULT 'editor',
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

INSERT IGNORE INTO usuarios (nombre, email, password, rol) VALUES
('Administrador', 'admin@drofar.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

INSERT IGNORE INTO banners (titulo, subtitulo, orden, estado) VALUES
('Al servicio de la salud', 'Distribuidora especializada en insumos y material médico', 1, 1);
