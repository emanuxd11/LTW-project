create table user (
    id integer primary key autoincrement,
    name varchar,
    username varchar,
    email varchar,
    creation_date TEXT DEFAULT (datetime('now', 'localtime')),
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

create table ticket (
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
