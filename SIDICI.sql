
--
-- Generar Sequencias
DROP SEQUENCE IF EXISTS admin_idadmin_seq CASCADE;
CREATE SEQUENCE admin_idadmin_seq;
DROP SEQUENCE IF EXISTS movimientos_idmovimiento_seq CASCADE;
CREATE SEQUENCE movimientos_idmovimiento_seq;
DROP SEQUENCE IF EXISTS novedades_id_novedad_seq CASCADE;
CREATE SEQUENCE novedades_id_novedad_seq;

--
-- Estrutura da tabela 'activos'
--

DROP TABLE IF EXISTS activos CASCADE;
CREATE TABLE activos (
idactivo varchar(4) NOT NULL,
idempleado varchar(11),
id_estadoact varchar(1) NOT NULL,
serial varchar(25) NOT NULL,
so varchar(10) NOT NULL,
marca varchar(25) NOT NULL,
tipo varchar(10) NOT NULL,
fecha date NOT NULL,
observaciones varchar(2000) NOT NULL,
estado varchar(20) DEFAULT 'Asignado'::character varying
);

--
-- Creating data for 'activos'
--

INSERT INTO activos VALUES ('350','1053331039','1','4FZXVC3','WINDOWS','DELL ','Laptop','2022-11-30','Equipo sin numero de activo fijo, esta fuera de la oficina ','Asignado');
INSERT INTO activos VALUES ('257','1098703709','1','PF08Y4HM ','WINDOWS','LENOVO','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('244','1096184605','1','PCk4N0CX064898164','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('347','1005161040','1','C17G356CQ6L4','macOS','Makbook','Laptop','2022-11-30','Factura # 9177 alfa canal digital','Asignado');
INSERT INTO activos VALUES ('271','1018510067','1','5CD8383M1P','WINDOWS','HP','Laptop','2022-11-30','Se realizo cambio de bateria (17/08/2021)','Asignado');
INSERT INTO activos VALUES ('272','1018427404','1','5CD81703GV ','WINDOWS','HP','Laptop','2022-11-30','Se realizo cambio de bateria Factura FEC No. 2446 (17/08/2021)','Asignado');
INSERT INTO activos VALUES ('351','1102364526','1','1H3PVC3','WINDOWS','DELL','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('281','1007790592','1','RYZEN 5 -CN K8 Al','WINDOWS','ASUS','Laptop','2022-11-30','FACTURA # TT232  T Y T ','Asignado');
INSERT INTO activos VALUES ('282','91476804','1','VOSTRO IF2ST43','WINDOWS','VOSTRO','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('358','79189680','1','JTP6Vf2','WINDOWS','DELL','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('122','1000727726','1','5CD7363FVL','WINDOWS','HP','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('344','1098810803','1','PF24T8DQ','WINDOWS','LENOVO','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('356','1005340274','1','PF3CBRMF 82C4','WINDOWS','LENOVO','Laptop','2022-11-30','Factura 9413','Asignado');
INSERT INTO activos VALUES ('364','37901626','1','N3N0CV22762713C','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('365','1098647556','1','NXHS5AL02X21703CF63400','WINDOWS','ACER','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('367','1102720850','1','N6N0CX16V17526F','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('368','63542220','1','N6N0CX16V30626D  ','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('352','1140847441','1','M6N0CX18P667252','WINDOWS','ASUS','Laptop','2022-11-30','Factura FVE32','Asignado');
INSERT INTO activos VALUES ('366','1098776494','1','N6N0CX16U89026A','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('362','1095839818','1','N4N0CX143902179 ','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('115','1053331039','1','JGGM91TD500453H','WINDOWS','SAMSUNG','Laptop','2022-11-30','Equipo en optimas condiciones','Asignado');
INSERT INTO activos VALUES ('128','1022950773','1','G2N0CV10A79007C','WINDOWS','ASUS','Laptop','2022-11-30','Equipo en buen estado','Asignado');
INSERT INTO activos VALUES ('353','1098763006','1','M6N0CX14531124B','WINDOWS','ASUS','Laptop','2022-11-30','Factura FVE33','Asignado');
INSERT INTO activos VALUES ('354','1098608968','1','PF3CPJB6 82C4','WINDOWS','LENOVO','Laptop','2022-11-30','Factura 9413','Asignado');
INSERT INTO activos VALUES ('355','1101698657','1','PF3CCDVM 82C4','WINDOWS','LENOVO','Laptop','2022-11-30','Factura 9413','Asignado');
INSERT INTO activos VALUES ('357','1095955546','1','PF3CBEYP 82C4','WINDOWS','LENOVO','Laptop','2022-11-30','Factura 9414','Asignado');
INSERT INTO activos VALUES ('361','1098817685','1','N4N0CX14410717B','WINDOWS','ASUS','Laptop','2022-11-30','Factura Alkosto W4221001883','Asignado');
INSERT INTO activos VALUES ('363','1065641588','1','N5N0CV00S62518D  ','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Asignado');
INSERT INTO activos VALUES ('359','1098742562','1','M7N0CX21585830F','WINDOWS','ASUS','Laptop','2022-11-30','Equipo comprado en tienda y tecnologia','Asignado');
INSERT INTO activos VALUES ('116','22222222','1','E7N0CX205431283','WINDOWS','ASUS','Laptop','2022-12-03','Ninguna','Creado');
INSERT INTO activos VALUES ('100','22222222','1','5CD7363FVZ','WINDOWS','HP','Laptop','2022-11-30','Se realiza cambio de bateria y cargador el 09 de sept 2021.','Creado');
INSERT INTO activos VALUES ('110','22222222','1','5CD7363FVQ','WINDOWS','HP','Laptop','2022-11-30','Equipo asignado por prestamo temporal ','Creado');
INSERT INTO activos VALUES ('142','22222222','1','D4N0CX215666615G','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Creado');
INSERT INTO activos VALUES ('268','22222222','1','A315-53G-50L8','WINDOWS','ACER','Laptop','2022-11-30','Ninguna','Creado');
INSERT INTO activos VALUES ('369','22222222','1','M6N0CX13W18324F','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Creado');
INSERT INTO activos VALUES ('345','22222222','1','M3N0CX11270612E','WINDOWS','ASUS','Laptop','2022-11-30','Ninguna','Creado');
INSERT INTO activos VALUES ('134','22222222','1','MP1BYBZL','WINDOWS','LENOVO','Laptop','2022-11-30','Ninguna','Creado');
INSERT INTO activos VALUES ('269','22222222','1','K4N0GRO6J415164','WINDOWS','ASUS','Laptop','2022-11-30','SE ENVIA EQUIPO A GARANTIA SEGUN FACTURA # 8479 T Y T - 20 DE MAYO 2020 ','Creado');


--
-- Creating index for 'activos'
--

ALTER TABLE ONLY  public.activos  ADD CONSTRAINT  activos_pkey  PRIMARY KEY  (idactivo);

--
-- Estrutura da tabela 'admin'
--

DROP TABLE IF EXISTS admin CASCADE;
CREATE TABLE admin (
idadmin int4 NOT NULL DEFAULT nextval('admin_idadmin_seq'::regclass),
idempleado varchar(11) NOT NULL,
correo varchar(50) NOT NULL,
pass varchar(50) NOT NULL,
id_estadoemp varchar(1) NOT NULL,
tokenuser varchar(30),
perfil varchar(255) DEFAULT 'gestion.jpg'::character varying
);

--
-- Creating data for 'admin'
--

INSERT INTO admin VALUES ('3','1002995941','ferney.becerra@misena.edu.co','admin16$','1','KFbDIgLhUYWVEj9CR0mH','ferney.becerra@misena.edu.co6387cefe059058.38294616.jpeg');
INSERT INTO admin VALUES ('20','1053331039','serjio1214@gmail.com','hola123','1','6GO4F2iTh08SAbMZHEQY','serjio1214@gmail.com6391254b8389e6.75327082.jpg');
INSERT INTO admin VALUES ('14','1102720850','asistente.ti@amovil.co','1234','1','gzP6iGy7o320kWB4hlFJ','asistente.ti@amovil.co638b7f0cdb48e6.01358258.jpg');


--
-- Creating index for 'admin'
--

ALTER TABLE ONLY  public.admin  ADD CONSTRAINT  admin_pkey  PRIMARY KEY  (idadmin);

--
-- Estrutura da tabela 'cargo'
--

DROP TABLE IF EXISTS cargo CASCADE;
CREATE TABLE cargo (
id_cargo varchar(2) NOT NULL,
nomcargo varchar(100) NOT NULL,
sueldo float8 DEFAULT 0
);

--
-- Creating data for 'cargo'
--

INSERT INTO cargo VALUES ('4','Administrador financiero','2000000');
INSERT INTO cargo VALUES ('5','Director de operaciones','2000000');
INSERT INTO cargo VALUES ('6','Analista de servicio nivel 1','2000000');
INSERT INTO cargo VALUES ('7','Analista de servicio nivel 2','2000000');
INSERT INTO cargo VALUES ('9','Lider de implementacion','2000000');
INSERT INTO cargo VALUES ('11','Director de proyectos','0');
INSERT INTO cargo VALUES ('12','Lider de proyectos','0');
INSERT INTO cargo VALUES ('10','Gestor sig','0');
INSERT INTO cargo VALUES ('14','Lider de mesa de ayuda','0');
INSERT INTO cargo VALUES ('13','Analista de documentos electronicos','2000000');
INSERT INTO cargo VALUES ('1','Desarrolador movil','2000000');
INSERT INTO cargo VALUES ('2','Asistente TI','2000000');
INSERT INTO cargo VALUES ('3','Desarrolador web','1000000');
INSERT INTO cargo VALUES ('15','Director de operaciones','15000000');

--
-- Estrutura da tabela 'ciudad'
--

DROP TABLE IF EXISTS ciudad CASCADE;
CREATE TABLE ciudad (
id_compania varchar(20) NOT NULL,
ciudad varchar(20) NOT NULL
);

--
-- Creating data for 'ciudad'
--

INSERT INTO ciudad VALUES ('1','Medellin');
INSERT INTO ciudad VALUES ('2','Bogota');
INSERT INTO ciudad VALUES ('3','Cucuta');
INSERT INTO ciudad VALUES ('4','Cartagena');
INSERT INTO ciudad VALUES ('5','Bucaramanga');

--
-- Estrutura da tabela 'empleados'
--

DROP TABLE IF EXISTS empleados CASCADE;
CREATE TABLE empleados (
idempleado varchar(11) NOT NULL,
nombre varchar(50) NOT NULL,
telefono varchar(20) NOT NULL,
id_cargo varchar(10) NOT NULL,
id_compania varchar(30) NOT NULL,
direccion varchar(150) NOT NULL,
id_estadoemp varchar(30) NOT NULL
);

--
-- Creating data for 'empleados'
--

INSERT INTO empleados VALUES ('1102364526','Narly Viviana Alvarez Daza','3106690165','7','5','CLLE 2 #03-08 BARRIO EL TRAPICHE','1');
INSERT INTO empleados VALUES ('37901626','Maria Hudith Malavera Gomez','3163993236','7','5','KR19 41 51 APTO 803 ','1');
INSERT INTO empleados VALUES ('1098763006','Diego Fernando Parada Bueno ','3177764270','6','5','CARRERA12 104 A 03 PISO 2 ','1');
INSERT INTO empleados VALUES ('1095839818','Laura Mariana Arias Fonceca','3185229536','6','5','CALLE 9 4 28 BARRIO CARACOLI ','1');
INSERT INTO empleados VALUES ('1098647556','Derlybret Rodriguez Jaimes','3167463613','4','5','CRA 35-36-14 CONJUNTO  REDIL DEL COUNTRY TORRE 2 APTO 303 ','1');
INSERT INTO empleados VALUES ('10008471','Cesar Augusto Trujillo Salazar','3024095500','7','5','CLLE 54 # 4D-44 APTO 405G LOS CIRUELOS','1');
INSERT INTO empleados VALUES ('13717893','Cristian Antonio Ayala Rueda','3176676102','15','5','CONJUNTO TAYRONA I TORRE 1 APTO 1201 ','1');
INSERT INTO empleados VALUES ('91476804','Carlos Alberto Ardila Zuñiga','3173000394','11','5','ENTRE PARQUES GUAYACAN TORRE 2 APTO 101 PIEDECUESTA ','1');
INSERT INTO empleados VALUES ('1098703709','Cristian Leonardo Peñuela Ayala ','3174033427','13','5','Carrera 50 # 72 -19 Bucaramanga CONJUNTO VILLAS DEL CACIQUE CASA 3 ','1');
INSERT INTO empleados VALUES ('1018427404','Italo Leonardy Sanchez Quironez','3105806317','14','2','  Calle 8 N. 11 ? 01 Casa 49 Quintas de Celta Etapa 1 Funza ? Cundinamarca','1');
INSERT INTO empleados VALUES ('1018510067','Juan Felipe Aldana Chaparro','3002667809','6','2','Direccion: Carrera 22A #9B - 16 - Paipa - Boyaca','1');
INSERT INTO empleados VALUES ('1096184605','Edgar Josue Rivera Angulo','3118350044','9','5','CALLE 17 #2w-80 SENDERO DE MIRAFLORES TORRE 3 PISO 11 APARTAMENTO 1111','1');
INSERT INTO empleados VALUES ('79189680','Wilton  Cortez Sanchez','316 8784462','6','2','CARERRA 91 # 137-70 SUBA','1');
INSERT INTO empleados VALUES ('1098608968','Eduardo Andres Diaz Gutierrez','3156417599','6','5','CLLE 23  12 03 CIUDAD VALENCIA','1');
INSERT INTO empleados VALUES ('1007790592','Steffany Juliana Orejarena Castañeda','3228629792','13','5','VIA GUATIGUARA-VEREDA LA DIVA-  VIALLA ADELA TORRE D APTO 702 PIEDECUESTA ','1');
INSERT INTO empleados VALUES ('1102720850','Carlos Julian Rodriguez Sanchez ','3118756341','2','5','CALLE18 #8W-06 TORRE 1 APTO 202 CONJ REAL ISABELLA BARRIO COMUNEROS PIEDECUESTA ','1');
INSERT INTO empleados VALUES ('1005161040','Arvey Felipe Saavedra Basto','+5730123228811','1','5','Cr 30 Cl 33 79 Ed Lantana','1');
INSERT INTO empleados VALUES ('1005340274','Yosmar Julian Valderrama Gomez','3173521844','3','5','Calle 4119-43 Barrio Rincon de Giron','1');
INSERT INTO empleados VALUES ('1098810803','Brayan Mauricio  Diaz Bermudez ','316 3262323','3','5','CL 27 N 9 28 barrio norte ','1');
INSERT INTO empleados VALUES ('1040742851','Luisa Fernanda Saldarriaga Cardona','+5731058268921','10','1','CL 98 SUR # 55 7','1');
INSERT INTO empleados VALUES ('1065641588','Andrea De Los Angeles Alhuema Ordonez','3015183893','6','5','Cra 12c #33-18 barrio Los laureles  ','1');
INSERT INTO empleados VALUES ('1015453513','Marisol Quiroga Prada','3143577055','6','5','Cr 29 12 05 barrio la universidad','1');
INSERT INTO empleados VALUES ('63542220','Carolina Patiño Silva ','3202937839','6','5','CARRERA 5 # 45-13 BARRIO LAGOS II','1');
INSERT INTO empleados VALUES ('1101698657','Andres Ferney Medina Ruiz','3102299875','6','5','Carrera 13 # 3-13 barrio villabel ','1');
INSERT INTO empleados VALUES ('1095955546','Mayra Daniela  Gomez Abreu','313 4833694','6','5','Conjunto Residencial Paseo Real 2 - Torre 18 - Apartamento 5069 - Piedecuesta.','1');
INSERT INTO empleados VALUES ('1098817685','Anderson Eduardo Abella Luna ','314 3330087','6','2','Calle 56 # 14 - 105 Barrio el reposo','1');
INSERT INTO empleados VALUES ('1053331039','Jairo Alonso  Ibañez Suarez','3212302996','6','5','carrera 55A 187 51 interior 5 apto 304 barrio mirandela - bogota ','1');
INSERT INTO empleados VALUES ('1022950773','Ginna Paola Parra Ramirez','322 7698986','6','5','CALLE 8 5- 21 GUATEQUE BOYACA','1');
INSERT INTO empleados VALUES ('1098776494','Juan Carlos Diaz Remolina',' 318 7579120','6','5','Carrera 16 117 11 barrio Villas del nogal Bucaramanga','1');
INSERT INTO empleados VALUES ('1097780634','Angel David  Ayala Jaimes','+5731708620965','6','5','CONJUNTO TAYRONA 1 TORRE 1 APTO 1201  CAÑAVERAL ','1');
INSERT INTO empleados VALUES ('1140847441','Juan Camilo  Pavajeau Cuadro','3003025116','1','5','Calle 23  # 4- 50 APto 935 Conjunto Portal de La loma Barrio paseo del puente Piedecuesta ------( CRA 38 # 61- 22 PISO 2 BARRIO RECREO-BARRANQUILLA)','1');


--
-- Creating index for 'empleados'
--

ALTER TABLE ONLY  public.empleados  ADD CONSTRAINT  empleados_pkey  PRIMARY KEY  (idempleado);

--
-- Estrutura da tabela 'estado_activos'
--

DROP TABLE IF EXISTS estado_activos CASCADE;
CREATE TABLE estado_activos (
id_estadoact varchar(1) NOT NULL,
nombre varchar(20) NOT NULL
);

--
-- Creating data for 'estado_activos'
--

INSERT INTO estado_activos VALUES ('1','Nuevo');
INSERT INTO estado_activos VALUES ('2','Usado');
INSERT INTO estado_activos VALUES ('3','Reparado');
INSERT INTO estado_activos VALUES ('4','Disponible');

--
-- Estrutura da tabela 'estado_empleados'
--

DROP TABLE IF EXISTS estado_empleados CASCADE;
CREATE TABLE estado_empleados (
id_estadoemp varchar(1) NOT NULL,
nombre varchar(20) NOT NULL
);

--
-- Creating data for 'estado_empleados'
--

INSERT INTO estado_empleados VALUES ('1','Activo');
INSERT INTO estado_empleados VALUES ('2','Inactivo');

--
-- Estrutura da tabela 'movimientos'
--

DROP TABLE IF EXISTS movimientos CASCADE;
CREATE TABLE movimientos (
idmovimiento int4 NOT NULL DEFAULT nextval('movimientos_idmovimiento_seq'::regclass),
idempleado varchar(11) NOT NULL,
idactivo varchar(4) NOT NULL,
fechaint date NOT NULL,
fechaout date,
descripcion varchar(2000)
);

--
-- Creating data for 'movimientos'
--

INSERT INTO movimientos VALUES ('2','6','20','2022-10-26','2022-10-26','ESTE ES PRUEBA DE EL REGISTRO DE ACTIVOS');
INSERT INTO movimientos VALUES ('3','3','345','2022-10-31','2022-10-31','nsdjkhjklsehbf');
INSERT INTO movimientos VALUES ('4','3','158','2022-11-01','2022-11-01','ffffdfffffffffffffffffffffffffffffffffffffffffff');
INSERT INTO movimientos VALUES ('5','6','25','2022-11-22','2022-11-22','ESTO ES UNA PRUEBA PARA EL SERVIDOR');
INSERT INTO movimientos VALUES ('6','6','25','2022-11-22','2022-11-22','Se le daño el teclado');
INSERT INTO movimientos VALUES ('7','0','22','2022-11-22','2022-11-22','esta usado pero esta como nuevo. Tiene un buen funcionamiento');
INSERT INTO movimientos VALUES ('8','0','146','2022-11-22','2022-11-22','es un equipo que sera de gran utilidad par el usuario encargado de gestionarlo.');
INSERT INTO movimientos VALUES ('9','0','158','2022-02-01','2022-02-01','el activo se utilizara para ofimatica profesional y cuentas regresivas pendientes.');
INSERT INTO movimientos VALUES ('10','8','22','2022-11-24','2022-11-24','este es un caso de prueba para registrar un activo');
INSERT INTO movimientos VALUES ('11','5','22','2022-11-24','2022-11-24','este dispositivo esta malo, hay que cambiarlo');
INSERT INTO movimientos VALUES ('12','6','25','2022-11-24','2022-11-24','el portatil se cayo de un segundo piso y se le partio la bateria esta en reparacion.');
INSERT INTO movimientos VALUES ('13','0','0','2022-11-24','2022-11-24','el equipo sufrio un daño inesperado');
INSERT INTO movimientos VALUES ('14','3','0','2022-02-20','2022-02-20','el equipo exploto durante una actualizacion');
INSERT INTO movimientos VALUES ('15','0','116','2022-11-29','2022-11-29','Ninguna');
INSERT INTO movimientos VALUES ('16','0','350','2022-11-29','2022-11-29','Equipo sin numero de activo fijo, esta fuera de la oficina ');
INSERT INTO movimientos VALUES ('17','0','252','2022-11-29','2022-11-29','Ninguna');
INSERT INTO movimientos VALUES ('18','0','257','2022-11-29','2022-11-29','Ninguna');
INSERT INTO movimientos VALUES ('19','0','244','2022-11-29','2022-11-29','Ninguna');
INSERT INTO movimientos VALUES ('20','0','347','2022-11-29','2022-11-29','Factura # 9177 alfa canal digital');
INSERT INTO movimientos VALUES ('21','0','271','2022-11-30','2022-11-30','Se realizo cambio de bateria (17/08/2021)');
INSERT INTO movimientos VALUES ('22','0','272','2022-11-30','2022-11-30','Se realizo cambio de bateria Factura FEC No. 2446 (17/08/2021)');
INSERT INTO movimientos VALUES ('23','0','351','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('24','0','281','2022-11-30','2022-11-30','FACTURA # TT232  T Y T ');
INSERT INTO movimientos VALUES ('25','0','282','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('26','0','122','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('27','0','358','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('28','0','344','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('29','0','356','2022-11-30','2022-11-30','Factura 9413');
INSERT INTO movimientos VALUES ('30','0','364','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('31','0','365','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('32','0','367','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('33','0','368','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('34','0','352','2022-11-30','2022-11-30','Factura FVE32');
INSERT INTO movimientos VALUES ('35','0','100','2022-11-30','2022-11-30','Se realiza cambio de bateria y cargador el 09 de sept 2021.');
INSERT INTO movimientos VALUES ('36','0','366','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('37','0','362','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('38','0','110','2022-11-30','2022-11-30','Equipo asignado por prestamo temporal ');
INSERT INTO movimientos VALUES ('39','0','115','2022-11-30','2022-11-30','Equipo en optimas condiciones');
INSERT INTO movimientos VALUES ('40','0','142','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('41','0','268','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('42','0','128','2022-11-30','2022-11-30','Equipo en buen estado');
INSERT INTO movimientos VALUES ('43','0','353','2022-11-30','2022-11-30','Factura FVE33');
INSERT INTO movimientos VALUES ('44','0','354','2022-11-30','2022-11-30','Factura 9413');
INSERT INTO movimientos VALUES ('45','0','355','2022-11-30','2022-11-30','Factura 9413');
INSERT INTO movimientos VALUES ('46','0','357','2022-11-30','2022-11-30','Factura 9414');
INSERT INTO movimientos VALUES ('47','0','361','2022-11-30','2022-11-30','Factura Alkosto W4221001883');
INSERT INTO movimientos VALUES ('48','0','363','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('49','0','369','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('50','0','345','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('51','0','359','2022-11-30','2022-11-30','Equipo comprado en tienda y tecnologia');
INSERT INTO movimientos VALUES ('52','0','134','2022-11-30','2022-11-30','Ninguna');
INSERT INTO movimientos VALUES ('53','0','269','2022-11-30','2022-11-30','SE ENVIA EQUIPO A GARANTIA SEGUN FACTURA # 8479 T Y T - 20 DE MAYO 2020 ');
INSERT INTO movimientos VALUES ('54','1095839818','357','2022-12-01','2022-12-01','El equipo presenta error al iniciar cualquier aplicacion de office 365');
INSERT INTO movimientos VALUES ('55','22222222','999','2022-12-03','2022-12-03','999 pruebas');
INSERT INTO movimientos VALUES ('57','22222222','176','2022-12-05','2022-12-05','el equipo esta es bueno para hacer escaneo de redes informaticas ');
INSERT INTO movimientos VALUES ('58','22222222','9999','2022-12-05','2022-12-05','pruebas');
INSERT INTO movimientos VALUES ('59','1140847441','350','2022-12-14','2022-12-14','pruiebas pruenbas');


--
-- Creating index for 'movimientos'
--

ALTER TABLE ONLY  public.movimientos  ADD CONSTRAINT  movimientos_pkey  PRIMARY KEY  (idmovimiento);

--
-- Estrutura da tabela 'novedades'
--

DROP TABLE IF EXISTS novedades CASCADE;
CREATE TABLE novedades (
id_novedad int4 NOT NULL DEFAULT nextval('novedades_id_novedad_seq'::regclass),
descripcion varchar(2000) NOT NULL,
fecha date NOT NULL,
idactivo varchar(4),
idempleado varchar(11) NOT NULL,
resuelto varchar(2)
);

--
-- Creating data for 'novedades'
--

INSERT INTO novedades VALUES ('10','El equipo presenta error al iniciar cualquier aplicacion de office 365','2022-12-01','357','1095839818','NO');
INSERT INTO novedades VALUES ('11','pruiebas pruenbas','2022-12-14','350','1140847441','NO');


--
-- Creating index for 'novedades'
--

ALTER TABLE ONLY  public.novedades  ADD CONSTRAINT  novedades_pkey  PRIMARY KEY  (id_novedad);


-- Actualizando secuencia admin

ALTER SEQUENCE admin_idadmin_seq RESTART WITH 21;


-- Actualizando secuencia movimientos

ALTER SEQUENCE movimientos_idmovimiento_seq RESTART WITH 60;


-- Actualizando secuencia novedad

ALTER SEQUENCE novedades_id_novedad_seq RESTART WITH 12;
