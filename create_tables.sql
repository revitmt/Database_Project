use db_project;

CREATE TABLE LOGIN_USER
(
	Username varchar(32)  PRIMARY KEY,
	Password varchar(32)  NOT NULL,
	Fname    varchar(50),
	Mname    varchar(50)  DEFAULT NULL,
	Lname    varchar(50),
	Email    varchar(50),
	Usertype char(1)      CHECK (Username='S' OR Username='T')
);

CREATE TABLE COURSES
(
	CourseNum   varchar(20)   PRIMARY KEY,
	Coursename  varchar(20)   NOT NULL,
	Description varchar(1000)
);

CREATE TABLE COURSES_THIS_SEM
(
	eCourseNum  varchar(20), 
	CRN        varchar(5)  PRIMARY KEY,
	SectionNum varchar(3),
	FOREIGN KEY (eCourseNum) REFERENCES COURSES(CourseNum) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE COURSE_WORK
(
	Name        varchar(20),
	eCRN         varchar(5),
	eSectionNum  varchar(3),
	eDescription varchar(20),
	Assign_date date,
	Due_date    date,
	Work_type   char(2) CHECK (Work_type IN ('HM','PJ','CL','SV','RP','OT')),
	PRIMARY KEY (Name, eCRN),
	FOREIGN KEY (eCRN) REFERENCES COURSES_THIS_SEM(CRN) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE COURSES_ENROLLED
(
	sUsername   varchar(32),
	sCRN        varchar(5),
	sSectionNum varchar(3),
	PRIMARY KEY (sUsername, sCRN),
	FOREIGN KEY (sUsername) REFERENCES LOGIN_USER(Username) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (sCRN) REFERENCES COURSES_THIS_SEM(CRN) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE COURSES_TEACHING
(
	tUsername   varchar(32),
	tCRN        varchar(5),
	tSectionNum varchar(3),
	PRIMARY KEY (tUsername, tCRN),
	FOREIGN KEY (tUsername) REFERENCES LOGIN_USER(Username) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (tCRN) REFERENCES COURSES_THIS_SEM(CRN) ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE EMAIL_ALERT
(
	Username varchar(32),
	Name     varchar(20),
	CRN      varchar(5),
	PRIMARY KEY (Username, Name, CRN),
	FOREIGN KEY (CRN) REFERENCES COURSE_WORK(eCRN) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Name) REFERENCES COURSE_WORK(Name) ON DELETE CASCADE ON UPDATE CASCADE,
	FOREIGN KEY (Username) REFERENCES LOGIN_USER(Username) ON DELETE CASCADE ON UPDATE CASCADE
);
