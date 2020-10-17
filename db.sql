CREATE TABLE product (
    id int(11) unsigned not null auto_increment,
    name varchar(500) not null,
    price int(11) unsigned not null,
    image varchar(1000) not null,
    material_id int(11) unsigned not null,
    primary key (id),
    foreign key (material_id) references material(id)
)ENGINE=innodb;

CREATE TABLE material (
    id int(11) unsigned not null auto_increment,
    name varchar(500),
    primary key (id)
)ENGINE=innodb;

CREATE TABLE color (
    id int(11) unsigned not null auto_increment,
    name varchar(500) not null,
    primary key (id)
)ENGINE=innodb;

CREATE TABLE product_color (
    id int(11) unsigned not null auto_increment,
    product_id int(11) unsigned not null,
    color_id int(11) unsigned not null,
    primary key (id),
    foreign key (product_id) references product(id),
    foreign key (color_id) references color(id)
)ENGINE=innodb;

alter table product add material_id int(11) unsigned;
alter table product add foreign key (material_id) references material(id);