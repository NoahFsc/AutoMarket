/* TABLES */
/* TABLES DE LARAVEL */
CREATE TABLE CACHE (
    `key` varchar(255) NOT NULL,
    value mediumtext NOT NULL,
    expiration int NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE CACHE_LOCKS (
    `key` varchar(255) NOT NULL,
    owner varchar(255) NOT NULL,
    expiration int NOT NULL,
    PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE FAILED_JOBS (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    uuid varchar(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload longtext NOT NULL,
    exception longtext NOT NULL,
    failed_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY failed_jobs_uuid_unique (uuid)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE JOB_BATCHES (
    id varchar(255) NOT NULL,
    name varchar(255) NOT NULL,
    total_jobs int NOT NULL,
    pending_jobs int NOT NULL,
    failed_jobs int NOT NULL,
    failed_job_ids longtext NOT NULL,
    options mediumtext,
    cancelled_at int DEFAULT NULL,
    created_at int NOT NULL,
    finished_at int DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE JOBS (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    queue varchar(255) NOT NULL,
    payload longtext NOT NULL,
    attempts tinyint unsigned NOT NULL,
    reserved_at int unsigned DEFAULT NULL,
    available_at int unsigned NOT NULL,
    created_at int unsigned NOT NULL,
    PRIMARY KEY (id),
    KEY jobs_queue_index (queue)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE MIGRATIONS (
    id int unsigned NOT NULL AUTO_INCREMENT,
    migration varchar(255) NOT NULL,
    batch int NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE PASSWORD_RESET_TOKENS (
    email varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    token varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE SESSIONS (
    id varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    user_id bigint unsigned DEFAULT NULL,
    ip_address varchar(45) CHARACTER SET utf8mb4 DEFAULT NULL,
    user_agent text CHARACTER SET utf8mb4,
    payload longtext CHARACTER SET utf8mb4 NOT NULL,
    last_activity int NOT NULL,
    PRIMARY KEY (id),
    KEY sessions_user_id_index (user_id),
    KEY sessions_last_activity_index (last_activity)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/* TABLES DU SITE */
CREATE TABLE USERS (
    id int NOT NULL AUTO_INCREMENT,
    last_name varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
    first_name varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
    email varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    birth_date timestamp NULL DEFAULT NULL,
    identity_card varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    adresse varchar(75) CHARACTER SET utf8mb4 DEFAULT NULL,
    telephone varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    profile_picture varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    description varchar(255) CHARACTER SET utf8mb4 DEFAULT NULL,
    email_verified_at timestamp NULL DEFAULT NULL,
    password varchar(255) CHARACTER SET utf8mb4 NOT NULL,
    is_admin tinyint(1) DEFAULT '0',
    remember_token varchar(100) CHARACTER SET utf8mb4 DEFAULT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY users_email_unique (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE WEBSITE_REVIEWS (
    id int NOT NULL AUTO_INCREMENT,
    nb_of_star int DEFAULT NULL,
    comment varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    CONSTRAINT website_reviews_ibfk_1 FOREIGN KEY (user_id) REFERENCES USERS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE USER_REVIEWS (
    id int NOT NULL AUTO_INCREMENT,
    nb_of_star int NOT NULL,
    comment varchar(255) NOT NULL,
    created_at date DEFAULT NULL,
    user_id_writer int DEFAULT NULL,
    user_id_receiver int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id_writer (user_id_writer),
    KEY user_id_receiver (user_id_receiver),
    CONSTRAINT user_reviews_ibfk_1 FOREIGN KEY (user_id_writer) REFERENCES USERS (id),
    CONSTRAINT user_reviews_ibfk_2 FOREIGN KEY (user_id_receiver) REFERENCES USERS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REPORTS (
    id int NOT NULL AUTO_INCREMENT,
    reason varchar(255) NOT NULL,
    user_id_receiver int DEFAULT NULL,
    user_id_writer int DEFAULT NULL,
    status tinyint(1) DEFAULT '0',
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id_receiver (user_id_receiver),
    KEY user_id_writer (user_id_writer),
    CONSTRAINT reports_ibfk_1 FOREIGN KEY (user_id_receiver) REFERENCES USERS (id),
    CONSTRAINT reports_ibfk_2 FOREIGN KEY (user_id_writer) REFERENCES USERS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE BRANDS (
    id int NOT NULL AUTO_INCREMENT,
    brand_name varchar(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE CAR_MODELS (
    id int NOT NULL AUTO_INCREMENT,
    model_name varchar(50) NOT NULL,
    brand_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY brand_id (brand_id),
    CONSTRAINT car_models_ibfk_1 FOREIGN KEY (brand_id) REFERENCES BRANDS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REFERENTIELS_CRIT_AIR (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    image varchar(255) DEFAULT NULL,
    nom varchar(100) DEFAULT NULL,
    UNIQUE KEY id (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REFERENTIELS_FUEL_TYPE (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    nom varchar(100) DEFAULT NULL,
    UNIQUE KEY id (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REFERENTIELS_NB_DOORS (
    id bigint unsigned NOT NULL AUTO_INCREMENT,
    nb_doors varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    UNIQUE KEY id (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REFERENTIELS_GEARBOX_TYPE (
    id int NOT NULL AUTO_INCREMENT,
    nom varchar(100) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE REFERENTIELS_VEHICULE_TYPE (
    id int NOT NULL AUTO_INCREMENT,
    segment varchar(100) DEFAULT NULL,
    nom varchar(100) DEFAULT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE EQUIPMENTS (
    id int NOT NULL AUTO_INCREMENT,
    equipment_name varchar(50) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE CARS (
    id int NOT NULL AUTO_INCREMENT,
    type_of_car_id int DEFAULT NULL,
    car_year varchar(4) DEFAULT NULL,
    mileage float DEFAULT NULL,
    postal_code varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
    consommation float DEFAULT NULL,
    nb_door_id bigint unsigned DEFAULT NULL,
    provenance varchar(50) DEFAULT NULL,
    puissance_fiscale float DEFAULT NULL,
    puissance_din float DEFAULT NULL,
    boite_vitesse_id int DEFAULT NULL,
    carburant_id bigint unsigned DEFAULT NULL,
    vente_enchere tinyint(1) DEFAULT NULL,
    minimum_price float DEFAULT NULL,
    selling_price float DEFAULT NULL,
    deadline date DEFAULT NULL,
    crit_air_id bigint unsigned DEFAULT NULL,
    co2_emission float DEFAULT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int NOT NULL,
    model_id int NOT NULL,
    status tinyint(1) NOT NULL DEFAULT '0',
    status_ct tinyint(1) NOT NULL DEFAULT '0',
    commentaire_vendeur longtext,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY model_id (model_id),
    KEY nb_door (nb_door_id),
    KEY carburant (carburant_id),
    KEY crit_air (crit_air_id),
    KEY type_of_car_id (type_of_car_id),
    KEY boite_vitesse_id (boite_vitesse_id),
    CONSTRAINT cars_ibfk_2 FOREIGN KEY (model_id) REFERENCES CAR_MODELS (id),
    CONSTRAINT cars_ibfk_3 FOREIGN KEY (nb_door_id) REFERENCES REFERENTIELS_NB_DOORS (id),
    CONSTRAINT cars_ibfk_4 FOREIGN KEY (nb_door_id) REFERENCES REFERENTIELS_NB_DOORS (id),
    CONSTRAINT cars_ibfk_5 FOREIGN KEY (carburant_id) REFERENCES REFERENTIELS_FUEL_TYPE (id),
    CONSTRAINT cars_ibfk_6 FOREIGN KEY (crit_air_id) REFERENCES REFERENTIELS_CRIT_AIR (id),
    CONSTRAINT cars_ibfk_7 FOREIGN KEY (type_of_car_id) REFERENCES REFERENTIELS_VEHICULE_TYPE (id),
    CONSTRAINT cars_ibfk_8 FOREIGN KEY (boite_vitesse_id) REFERENCES REFERENTIELS_GEARBOX_TYPE (id),
    CONSTRAINT cars_ibfk_9 FOREIGN KEY (user_id) REFERENCES USERS (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE DOCUMENTS (
    id int NOT NULL AUTO_INCREMENT,
    document_type varchar(50) NOT NULL,
    document_content varchar(255) NOT NULL,
    car_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY car_id (car_id),
    CONSTRAINT documents_ibfk_1 FOREIGN KEY (car_id) REFERENCES CARS (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE CARS_EQUIPMENTS (
    id int NOT NULL AUTO_INCREMENT,
    car_id int DEFAULT NULL,
    equipment_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY car_id (car_id),
    KEY equipment_id (equipment_id),
    CONSTRAINT cars_equipments_ibfk_3 FOREIGN KEY (car_id) REFERENCES CARS (id) ON DELETE CASCADE,
    CONSTRAINT cars_equipments_ibfk_4 FOREIGN KEY (equipment_id) REFERENCES EQUIPMENTS (id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE BIDS (
    id int NOT NULL AUTO_INCREMENT,
    proposed_price float NOT NULL,
    status tinyint(1) NOT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int DEFAULT NULL,
    car_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY car_id (car_id),
    CONSTRAINT bids_ibfk_1 FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT bids_ibfk_2 FOREIGN KEY (car_id) REFERENCES CARS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE ORDERS (
    id int NOT NULL AUTO_INCREMENT,
    delivery_status tinyint(1) NOT NULL DEFAULT '0',
    delivery_type tinyint(1) NOT NULL DEFAULT '0',
    delivery_date timestamp NULL DEFAULT NULL,
    user_id int NOT NULL,
    car_id int NOT NULL,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY car_id (car_id),
    CONSTRAINT orders_ibfk_1 FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT orders_ibfk_2 FOREIGN KEY (car_id) REFERENCES CARS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE OFFERS (
    id int NOT NULL AUTO_INCREMENT,
    proposed_price float NOT NULL,
    accepted_declined int DEFAULT '0',
    status tinyint(1) NOT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_id int DEFAULT NULL,
    car_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY car_id (car_id),
    CONSTRAINT offers_ibfk_1 FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT offers_ibfk_2 FOREIGN KEY (car_id) REFERENCES CARS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE CONVERSATIONS (
    id int NOT NULL AUTO_INCREMENT,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    user_id_sender int NOT NULL,
    user_id_receiver int NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY user_id_sender (user_id_sender, user_id_receiver),
    KEY user_id_receiver (user_id_receiver),
    CONSTRAINT conversations_ibfk_1 FOREIGN KEY (user_id_sender) REFERENCES USERS (id),
    CONSTRAINT conversations_ibfk_2 FOREIGN KEY (user_id_receiver) REFERENCES USERS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE CHATS (
    id int NOT NULL AUTO_INCREMENT,
    content varchar(255) NOT NULL,
    send_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    conversation_id int NOT NULL,
    user_id int NOT NULL,
    offer_id int DEFAULT NULL,
    PRIMARY KEY (id),
    KEY conversation_id (conversation_id),
    KEY user_id (user_id),
    KEY offer_id (offer_id),
    CONSTRAINT chats_ibfk_1 FOREIGN KEY (conversation_id) REFERENCES CONVERSATIONS (id),
    CONSTRAINT chats_ibfk_2 FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT chats_ibfk_3 FOREIGN KEY (offer_id) REFERENCES OFFERS (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE HISTORIQUE_NAVIGATION (
    id int NOT NULL AUTO_INCREMENT,
    user_id int DEFAULT NULL,
    car_id int DEFAULT NULL,
    action_type enum('bid','offer','order') DEFAULT NULL,
    score int DEFAULT NULL,
    created_at timestamp NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    KEY user_id (user_id),
    KEY car_id (car_id),
    CONSTRAINT historique_navigation_ibfk_1 FOREIGN KEY (user_id) REFERENCES USERS (id),
    CONSTRAINT historique_navigation_ibfk_2 FOREIGN KEY (car_id) REFERENCES CARS (id),
    CONSTRAINT historique_navigation_chk_1 CHECK (score BETWEEN 3 AND 5)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/* INSERTIONS UTILISATEURS */
/* USERS */

INSERT INTO USERS (id, last_name, first_name, email, birth_date, identity_card, adresse, telephone, profile_picture, description, email_verified_at, password, is_admin, remember_token, created_at, updated_at) VALUES
(1, 'Faisca', 'Noah', 'noah.faisca@mail.com', '2004-10-04 00:00:00', 'identity_card/wwvzXlWyk3VndUnJSptNkFF4g6Dq9KqaWnGklcz5.pdf', '14 Rue de Fougères, 80090 Amiens', '0622861975', 'profile_pictures/QARpLyvOIHDevlypuVLc6NDrfzgbGV7XMdPl7ofy.jpg', "Un vendeur lambda venu d\'Amiens.", '2004-10-04 00:00:00', '$2y$12$9GYr0ERy1.qrHeOcpPiWsOBjDGqwwF0.PAoZcQ3X3IZ/R3374pVSW', 1, 'fLLoeYMeGzFurftONQ16fszhT1jRZlaZLd9I2vbm9a609Zx57c82VULkO8Xn', '2025-02-24 16:20:48', '2025-02-24 16:25:02'),
(2, 'Dupont', 'Alice', 'alice.dupont@mail.com', '1988-05-12 00:00:00', '', '12 Avenue des Champs, Paris', '0601020304', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(3, 'Martin', 'Lucas', 'lucas.martin@mail.com', '1992-09-30 00:00:00', '', '33 Boulevard Haussmann, Paris', '0612345678', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(4, 'Lemoine', 'Sophie', 'sophie.lemoine@mail.com', '1996-07-15 00:00:00', '', '5 Rue de la Paix, Lyon', '0623456789', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(5, 'Durand', 'Antoine', 'antoine.durand@mail.com', '1985-03-25 00:00:00', '', '9 Place Bellecour, Lyon', '0634567890', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(6, 'Bernard', 'Emma', 'emma.bernard@mail.com', '1991-11-05 00:00:00', '', '20 Rue Nationale, Lille', '0645678901', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(7, 'Moreau', 'Julien', 'julien.moreau@mail.com', '1987-06-18 00:00:00', '', '3 Avenue Foch, Marseille', '0656789012', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(8, 'Rousseau', 'Camille', 'camille.rousseau@mail.com', '1993-04-22 00:00:00', '', '7 Rue du Port, Bordeaux', '0667890123', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(9, 'Petit', 'Nicolas', 'nicolas.petit@mail.com', '1989-08-10 00:00:00', '', '1 Place du Capitole, Toulouse', '0678901234', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(10, 'Leroy', 'Manon', 'manon.leroy@mail.com', '1998-02-14 00:00:00', '', '22 Rue de l’Église, Strasbourg', '0689012345', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(11, 'Garcia', 'Thomas', 'thomas.garcia@mail.com', '1984-12-01 00:00:00', '', '8 Quai de la Seine, Paris', '0690123456', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(12, 'Fournier', 'Julie', 'julie.fournier@mail.com', '1990-01-09 00:00:00', '', '19 Rue Saint-Honoré, Paris', '0701234567', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(13, 'Robin', 'Alexandre', 'alexandre.robin@mail.com', '1997-05-21 00:00:00', '', '10 Boulevard Voltaire, Lyon', '0712345678', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(14, 'Clement', 'Laura', 'laura.clement@mail.com', '1994-09-30 00:00:00', '', '6 Rue du Marché, Nantes', '0723456789', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(15, 'Perrin', 'Maxime', 'maxime.perrin@mail.com', '1986-07-17 00:00:00', '', '4 Rue des Lilas, Rennes', '0734567890', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(16, 'Blanc', 'Sarah', 'sarah.blanc@mail.com', '1992-03-11 00:00:00', '', '2 Rue Victor Hugo, Montpellier', '0745678901', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(17, 'Gauthier', 'Hugo', 'hugo.gauthier@mail.com', '1995-11-29 00:00:00', '', '11 Rue Lafayette, Toulouse', '0756789012', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(18, 'Chevalier', 'Elise', 'elise.chevalier@mail.com', '1991-06-05 00:00:00', '', '25 Avenue de la République, Marseille', '0767890123', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48'),
(19, 'Lopez', 'Pierre', 'pierre.lopez@mail.com', '1983-12-19 00:00:00', '', '18 Rue des Arts, Bordeaux', '0778901234', '', NULL, NULL, '$2y$10$prqZ06bloKXe.ehmqw9tE.O4kibcsI6sGznOomw400qhU5nQnJOt.', 0, '', '2025-02-24 00:00:00', '2025-02-24 16:20:48');

/* WEBSITE REVIEWS */
INSERT INTO WEBSITE_REVIEWS (comment, user_id, nb_of_star) VALUES
('Super site, très facile à utiliser et interface agreable.', 3, 5),
('Bonne experience d achat, service client reactif.', 5, 4),
('Les enchères sont interessantes, mais il faudrait plus de filtres.', 7, 3),
('Livraison rapide et conforme à la description, je recommande !', 9, 5),
('Quelques bugs sur mobile, mais sinon très bon site.', 2, 3);

/* USER REVIEWS */
INSERT INTO USER_REVIEWS (comment, nb_of_star, user_id_writer, user_id_receiver, created_at) VALUES
('Vendeur sérieux, voiture en bon état, je recommande.', 5, 2, 1, '2025-02-24 00:00:00'),
('Achat rapide et efficace, vendeur très professionnel.', 4, 3, 1, '2025-02-24 00:00:00'),
('Vendeur très sympa, voiture conforme à la description.', 5, 6, 2, '2025-02-24 00:00:00'),
('Vendeur réactif, voiture en bon état, je recommande.', 4, 8, 2, '2025-02-24 00:00:00'),
('Vendeur sérieux, voiture en bon état, je recommande.', 5, 9, 2, '2025-02-24 00:00:00');

/* REPORTS */
INSERT INTO REPORTS (reason, user_id_receiver, user_id_writer, status, created_at, updated_at) VALUES
('Contenu inapproprié', 1, 2, 0, '2025-02-24 00:00:00', '2025-02-24 00:00:00'),
('Contenu inapproprié', 1, 3, 0, '2025-02-24 00:00:00', '2025-02-24 00:00:00'),
('Contenu inapproprié', 2, 6, 0, '2025-02-24 00:00:00', '2025-02-24 00:00:00'),
('Contenu inapproprié', 2, 8, 0, '2025-02-24 00:00:00', '2025-02-24 00:00:00'),
('Contenu inapproprié', 2, 9, 0, '2025-02-24 00:00:00', '2025-02-24 00:00:00');

/* INSERTIONS REFERENTIELS */
/* BRANDS */
INSERT INTO BRANDS (brand_name) VALUES
('Peugeot'),
('Renault'),
('BMW'),
('Mercedes-Benz'),
('Audi'),
('Ford'),
('Chevrolet'),
('Toyota'),
('Tesla'),
('Honda');

/* CAR_MODELS */
INSERT INTO CAR_MODELS (model_name, brand_id) VALUES
('208', 1),
('308', 1),
('3008', 1),
('508', 1),
('Clio', 2),
('Megane', 2),
('Captur', 2),
('Austral', 2),
('Série 3', 3),
('X5', 3),
('Série 5', 3),
('i4', 3),
('Classe A', 4),
('Classe C', 4),
('GLE', 4),
('EQS', 4),
('A3', 5),
('A4', 5),
('Q5', 5),
('e-tron QT', 5),
('Fiesta', 6),
('Focus', 6),
('Mustang', 6),
('Kuga', 6),
('Camaro', 7),
('Corvette', 7),
('Tahoe', 7),
('Silverado', 7),
('Yaris', 8),
('Corolla', 8),
('RAV4', 8),
('Supra', 8),
('Model 3', 9),
('Model S', 9),
('Model X', 9),
('Model Y', 9),
('Civic', 10),
('Accord', 10),
('CR-V', 10),
('e', 10);

/* REFERENTIELS_CRIT_AIR */
INSERT INTO REFERENTIELS_CRIT_AIR (image, nom) VALUES
('images/critair-electrique.png', "Crit'Air Electrique"),
('images/critair-1.png', "Crit'Air 1"),
('images/critair-2.png', "Crit'Air 2"),
('images/critair-3.png', "Crit'Air 3"),
('images/critair-4.png', "Crit'Air 4"),
('images/critair-5.png', "Crit'Air 5");

/* REFERENTIELS_FUEL_TYPE */
INSERT INTO REFERENTIELS_FUEL_TYPE (nom) VALUES
('Diesel'),
('Essence'),
('Électrique'),
('Hybride');

/* REFERENTIELS_NB_DOORS */
INSERT INTO REFERENTIELS_NB_DOORS (nb_doors) VALUES
('3'),
('5');

/* REFERENTIELS_GEARBOX_TYPE */
INSERT INTO REFERENTIELS_GEARBOX_TYPE (nom) VALUES
('Manuelle'),
('Automatique');

/* REFERENTIELS_VEHICULE_TYPE */
INSERT INTO REFERENTIELS_VEHICULE_TYPE (segment, nom) VALUES
('Segment A', 'Minis Citadines'),
('Segment B', 'Citadines Polyvalentes'),
('Segment C ou M1', 'Compactes'),
('Segment D ou M2', 'Familiales'),
('Segment E ou H1', 'Intermédiaires ou routières'),
('Segment F ou H2', 'Berlines de luxe'),
('Segment S', 'Coupés Sportifs'),
('Segment M', 'Monospaces'),
('Segment J', 'SUV et Tout-Terrains');

/* EQUIPMENTS */
INSERT INTO EQUIPMENTS (equipment_name) VALUES
('Climatisation'),
('Régulateur de vitesse'),
('GPS'),
('Caméra de recul'),
('Toit ouvrant'),
('Sièges chauffants'),
('Sièges massants'),
('Volant chauffant'),
('Radar de stationnement'),
('Jantes alliage');

/* INSERTIONS ANNONCES */
/* CARS */
INSERT INTO CARS (type_of_car_id, car_year, mileage, postal_code, consommation, nb_door_id, provenance, puissance_fiscale, puissance_din, boite_vitesse_id, carburant_id, vente_enchere, minimum_price, selling_price, deadline, crit_air_id, co2_emission, created_at, user_id, model_id, status, status_ct, commentaire_vendeur) VALUES
(2, '2016', 102000, '59000', 6, 2, 'France', 7, 130, 1, 2, 0, 14000, 14000, '2025-03-20', 1, 118, '2025-02-24 00:00:00', 1, 2, 0, 1, 'Bonne occasion, CT OK.'),
(4, '2018', 85000, '75001', 5.2, 2, 'France', 7, 130, 1, 2, 0, 15000, 15000, '2025-03-15', 1, 110, '2025-02-24 00:00:00', 1, 3, 0, 1, 'Très bon état, entretien régulier.'),
(4, '2018', 72000, '76000', 5, 2, 'France', 6, 125, 1, 2, 1, 16000, 16000, '2025-06-30', 1, 108, '2025-02-24 00:00:00', 3, 3, 0, 1, 'Compacte et économique.'),
(4, '2018', 72000, '59000', 5.2, 2, 'France', 6, 125, 1, 2, 1, 15500, 15500, '2025-06-25', 1, 110, '2025-02-24 00:00:00', 3, 3, 0, 1, 'Économique et fiable.'),
(4, '2017', 92000, '75015', 5.8, 2, 'France', 7, 125, 1, 2, 0, 13500, 13500, '2025-04-20', 1, 115, '2025-02-24 00:00:00', 2, 4, 0, 1, 'Bon état général, quelques rayures.'),
(4, '2021', 28000, '75012', 4.8, 2, 'France', 6, 130, 1, 2, 1, 18500, 18500, '2025-05-18', 1, 102, '2025-02-24 00:00:00', 2, 4, 0, 1, 'Bon état, faible consommation.'),
(2, '2021', 15000, '31000', 3.9, 2, 'France', 5, 115, 1, 1, 0, 18500, 18500, '2025-05-05', 1, 90, '2025-02-24 00:00:00', 2, 5, 0, 1, 'Quasi neuve, très faible consommation.'),
(1, '2023', 8000, '44000', 3.5, 2, 'France', 5, 110, 1, 1, 1, 19000, 19000, '2025-08-10', 1, 85, '2025-02-24 00:00:00', 4, 5, 0, 1, 'Modèle récent, consommation réduite.'),
(8, '2019', 60000, '31000', 4.9, 2, 'France', 6, 120, 1, 1, 0, 17000, 17000, '2025-05-25', 1, 95, '2025-02-24 00:00:00', 5, 6, 0, 1, 'Entretien régulier, faible kilométrage.'),
(8, '2020', 34000, '34000', 4.6, 2, 'France', 6, 120, 1, 1, 1, 17500, 17500, '2025-09-30', 1, 90, '2025-02-24 00:00:00', 6, 6, 0, 1, 'Modèle bien entretenu, consommation réduite.'),
(8, '2019', 56000, '31000', 5, 2, 'France', 6, 120, 1, 1, 1, 17000, 17000, '2025-08-14', 1, 95, '2025-02-24 00:00:00', 7, 6, 0, 1, 'Compact et bien entretenu.'),
(3, '2020', 30000, '69005', 4.8, 2, 'Allemagne', 6, 140, 2, 1, 0, 22000, 22000, '2025-04-10', 1, 98, '2025-02-24 00:00:00', 9, 7, 0, 1, 'Voiture en parfait état, faible kilométrage.'),
(4, '2019', 49000, '75010', 5.3, 2, 'Belgique', 7, 135, 2, 2, 1, 22000, 22000, '2025-09-05', 1, 110, '2025-02-24 00:00:00', 2, 7, 0, 1, 'Parfait état, entretien à jour.'),
(6, '2022', 12000, '69009', 4.2, 2, 'Allemagne', 6, 145, 2, 1, 0, 25000, 25000, '2025-05-10', 1, 100, '2025-02-24 00:00:00', 1, 8, 0, 1, 'Proche du neuf, options haut de gamme.'),
(6, '2016', 97000, '69007', 5.9, 2, 'Allemagne', 7, 145, 2, 1, 1, 16000, 16000, '2025-06-12', 1, 125, '2025-02-24 00:00:00', 1, 8, 0, 1, 'Solide et fiable, parfait pour la ville.'),
(6, '2019', 45000, '67000', 5.6, 2, 'Belgique', 8, 160, 2, 2, 0, 27000, 27000, '2025-06-01', 1, 120, '2025-02-24 00:00:00', 1, 9, 0, 1, 'Véhicule fiable et confortable.'),
(6, '2021', 18000, '67000', 4.1, 2, 'Allemagne', 6, 140, 2, 1, 0, 23500, 23500, '2025-05-15', 1, 105, '2025-02-24 00:00:00', 2, 9, 0, 1, 'Quasi neuf, intérieur cuir.'),
(6, '2020', 34000, '13002', 4.7, 2, 'Allemagne', 7, 140, 2, 1, 1, 24000, 24000, '2025-07-30', 1, 105, '2025-02-24 00:00:00', 1, 9, 0, 1, 'Équipement haut de gamme.'),
(6, '2020', 45000, '67000', 5.5, 2, 'Belgique', 8, 155, 2, 2, 0, 26000, 26000, '2025-07-01', 1, 125, '2025-02-24 00:00:00', 4, 10, 0, 1, 'Confort et performance.'),
(6, '2022', 9000, '13002', 4, 2, 'Allemagne', 6, 135, 2, 1, 1, 24500, 24500, '2025-05-12', 1, 95, '2025-02-24 00:00:00', 2, 10, 0, 1, 'Quasi neuf, très confortable.'),
(6, '2022', 12000, '67000', 4.1, 2, 'Belgique', 8, 150, 2, 2, 1, 26500, 26500, '2025-09-20', 1, 115, '2025-02-24 00:00:00', 3, 10, 0, 1, 'Presque neuf, intérieur cuir premium.'),
(6, '2014', 145000, '13004', 7.8, 2, 'Italie', 11, 260, 1, 3, 1, 39000, 39000, '2025-06-20', 2, 200, '2025-02-24 00:00:00', 1, 11, 0, 0, 'Superbe modèle, parfait pour les passionnés.'),
(6, '2016', 120000, '13008', 6.5, 2, 'Italie', 9, 200, 1, 3, 0, 45000, 45000, '2025-03-25', 2, 180, '2025-02-24 00:00:00', 2, 12, 0, 0, 'Puissante et bien entretenue, idéale pour les amateurs.'),
(6, '2017', 105000, '69003', 7.2, 2, 'Italie', 9, 210, 1, 3, 1, 37000, 37000, '2025-08-22', 2, 180, '2025-02-24 00:00:00', 1, 12, 0, 0, 'Bonne puissance, bel état.'),
(6, '2015', 135000, '13013', 7, 2, 'Italie', 10, 230, 1, 3, 0, 38000, 38000, '2025-06-15', 2, 190, '2025-02-24 00:00:00', 2, 13, 0, 0, 'Véhicule puissant, moteur réactif.'),
(6, '2014', 158000, '13006', 7.5, 2, 'Italie', 10, 250, 1, 3, 1, 35500, 35500, '2025-07-08', 2, 200, '2025-02-24 00:00:00', 1, 13, 0, 0, 'Modèle sportif, puissance assurée.'),
(6, '2018', 89000, '75008', 6.3, 2, 'France', 9, 200, 1, 3, 0, 42000, 42000, '2025-04-10', 2, 170, '2025-02-24 00:00:00', 2, 14, 0, 0, 'Moteur puissant, parfait pour la route.'),
(6, '2015', 140000, '75016', 7.9, 2, 'Italie', 11, 270, 1, 3, 1, 38000, 38000, '2025-10-05', 2, 210, '2025-02-24 00:00:00', 1, 14, 0, 0, 'Excellent modèle pour les amateurs de vitesse.'),
(6, '2013', 155000, '68000', 8.1, 2, 'Italie', 12, 280, 1, 3, 1, 41000, 41000, '2025-07-25', 2, 220, '2025-02-24 00:00:00', 3, 15, 0, 0, 'Un classique des sportives, toujours impressionnante.'),
(6, '2013', 170000, '68000', 8.5, 2, 'Italie', 12, 290, 1, 3, 1, 40000, 40000, '2025-09-12', 2, 220, '2025-02-24 00:00:00', 1, 15, 0, 0, 'Un classique des sportives, état impeccable.');

/* DOCUMENTS */
INSERT INTO DOCUMENTS (document_type, document_content, car_id) VALUES
('image', '/document_content/308-1.jpg', 1),
('image', '/document_content/3008-1.jpg', 2),
('image', '/document_content/3008-2.jpg', 3),
('image', '/document_content/3008-3.jpg', 4),
('image', '/document_content/508-1.jpg', 5),
('image', '/document_content/508-2.jpg', 6),
('image', '/document_content/clio-1.jpg', 7),
('image', '/document_content/clio-2.jpg', 8),
('image', '/document_content/megane-1.jpg', 9),
('image', '/document_content/megane-2.jpg', 10),
('image', '/document_content/megane-3.jpg', 11),
('image', '/document_content/captur-1.jpg', 12),
('image', '/document_content/captur-2.jpg', 13),
('image', '/document_content/austral-1.jpg', 14),
('image', '/document_content/austral-2.jpg', 15),
('image', '/document_content/serie3-1.jpg', 16),
('image', '/document_content/serie3-2.jpg', 17),
('image', '/document_content/serie3-3.jpg', 18),
('image', '/document_content/x5-1.jpg', 19),
('image', '/document_content/x5-2.jpg', 20),
('image', '/document_content/x5-3.jpg', 21),
('image', '/document_content/serie5-1.jpg', 22),
('image', '/document_content/i4-1.jpg', 23),
('image', '/document_content/i4-2.jpg', 24),
('image', '/document_content/classea-1.jpg', 25),
('image', '/document_content/classea-2.jpg', 26),
('image', '/document_content/classec-1.jpg', 27),
('image', '/document_content/classec-2.jpg', 28),
('image', '/document_content/gle-1.jpg', 29),
('image', '/document_content/gle-2.jpg', 30),
('image', '/document_content/serie3-2p2.jpg', 17),
('image', '/document_content/serie3-2p3.jpg', 17),
('image', '/document_content/serie3-2p4.jpg', 17);

/* CARS_EQUIPMENTS */
INSERT INTO CARS_EQUIPMENTS (car_id, equipment_id) VALUES
(17, 1),
(17, 2),
(17, 3),
(17, 4),
(17, 5),
(17, 6),
(17, 7),
(17, 8),
(17, 9),
(17, 10);

/* INSERTIONS TCHAT */
/* CONVERSATIONS */
INSERT INTO CONVERSATIONS (created_at, user_id_sender, user_id_receiver) VALUES
('2025-02-24 18:59:02', 1, 2),
('2025-02-24 19:03:39', 1, 9);

/* OFFERS */
INSERT INTO OFFERS (proposed_price, accepted_declined, status, user_id, car_id, created_at) VALUES
(20000, 1, 1, 1, 17, '2025-02-24 19:01:34'),
(12000, 1, 0, 9, 1, '2025-02-24 19:04:34');

/* CHATS */
INSERT INTO CHATS (content, send_at, conversation_id, user_id, offer_id) VALUES
("Bonjour ! J\'ai vu que vous vendiez votre BMW Série 3, est-elle toujours disponible ?", '2025-02-24 19:00:39', 1, 1, NULL),
('Bonjour ! Oui, elle est toujours disponible. Elle est en excellent état et a toujours été bien entretenue. Vous êtes intéressé ?', '2025-02-24 19:00:54', 1, 2, NULL),
("Oui, elle m\'intéresse beaucoup ! Je vais vous faire une offre !", '2025-02-24 19:01:13', 1, 1, NULL),
('Nouvelle offre de  : 20000€', '2025-02-24 19:01:34', 1, 1, 1),
("3.500€ de moins... bon j\'accepte !", '2025-02-24 19:01:46', 1, 2, NULL),
('Bonjour, je suis intéressé par cette voiture, je vous fais une offre.', '2025-02-24 19:03:50', 2, 9, NULL),
('Nouvelle offre de  : 12000€', '2025-02-24 19:04:34', 2, 9, 2);

/* ORDERS */
INSERT INTO ORDERS (delivery_status, delivery_type, delivery_date, user_id, car_id) VALUES
(0, 0, '2025-03-12 00:00:00', 1, 17);