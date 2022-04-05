CREATE DATABASE realQuest;
USE realQuest;

CREATE TABLE USER (
    id INTEGER PRIMARY KEY,
    username VARCHAR(255) UNIQUE,
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    useractive BOOLEAN DEFAULT TRUE,
    loginattempts INTEGER(1) DEFAULT 0,
    api_key VARCHAR(255) UNIQUE
);

INSERT INTO USER (id, username, email, password, useractive, loginattempts, api_key) values (1,"pepe", "pepe@email.com", "meofwphgpw", TRUE, 0, "gohweopghwop234324");

CREATE TABLE LOCATION (
    id INTEGER PRIMARY KEY,
    id_user INTEGER,
    latitude REAL,
    longitude REAL,
    password TEXT,
    name TEXT,
    created_at DATETIME,
    updated_at DATETIME,
    FOREIGN KEY(id_user) REFERENCES USER(id)
);

curl -X POST localhost/framework_api_php/user/register\
   -H 'Content-Type: application/json' \
   -d '{"username":"Morcillo","pass":"my_password1","email":"morcillo@email.com"}'

   INSERT INTO USER (id, username, email, password, useractive, loginattempts, api_key) values (2, "Pepon", "sdgsdg2fewg@fgwegw", "$2y$10$Uaw910I43mQFc3/wLo4RKejKo07/7Rq7lbqpP1m7Re9Qb2AVGBaK",1,0,"196aa3a3-a8f3-4335-9beb-bad0a62988cc");