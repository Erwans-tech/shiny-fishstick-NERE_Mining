--
-- PostgreSQL database dump
--

\restrict su263ib0C3QszhFHv8ZCF3UUyPuUlGPXoeEAkLaoj0ZDhoAd4EA5LwnqFjp5NIo

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE IF EXISTS ONLY public.job_applications DROP CONSTRAINT IF EXISTS job_applications_job_offer_id_foreign;
DROP INDEX IF EXISTS public.site_analytics_visited_referrer_idx;
DROP INDEX IF EXISTS public.site_analytics_visited_page_idx;
DROP INDEX IF EXISTS public.site_analytics_visited_device_idx;
DROP INDEX IF EXISTS public.site_analytics_visited_at_index;
DROP INDEX IF EXISTS public.site_analytics_page_url_index;
DROP INDEX IF EXISTS public.site_analytics_device_type_index;
DROP INDEX IF EXISTS public.sessions_user_id_index;
DROP INDEX IF EXISTS public.sessions_last_activity_index;
DROP INDEX IF EXISTS public.reports_published_at_index;
DROP INDEX IF EXISTS public.press_documents_published_at_index;
DROP INDEX IF EXISTS public.news_published_at_index;
DROP INDEX IF EXISTS public.jobs_queue_index;
DROP INDEX IF EXISTS public.failed_jobs_connection_queue_failed_at_index;
DROP INDEX IF EXISTS public.cache_locks_expiration_index;
DROP INDEX IF EXISTS public.cache_expiration_index;
ALTER TABLE IF EXISTS ONLY public.users DROP CONSTRAINT IF EXISTS users_public_uuid_unique;
ALTER TABLE IF EXISTS ONLY public.users DROP CONSTRAINT IF EXISTS users_pkey;
ALTER TABLE IF EXISTS ONLY public.users DROP CONSTRAINT IF EXISTS users_email_unique;
ALTER TABLE IF EXISTS ONLY public.site_settings DROP CONSTRAINT IF EXISTS site_settings_pkey;
ALTER TABLE IF EXISTS ONLY public.site_settings DROP CONSTRAINT IF EXISTS site_settings_key_unique;
ALTER TABLE IF EXISTS ONLY public.site_analytics DROP CONSTRAINT IF EXISTS site_analytics_pkey;
ALTER TABLE IF EXISTS ONLY public.sessions DROP CONSTRAINT IF EXISTS sessions_pkey;
ALTER TABLE IF EXISTS ONLY public.reports DROP CONSTRAINT IF EXISTS reports_pkey;
ALTER TABLE IF EXISTS ONLY public.press_documents DROP CONSTRAINT IF EXISTS press_documents_pkey;
ALTER TABLE IF EXISTS ONLY public.password_reset_tokens DROP CONSTRAINT IF EXISTS password_reset_tokens_pkey;
ALTER TABLE IF EXISTS ONLY public.partners DROP CONSTRAINT IF EXISTS partners_pkey;
ALTER TABLE IF EXISTS ONLY public.newsletter_subscribers DROP CONSTRAINT IF EXISTS newsletter_subscribers_pkey;
ALTER TABLE IF EXISTS ONLY public.newsletter_subscribers DROP CONSTRAINT IF EXISTS newsletter_subscribers_email_unique;
ALTER TABLE IF EXISTS ONLY public.news DROP CONSTRAINT IF EXISTS news_slug_unique;
ALTER TABLE IF EXISTS ONLY public.news DROP CONSTRAINT IF EXISTS news_pkey;
ALTER TABLE IF EXISTS ONLY public.migrations DROP CONSTRAINT IF EXISTS migrations_pkey;
ALTER TABLE IF EXISTS ONLY public.media_assets DROP CONSTRAINT IF EXISTS media_assets_pkey;
ALTER TABLE IF EXISTS ONLY public.leadership_members DROP CONSTRAINT IF EXISTS leadership_members_pkey;
ALTER TABLE IF EXISTS ONLY public.karma_departments DROP CONSTRAINT IF EXISTS karma_departments_pkey;
ALTER TABLE IF EXISTS ONLY public.jobs DROP CONSTRAINT IF EXISTS jobs_pkey;
ALTER TABLE IF EXISTS ONLY public.job_offers DROP CONSTRAINT IF EXISTS job_offers_slug_unique;
ALTER TABLE IF EXISTS ONLY public.job_offers DROP CONSTRAINT IF EXISTS job_offers_pkey;
ALTER TABLE IF EXISTS ONLY public.job_batches DROP CONSTRAINT IF EXISTS job_batches_pkey;
ALTER TABLE IF EXISTS ONLY public.job_applications DROP CONSTRAINT IF EXISTS job_applications_pkey;
ALTER TABLE IF EXISTS ONLY public.hero_slides DROP CONSTRAINT IF EXISTS hero_slides_pkey;
ALTER TABLE IF EXISTS ONLY public.failed_jobs DROP CONSTRAINT IF EXISTS failed_jobs_uuid_unique;
ALTER TABLE IF EXISTS ONLY public.failed_jobs DROP CONSTRAINT IF EXISTS failed_jobs_pkey;
ALTER TABLE IF EXISTS ONLY public.contact_messages DROP CONSTRAINT IF EXISTS contact_messages_pkey;
ALTER TABLE IF EXISTS ONLY public.certifications DROP CONSTRAINT IF EXISTS certifications_pkey;
ALTER TABLE IF EXISTS ONLY public.cache DROP CONSTRAINT IF EXISTS cache_pkey;
ALTER TABLE IF EXISTS ONLY public.cache_locks DROP CONSTRAINT IF EXISTS cache_locks_pkey;
ALTER TABLE IF EXISTS public.users ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.site_settings ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.site_analytics ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.reports ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.press_documents ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.partners ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.newsletter_subscribers ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.news ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.migrations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.media_assets ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.leadership_members ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.karma_departments ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.jobs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.job_offers ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.job_applications ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.hero_slides ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.failed_jobs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.contact_messages ALTER COLUMN id DROP DEFAULT;
ALTER TABLE IF EXISTS public.certifications ALTER COLUMN id DROP DEFAULT;
DROP SEQUENCE IF EXISTS public.users_id_seq;
DROP TABLE IF EXISTS public.users;
DROP SEQUENCE IF EXISTS public.site_settings_id_seq;
DROP TABLE IF EXISTS public.site_settings;
DROP SEQUENCE IF EXISTS public.site_analytics_id_seq;
DROP TABLE IF EXISTS public.site_analytics;
DROP TABLE IF EXISTS public.sessions;
DROP SEQUENCE IF EXISTS public.reports_id_seq;
DROP TABLE IF EXISTS public.reports;
DROP SEQUENCE IF EXISTS public.press_documents_id_seq;
DROP TABLE IF EXISTS public.press_documents;
DROP TABLE IF EXISTS public.password_reset_tokens;
DROP SEQUENCE IF EXISTS public.partners_id_seq;
DROP TABLE IF EXISTS public.partners;
DROP SEQUENCE IF EXISTS public.newsletter_subscribers_id_seq;
DROP TABLE IF EXISTS public.newsletter_subscribers;
DROP SEQUENCE IF EXISTS public.news_id_seq;
DROP TABLE IF EXISTS public.news;
DROP SEQUENCE IF EXISTS public.migrations_id_seq;
DROP TABLE IF EXISTS public.migrations;
DROP SEQUENCE IF EXISTS public.media_assets_id_seq;
DROP TABLE IF EXISTS public.media_assets;
DROP SEQUENCE IF EXISTS public.leadership_members_id_seq;
DROP TABLE IF EXISTS public.leadership_members;
DROP SEQUENCE IF EXISTS public.karma_departments_id_seq;
DROP TABLE IF EXISTS public.karma_departments;
DROP SEQUENCE IF EXISTS public.jobs_id_seq;
DROP TABLE IF EXISTS public.jobs;
DROP SEQUENCE IF EXISTS public.job_offers_id_seq;
DROP TABLE IF EXISTS public.job_offers;
DROP TABLE IF EXISTS public.job_batches;
DROP SEQUENCE IF EXISTS public.job_applications_id_seq;
DROP TABLE IF EXISTS public.job_applications;
DROP SEQUENCE IF EXISTS public.hero_slides_id_seq;
DROP TABLE IF EXISTS public.hero_slides;
DROP SEQUENCE IF EXISTS public.failed_jobs_id_seq;
DROP TABLE IF EXISTS public.failed_jobs;
DROP SEQUENCE IF EXISTS public.contact_messages_id_seq;
DROP TABLE IF EXISTS public.contact_messages;
DROP SEQUENCE IF EXISTS public.certifications_id_seq;
DROP TABLE IF EXISTS public.certifications;
DROP TABLE IF EXISTS public.cache_locks;
DROP TABLE IF EXISTS public.cache;
SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: cache; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration bigint NOT NULL
);


