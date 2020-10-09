INSERT INTO pais (id, nombre) VALUES (1, 'Argentina');

INSERT INTO provincia (id, nombre, pais_id) VALUES (3, 'Entre Ríos', 1);

INSERT INTO localidad (id, nombre, provincia_id) VALUES (130, 'Rosario del Tala', 3);

INSERT INTO tipodocumento (id, nombre) VALUES (1, 'DNI');

INSERT INTO usuario (id, nombre, apellido, email, password, documento, confirmacion_terminos, localidad_id, tipo_documento_id)
	VALUES (1, 'Armando Esteban', 'Quito', 'aquito@gmail.com', 'constraseña',38983478, TRUE, 130, 1);

INSERT INTO tipocompetencia (id, nombre) VALUES (1, 'LIGA');
INSERT INTO tipocompetencia (id, nombre) VALUES (2, 'ELIMINACION_SIMPLE');
INSERT INTO tipocompetencia (id, nombre) VALUES (3, 'ELIMINACION_DOBLE');

INSERT INTO tipopuntuacion (id, nombre) VALUES (1, 'SETS');
INSERT INTO tipopuntuacion (id, nombre) VALUES (2, 'PUNTUACION');
INSERT INTO tipopuntuacion (id, nombre) VALUES (3, 'RESULTADO_FINAL');

INSERT INTO deporte (id, nombre) VALUES (1, 'football');
INSERT INTO deporte (id, nombre) VALUES (2, 'basquet');
INSERT INTO deporte (id, nombre) VALUES (3, 'tenis');

INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado) 
	VALUES (1, 1, 'Rafael Osinalde', 'Cancha de futball', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado)
	VALUES (2, 2, 'Gregorio Panizza', 'Cancha de basquet', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado)
	VALUES (3, 3, 'Club Talense', 'Cancha de tenis', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado) 
	VALUES (4, 4, '2 de Enero', 'Cancha de futball', 1,null);

INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (1, 1);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (1, 2);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (1, 3);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (2, 1);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (2, 2);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (2, 3);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (3, 1);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (3, 2);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (3, 3);
INSERT INTO sedesdeporte(sedes_id, deporte_id) VALUES (4, 1);



INSERT INTO estadocompetencia (id,nombre)
	VALUES(1,'CREADA')
	
