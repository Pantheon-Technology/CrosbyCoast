DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS crosbyEvent;

CREATE TABLE users (
id int(3) AUTO_INCREMENT PRIMARY KEY,
accountName varchar(30) NOT NULL,
accountPassword varchar(30) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
insert into users (id, accountName, accountPassword)
values (1, 'johnny', 'password');

CREATE TABLE crosbyEvent(
eventImg varchar(100),
eventName varchar(100),
eventDesc varchar(300),
eventDate varchar(30),
eventTime varchar(30)
);

INSERT INTO crosbyEvent (eventImg, eventName, eventDesc, eventDate, eventTime)
values ('Pictures/CrosbyBeach.jpeg', 'pretend event', 'Just a bit of sample text to fill out the space to look as it would if it was real.', '27/07/2022', '5pm');

INSERT INTO crosbyEvent (eventImg, eventName, eventDesc, eventDate, eventTime)
values ('Pictures/AnotherPlace.jpg', 'pretend event', 'Just a bit of sample text to fill out the space to look as it would if it was real.', '27/07/2022', '5pm');

INSERT INTO crosbyEvent (eventImg, eventName, eventDesc, eventDate, eventTime)
values ('Pictures/CrosbyBeach.jpeg', 'pretend event', 'Just a bit of sample text to fill out the space to look as it would if it was real.', '27/07/2022', '5pm');

INSERT INTO crosbyEvent (eventImg, eventName, eventDesc, eventDate, eventTime)
values ('Pictures/CrosbyBeach.jpeg', 'pretend event', 'Just a bit of sample text to fill out the space to look as it would if it was real.', '27/07/2022', '5pm');
