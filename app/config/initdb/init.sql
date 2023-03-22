CREATE DATABASE IF NOT EXISTS AdmissionsCommittee;
use AdmissionsCommittee;

CREATE TABLE IF NOT EXISTS Entrants
(
    id_entrant           INTEGER AUTO_INCREMENT NOT NULL,
    name                 VARCHAR(20) NOT NULL,
    surname              VARCHAR(20) NOT NULL,
    patronymic        	 VARCHAR(20) NULL,
    birthday             DATE NOT NULL,
    sex                  VARCHAR(20) NULL,
    edu_institution      VARCHAR(20) NULL,
    grad_date_edu_institution DATE NULL,
    has_gold_medal       boolean NULL,
    certificate_number   INTEGER NULL,
    email                VARCHAR(20) NOT NULL,
    phone                BIGINT NOT NULL,
    password	  		 VARCHAR(200) NULL,
    PRIMARY KEY (id_entrant)
    );

CREATE TABLE IF NOT EXISTS Role
(
    id_role              INTEGER AUTO_INCREMENT NOT NULL,
    role_name                 VARCHAR(100) NOT NULL,
    PRIMARY KEY (id_role)
    );

CREATE TABLE IF NOT EXISTS Faculties(
    id_faculty INTEGER AUTO_INCREMENT NOT NULL,
    name VARCHAR(200) NOT NULL,
    description TEXT NULL,
    PRIMARY KEY (id_faculty)

    );

CREATE TABLE IF NOT EXISTS Status
(
    id_status            INTEGER AUTO_INCREMENT NOT NULL,
    status_name          VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_status)
    );



CREATE TABLE IF NOT EXISTS Subjects
(
    id_subject           INTEGER AUTO_INCREMENT NOT NULL,
    name                 VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_subject)
    );

CREATE TABLE IF NOT EXISTS SubjectsUSE
(
    id_subject_use       INTEGER AUTO_INCREMENT NOT NULL,
    name                 VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_subject_use)
    );

