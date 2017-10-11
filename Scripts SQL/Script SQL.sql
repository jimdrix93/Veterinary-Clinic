--BORRADO DE TABLAS--
DROP SEQUENCE CITAS_SEQ;
DROP SEQUENCE CLIENTES_SEQ;
DROP SEQUENCE ENFERMEDADES_SEQ;
DROP SEQUENCE FACTURAS_SEQ;
DROP SEQUENCE HISTORIALES_SEQ;
DROP SEQUENCE LINEASDEFACTURA_SEQ;
DROP SEQUENCE MASCOTAS_SEQ;
DROP SEQUENCE MENSAJES_SEQ;
DROP SEQUENCE PERSONAL_SEQ;
DROP SEQUENCE SINTOMAS_SEQ;
DROP SEQUENCE TRATAMIENTOS_SEQ;
DROP SEQUENCE VISITAS_SEQ;

DROP TABLE CITAS;
DROP TABLE SINTOMAS;
DROP TABLE ENFERMEDADES;
DROP TABLE VISITAS;
DROP TABLE HISTORIALES;
DROP TABLE TRATAMIENTOS;
DROP TABLE LINEASDEFACTURA;
DROP TABLE FACTURAS;
DROP TABLE MASCOTAS;
DROP TABLE MENSAJES;
DROP TABLE PERSONAL;
DROP TABLE CLIENTES;
DROP TABLE USUARIOS;

--CREACIÓN DE TABLAS--

CREATE TABLE USUARIOS 
(
	DNI VARCHAR2(9) NOT NULL 
	, NOMBRE VARCHAR2(50) NOT NULL 
	, APELLIDOS VARCHAR2(50) NOT NULL 
	, DIRECCION VARCHAR2(100) NOT NULL 
	, TELEFONO NUMBER(9) 
	, CONTRASENA VARCHAR2(15) NOT NULL 
);

CREATE TABLE CLIENTES 
(
    IDCLIENTE NUMBER(*, 0) NOT NULL 
  , DNI VARCHAR2(9 BYTE) NOT NULL 
);

CREATE TABLE PERSONAL 
(
	IDPERSONAL NUMBER(*, 0) NOT NULL 
	, DNI VARCHAR2(9 BYTE) NOT NULL 
	, TIPOPERSONAL VARCHAR2(15 BYTE) NOT NULL
);

CREATE TABLE MENSAJES 
(
	IDMENSAJE NUMBER(*, 0) NOT NULL 
	, IDCLIENTE NUMBER(*, 0) NOT NULL 
	, IDPERSONAL NUMBER(*, 0) NOT NULL 
	, ASUNTO VARCHAR2(100 BYTE) NOT NULL 
	, TEXTO VARCHAR2(500 BYTE)
	, FECHAHORA TIMESTAMP(6) DEFAULT SYSDATE NOT NULL 
	, LEIDO NUMBER(*, 0) DEFAULT 0 NOT NULL 
);

CREATE TABLE MASCOTAS 
(
	IDMASCOTA NUMBER(*, 0) NOT NULL 
	, IDCLIENTE NUMBER(*, 0) NOT NULL 
	, TIPOMASCOTA VARCHAR2(5 BYTE) NOT NULL 
	, RAZA VARCHAR2(20 BYTE)
	, NOMBREMASCOTA VARCHAR2(20 BYTE) 
);

CREATE TABLE TRATAMIENTOS 
(
	IDTRATAMIENTO NUMBER(*, 0) NOT NULL 
	, IDLINEAFACTURA NUMBER(*, 0) NOT NULL 
	, TIPOTRATAMIENTO VARCHAR2(20 BYTE) NOT NULL 
);

CREATE TABLE VISITAS 
(
	IDVISITA NUMBER(*, 0) NOT NULL 
	, IDHISTORIAL NUMBER(*, 0) NOT NULL 
	, IDTRATAMIENTO NUMBER(*, 0) NOT NULL
	, FECHA TIMESTAMP DEFAULT SYSDATE NOT NULL
);

CREATE TABLE ENFERMEDADES 
(
    IDENFERMEDAD NUMBER(*, 0) NOT NULL 
  , IDTRATAMIENTO NUMBER(*, 0) NOT NULL 
  , TIPOENFERMEDAD VARCHAR2(20 BYTE) NOT NULL
);

CREATE TABLE SINTOMAS 
(
	IDSINTOMA NUMBER(*, 0) NOT NULL 
	, IDENFERMEDAD NUMBER(*, 0) NOT NULL 
	, TIPOSINTOMA VARCHAR2(50 BYTE) NOT NULL
);

CREATE TABLE CITAS 
(
    IDCITA NUMBER(*, 0) NOT NULL 
  , IDMASCOTA NUMBER(*, 0) NOT NULL 
  , IDSINTOMA NUMBER(*, 0) NOT NULL 
  , IDVISITA NUMBER(*, 0) NOT NULL 
  , IDPERSONAL NUMBER(*, 0) NOT NULL 
  , FECHAHORA TIMESTAMP NOT NULL
);

CREATE TABLE HISTORIALES 
(
    IDHISTORIAL NUMBER(*, 0) NOT NULL 
  , IDMASCOTA NUMBER(*, 0) NOT NULL
);

