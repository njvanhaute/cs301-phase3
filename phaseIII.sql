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

CREATE TABLE CUSTOMER
(
	Username VARCHAR(15) NOT NULL,
	Email VARCHAR(30) NOT NULL,
	Password_Customer VARCHAR(20) NOT NULL,
	CONSTRAINT MAPK PRIMARY KEY(Username, Email)
);

CREATE TABLE MOVIE
(
	Title VARCHAR(100) NOT NULL,
	Movie_Cast VARCHAR(255) NOT NULL,
	Synopsis	VARCHAR(1000) NOT NULL,
	Movie_Length	INT,
	Movie_Genre	VARCHAR(10) NOT NULL,
	Release_Date VARCHAR(20) NOT NULL,
	Rating	VARCHAR(10),
	CONSTRAINT MOPK PRIMARY KEY (Title)
);


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
	Expiration_Date VARCHAR(20) NOT NULL,
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
  Num_Adult_Tickets INT,
	Num_Total_Tickets	INT,
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

INSERT INTO MANAGER VALUES('swmaryland', 'swmaryland@uamovie.com', 'g00dboy1');
INSERT INTO MANAGER VALUES('aamanning', 'aamanning@uamovie.com', 'passw0rd!');
INSERT INTO MANAGER VALUES('scao', 'scao@uamovie.com', 'moviefuff112');
INSERT INTO MANAGER VALUES('nvanhaute', 'nvanhaute@uamovie.com', 'sweetn1blets');
INSERT INTO MANAGER VALUES('amusaev', 'amusaev@uamovie.com', 'b0ssman3');

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

