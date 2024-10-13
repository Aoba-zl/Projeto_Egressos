/*
CREATE DATABASE Graduates;
USE Graduates;

USE mysql;
DROP DATABASE Graduates;

*/

/*
DROP TABLE AcademicFormation;

DROP TABLE ProfessionalProfile;

DROP TABLE Feedback;

DROP TABLE Contact;

DROP TABLE Assessment;

DROP TABLE Egress;

DROP TABLE User;

DROP TABLE Address;

DROP TABLE Company;

DROP TABLE Platform;

DROP TABLE Institution;

DROP TABLE Course;
*/

CREATE TABLE User
(
    email        varchar(255),
    password     varchar(72),
    account_type int,
    name         varchar(100),
    PRIMARY KEY (email)
);

CREATE TABLE Egress
(
    id         bigint,
    cpf        char(11),
    phone      varchar(12),
    birth_date date,
    user_email varchar(255),
    status     int,
    FOREIGN KEY (user_email) REFERENCES User (email),
    PRIMARY KEY (id)
);

CREATE TABLE Assessment
(
    moderator_email varchar(255),
    alumni_id       bigint,
    comment         text,
    FOREIGN KEY (moderator_email) REFERENCES User (email),
    FOREIGN KEY (alumni_id) REFERENCES Egress (id),
    PRIMARY KEY (alumni_id, moderator_email)
);

CREATE TABLE Address
(
    id          bigint,
    postal_code char(8),
    door_number int,
    PRIMARY KEY (id)
);

CREATE TABLE Company
(
    id         bigint,
    name       varchar(100),
    phone      varchar(12),
    website    varchar(200) null,
    email      varchar(255),
    address_id bigint,
    FOREIGN KEY (address_id) REFERENCES Address(id),
    PRIMARY KEY (id)
);

CREATE TABLE Platform
(
    id   bigint,
    name varchar(255),
    PRIMARY KEY (id)
);

CREATE TABLE Contact
(
    profile_id   bigint,
    platform_id  bigint,
    contact_info varchar(255),
    FOREIGN KEY (platform_id) REFERENCES Platform (id),
    FOREIGN KEY (profile_id) REFERENCES Egress (id),
    PRIMARY KEY (profile_id, platform_id)
);

CREATE TABLE Feedback
(
    profile_id bigint,
    comment    text,
    FOREIGN KEY (profile_id) REFERENCES Egress (id),
    PRIMARY KEY (profile_id)
);

CREATE TABLE ProfessionalProfile
(
    company_id    bigint,
    alumni_id     bigint,
    start_date    Date,
    end_date      Date NULL,
    field_of_work varchar(255),
    FOREIGN KEY (company_id) REFERENCES Company (id),
    FOREIGN KEY (alumni_id) REFERENCES Egress (id),
    PRIMARY KEY (company_id, alumni_id)
);

CREATE TABLE Institution
(
    id         bigint,
    name       varchar(255),
    address_id bigint,
    FOREIGN KEY (address_id) REFERENCES Address(id),
    PRIMARY KEY (id)
);

CREATE TABLE Course
(
    id          bigint,
    name        varchar(255),
    degree_type varchar(20),
    PRIMARY KEY (id)
);

CREATE TABLE AcademicFormation
(
    profile_id     bigint,
    institution_id bigint,
    course_id      bigint,
    start_year     int,
    end_year       int NULL,
    study_period   varchar(12),
    FOREIGN KEY (institution_id) REFERENCES Institution (id),
    FOREIGN KEY (profile_id) REFERENCES Egress (id),
    FOREIGN KEY (course_id) REFERENCES Course (id),
    PRIMARY KEY (profile_id, course_id, institution_id)
);
