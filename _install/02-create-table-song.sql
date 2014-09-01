CREATE TABLE project (
  id serial PRIMARY KEY,
  name varchar NOT NULL,
  description varchar NOT NULL,
  created_at TIMESTAMP NOT NULL,
  updated_at TIMESTAMP NOT NULL
);