CREATE TABLE FACTURAS 
(
    IDFACTURA NUMBER(*, 0) NOT NULL 
  , IDCLIENTE NUMBER(*, 0) NOT NULL 
  , IMPORTETOTAL FLOAT NOT NULL
  , PAGADA NUMBER(*, 0) DEFAULT 0 NOT NULL
  , FECHA TIMESTAMP DEFAULT SYSDATE NOT NULL
);

CREATE TABLE LINEASDEFACTURA 
(
    IDLINEAFACTURA NUMBER(*, 0) NOT NULL 
  , IDFACTURA NUMBER(*, 0) NOT NULL 
  , IDPERSONAL NUMBER(*, 0) NOT NULL 
  , IMPORTE FLOAT(24) NOT NULL
);

--CREACIÓN DE RELACIONES ENTRE TABLAS--

ALTER TABLE USUARIOS ADD(
	CONSTRAINT USUARIOS_PK PRIMARY KEY(DNI)
);

ALTER TABLE CLIENTES ADD(
	CONSTRAINT CLIENTES_PK PRIMARY KEY(IDCLIENTE)
	, CONSTRAINT CLIENTES_FK1 FOREIGN KEY(DNI) REFERENCES USUARIOS(DNI) ON DELETE CASCADE
);

ALTER TABLE PERSONAL ADD (
	CONSTRAINT PERSONAL_PK PRIMARY KEY(IDPERSONAL)
	, CONSTRAINT PERSONAL_FK1 FOREIGN KEY(DNI) REFERENCES USUARIOS(DNI) ON DELETE CASCADE
	, CONSTRAINT PERSONAL_CHK1 CHECK(TIPOPERSONAL IN('Veterinario', 'Peluquero', 'Recepcionista'))
);

ALTER TABLE MENSAJES ADD(
	CONSTRAINT MENSAJE_PK PRIMARY KEY(IDMENSAJE)
	, CONSTRAINT MENSAJES_FK1 FOREIGN KEY(IDCLIENTE) REFERENCES CLIENTES(IDCLIENTE)
	, CONSTRAINT MENSAJES_FK2 FOREIGN KEY(IDPERSONAL) REFERENCES PERSONAL(IDPERSONAL)
);

ALTER TABLE MASCOTAS ADD(
	CONSTRAINT MASCOTAS_PK PRIMARY KEY(IDMASCOTA)
	, CONSTRAINT MASCOTAS_FK1 FOREIGN KEY(IDCLIENTE) REFERENCES CLIENTES(IDCLIENTE)
	, CONSTRAINT MASCOTAS_CHK1 CHECK(TIPOMASCOTA IN('Perro', 'Gato'))
);

ALTER TABLE FACTURAS ADD(
	CONSTRAINT FACTURAS_PK PRIMARY KEY(IDFACTURA)
	, CONSTRAINT FACTURAS_FK1 FOREIGN KEY(IDCLIENTE) REFERENCES CLIENTES(IDCLIENTE)
);

ALTER TABLE LINEASDEFACTURA ADD(
	CONSTRAINT LINEASDEFACTURA_PK PRIMARY KEY(IDLINEAFACTURA)
	, CONSTRAINT LINEASDEFACTURA_FK1 FOREIGN KEY(IDPERSONAL) REFERENCES PERSONAL(IDPERSONAL)
	, CONSTRAINT LINEASDEFACTURA_FK2 FOREIGN KEY(IDFACTURA) REFERENCES FACTURAS(IDFACTURA)
);

ALTER TABLE TRATAMIENTOS ADD(
	CONSTRAINT TRATAMIENTOS_PK PRIMARY KEY(IDTRATAMIENTO)
	, CONSTRAINT TRATAMIENTOS_FK1 FOREIGN KEY(IDLINEAFACTURA) REFERENCES LINEASDEFACTURA(IDLINEAFACTURA)
	, CONSTRAINT TRATAMIENTOS_CHK1 CHECK(TIPOTRATAMIENTO IN('Acupuntura', 'Cirugia', 'Dieta',
	'Farmacoterapia', 'Fisioterapia', 'Fitoterapia', 'Hidroterapia', 'Ortopedia', 'Protesis',
	'Psicoterapia', 'Arteterapia', 'Quimioterapia', 'Radioterapia', 'Rehabilitacion', 'Reposo',
	'Sueroterapia', 'Terapia ocupacional', 'Cortar pelo', 'Cortar unas', 'Lavar', 'Otros', 'Cita asignada'))
);

ALTER TABLE HISTORIALES ADD(
	CONSTRAINT HISTORIALES_PK PRIMARY KEY(IDHISTORIAL)
	, CONSTRAINT HISTORIALES_FK1 FOREIGN KEY(IDMASCOTA) REFERENCES MASCOTAS(IDMASCOTA) ON DELETE CASCADE
);

ALTER TABLE VISITAS ADD(
	CONSTRAINT VISITAS_PK PRIMARY KEY(IDVISITA)
	, CONSTRAINT VISITAS_FK1 FOREIGN KEY(IDTRATAMIENTO) REFERENCES TRATAMIENTOS(IDTRATAMIENTO)
	, CONSTRAINT VISITAS_FK2 FOREIGN KEY(IDHISTORIAL) REFERENCES HISTORIALES(IDHISTORIAL) ON DELETE CASCADE
);

