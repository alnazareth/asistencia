--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: asistencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asistencia (
    id_asistencia integer NOT NULL,
    fecha date NOT NULL,
    hentra_ma time without time zone NOT NULL,
    hsali_ma time without time zone NOT NULL,
    hentra_ta time without time zone NOT NULL,
    hsali_ta time without time zone NOT NULL,
    id_pe integer NOT NULL
);


ALTER TABLE public.asistencia OWNER TO postgres;

--
-- Name: asistencia_id_asistencia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE asistencia_id_asistencia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.asistencia_id_asistencia_seq OWNER TO postgres;

--
-- Name: asistencia_id_asistencia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE asistencia_id_asistencia_seq OWNED BY asistencia.id_asistencia;


--
-- Name: auditoria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE auditoria (
    id_au integer NOT NULL,
    fecha date NOT NULL,
    hora character varying NOT NULL,
    accion character varying NOT NULL,
    id_u integer NOT NULL
);


ALTER TABLE public.auditoria OWNER TO postgres;

--
-- Name: auditoria_id_au_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE auditoria_id_au_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.auditoria_id_au_seq OWNER TO postgres;

--
-- Name: auditoria_id_au_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE auditoria_id_au_seq OWNED BY auditoria.id_au;


--
-- Name: horario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE horario (
    id integer NOT NULL,
    hora_entra_ma time without time zone NOT NULL,
    hora_sali_ma time without time zone NOT NULL,
    hora_entra_ta time without time zone NOT NULL,
    hora_sali_ta time without time zone NOT NULL
);


ALTER TABLE public.horario OWNER TO postgres;

--
-- Name: horario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE horario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.horario_id_seq OWNER TO postgres;

--
-- Name: horario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE horario_id_seq OWNED BY horario.id;


--
-- Name: permiso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE permiso (
    id_permiso integer NOT NULL,
    id_pers integer NOT NULL,
    fecha_ini date NOT NULL,
    fecha_fin date NOT NULL
);


ALTER TABLE public.permiso OWNER TO postgres;

--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE permiso_id_permiso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.permiso_id_permiso_seq OWNER TO postgres;

--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE permiso_id_permiso_seq OWNED BY permiso.id_permiso;


