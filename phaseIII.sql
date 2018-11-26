DROP TABLE IF EXISTS SYSTEM_INFO;
DROP TABLE IF EXISTS CUSTOMER;
DROP TABLE IF EXISTS ORDER_ITEM;
DROP TABLE IF EXISTS REVIEW;
DROP TABLE IF EXISTS PLAYS_AT;
DROP TABLE IF EXISTS SHOWTIME;
DROP TABLE IF EXISTS PREFERS;
DROP TABLE IF EXISTS MANAGER;
DROP TABLE IF EXISTS THEATER;
DROP TABLE IF EXISTS MOVIE;
DROP TABLE IF EXISTS PAYMENT_INFO;

CREATE TABLE MANAGER
(
	Username VARCHAR(15) NOT NULL,
	Email VARCHAR(30) NOT NULL,
	Password_Manager VARCHAR(20) NOT NULL,
	CONSTRAINT MAPK PRIMARY KEY(Username, Email)
);

INSERT INTO MANAGER VALUES('swmaryland', 'swmaryland@uamovie.com', 'g00dboy1');
INSERT INTO MANAGER VALUES('aamanning', 'aamanning@uamovie.com', 'passw0rd!');
INSERT INTO MANAGER VALUES('scao', 'scao@uamovie.com', 'moviefuff112');
INSERT INTO MANAGER VALUES('nvanhaute', 'nvanhaute@uamovie.com', 'sweetn1blets');
INSERT INTO MANAGER VALUES('amusaev', 'amusaev@uamovie.com', 'b0ssman3');

CREATE TABLE CUSTOMER
(
	Username VARCHAR(15) NOT NULL,
	Email VARCHAR(30) NOT NULL,
	Password_Customer VARCHAR(20) NOT NULL,
	CONSTRAINT MAPK PRIMARY KEY(Username, Email)
);
INSERT INTO CUSTOMER VALUES('mheine', 'mheine@uamovie.com', 'hookem1');
INSERT INTO CUSTOMER VALUES('amow7', 'mheine@uamovie.com', 'g0dawgs');
INSERT INTO CUSTOMER VALUES('caro.wells', 'cwells@ua.edu', 'd0thanrulez!');
INSERT INTO CUSTOMER VALUES('cliffp', 'pricec@ua.edu', 'league0flegends');
INSERT INTO CUSTOMER VALUES('lukehatfield', 'luke@gt.edu', 'g0bucks');
INSERT INTO CUSTOMER VALUES('bpierson', 'bradley.p@uga.edu', 'lilyismygf112');
INSERT INTO CUSTOMER VALUES('nickbell', 'nbell7@tech.com', 'buzzhorns1');
INSERT INTO CUSTOMER VALUES('skipm', 'skip@maryland.com', 'ele1phant');
INSERT INTO CUSTOMER VALUES('geralyn.ann', 'geri@maryland.com', 'bensamw1ll');
INSERT INTO CUSTOMER VALUES('brennen.clifford', 'brendog@bellsouth.net', 'b1llsmafia');
INSERT INTO CUSTOMER VALUES('austinb', 'blackmon.a@comcast.net', 'crackerBarrell1');
INSERT INTO CUSTOMER VALUES('carter.shelt', 'cshelton@crimson.com', 'r1ppedboy');
INSERT INTO CUSTOMER VALUES('imaqtpie', 'qt@pie.org', 'shmolket7');
INSERT INTO CUSTOMER VALUES('danielmarzec', 'dm7@ibm.com', 'crypt0goon');
INSERT INTO CUSTOMER VALUES('mike.spisak', 'spisak@ibm.com', 'havynRulez2');
INSERT INTO CUSTOMER VALUES('jgrant', 'jusgrant@ibm.com', 'secretagentman234');
INSERT INTO CUSTOMER VALUES('everest.chiu', 'echiu7@illinois.com', 'soccerman7');
INSERT INTO CUSTOMER VALUES('maguilera', 'meghan@giggles.org', 'br0dyagui');
INSERT INTO CUSTOMER VALUES('ceaguilera', 'carlos@cobb.com', 'arch1tect');
INSERT INTO CUSTOMER VALUES('mhuber7', 'megan.h@gt.edu', 'pennsylvan1a8');
INSERT INTO CUSTOMER VALUES('zzalar', 'zz@buzz.com', 'h0ckey1');
INSERT INTO CUSTOMER VALUES('hannah.williams', 'hwill@some.edu', 'passw0rds');
INSERT INTO CUSTOMER VALUES('bgates2', 'bill@windows.com', '0sg00d');
INSERT INTO CUSTOMER VALUES('steven.jobs', 'stevie@apple.com', 'ip0dnan0');
INSERT INTO CUSTOMER VALUES('woz.s', 'steven@apple.com', 'ididitreally!');
INSERT INTO CUSTOMER VALUES('eldrick.woods', 'tiger@woods.com', 'majorchamp17');

