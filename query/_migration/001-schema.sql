create table todo
(
    id text constraint todo_pk primary key,
    title text not null,
    completed integer default 0 not null
);

