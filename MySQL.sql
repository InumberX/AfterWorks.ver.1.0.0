create table E_STAFF (
    STAFF_ID bigint(8) primary key,
    STAFF_FIRST_NAME varchar(10) NOT NULL,
    STAFF_SECOND_NAME varchar(10) NOT NULL,
    STAFF_MAIL_ADDRESS varchar(256) NOT NULL,
    DELETE_FLG char(1) NOT NULL,
    REG_ID bigint(8) NOT NULL,
    REG_DATE datetime NOT NULL,
    UPD_ID bigint(8) NOT NULL,
    UPD_DATE datetime NOT NULL
) default charset = UTF8;

create table E_STAFF_QUESTION (
    QUESTION_ID bigint(8) primary key,
    ANSWER_ID bigint(8),
    STAFF_ID bigint(8) NOT NULL,
    QUESTION_TEXT text,
    DELETE_FLG char(1) NOT NULL,
    REG_ID bigint(8) NOT NULL,
    REG_DATE datetime NOT NULL,
    UPD_ID bigint(8) NOT NULL,
    UPD_DATE datetime NOT NULL
) default charset = UTF8;

create table E_STAFF_ANSWER (
    ANSWER_ID bigint(8) primary key,
    COCHARGE_ID bigint(8),
    ANSWER_TEXT text,
    DELETE_FLG char(1) NOT NULL,
    REG_ID bigint(8) NOT NULL,
    REG_DATE datetime NOT NULL,
    UPD_ID bigint(8) NOT NULL,
    UPD_DATE datetime NOT NULL
) default charset = UTF8;

create table M_COCHARGE (
    COCHARGE_ID bigint(8) primary key,
    COCHARGE_FIRST_NAME varchar(10) NOT NULL,
    COCHARGE_SECOND_NAME varchar(10) NOT NULL,
    COCHARGE_MAIL_ADDRESS varchar(256),
    COCHARGE_PASSWORD varchar(50),
    DELETE_FLG char(1) NOT NULL,
    REG_ID bigint(8) NOT NULL,
    REG_DATE datetime NOT NULL,
    UPD_ID bigint(8) NOT NULL,
    UPD_DATE datetime NOT NULL
) default charset = UTF8;

SELECT STAFF_ID FROM E_STAFF WHERE STAFF_FIRST_NAME = ? AND STAFF_SECOND_NAME = ? AND STAFF_MAIL_ADDRESS = ?;

SELECT COUNT(1) FROM E_STAFF;

SELECT COUNT(1) FROM E_STAFF_QUESTION;

SELECT COUNT(1) FROM E_STAFF_ANSWER;

INSERT INTO E_STAFF (STAFF_ID, STAFF_FIRST_NAME, STAFF_SECOND_NAME, STAFF_MAIL_ADDRESS, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES (?, ?, ?, ?, 0, 0, ?, 0, ?);

UPDATE E_STAFF SET (UPD_ID = 0, UPD_DATE = ?) WHERE STAFF_ID = ?;

INSERT INTO E_STAFF_QUESTION (QUESTION_ID, ANSWER_ID, STAFF_ID, QUESTION_TEXT, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES (?, NULL, ?, ?, 0, 0, ?, 0, ?);

SELECT ES.STAFF_FIRST_NAME, ES.STAFF_SECOND_NAME, ESQ.QUESTION_ID, ESQ.ANSWER_ID, ESQ.QUESTION_TEXT, ESQ.REG_DATE FROM E_STAFF ES INNER JOIN E_STAFF_QUESTION ESQ ON ESQ.STAFF_ID = ES.STAFF_ID AND ES.DELETE_FLG = 0;

SELECT
  ES.STAFF_FIRST_NAME,
  ES.STAFF_SECOND_NAME,
  ESQ.QUESTION_ID,
  ESQ.ANSWER_ID,
  ESQ.QUESTION_TEXT,
  ESQ.REG_DATE
FROM
  E_STAFF_QUESTION ESQ
INNER JOIN
  E_STAFF ES
    ON
      ES.STAFF_ID = ESQ.STAFF_ID
      AND ES.DELETE_FLG = 0
WHERE
  ESQ.QUESTION_ID = ?
  AND ESQ.DELETE_FLG = 0;

SELECT
  ES.STAFF_FIRST_NAME,
  ES.STAFF_SECOND_NAME,
  ES.STAFF_MAIL_ADDRESS,
  ESQ.QUESTION_ID,
  ESQ.ANSWER_ID,
  ESQ.QUESTION_TEXT,
  ESQ.REG_DATE
FROM
  E_STAFF_QUESTION ESQ
INNER JOIN
  E_STAFF ES
    ON
      ES.STAFF_ID = ESQ.STAFF_ID
      AND ES.DELETE_FLG = 0
WHERE
  ESQ.QUESTION_ID = ?
  AND ESQ.DELETE_FLG = 0;

INSERT INTO E_STAFF_ANSWER (ANSWER_ID, COCHARGE_ID, ANSWER_TEXT, DELETE_FLG, REG_ID, REG_DATE, UPD_ID, UPD_DATE) VALUES (?, ?, ?, 0, ?, ?, ?, ?);

UPDATE E_STAFF_QUESTION SET ANSWER_ID = ?, UPD_ID = ?, UPD_DATE = ? WHERE QUESTION_ID = ?;

SELECT
  ES.STAFF_FIRST_NAME,
  ES.STAFF_SECOND_NAME,
  ES.STAFF_MAIL_ADDRESS,
  ESQ.QUESTION_TEXT,
  ESQ.REG_DATE AS QUESTION_DATE,
  ESA.ANSWER_TEXT,
  ESA.REG_DATE AS ANSWER_DATE,
  MC.COCHARGE_FIRST_NAME,
  MC.COCHARGE_SECOND_NAME,
  MC.COCHARGE_MAIL_ADDRESS
FROM
  E_STAFF_QUESTION ESQ
INNER JOIN
  E_STAFF ES
    ON
      ES.STAFF_ID = ESQ.STAFF_ID
      AND ES.DELETE_FLG = 0
INNER JOIN
  E_STAFF_ANSWER ESA
    ON
      ESA.ANSWER_ID = ESQ.ANSWER_ID
      AND ESA.DELETE_FLG = 0
INNER JOIN
  M_COCHARGE MC
    ON
      MC.COCHARGE_ID = ESA.COCHARGE_ID
      AND MC.DELETE_FLG = 0
WHERE
  ESQ.QUESTION_ID = ?
  AND ESQ.DELETE_FLG = 0;