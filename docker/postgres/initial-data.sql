/* PRODUCTS */
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

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_pkey PRIMARY KEY (product_id);

CREATE SEQUENCE public.products_product_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_product_id_seq OWNER TO postgres;

ALTER SEQUENCE public.products_product_id_seq OWNED BY public.products.product_id;

ALTER TABLE ONLY public.products ALTER COLUMN product_id SET DEFAULT nextval('public.products_product_id_seq'::regclass);

/* IMAGES FOR PRODUCTS */

CREATE TABLE public.products_images (
    product_image_id integer NOT NULL,
    product_id integer NOT NULL,
    file character varying NOT NULL
);


ALTER TABLE public.products_images OWNER TO postgres;

ALTER TABLE ONLY public.products_images
    ADD CONSTRAINT products_images_pkey PRIMARY KEY (product_image_id);

CREATE SEQUENCE public.products_images_product_image_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_images_product_image_id_seq OWNER TO postgres;

ALTER SEQUENCE public.products_images_product_image_id_seq OWNED BY public.products_images.product_image_id;

ALTER TABLE ONLY public.products_images ALTER COLUMN product_image_id SET DEFAULT nextval('public.products_images_product_image_id_seq'::regclass);


/* RATES FOR PRODUCTS */
CREATE TABLE public.products_rates (
    product_rate_id integer NOT NULL,
    product_id integer NOT NULL,
    user_id integer NOT NULL,
    value smallint NOT NULL
);


ALTER TABLE public.products_rates OWNER TO postgres;


CREATE SEQUENCE public.products_rates_product_rate_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_rates_product_rate_id_seq OWNER TO postgres;

ALTER SEQUENCE public.products_rates_product_rate_id_seq OWNED BY public.products_rates.product_rate_id;

ALTER TABLE ONLY public.products_rates ALTER COLUMN product_rate_id SET DEFAULT nextval('public.products_rates_product_rate_id_seq'::regclass);


/* ROLES OF USERS */
CREATE TABLE public.roles (
    role_id integer NOT NULL,
    name character varying(16)
);


ALTER TABLE public.roles OWNER TO postgres;

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (role_id);

CREATE SEQUENCE public.roles_role_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_role_id_seq OWNER TO postgres;

ALTER SEQUENCE public.roles_role_id_seq OWNED BY public.roles.role_id;

ALTER TABLE ONLY public.roles ALTER COLUMN role_id SET DEFAULT nextval('public.roles_role_id_seq'::regclass);


INSERT INTO public.roles (role_id, name) VALUES (1, 'standard');
INSERT INTO public.roles (role_id, name) VALUES (2, 'admin');


/* USERS */
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


ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);


ALTER TABLE ONLY public.users
    ADD CONSTRAINT register UNIQUE (email, username);

CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_user_id_seq OWNER TO postgres;


ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;


ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);


INSERT INTO public.users (user_id, username, avatar, email, password, role_id, created_date, modified_date) VALUES (1, 'admin', NULL, 'admin@only-buy.com', '$2y$10$CCz2LXxnAhJB0yEfMGdxluqyuC20.G98DMLn9whWtyLUnlnT9s9aO', 2, '2023-06-05', '2023-06-05');
INSERT INTO public.users (user_id, username, avatar, email, password, role_id, created_date, modified_date) VALUES (2, 'only-buy', NULL, 'only-buy@only-buy.com', '$2y$10$CCz2LXxnAhJB0yEfMGdxluqyuC20.G98DMLn9whWtyLUnlnT9s9aO', 1, '2023-06-05', '2023-06-05');

/* FOREIGN KEYS - USERS */
ALTER TABLE public.users
ADD FOREIGN KEY (role_id) REFERENCES roles(role_id);

/* FOREIGN KEYS - RATES OF PRODUCTS */
ALTER TABLE public.products_rates
ADD FOREIGN KEY (product_id) REFERENCES products(product_id);

ALTER TABLE public.products_rates
ADD FOREIGN KEY (user_id) REFERENCES users(user_id);

/* FOREIGN KEYS - IMAGES OF PRODUCTS */
ALTER TABLE public.products_images
ADD FOREIGN KEY (product_id) REFERENCES products(product_id);