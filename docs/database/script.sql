SET FOREIGN_KEY_CHECKS = 0;

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  first_name VARCHAR(50) NOT NULL,
  last_name VARCHAR(50) NOT NULL,
  birth_date DATE,
  identity_card VARCHAR(255),
  adresse VARCHAR(255),
  telephone VARCHAR(20),
  profile_picture VARCHAR(255),
  description VARCHAR(255),
  is_admin TINYINT(1) DEFAULT 0,
  email_verified_at TIMESTAMP NULL DEFAULT NULL,
  remember_token VARCHAR(100) DEFAULT NULL,
  created_at TIMESTAMP,
  updated_at TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY users_email_unique (email)
);

CREATE TABLE WEBSITE_REVIEWS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nb_of_star INT NOT NULL,
    comment VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES USERS(id)
);

CREATE TABLE USER_REVIEWS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nb_of_star INT NOT NULL,
    comment VARCHAR(255) NOT NULL,
    created_at DATE ,
    user_id_writer INT,
    user_id_receiver INT,
    FOREIGN KEY (user_id_writer) REFERENCES USERS(id),
    FOREIGN KEY (user_id_receiver) REFERENCES USERS(id)
);

CREATE TABLE BRANDS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    brand_name VARCHAR(50) NOT NULL
);

CREATE TABLE CAR_MODELS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    model_name VARCHAR(50) NOT NULL,
    brand_id INT,
    FOREIGN KEY (brand_id) REFERENCES BRANDS(id)
);

CREATE TABLE REFERENTIELS_CRIT_AIR (
  id INT PRIMARY KEY AUTO_INCREMENT,
  image varchar(255),
  nom varchar(100),
);

CREATE TABLE REFERENTIELS_FUEL_TYPE (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nom varchar(100),
);

CREATE TABLE REFERENTIELS_NB_DOORS (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nb_doors varchar(100),
);

CREATE TABLE CARS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    type_of_car VARCHAR(50),
    car_year VARCHAR(4),
    mileage FLOAT,
    postal_code VARCHAR(5),
    consommation FLOAT,
    nb_door_id INT,
    provenance VARCHAR(50),
    puissance_fiscale FLOAT,
    puissance_din FLOAT,
    boite_vitesse BOOLEAN,
    carburant_id INT,
    vente_enchere BOOLEAN,
    minimum_price FLOAT,
    selling_price FLOAT,
    deadline DATE,
    crit_air_id INT,
    co2_emission FLOAT,
    commentaire_vendeur TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    model_id INT,
    status BOOLEAN NOT NULL,
    FOREIGN KEY (user_id) REFERENCES USERS(id),
    FOREIGN KEY (model_id) REFERENCES CAR_MODELS(id),
    FOREIGN KEY (crit_air_id) REFERENCES REFERENTIELS_CRIT_AIR(id),
    FOREIGN KEY (carburant_id) REFERENCES REFERENTIELS_FUEL_TYPE(id),
    FOREIGN KEY (nb_door_id) REFERENCES REFERENTIELS_NB_DOORS(id)
);

CREATE TABLE DOCUMENTS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    document_type VARCHAR(50) NOT NULL,
    document_content VARCHAR(255) NOT NULL,
    car_id INT,
    FOREIGN KEY (car_id) REFERENCES CARS(id)
);

CREATE TABLE OFFERS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    proposed_price FLOAT NOT NULL,
    accepted_declined INT,
    status BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    car_id INT,
    FOREIGN KEY (user_id) REFERENCES USERS(id),
    FOREIGN KEY (car_id) REFERENCES CARS(id)
);

CREATE TABLE BIDS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    proposed_price FLOAT NOT NULL,
    status BOOLEAN NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id INT,
    car_id INT,
    FOREIGN KEY (user_id) REFERENCES USERS(id),
    FOREIGN KEY (car_id) REFERENCES CARS(id)
);

CREATE TABLE EQUIPMENTS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    equipment_name VARCHAR(50) NOT NULL
);

CREATE TABLE CARS_EQUIPMENTS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    car_id INT,
    equipment_id INT,
    FOREIGN KEY (car_id) REFERENCES CARS(id),
    FOREIGN KEY (equipment_id) REFERENCES EQUIPMENTS(id)
);

CREATE TABLE REPORTS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    reason VARCHAR(255) NOT NULL,
    user_id_receiver INT,
    user_id_writer INT,
    status TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id_receiver) REFERENCES USERS(id),
    FOREIGN KEY (user_id_writer) REFERENCES USERS(id)
);

CREATE TABLE CONVERSATIONS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id_sender INT NOT NULL,
    user_id_receiver INT NOT NULL,
    FOREIGN KEY (user_id_sender) REFERENCES USERS(id),
    FOREIGN KEY (user_id_receiver) REFERENCES USERS(id),
    UNIQUE (user_id_sender, user_id_receiver),
    CHECK (user_id_sender < user_id_receiver)
);

CREATE TABLE CHATS (
    id INT PRIMARY KEY AUTO_INCREMENT,
    content VARCHAR(255) NOT NULL,
    send_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    conversation_id INT NOT NULL, 
    user_id INT NOT NULL,
    FOREIGN KEY (conversation_id) REFERENCES CONVERSATIONS(id),
    FOREIGN KEY (user_id) REFERENCES USERS(id)
);

SET FOREIGN_KEY_CHECKS = 1;

