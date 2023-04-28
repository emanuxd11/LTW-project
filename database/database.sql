create table user (
    id int primary key,
    name varchar,
    username varchar,
    email varchar,
    creation_date text default datetime(),
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
    id int primary key,
    department int references department,
    title varchar,
    description varchar,
    post_date date,
    last_updated date,
    img_reference varchar,
    status boolean, 
    agent_id references agent
);

create table ticket_version (
    id int primary key,
    title varchar,
    description varchar,
    version_date date,
    ticket_id references ticket
);

create table replies (
    id int primary key,
    text varchar,
    post_date date,
    last_updated date,
    ticket_id int references ticket,
    agent_id int references agent
);

create table reply_version (
    id int primary key,
    text varchar,
    version_date date,
    reply_id references reply
);

create table hashtag (
    content varchar primary key
);

-- junction table para a relação *---* de agent e department
create table ticket_hashtag (
    ticket_id references ticket,
    hashtag_id references hashtag,
    primary key (ticket_id, hashtag_id)
);

create table faq (
    id int primary key,
    title varchar,
    description varchar
);
