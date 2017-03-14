CREATE TABLE Student
(student_email VARCHAR(100) NOT NULL PRIMARY KEY,
 phone VARCHAR(20),
 name VARCHAR(256) NOT NULL,
);

CREATE TABLE Problem
(problem_number INTEGER NOT NULL,
 homework_number INTEGER NOT NULL,
 class_number INTEGER NOT NULL,
 department VARCHAR(8) NOT NULL,
 school VARCHAR(100) NOT NULL,
 PRIMARY KEY(problem_number, homework_number, class_number, department, school)
);

CREATE TABLE WantsHelpWith
(student_email VARCHAR(100) NOT NULL REFERENCES Student(student_email),
 problem_number INTEGER NOT NULL,
 homework_number INTEGER NOT NULL, 
 class_number INTEGER NOT NULL,
 department VARCHAR(8) NOT NULL,
 school VARCHAR(100) NOT NULL,
 date DATE NOT NULL,
 blockEmails BOOLEAN,
 FOREIGN KEY (problem_number, homework_number, class_number, department, school) REFERENCES Problem(problem_number, homework_number, class_number, department, school),
 PRIMARY KEY(student_email, problem_number, homework_number, class_number, department, school)
);

#THIS TABLE IS CLEARED EVERY 5 MINUTES! WORYING ABOUT FOREIGN KEYS, FUNCTIONAL DEPENDENCIES, TABLE SIZE, ETC. IS POINTLESS.
#HAVING A PRIMARY KEY DOESN'T MATTER BECAUSE I WILL NEVER PERFORM ANYTHING BEYOND A Select * AND Insert ON THIS TABLE
#THIS DATA IS ALL TEMPORARY, AND IS FASTER THAN ANY OTHER METHOD OF RECORDING WHO I NEED TO EMAIL
CREATE TABLE EmailsToSend
(target_email VARCHAR(100) NOT NULL,
 target_name  VARCHAR(256) NOT NULL,
 classmate_name VARCHAR(256) NOT NULL,
 classmate_email VARCHAR(100) NOT NULL,
 classmate_phone VARCHAR(20),
 department VARCHAR(8) NOT NULL,
 class_number INTEGER NOT NULL,
 homework_number INTEGER NOT NULL
);

