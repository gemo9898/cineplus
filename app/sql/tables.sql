CREATE EXTENSION IF NOT EXISTS "uuid-ossp";

DROP TABLE IF EXISTS films CASCADE;


CREATE TABLE films (
    id_film UUID PRIMARY KEY DEFAULT uuid_generate_v4(),
    title VARCHAR(255) NOT NULL,
    director VARCHAR(100) NOT NULL,
    release_year INTEGER CHECK (release_year >= 1888),
    category VARCHAR(50) NOT NULL
    );