CREATE TABLE REVIEW
(
	Review_ID INT,
	Title VARCHAR(100) NOT NULL,
	Comments VARCHAR(255),
	Rating INT,
	Username VARCHAR(15),
	CONSTRAINT REPK PRIMARY KEY (Review_ID),
	CONSTRAINT REMOFK FOREIGN KEY (Title) REFERENCES MOVIE(Title) ON DELETE CASCADE ON UPDATE CASCADE
);



CREATE TABLE PAYMENT_INFO
(
	Card_No LONG INT NOT NULL,
	CVV	INT NOT NULL,
	Name_On_Card VARCHAR(20) NOT NULL,
	Espiration_Date VARCHAR(20) NOT NULL,
	Saved BOOLEAN,
	Username VARCHAR(15) NOT NULL,
	CONSTRAINT PAPK PRIMARY KEY (Card_No),
	CONSTRAINT PACUFK FOREIGN KEY (Username) REFERENCES CUSTOMER(Username) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE ORDER_ITEM
(
	Order_ID LONG INT NOT NULL,
	Order_Date VARCHAR(20) NOT NULL,
	Num_Senior_Tickets	INT,
	Num_Child_Tickets	INT,
	Num_Total_tickets	INT,
	Order_Time	VARCHAR(20) NOT NULL,
	Order_Status VARCHAR(10),
	Card_No LONG INT NOT NULL,
	Username VARCHAR(15) NOT NULL,
	Title VARCHAR(100) NOT NULL,
	Theater_ID INT,
	CONSTRAINT ORPK PRIMARY KEY (Order_ID),
	CONSTRAINT ORMOFK FOREIGN KEY (Title) REFERENCES MOVIE(Title) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT ORCUFK FOREIGN KEY (Username) REFERENCES CUSTOMER(Username) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT ORPAFK FOREIGN KEY (Card_No) REFERENCES PAYMENT_INFO(Card_No) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT ORTHFK FOREIGN KEY (Theater_ID) REFERENCES THEATER(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE MOVIE
(
	Title VARCHAR(100) NOT NULL,
	Movie_Cast VARCHAR(255) NOT NULL,
	Synopsis	VARCHAR(1000) NOT NULL,
	Movie_Length	DOUBLE
	Movie_Genre	VARCHAR(10) NOT NULL,
	Release_Date VARCHAR(20) NOT NULL,
	Rating	INT,
	CONSTRAINT MOPK PRIMARY KEY (Title)
);

CREATE TABLE PLAYS_AT
(
	Playing BOOLEAN,
	Title VARCHAR(100) NOT NULL,
	Theater_ID INT,
	CONSTRAINT PLPK PRIMARY KEY (Title, Theater_ID),
	CONSTRAINT PLMOFK FOREIGN KEY (Title) REFERENCES MOVIE(Title) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PLTHFK FOREIGN KEY (Theater_ID) REFERENCES THEATER(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE SHOWTIME
(
	Showtime VARCHAR(20) NOT NULL,
	Theater_ID INT,
	Title VARCHAR(100) NOT NULL,
	CONSTRAINT SHFK PRIMARY KEY (Showtime, Theater_ID, Title),
	CONSTRAINT SHTHFK FOREIGN KEY (Theater_ID) REFERENCES THEATER(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT SHMOFK FOREIGN KEY (Title) REFERENCES MOVIE(Title) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE THEATER
(
	Theater_ID INT,
	Name	VARCHAR(20),
	Theater_State	VARCHAR(20),
	Theater_City	VARCHAR(20),
	Theater_Street	VARCHAR(20),
	Theater_ZIP	INT,
	CONSTRAINT THPK PRIMARY KEY (Theater_ID)
);

CREATE TABLE SYSTEM_INFO
(
	Cancellation_Fee INT,
	Manager_password VARCHAR(20) NOT NULL,
	Child_discount	DOUBLE,
	Senior_discount	DOUBLE
);

CREATE TABLE PREFERS
(
	Theater_ID INT,
	Username VARCHAR(15) NOT NULL,
	CONSTRAINT PRPK PRIMARY KEY (Theater_ID, Username),
	CONSTRAINT PRCUFK FOREIGN KEY (Username) REFERENCES CUSTOMER(Username) ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT PRTHFK FOREIGN KEY (Theater_ID) REFERENCES THEATER(Theater_ID) ON DELETE CASCADE ON UPDATE CASCADE
);

