-- Populating the department table
INSERT INTO department (name)
VALUES ("Support"),
       ("Sales"),
       ("Marketing");

-- Populating the user table
INSERT INTO user (first_name, last_name, username, email, password)
VALUES ("John", "Doe", "johndoe", "johndoe@example.com", "password"),
       ("Jane", "Smith", "janesmith", "janesmith@example.com", "password");

-- Populating the agent table
INSERT INTO agent (user_id)
VALUES (1),
       (2);

-- Populating the ticket table
INSERT INTO ticket (department, title, description, post_date, last_updated, img_reference, status, agent_id)
VALUES (1, "Issue with Payment", "I made a payment but it is not reflecting in my account. Please help.", "2023-05-10", "2023-05-12", "image001.jpg", 1, 1),
       (2, "Login Trouble", "I am unable to log in to my account. It keeps showing an error message.", "2023-05-11", "2023-05-13", "image002.jpg", 1, 2),
       (3, "Product Inquiry", "I have some questions regarding the specifications of your product. Can you provide more details?", "2023-05-12", "2023-05-14", "image003.jpg", 1, null),
       (1, "Product Return Request", "I would like to initiate a return for the product I purchased. Please guide me through the process.", "2023-05-13", "2023-05-15", "image004.jpg", 1, null),
       (2, "Website Bug Report", "There is a bug on your website that prevents me from completing my purchase. Please fix it as soon as possible.", "2023-05-14", "2023-05-15", "image005.jpg", 1, null),
       (3, "Marketing Campaign Inquiry", "Im interested in your current marketing campaigns. Can you provide more information on how to participate?", "2023-05-15", "2023-05-15", "image006.jpg", 1, null),
       (1, "Technical Support Needed", "My device is not functioning properly. I need technical assistance to resolve the issue.", "2023-05-15", "2023-05-16", "image007.jpg", 1, 2);

-- Populating the ticket_version table
INSERT INTO ticket_version (title, description, version_date, ticket_id)
VALUES ("Issue with Payment (v2)", "I made a payment but it is still not reflecting in my account. Please help.", "2023-05-13", 1),
       ("Login Trouble (v2)", "I am still unable to log in to my account. The error message persists.", "2023-05-14", 2);

-- Populating the replies table
INSERT INTO replies (text, post_date, last_updated, ticket_id, agent_id)
VALUES ("We apologize for the inconvenience. Our team is looking into the issue and will resolve it soon.", "2023-05-12", "2023-05-13", 1, 1),
       ("Please try clearing your browser cache and cookies. If the issue persists, contact our support team for further assistance.", "2023-05-13", "2023-05-14", 2, 1);