INSERT INTO MOVIE VALUES("Creed II", "Michael B. Jordan, Sylvester Stallone, Tessa Thompson, Phyliia Rashad, Wood Harris", "Life has become a balancing act for Adonis Creed. Between personal obligations and training for his next big fight, he is up against the challenge of his life. Facing an opponent with ties to his family's past only intensifies his impending battle in the ring. Rocky Balboa is there by his side through it all and, together, Rocky and Adonis will confront their shared legacy, question what's worth fighting for, and discover that nothing's more important than family. Creed II is about going back to basics to rediscover what made you a champion in the first place, and remembering that, no matter where you go, you can't escape your history.", 130, "Drama", "11/21/2018", "PG-13");
INSERT INTO MOVIE VALUES("Bohemian Rhapsody", "Rami Malek, Gwilym Lee, Ben Hardy, Joe Mazzello, Mike Myers", "Singer Freddie Mercury, guitarist Brian May, drummer Roger Taylor and bass guitarist John Deacon take the music world by storm when they form the rock 'n' roll band Queen in 1970. Surrounded by darker influences, Mercury decides to leave Queen years later to pursue a solo career. Diagnosed with AIDS in the 1980s, the flamboyant frontman reunites with the group for the benefit concert Live Aid; leading the band in one of the greatest performances in rock history.", 135, "Drama", "11/02/2018", "PG-13");
INSERT INTO MOVIE VALUES("Dr. Seuss’ The Grinch", "Benedict Cumberbatch, Rashida Jones, Tristan O’Hare, Scarlett Estevez, Cameron Seely", "Academy Award® nominee Benedict Cumberbatch lends his voice to the infamous Grinch, who lives a solitary life inside a cave on Mt. Crumpet with only his loyal dog, Max, for company. With a cave rigged with inventions and contraptions for his day-to-day needs, the Grinch only sees his neighbors in Who-ville when he runs out of food. Each year at Christmas they disrupt his tranquil solitude with their increasingly bigger, brighter and louder celebrations. When the Whos declare they are going to make Christmas three times bigger this year, the Grinch realizes there is only one way for him to gain some peace and quiet: he must steal Christmas. To do so, he decides he will pose as Santa Claus on Christmas Eve, even going so far as to trap a lackadaisical misfit reindeer to pull his sleigh.", 90, "Comedy", "11/09/2018", "PG");
INSERT INTO MOVIE VALUES("Fantastic Beasts: The Crimes of Grindelwald", "Eddie Redmayne, Johnny Depp, Jude Law, Katherine Waterston, Dan Fogler", "In an effort to thwart Grindelwald's plans of raising pure-blood wizards to rule over all non-magical beings, Albus Dumbledore enlists his former student Newt Scamander, who agrees to help, unaware of the dangers that lie ahead. Lines are drawn as love and loyalty are tested, even among the truest friends and family, in an increasingly divided world.", 134, "Action/Adventure", "11/16/2018", "PG-13");
INSERT INTO MOVIE VALUES("Instant Family", "Mark Wahlberg, Rose Byrne, Isabela Moner, Octavia Spencer, Margo Martindale", "When Pete and Ellie decide to start a family, they stumble into the world of foster care adoption. They hope to take in one small child, but when they meet three siblings, including a rebellious 15-year-old girl, they find themselves speeding from zero to three kids overnight. Now, Pete and Ellie must try to learn the ropes of instant parenthood in the hope of becoming a family.", 119, "Comedy", "11/16/2018", "PG-13");
INSERT INTO MOVIE VALUES("Widows", "Viola Davis, Michelle Rodriguez, Liam Neeson, Colin Farrell, Robert Duvall", "‘Widows’ is the story of four women with nothing in common except a debt left behind by their dead husbands' criminal activities. Set in contemporary Chicago, amid a time of turmoil, tensions build when Veronica (Oscar® winner Viola Davis), Linda (Michelle Rodriguez), Alice (Elizabeth Debicki) and Belle (Cynthia Erivo) take their fate into their own hands and conspire to forge a future on their own terms. ‘Widows’ also stars Liam Neeson, Colin Farrell, Robert Duvall, Daniel Kaluuya, Lukas Haas and Brian Tyree Henry.", 128, "Suspense", "11/16/2018", "R");
INSERT INTO MOVIE VALUES("A Star is Born", "Bradley Cooper, Lady Gaga, Andrew Dice Clay, Dave Chappelle, Sam Elliott", "In this new take on the tragic love story, Bradley Cooper plays seasoned musician Jackson Maine, who discovers—and falls in love with—struggling artist Ally (Gaga). She has just about given up on her dream to make it big as a singer… until Jack coaxes her into the spotlight. But even as Ally’s career takes off, the personal side of their relationship is breaking down, as Jack fights an ongoing battle with his own internal demons.", 135, "Drama", "10/05/2018", "R");
INSERT INTO MOVIE VALUES("Ralph Breaks the Internet", "John C. Reilly, Sarah Silverman, Alan Tudyk, Jack McBrayer, Jane Lynch", "Ralph and Vanellope embark on an adventure inside the internet to find a spare part to fix a video game.", 112, "Action/Adventure", "11/21/2018", "PG");
INSERT INTO MOVIE VALUES("Robin Hood", "Taron Egerton, Eve Hewson, Jamie Foxx, Jamie Dornan, Paul Anderson", "A war-hardened Crusader and his Moorish commander mount an audacious revolt against the corrupt English crown in a thrilling action-adventure packed with gritty battlefield exploits, mind-blowing fight choreography, and a timeless romance.", 116, "Action/Adventure", "11/21/2018", "PG-13");
INSERT INTO MOVIE VALUES("The Front Runner", "Hugh Jackman, Vera Farmiga, Molly Ephraim, Kaitlyn Dever, Ari Graynor", "Oscar® nominee Hugh Jackman stars as the charismatic politician Gary Hart for Academy Award®-nominated director Jason Reitman in the new thrilling drama The Front Runner. The film follows the rise and fall of Senator Hart, who captured the imagination of young voters and was considered the overwhelming front runner for the 1988 Democratic presidential nomination when his campaign was sidelined by the story of an extramarital relationship with Donna Rice. As tabloid journalism and political journalism merged for the first time, Senator Hart was forced to drop out of the race – events that left a profound and lasting impact on American politics and the world stage.", 113, "Drama", "11/06/2018", "R");
INSERT INTO MOVIE VALUES("Beautiful Boy", "Steve Carell, Timothee Chalamet, Maura Tierney, Amy Ryan, Christian Convery", "Based on the best-selling pair of memoirs from father and son David and Nic Sheff, Beautiful Boy chronicles the heartbreaking and inspiring experience of survival, relapse, and recovery in a family coping with addiction over many years.", 120, "Drama", "10/12/2018", "R");
INSERT INTO MOVIE VALUES("Venom", "Tom Hardy, Michelle Williams, Riz Ahmed, Scott Haze, Reid Scott", "Reporter Eddie Brock develops superpowers after becoming a host to an alien parasite.", 112, "Action/Adventure", "10/05/2018", "PG-13");
INSERT INTO MOVIE VALUES("Smallfoot", "Channing Tatum, Zendaya, James Corden, Common, Lebron James", "A Yeti named Migo stirs up his community when he discovers something that he didn't know existed -- a human.", 96, "Animated", "09/28/2018", "PG");
INSERT INTO MOVIE VALUES("Boy Erased", "Nicole Kidman, Russell Crowe, Lucas Hedges, Joe Alwyn, Cherry Jones", "‘Boy Erased’ tells the story of Jared (Hedges), the son of a Baptist pastor in a small American town, who is outed to his parents (Kidman and Crowe) at age 19. Jared is faced with an ultimatum: attend a conversion therapy program – or be permanently exiled and shunned by his family, friends, and faith. Boy Erased is the true story of one young man’s struggle to find himself while being forced to question every aspect of his identity.", 115, "Documentary", "11/02/2018", "R");
INSERT INTO MOVIE VALUES("The Nutcracker and the Four Realms", "Kiera Knightley, Mackenzie Foy, Morgan Freeman, Helem Mirren, Matthew MacFayden", "Young Clara needs a magical, one-of-a-kind key to unlock a box that contains a priceless gift. A golden thread leads her to the coveted key, but it soon disappears into a strange and mysterious parallel world. In that world, she meets a soldier named Phillip, a group of mice and the regents who preside over three realms. Clara and Phillip must now enter a fourth realm to retrieve the key and restore harmony to the unstable land.", 139, "Action/Adventure", "11/02/2018", "PG");