ALTER TABLE ENFERMEDADES ADD(
	CONSTRAINT ENFERMEDADES_PK PRIMARY KEY(IDENFERMEDAD)
	, CONSTRAINT ENFERMEDADES_FK1 FOREIGN KEY(IDTRATAMIENTO) REFERENCES TRATAMIENTOS(IDTRATAMIENTO)
	, CONSTRAINT ENFERMEDADES_CHK1 CHECK (TIPOENFERMEDAD IN('Cenurosis', 'Toxocariasis', 'Rabia',
	'Pasteurella', 'Multocida', 'Fiebre botonosa', 'Fiebre Q', 'Toxoplasmosis', 'Otros'))
);

ALTER TABLE SINTOMAS ADD(
	CONSTRAINT SINTOMAS_PK PRIMARY KEY(IDSINTOMA)
	, CONSTRAINT SINTOMAS_FK1 FOREIGN KEY(IDENFERMEDAD) REFERENCES ENFERMEDADES(IDENFERMEDAD)
	, CONSTRAINT SINTOMAS_CHK1 CHECK(TIPOSINTOMA IN('Perdida de apetito', 'Consumo excesivo de agua',
	'Aumento de peso de forma rapida', 'Perdida de peso de forma rapida', 'Comportamiento fuera de lo comun',
	'Cansancio', 'Pereza', 'Dificultad para levantarse', 'Dificultad para acostarse',
	'Abultamientos extranos','Pelo abundante', 'Unas grandes', 'Otros'))
);

ALTER TABLE CITAS ADD(
	CONSTRAINT CITAS_PK PRIMARY KEY(IDCITA)
	, CONSTRAINT CITAS_UK1 UNIQUE (FECHAHORA)
	, CONSTRAINT CITAS_FK1 FOREIGN KEY(IDMASCOTA) REFERENCES MASCOTAS(IDMASCOTA) ON DELETE CASCADE
	, CONSTRAINT CITAS_FK2 FOREIGN KEY(IDSINTOMA) REFERENCES SINTOMAS(IDSINTOMA)
	, CONSTRAINT CITAS_FK3 FOREIGN KEY(IDVISITA) REFERENCES VISITAS (IDVISITA)
	, CONSTRAINT CITAS_FK4 FOREIGN KEY(IDPERSONAL) REFERENCES PERSONAL(IDPERSONAL)
);

--BORRADO DE SECUENCIAS--

DROP SEQUENCE CITAS_SEQ;
DROP SEQUENCE CLIENTES_SEQ;
DROP SEQUENCE ENFERMEDADES_SEQ;
DROP SEQUENCE FACTURAS_SEQ;
DROP SEQUENCE HISTORIALES_SEQ;
DROP SEQUENCE LINEASDEFACTURA_SEQ;
DROP SEQUENCE MASCOTAS_SEQ;
DROP SEQUENCE MENSAJES_SEQ;
DROP SEQUENCE PERSONAL_SEQ;
DROP SEQUENCE SINTOMAS_SEQ;
DROP SEQUENCE TRATAMIENTOS_SEQ;
DROP SEQUENCE VISITAS_SEQ;

--CREACIÓN DE SECUENCIAS--

CREATE SEQUENCE CITAS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE CLIENTES_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE ENFERMEDADES_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE FACTURAS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE HISTORIALES_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE LINEASDEFACTURA_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE MASCOTAS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE MENSAJES_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE PERSONAL_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE SINTOMAS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE TRATAMIENTOS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;
CREATE SEQUENCE VISITAS_SEQ INCREMENT BY 1 START WITH 1 MAXVALUE 9999999999999999999999999999;

--CREACIÓN DE TRIGGERS--

CREATE OR REPLACE TRIGGER tr_mascota_dia
   BEFORE INSERT
   ON citas
   FOR EACH ROW
DECLARE
   iCitas   INTEGER;
BEGIN
   SELECT COUNT (1)
   INTO iCitas
   FROM citas c
   WHERE C.IDMASCOTA = :new.IDMASCOTA AND C.FECHAHORA >= :new.FECHAHORA - 1;
   IF (iCitas > 0)
   THEN
      raise_application_error (
         -20600,
            TO_CHAR (:NEW.fechahora, 'DD/MM/RRRR')
         || '. Solo se puede solicitar una cita en 24 horas');
   END IF;
END;
/

CREATE OR REPLACE TRIGGER tr_citas
   BEFORE INSERT
   ON citas
   FOR EACH ROW
BEGIN
   IF (:NEW.fechahora < SYSDATE)
   THEN
      raise_application_error (
         -20600,
            TO_CHAR (:NEW.fechahora, 'DD/MM/RRRR')
         || '. El cliente no podrá solicitar una cita anterior a la fecha (y hora) actual');
   END IF;
END;
/

--CREACIÓN DE PROCEDURES Y FUNCTIONS--

