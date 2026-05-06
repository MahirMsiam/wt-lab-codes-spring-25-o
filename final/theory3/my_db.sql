-- // mysql user table
create table users (
	id int primary key auto_increment,
	email varchar(255) not null unique,
	username varchar(255) not null unique,
	password varchar(255) not null,
	created_at timestamp default current_timestamp
)
