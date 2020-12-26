create table games (
	id bigint auto_increment primary key,
	title varchar(60) not null,
	description text null,
	price int not null check (price >= 0)
);