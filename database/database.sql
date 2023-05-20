.mode column
.headers on

create table user (
    id integer primary key autoincrement,
    first_name text default 'none',
    last_name text default 'none',
    username text unique,
    email text unique,
    creation_date text default (datetime('now', 'localtime')),
    password text
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
    name text
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
    original_poster integer references user,
    title text,
    description text,
    post_date text default (datetime('now', 'localtime')),
    last_updated text default (datetime('now', 'localtime')),
    closing_date text,
    img_reference text,
    agent_id references agent
);

create table ticket_version (
    id integer primary key autoincrement,
    title text,
    description text,
    version_date text,
    ticket_id references ticket
);

create table messages (
    id integer primary key autoincrement,
    text text,
    post_date text default (datetime('now', 'localtime')),
    ticket_id integer references ticket,
    sender_id integer references user
);

create table hashtag (
    content text primary key
);

-- junction table para a relação *---* de ticket e hashtag
create table ticket_hashtag (
    ticket_id references ticket,
    hashtag_id references hashtag,
    primary key (ticket_id, hashtag_id)
);

create table faq (
    id integer primary key autoincrement,
    title text,
    answer text
);