INSERT INTO THEATER VALUES(001, "Acworth Theater", "GA", "Acworth", "5907 Brookstone Dr", 30101);
INSERT INTO THEATER VALUES(002, "Tide Theater", "AL", "Tuscaloosa", "3103 Rolling Way", 35406);
INSERT INTO THEATER VALUES(003, "OTP Cinema", "GA", "Sandy Springs", "2102 Barfield Rd", 30068);
INSERT INTO THEATER VALUES(004, "ITP Cinema", "GA", "Atlanta", "755 Hank Aaron Dr", 30315);
INSERT INTO THEATER VALUES(005, "Iron City Theater", "AL", "Birmingham", "513 22nd St S", 35233);
INSERT INTO THEATER VALUES(006, "Peanut Screens", "AL", "Dothan", "5603 Carver Way", 36301);

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

INSERT INTO PAYMENT_INFO VALUES(4276656543199739, 823, "Michael Santana", "11/2023", 1, "imaqtpie");
INSERT INTO PAYMENT_INFO VALUES(5194413228923793, 994, "Michael Santana", "06/2023", 1, "imaqtpie");
INSERT INTO PAYMENT_INFO VALUES(5286069914906911, 629, "Caroline Wells", "02/2026", 1, "caro.wells");
INSERT INTO PAYMENT_INFO VALUES(344699209276199, 8282, "Caroline Wells", "11/2026", 1, "caro.wells");
INSERT INTO PAYMENT_INFO VALUES(4552006971193116, 433, "Geri Maryland", "12/2022", 1, "geralyn.ann");
INSERT INTO PAYMENT_INFO VALUES(5442748681601927, 444, "Geri Maryland", "03/2020", 1, "geralyn.ann");
INSERT INTO PAYMENT_INFO VALUES(6011660415444301, 458, "Carlos Aguilera", "02/2025", 1, "ceaguilera");
INSERT INTO PAYMENT_INFO VALUES(4547411419334009, 192, "Carlos Aguilera", "03/2024", 1, "ceaguilera");
INSERT INTO PAYMENT_INFO VALUES(5198686929615612, 948, "Austin Blackmon", "04/2023", 1, "austinb");
INSERT INTO PAYMENT_INFO VALUES(6011525138243720, 203, "Austin Blackmon", "01/2026", 1, "austinb");
INSERT INTO PAYMENT_INFO VALUES(4395562016874277, 734, "Matt Heine", "02/2025", 1, "mheine");
INSERT INTO PAYMENT_INFO VALUES(4912871342910117, 076, "Alex Mowry", "10/2020", 1, "amow7");
INSERT INTO PAYMENT_INFO VALUES(5513025517058497, 403, "Cliff Price", "08/2022", 1, "cliffp");
INSERT INTO PAYMENT_INFO VALUES(379309212232746, 6703, "Brennen Clifford", "05/2027", 1, "brennen.clifford");
INSERT INTO PAYMENT_INFO VALUES(4015618789090697, 378, "Carter Shelton", "10/2026", 1, "carter.shelt");
INSERT INTO PAYMENT_INFO VALUES(6011455925362261, 587, "Everest Chiu", "09/2026", 1, "everest.chiu");
INSERT INTO PAYMENT_INFO VALUES(4380403607842182, 161, "Meghan Aguilera", "09/2021", 1, "maguilera");
INSERT INTO PAYMENT_INFO VALUES(4681012056488201, 136, "Mike Spisak", "11/2027", 1, "mike.spisak");
INSERT INTO PAYMENT_INFO VALUES(5501447884574357, 376, "Justin Grant", "01/2022", 1, "jgrant");
INSERT INTO PAYMENT_INFO VALUES(5363363524515956, 067, "Skip Maryland", "11/2023", 1, "skipm");
INSERT INTO PAYMENT_INFO VALUES(4693856794670298, 736, "Nick Bell", "05/2021", 1, "nickbell");
INSERT INTO PAYMENT_INFO VALUES(6011976341234529, 736, "Megan Huber", "10/2026", 1, "mhuber7");
INSERT INTO PAYMENT_INFO VALUES(4949810261349086, 645, "Daniel Marzec", "06/2021", 1, "danielmarzec");

