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

INSERT INTO REVIEW VALUES(001, "The Nutcracker and the Four Realms", "Cinematography was fabulous, plotline had a great twist, because without it the movie would have been very predictable. I really appreciated how everyone's name was Christmas themed, it really brought the spirit of Christmas to my heart!", 4, "caro.wells");
INSERT INTO REVIEW VALUES(002, "A Star is Born", "SPOILER ALERT: the ending is horrible. No redeeming qualities about the movie whatsoever. The married couple, you think is going to recommit to one another after he gets out my rehab, but instead he commits suicide! After two and half hours of watching their marriage unfold, it fails miserably by ending in suicide. I wouldn’t wish my worst enemy had to sit through this 2 hour joke of a film.", 2, "caro.wells");
INSERT INTO REVIEW VALUES(003, "Bohemian Rhapsody", "I didn't know much about Freddie's life so it was very interesting to see. Plus, I love Queen!", 4, "geralyn.ann");
INSERT INTO REVIEW VALUES(004, "Creed II", "If Creed is the reboot of the Rocky brand, then this was great and deserved the 5th star I didn’t give it. Many of the film’s motifs paid homage to the successful story of Rocky from years past.", 5, "mheine");
INSERT INTO REVIEW VALUES(005, "Dr. Seuss’ The Grinch", "Well first off I love the Grinch in general so I couldn't wait for this movie. Once I could order tickets I scooped them up. But this Grinch movie is the most cutest I believe. The message of it is great.", 4, "amow7");
INSERT INTO REVIEW VALUES(006, "Fantastic Beasts: The Crimes of Grindelwald", "Even worse than the first Fantastic Beasts movie, this is a disaster of a film. The story is all over the place and hard to follow, or even care about.", 1, "cliffp");
INSERT INTO REVIEW VALUES(007, "Instant Family", "One of the best movies!! Especially, if your thinking about fostering a child or children. It opens one’s heart to believe in hope and a great family for children that are struggling.", 5, "imaqtpie");
INSERT INTO REVIEW VALUES(008, "Widows", "I expected so much more. Everything felt rushed and there was no character development whatsoever.", 2, "imaqtpie");
INSERT INTO REVIEW VALUES(009, "Ralph Breaks the Internet", "The movie was hilarious! I liked that there was YouTube, Facebook, Snapchat, Instagram, Twitter, eBay, Fandango, IMDb, Amazon, etc!", 5, "mike.spisak");
INSERT INTO REVIEW VALUES(010, "Robin Hood", "I didn’t want to go. I really enjoyed the movie!! 5 stars!!", 5, "jgrant");
INSERT INTO REVIEW VALUES(011, "The Front Runner", "This movie was just flat. Boring. Nothing exciting or even Interesting. Don’t waste your money.", 2, "skipm");
INSERT INTO REVIEW VALUES(012, "Beautiful Boy", "In the beginning, 3 things 1. the dad was rocking out with the boy acid rock music. (lyrics can seep into your soul). 2. the boy went thru a divorce at an early age and was put on a plane for visitations with dad.", 4, "nickbell");
INSERT INTO REVIEW VALUES(013, "Venom", "This movie is a joke, in a bad way. Bad action scenes, bad acting, and worse screenplay. The voice over venom was unbearable to listen to. Would compare this to the last air bender.", 1, "mhuber7");
INSERT INTO REVIEW VALUES(014, "Smallfoot", "Cute! Happily surprised that channing could sing well. And common’s rap was AMAZING.", 4, "austinb");
INSERT INTO REVIEW VALUES(015, "Boy Erased", "It was such a touching story that most people have never even thought about. I cried because I am all to familiar with a lot of the situations in this film and they were portrayed perfectly.", 4, "ceaguilera");
INSERT INTO REVIEW VALUES(016, "A Star is Born", "Excellent!! As usual Bradley Cooper nails it and Lady Gaga stole the Show.... A + All Around - Best movie of the year for me!!", 5, "danielmarzec");
INSERT INTO REVIEW VALUES(017, "The Front Runner", "Very disappointing. Although I knew the story I thought there would be more substance.", 3, "carter.shelt");
INSERT INTO REVIEW VALUES(018, "Bohemian Rhapsody", "This was a really good movie. Really good. Rami Malek was amazing, and the rest of the cast was equally great. It was interesting to see a perspective on the development of the band.", 4, "imaqtpie");
INSERT INTO REVIEW VALUES(019, "Venom", "It's about time to get a better version of venom. Can't wait for the next movie.", 4, "everest.chiu");
INSERT INTO REVIEW VALUES(020, "Smallfoot", "A 6 year old, 12 year old and a 45 year old all enjoyed this movie; a rare feat. I noticed that the fan rating was pretty low but after seeing the movie, I think I know why.", 5, "maguilera");

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

