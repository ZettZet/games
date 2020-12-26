create table carts (
	id bigint auto_increment primary key,
	game_price int not null,
	status enum('taken', 'payed') default 'taken' null,
	game_id bigint null,
	customer_id bigint null,
	discount_id int null,
	constraint game_id unique (game_id, customer_id),
	constraint carts_ibfk_1 foreign key (game_id) references games (id) on update cascade on delete
	set null,
		constraint carts_ibfk_2 foreign key (customer_id) references customers (id) on update cascade on delete
	set null,
		constraint carts_ibfk_3 foreign key (discount_id) references discount (id) on update cascade
);
create index customer_id on carts (customer_id);
create index discount_id on carts (discount_id);