INSERT INTO ORDER_ITEM VALUES(001, "10/15/2018", 1, 0, 1, 2, "20:00", "completed", 5286069914906911, "caro.wells", "A Star is Born", 006);
INSERT INTO ORDER_ITEM VALUES(002, "11/03/2018", 1, 0, 1, 2, "15:00", "completed", 344699209276199, "caro.wells", "The Nutcracker and the Four Realms", 006);
INSERT INTO ORDER_ITEM VALUES(003, "11/05/2018", 0, 1, 1, 2, "13:00", "completed", 4552006971193116, "geralyn.ann", "Bohemian Rhapsody", 001);
INSERT INTO ORDER_ITEM VALUES(004, "11/05/2018", 1, 0, 1, 2, "14:30", "completed", 4395562016874277, "mheine", "Creed II", 002);
INSERT INTO ORDER_ITEM VALUES(005, "11/06/2018", 0, 1, 1, 2, "11:00", "completed", 4912871342910117, "amow7", "Dr. Seuss’ The Grinch", 003);
INSERT INTO ORDER_ITEM VALUES(006, "11/07/2018", 1, 1, 0, 2, "19:00", "completed", 5513025517058497, "cliffp", "Fantastic Beasts: The Crimes of Grindelwald", 002);
INSERT INTO ORDER_ITEM VALUES(007, "11/07/2018", 0, 0, 2, 2, "17:30", "completed", 4276656543199739, "imaqtpie", "Instant Family", 004);
INSERT INTO ORDER_ITEM VALUES(008, "11/08/2018", 1, 1, 0, 2, "20:00", "completed", 5194413228923793, "imaqtpie", "Widows", 004);
INSERT INTO ORDER_ITEM VALUES(009, "11/10/2018", 2, 0, 0, 2, "12:15", "completed", 4681012056488201, "mike.spisak", "Ralph Breaks the Internet", 003);
INSERT INTO ORDER_ITEM VALUES(010, "11/11/2018", 0, 2, 0, 2, "11:00", "completed", 5501447884574357, "jgrant", "Robin Hood", 004);
INSERT INTO ORDER_ITEM VALUES(011, "11/13/2018", 0, 0, 0, 1, "14:45", "completed", 5363363524515956, "skipm", "The Front Runner", 001);
INSERT INTO ORDER_ITEM VALUES(012, "11/14/2018", 1, 0, 0, 1, "13:14", "completed", 4693856794670298, "nickbell", "Beautiful Boy", 003);
INSERT INTO ORDER_ITEM VALUES(013, "11/15/2018", 0, 1, 0, 1, "21:15", "completed", 6011976341234529, "mhuber7", "Venom", 004);
INSERT INTO ORDER_ITEM VALUES(014, "11/16/2018", 0, 0, 1, 1, "22:00", "completed", 5198686929615612, "austinb", "Smallfoot", 002);
INSERT INTO ORDER_ITEM VALUES(015, "11/16/2018", 1, 0, 0, 1, "11:30", "completed", 4547411419334009, "ceaguilera", "Boy Erased", 004);
INSERT INTO ORDER_ITEM VALUES(016, "11/20/2018", 0, 1, 0, 1, "12:15", "completed", 4949810261349086, "danielmarzec", "A Star is Born", 004);
INSERT INTO ORDER_ITEM VALUES(017, "11/20/2018", 0, 2, 2, 4, "13:45", "completed",  4015618789090697, "carter.shelt", "The Front Runner", 002);
INSERT INTO ORDER_ITEM VALUES(018, "11/21/2018", 2, 1, 3, 6, "20:15", "completed", 5194413228923793, "imaqtpie", "Bohemian Rhapsody", 001);
INSERT INTO ORDER_ITEM VALUES(019, "11/22/2018", 1, 1, 1, 3, "00:30", "completed", 6011455925362261, "everest.chiu", "Venom", 003);
INSERT INTO ORDER_ITEM VALUES(020, "11/22/2018", 0, 0, 0, 1, "12:15", "completed", 4380403607842182, "maguilera", "Smallfoot", 003);
INSERT INTO ORDER_ITEM VALUES(041, "11/23/2018", 5, 0, 0, 5, "13:00", "cancelled", 5442748681601927, "amow7", "Dr. Seuss’ The Grinch", 001);
INSERT INTO ORDER_ITEM VALUES(021, "12/16/2018", 0, 2, 0, 2, "13:00", "cancelled", 5198686929615612, "austinb", "Bohemian Rhapsody", 002);
INSERT INTO ORDER_ITEM VALUES(022, "12/16/2018", 0, 0, 1, 1, "12:40", "cancelled", 5363363524515956, "skipm", "A Star is Born", 001);
INSERT INTO ORDER_ITEM VALUES(023, "12/17/2018", 1, 0, 0, 1, "01:00", "cancelled", 344699209276199, "caro.wells", "Creed II", 006);
INSERT INTO ORDER_ITEM VALUES(024, "12/17/2018", 1, 0, 0, 1, "12:00", "cancelled", 5513025517058497, "cliffp", "Beautiful Boy", 002);
INSERT INTO ORDER_ITEM VALUES(025, "12/18/2018", 0, 2, 2, 4, "15:15", "cancelled", 4681012056488201, "mike.spisak", "Boy Erased", 004);
INSERT INTO ORDER_ITEM VALUES(026, "12/19/2018", 2, 3, 4, 9, "16:03", "cancelled", 6011525138243720, "austinb", "Widows", 002);
INSERT INTO ORDER_ITEM VALUES(027, "12/19/2018", 0, 0, 1, 1, "16:15", "cancelled", 5501447884574357, "jgrant", "The Nutcracker and the Four Realms", 003);
INSERT INTO ORDER_ITEM VALUES(028, "12/20/2018", 1, 0, 1, 2, "17:40", "cancelled", 5442748681601927, "geralyn.ann", "Venom", 001);
INSERT INTO ORDER_ITEM VALUES(029, "12/21/2018", 0, 0, 1, 1, "14:00", "cancelled", 4912871342910117, "amow7", "Smallfoot", 005);
INSERT INTO ORDER_ITEM VALUES(030, "12/22/2018", 5, 0, 0, 1, "12:45", "cancelled", 4693856794670298, "nickbell", "Instant Family", 005);
INSERT INTO ORDER_ITEM VALUES(031, "12/18/2018", 1, 0, 0, 1, "13:00", "unused", 6011455925362261, "everest.chiu", "Dr. Seuss’ The Grinch", 003);
INSERT INTO ORDER_ITEM VALUES(032, "12/18/2018", 1, 0, 1, 2, "14:30", "unused", 344699209276199, "caro.wells", "Bohemian Rhapsody", 006);
INSERT INTO ORDER_ITEM VALUES(033, "12/19/2018", 0, 0, 2, 2, "12:45", "unused", 4912871342910117, "amow7", "Boy Erased", 004);
INSERT INTO ORDER_ITEM VALUES(034, "12/20/2018", 0, 1, 1, 2, "15:00", "unused", 4395562016874277, "mheine", "Creed II", 001);
INSERT INTO ORDER_ITEM VALUES(035, "12/21/2018", 2, 0, 2, 4, "16:20", "unused", 379309212232746, "brennen.clifford", "Fantastic Beasts: The Crimes of Grindelwald", 005);
INSERT INTO ORDER_ITEM VALUES(036, "12/24/2018", 0, 0, 1, 1, "09:30", "unused", 4693856794670298, "nickbell", "Creed II", 001);
INSERT INTO ORDER_ITEM VALUES(037, "12/24/2018", 0, 1, 1, 2, "10:20", "unused", 5194413228923793, "imaqtpie", "Smallfoot", 003);
INSERT INTO ORDER_ITEM VALUES(038, "12/25/2018", 0, 0, 1, 1, "12:00", "unused", 6011660415444301, "ceaguilera", "Widows", 004);
INSERT INTO ORDER_ITEM VALUES(039, "12/26/2018", 0, 0, 1, 1, "13:45", "unused", 5363363524515956, "skipm", "Bohemian Rhapsody", 002);
INSERT INTO ORDER_ITEM VALUES(040, "12/30/2018", 0, 1, 2, 3, "14:00", "unused", 5198686929615612, "austinb", "Ralph Breaks the Internet", 005);

