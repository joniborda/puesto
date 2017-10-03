CREATE SCHEMA usuarios;
CREATE TABLE usuarios.url
(
  id serial NOT NULL,
  descripcion character varying(100),
  CONSTRAINT urls_pk PRIMARY KEY (id)
);
CREATE TABLE usuarios.usuario
(
  usuario_login text NOT NULL,
  nombre_completo character varying,
  contrasenia character varying,
  modified timestamp without time zone,
  created timestamp without time zone,
  email text,
  borrado boolean NOT NULL DEFAULT false,
  CONSTRAINT usuario_pk PRIMARY KEY (usuario_login)
);
CREATE TABLE usuarios.grupo
(
  descripcion text NOT NULL,
  CONSTRAINT groups_pk PRIMARY KEY (descripcion)
);
CREATE TABLE usuarios.grupo_url
(
  id serial NOT NULL,
  grupo text,
  url_id integer,
  CONSTRAINT grupo_url_pkey PRIMARY KEY (id),
  CONSTRAINT grupo_url_grupo_fk FOREIGN KEY (grupo)
      REFERENCES usuarios.grupo (descripcion) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT grupo_url_url_fk FOREIGN KEY (url_id)
      REFERENCES usuarios.url (id) MATCH SIMPLE
      ON UPDATE CASCADE ON DELETE CASCADE
);
CREATE TABLE usuarios.historial
(
  id serial NOT NULL,
  usuario text,
  url character varying,
  parametros character varying,
  navegador character varying,
  ip character varying(30),
  fecha timestamp without time zone DEFAULT now(),
  CONSTRAINT historial_pk PRIMARY KEY (id),
  CONSTRAINT historiales_usuario_fk FOREIGN KEY (usuario)
      REFERENCES usuarios.usuario (usuario_login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);
CREATE TABLE usuarios.usuario_grupo
(
  id serial NOT NULL,
  usuario text NOT NULL,
  grupo text NOT NULL,
  CONSTRAINT usuario_grupo_pk PRIMARY KEY (id),
  CONSTRAINT usuario_grupo_grupo_fk FOREIGN KEY (grupo)
      REFERENCES usuarios.grupo (descripcion) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION,
  CONSTRAINT usuarios_grupo_usuario_fk FOREIGN KEY (usuario)
      REFERENCES usuarios.usuario (usuario_login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
);

SET search_path = usuarios, pg_catalog;

INSERT INTO grupo VALUES ('administrador');
INSERT INTO grupo VALUES ('INFORMATICA');
INSERT INTO grupo VALUES ('DPTO. TECNICO ADMINISTRATIVO');
INSERT INTO grupo VALUES ('MANTENIMIENTO');

INSERT INTO usuario VALUES ('administrativo', 'administrativo', 'b9e0927b549f7599b01a97ee524cdc7c', '2017-09-21 12:16:50', '2017-08-31 14:21:50', '', false);
INSERT INTO usuario VALUES ('admin', 'administrador', '5405eff412e4238815bf020cdcde72e5', '2017-09-22 08:46:15', '2017-08-23 16:21:29.456313', '', false);
INSERT INTO usuario VALUES ('mantenimiento', '', '05c3b08e1d1520527361730e42350705', '2017-09-22 09:45:50', '2017-09-22 09:22:42', '', false);

INSERT INTO usuario_grupo(usuario, grupo) VALUES ('administrativo', 'administrador');
INSERT INTO usuario_grupo(usuario, grupo) VALUES ('administrativo', 'DPTO. TECNICO ADMINISTRATIVO');
INSERT INTO usuario_grupo(usuario, grupo) VALUES ('admin', 'administrador');
INSERT INTO usuario_grupo(usuario, grupo) VALUES ('admin', 'INFORMATICA');
INSERT INTO usuario_grupo(usuario, grupo) VALUES ('mantenimiento', 'administrador');
INSERT INTO usuario_grupo(usuario, grupo) VALUES ('mantenimiento', 'MANTENIMIENTO');
