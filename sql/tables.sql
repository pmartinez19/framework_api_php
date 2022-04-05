CREATE TABLE USER (
    id INTEGER PRIMARY KEY,
    username VARCHAR(50),
    email VARCHAR(120),
    password VARCHAR(16),
    api_key VARCHAR(64)
);

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