CREATE TABLE IF NOT EXISTS Employer
(
    id_employer          INTEGER AUTO_INCREMENT NOT NULL,
    name                 VARCHAR(20) NOT NULL,
    surname              VARCHAR(20) NOT NULL,
    patronymic           VARCHAR(20) NULL,
    id_role              INTEGER NOT NULL,
    work_email         	 VARCHAR(20) NOT NULL,
    password			 VARCHAR(200) DEFAULT 'admin',
    PRIMARY KEY (id_employer),
    CONSTRAINT role_employer
    FOREIGN KEY (id_role)
    REFERENCES Role (id_role)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS Grades
(
    id_grade             INTEGER AUTO_INCREMENT NOT NULL,
    grade                INTEGER NULL,
    id_entrant           INTEGER NULL,
    id_subject           INTEGER NOT NULL,
    PRIMARY KEY (id_grade,id_subject),
    CONSTRAINT entrants_grades
    FOREIGN KEY (id_entrant)
    REFERENCES Entrants (id_entrant)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    CONSTRAINT  subjects_grades
    FOREIGN KEY (id_subject)
    REFERENCES Subjects (id_subject)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS GradesUSE
(
    id_grades_use        INTEGER AUTO_INCREMENT NOT NULL,
    grade                INTEGER NOT NULL,
    exam_date            DATE NOT NULL,
    id_entrant           INTEGER NULL,
    id_subject_use       INTEGER NOT NULL,
    PRIMARY KEY (id_grades_use,id_subject_use),
    CONSTRAINT entrants_gradesUSE
    FOREIGN KEY (id_entrant)
    REFERENCES Entrants (id_entrant)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    CONSTRAINT subjectsUSE_gradesUSE
    FOREIGN KEY (id_subject_use)
    REFERENCES SubjectsUse (id_subject_use)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS Passports
(
    id_passport          INTEGER AUTO_INCREMENT NOT NULL,
    given_out_by_whom    VARCHAR(100) NOT NULL,
    when_given_out       DATE NOT NULL,
    serial               INTEGER NOT NULL,
    number               INTEGER NOT NULL,
    id_entrant           INTEGER NOT NULL,
    PRIMARY KEY (id_passport,id_entrant),
    CONSTRAINT entrants_passports
    FOREIGN KEY (id_entrant)
    REFERENCES Entrants (id_entrant)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );

CREATE TABLE IF NOT EXISTS Requests
(
    id_request           INTEGER AUTO_INCREMENT NOT NULL,
    date_of_submission   DATE NOT NULL,
    comment              TEXT NULL,
    id_entrant           INTEGER NOT NULL,
    id_faculty           INTEGER NOT NULL,
    id_status            INTEGER NOT NULL,
    id_employer          INTEGER NOT NULL,
    PRIMARY KEY (id_request, id_entrant, id_faculty, id_status, id_employer),
    CONSTRAINT entrants_requests
    FOREIGN KEY (id_entrant)
    REFERENCES Entrants (id_entrant)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    CONSTRAINT faculties_requests
    FOREIGN KEY (id_faculty)
    REFERENCES Faculties (id_faculty)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    CONSTRAINT status_requests
    FOREIGN KEY (id_status)
    REFERENCES Status (id_status)
    ON DELETE RESTRICT
    ON UPDATE CASCADE,
    CONSTRAINT employer_requests
    FOREIGN KEY (id_employer)
    REFERENCES Employer (id_employer)
    ON DELETE RESTRICT
    ON UPDATE CASCADE
    );



INSERT INTO Entrants VALUES (NULL, 'Ivan', 'Ivanov', 'Ivanovich', '01.01.2010', 'male', 'School 13', '01.01.2010', 1, 1488, 'ivan@mail.ru', 88005556565, 'password');


INSERT INTO SubjectsUSE VALUES (NULL, 'Русский');
INSERT INTO SubjectsUSE VALUES (NULL, 'Математика ПРОФИЛЬ');
INSERT INTO SubjectsUSE VALUES (NULL, 'Информатика');


INSERT INTO GradesUSE VALUES (NULL, 100, '01.01.2010', 1, 1);
INSERT INTO GradesUSE VALUES (NULL, 90, '01.02.2010', 1, 2);
INSERT INTO GradesUSE VALUES (NULL, 80, '01.03.2010', 1, 3);


INSERT INTO Passports VALUES (null, 'МВД РОССИИ', '01.01.2007', 1488, 008210, 1);


INSERT INTO Faculties VALUES (null, 'Институт ядерной физики и технологий', 'Цель ИЯФиТ и стратегия развития - создание и развитие научно-образовательного центра мирового уровня в области ядерной физики и технологий, радиационного материаловедения, физики элементарных частиц, астрофизики и космофизики.' );
INSERT INTO Faculties VALUES (null, 'Институт интеллектуальных кибернетических систем', 'Цель ИИКС и стратегия развития - это подготовка кадров, способных противостоять современным угрозам и вызовам, обладающих знаниями и компетенциями в области кибернетики, информационной и финансовой безопасности для решения задач разработки базового программного обеспечения, повышения защищенности критически важных информационных систем и противодействия отмыванию денег, полученных преступным путем, и финансированию терроризма.' );
INSERT INTO Faculties VALUES (null, 'Институт лазерных и плазменных технологий', 'Стратегическая цель Института ЛаПлаз – стать ведущей научной школой и ядром развития инноваций по лазерным, плазменным, радиационным и ускорительным технологиям, с уникальными образовательными программами, востребованными на российском и мировом рынке образовательных услуг.' );
INSERT INTO Faculties VALUES (null, 'Институт физико-технических интеллектуальных систем', 'Институт физико-технических интеллектуальных систем впервые в стране обеспечивает комплексную подготовку специалистов по созданию киберфизических устройств и систем самого различного назначения – основного вида технических устройств середины 21 века. ИФТИС реализует «дуальную» модель образования, в рамках которой направляет студентов на стажировку и выпускников для трудоустройства на передовые предприятия, занятые созданием инновационных киберфизических продуктов, в первую очередь, на предприятия ГК «Росатом». Основным индустриальным партнером ИФТИС является ведущее предприятие ГК «Росатом» — ФГУП «ВНИИА им. Н.Л. Духова».' );
INSERT INTO Faculties VALUES (null, 'Институт международных отношений', 'Цель ИМО и стратегия развития - системная подготовка высококвалифицированных кадров, способных решать нестандартные задачи при реализации международных научно-технологических и торгово-промышленных проектов для компаний и корпораций ключевых секторов экономики страны.' );


INSERT INTO Status VALUES (null, 'В обработке');
INSERT INTO Status VALUES (null, 'Получен ответ');
INSERT INTO Status VALUES (null, 'На рассторжении');
INSERT INTO Status VALUES (null, 'Отклонено');

INSERT INTO Role VALUES (NULL, 'Заведующий приёмной комиссией');
INSERT INTO Role VALUES (NULL, 'Заведующая приёмной комиссией');
INSERT INTO Role VALUES (NULL, 'Ассистент');


INSERT INTO Employer VALUES (NULL, 'admin', 'admin', 'admin', 1, 'admin@mail.ru', 'admin');


INSERT INTO Subjects VALUES (NULL, 'Русский');
INSERT INTO Subjects VALUES (NULL, 'Математика');
INSERT INTO Subjects VALUES (NULL, 'Информатика');
INSERT INTO Subjects VALUES (NULL, 'Биология');


INSERT INTO Grades VALUES (NULL, 5, 1, 1);
INSERT INTO Grades VALUES (NULL, 4, 1, 2);
INSERT INTO Grades VALUES (NULL, 4, 1, 3);
INSERT INTO Grades VALUES (NULL, 3, 1, 4);


INSERT INTO Requests VALUES (NULL, '01.01.2023',NULL, 1, 1, 1, 1);

DELIMITER $$
CREATE TRIGGER check_request_duplicate
    BEFORE INSERT ON Requests
    FOR EACH ROW
BEGIN
    IF EXISTS (SELECT 1 FROM Requests WHERE id_entrant = NEW.id_entrant) THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = 'Only one request allowed per entrant';
END IF;
END;
$$