CREATE OR REPLACE FUNCTION traduce_dni_idCliente
(w_dni IN usuarios.dni%TYPE)
RETURN INTEGER
IS w_idCliente		 clientes.idCliente%TYPE;
BEGIN
SELECT idCliente INTO w_idCliente FROM clientes WHERE dni = w_dni;
RETURN w_idCliente;
END traduce_dni_idCliente;
/
CREATE OR REPLACE FUNCTION traduce_dni_idPersonal
(w_dni IN usuarios.dni%TYPE)
RETURN INTEGER
IS w_idPersonal		 personal.idPersonal%TYPE;
BEGIN
SELECT idPersonal INTO w_idPersonal FROM personal WHERE dni = w_dni;
RETURN w_idPersonal;
END traduce_dni_idPersonal;
/
CREATE OR REPLACE FUNCTION traduce_sintoma_idSintoma
(w_sintoma IN sintomas.tipoSintoma%TYPE)
RETURN INTEGER
IS w_idSintoma	 sintomas.idSintoma%TYPE;
BEGIN
SELECT idSintoma INTO w_idSintoma FROM sintomas WHERE tipoSintoma = w_sintoma;
RETURN w_idSintoma;
END traduce_sintoma_idSintoma;
/
CREATE OR REPLACE FUNCTION traduce_enferm_idEnferm
(w_enfermedad IN enfermedades.tipoEnfermedad%TYPE)
RETURN INTEGER
IS w_idEnfermedad	 enfermedades.idEnfermedad%TYPE;
BEGIN
SELECT idEnfermedad INTO w_idEnfermedad FROM enfermedades WHERE tipoEnfermedad = w_enfermedad;
RETURN w_idEnfermedad;
END traduce_enferm_idEnferm;
/
CREATE OR REPLACE FUNCTION traduce_trat_idTrat
(w_tratamiento IN tratamientos.tipoTratamiento%TYPE)
RETURN INTEGER
IS w_idTratamiento	 tratamientos.idTratamiento%TYPE;
BEGIN
SELECT idTratamiento INTO w_idTratamiento FROM tratamientos WHERE tipoTratamiento = w_tratamiento;
RETURN w_idTratamiento;
END traduce_trat_idTrat;
/
CREATE OR REPLACE FUNCTION traduce_lF_idLF
(w_importe IN LINEASDEFACTURA.IMPORTE%TYPE)
RETURN INTEGER
IS 
w_idLineaFactura 	lineasdefactura.idLineaFactura%TYPE;
BEGIN
SELECT idLineaFactura INTO w_idLineaFactura FROM lineasdefactura WHERE importe = w_importe;
RETURN w_idLineaFactura;
END traduce_lF_idLF;
/
CREATE OR REPLACE FUNCTION traduce_factura_idFactura
(w_dni IN usuarios.dni%TYPE)
RETURN INTEGER
IS w_idFactura 	facturas.idFactura%TYPE;
w_idCliente		 clientes.idCliente%TYPE;
BEGIN
	w_idCliente := traduce_dni_idCliente(w_dni);
SELECT idFactura INTO w_idFactura FROM facturas WHERE idCliente = w_idCliente;
RETURN w_idFactura;
END traduce_factura_idFactura;
/
CREATE OR REPLACE FUNCTION traduce_mascota_idMascota
(w_dni IN usuarios.dni%TYPE, w_nombre_mascota IN mascotas.nombreMascota%TYPE)
RETURN INTEGER
IS w_idMascota 	mascotas.idMascota%TYPE;
w_idCliente		 clientes.idCliente%TYPE;
BEGIN
	w_idCliente := traduce_dni_idCliente(w_dni);
SELECT idMascota INTO w_idMascota FROM mascotas WHERE nombremascota = w_nombre_mascota;
RETURN w_idMascota;
END traduce_mascota_idMascota;
/
CREATE OR REPLACE FUNCTION traduce_historial_idHistorial
(w_dni IN usuarios.dni%TYPE, w_nombre_mascota IN mascotas.nombreMascota%TYPE)
RETURN INTEGER
IS w_idMascota 	mascotas.idMascota%TYPE;
w_idHistorial	historiales.idHistorial%TYPE;
BEGIN
	w_idMascota := traduce_mascota_idMascota(w_dni, w_nombre_mascota);
SELECT idHistorial INTO w_idHistorial FROM historiales WHERE idMascota = w_idMascota;
RETURN w_idHistorial;
END traduce_historial_idHistorial;
/
CREATE OR REPLACE FUNCTION traduce_visita_idVisita
(w_dni IN usuarios.dni%TYPE, w_nombre_mascota IN mascotas.nombreMascota%TYPE, w_tratamiento IN tratamientos.tipoTratamiento%TYPE, w_fecha IN visitas.fecha%TYPE)
RETURN INTEGER
IS w_idVisita	 	visitas.idVisita%TYPE;
w_idHistorial	historiales.idHistorial%TYPE;
w_idTratamiento	tratamientos.idTratamiento%TYPE;
BEGIN
	w_idHistorial := traduce_historial_idHistorial(w_dni, w_nombre_mascota);
	w_idTratamiento := traduce_trat_idTrat(w_tratamiento);
