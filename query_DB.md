# **CREAZIONE DATABASE E TABELLE**



CREATE DATABASE db\_coinquilini;

USE db\_coinquilini;



-- TABELLA CITTA

CREATE TABLE citta (

&nbsp;   idCitta INT AUTO\_INCREMENT PRIMARY KEY,

&nbsp;   nomeCitta VARCHAR(25) NOT NULL

);



-- TABELLA UTENTI

CREATE TABLE utenti (

&nbsp;   idUtente INT AUTO\_INCREMENT PRIMARY KEY,

&nbsp;   nomeUtente VARCHAR(50) NOT NULL,

&nbsp;   cognomeUtente VARCHAR(50) NOT NULL,

&nbsp;   sesso VARCHAR(10),

&nbsp;   universita\_lavoro VARCHAR(100),

&nbsp;   ruolo VARCHAR(20) CHECK (ruolo IN ('offre\_casa', 'cerca\_casa')),

&nbsp;   linguaParlata VARCHAR(50),

&nbsp;   dataNascita DATE

);



-- TABELLA CASA

CREATE TABLE casa (

&nbsp;   idCasa INT AUTO\_INCREMENT PRIMARY KEY,

&nbsp;   nPosti INT NOT NULL,

&nbsp;   via VARCHAR(50),

&nbsp;   civico VARCHAR(4),

&nbsp;   nStanzeLetto INT,

&nbsp;   nBagni INT,

&nbsp;   metratura INT,

&nbsp;   descrizione TEXT,

&nbsp;   idCitta INT,

&nbsp;   idProprietario INT,

&nbsp;   FOREIGN KEY (idCitta) REFERENCES citta(idCitta),

&nbsp;   FOREIGN KEY (idProprietario) REFERENCES utenti(idUtente)

);



-- TABELLA UTENTE\_CASA

CREATE TABLE utente\_casa (

&nbsp;   idUtente INT,

&nbsp;   idCasa INT,

&nbsp;   PRIMARY KEY (idUtente, idCasa),

&nbsp;   FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

&nbsp;   FOREIGN KEY (idCasa) REFERENCES casa(idCasa)

);



-- TABELLA INTERESSI

CREATE TABLE interessi (

&nbsp;   idInteresse INT AUTO\_INCREMENT PRIMARY KEY,

&nbsp;   nomeInteresse VARCHAR(50) NOT NULL

);



-- TABELLA UTENTE\_INTERESSI

CREATE TABLE utente\_interessi (

&nbsp;   idUtente INT,

&nbsp;   idInteresse INT,

&nbsp;   PRIMARY KEY (idUtente, idInteresse),

&nbsp;   FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

&nbsp;   FOREIGN KEY (idInteresse) REFERENCES interessi(idInteresse)

);



-- TABELLA UTENTE\_VISTO\_UTENTE

CREATE TABLE utente\_visto\_utente (

&nbsp;   idUtente INT,

&nbsp;   idUtenteVisto INT,

&nbsp;   mi\_piace BOOLEAN,

&nbsp;   PRIMARY KEY (idUtente, idUtenteVisto),

&nbsp;   FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

&nbsp;   FOREIGN KEY (idUtenteVisto) REFERENCES utenti(idUtente)

);















# **POPOLAZIONE TABELLE**





**-- CITTA**

**INSERT INTO citta (nomeCitta) VALUES ('Torino');**



**-- INTERESSI**

**INSERT INTO interessi (nomeInteresse) VALUES**

**('Calcio'), ('Basket'), ('Cucina'), ('Musica'), ('Viaggi'),**

**('Gaming'), ('Lettura'), ('Palestra'), ('Cinema'), ('Fotografia');**



**-- UTENTI (20)**

**INSERT INTO utenti (nomeUtente, cognomeUtente, sesso, universita\_lavoro, ruolo, linguaParlata, dataNascita) VALUES**

**('Marco',      'Rossi',      'M', 'Politecnico di Torino',       'offre\_casa',  'Italiano',  '1998-03-15'),**

**('Giulia',     'Ferrari',    'F', 'Università di Torino',        'cerca\_casa',  'Italiano',  '2000-07-22'),**

**('Luca',       'Bianchi',    'M', 'Politecnico di Torino',       'cerca\_casa',  'Italiano',  '1999-11-05'),**

**('Sofia',      'Esposito',   'F', 'Università di Torino',        'offre\_casa',  'Italiano',  '1997-04-30'),**

**('Ahmed',      'Ben Ali',    'M', 'Politecnico di Torino',       'cerca\_casa',  'Arabo',     '2001-01-18'),**

**('Elena',      'Conti',      'F', 'IED Torino',                  'cerca\_casa',  'Italiano',  '2000-09-12'),**

**('Matteo',     'Ricci',      'M', 'Università di Torino',        'offre\_casa',  'Italiano',  '1996-06-25'),**

**('Anna',       'Lombardi',   'F', 'Politecnico di Torino',       'cerca\_casa',  'Italiano',  '2002-02-14'),**

