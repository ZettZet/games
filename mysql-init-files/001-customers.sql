create table customers
(
	id bigint auto_increment
		primary key,
	email varchar(50) not null,
	pass varchar(20) not null
);

