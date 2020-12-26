create table game_category (
	game_id bigint not null,
	category_id int not null,
	constraint game_category_ibfk_1 foreign key (game_id) references games (id) on update cascade on delete cascade,
	constraint game_category_ibfk_2 foreign key (category_id) references category (id) on update cascade on delete cascade
);
create index category_id on game_category (category_id);
create index game_id on game_category (game_id);