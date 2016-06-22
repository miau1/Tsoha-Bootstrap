-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Tyontekija (fullname, wposition, location, password) VALUES ('työ', 'Kokki/kuski', 'ravintolassa', 'lol');
INSERT INTO Tyontekija (fullname, wposition, location, password) VALUES ('Erno', 'Kokki/kuski', 'ravintolassa', 'ernolol');
INSERT INTO Tyontekija (fullname, wposition, location, password) VALUES ('Jaska', 'Kuski', 'toimittamassa', 'jaskalol');
INSERT INTO Tyontekija (fullname, wposition, location, password) VALUES ('Pomo', 'Ravintolapäällikkö', 'ravintolassa', 'pomolol');

INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (1, 'Pepperoni', 700, 'nam', 'Pizza');
INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (2, 'Kana', 700, 'nam', 'Pizza');
INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (3, 'Mozzarella', 600, 'nam', 'Pizza');
INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (4, 'Special', 1000, 'nam', 'Pizza');
INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (5, 'Kokis', 250, 'nam', 'Juoma');
INSERT INTO Tuote (pnumber, pname, price, description, ptype) VALUES (6, 'Spraitti', 250, 'nam', 'Juoma');

INSERT INTO Tayte (pname, description) VALUES ('Sipuli', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Pepperoni', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Mozzarella', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Kinkku', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Ananas', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Tonnikala', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Kana', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Herkkusieni', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Bolognesekastike', 'huhhuh');
INSERT INTO Tayte (pname, description) VALUES ('Lohi', 'huhhuh');

INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (1, 1);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (1, 2);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (2, 7);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (2, 5);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (3, 3);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (3, 8);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (3, 1);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (4, 2);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (4, 4);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (4, 6);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (4, 7);
INSERT INTO Pizzatayte (pizza_id, tayte_id) VALUES (4, 10);

INSERT INTO Tilaus (worker_id, customer, phone, address, ordered, delivered, price, problems, discount) VALUES (2, 'Heppu Heimonen', '123456', 'Pizzatie 3', CURRENT_TIMESTAMP(0), CURRENT_TIMESTAMP(0), 1400, 'Ei ongelmia', 0);
INSERT INTO Tilaus (worker_id, customer, phone, address, ordered, delivered, price, problems, discount) VALUES (3, 'Moi Moimonen', '123456', 'Pizzatie 5', CURRENT_TIMESTAMP(0), CURRENT_TIMESTAMP(0), 1700, 'Myöhästyi', 400);
INSERT INTO Tilaus (customer, phone, address, ordered, price, problems, discount) VALUES ('Jou Joujonen', '123456', 'Pastatie 91', CURRENT_TIMESTAMP(0), 1300, 'Ei ongelmia', 0);

INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (1, 1);
INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (1, 2);
INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (2, 1);
INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (2, 4);
INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (3, 2);
INSERT INTO Tilaustuote (tilaus_id, tuote_id) VALUES (3, 3);
