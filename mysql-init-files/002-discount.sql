create table discount (
	id int auto_increment primary key,
	percent int not null check(percent > 0 && percent < 100),
	starts date not null,
	ends date not null
);