SELECT idVisita INTO w_idVisita FROM visitas WHERE idHistorial = w_idHistorial AND fecha = w_fecha AND idTratamiento = w_idTratamiento;
RETURN w_idVisita;
END traduce_visita_idVisita;
/
CREATE OR REPLACE FUNCTION traduce_cita_idCita
(w_dni_cliente IN usuarios.dni%TYPE, w_nombre_mascota IN mascotas.nombreMascota%TYPE, w_sintoma IN sintomas.tipoSintoma%TYPE, w_tratamiento IN tratamientos.tipoTratamiento%TYPE, w_dni_personal IN usuarios.dni%TYPE, w_fecha IN VISITAS.FECHA%TYPE)
RETURN INTEGER
IS w_idMascota	mascotas.idMascota%TYPE;
w_idSintoma	sintomas.idSintoma%TYPE;
w_idVisita		visitas.idVisita%TYPE;
w_idPersonal	personal.idPersonal%TYPE;
w_idCita  citas.idCita%TYPE;
BEGIN
	w_idMascota := traduce_mascota_idMascota(w_dni_cliente, w_nombre_mascota);
	w_idSintoma := traduce_sintoma_idSintoma(w_sintoma);
	w_idVisita := traduce_visita_idVisita(w_dni_cliente, w_nombre_mascota, w_tratamiento, w_fecha);
	w_idPersonal := traduce_dni_idPersonal(w_dni_personal);
SELECT idCita INTO w_idCita FROM citas WHERE idMascota = w_idMascota AND idSintoma = w_idSintoma AND idVisita = w_idVisita AND idPersonal = w_idPersonal;
RETURN w_idCita;
END traduce_cita_idCita;
/
CREATE OR REPLACE FUNCTION obtener_importe_lF
(w_idLineaFactura IN lineasDeFactura.idLineaFactura%TYPE)
RETURN FLOAT
IS w_importe	lineasDeFactura.importe%TYPE;

BEGIN
SELECT importe INTO w_importe FROM lineasDeFactura WHERE idLineaFactura = w_idLineaFactura;
RETURN w_importe;
END obtener_importe_lF;
/
CREATE OR REPLACE FUNCTION sumaImportes_importeTotal
(w_importe IN lineasDeFactura.importe%TYPE, w_dni_cliente  IN  usuarios.dni%TYPE)
RETURN FLOAT
IS w_importeTotal 	facturas.importeTotal%TYPE;
w_idCliente	clientes.idCliente%TYPE;

BEGIN
	w_idCliente := traduce_dni_idCliente(w_dni_cliente);
	
SELECT importeTotal+w_importe INTO w_importeTotal FROM facturas WHERE idCliente = w_idCliente;
RETURN w_importeTotal;
END sumaImportes_importeTotal;
/
CREATE OR REPLACE PROCEDURE dar_alta_usuario
(w_dni_usuario 		IN 	usuarios.dni%TYPE,
 w_nombre_usuario		IN 	usuarios.nombre%TYPE,
 w_apellido_usuario 		IN 	usuarios.apellidos%TYPE,
 w_direccion_usuario 		IN	usuarios.direccion%TYPE,
 w_telefono_usuario		IN 	usuarios.telefono%TYPE,
 w_contrasena_usuario	IN	usuarios.contrasena%TYPE) 

IS
BEGIN
INSERT INTO usuarios(dni, nombre, apellidos, direccion, telefono, contrasena)
VALUES (w_dni_usuario, w_nombre_usuario, w_apellido_usuario, w_direccion_usuario, w_telefono_usuario, w_contrasena_usuario);
END dar_alta_usuario;
/
CREATE OR REPLACE PROCEDURE dar_alta_cliente
(w_dni_cliente 		IN 	usuarios.dni%TYPE,
 w_nombre_cliente		IN 	usuarios.nombre%TYPE,
 w_apellido_cliente 		IN 	usuarios.apellidos%TYPE,
 w_direccion_cliente 		IN	usuarios.direccion%TYPE,
 w_telefono_cliente		IN 	usuarios.telefono%TYPE,
 w_contrasena_cliente	IN	usuarios.contrasena%TYPE) 


IS
BEGIN
dar_alta_usuario(w_dni_cliente, w_nombre_cliente, w_apellido_cliente, w_direccion_cliente, w_telefono_cliente,w_contrasena_cliente);
INSERT INTO clientes(idCliente,dni)
VALUES (clientes_seq.nextval,w_dni_cliente);

END dar_alta_cliente;
/
CREATE OR REPLACE PROCEDURE dar_alta_personal
(w_dni_personal		IN 	usuarios.dni%TYPE,
 w_nombre_personal		IN 	usuarios.nombre%TYPE,
 w_apellido_personal 		IN 	usuarios.apellidos%TYPE,
 w_direccion_personal 	IN	usuarios.direccion%TYPE,
 w_telefono_personal		IN 	usuarios.telefono%TYPE,
 w_contrasena_personal	IN	usuarios.contrasena%TYPE,
 w_tipo_puesto_trabajo_personal    IN    personal.tipoPersonal%TYPE) 

IS
BEGIN
dar_alta_usuario(w_dni_personal, w_nombre_personal, w_apellido_personal, w_direccion_personal, w_telefono_personal, w_contrasena_personal);
INSERT INTO personal( idPersonal, dni, tipoPersonal)
VALUES (personal_seq.nextval, w_dni_personal, w_tipo_puesto_trabajo_personal);
END dar_alta_personal;
/
CREATE OR REPLACE PROCEDURE dar_alta_mascota
(w_tipoMascota_mascota		IN 	mascotas.tipoMascota%TYPE,
 w_raza_mascota			IN 	mascotas.raza%TYPE,
 w_nombreMascota_mascota	IN	mascotas.nombreMascota%TYPE,
 w_dniCliente				IN	clientes.dni%TYPE)

