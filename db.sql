CREATE TABLE competencia
(
    id                    INT AUTO_INCREMENT NOT NULL,
    estado_competencia_id INT NOT NULL,
    tipo_competencia_id   INT NOT NULL,
    deporte_id            INT NOT NULL,
    tipo_puntuacion_id     INT NOT NULL,
    fixture_id            INT DEFAULT NULL,
    usuario_id            INT NOT NULL,
    nombre                VARCHAR(50) NOT NULL,
    reglamento            VARCHAR(1000) DEFAULT NULL,
    permite_empate        TINYINT(1) NOT NULL,
    ptos_ganado           INT NOT NULL,
    ptos_empate           INT NOT NULL,
    ptos_presentacion     INT NOT NULL,
    ptos_ausencia         INT DEFAULT NULL,
    cantidad_sets         INT DEFAULT NULL,
    fecha_baja            DATE DEFAULT NULL,
    UNIQUE INDEX UNIQ_842C498AE524616D (fixture_id),
    INDEX usuario_fk_1 (usuario_id),
    INDEX tipo_competencia_fk_1 (tipo_competencia_id),
    INDEX tipo_puntuacion_fk_1 (tipo_puntuacion_id),
    INDEX fixture_fk_1 (fixture_id),
    INDEX estado_competencia_fk_1 (estado_competencia_id),
    INDEX deporte_fk_1 (deporte_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE deporte
(
    id INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE =    InnoDB;

CREATE TABLE encuentro
(
    id                        INT AUTO_INCREMENT NOT NULL,
    encuentro_empatado        TINYINT(1)         NOT NULL,
    asistencia_participante_1 TINYINT(1)         NOT NULL,
    asistencia_participante_2 TINYINT (1) NOT NULL,
    participante1_id          INT                NOT NULL,
    participante2_id          INT                NOT NULL,
    ganador_id                INT                NOT NULL,
    sedes_id                  INT                NOT NULL,
    ronda_id                  INT                NOT NULL,
    encuentro_perdedor_id INT NOT NULL,
    encuentro_ganador_id      INT                NOT NULL,
    INDEX participante_fk_2 (participante2_id),
    INDEX sedes_fk_1 (sedes_id),
    INDEX encuentro_fk_1 (encuentro_perdedor_id),
    INDEX encuentro_fk_2 (encuentro_ganador_id),
    INDEX participante_fk_1 (participante1_id),
    INDEX participante_fk_3 (ganador_id),
    INDEX ronda_fk_1 (ronda_id),
    PRIMARY KEY (id
        )
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;

CREATE TABLE estadocompetencia
(
    id     INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci
`
  ENGINE = InnoDB;

CREATE TABLE fixture
(
    id INT AUTO_INCREMENT NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;

CREATE TABLE historialresultado
(
    id                        INT AUTO_INCREMENT NOT NULL,
    fecha_historial           DATE               NOT NULL,
    puntos_participante_1     INT                NOT NULL,
    puntos_participante_2     INT                NOT NULL,
    encuentro_empatado        TINYINT(1)         NOT NULL,
    asistencia_participante_1 TINYINT(1)         NOT NULL,
    asistencia_participante_2 TINYINT(1)         NOT NULL,
    ganador_id                INT                NOT NULL,
    encuentro_id
                              INT                NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4
  COLLATE `utf8mb4_unicode_ci`
  ENGINE = InnoDB;
CREATE TABLE localidad
(
    id           INT AUTO_INCREMENT NOT NULL,
    nombre       VARCHAR(50)        NOT NULL,
    provincia_id INT                NOT NULL,
    INDEX provincia_fk_1 (provincia_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER
SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE pais
(
    id     INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE participante
(
    id             INT AUTO_INCREMENT NOT NULL,
    competencia_id INT                NOT NULL,
    nombre         VARCHAR(50)        NOT NULL,
    email          VARCHAR(100)       NOT NULL,
    INDEX competencia_fk_1 (competencia_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE provincia
(
    id      INT AUTO_INCREMENT NOT NULL,
    nombre  VARCHAR(50)        NOT NULL,
    pais_id INT                NOT NULL,
    INDEX pais_fk_1 (pais_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE resultado
(
    id                    INT AUTO_INCREMENT NOT NULL,
    puntos_participante_1 INT                NOT NULL,
    puntos_participante_2 INT                NOT NULL,
    encuentro_id          INT                NOT NULL,
    historial_resultado_id INT NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE ronda
(
    id                    INT AUTO_INCREMENT NOT NULL,
    numero                INT                NOT NULL,
    fecha                 DATE               NOT NULL,
    fixture_id            INT                NOT NULL,
    fixture_perdedores_id INT                NOT NULL,
    INDEX fixture_fk_2 (fixture_perdedores_id),
    INDEX fixture_fk_1 (fixture_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE sedes
(
    id            INT AUTO_INCREMENT NOT NULL,
    codigo        INT                NOT NULL,
    nombre        VARCHAR(50)        NOT NULL,
    descripcion   VARCHAR(100)       NOT NULL,
    fecha_borrado DATE               NOT NULL,
    usuario_id INT NOT NULL,
    INDEX usuario_fk_2 (usuario_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE sedesdeporte
(
    sedes_id   INT NOT NULL,
    deporte_id INT NOT NULL,
    INDEX IDX_790C3D1DBC4E8C79 (sedes_id),
    INDEX IDX_790C3D1D239C54DD (deporte_id),
    PRIMARY KEY (
                 sedes_id, deporte_id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE sedescompetencia
(
    id             INT AUTO_INCREMENT NOT NULL,
    competencia_id INT                NOT NULL,
    sedes_id       INT                NOT NULL,
    disponibilidad INT                NOT NULL,
    INDEX sedes_fk_2 (sedes_id),
    INDEX competencia_fk_2 (competencia_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE tipocompetencia
(
    id     INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE tipodocumento
(
    id     INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE tipopuntuacion
(
    id     INT AUTO_INCREMENT NOT NULL,
    nombre VARCHAR(50)        NOT NULL,
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB;

CREATE TABLE usuario
(
    id                    INT AUTO_INCREMENT NOT NULL,
    nombre                VARCHAR(100)       NOT NULL,
    apellido              VARCHAR(100)       NOT NULL,
    email                 VARCHAR(100)       NOT NULL,
    password              VARCHAR(50) NOT NULL,
    documento             INT                NOT NULL,
    confirmacion_terminos TINYINT(1)         NOT NULL,
    localidad_id          INT                NOT NULL,
    tipo_documento_id     INT                NOT NULL,
    INDEX tipo_documento_fk_1 (tipo_documento_id),
    INDEX localidad_fk_2 (localidad_id),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;

CREATE TABLE refresh_tokens
(
    id            INT AUTO_INCREMENT NOT NULL,
    refresh_token VARCHAR(128)       NOT NULL,
    username      VARCHAR(255)       NOT NULL,
    valid         DATETIME           NOT NULL,
    UNIQUE INDEX UNIQ_9BACE7E1C74F2195 (refresh_token),
    PRIMARY KEY (id)
) DEFAULT CHARACTER SET utf8mb4  COLLATE `utf8mb4_unicode_ci`  ENGINE = InnoDB;


ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498A7336E949 FOREIGN KEY (estado_competencia_id) REFERENCES estadocompetencia (id);
ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498A15530CED FOREIGN KEY (tipo_competencia_id) REFERENCES tipocompetencia (id);
ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498A239C54DD FOREIGN KEY (deporte_id) REFERENCES deporte (id);
ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498A9E9155BB FOREIGN KEY (tipo_puntuacion_id) REFERENCES tipopuntuacion (id);
ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498AE524616D FOREIGN KEY (fixture_id) REFERENCES fixture (id);
ALTER TABLE competencia
    ADD CONSTRAINT FK_842C498ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id);
ALTER TABLE participante
    ADD CONSTRAINT FK_85BDC5C39980C34D FOREIGN KEY (competencia_id) REFERENCES competencia (id);
ALTER TABLE sedesdeporte
    ADD CONSTRAINT FK_790C3D1DBC4E8C79 FOREIGN KEY (sedes_id) REFERENCES sedes (id);
ALTER TABLE sedesdeporte
    ADD CONSTRAINT FK_790C3D1D239C54DD FOREIGN KEY (deporte_id) REFERENCES deporte (id);
ALTER TABLE sedescompetencia
    ADD CONSTRAINT FK_517E75CB9980C34D FOREIGN KEY (competencia_id) REFERENCES competencia (id);
ALTER TABLE sedescompetencia
    ADD CONSTRAINT FK_517E75CBBC4E8C79 FOREIGN KEY (sedes_id) REFERENCES sedes (id);