INSERT INTO PLAYS_AT VALUES(1, "Creed II", 001);
INSERT INTO PLAYS_AT VALUES(1, "Creed II", 002);
INSERT INTO PLAYS_AT VALUES(0, "Creed II", 003);
INSERT INTO PLAYS_AT VALUES(1, "Creed II", 006);
INSERT INTO PLAYS_AT VALUES(1, "Bohemian Rhapsody", 001);
INSERT INTO PLAYS_AT VALUES(1, "Bohemian Rhapsody", 002);
INSERT INTO PLAYS_AT VALUES(0, "Bohemian Rhapsody", 004);
INSERT INTO PLAYS_AT VALUES(1, "Bohemian Rhapsody", 006);
INSERT INTO PLAYS_AT VALUES(1, "Dr. Seuss’ The Grinch", 001);
INSERT INTO PLAYS_AT VALUES(1, "Dr. Seuss’ The Grinch", 003);
INSERT INTO PLAYS_AT VALUES(0, "Dr. Seuss’ The Grinch", 006);
INSERT INTO PLAYS_AT VALUES(1, "Fantastic Beasts: The Crimes of Grindelwald", 002);
INSERT INTO PLAYS_AT VALUES(1, "Fantastic Beasts: The Crimes of Grindelwald", 005);
INSERT INTO PLAYS_AT VALUES(0, "Fantastic Beasts: The Crimes of Grindelwald", 006);
INSERT INTO PLAYS_AT VALUES(0, "Instant Family", 001);
INSERT INTO PLAYS_AT VALUES(1, "Instant Family", 004);
INSERT INTO PLAYS_AT VALUES(1, "Instant Family", 005);
INSERT INTO PLAYS_AT VALUES(0, "Widows", 001);
INSERT INTO PLAYS_AT VALUES(1, "Widows", 002);
INSERT INTO PLAYS_AT VALUES(1, "Widows", 004);
INSERT INTO PLAYS_AT VALUES(1, "A Star is Born", 001);
INSERT INTO PLAYS_AT VALUES(1, "A Star is Born", 004);
INSERT INTO PLAYS_AT VALUES(1, "A Star is Born", 006);
INSERT INTO PLAYS_AT VALUES(1, "Ralph Breaks the Internet", 002);
INSERT INTO PLAYS_AT VALUES(1, "Ralph Breaks the Internet", 003);
INSERT INTO PLAYS_AT VALUES(1, "Ralph Breaks the Internet", 005);
INSERT INTO PLAYS_AT VALUES(1, "Robin Hood", 004);
INSERT INTO PLAYS_AT VALUES(1, "The Front Runner", 001);
INSERT INTO PLAYS_AT VALUES(1, "The Front Runner", 002);
INSERT INTO PLAYS_AT VALUES(1, "Beautiful Boy", 001);
INSERT INTO PLAYS_AT VALUES(1, "Beautiful Boy", 002);
INSERT INTO PLAYS_AT VALUES(1, "Beautiful Boy", 003);
INSERT INTO PLAYS_AT VALUES(1, "Venom", 001);
INSERT INTO PLAYS_AT VALUES(1, "Venom", 003);
INSERT INTO PLAYS_AT VALUES(1, "Venom", 004);
INSERT INTO PLAYS_AT VALUES(0, "Venom", 005);
INSERT INTO PLAYS_AT VALUES(1, "Smallfoot", 002);
INSERT INTO PLAYS_AT VALUES(1, "Smallfoot", 003);
INSERT INTO PLAYS_AT VALUES(1, "Smallfoot", 005);
INSERT INTO PLAYS_AT VALUES(0, "Boy Erased", 002);
INSERT INTO PLAYS_AT VALUES(1, "Boy Erased", 003);
INSERT INTO PLAYS_AT VALUES(1, "Boy Erased", 004);
INSERT INTO PLAYS_AT VALUES(1, "The Nutcracker and the Four Realms", 003);
INSERT INTO PLAYS_AT VALUES(0, "The Nutcracker and the Four Realms", 005);
INSERT INTO PLAYS_AT VALUES(1, "The Nutcracker and the Four Realms", 006);