INSERT INTO PAYMENT_INFO VALUES(4276656543199739, 823, "Michael Santana", "11/2023", TRUE, "imaqtpie");
INSERT INTO PAYMENT_INFO VALUES(5194413228923793, 994, "Michael Santana", "06/2023", TRUE, "imaqtpie");
INSERT INTO PAYMENT_INFO VALUES(5286069914906911, 629, "Caroline Wells", "02/2026", TRUE, "caro.wells");
INSERT INTO PAYMENT_INFO VALUES(344699209276199, 8282, "Caroline Wells", "11/2026", TRUE, "caro.wells");
INSERT INTO PAYMENT_INFO VALUES(4552006971193116, 433, "Geri Maryland", "12/2022", TRUE, "geralyn.ann");
INSERT INTO PAYMENT_INFO VALUES(5442748681601927, 444, "Geri Maryland", "03/2020", TRUE, "geralyn.ann");
INSERT INTO PAYMENT_INFO VALUES(6011660415444301, 458, "Carlos Aguilera", "02/2025", TRUE, "ceaguilera");
INSERT INTO PAYMENT_INFO VALUES(4547411419334009, 192, "Carlos Aguilera", "03/2024", TRUE, "ceaguilera");
INSERT INTO PAYMENT_INFO VALUES(5198686929615612, 948, "Austin Blackmon", "04/2023", TRUE, "austinb");
INSERT INTO PAYMENT_INFO VALUES(6011525138243720, 203, "Austin Blackmon", "01/2026", TRUE, "austinb");
INSERT INTO PAYMENT_INFO VALUES(4395562016874277, 734, "Matt Heine", "02/2025", TRUE, "mheine");
INSERT INTO PAYMENT_INFO VALUES(4912871342910117, 076, "Alex Mowry", "10/2020", TRUE, "amow7");
INSERT INTO PAYMENT_INFO VALUES(5513025517058497, 403, "Cliff Price", "08/2022", TRUE, "cliffp");
INSERT INTO PAYMENT_INFO VALUES(379309212232746, 6703, "Brennen Clifford", "05/2027", TRUE, "brennen.clifford");
INSERT INTO PAYMENT_INFO VALUES(4015618789090697, 378, "Carter Shelton", "10/2026", TRUE, "carter.shelt");
INSERT INTO PAYMENT_INFO VALUES(6011455925362261, 587, "Everest Chiu", "09/2026", TRUE, "everest.chiu");
INSERT INTO PAYMENT_INFO VALUES(4380403607842182, 161, "Meghan Aguilera", "09/2021", TRUE, "maguilera");
INSERT INTO PAYMENT_INFO VALUES(4681012056488201, 136, "Mike Spisak", "11/2027", TRUE, "mike.spisak");
INSERT INTO PAYMENT_INFO VALUES(5501447884574357, 376, "Justin Grant", "01/2022", TRUE, "jgrant");
INSERT INTO PAYMENT_INFO VALUES(5363363524515956, 067, "Skip Maryland", "11/2023", TRUE, "skipm");
INSERT INTO PAYMENT_INFO VALUES(4693856794670298, 736, "Nick Bell", "05/2021", TRUE, "nickbell");
INSERT INTO PAYMENT_INFO VALUES(6011976341234529, 736, "Megan Huber", "10/2026", TRUE, "mhuber7");
INSERT INTO PAYMENT_INFO VALUES(4949810261349086, 645, "Daniel Marzec", "06/2021", TRUE, "danielmarzec");

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