IS w_idCliente					clientes.idCliente%TYPE;
BEGIN
w_idCliente := traduce_dni_idCliente(w_dniCliente);
INSERT INTO mascotas(idMascota, idCliente, tipoMascota, raza, nombreMascota)
VALUES (mascotas_seq.nextval, w_idCliente, w_tipoMascota_mascota, w_raza_mascota, w_nombreMascota_mascota);
END dar_alta_mascota;
/
CREATE OR REPLACE PROCEDURE crear_visita
(w_dni IN usuarios.dni%TYPE, 
 w_nombre_mascota IN mascotas.nombreMascota%TYPE,
 w_tratamiento			IN 	tratamientos.tipoTratamiento%TYPE,
 w_fecha      IN VISITAS.FECHA%TYPE)

IS
w_idHistorial					historiales.idHistorial%TYPE;
w_idTratamiento					tratamientos.idTratamiento%TYPE;
BEGIN
w_idTratamiento := traduce_trat_idTrat(w_tratamiento);
w_idHistorial := traduce_historial_idHistorial(w_dni, w_nombre_mascota);
INSERT INTO visitas(idVisita, idHistorial, idTratamiento, fecha)
VALUES (visitas_seq.nextval, w_idHistorial, w_idTratamiento, w_fecha);
END crear_visita;
/
CREATE OR REPLACE PROCEDURE asignar_cita
(w_fechahora_elegida		IN 	citas.fechahora%TYPE,
w_nombreMascota		IN	mascotas.nombreMascota%TYPE,
w_dni_cliente 			IN	usuarios.dni%TYPE,
w_dni_personal		IN	usuarios.dni%TYPE,
w_tratamiento			IN 	tratamientos.tipoTratamiento%TYPE,
w_sintoma			IN 	sintomas.tipoSintoma%TYPE
) 

IS w_idMascota	citas.idMascota%TYPE;
w_idVisita		visitas.idVisita%TYPE;
w_idPersonal		personal.idPersonal%TYPE;
w_idSintoma		sintomas.idSintoma%TYPE;

BEGIN
	w_idMascota := traduce_mascota_idMascota(w_dni_cliente, w_nombreMascota);
	w_idVisita := traduce_visita_idVisita(w_dni_cliente, w_nombreMascota, w_tratamiento, w_fechahora_elegida);
	w_idPersonal := traduce_dni_idPersonal(w_dni_personal);
	w_idSintoma := traduce_sintoma_idSintoma(w_sintoma);
INSERT INTO citas(idMascota, idSintoma, idVisita, idPersonal, fechahora)
VALUES (w_idMascota, w_idSintoma, w_idVisita, w_idPersonal, w_fechahora_elegida);

END asignar_cita;
/
CREATE OR REPLACE PROCEDURE crear_mensaje
(w_asunto_mensaje		IN 	mensajes.asunto%TYPE,
 w_texto_mensaje		IN 	mensajes.texto%TYPE,
w_dni_personal_mensaje IN  	usuarios.dni%TYPE,
w_dni_cliente_mensaje            IN 	usuarios.dni%TYPE) 

IS w_idCliente 			mensajes.idCliente%TYPE;
w_idPersonal			mensajes.idPersonal%TYPE;

BEGIN

	w_idCliente := traduce_dni_idCliente(w_dni_cliente_mensaje);
	w_idPersonal := traduce_dni_idPersonal(w_dni_personal_mensaje);
INSERT INTO mensajes(idMensaje, idCliente, idPersonal, asunto, texto)
VALUES (mensajes_seq.nextval, w_idCliente, w_idPersonal, w_asunto_mensaje, w_texto_mensaje);
END crear_mensaje;
/
CREATE OR REPLACE PROCEDURE crear_historial
(w_dni IN usuarios.dni%TYPE, 
w_nombre_mascota IN mascotas.nombreMascota%TYPE) 

IS w_idMascota				mascotas.idMascota%TYPE;
BEGIN
w_idMascota := traduce_mascota_idMascota(w_dni, w_nombre_mascota);
INSERT INTO historiales( idHistorial, idMascota)
VALUES (historiales_seq.nextval, w_idMascota);
END crear_historial;
/
CREATE OR REPLACE PROCEDURE crear_sintoma
(w_enfermedad IN enfermedades.tipoEnfermedad%TYPE,
w_sintoma         IN  	sintomas.tipoSintoma%TYPE)

IS w_idEnfermedad				enfermedades.idEnfermedad%TYPE;
BEGIN
w_idEnfermedad := traduce_enferm_idEnferm(w_enfermedad);
INSERT INTO sintomas(idSintoma,idEnfermedad, tipoSintoma)
VALUES (sintomas_seq.nextval,w_idEnfermedad, w_sintoma);
END crear_sintoma;
/
CREATE OR REPLACE PROCEDURE crear_enfermedad
(w_tratamiento IN tratamientos.tipoTratamiento%TYPE,
 w_enfermedad	IN	enfermedades.tipoEnfermedad%TYPE) 

