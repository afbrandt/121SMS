create table student{
varchar2[25] fname not null,
varchar2[25] lname not null,
char sex not null,
date bdate not null,
varchar2[12] phone_number,
varchar2[50] address,
varchar2[25] birthplace,
varchar2[25] passport_id
varchar2[10] ssu_id not null,
date[4] cohort,
varchar2[40] chinese_uni,
constraint pk_studentid primary key(ssu_id),
}

create table transcript{
varchar2[10] sid not null,
number credits,	
double gpa
constraint pk_sid primary key (sid),
constraint fk_transcript_sid foreign key (sid)
references student(ssu_id)
}

create table tests{
varchar2[10] sid not null,
number test_score,
date test_date,
varchar2[25] test_type,
constraint pk_unique_test primary key (sid, test_score, test_date),
constraint fk_tests_sid foreign key (sid)
references student(ssu_id)
}

create table financial_transactions{
varchar2[10] sid not null,
varchar2[10] trans_type,
varchar2[10] trans_number,
date trans_request_date,
date trans_process_date,
double trans_amount,
constraint pk_unique_trans primary key (sid, trans_number),
constraint fk_financial_trans_sid foreign key(sid)
references student(ssu_id)
}

create table departments{
varchar2[25] dept_name,
number dept_id,
varchar2[10] dept_phone,
varchar2[10] dept_location,
constraint pk_dept_id primary key (dept_id)
}

create table current_semester{
varchar2[10] sid,
varchar2[4] class_number,
constraint pk_unique_semester primary key (sid, class_number),
constraint fk_current_semester_sid foreign key (sid)
references student(ssu_id)
}


