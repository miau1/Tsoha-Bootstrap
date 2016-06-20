-- Lisää CREATE TABLE lauseet tähän tiedostoon


CREATE TABLE Tyontekija(
    id SERIAL PRIMARY KEY,
    fullname varchar(50) NOT NULL,
    wposition varchar(20) NOT NULL,
    location varchar(20) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Tuote(
    id SERIAL PRIMARY KEY,
    pnumber int NOT NULL,
    pname varchar(20) NOT NULL,
    price numeric NOT NULL,
    description varchar(200) NOT NULL,
    ptype varchar(200)NOT NULL
);

CREATE TABLE Tayte(
    id SERIAL PRIMARY KEY,
    pname varchar(20) NOT NULL,
    description varchar(200) NOT NULL
);

CREATE TABLE Pizzatayte(
    pizza_id INTEGER REFERENCES Tuote(id) ON UPDATE CASCADE ON DELETE CASCADE,
    tayte_id INTEGER REFERENCES Tayte(id) ON UPDATE CASCADE,
    CONSTRAINT pizzatayte_key PRIMARY KEY (pizza_id, tayte_id)
);

CREATE TABLE Tilaus(
    id SERIAL PRIMARY KEY,
    worker_id INTEGER REFERENCES Tyontekija(id),
    tuotteet INTEGER[], 
    customer varchar(50) NOT NULL,
    phone varchar(20) NOT NULL,
    address varchar(50) NOT NULL,
    ordered timestamp NOT NULL,
    delivered timestamp,
    price numeric NOT NULL,
    problems varchar(200),
    discount numeric
);

CREATE TABLE Tilaustuote(
    tilaus_id INTEGER REFERENCES Tilaus(id) ON UPDATE CASCADE ON DELETE CASCADE,
    tuote_id INTEGER REFERENCES Tuote(id) ON UPDATE CASCADE,
    CONSTRAINT tilaustuote_key PRIMARY KEY (tilaus_id, tuote_id)
);
