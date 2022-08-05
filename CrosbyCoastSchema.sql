DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS crosbyEvent;

CREATE TABLE users (
id int(3) AUTO_INCREMENT PRIMARY KEY,
username varchar(30) NOT NULL,
`Password` varchar(300) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


CREATE TABLE crosbyEvent(
eventID Int PRIMARY KEY NOT NULL AUTO_INCREMENT,
eventImg varchar(100),
eventName varchar(100),
eventDesc varchar(300),
eventDate varchar(30),
eventTime varchar(30)
);

select * from users;
select * from crosbyEvent;