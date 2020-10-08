ALTER TABLE `competencia` ADD CONSTRAINT `estado_competencia_fk_1` FOREIGN KEY (`estado_competencia_id`) REFERENCES `estadocompetencia` (`id`);
ALTER TABLE `competencia` ADD CONSTRAINT `tipo_competencia_fk_1` FOREIGN KEY (`tipo_competencia_id`) REFERENCES `tipocompetencia` (`id`);
ALTER TABLE `competencia` ADD CONSTRAINT `deporte_fk_1` FOREIGN KEY (`deporte_id`) REFERENCES `deporte` (`id`);
ALTER TABLE `competencia` ADD CONSTRAINT `tipo_puntuacion_fk_1` FOREIGN KEY (`tipo_puntuacion_id`) REFERENCES `tipopuntuacion` (`id`);
ALTER TABLE `competencia` ADD CONSTRAINT `fixture_fk_1` FOREIGN KEY (`fixture_id`) REFERENCES `fixture` (`id`);
ALTER TABLE `competencia` ADD CONSTRAINT `usuario_fk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);


ALTER TABLE `encuentro` ADD CONSTRAINT `participante_fk_1` FOREIGN KEY (`participante1_id`) REFERENCES `participante` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `participante_fk_2` FOREIGN KEY (`participante2_id`) REFERENCES `participante` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `participante_fk_3` FOREIGN KEY (`ganador_id`) REFERENCES `participante` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `sedes_fk_1` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `ronda_fk_1` FOREIGN KEY (`ronda_id`) REFERENCES `ronda` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `encuentro_fk_1` FOREIGN KEY (`encuentro_perdedor_id`) REFERENCES `encuentro` (`id`);
ALTER TABLE `encuentro` ADD CONSTRAINT `encuentro_fk_2` FOREIGN KEY (`encuentro_ganador_id`) REFERENCES `encuentro` (`id`);

--HISTORIAL DE RESULTADOS IRÍA AQUÍ

ALTER TABLE `localidad` ADD CONSTRAINT `provincia_fk_1` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`id`);

ALTER TABLE `participante` ADD CONSTRAINT `competencia_fk_1` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`);

ALTER TABLE `provincia` ADD CONSTRAINT `pais_fk_1` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`id`);

--RONDA IRÍA AQUÍ

ALTER TABLE `ronda` ADD CONSTRAINT `fixture_fk_1` FOREIGN KEY (`fixture_id`) REFERENCES `fixture` (`id`);
ALTER TABLE `ronda` ADD CONSTRAINT `fixture_fk_2` FOREIGN KEY (`fixture_perdedores_id`) REFERENCES `fixture` (`id`);

ALTER TABLE `sedes` ADD CONSTRAINT `usuario_fk_2` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);

ALTER TABLE `sedescompetencia` ADD CONSTRAINT `competencia_fk_2` FOREIGN KEY (`competencia_id`) REFERENCES `competencia` (`id`);
ALTER TABLE `sedescompetencia` ADD CONSTRAINT `sedes_fk_2` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`);

ALTER TABLE `sedesdeporte` ADD CONSTRAINT `deporte_fk_2` FOREIGN KEY (`deporte_id`) REFERENCES `deporte` (`id`);
ALTER TABLE `sedesdeporte` ADD CONSTRAINT `sedes_fk_3` FOREIGN KEY (`sedes_id`) REFERENCES `sedes` (`id`);

ALTER TABLE `usuario` ADD CONSTRAINT `localidad_fk_2` FOREIGN KEY (`localidad_id`) REFERENCES `localidad` (`id`);
ALTER TABLE `usuario` ADD CONSTRAINT `tipo_documento_fk_1` FOREIGN KEY (`tipo_documento_id`) REFERENCES `tipodocumento` (`id`);
