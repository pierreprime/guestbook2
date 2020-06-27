--
-- PostgreSQL database dump
--

-- Dumped from database version 11.8
-- Dumped by pg_dump version 12.2 (Ubuntu 12.2-4)

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

--
-- Data for Name: admin; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.admin (id, username, roles, password) FROM stdin;
2	admin	["ROLE_ADMIN"]	$argon2id$v=19$m=65536,t=4,p=1$yacot9PcmuqoAgWSOOaDHw$ASZMFBivj8++FQoMSEGnkOdvPHzSPX+tnRpUR6elAJ0
\.


--
-- Data for Name: conference; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.conference (id, city, year, is_international, slug) FROM stdin;
7	Sydney	2000	t	sydney-2000
8	Athens	2004	t	athens-2004
\.


--
-- Data for Name: comment; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.comment (id, conference_id, author, text, email, created_at, photo_filename, state) FROM stdin;
8	7	Myself	This was a great game	myself@server.org	2020-06-27 11:25:33	\N	published
9	8	Him	blabla	him@server.org	2020-06-27 11:25:33	\N	submitted
11	8	pericles	what an antique	pericles@athens.org	2020-06-27 11:26:30	e8d4099f06f0.jpeg	published
12	7	heyhey	odezkdpozedj	hey@hey.hey	2020-06-27 11:31:46	\N	published
\.


--
-- Data for Name: messenger_messages; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.messenger_messages (id, body, headers, queue_name, created_at, available_at, delivered_at) FROM stdin;
\.


--
-- Data for Name: migration_versions; Type: TABLE DATA; Schema: public; Owner: main
--

COPY public.migration_versions (version, executed_at) FROM stdin;
20200514093922	2020-06-27 08:36:41
20200523091451	2020-06-27 08:36:41
20200523092239	2020-06-27 08:36:41
20200525221337	2020-06-27 08:36:41
20200605220816	2020-06-27 08:36:41
\.


--
-- Name: admin_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.admin_id_seq', 2, true);


--
-- Name: comment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.comment_id_seq', 12, true);


--
-- Name: conference_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.conference_id_seq', 8, true);


--
-- Name: messenger_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: main
--

SELECT pg_catalog.setval('public.messenger_messages_id_seq', 1, false);


--
-- PostgreSQL database dump complete
--

