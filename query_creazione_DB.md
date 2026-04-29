CREATE DATABASE db\_coinquilini;

USE db\_coinquilini;



CREATE TABLE citta (

idCitta INT AUTO\_INCREMENT PRIMARY KEY,

nomeCitta VARCHAR(25) NOT NULL

);



CREATE TABLE utenti (

idUtente INT AUTO\_INCREMENT PRIMARY KEY,

nomeUtente VARCHAR(50) NOT NULL,

cognomeUtente VARCHAR(50) NOT NULL,

sesso VARCHAR(10),

universita\_lavoro VARCHAR(100),

cerca\_casa BOOLEAN,

linguaParlata VARCHAR(50),

dataNascita DATE,

mail VARCHAR(100) NOT NULL UNIQUE,

psw VARCHAR(255) NOT NULL,

cellulare VARCHAR(15),

soprannome VARCHAR(50),

nickname\_instagram VARCHAR(50)

luogo\_ricerca INT,

FOREIGN KEY (luogo\_ricerca) REFERENCES citta(idCitta)

);



CREATE TABLE casa (

idCasa INT AUTO\_INCREMENT PRIMARY KEY,

nPosti INT NOT NULL,

via VARCHAR(50),

civico VARCHAR(4),

cap VARCHAR(5),

nStanzeLetto INT,

nBagni INT,

metratura INT,

descrizione TEXT,

lat DECIMAL(9,6),

lng DECIMAL(9,6),

idCitta INT,

idProprietario INT,

FOREIGN KEY (idCitta) REFERENCES citta(idCitta),

FOREIGN KEY (idProprietario) REFERENCES utenti(idUtente)

);



CREATE TABLE utente\_casa (

idUtente INT,

idCasa INT,

PRIMARY KEY (idUtente, idCasa),

FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

FOREIGN KEY (idCasa) REFERENCES casa(idCasa)

);



CREATE TABLE interessi (

idInteresse INT AUTO\_INCREMENT PRIMARY KEY,

nomeInteresse VARCHAR(50) NOT NULL

);



CREATE TABLE utente\_interessi (

idUtente INT,

idInteresse INT,

PRIMARY KEY (idUtente, idInteresse),

FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

FOREIGN KEY (idInteresse) REFERENCES interessi(idInteresse)

);



CREATE TABLE personalita (

idPersonalita INT AUTO\_INCREMENT PRIMARY KEY,

nomePersonalita VARCHAR(50) NOT NULL

);



CREATE TABLE utente\_personalita (

idUtente INT,

idPersonalita INT,

PRIMARY KEY (idUtente, idPersonalita),

FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

FOREIGN KEY (idPersonalita) REFERENCES personalita(idPersonalita)

);



CREATE TABLE abitudini (

idAbitudine INT AUTO\_INCREMENT PRIMARY KEY,

nomeAbitudine VARCHAR(50) NOT NULL

);



CREATE TABLE utente\_abitudini (

idUtente INT,

idAbitudine INT,

valore INT,

PRIMARY KEY (idUtente, idAbitudine),

FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

FOREIGN KEY (idAbitudine) REFERENCES abitudini(idAbitudine)

);



CREATE TABLE utente\_visto\_utente (

idUtente INT,

idUtenteVisto INT,

mi\_piace BOOLEAN,

PRIMARY KEY (idUtente, idUtenteVisto),

FOREIGN KEY (idUtente) REFERENCES utenti(idUtente),

FOREIGN KEY (idUtenteVisto) REFERENCES utenti(idUtente)

);