IS w_idTratamiento			tratamientos.idTratamiento%TYPE;
BEGIN
w_idTratamiento := traduce_trat_idTrat(w_tratamiento);
INSERT INTO enfermedades(idEnfermedad, idTratamiento, tipoEnfermedad)
VALUES (enfermedades_seq.nextval, w_idTratamiento, w_enfermedad);
END crear_enfermedad;
/
CREATE OR REPLACE PROCEDURE crear_tratamiento
( w_tratamiento	IN	tratamientos.tipoTratamiento%TYPE) 

IS w_idLineaDeFactura 				lineasDeFactura.idLineafactura%TYPE;
BEGIN
w_idLineaDeFactura := traduce_lF_idLF(w_tratamiento);
INSERT INTO tratamientos(idTratamiento, tipoTratamiento, idLineaFactura)
VALUES (tratamientos_seq.nextval, w_tratamiento,  w_idLineaDeFactura);
END crear_tratamiento;
/
CREATE OR REPLACE PROCEDURE crear_lineaDeFactura
(w_dni_cliente			IN	usuarios.dni%TYPE,
w_dni_personal			IN	usuarios.dni%TYPE,
w_importe				IN	lineasDeFactura.importe%TYPE) 

IS w_idFactura	facturas.idFactura%TYPE;
w_idPersonal	personal.idPersonal%TYPE;
BEGIN
w_idFactura := traduce_factura_idFactura(w_dni_cliente);
w_idPersonal := traduce_dni_idPersonal(w_dni_personal);
INSERT INTO lineasDeFactura(idLineaFactura, idFactura, idPersonal,importe)
VALUES (lineasDeFactura_seq.nextval, w_idFactura, w_idPersonal, w_importe);
END crear_lineaDeFactura;
/
CREATE OR REPLACE PROCEDURE crear_factura
(w_dni_cliente			IN	usuarios.dni%TYPE) 

IS w_idCliente		clientes.idCliente%TYPE;
BEGIN
w_idCliente := traduce_dni_idCliente(w_dni_cliente);
INSERT INTO facturas(idFactura, idCliente, importeTotal)
VALUES (facturas_seq.nextval, w_idCliente, 0);
END crear_factura;
/
CREATE OR REPLACE PROCEDURE eliminar_usuario
(w_dni_usuario			IN	usuarios.dni%TYPE) 

IS
BEGIN
	
DELETE FROM usuarios
WHERE DNI = w_dni_usuario;
END eliminar_usuario;
/
CREATE OR REPLACE PROCEDURE eliminar_mascota
(w_dni_cliente			IN	usuarios.dni%TYPE,
w_nombreMascota		IN	mascotas.nombreMascota%TYPE) 

IS w_idMascota	mascotas.idMascota%TYPE;
BEGIN
	w_idMascota := traduce_mascota_idMascota(w_dni_cliente, w_nombreMascota);
DELETE FROM mascotas
WHERE idCliente = w_idMascota;
END eliminar_mascota;
/
CREATE OR REPLACE PROCEDURE eliminar_cita
(w_dni_cliente IN usuarios.dni%TYPE, 
w_nombre_mascota IN mascotas.nombreMascota%TYPE, 
w_sintoma IN sintomas.tipoSintoma%TYPE, 
w_tratamiento IN tratamientos.tipoTratamiento%TYPE, 
w_dni_personal IN usuarios.dni%TYPE,
w_fecha IN CITAS.FECHAHORA%TYPE) 

IS w_idCita	citas.idCita%TYPE;
BEGIN
	w_idCita := traduce_cita_idCita(w_dni_cliente, w_nombre_mascota, w_sintoma, w_tratamiento, w_dni_personal, w_fecha);
DELETE FROM citas
WHERE idCita= w_idCita;
END eliminar_cita;
/
CREATE OR REPLACE PROCEDURE actualizar_direccion_usuario
(w_dni		IN	usuarios.dni%TYPE,
w_direccion	IN	usuarios.direccion%TYPE) 

IS 
BEGIN
UPDATE usuarios
SET direccion = w_direccion
WHERE dni = w_dni;
END actualizar_direccion_usuario;
/
CREATE OR REPLACE PROCEDURE actualizar_telefono_usuario
(w_dni		IN	usuarios.dni%TYPE,
w_telefono	IN	usuarios.telefono%TYPE) 

IS 
BEGIN
UPDATE usuarios
SET telefono = w_telefono
WHERE dni = w_dni;
END actualizar_telefono_usuario;
/
CREATE OR REPLACE PROCEDURE actualizar_contrasena_usuario
(w_dni		IN	usuarios.dni%TYPE,
w_contrasena	IN	usuarios.contrasena%TYPE) 

IS 
BEGIN
UPDATE usuarios
SET contrasena= w_contrasena
WHERE dni = w_dni;
END actualizar_contrasena_usuario;
/
CREATE OR REPLACE PROCEDURE actualizar_cita
(w_dni_cliente IN usuarios.dni%TYPE, 
w_nombre_mascota IN mascotas.nombreMascota%TYPE, 
w_sintoma IN sintomas.tipoSintoma%TYPE, 
w_tratamiento IN tratamientos.tipoTratamiento%TYPE, 
w_dni_personal IN usuarios.dni%TYPE,
w_fechahora_elegida		IN 	citas.fechahora%TYPE) 

