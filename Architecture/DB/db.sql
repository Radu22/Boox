

CREATE TABLE USERS (
	user_id 		 INT NOT NULL PRIMARY KEY,
	firstname		 VARCHAR2(30) NOT NULL,
	lastname 	 	 VARCHAR2(30),
	email 			 VARCHAR2(40) NOT NULL,
	username 		 VARCHAR2(10) NOT NULL,
	password 		 VARCHAR2(20) NOT NULL
);

CREATE TABLE BOOK_ADDED(
   book_id 			INT NOT NULL PRIMARY KEY,
   id 				INT NOT NULL,
   book_title		VARCHAR2(50) NOT NULL,
   book_author 		VARCHAR2(50) NOT NULL,
   ISBN				INT NOT NULL,
   description 		VARCHAR2(200),

   CONSTRAINT fk_add FOREIGN KEY (id) REFERENCES USERS(user_id)
);

CREATE TABLE BOOK_WANTED(
   book_id 			INT NOT NULL PRIMARY KEY,
   id 				INT NOT NULL,
   book_title		VARCHAR2(50) NOT NULL,
   book_author 		VARCHAR2(50) NOT NULL,
   ISBN				INT NOT NULL,
   description 		VARCHAR2(200),

   CONSTRAINT fk_want FOREIGN KEY (id) REFERENCES USERS(user_id)
);

CREATE TABLE IMAGE(
	id 				INT NOT NULL PRIMARY KEY,
	book_ID 		INT NOT NULL,
	name			VARCHAR2(35),

	CONSTRAINT fk_book FOREIGN KEY (book_ID) REFERENCES BOOK_ADDED(book_id)
);