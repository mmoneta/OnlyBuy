--
-- PostgreSQL database dump
--

-- Dumped from database version 15.3
-- Dumped by pg_dump version 15.3

-- Started on 2023-06-29 15:12:56

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE "only-buy";
--
-- TOC entry 3367 (class 1262 OID 16398)
-- Name: only-buy; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE "only-buy" WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Polish_Poland.1250';


ALTER DATABASE "only-buy" OWNER TO postgres;

\connect -reuse-previous=on "dbname='only-buy'"

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 221 (class 1259 OID 16436)
-- Name: products; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products (
    product_id integer NOT NULL,
    name character varying NOT NULL,
    description character varying NOT NULL,
    is_active boolean NOT NULL,
    is_promo boolean NOT NULL,
    created_date date NOT NULL,
    modified_date date NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- TOC entry 219 (class 1259 OID 16427)
-- Name: products_images; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products_images (
    product_image_id integer NOT NULL,
    product_id integer NOT NULL,
    file character varying NOT NULL
);


ALTER TABLE public.products_images OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16426)
-- Name: products_images_product_image_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_images_product_image_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_images_product_image_id_seq OWNER TO postgres;

--
-- TOC entry 3368 (class 0 OID 0)
-- Dependencies: 218
-- Name: products_images_product_image_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_images_product_image_id_seq OWNED BY public.products_images.product_image_id;


--
-- TOC entry 220 (class 1259 OID 16435)
-- Name: products_product_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_product_id_seq OWNER TO postgres;

--
-- TOC entry 3369 (class 0 OID 0)
-- Dependencies: 220
-- Name: products_product_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_product_id_seq OWNED BY public.products.product_id;


--
-- TOC entry 217 (class 1259 OID 16420)
-- Name: products_rates; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.products_rates (
    product_rate_id integer NOT NULL,
    product_id integer NOT NULL,
    user_id integer NOT NULL,
    value smallint NOT NULL
);


ALTER TABLE public.products_rates OWNER TO postgres;

--
-- TOC entry 216 (class 1259 OID 16419)
-- Name: products_rates_product_rate_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_rates_product_rate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_rates_product_rate_id_seq OWNER TO postgres;

--
-- TOC entry 3370 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_rates_product_rate_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_rates_product_rate_id_seq OWNED BY public.products_rates.product_rate_id;


--
-- TOC entry 215 (class 1259 OID 16413)
-- Name: roles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.roles (
    role_id integer NOT NULL,
    name character varying(16)
);


ALTER TABLE public.roles OWNER TO postgres;

--
-- TOC entry 214 (class 1259 OID 16412)
-- Name: roles_role_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.roles_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_role_id_seq OWNER TO postgres;

--
-- TOC entry 3371 (class 0 OID 0)
-- Dependencies: 214
-- Name: roles_role_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.roles_role_id_seq OWNED BY public.roles.role_id;


--
-- TOC entry 223 (class 1259 OID 16447)
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    user_id integer NOT NULL,
    username character varying,
    avatar character varying,
    email character varying,
    password character varying NOT NULL,
    role_id smallint NOT NULL,
    created_date date NOT NULL,
    modified_date date NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 16446)
-- Name: users_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO postgres;

--
-- TOC entry 3372 (class 0 OID 0)
-- Dependencies: 222
-- Name: users_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


--
-- TOC entry 3196 (class 2604 OID 16439)
-- Name: products product_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN product_id SET DEFAULT nextval('public.products_product_id_seq'::regclass);


--
-- TOC entry 3195 (class 2604 OID 16430)
-- Name: products_images product_image_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products_images ALTER COLUMN product_image_id SET DEFAULT nextval('public.products_images_product_image_id_seq'::regclass);


--
-- TOC entry 3194 (class 2604 OID 16423)
-- Name: products_rates product_rate_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products_rates ALTER COLUMN product_rate_id SET DEFAULT nextval('public.products_rates_product_rate_id_seq'::regclass);


--
-- TOC entry 3193 (class 2604 OID 16416)
-- Name: roles role_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.roles ALTER COLUMN role_id SET DEFAULT nextval('public.roles_role_id_seq'::regclass);


--
-- TOC entry 3197 (class 2604 OID 16450)
-- Name: users user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


--
-- TOC entry 3359 (class 0 OID 16436)
-- Dependencies: 221
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3357 (class 0 OID 16427)
-- Dependencies: 219
-- Data for Name: products_images; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3355 (class 0 OID 16420)
-- Dependencies: 217
-- Data for Name: products_rates; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 3353 (class 0 OID 16413)
-- Dependencies: 215
-- Data for Name: roles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.roles (role_id, name) VALUES (1, 'standard');
INSERT INTO public.roles (role_id, name) VALUES (2, 'admin');


--
-- TOC entry 3361 (class 0 OID 16447)
-- Dependencies: 223
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.users (user_id, username, avatar, email, password, role_id, created_date, modified_date) VALUES (1, 'admin', NULL, 'admin@only-buy.com', '$2y$10$CCz2LXxnAhJB0yEfMGdxluqyuC20.G98DMLn9whWtyLUnlnT9s9aO', 2, '2023-06-05', '2023-06-05');
INSERT INTO public.users (user_id, username, avatar, email, password, role_id, created_date, modified_date) VALUES (2, 'only-buy', NULL, 'only-buy@only-buy.com', '$2y$10$CCz2LXxnAhJB0yEfMGdxluqyuC20.G98DMLn9whWtyLUnlnT9s9aO', 1, '2023-06-05', '2023-06-05');


--
-- TOC entry 3373 (class 0 OID 0)
-- Dependencies: 218
-- Name: products_images_product_image_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_images_product_image_id_seq', 1, false);


--
-- TOC entry 3374 (class 0 OID 0)
-- Dependencies: 220
-- Name: products_product_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_product_id_seq', 1, false);


--
-- TOC entry 3375 (class 0 OID 0)
-- Dependencies: 216
-- Name: products_rates_product_rate_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_rates_product_rate_id_seq', 1, false);


--
-- TOC entry 3376 (class 0 OID 0)
-- Dependencies: 214
-- Name: roles_role_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.roles_role_id_seq', 2, true);


--
-- TOC entry 3377 (class 0 OID 0)
-- Dependencies: 222
-- Name: users_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_user_id_seq', 2, true);


-- Completed on 2023-06-29 15:12:56

--
-- PostgreSQL database dump complete
--

