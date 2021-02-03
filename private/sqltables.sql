CREATE TABLE users(
    idUsers INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nameUsers LONGTEXT NOT NULL,
    surnameUsers LONGTEXT NOT NULL,
    dobUsers LONGTEXT NOT NULL,
    uNameUsers TINYTEXT NOT NULL,
    mailUsers LONGTEXT NOT NULL,
    dNumUsers INT(11) NOT NULL,
    pwdUsers LONGTEXT NOT NULL,
    isVerified INT(1) NOT NULL DEFAULT 0,
    isAdminUsers INT(1) NOT NULL DEFAULT 0,
    createdUsers TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pwdReset(
    pwdResetId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    pwdResetEmail TEXT NOT NULL,
    pwdResetSelector TEXT NOT NULL,
    pwdResetToken LONGTEXT NOT NULL,
    pwdResetExpires TEXT NOT NULL,
    pwdResetUrl LONGTEXT NOT NULL
);

CREATE TABLE events(
    eventsId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    eventsCreatedBy TEXT NOT NULL,
    eventsCreatedById int(11) NOT NULL,
    eventsDate TEXT NOT NULL,
    eventsTime TEXT NOT NULL,
    eventsStart TEXT NOT NULL,
    eventsEnd TEXT NOT NULL,
    eventsInfo TEXT NOT NULL,
    eventsCreated TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE eventsAttendance(
    eventsAttendanceId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    eventsAttendanceLinkedId int(11) NOT NULL,
    eventsAttendanceDriverId int(11) NOT NULL,
    eventsAttendanceDriverTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE jobs(
    jobsId int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    jobsDriverId int(11) NOT NULL,
    jobsCargo TEXT NOT NULL,
    jobsStart TEXT NOT NULL,
    jobsCompanyStart TEXT NOT NULL,
    jobsEnd TEXT NOT NULL,
    jobsCompanyEnd TEXT NOT NULL,
    jobsDistance TEXT NOT NULL,
    jobsFuel TEXT NOT NULL,
    jobsCost TEXT NOT NULL,
    jobsRev TEXT NOT NULL,
    jobsTime TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE accounts(
    accountsId INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    accountsDriverId INT(11) NOT NULL,
    accountsBalance INT(11) NOT NULL,
    accountsJobsComp INT(11) NOT NULL,
    accountsInsurance INT(1) NOT NULL
);
