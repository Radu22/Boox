drop table USERS;
drop table book_added;
drop table book_wanted;
drop table user_group;
/

CREATE TABLE USERS (
	user_id 		 INT NOT NULL PRIMARY KEY,
	firstname		 VARCHAR2(30) NOT NULL,
	lastname 	 	 VARCHAR2(30),
	email 			 VARCHAR2(40) NOT NULL,
	username 		 VARCHAR2(10) NOT NULL,
	password 		 VARCHAR2(20) NOT NULL
);

CREATE TABLE BOOK_ADDED (
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

CREATE TABLE user_group(
	id 				INT NOT NULL PRIMARY KEY,
	id_first		INT NOT NULL,
	id_second 		INT NOT NULL,

	CONSTRAINT fk_id_first  FOREIGN KEY (id_first)  REFERENCES USERS(user_id),
	CONSTRAINT fk_id_second FOREIGN KEY (id_second) REFERENCES USERS(user_id),

	CONSTRAINT no_dups UNIQUE (id_first,id_second)
);

CREATE TABLE IMAGE(
	id 				INT NOT NULL PRIMARY KEY,
	book_ID 		INT NOT NULL,
	name			VARCHAR2(35),

	CONSTRAINT fk_book FOREIGN KEY (book_ID) REFERENCES BOOK_ADDED(book_id)
);