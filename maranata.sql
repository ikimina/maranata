PGDMP
     2        
            w            maranata    11.5    11.5                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                       false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                       false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                       false                       1262    49277    maranata    DATABASE     ?   CREATE DATABASE maranata WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE maranata;
             postgres    false            ?            1259    49304 
   credential    TABLE     	  CREATE TABLE public.credential (
    id integer NOT NULL,
    user_id character varying(50) NOT NULL,
    username character varying(50) NOT NULL,
    password character varying(150) NOT NULL,
    modified_date timestamp with time zone DEFAULT CURRENT_TIMESTAMP
);
    DROP TABLE public.credential;
       public         postgres    false            ?            1259    49302    credential_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.credential_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.credential_id_seq;
       public       postgres    false    201                       0    0    credential_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.credential_id_seq OWNED BY public.credential.id;
            public       postgres    false    200            ?            1259    49280    members    TABLE     P  CREATE TABLE public.members (
    id integer NOT NULL,
    fname character varying(50) NOT NULL,
    lname character varying(50) NOT NULL,
    sex character varying(20) NOT NULL,
    district character varying(20) NOT NULL,
    sector character varying(20) NOT NULL,
    cell character varying(20) NOT NULL,
    village character varying(20) NOT NULL,
    picture character varying(255) NOT NULL,
    dob character varying(20) NOT NULL,
    phone character varying(20) NOT NULL,
    created_date timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    active character varying(5) NOT NULL
);
    DROP TABLE public.members;
       public         postgres    false            ?            1259    49278    members_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.members_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 %   DROP SEQUENCE public.members_id_seq;
       public       postgres    false    197                       0    0    members_id_seq    SEQUENCE OWNED BY     A   ALTER SEQUENCE public.members_id_seq OWNED BY public.members.id;
            public       postgres    false    196            ?            1259    49292    staff    TABLE     ?  CREATE TABLE public.staff (
    id integer NOT NULL,
    fname character varying(50) NOT NULL,
    lname character varying(50) NOT NULL,
    sex character varying(20) NOT NULL,
    district character varying(20) NOT NULL,
    sector character varying(20) NOT NULL,
    cell character varying(20) NOT NULL,
    village character varying(20) NOT NULL,
    picture character varying(255) NOT NULL,
    dob character varying(20) NOT NULL,
    phone character varying(20) NOT NULL,
    email character varying(50) NOT NULL,
    type character varying(20) NOT NULL,
    created_date timestamp with time zone DEFAULT CURRENT_TIMESTAMP,
    active character varying(5) NOT NULL
);
    DROP TABLE public.staff;
       public         postgres    false            ?            1259    49290    staff_id_seq    SEQUENCE     ?   CREATE SEQUENCE public.staff_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.staff_id_seq;
       public       postgres    false    199                        0    0    staff_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.staff_id_seq OWNED BY public.staff.id;
            public       postgres    false    198            ?
           2604    49307 
   credential id    DEFAULT     n   ALTER TABLE ONLY public.credential ALTER COLUMN id SET DEFAULT nextval('public.credential_id_seq'::regclass);
 <   ALTER TABLE public.credential ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    200    201    201            ?
           2604    49283 
   members id    DEFAULT     h   ALTER TABLE ONLY public.members ALTER COLUMN id SET DEFAULT nextval('public.members_id_seq'::regclass);
 9   ALTER TABLE public.members ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    197    196    197            ?
           2604    49295    staff id    DEFAULT     d   ALTER TABLE ONLY public.staff ALTER COLUMN id SET DEFAULT nextval('public.staff_id_seq'::regclass);
 7   ALTER TABLE public.staff ALTER COLUMN id DROP DEFAULT;
       public       postgres    false    199    198    199                      0    49304 
   credential 
   TABLE DATA               T   COPY public.credential (id, user_id, username, password, modified_date) FROM stdin;
    public       postgres    false    201   ?                 0    49280    members 
   TABLE DATA               ?   COPY public.members (id, fname, lname, sex, district, sector, cell, village, picture, dob, phone, created_date, active) FROM stdin;
    public       postgres    false    197                    0    49292    staff 
   TABLE DATA               ?   COPY public.staff (id, fname, lname, sex, district, sector, cell, village, picture, dob, phone, email, type, created_date, active) FROM stdin;
    public       postgres    false    199   6       !           0    0    credential_id_seq    SEQUENCE SET     @   SELECT pg_catalog.setval('public.credential_id_seq', 1, false);
            public       postgres    false    200            "           0    0    members_id_seq    SEQUENCE SET     =   SELECT pg_catalog.setval('public.members_id_seq', 1, false);
            public       postgres    false    196            #           0    0    staff_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.staff_id_seq', 1, false);
            public       postgres    false    198            ?
           2606    49310    credential credential_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public.credential
    ADD CONSTRAINT credential_pkey PRIMARY KEY (id);
 D   ALTER TABLE ONLY public.credential DROP CONSTRAINT credential_pkey;
       public         postgres    false    201            ?
           2606    49312 "   credential credential_username_key 
   CONSTRAINT     a   ALTER TABLE ONLY public.credential
    ADD CONSTRAINT credential_username_key UNIQUE (username);
 L   ALTER TABLE ONLY public.credential DROP CONSTRAINT credential_username_key;
       public         postgres    false    201            ?
           2606    49289    members members_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public.members
    ADD CONSTRAINT members_pkey PRIMARY KEY (id);
 >   ALTER TABLE ONLY public.members DROP CONSTRAINT members_pkey;
       public         postgres    false    197            ?
           2606    49301    staff staff_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.staff
    ADD CONSTRAINT staff_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.staff DROP CONSTRAINT staff_pkey;
       public         postgres    false    199               
   x?????? ? ?         
   x?????? ? ?         
   x?????? ? ?     