**('Kevin',      'Dupont',     'M', 'Università di Torino',        'cerca\_casa',  'Francese',  '1999-08-03'),**

**('Chiara',     'Moretti',    'F', 'Accademia Albertina',         'cerca\_casa',  'Italiano',  '2001-05-19'),**

**('Davide',     'Gallo',      'M', 'Politecnico di Torino',       'offre\_casa',  'Italiano',  '1995-12-07'),**

**('Martina',    'Bruno',      'F', 'Università di Torino',        'cerca\_casa',  'Italiano',  '2000-03-28'),**

**('Alessandro', 'Marino',     'M', 'Politecnico di Torino',       'cerca\_casa',  'Italiano',  '1998-10-11'),**

**('Sara',       'Greco',      'F', 'IED Torino',                  'offre\_casa',  'Italiano',  '1997-07-16'),**

**('Yuki',       'Tanaka',     'F', 'Università di Torino',        'cerca\_casa',  'Giapponese','2001-04-09'),**

**('Federico',   'Colombo',    'M', 'Politecnico di Torino',       'cerca\_casa',  'Italiano',  '1999-01-23'),**

**('Valentina',  'Mancini',    'F', 'Università di Torino',        'offre\_casa',  'Italiano',  '1996-11-30'),**

**('Carlos',     'Ramirez',    'M', 'Politecnico di Torino',       'cerca\_casa',  'Spagnolo',  '2000-06-04'),**

**('Beatrice',   'Fontana',    'F', 'Accademia Albertina',         'cerca\_casa',  'Italiano',  '2002-08-17'),**

**('Simone',     'De Luca',    'M', 'Università di Torino',        'offre\_casa',  'Italiano',  '1994-09-21');**



**-- CASE (tutte a Torino, idCitta = 1)**

**-- Proprietari: utenti con ruolo offre\_casa -> id 1, 4, 7, 11, 14, 17, 20**

**INSERT INTO casa (nPosti, via, civico, nStanzeLetto, nBagni, metratura, descrizione, idCitta, idProprietario) VALUES**

**(3, 'Via Po',              '12',  2, 1,  75,  'Appartamento luminoso vicino al Po',                    1, 1),**

**(4, 'Via Roma',            '45',  3, 2,  90,  'Ampio appartamento in centro, vicino ai mezzi',         1, 4),**

**(2, 'Corso Vittorio',      '8',   1, 1,  55,  'Bilocale moderno, ottima posizione',                    1, 7),**

**(5, 'Via Garibaldi',       '33',  4, 2, 110,  'Grande casa ideale per studenti universitari',          1, 11),**

**(3, 'Via Nizza',           '67',  2, 1,  80,  'Vicino alla stazione Porta Nuova, ben servita',         1, 14),**

**(2, 'Corso Francia',       '21',  1, 1,  60,  'Appartamento tranquillo in zona residenziale',          1, 17),**

**(4, 'Via Lagrange',        '5',   3, 2,  95,  'Ristrutturato di recente, arredato con gusto',          1, 20);**



**-- UTENTE\_CASA (chi abita dove)**

**INSERT INTO utente\_casa (idUtente, idCasa) VALUES**

**(2,  1), (3,  1),**

**(5,  2), (6,  2), (8,  2),**

**(9,  3),**

**(10, 4), (12, 4), (13, 4), (15, 4),**

**(16, 5), (18, 5),**

**(19, 6),**

**(1,  7), (4,  7);**



**-- UTENTE\_INTERESSI**

**INSERT INTO utente\_interessi (idUtente, idInteresse) VALUES**

**(1,  1), (1,  2),**

**(2,  3), (2,  9),**

**(3,  6), (3,  7),**

**(4,  4), (4,  5),**

**(5,  1), (5,  6),**

**(6,  10),(6,  4),**

**(7,  8), (7,  1),**

**(8,  3), (8,  9),**

**(9,  5), (9,  10),**

**(10, 4), (10, 7),**

**(11, 1), (11, 8),**

**(12, 2), (12, 3),**

**(13, 6), (13, 1),**

**(14, 9), (14, 4),**

**(15, 5), (15, 7),**

**(16, 8), (16, 6),**

**(17, 3), (17, 2),**

**(18, 1), (18, 5),**

**(19, 10),(19, 9),**

**(20, 7), (20, 8);**



**-- UTENTE\_VISTO\_UTENTE (alcuni like/dislike tra utenti)**

**INSERT INTO utente\_visto\_utente (idUtente, idUtenteVisto, mi\_piace) VALUES**

**(2,  3,  TRUE),**

**(3,  2,  TRUE),**

**(5,  6,  TRUE),**

**(6,  5,  FALSE),**

**(8,  12, TRUE),**

**(12, 8,  TRUE),**

**(9,  16, FALSE),**

**(16, 9,  TRUE),**

**(10, 13, TRUE),**

**(13, 10, FALSE),**

**(15, 19, TRUE),**

**(19, 15, TRUE),**

**(18, 5,  FALSE),**

**(1,  7,  TRUE),**

**(7,  1,  TRUE);**

