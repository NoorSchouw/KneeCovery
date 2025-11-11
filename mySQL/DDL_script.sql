/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     07/11/2025 16:57:43                          */
/*==============================================================*/
DROP DATABASE IF EXISTS KNEECOVERY;

CREATE DATABASE KNEECOVERY;
USE KNEECOVERY;

drop table if exists chatbotSessions;

drop table if exists chatbotMessage;

drop table if exists exercise;

drop table if exists excerciseExecution;

drop table if exists exerciseSchedule;

drop table if exists faq;

drop table if exists faqCategories;

drop table if exists injury;

drop table if exists patient;

drop table if exists patientExerciseAssigned;

drop table if exists patientInjury;

drop table if exists physiotherapist;

drop table if exists progress;

drop table if exists user;

/*==============================================================*/
/* Table: chatbotSessions                                      */
/*==============================================================*/
create table chatbotSessions
(
    user_id              int not null,
    session_id           int not null,
    started_at           datetime not null,
    ended_at             datetime,
    context              TEXT,
    primary key (user_id, session_id)
);

/*==============================================================*/
/* Table: chatbotMessage                                           */
/*==============================================================*/
create table chatbotMessage
(
    user_id              int not null,
    session_id           int not null,
    message_id           int not null,
    sender               varchar(256) not null,
    message              varchar(256),
    primary key (user_id, session_id, message_id)
);

/*==============================================================*/
/* Table: exercise                                              */
/*==============================================================*/
create table exercise
(
    exercise_id          int not null,
    exercise_video_path  varchar(256),
    exercise_name        varchar(256) not null,
    exercise_description varchar(256) not null,
    primary key (exercise_id)
);

/*==============================================================*/
/* Table: excerciseExecution                                     */
/*==============================================================*/
create table excerciseExecution
(
    schedule_id          int not null,
    execution_id         int not null,
    assignment_id        int,
    execution_date       date not null,
    feedback             varchar(1000) not null,
    score                int not null,
    start_time           time not null,
    end_time             time not null,
    duration             time not null,
    execution_video_path varchar(256),
    primary key (schedule_id, execution_id)
);

/*==============================================================*/
/* Table: exerciseSchedule                                       */
/*==============================================================*/
create table exerciseSchedule
(
    schedule_id          int not null,
    assignment_id        int,
    scheduled_date       date not null,
    primary key (schedule_id)
);

/*==============================================================*/
/* Table: faq                                                   */
/*==============================================================*/
create table faq
(
    question             varchar(256) not null,
    faq_id               varchar(256) not null,
    category_id          int not null,
    answer               varchar(256) not null,
    primary key (faq_id)
);

/*==============================================================*/
/* Table: faqCategories                                        */
/*==============================================================*/
create table faqCategories
(
    category_id          int not null,
    faq_name             varchar(256) not null,
    faq_description      varchar(256),
    primary key (category_id)
);

/*==============================================================*/
/* Table: injury                                                */
/*==============================================================*/
create table injury
(
    affected_area        varchar(256) not null,
    primary key (affected_area)
);

/*==============================================================*/
/* Table: patient                                               */
/*==============================================================*/
create table patient
(
    user_id              int not null,
    phy_user_id          int not null,
    physio_number        int not null,
    start_date           varchar(256) not null,
    treatment_status     varchar(256) not null,
    medical_notes        varchar(256),
    primary key (user_id)
);

/*==============================================================*/
/* Table: patientExerciseAssigned                               */
/*==============================================================*/
create table patientExerciseAssigned
(
    assignment_id        int not null,
    exercise_id          int,
    user_id              int not null,
    physio_number        int not null,
    pat_user_id          int not null,
    frequency            int not null,
    frequency_period     varchar(256) not null,
    assigned_date        date not null,
    personal_video_path  varchar(256),
    primary key (assignment_id)
);

/*==============================================================*/
/* Table: patientInjury                                         */
/*==============================================================*/
create table patientInjury
(
    affected_area        varchar(256) not null,
    user_id              int not null,
    phy_user_id          int not null,
    physio_number        int not null,
    primary key (user_id, phy_user_id, affected_area, physio_number)
);

/*==============================================================*/
/* Table: physiotherapist                                       */
/*==============================================================*/
create table physiotherapist
(
    user_id              int not null,
    physio_number        int not null,
    primary key (user_id, physio_number)
);

/*==============================================================*/
/* Table: progress                                              */
/*==============================================================*/
create table progress
(
    progess_id           int not null,
    user_id              int not null,
    metric_name          varchar(256) not null,
    metric_value         int not null,
    recorded_at          datetime not null,
    primary key (progess_id)
);

/*==============================================================*/
/* Table: user                                                  */
/*==============================================================*/
create table user
(
    user_id              int not null,
    first_name           varchar(50) not null,
    last_name            varchar(50) not null,
    email                varchar(256) not null,
    password             varchar(256) not null,
    gender               varchar(256) not null,
    primary key (user_id)
);

alter table chatbotSessions add constraint fk_belongs_to foreign key (user_id)
    references user (user_id) on delete restrict on update restrict;

alter table chatbotMessage add constraint fk_session_has_a foreign key (user_id, session_id)
    references chatbotSessions (user_id, session_id) on delete restrict on update restrict;

alter table excerciseExecution add constraint fk_executed_at foreign key (assignment_id)
    references patientExerciseAssigned (assignment_id) on delete restrict on update restrict;

alter table excerciseExecution add constraint fk_has_perfomed_at foreign key (schedule_id)
    references exerciseSchedule (schedule_id) on delete restrict on update restrict;

alter table exerciseSchedule add constraint fk_has_to_be_perfomed_at foreign key (assignment_id)
    references patientExerciseAssigned (assignment_id) on delete restrict on update restrict;

alter table faq add constraint fk_belong_to foreign key (category_id)
    references faqCategories (category_id) on delete restrict on update restrict;

alter table patient add constraint fk_physio_has_a foreign key (phy_user_id, physio_number)
    references physiotherapist (user_id, physio_number) on delete restrict on update restrict;

alter table patient add constraint fk_user_is_a foreign key (user_id)
    references user (user_id) on delete restrict on update restrict;

alter table patientExerciseAssigned add constraint fk_assigned_to foreign key (exercise_id)
    references exercise (exercise_id) on delete restrict on update restrict;

alter table patientExerciseAssigned add constraint fk_can_assign foreign key (user_id, physio_number)
    references physiotherapist (user_id, physio_number) on delete restrict on update restrict;

alter table patientExerciseAssigned add constraint fk_has_to_perform foreign key (pat_user_id)
    references patient (user_id) on delete restrict on update restrict;

alter table patientInjury add constraint fk_patient_has_a foreign key (affected_area)
    references injury (affected_area) on delete restrict on update restrict;

alter table patientInjury add constraint fk_patient_has_a2 foreign key (user_id)
    references patient (user_id) on delete restrict on update restrict;

alter table physiotherapist add constraint fk_user_is_a_physio foreign key (user_id)
    references user (user_id) on delete restrict on update restrict;

alter table progress add constraint fk_has foreign key (user_id)
    references patient (user_id) on delete restrict on update restrict;

