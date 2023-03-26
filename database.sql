create table user (
    id int primary key,
    name varchar,
    username varchar,
    email varchar,
    password varchar
);

create table client (
    id int primary key,
    user_id int references user 
);

create table agent (
    id int primary key,

    user_id int references user 
);

create table admin (
    id int primary key,
    user_id int references user 
);

create table department (
    id int primary key,
    name varchar
);

-- tabela de associação para a relação *---* de agent e department
create table agent_department (
    agent_id int references agent,
    department_id int references department,
    primary key (agent_id, department_id)
);

create table ticket (
    id int,
    department int references department,
    title varchar,
    description varchar,
    -- image (?)
    status boolean, -- boolean ou varchar?
    agentID references agent,
    primary key (id, department)
);

create table replies (
    text varchar,
    ticketID int references ticket(id),
    agentID int references agent
);