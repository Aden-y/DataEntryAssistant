create database if not exists  counties;
use counties;
drop table if exists counties;
create table counties (
    id int primary key auto_increment not null,
    name varchar(50) not null  unique key
);
drop table if exists constituencies;
create table if not exists constituencies(
    id int primary key auto_increment not null,
    name varchar(50) not null  unique key,
    county_id int not null ,
    foreign key (county_id) references counties(id)
);
drop table if exists wards;
create table if not exists wards(
    id int primary key auto_increment not null,
    name varchar(50) not null,
    constituency_id int not null ,
    foreign key (constituency_id) references constituencies(id)
);