IS  w_idCita 	citas.idCita%TYPE;
BEGIN
w_idCita := traduce_cita_idCita(w_dni_cliente, w_nombre_mascota, w_sintoma, w_tratamiento, w_dni_personal, w_fechahora_elegida);
UPDATE citas
SET fechahora= w_fechahora_elegida
WHERE idCita = w_idCita;
END actualizar_cita;
/
CREATE OR REPLACE PROCEDURE calcular_importeTotal
(w_dni_cliente IN usuarios.dni%TYPE, w_tratamiento  IN  tratamientos.tipoTratamiento%TYPE) 

IS  w_importeTotal 	facturas.importeTotal%TYPE;
w_importe	lineasDeFactura.importe%TYPE;
w_idFactura	facturas.idFactura%TYPE;
w_idCliente	clientes.idCliente%TYPE;
BEGIN
w_idCliente  := traduce_dni_idCliente(w_dni_cliente);
w_idFactura  := traduce_factura_idFactura(w_dni_cliente);
w_importe := obtener_importe_lF(w_tratamiento);
w_importeTotal := sumaImportes_importeTotal(w_importe, w_dni_cliente);
INSERT INTO facturas(idFactura, idCliente, importeTotal)
VALUES (w_idFactura, w_idCliente, w_importeTotal);
END calcular_importeTotal;
/
CREATE SEQUENCE CITAS_SEQ;

CREATE TRIGGER CITAS_TRG 
BEFORE INSERT ON CITAS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDCITA IS NULL THEN
      SELECT CITAS_SEQ.NEXTVAL INTO :NEW.IDCITA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE CLIENTES_SEQ;

CREATE TRIGGER CLIENTES_TRG 
BEFORE INSERT ON CLIENTES 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDCLIENTE IS NULL THEN
      SELECT CLIENTES_SEQ.NEXTVAL INTO :NEW.IDCLIENTE FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE ENFERMEDADES_SEQ;

CREATE TRIGGER ENFERMEDADES_TRG 
BEFORE INSERT ON ENFERMEDADES 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDENFERMEDAD IS NULL THEN
      SELECT ENFERMEDADES_SEQ.NEXTVAL INTO :NEW.IDENFERMEDAD FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE FACTURAS_SEQ;

CREATE TRIGGER FACTURAS_TRG 
BEFORE INSERT ON FACTURAS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDFACTURA IS NULL THEN
      SELECT FACTURAS_SEQ.NEXTVAL INTO :NEW.IDFACTURA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE HISTORIALES_SEQ;

CREATE TRIGGER HISTORIALES_TRG 
BEFORE INSERT ON HISTORIALES 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDHISTORIAL IS NULL THEN
      SELECT HISTORIALES_SEQ.NEXTVAL INTO :NEW.IDHISTORIAL FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE LINEASDEFACTURA_SEQ;

CREATE TRIGGER LINEASDEFACTURA_TRG 
BEFORE INSERT ON LINEASDEFACTURA 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDLINEAFACTURA IS NULL THEN
      SELECT LINEASDEFACTURA_SEQ.NEXTVAL INTO :NEW.IDLINEAFACTURA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE MASCOTAS_SEQ;

CREATE TRIGGER MASCOTAS_TRG 
BEFORE INSERT ON MASCOTAS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDMASCOTA IS NULL THEN
      SELECT MASCOTAS_SEQ.NEXTVAL INTO :NEW.IDMASCOTA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE MENSAJES_SEQ;

CREATE TRIGGER MENSAJES_TRG 
BEFORE INSERT ON MENSAJES 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDMENSAJE IS NULL THEN
      SELECT MENSAJES_SEQ.NEXTVAL INTO :NEW.IDMENSAJE FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE PERSONAL_SEQ;

CREATE TRIGGER PERSONAL_TRG 
BEFORE INSERT ON PERSONAL 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDPERSONAL IS NULL THEN
      SELECT PERSONAL_SEQ.NEXTVAL INTO :NEW.IDPERSONAL FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE SINTOMAS_SEQ;

CREATE TRIGGER SINTOMAS_TRG 
BEFORE INSERT ON SINTOMAS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDSINTOMA IS NULL THEN
      SELECT SINTOMAS_SEQ.NEXTVAL INTO :NEW.IDSINTOMA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE TRATAMIENTOS_SEQ;

CREATE TRIGGER TRATAMIENTOS_TRG 
BEFORE INSERT ON TRATAMIENTOS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDTRATAMIENTO IS NULL THEN
      SELECT TRATAMIENTOS_SEQ.NEXTVAL INTO :NEW.IDTRATAMIENTO FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/
CREATE SEQUENCE VISITAS_SEQ;

CREATE TRIGGER VISITAS_TRG 
BEFORE INSERT ON VISITAS 
FOR EACH ROW 
BEGIN
  <<COLUMN_SEQUENCES>>
  BEGIN
    IF INSERTING AND :NEW.IDVISITA IS NULL THEN
      SELECT VISITAS_SEQ.NEXTVAL INTO :NEW.IDVISITA FROM SYS.DUAL;
    END IF;
  END COLUMN_SEQUENCES;
END;
/