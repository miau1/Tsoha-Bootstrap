-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Tyontekija (fullname, wposition, location, password) VALUES ('työ', 'kokki', 'ravintola', 'lol');

INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (1, 'Pepperoni', 7, 'nam', 'Pizza');

INSERT INTO Tayte (pname, description) VALUES ('Sipuli', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Pepperoni', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Mozzarella', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Kinkku', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Ananas', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Tonnikala', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Herkkusieni', 'huhhuh');

INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (1, 1);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (1, 2);
