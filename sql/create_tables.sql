-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Asiakas(
    id SERIAL PRIMARY KEY,
    fullname varchar(50) NOT NULL,
    phone varchar(20) NOT NULL,
    address varchar(50) NOT NULL
);

CREATE TABLE Tyontekija(
    id SERIAL PRIMARY KEY,
    fullname varchar(50) NOT NULL,
    wposition varchar(20) NOT NULL,
    location varchar(20) NOT NULL
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
    amount INTEGER NOT NULL DEFAULT 1,
    CONSTRAINT pizzatayte_key PRIMARY KEY (pizza_id, tayte_id)
);

CREATE TABLE Tilaus(
    id SERIAL PRIMARY KEY,
    customer_id INTEGER REFERENCES Asiakas(id),
    worker_id INTEGER REFERENCES Tyontekija(id),
    product_id INTEGER REFERENCES Tuote(id), 
    ordered DATE NOT NULL,
    delivered DATE,
    price numeric NOT NULL,
    problems varchar(200),
    discount numeric
);
