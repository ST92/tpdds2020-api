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

INSERT INTO deporte (id, nombre) VALUES (1, 'Fútbol');
INSERT INTO deporte (id, nombre) VALUES (2, 'Basquet');
INSERT INTO deporte (id, nombre) VALUES (3, 'Tenis');
INSERT INTO deporte (id, nombre) VALUES (4, 'Rugby');

INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado) 
	VALUES (1, 1, 'Rafael Osinalde', 'Cancha de Fútbol', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado)
	VALUES (2, 2, 'Gregorio Panizza', 'Cancha de Basquet', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado)
	VALUES (3, 3, 'Club Talense', 'Cancha de Tenis', 1,null);
INSERT INTO sedes (id, codigo, nombre, descripcion, usuario_id, fecha_borrado) 
	VALUES (4, 4, '2 de Enero', 'Cancha de Fútbol', 1,null);

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


INSERT INTO estadocompetencia (id,nombre) VALUES(1,'CREADA');
INSERT INTO estadocompetencia (id,nombre) VALUES(2,'PLANIFICADA');
INSERT INTO estadocompetencia (id, nombre) VALUES (3, 'EN_DISPUTA');
INSERT INTO estadocompetencia (id, nombre) VALUES (4, 'FINALIZADA');
INSERT INTO estadocompetencia (id, nombre) VALUES (5, 'ELIMINADA');


INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (1, 0, 2, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (2, 3, 0, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (3, 0, 0, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (4, 1, 1, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (5, 0, 1, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (6, 1, 3, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (7, 2, 1, 0);
INSERT INTO resultado(id, puntos_participante_1, puntos_participante_2, encuentro_id) VALUES (8, 3, 0, 0);