--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration bigint NOT NULL
);


--
-- Name: certifications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.certifications (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    description text,
    logo_path character varying(255),
    issued_at date,
    expires_at date,
    sort_order integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: certifications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.certifications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: certifications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.certifications_id_seq OWNED BY public.certifications.id;


--
-- Name: contact_messages; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.contact_messages (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    subject character varying(255),
    type character varying(60) DEFAULT 'general'::character varying NOT NULL,
    message text NOT NULL,
    read_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    status character varying(255) DEFAULT 'new'::character varying NOT NULL,
    admin_notes text,
    CONSTRAINT contact_messages_status_check CHECK (((status)::text = ANY (ARRAY[('new'::character varying)::text, ('reviewing'::character varying)::text, ('replied'::character varying)::text, ('archived'::character varying)::text])))
);


--
-- Name: contact_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.contact_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: contact_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.contact_messages_id_seq OWNED BY public.contact_messages.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection character varying(255) NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: hero_slides; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.hero_slides (
    id bigint NOT NULL,
    title character varying(160),
    caption character varying(255),
    image_path character varying(255),
    is_active boolean DEFAULT true NOT NULL,
    sort_order smallint DEFAULT '0'::smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    type character varying(10) DEFAULT 'image'::character varying NOT NULL,
    video_url character varying(500)
);


--
-- Name: hero_slides_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.hero_slides_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: hero_slides_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.hero_slides_id_seq OWNED BY public.hero_slides.id;


--
-- Name: job_applications; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_applications (
    id bigint NOT NULL,
    job_offer_id bigint NOT NULL,
    first_name character varying(255) NOT NULL,
    last_name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    phone character varying(40),
    nationality character varying(80),
    current_position character varying(160),
    experience_years character varying(40),
    motivation text NOT NULL,
    cv_path character varying(255),
    cover_letter_path character varying(255),
    status character varying(255) DEFAULT 'new'::character varying NOT NULL,
    admin_notes text,
    read_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT job_applications_status_check CHECK (((status)::text = ANY (ARRAY[('new'::character varying)::text, ('reviewing'::character varying)::text, ('interview'::character varying)::text, ('rejected'::character varying)::text, ('accepted'::character varying)::text])))
);


--
-- Name: job_applications_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.job_applications_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: job_applications_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.job_applications_id_seq OWNED BY public.job_applications.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


--
-- Name: job_offers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.job_offers (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    department character varying(120) NOT NULL,
    location character varying(120) DEFAULT 'Karma, Burkina Faso'::character varying NOT NULL,
    contract_type character varying(80) NOT NULL,
    description text NOT NULL,
    requirements text,
    deadline date,
    is_published boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    slug character varying(255),
    experience_level character varying(80),
    salary_range character varying(120),
    is_spontaneous boolean DEFAULT false NOT NULL
);


--
-- Name: job_offers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.job_offers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: job_offers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.job_offers_id_seq OWNED BY public.job_offers.id;


--
-- Name: jobs; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: karma_departments; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.karma_departments (
    id bigint NOT NULL,
    tag_fr character varying(80) NOT NULL,
    tag_en character varying(80) NOT NULL,
    title_fr character varying(255) NOT NULL,
    title_en character varying(255) NOT NULL,
    body_fr text NOT NULL,
    body_en text NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    is_published boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: karma_departments_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.karma_departments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: karma_departments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.karma_departments_id_seq OWNED BY public.karma_departments.id;


--
-- Name: leadership_members; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.leadership_members (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    title character varying(255) NOT NULL,
    department character varying(255),
    photo_path character varying(255),
    is_published boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    hierarchy_level smallint DEFAULT '2'::smallint NOT NULL
);


--
-- Name: leadership_members_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.leadership_members_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: leadership_members_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.leadership_members_id_seq OWNED BY public.leadership_members.id;


--
-- Name: media_assets; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.media_assets (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    type character varying(30) DEFAULT 'image'::character varying NOT NULL,
    file_path character varying(255) NOT NULL,
    caption text,
    is_published boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    external_url text,
    placement character varying(40) DEFAULT 'gallery'::character varying NOT NULL
);


--
-- Name: media_assets_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.media_assets_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: media_assets_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.media_assets_id_seq OWNED BY public.media_assets.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: news; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.news (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    category character varying(80) NOT NULL,
    excerpt text,
    image_path character varying(255),
    published_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    content text,
    slug character varying(255),
    gallery_images text
);


--
-- Name: news_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.news_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: news_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.news_id_seq OWNED BY public.news.id;


--
-- Name: newsletter_subscribers; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.newsletter_subscribers (
    id bigint NOT NULL,
    email character varying(255) NOT NULL,
    subscribed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: newsletter_subscribers_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.newsletter_subscribers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: newsletter_subscribers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.newsletter_subscribers_id_seq OWNED BY public.newsletter_subscribers.id;


--
-- Name: partners; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.partners (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    logo_path character varying(255),
    website_url character varying(255),
    category character varying(80),
    is_published boolean DEFAULT true NOT NULL,
    sort_order integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: partners_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.partners_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: partners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.partners_id_seq OWNED BY public.partners.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


--
-- Name: press_documents; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.press_documents (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    document_type character varying(80) NOT NULL,
    description text,
    file_path character varying(255) NOT NULL,
    published_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: press_documents_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.press_documents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: press_documents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.press_documents_id_seq OWNED BY public.press_documents.id;


--
-- Name: reports; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.reports (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    category character varying(80) NOT NULL,
    description text,
    file_path character varying(255) NOT NULL,
    cover_image character varying(255),
    published_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: reports_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.reports_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: reports_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.reports_id_seq OWNED BY public.reports.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


--
-- Name: site_analytics; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.site_analytics (
    id bigint NOT NULL,
    page_url character varying(255) NOT NULL,
    page_title character varying(255),
    referrer character varying(255),
    user_agent character varying(255),
    device_type character varying(20),
    country character varying(2),
    ip_address character varying(64),
    visited_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


--
-- Name: site_analytics_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.site_analytics_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: site_analytics_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.site_analytics_id_seq OWNED BY public.site_analytics.id;


--
-- Name: site_settings; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.site_settings (
    id bigint NOT NULL,
    key character varying(255) NOT NULL,
    value text,
    type character varying(255) DEFAULT 'text'::character varying NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


--
-- Name: site_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.site_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: site_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.site_settings_id_seq OWNED BY public.site_settings.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: -
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    is_admin boolean DEFAULT false NOT NULL,
    public_uuid uuid NOT NULL
);


--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: -
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: -
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: certifications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.certifications ALTER COLUMN id SET DEFAULT nextval('public.certifications_id_seq'::regclass);


--
-- Name: contact_messages id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contact_messages ALTER COLUMN id SET DEFAULT nextval('public.contact_messages_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: hero_slides id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.hero_slides ALTER COLUMN id SET DEFAULT nextval('public.hero_slides_id_seq'::regclass);


--
-- Name: job_applications id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_applications ALTER COLUMN id SET DEFAULT nextval('public.job_applications_id_seq'::regclass);


--
-- Name: job_offers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_offers ALTER COLUMN id SET DEFAULT nextval('public.job_offers_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: karma_departments id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.karma_departments ALTER COLUMN id SET DEFAULT nextval('public.karma_departments_id_seq'::regclass);


--
-- Name: leadership_members id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.leadership_members ALTER COLUMN id SET DEFAULT nextval('public.leadership_members_id_seq'::regclass);


--
-- Name: media_assets id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media_assets ALTER COLUMN id SET DEFAULT nextval('public.media_assets_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: news id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.news ALTER COLUMN id SET DEFAULT nextval('public.news_id_seq'::regclass);


--
-- Name: newsletter_subscribers id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.newsletter_subscribers ALTER COLUMN id SET DEFAULT nextval('public.newsletter_subscribers_id_seq'::regclass);


--
-- Name: partners id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.partners ALTER COLUMN id SET DEFAULT nextval('public.partners_id_seq'::regclass);


--
-- Name: press_documents id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.press_documents ALTER COLUMN id SET DEFAULT nextval('public.press_documents_id_seq'::regclass);


--
-- Name: reports id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reports ALTER COLUMN id SET DEFAULT nextval('public.reports_id_seq'::regclass);


--
-- Name: site_analytics id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.site_analytics ALTER COLUMN id SET DEFAULT nextval('public.site_analytics_id_seq'::regclass);


--
-- Name: site_settings id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.site_settings ALTER COLUMN id SET DEFAULT nextval('public.site_settings_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: certifications; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: contact_messages; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: hero_slides; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: job_applications; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: job_offers; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: karma_departments; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: leadership_members; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: media_assets; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.migrations VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO public.migrations VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO public.migrations VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO public.migrations VALUES (4, '2026_08_20_165609_create_news_table', 1);
INSERT INTO public.migrations VALUES (5, '2026_08_20_170359_create_reports_table', 1);
INSERT INTO public.migrations VALUES (6, '2026_08_20_170400_create_job_offers_table', 1);
INSERT INTO public.migrations VALUES (7, '2026_08_20_170401_create_contact_messages_table', 1);
INSERT INTO public.migrations VALUES (8, '2026_08_20_170717_create_newsletter_subscribers_table', 1);
INSERT INTO public.migrations VALUES (9, '2026_08_20_170718_create_partners_table', 1);
INSERT INTO public.migrations VALUES (10, '2026_08_20_170719_create_media_assets_table', 1);
INSERT INTO public.migrations VALUES (11, '2026_08_20_170720_create_press_documents_table', 1);
INSERT INTO public.migrations VALUES (12, '2026_08_25_095550_add_content_to_news_table', 1);
INSERT INTO public.migrations VALUES (13, '2026_08_25_121120_add_is_admin_to_users_table', 1);
INSERT INTO public.migrations VALUES (14, '2026_08_25_133651_add_slug_to_job_offers_table', 1);
INSERT INTO public.migrations VALUES (15, '2026_08_25_135029_add_fields_to_job_offers_table', 1);
INSERT INTO public.migrations VALUES (16, '2026_08_25_135030_create_job_applications_table', 1);
INSERT INTO public.migrations VALUES (17, '2026_08_25_144200_add_is_spontaneous_to_job_offers_table', 1);
INSERT INTO public.migrations VALUES (18, '2026_08_27_084134_add_external_url_to_media_assets_table', 1);
INSERT INTO public.migrations VALUES (19, '2026_08_27_150000_add_placement_to_media_assets_table', 1);
INSERT INTO public.migrations VALUES (20, '2026_08_27_165117_create_hero_slides_table', 1);
INSERT INTO public.migrations VALUES (21, '2026_08_28_081856_add_type_to_hero_slides_table', 1);
INSERT INTO public.migrations VALUES (22, '2026_08_31_090000_create_karma_departments_table', 1);
INSERT INTO public.migrations VALUES (23, '2026_08_31_112849_add_status_and_notes_to_contact_messages_table', 1);
INSERT INTO public.migrations VALUES (24, '2026_08_31_113114_create_site_settings_table', 1);
INSERT INTO public.migrations VALUES (25, '2026_08_31_113418_create_certifications_table', 1);
INSERT INTO public.migrations VALUES (26, '2026_08_31_164742_add_mining_videos_to_hero_slides', 1);
INSERT INTO public.migrations VALUES (27, '2026_09_01_111347_add_video_support_to_hero_slides_table', 1);
INSERT INTO public.migrations VALUES (28, '2026_09_01_111851_add_carousel_settings_to_site_settings', 1);
INSERT INTO public.migrations VALUES (29, '2026_09_01_112840_create_site_analytics_table', 1);
INSERT INTO public.migrations VALUES (30, '2026_09_02_002832_add_slug_to_news_table', 1);
INSERT INTO public.migrations VALUES (31, '2026_09_02_120000_seed_requested_news_articles', 1);
INSERT INTO public.migrations VALUES (32, '2026_09_03_120000_add_press_contact_settings', 1);
INSERT INTO public.migrations VALUES (33, '2026_09_03_120000_create_leadership_members_table', 1);
INSERT INTO public.migrations VALUES (34, '2026_09_03_123000_add_hierarchy_level_to_leadership_members_table', 1);
INSERT INTO public.migrations VALUES (35, '2026_09_03_124000_seed_initial_leadership_members', 1);
INSERT INTO public.migrations VALUES (36, '2026_09_04_130000_expand_site_analytics_ip_hash', 1);
INSERT INTO public.migrations VALUES (37, '2026_09_07_120000_seed_default_hero_slides', 1);
INSERT INTO public.migrations VALUES (38, '2026_09_07_121000_ensure_default_hero_slides', 1);
INSERT INTO public.migrations VALUES (39, '2026_09_07_130000_repair_mojibake_editorial_text', 1);
INSERT INTO public.migrations VALUES (40, '2026_09_07_131000_repair_double_encoded_editorial_text', 1);
INSERT INTO public.migrations VALUES (41, '2026_09_07_140000_add_gallery_images_to_news_table', 1);
INSERT INTO public.migrations VALUES (42, '2026_09_07_150000_create_sessions_table', 1);
INSERT INTO public.migrations VALUES (43, '2026_09_07_160000_add_public_uuid_to_users_table', 1);
INSERT INTO public.migrations VALUES (44, '2026_09_07_161000_add_site_analytics_indexes', 1);


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: newsletter_subscribers; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: partners; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: press_documents; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: reports; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: site_analytics; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.site_analytics VALUES (4, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/developpement-durable/sante-securite', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 12:18:17');
INSERT INTO public.site_analytics VALUES (5, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 12:21:55');
INSERT INTO public.site_analytics VALUES (6, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 12:46:00');
INSERT INTO public.site_analytics VALUES (7, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:12:07');
INSERT INTO public.site_analytics VALUES (8, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:31:34');
INSERT INTO public.site_analytics VALUES (9, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:32:02');
INSERT INTO public.site_analytics VALUES (10, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:39:27');
INSERT INTO public.site_analytics VALUES (11, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:41:16');
INSERT INTO public.site_analytics VALUES (12, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:41:55');
INSERT INTO public.site_analytics VALUES (13, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 14:56:06');
INSERT INTO public.site_analytics VALUES (14, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 15:38:21');
INSERT INTO public.site_analytics VALUES (15, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 15:45:05');
INSERT INTO public.site_analytics VALUES (16, 'http://127.0.0.1:8000/karma', NULL, 'http://127.0.0.1:8000/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 15:47:49');
INSERT INTO public.site_analytics VALUES (17, 'http://127.0.0.1:8000/karma', NULL, 'http://127.0.0.1:8000/karma', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 15:51:17');
INSERT INTO public.site_analytics VALUES (18, 'http://127.0.0.1:8000/karma/exploitation', NULL, 'http://127.0.0.1:8000/karma', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 15:52:13');
INSERT INTO public.site_analytics VALUES (19, 'http://127.0.0.1:8000/karma/organisation', NULL, 'http://127.0.0.1:8000/karma/exploitation', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:02:29');
INSERT INTO public.site_analytics VALUES (20, 'http://127.0.0.1:8000/karma/modele-operationnel', NULL, 'http://127.0.0.1:8000/karma/organisation', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:02:36');
INSERT INTO public.site_analytics VALUES (21, 'http://127.0.0.1:8000/karma/impact', NULL, 'http://127.0.0.1:8000/karma/modele-operationnel', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:02:42');
INSERT INTO public.site_analytics VALUES (22, 'http://127.0.0.1:8000/projets/projet-cil', NULL, 'http://127.0.0.1:8000/karma/impact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:07:21');
INSERT INTO public.site_analytics VALUES (23, 'http://127.0.0.1:8000/projets', NULL, 'http://127.0.0.1:8000/projets/projet-cil', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:08:14');
INSERT INTO public.site_analytics VALUES (24, 'http://127.0.0.1:8000/qui-sommes-nous/mot-du-pdg', NULL, 'http://127.0.0.1:8000/projets', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:29:30');
INSERT INTO public.site_analytics VALUES (25, 'http://127.0.0.1:8000/projets', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/mot-du-pdg', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:31:05');
INSERT INTO public.site_analytics VALUES (26, 'http://127.0.0.1:8000/developpement-durable/communautes', NULL, 'http://127.0.0.1:8000/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:31:41');
INSERT INTO public.site_analytics VALUES (27, 'http://127.0.0.1:8000/karma', NULL, 'http://127.0.0.1:8000/projets', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:35:24');
INSERT INTO public.site_analytics VALUES (28, 'http://127.0.0.1:8000/karma/exploitation', NULL, 'http://127.0.0.1:8000/karma', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 16:35:38');
INSERT INTO public.site_analytics VALUES (29, 'http://127.0.0.1:8000/karma/exploitation', NULL, 'http://127.0.0.1:8000/karma', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 17:25:25');
INSERT INTO public.site_analytics VALUES (30, 'http://127.0.0.1:8000/projets/projet-cil', NULL, 'http://127.0.0.1:8000/karma/exploitation', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.136.1 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-09 17:50:41');
INSERT INTO public.site_analytics VALUES (31, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.137.0 Chrome/148.0.7778.280 Electron/42.10.0 Safari/537.36', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:25:11');
INSERT INTO public.site_analytics VALUES (32, 'http://127.0.0.1:8000', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:25:52');
INSERT INTO public.site_analytics VALUES (33, 'http://127.0.0.1:8000/gestion-nm', NULL, NULL, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:32:56');
INSERT INTO public.site_analytics VALUES (34, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:33:10');
INSERT INTO public.site_analytics VALUES (35, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:33:20');
INSERT INTO public.site_analytics VALUES (36, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:33:26');
INSERT INTO public.site_analytics VALUES (37, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:33:35');
INSERT INTO public.site_analytics VALUES (38, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:33:54');
INSERT INTO public.site_analytics VALUES (39, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:35:22');
INSERT INTO public.site_analytics VALUES (40, 'http://127.0.0.1:8000/gestion-nm', NULL, 'http://127.0.0.1:8000/gestion-nm', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:38:26');
INSERT INTO public.site_analytics VALUES (41, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/gestion-nm/hero-slideshow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:59:39');
INSERT INTO public.site_analytics VALUES (42, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/gestion-nm/hero-slideshow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 09:59:44');
INSERT INTO public.site_analytics VALUES (43, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/gestion-nm/hero-slideshow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:02:01');
INSERT INTO public.site_analytics VALUES (44, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/gestion-nm/hero-slideshow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:15:32');
INSERT INTO public.site_analytics VALUES (45, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/gestion-nm/hero-slideshow', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:17:56');
INSERT INTO public.site_analytics VALUES (46, 'http://127.0.0.1:8000/qui-sommes-nous/mot-du-pdg', NULL, 'http://127.0.0.1:8000/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:19:57');
INSERT INTO public.site_analytics VALUES (47, 'http://127.0.0.1:8000/qui-sommes-nous/identite', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/mot-du-pdg', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:20:06');
INSERT INTO public.site_analytics VALUES (48, 'http://127.0.0.1:8000/qui-sommes-nous/histoire', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/identite', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:20:12');
INSERT INTO public.site_analytics VALUES (49, 'http://127.0.0.1:8000/qui-sommes-nous/valeurs', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/histoire', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:20:22');
INSERT INTO public.site_analytics VALUES (50, 'http://127.0.0.1:8000/qui-sommes-nous/gouvernance', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/valeurs', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:20:31');
INSERT INTO public.site_analytics VALUES (51, 'http://127.0.0.1:8000/karma', NULL, 'http://127.0.0.1:8000/qui-sommes-nous/gouvernance', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:20:51');
INSERT INTO public.site_analytics VALUES (52, 'http://127.0.0.1:8000/karma/ressources-reserves', NULL, 'http://127.0.0.1:8000/karma', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:21:08');
INSERT INTO public.site_analytics VALUES (53, 'http://127.0.0.1:8000/karma/organisation', NULL, 'http://127.0.0.1:8000/karma/ressources-reserves', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:21:23');
INSERT INTO public.site_analytics VALUES (54, 'http://127.0.0.1:8000/karma/modele-operationnel', NULL, 'http://127.0.0.1:8000/karma/organisation', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:21:35');
INSERT INTO public.site_analytics VALUES (55, 'http://127.0.0.1:8000/karma/impact', NULL, 'http://127.0.0.1:8000/karma/modele-operationnel', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:21:42');
INSERT INTO public.site_analytics VALUES (56, 'http://127.0.0.1:8000/projets/projet-cil', NULL, 'http://127.0.0.1:8000/karma/impact', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:21:56');
INSERT INTO public.site_analytics VALUES (57, 'http://127.0.0.1:8000/projets', NULL, 'http://127.0.0.1:8000/projets/projet-cil', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:22:03');
INSERT INTO public.site_analytics VALUES (58, 'http://127.0.0.1:8000/developpement-durable/communautes', NULL, 'http://127.0.0.1:8000/projets', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:22:27');
INSERT INTO public.site_analytics VALUES (59, 'http://127.0.0.1:8000/developpement-durable/environnement', NULL, 'http://127.0.0.1:8000/developpement-durable/communautes', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:22:48');
INSERT INTO public.site_analytics VALUES (60, 'http://127.0.0.1:8000/developpement-durable/sante-securite', NULL, 'http://127.0.0.1:8000/developpement-durable/environnement', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:22:55');
INSERT INTO public.site_analytics VALUES (61, 'http://127.0.0.1:8000/developpement-durable/contenu-local', NULL, 'http://127.0.0.1:8000/developpement-durable/sante-securite', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:07');
INSERT INTO public.site_analytics VALUES (62, 'http://127.0.0.1:8000/actualites', NULL, 'http://127.0.0.1:8000/developpement-durable/contenu-local', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:16');
INSERT INTO public.site_analytics VALUES (63, 'http://127.0.0.1:8000/communiques', NULL, 'http://127.0.0.1:8000/actualites', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:23');
INSERT INTO public.site_analytics VALUES (64, 'http://127.0.0.1:8000/mediatheque', NULL, 'http://127.0.0.1:8000/communiques', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:28');
INSERT INTO public.site_analytics VALUES (65, 'http://127.0.0.1:8000/rapports', NULL, 'http://127.0.0.1:8000/mediatheque', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:38');
INSERT INTO public.site_analytics VALUES (66, 'http://127.0.0.1:8000/contact-presse', NULL, 'http://127.0.0.1:8000/rapports', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:44');
INSERT INTO public.site_analytics VALUES (67, 'http://127.0.0.1:8000/carrieres', NULL, 'http://127.0.0.1:8000/contact-presse', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:23:52');
INSERT INTO public.site_analytics VALUES (68, 'http://127.0.0.1:8000/offres-emploi', NULL, 'http://127.0.0.1:8000/carrieres', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:24:01');
INSERT INTO public.site_analytics VALUES (69, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/offres-emploi', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:33:04');
INSERT INTO public.site_analytics VALUES (70, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/offres-emploi', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 10:35:19');
INSERT INTO public.site_analytics VALUES (71, 'http://127.0.0.1:8000', NULL, 'http://127.0.0.1:8000/', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36 Edg/152.0.0.0', 'desktop', NULL, '12ca17b49af2289436f303e0166030a21e525d266e209267433801a8fd4071a0', '2026-09-10 11:12:39');


--
-- Data for Name: site_settings; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.users VALUES (1, 'Administrateur Néré Mining Néré Mining', 'admin@nere-mining.bf', '2026-09-10 09:37:39', '$2y$12$cIsFI3U8muAjyayq3Ks/.eN3EEJsvJmH1/NLpWWpLePqj0cov1zHq', NULL, '2026-09-10 09:37:40', '2026-09-10 09:37:40', true, 'e3cf0114-9047-4ca7-827b-9f734903ecf9');


--
-- Name: certifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.certifications_id_seq', 1, false);


--
-- Name: contact_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.contact_messages_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: hero_slides_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.hero_slides_id_seq', 1, false);


--
-- Name: job_applications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.job_applications_id_seq', 1, false);


--
-- Name: job_offers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.job_offers_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: karma_departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.karma_departments_id_seq', 1, false);


--
-- Name: leadership_members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.leadership_members_id_seq', 1, false);


--
-- Name: media_assets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.media_assets_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.migrations_id_seq', 44, true);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.news_id_seq', 1, false);


--
-- Name: newsletter_subscribers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.newsletter_subscribers_id_seq', 1, false);


--
-- Name: partners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.partners_id_seq', 1, false);


--
-- Name: press_documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.press_documents_id_seq', 1, false);


--
-- Name: reports_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reports_id_seq', 1, false);


--
-- Name: site_analytics_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.site_analytics_id_seq', 71, true);


--
-- Name: site_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.site_settings_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: certifications certifications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.certifications
    ADD CONSTRAINT certifications_pkey PRIMARY KEY (id);


--
-- Name: contact_messages contact_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.contact_messages
    ADD CONSTRAINT contact_messages_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: hero_slides hero_slides_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.hero_slides
    ADD CONSTRAINT hero_slides_pkey PRIMARY KEY (id);


--
-- Name: job_applications job_applications_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_applications
    ADD CONSTRAINT job_applications_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: job_offers job_offers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_offers
    ADD CONSTRAINT job_offers_pkey PRIMARY KEY (id);


--
-- Name: job_offers job_offers_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_offers
    ADD CONSTRAINT job_offers_slug_unique UNIQUE (slug);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: karma_departments karma_departments_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.karma_departments
    ADD CONSTRAINT karma_departments_pkey PRIMARY KEY (id);


--
-- Name: leadership_members leadership_members_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.leadership_members
    ADD CONSTRAINT leadership_members_pkey PRIMARY KEY (id);


--
-- Name: media_assets media_assets_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.media_assets
    ADD CONSTRAINT media_assets_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: news news_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_pkey PRIMARY KEY (id);


--
-- Name: news news_slug_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.news
    ADD CONSTRAINT news_slug_unique UNIQUE (slug);


--
-- Name: newsletter_subscribers newsletter_subscribers_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.newsletter_subscribers
    ADD CONSTRAINT newsletter_subscribers_email_unique UNIQUE (email);


--
-- Name: newsletter_subscribers newsletter_subscribers_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.newsletter_subscribers
    ADD CONSTRAINT newsletter_subscribers_pkey PRIMARY KEY (id);


--
-- Name: partners partners_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.partners
    ADD CONSTRAINT partners_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: press_documents press_documents_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.press_documents
    ADD CONSTRAINT press_documents_pkey PRIMARY KEY (id);


--
-- Name: reports reports_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.reports
    ADD CONSTRAINT reports_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: site_analytics site_analytics_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.site_analytics
    ADD CONSTRAINT site_analytics_pkey PRIMARY KEY (id);


--
-- Name: site_settings site_settings_key_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.site_settings
    ADD CONSTRAINT site_settings_key_unique UNIQUE (key);


--
-- Name: site_settings site_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.site_settings
    ADD CONSTRAINT site_settings_pkey PRIMARY KEY (id);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_public_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_public_uuid_unique UNIQUE (public_uuid);


--
-- Name: cache_expiration_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX cache_expiration_index ON public.cache USING btree (expiration);


--
-- Name: cache_locks_expiration_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX cache_locks_expiration_index ON public.cache_locks USING btree (expiration);


--
-- Name: failed_jobs_connection_queue_failed_at_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX failed_jobs_connection_queue_failed_at_index ON public.failed_jobs USING btree (connection, queue, failed_at);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: news_published_at_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX news_published_at_index ON public.news USING btree (published_at);


--
-- Name: press_documents_published_at_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX press_documents_published_at_index ON public.press_documents USING btree (published_at);


--
-- Name: reports_published_at_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX reports_published_at_index ON public.reports USING btree (published_at);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: site_analytics_device_type_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_device_type_index ON public.site_analytics USING btree (device_type);


--
-- Name: site_analytics_page_url_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_page_url_index ON public.site_analytics USING btree (page_url);


--
-- Name: site_analytics_visited_at_index; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_visited_at_index ON public.site_analytics USING btree (visited_at);


--
-- Name: site_analytics_visited_device_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_visited_device_idx ON public.site_analytics USING btree (visited_at, device_type);


--
-- Name: site_analytics_visited_page_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_visited_page_idx ON public.site_analytics USING btree (visited_at, page_url);


--
-- Name: site_analytics_visited_referrer_idx; Type: INDEX; Schema: public; Owner: -
--

CREATE INDEX site_analytics_visited_referrer_idx ON public.site_analytics USING btree (visited_at, referrer);


--
-- Name: job_applications job_applications_job_offer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: -
--

ALTER TABLE ONLY public.job_applications
    ADD CONSTRAINT job_applications_job_offer_id_foreign FOREIGN KEY (job_offer_id) REFERENCES public.job_offers(id) ON DELETE CASCADE;


--
-- PostgreSQL database dump complete
--

\unrestrict su263ib0C3QszhFHv8ZCF3UUyPuUlGPXoeEAkLaoj0ZDhoAd4EA5LwnqFjp5NIo

