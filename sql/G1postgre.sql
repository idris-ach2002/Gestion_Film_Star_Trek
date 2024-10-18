DROP TABLE IF EXISTS G01_realiser;
DROP TABLE IF EXISTS G01_interprete;
DROP TABLE IF EXISTS G01_Oeuvre;
DROP TABLE IF EXISTS G01_Artiste;


CREATE TABLE IF NOT EXISTS G01_Oeuvre (
oeuvre_id SERIAL PRIMARY KEY,
oeuvre_nom varchar(50) NOT NULL,
oeuvre_type varchar(50) NOT NULL CHECK(oeuvre_type in ('FILM','SERIE')),
oeuvre_date_de_sortie date NOT NULL
);



CREATE TABLE IF NOT EXISTS G01_Artiste (
artiste_id SERIAL PRIMARY KEY,
artiste_nom varchar(50) NOT NULL,
artiste_pays varchar(50) NOT NULL,
artiste_date_de_naissance date NOT NULL
);


CREATE TABLE IF NOT EXISTS G01_interprete(
personnage_nom varchar(50) NOT NULL,
personnageAnneDeNaissance int NOT NULL,
oeuvre_id int NOT NULL,artiste_id SERIAL PRIMARY KEY,
artiste_id int NOT NULL,
FOREIGN KEY (oeuvre_id) REFERENCES G01_Oeuvre(oeuvre_id),
FOREIGN KEY (artiste_id) REFERENCES G01_Artiste(artiste_id),
PRIMARY KEY (oeuvre_id,artiste_id)
);

CREATE TABLE IF NOT EXISTS G01_realiser(
oeuvre_id int NOT NULL,
artiste_id int NOT NULL,
FOREIGN KEY (oeuvre_id) REFERENCES G01_Oeuvre(oeuvre_id),
FOREIGN KEY (artiste_id) REFERENCES G01_Artiste(artiste_id),
PRIMARY KEY (oeuvre_id,artiste_id)
);



INSERT INTO G01_Oeuvre(oeuvre_nom,oeuvre_type,oeuvre_date_de_sortie) VALUES
('Star Trek','FILM', '1979-08-29'),
('Star Trek II: The Wrath of Khan','FILM','1982-06-04'),
('Star Trek III: The Search for Spock','FILM','1984-06-01'),
('Star Trek IV: The Voyage Home','FILM','1986-11-26'),
('Star Trek V: The Final Frontier','FILM','1989-12-11'),
('Star Trek VI: The Undiscovered Country','FILM','1991-12-06'),
('Star Trek','SERIE','1966-09-08'),
('Star Trek: Deep Space Nine','SERIE','1978-05-01'),
('Star Trek: Phase II','SERIE','1993-01-03'),
('Star Trek: The Next Generation','SERIE','1987-09-28');



INSERT INTO G01_Artiste(artiste_nom,artiste_pays,artiste_date_de_naissance) VALUES
('Robert Wise','United States of America','1914-09-10'),
('Nicholas Meyer','United States of America','1945-12-24'),
('Leonard Nimoy','United States of America','1931-03-26'),
('William Shatner','Canada','1931-03-22'),
('Jackson DeForest Kelley','United States of America','1920-01-20'),
('George Takei','Japan','1937-04-20'),
('Gene Roddenberry','United States of America','1921-08-19'),
('Richard Keith Berman','United States of America','1945-12-25'),
('Grace Lee Whitney','United States of America','1930-04-01'),
('Jonathan Scott Frakes','United States of America','1952-08-19');




INSERT INTO G01_realiser(oeuvre_id,artiste_id) VALUES
((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1979-08-29'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Robert Wise')),

((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1982-06-04'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Nicholas Meyer')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1984-06-01'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Leonard Nimoy')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1986-11-26'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'William Shatner')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1989-12-11'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Jackson DeForest Kelley')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1991-12-06'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'George Takei')),

((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1966-09-08'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Gene Roddenberry')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1978-05-01'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Richard Keith Berman')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1993-01-03'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Grace Lee Whitney')),


((SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1987-09-28'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Jonathan Scott Frakes'));


INSERT INTO G01_interprete(personnage_nom,personnageAnneDeNaissance,oeuvre_id,artiste_id) VALUES
('Pavel Chekov',2245,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1979-08-29'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Robert Wise')),


('Khan Noonien Singh',2285,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1982-06-04'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Nicholas Meyer')),

('Spock',2230,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1984-06-01'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Leonard Nimoy')),

('James Tiberius Kirk',2233,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1986-11-26'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'William Shatner')),

('Leonard H. McCoy',2227,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1989-12-11'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Jackson DeForest Kelley')),

('Hikaru Sulu',2237,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1991-12-06'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'George Takei')),

('Montgomery Scott',2222,(SELECT oeuvre_id FROM G01_Oeuvre WHERE oeuvre_date_de_sortie = '1966-09-08'),
(SELECT artiste_id FROM G01_Artiste WHERE artiste_nom = 'Gene Roddenberry'));