INSERT INTO SHOWTIME VALUES("13:00", 002, "Bohemian Rhapsody");
INSERT INTO SHOWTIME VALUES("12:40", 001, "A Star is Born");
INSERT INTO SHOWTIME VALUES("01:00", 006, "Creed II");
INSERT INTO SHOWTIME VALUES("12:00", 002, "Beautiful Boy");
INSERT INTO SHOWTIME VALUES("15:15", 004, "Boy Erased");
INSERT INTO SHOWTIME VALUES("16:03", 002, "Widows");
INSERT INTO SHOWTIME VALUES("16:15", 003, "The Nutcracker and the Four Realms");
INSERT INTO SHOWTIME VALUES("17:40", 001, "Venom");
INSERT INTO SHOWTIME VALUES("14:00", 005, "Smallfoot");
INSERT INTO SHOWTIME VALUES("12:45", 005, "Instant Family");
INSERT INTO SHOWTIME VALUES("13:00", 003, "Dr. Seuss’ The Grinch");
INSERT INTO SHOWTIME VALUES("14:30", 006, "Bohemian Rhapsody");
INSERT INTO SHOWTIME VALUES("12:45", 004, "Boy Erased");
INSERT INTO SHOWTIME VALUES("15:00", 001, "Creed II");
INSERT INTO SHOWTIME VALUES("16:20", 005, "Fantastic Beasts: The Crimes of Grindelwald");
INSERT INTO SHOWTIME VALUES("09:30", 001, "Creed II");
INSERT INTO SHOWTIME VALUES("10:20", 003, "Smallfoot");
INSERT INTO SHOWTIME VALUES("12:00", 004, "Widows");
INSERT INTO SHOWTIME VALUES("13:45", 002, "Bohemian Rhapsody");
INSERT INTO SHOWTIME VALUES("14:00", 005, "Ralph Breaks the Internet");

INSERT INTO SYSTEM_INFO VALUES(5, "imthecaptainnow1", 0.20, 0.30);

INSERT INTO PREFERS VALUES(006, "caro.wells");
INSERT INTO PREFERS VALUES(002, "caro.wells");
INSERT INTO PREFERS VALUES(001, "geralyn.ann");
INSERT INTO PREFERS VALUES(003, "geralyn.ann");
INSERT INTO PREFERS VALUES(003, "nickbell");
INSERT INTO PREFERS VALUES(004, "nickbell");
INSERT INTO PREFERS VALUES(001, "ceaguilera");
INSERT INTO PREFERS VALUES(004, "ceaguilera");
INSERT INTO PREFERS VALUES(001, "amow7");
INSERT INTO PREFERS VALUES(005, "amow7");
INSERT INTO PREFERS VALUES(002, "austinb");
INSERT INTO PREFERS VALUES(002, "carter.shelt");
INSERT INTO PREFERS VALUES(003, "lukehatfield");
INSERT INTO PREFERS VALUES(005, "brennen.clifford");
INSERT INTO PREFERS VALUES(006, "danielmarzec");
