DROP TABLE IF EXISTS member;
CREATE TABLE member(
    username VARCHAR(25),
    password VARCHAR(128),
    PRIMARY KEY (username)
);
INSERT INTO member(username, password) VALUES("sample", "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8");
INSERT INTO member(username, password) VALUES("user", "5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8");