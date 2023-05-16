.mode column
.headers on

create table user (
    id integer primary key autoincrement,
    first_name varchar default 'none',
    last_name varchar default 'none',
    username varchar unique,
    email varchar unique,
    creation_date varchar default (datetime('now', 'localtime')),
    password varchar
);

create table client (
    id integer primary key autoincrement,
    user_id integer references user 
);

create table agent (
    id integer primary key autoincrement,
    user_id integer references user 
);

create table admin (
    id integer primary key autoincrement,
    user_id integer references user 
);

create table department (
    id integer primary key autoincrement,
    name varchar
);

-- tabela de associação para a relação *---* de agent e department
create table agent_department (
    agent_id integer references agent,
    department_id integer references department,
    primary key (agent_id, department_id)
);

create table ticket ( --here we should also include a field for the client id
    id integer primary key autoincrement,
    department integer references department,
    title varchar,
    description varchar,
    post_date date,
    last_updated date,
    img_reference varchar,
    status boolean, 
    agent_id references agent
);

create table ticket_version (
    id integer primary key autoincrement,
    title varchar,
    description varchar,
    version_date date,
    ticket_id references ticket
);

create table replies (
    id integer primary key autoincrement,
    text varchar,
    post_date date,
    last_updated date,
    ticket_id integer references ticket,
    agent_id integer references agent
);

create table reply_version (
    id integer primary key autoincrement,
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
    id integer primary key autoincrement,
    title varchar,
    description varchar
);
