use db_project;


/* 4. View available Projects */
DROP PROCEDURE IF EXISTS showAvailCourseWork;
DELIMITER $$
CREATE PROCEDURE showAvailCourseWork(stuUsername varchar(20), type char(2))
BEGIN
	SELECT Name, Assign_date, Due_date, eDescription
	FROM COURSE_WORK JOIN COURSES_ENROLLED ON eCRN=sCRN AND eSectionNum=sSectionNum
	WHERE sUserName = stuUsername AND Work_type = type;
END $$

DELIMITER ;


DROP PROCEDURE IF EXISTS showAllAvailCourseWork;
DELIMITER $$
CREATE PROCEDURE showAllAvailCourseWork(stuUsername varchar(20))
BEGIN
	SELECT Name, Assign_date, Due_date, eDescription
	FROM COURSE_WORK JOIN COURSES_ENROLLED ON eCRN=sCRN AND eSectionNum=sSectionNum
	WHERE sUserName = stuUsername;
END $$

DELIMITER ;


/* 5. View active Projects */
DROP PROCEDURE IF EXISTS showActiveCourseWork;
DELIMITER $$
CREATE PROCEDURE showActiveCourseWork(stuUsername varchar(20), type char(2))
BEGIN
	SELECT Name, Assign_date, Due_date, eDescription
	FROM COURSE_WORK JOIN COURSES_ENROLLED ON eCRN=sCRN AND eSectionNum=sSectionNum
	WHERE sUserName = stuUsername AND Work_type = type AND Assign_date <= CURDATE() AND Due_date >= CURDATE();
END $$

DELIMITER ;

DROP PROCEDURE IF EXISTS showAllActiveCourseWork;
DELIMITER $$
CREATE PROCEDURE showAllActiveCourseWork(stuUsername varchar(20))
BEGIN
	SELECT Name, Assign_date, Due_date, eDescription
	FROM COURSE_WORK JOIN COURSES_ENROLLED ON eCRN=sCRN AND eSectionNum=sSectionNum
	WHERE sUserName = stuUsername AND Assign_date <= CURDATE() AND Due_date >= CURDATE();
END $$

DELIMITER ;


/* 8. Add coursework */
/* Example :
   call addCourseWork('CSCI 4560', 'Survey1', '001', 'Survey.txt', '2015-11-17', '2015-12-10', 'SV');
   call addCourseWork(     '4560','Survey1','001','Survey.txt','2015-11-17','2015-12-10','SV')
 */
DROP PROCEDURE IF EXISTS addCourseWork;
DELIMITER $$
CREATE PROCEDURE addCourseWork( cNum varchar(20), cName varchar(20), sNum varchar(3), eDes varchar(50), aDate date, dDate date, wtype varchar(2))
BEGIN
	INSERT INTO COURSE_WORK VALUES (cName, (
											SELECT CRN 
											FROM COURSES_THIS_SEM
											WHERE eCourseNum=cNum AND SectionNum=sNum 
											),
											sNum, eDes, aDate, dDate, wtype);
END $$

DELIMITER ;

/* 9. Edit assign and due date */
/* Example :
   call editAssignDueDate('ResearchPaper1', '81159', '2015-9-1', '2015-12-10');
 */
DROP PROCEDURE IF EXISTS editAssignDueDate;
DELIMITER $$
CREATE PROCEDURE editAssignDueDate(cName varchar(20), c_crn varchar(5), aDate date, dDate date)
BEGIN
	UPDATE COURSE_WORK
	SET Assign_date = aDate, Due_date = dDate
	WHERE Name = cName AND eCRN = c_crn;
END $$

DELIMITER ;

/* 11. View Coursework of all courses taught by the instructor */
/* Example :
	 call courseWorkOfInstructor('zhi_ins');
*/
DROP PROCEDURE IF EXISTS courseWorkOfInstructor;
DELIMITER $$
CREATE PROCEDURE courseWorkOfInstructor(IN InsUserName varchar(20))
BEGIN
	SELECT Name, eCRN, eSectionNum, eDescription, Assign_date, Due_date, Work_type
	FROM COURSE_WORK JOIN (
													SELECT tCRN 
												 	FROM COURSES_TEACHING
												 	WHERE tUsername = InsUserName
												) as dT 
												ON eCRN = dT.tCRN
												ORDER BY Due_date;
END $$

DELIMITER ;

/* 12. & 13. Delete coursework*/
/* Example :
	 call deleteCourseWork('ResearchPaper1', '81159');
*/
DROP PROCEDURE IF EXISTS deleteCourseWork;
DELIMITER $$
CREATE PROCEDURE deleteCourseWork( CourseWorkName varchar(20), crnNum varchar(5))
BEGIN
	DELETE from COURSE_WORK
	WHERE Name = CourseWorkName AND eCRN = crnNum;
END $$

DELIMITER ;


/* 16. Add email alert */
/* Example :
	 call courseWorkOfInstructor('zhi_ins');
*/
DROP PROCEDURE IF EXISTS AddEmailAlert;
DELIMITER $$
CREATE PROCEDURE AddEmailAlert(IN UserName varchar(32), Name varchar(20), CRN  varchar(5))
BEGIN
	INSERT INTO EMAIL_ALERT VALUES (UserName, Name, CRN);
END $$

DELIMITER ;


/* 17. Show email alerts */
/* Example :
	 call courseWorkOfInstructor('zhi_ins');
*/
DROP PROCEDURE IF EXISTS ShowEmailAlert;
DELIMITER $$
CREATE PROCEDURE ShowEmailAlert(IN User_Name varchar(32))
BEGIN
	SELECT * FROM EMAIL_ALERT WHERE Username = User_Name;
END $$

DELIMITER ;



DROP TRIGGER IF EXISTS HashPass;
DELIMITER $$
create trigger HashPass before insert on login_user
for each row
begin 
IF EXISTS (SELECT NEW.Password) 
    THEN 
    	SET NEW.Password = md5(NEW.Password); 
    END IF;
end$$

DELIMITER ;