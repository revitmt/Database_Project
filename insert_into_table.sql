INSERT INTO LOGIN_USER VALUES ('ali_stu', 'ali123', 'Alice', 'M', 'Lambert', 'alice@gmail.com', 'S');
INSERT INTO LOGIN_USER VALUES ('bob_stu', 'bob123', 'Bob', 'C', 'Reeves', 'bob@gmail.com', 'S');
INSERT INTO LOGIN_USER VALUES ('chr_stu', 'chr123', 'Chris', 'A', 'Campbell', 'chris@gmail.com', 'S');
INSERT INTO LOGIN_USER VALUES ('cen_ins', 'cen123', 'Cen', NULL , 'Li', 'cenli@gmail.com', 'T');
INSERT INTO LOGIN_USER VALUES ('jos_ins', 'jos123', 'Joshua', NULL , 'Philips', 'joshua@gmail.com', 'T');
INSERT INTO LOGIN_USER VALUES ('zhi_ins', 'zhi123', 'Zhijiang', NULL , 'Dong', 'zhijiang@gmail.com', 'T');


INSERT INTO COURSES VALUES ('CSCI 3130', 'Visualization', 'This is scientific visualization.');
INSERT INTO COURSES VALUES ('CSCI 2170', 'Python', 'This is python.');
INSERT INTO COURSES VALUES ('CSCI 4560', 'C++', 'This is C++.');


INSERT INTO COURSES_THIS_SEM VALUES ('CSCI 2170', '81141', '001');
INSERT INTO COURSES_THIS_SEM VALUES ('CSCI 2170', '81142', '002');
INSERT INTO COURSES_THIS_SEM VALUES ('CSCI 3130', '81146', '001');
INSERT INTO COURSES_THIS_SEM VALUES ('CSCI 4560', '81159', '001');


INSERT INTO COURSE_WORK VALUES ('Homework6', '81141', '001', 'Homework6.pdf','2015-11-11', '2015-12-11', 'HM');
INSERT INTO COURSE_WORK VALUES ('Project6', '81142', '002', 'Project6.pdf','2015-11-12', '2015-12-12', 'PJ');
INSERT INTO COURSE_WORK VALUES ('ClosedLab10', '81146', '001', 'ClosedLab10.txt','2015-10-17', '2015-11-10', 'CL');
INSERT INTO COURSE_WORK VALUES ('ClosedLab11', '81146', '001', 'ClosedLab11.pdf','2015-11-17', '2015-12-10', 'CL');
INSERT INTO COURSE_WORK VALUES ('ResearchPaper1', '81159', '001', 'ResearchPaper.pdf','2015-10-01', '2015-12-16', 'RP');
INSERT INTO COURSE_WORK VALUES ('Homework7', '81159', '001', 'Homework7.doc', '2015-12-10', '2015-12-17', 'HM');


INSERT INTO COURSES_ENROLLED VALUES ('ali_stu', '81141', '001');
INSERT INTO COURSES_ENROLLED VALUES ('ali_stu', '81146', '001');
INSERT INTO COURSES_ENROLLED VALUES ('bob_stu', '81146', '001');
INSERT INTO COURSES_ENROLLED VALUES ('bob_stu', '81159', '001');
INSERT INTO COURSES_ENROLLED VALUES ('chr_stu', '81142', '002');
INSERT INTO COURSES_ENROLLED VALUES ('chr_stu', '81146', '001');


INSERT INTO COURSES_TEACHING VALUES ('cen_ins', '81141', '001');
INSERT INTO COURSES_TEACHING VALUES ('zhi_ins', '81142', '002');
INSERT INTO COURSES_TEACHING VALUES ('jos_ins', '81146', '001');
INSERT INTO COURSES_TEACHING VALUES ('zhi_ins', '81159', '001');
