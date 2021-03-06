
CREATE TABLE USUARIO (
                ID_USUARIO BIGINT AUTO_INCREMENT NOT NULL,
                CPF VARCHAR(11) NOT NULL,
                NOME VARCHAR(50) NOT NULL,
                SENHA VARCHAR(20) NOT NULL,
                PRIMARY KEY (ID_USUARIO)
);


CREATE UNIQUE INDEX usuario_idx
 ON USUARIO
 ( CPF );

CREATE TABLE EVENTO (
                ID_EVENTO BIGINT AUTO_INCREMENT NOT NULL,
                CATEGORIA VARCHAR(50) NOT NULL,
                TITULO VARCHAR(100) NOT NULL,
                TEXTO VARCHAR(8000) NOT NULL,
                IMAGEM VARCHAR(50),
                DATA_PUBLICACAO DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
                ID_USUARIO BIGINT NOT NULL,
                PRIMARY KEY (ID_EVENTO)
);


CREATE UNIQUE INDEX evento_idx
 ON EVENTO
 ( TITULO );

ALTER TABLE EVENTO ADD CONSTRAINT usuario_noticia_fk
FOREIGN KEY (ID_USUARIO)
REFERENCES USUARIO (ID_USUARIO)
ON DELETE NO ACTION
ON UPDATE NO ACTION;