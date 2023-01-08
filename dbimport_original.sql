-- ************************************** `user`

CREATE TABLE `user`
(
 `id`           integer NOT NULL AUTO_INCREMENT,
 `name`         varchar(45) NOT NULL ,
 `email`        varchar(45) NOT NULL ,
 `password`     varchar(45) NOT NULL ,
 `phone_number` integer NOT NULL ,
 `description`  varchar(45) NULL ,
 `gender`       varchar(45) NOT NULL ,
 `birth_date`   date NOT NULL ,

PRIMARY KEY (`id`)
);

-- ************************************** `conversation`

CREATE TABLE `conversation`
(
 `id`           integer NOT NULL AUTO_INCREMENT,
 `user_id`      integer NOT NULL ,
 `time_created` datetime NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_10_1` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `match`

CREATE TABLE `match`
(
 `id`              integer NOT NULL AUTO_INCREMENT,
 `user_id`         integer NOT NULL ,
 `matched_user_id` integer NOT NULL ,
 `response`        varchar(45) NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_6` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `participant`

CREATE TABLE `participant`
(
 `id`              integer NOT NULL AUTO_INCREMENT,
 `conversation_id` integer NOT NULL ,
 `user_id`         integer NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`conversation_id`),
CONSTRAINT `FK_4` FOREIGN KEY `FK_2` (`conversation_id`) REFERENCES `conversation` (`id`)
);

-- ************************************** `message`

CREATE TABLE `message`
(
 `id`             integer NOT NULL AUTO_INCREMENT,
 `participant_id` integer NOT NULL ,
 `text`           varchar(45) NOT NULL ,
 `timestamp`      datetime NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`participant_id`),
CONSTRAINT `FK_5` FOREIGN KEY `FK_2` (`participant_id`) REFERENCES `participant` (`id`)
);

-- ************************************** `photo`

CREATE TABLE `photo`
(
 `id`           integer NOT NULL AUTO_INCREMENT,
 `user_id`      integer NOT NULL ,
 `url`          varchar(45) NOT NULL ,
 `time_created` datetime NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_1` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `preferences`

CREATE TABLE `preferences`
(
 `id`       integer NOT NULL AUTO_INCREMENT,
 `user_id`  integer NOT NULL ,
 `gender`   varchar(45) NOT NULL ,
 `distance` int NOT NULL ,
 `age`      int NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_2` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `role`

CREATE TABLE `role`
(
 `id`   integer NOT NULL AUTO_INCREMENT,
 `name` varchar(45) NOT NULL ,

PRIMARY KEY (`id`)
);

-- ************************************** `user_role`

CREATE TABLE `user_role`
(
 `id`       integer NOT NULL AUTO_INCREMENT,
 `user_id`  integer NOT NULL ,
 `role_id`  integer NOT NULL ,
 `end_time` datetime NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`role_id`),
CONSTRAINT `FK_7` FOREIGN KEY `FK_2` (`role_id`) REFERENCES `role` (`id`),
KEY `FK_3` (`user_id`),
CONSTRAINT `FK_8` FOREIGN KEY `FK_3` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `user_geolocation`

CREATE TABLE `user_geolocation`
(
 `id`        integer NOT NULL AUTO_INCREMENT,
 `user_id`   integer NOT NULL ,
 `latitude`  decimal NOT NULL ,
 `longitude` decimal NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_9` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`)
);

-- ************************************** `interests`

CREATE TABLE `interests`
(
 `id`                   integer NOT NULL AUTO_INCREMENT,
 `interest_description` varchar(45) NOT NULL ,

PRIMARY KEY (`id`)
);

-- ************************************** `user_interests`

CREATE TABLE `user_interests`
(
 `id`          integer NOT NULL AUTO_INCREMENT,
 `user_id`     integer NOT NULL ,
 `interest_id` integer NOT NULL ,

PRIMARY KEY (`id`),
KEY `FK_2` (`user_id`),
CONSTRAINT `FK_10` FOREIGN KEY `FK_2` (`user_id`) REFERENCES `user` (`id`),
KEY `FK_3` (`interest_id`),
CONSTRAINT `FK_11` FOREIGN KEY `FK_3` (`interest_id`) REFERENCES `interests` (`id`)
);