

/*
*		Aici o sa adaugam scripturile de creeare a tabelelor,de populare  a bazei de date etc..
*		Fisierul n-o sa fie folosit direct, e doar ca sa ajungem la un consens
*		Ce scriu aici vei scrie in phpmyadmin, la tabul de sql, ca sa-ti creezi baza de date local
*
*/

/*
	 auto increment creste id-ul cu 1 pentru fiecare noua intrare
*/

create table users (
	id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	nume varchar2(15) NOT NULL,
	prenume varchar2(15) NOT NULL,
	email varchar2(40) NOT NULL,
 	location varchar2(50)
);