--
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE persona (
    id integer NOT NULL,
    cedu_pers numeric,
    nomb_pers character varying,
    apel_pers character varying,
    sexo_pers character varying,
    dire_pers character varying,
    tele_pers numeric,
    eciv_pers character varying,
    corr_pers character varying,
    carg_pers character varying,
    estatu_per character varying,
    fecha_registro date
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- Name: persona_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE persona_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_id_seq OWNER TO postgres;

--
-- Name: persona_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE persona_id_seq OWNED BY persona.id;


--
-- Name: personal; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW personal AS
 SELECT persona.cedu_pers AS cedula,
    persona.nomb_pers AS nombre,
    persona.apel_pers AS apellido,
    persona.sexo_pers AS sexo,
    persona.dire_pers AS direccion,
    persona.tele_pers AS telefono,
    persona.eciv_pers AS "estado civil",
    persona.corr_pers AS correo
   FROM persona
  WHERE ((persona.nomb_pers)::text ~~* 'a%'::text)
  ORDER BY persona.nomb_pers;


ALTER TABLE public.personal OWNER TO postgres;

--
-- Name: personal masculino; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW "personal masculino" AS
 SELECT count(*) AS "cantidad de masculinos"
   FROM persona
  WHERE ((persona.sexo_pers)::text = 'masculino'::text);


ALTER TABLE public."personal masculino" OWNER TO postgres;

--
-- Name: sesion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sesion (
    id_se integer NOT NULL,
    fecha_en date,
    hora_en character varying,
    fecha_sa date,
    hora_sa character varying,
    tipo character varying,
    id_usu integer NOT NULL
);


ALTER TABLE public.sesion OWNER TO postgres;

--
-- Name: sesion_id_se_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sesion_id_se_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.sesion_id_se_seq OWNER TO postgres;

--
-- Name: sesion_id_se_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sesion_id_se_seq OWNED BY sesion.id_se;


--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    id integer NOT NULL,
    clav_usua character varying,
    logn_usua character varying,
    codi_pers integer,
    tipo_usua character varying,
    pregunta character varying,
    respuesta character varying,
    estatus_usu character varying
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuario_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.usuario_id_seq OWNER TO postgres;

--
-- Name: usuario_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuario_id_seq OWNED BY usuario.id;


--
-- Name: id_asistencia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asistencia ALTER COLUMN id_asistencia SET DEFAULT nextval('asistencia_id_asistencia_seq'::regclass);


--
-- Name: id_au; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auditoria ALTER COLUMN id_au SET DEFAULT nextval('auditoria_id_au_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY horario ALTER COLUMN id SET DEFAULT nextval('horario_id_seq'::regclass);


--
-- Name: id_permiso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso ALTER COLUMN id_permiso SET DEFAULT nextval('permiso_id_permiso_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY persona ALTER COLUMN id SET DEFAULT nextval('persona_id_seq'::regclass);


--
-- Name: id_se; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sesion ALTER COLUMN id_se SET DEFAULT nextval('sesion_id_se_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario ALTER COLUMN id SET DEFAULT nextval('usuario_id_seq'::regclass);


--
-- Data for Name: asistencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY asistencia (id_asistencia, fecha, hentra_ma, hsali_ma, hentra_ta, hsali_ta, id_pe) FROM stdin;
30	2017-05-09	00:00:00	00:00:00	03:25:00	03:29:00	14
31	2017-05-10	00:00:00	00:00:00	10:22:00	10:52:00	14
32	2017-05-11	10:19:00	00:00:00	00:00:00	00:00:00	14
\.


--
-- Name: asistencia_id_asistencia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asistencia_id_asistencia_seq', 32, true);


--
-- Data for Name: auditoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY auditoria (id_au, fecha, hora, accion, id_u) FROM stdin;
34	2016-10-19	9:10 PM	Modifico el Estatus del Usuario ( jorge )	2
35	2016-10-19	9:16 PM	Modifico el Estatus del Usuario ( antonel )	2
36	2016-10-19	9:16 PM	Modifico el Estatus del Usuario ( ruben )	2
37	2016-10-19	9:16 PM	Modifico el Estatus del Usuario ( juana )	2
38	2016-10-19	9:17 PM	Modifico el Estatus del Usuario ( juan )	2
39	2016-10-19	9:17 PM	Modifico el Estatus del Usuario ( dfzgbfd )	2
40	2017-05-09	11:26 AM	Registro un Permiso ( 22926602 )	9
41	2017-05-09	1:10 PM	Registro un Usuario ( laura )	9
42	2017-05-11	3:31 PM	Registro un Usuario ( lorennys )	9
43	2017-05-11	3:32 PM	Registro un Usuario ( raquel )	9
\.


--
-- Name: auditoria_id_au_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('auditoria_id_au_seq', 43, true);


--
-- Data for Name: horario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY horario (id, hora_entra_ma, hora_sali_ma, hora_entra_ta, hora_sali_ta) FROM stdin;
1	08:00:00	11:00:00	02:30:00	05:00:00
\.


--
-- Name: horario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('horario_id_seq', 1, true);


--
-- Data for Name: permiso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY permiso (id_permiso, id_pers, fecha_ini, fecha_fin) FROM stdin;
7	13	2017-05-09	2017-05-13
\.


--
-- Name: permiso_id_permiso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('permiso_id_permiso_seq', 7, true);


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY persona (id, cedu_pers, nomb_pers, apel_pers, sexo_pers, dire_pers, tele_pers, eciv_pers, corr_pers, carg_pers, estatu_per, fecha_registro) FROM stdin;
3	25622647	juan	m	masculino	tacoa	4123457689	soltero	juancito@hotmail.com	administrativo	bloqueado	2016-01-01
15	20375609	braulio	malave	masculino	calle venezuela	4260841031	comcubinato	carlosmalave@gmail.com	obrero	activo	2017-05-10
1	24841343	ruben	gonzalez	masculino	el lirio	4141927516	concubinato	rubendgn28@gmail.com	tesorero	activo	2016-01-01
7	2	n	m	masculino	e3	22	soltero	33@gmail.com	obrero	bloqueado	2016-01-01
9	1234	asdasdasd	q123	masculino	123	123	soltero	123@g	obrero	bloqueado	2016-05-22
8	1	n	m	masculino	e3	22	soltero	33@gmail.com	docente	bloqueado	2016-01-01
2	24841407	jose	marcano	masculino	canchunchu	4164933320	soltero	jose_marcano-15@hotmail.com	administrativo	activo	2016-01-01
13	22926602	carlos	malave	macho	calle ecuador	4167139071	activo	carlosmalavea@gmail.com	administrativo	activo	2017-05-04
5	26444857	antonela	garones	femenino	casanay	4240901876	soltera	antonela_17@gmail.com	obrero	bloqueado	2016-01-01
12	1655236	pepe	aguilar	masculino	caracas	4165827569	divorciado	pepito_elmalito@hotmail.com	obrero	activo	2016-06-05
4	24332256	fernanda	ferrer	femenino	maturin	4160098789	concubinato	fer_ferrer@gmail.com	docente	bloqueado	2016-01-01
10	25644553	juana	ribera	femenino	san carlosads	416440987	concubinato	ribera@hotmail.com	docente	bloqueado	2016-05-25
14	25658401	laura	lista	femenino	calle venezuela	4262819115	soltero	lauralista701@hotmail.com	docente	activo	2017-05-09
11	27711231	jorge	mujica	masculino	kdsfd	12313232132	soltero	xjorgex147@hotmail.com	administrativo	activo	2016-06-04
16	1234567	lorennys	marcano	femenino	unea 	4260841031	soltero	lorennys@gmail.com	administrativo	activo	2017-05-11
17	1233456	raquel	avila	femenino	unea 	4260841031	casado	raquelavila@gmail.com	administrativo	activo	2017-05-11
\.


--
-- Name: persona_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('persona_id_seq', 17, true);


--
-- Data for Name: sesion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sesion (id_se, fecha_en, hora_en, fecha_sa, hora_sa, tipo, id_usu) FROM stdin;
56	2016-10-19	9:15 PM	2016-10-19	9:15 PM	Salida	2
57	2016-10-19	9:15 PM	2016-10-19	9:21 PM	Salina	2
58	2016-10-19	9:21 PM	\N	\N	Entrada	2
59	2017-05-04	8:50 PM	2017-05-04	9:01 PM	Salina	9
60	2017-05-04	9:01 PM	2017-05-08	1:29 PM	Salina	9
61	2017-05-08	1:29 PM	2017-05-08	2:49 PM	Salina	9
62	2017-05-08	2:49 PM	2017-05-08	7:40 PM	Salina	9
63	2017-05-08	7:40 PM	2017-05-08	7:49 PM	Salina	9
64	2017-05-08	7:49 PM	2017-05-08	9:37 PM	Salina	9
65	2017-05-08	9:37 PM	2017-05-08	10:11 PM	Salina	9
66	2017-05-08	10:11 PM	2017-05-09	06:21 AM	Salina	9
67	2017-05-09	06:21 AM	2017-05-09	06:55 AM	Salida	9
68	2017-05-09	06:56 AM	2017-05-09	07:04 AM	Salina	9
69	2017-05-09	07:04 AM	2017-05-09	08:46 AM	Salina	9
70	2017-05-09	08:46 AM	2017-05-09	12:58 AM	Salina	9
71	2017-05-09	12:58 AM	2017-05-09	1:11 PM	Salida	9
72	2017-05-09	1:11 PM	2017-05-09	2:10 PM	Salida	10
73	2017-05-09	2:10 PM	2017-05-09	2:24 PM	Salida	9
74	2017-05-09	2:39 PM	2017-05-09	2:42 PM	Salida	9
75	2017-05-09	2:58 PM	2017-05-09	3:09 PM	Salida	9
76	2017-05-09	3:09 PM	2017-05-09	3:12 PM	Salida	10
77	2017-05-09	3:12 PM	2017-05-09	3:24 PM	Salida	9
78	2017-05-09	3:25 PM	2017-05-10	10:22 PM	Salina	9
79	2017-05-10	10:22 PM	2017-05-10	10:50 PM	Salida	9
80	2017-05-10	10:53 PM	2017-05-10	10:58 PM	Salida	9
82	2017-05-11	10:20 AM	2017-05-11	11:12 AM	Salida	9
83	2017-05-11	11:28 AM	2017-05-11	11:30 AM	Salida	9
84	2017-05-11	11:39 AM	2017-05-11	12:31 AM	Salina	9
85	2017-05-11	12:31 AM	2017-05-11	12:54 AM	Salida	9
81	2017-05-10	10:58 PM	2017-05-11	12:54 AM	Salina	10
86	2017-05-11	12:54 AM	2017-05-11	12:54 AM	Salida	10
87	2017-05-11	1:37 PM	2017-05-11	2:47 PM	Salina	9
88	2017-05-11	2:47 PM	2017-05-11	3:02 PM	Salina	9
89	2017-05-11	3:02 PM	2017-05-11	3:08 PM	Salida	9
91	2017-05-11	3:27 PM	2017-05-11	3:34 PM	Salida	9
90	2017-05-11	3:08 PM	2017-05-11	3:34 PM	Salina	10
92	2017-05-11	3:34 PM	2017-05-11	3:36 PM	Salida	10
93	2017-05-11	3:37 PM	2017-05-11	3:37 PM	Salida	11
94	2017-05-11	3:37 PM	\N	\N	Entrada	12
\.


--
-- Name: sesion_id_se_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sesion_id_se_seq', 94, true);


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (id, clav_usua, logn_usua, codi_pers, tipo_usua, pregunta, respuesta, estatus_usu) FROM stdin;
4	MTIzNA==	fernanda	4	Usuario	\N	\N	bloquado
7	MTIzNDU2Nzg=	jorge	11	Usuario	¿cual es el nombre de tu madre?	petra	bloquado
5	MTIzNA==	antonel	5	Usuario	\N	\N	bloquado
1	MTIzNDU2Nzg=	ruben	1	Usuario	\N	\N	bloquado
6	MTIzNDU2Nzg=	juana	10	Usuario	nombre de mama?	petra	bloquado
8	YXNmZ2Y=	dfzgbfd	12	Usuario	¿nombre de mi mascota?	pepe	bloquado
2	12345678	jose	2	administrador	\N	\N	Activo
3	anVhbk11amljYTEy	juan	3	administrador	\N	\N	bloqueado
9	bWlvbm90dXlv	carlos	13	administrador			Activo
10	MTIzNDU2Nzg=	laura	14	Usuario	¿nombre de mi madre?	aura	Activo
12	MTIzNDU2Nzg=	raquel	17	Usuario	¿nombre de mi madre?	raquel	Activo
11	MTIzNDU2Nzg=	lorannys	16	administrador	¿programa favorito de televicion?	globovision	Activo
\.


--
-- Name: usuario_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuario_id_seq', 12, true);


--
-- Name: asistencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_pkey PRIMARY KEY (id_asistencia);


--
-- Name: auditoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT auditoria_pkey PRIMARY KEY (id_au);


--
-- Name: horario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY horario
    ADD CONSTRAINT horario_pkey PRIMARY KEY (id);


--
-- Name: permiso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY permiso
    ADD CONSTRAINT permiso_pkey PRIMARY KEY (id_permiso);


--
-- Name: persona_cedu_pers_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_cedu_pers_key UNIQUE (cedu_pers);


--
-- Name: persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id);


--
-- Name: sesion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_pkey PRIMARY KEY (id_se);


--
-- Name: usuario_logn_usua_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_logn_usua_key UNIQUE (logn_usua);


--
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id);


--
-- Name: asistencia_id_pe_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asistencia
    ADD CONSTRAINT asistencia_id_pe_fkey FOREIGN KEY (id_pe) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: auditoria_id_u_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY auditoria
    ADD CONSTRAINT auditoria_id_u_fkey FOREIGN KEY (id_u) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: permiso_cedula_p_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY permiso
    ADD CONSTRAINT permiso_cedula_p_fkey FOREIGN KEY (id_pers) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: sesion_id_usu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sesion
    ADD CONSTRAINT sesion_id_usu_fkey FOREIGN KEY (id_usu) REFERENCES usuario(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: usuario_codi_pers_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_codi_pers_fkey FOREIGN KEY (codi_pers) REFERENCES persona(id) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

