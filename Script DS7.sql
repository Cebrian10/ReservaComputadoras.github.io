-- Script DS7

-- Crear la base de datos
CREATE DATABASE bdds7;

-- Usar la base de datos
USE bdds7;

-- Crear la tabla 'salones'
CREATE TABLE salones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- Insertar datos en la tabla 'salones'
INSERT INTO salones (name) VALUES
    ('Salón 4-401'),
    ('Salón 4-402');

-- Crear la tabla 'ususarios'
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255),
    pass VARCHAR(255),
    rol VARCHAR(255)
);

-- Insertar datos en la tabla 'usuarios'
INSERT INTO usuarios (name, email, pass, rol) VALUES
('admin','admin@gmail.com','$2y$10$MRX.QaY3I7D5cfDZEcDiEOu4dmFXQIYg0QDHsDfVzRvipxUKjqYcq','adm');

-- Crear la tabla 'computadoras'
CREATE TABLE computadoras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    img VARCHAR(255),
    name VARCHAR(255),
    status VARCHAR(255),
    id_salon INT,
    FOREIGN KEY (id_salon) REFERENCES salones(id)
);

-- Insertar registros en la tabla 'computadoras'
INSERT INTO computadoras (img, name, status, id_salon) VALUES 
('1_pc.png', 'Equipo 401-1', 'Disponible', 1),
('2_pc.png', 'Equipo 401-2', 'Disponible', 1),
('3_pc.png', 'Equipo 401-3', 'Disponible', 1),
('4_pc.png', 'Equipo 401-4', 'Disponible', 1),
('5_pc.png', 'Equipo 401-5', 'Disponible', 1),
('6_pc.png', 'Equipo 401-6', 'Disponible', 1),
('7_pc.png', 'Equipo 401-7', 'Disponible', 1),
('8_pc.png', 'Equipo 401-8', 'Disponible', 1),
('9_pc.png', 'Equipo 401-9', 'Disponible', 1),
('10_pc.png', 'Equipo 401-10', 'Disponible', 1),
('11_pc.png', 'Equipo 401-11', 'Disponible', 1),
('12_pc.png', 'Equipo 401-12', 'Disponible', 1),
('13_pc.png', 'Equipo 401-13', 'Disponible', 1),
('14_pc.png', 'Equipo 401-14', 'Disponible', 1),
('15_pc.png', 'Equipo 401-15', 'Disponible', 1),
('16_pc.png', 'Equipo 402-1', 'Disponible', 2),
('17_pc.png', 'Equipo 402-2', 'Disponible', 2),
('18_pc.png', 'Equipo 402-3', 'Disponible', 2),
('19_pc.png', 'Equipo 402-4', 'Disponible', 2),
('20_pc.png', 'Equipo 402-5', 'Disponible', 2),
('21_pc.png', 'Equipo 402-6', 'Disponible', 2),
('22_pc.png', 'Equipo 402-7', 'Disponible', 2),
('23_pc.png', 'Equipo 402-8', 'Disponible', 2),
('24_pc.png', 'Equipo 402-9', 'Disponible', 2),
('25_pc.png', 'Equipo 402-10', 'Disponible', 2),
('26_pc.png', 'Equipo 402-11', 'Disponible', 2),
('27_pc.png', 'Equipo 402-12', 'Disponible', 2),
('28_pc.png', 'Equipo 402-13', 'Disponible', 2),
('29_pc.png', 'Equipo 402-14', 'Disponible', 2),
('30_pc.png', 'Equipo 402-15', 'Disponible', 2);

-- Crear la tabla 'reservas'
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day DATE,
    start_time TIME,
    end_time TIME,
    id_usuarios INT,
    FOREIGN KEY (id_usuarios) REFERENCES usuarios(id),
    id_equipos INT,
    FOREIGN KEY (id_equipos) REFERENCES computadoras(id)
);