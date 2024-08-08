DROP TABLE IF EXISTS Ticket_Hashtag;
DROP TABLE IF EXISTS TicketHistory;
DROP TABLE IF EXISTS Ticket;
DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Hashtag;
DROP TABLE IF EXISTS Department;
DROP TABLE IF EXISTS FAQ;


CREATE TABLE User (
    id INTEGER PRIMARY KEY,
    name TEXT,
    username TEXT NOT NULL UNIQUE,
    password NVARCHAR(40) NOT NULL,
    email TEXT NOT NULL UNIQUE,
    role TEXT NOT NULL CHECK (role IN ('client', 'agent', 'admin'))
);


CREATE TABLE Ticket (
    id INTEGER PRIMARY KEY,
    title TEXT NOT NULL,
    description TEXT NOT NULL,
    date DATE,
    status TEXT,
    creator_id INTEGER NOT NULL,
    assignee_id INTEGER,
    department_id INTEGER,
    FOREIGN KEY (creator_id) REFERENCES User(id),
    FOREIGN KEY (assignee_id) REFERENCES User(id),
    FOREIGN KEY (department_id) REFERENCES Department(id)
);



CREATE TABLE Hashtag (
    id INTEGER PRIMARY KEY,
    text TEXT NOT NULL UNIQUE
);

CREATE TABLE Ticket_Hashtag (
    ticket_id INTEGER NOT NULL,
    hashtag_id INTEGER NOT NULL,
    PRIMARY KEY (ticket_id, hashtag_id),
    FOREIGN KEY (ticket_id) REFERENCES Ticket(id) ON DELETE CASCADE,
    FOREIGN KEY (hashtag_id) REFERENCES Hashtag(id) ON DELETE CASCADE
);

CREATE TABLE TicketHistory (
    id INTEGER PRIMARY KEY,
    ticket_id INTEGER,
    title TEXT,
    description TEXT,
    date DATE,
    status TEXT,
    creator_id INTEGER,
    assignee_id INTEGER,
    department_id INTEGER,
    user_id INTEGER,
    timestamp DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY(ticket_id) REFERENCES Ticket(id),
    FOREIGN KEY(creator_id) REFERENCES User(id),
    FOREIGN KEY(assignee_id) REFERENCES User(id),
    FOREIGN KEY(department_id) REFERENCES Department(id),
    FOREIGN KEY(user_id) REFERENCES User(id)
);


CREATE TRIGGER TicketHistoryInsertTrigger AFTER INSERT ON Ticket
BEGIN
    INSERT INTO TicketHistory (
        ticket_id,
        title,
        description,
        date,
        status,
        creator_id,
        assignee_id,
        department_id,
        user_id
    )
    VALUES (
        NEW.id,
        NEW.title,
        NEW.description,
        NEW.date,
        NEW.status,
        NEW.creator_id,
        NEW.assignee_id,
        NEW.department_id,
        1 -- replace with the appropriate user id
    );
END;

CREATE TRIGGER TicketHistoryUpdateTrigger AFTER UPDATE ON Ticket
BEGIN
    INSERT INTO TicketHistory (
        ticket_id,
        title,
        description,
        date,
        status,
        creator_id,
        assignee_id,
        department_id,
        user_id
    )
    SELECT
        NEW.id,
        NEW.title,
        NEW.description,
        NEW.date,
        NEW.status,
        NEW.creator_id,
        NEW.assignee_id,
        NEW.department_id,
        1 -- replace with the appropriate user id
    WHERE
        NEW.title <> OLD.title OR
        NEW.description <> OLD.description OR
        NEW.date <> OLD.date OR
        NEW.status <> OLD.status OR
        NEW.assignee_id <> OLD.assignee_id;
END;






CREATE TABLE Department (
    id INTEGER PRIMARY KEY,
    name TEXT NOT NULL
);

CREATE TABLE FAQ (
    id INTEGER PRIMARY KEY,
    question TEXT NOT NULL,
    answer TEXT NOT NULL
);

-- Users

-- password for every user is password123
INSERT INTO User (name, username, password, email, role)
VALUES
('John Smith', 'johnsmith', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'john.smith@example.com', 'client'),
('Jane Doe', 'janedoe', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'jane.doe@example.com', 'agent'),
('Admin User', 'admin', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'admin@example.com', 'admin');

-- Tickets
INSERT INTO Ticket (title, description, date, status, creator_id, assignee_id, department_id)
VALUES
('Need advice on relationship', 'My partner and I are having trouble communicating. Please help!', '2022-02-15', 'open', 1, 2, 1),
('How to deal with jealousy?', 'I get jealous easily and it causes problems in my relationship. Any advice?', '2022-03-01', 'closed', 2, 1, 2),
('Is it normal to argue?', 'My partner and I argue a lot. Is this normal in a relationship?', '2022-04-05', 'open', 1, null, 1);

-- Hashtags
INSERT INTO Hashtag (text) VALUES
('communication'),
('jealousy'),
('arguing'),
('relationship advice');

-- Ticket_Hashtag
INSERT INTO Ticket_Hashtag (ticket_id, hashtag_id) VALUES
(1, 1),
(1, 4),
(2, 2),
(3, 3),
(3, 4);

-- TicketHistory
INSERT INTO TicketHistory (ticket_id, title, description, date, status, department_id, creator_id, assignee_id, user_id)
VALUES
(1, 'Need advice on relationship', 'My partner and I are having trouble communicating. Please help!', '2022-02-15', 'open', 1, 1, 2, 1),
(2, 'How to deal with jealousy?', 'I get jealous easily and it causes problems in my relationship. Any advice?', '2022-03-01', 'closed', 2, 2, 1, 2),
(3, 'Is it normal to argue?', 'My partner and I argue a lot. Is this normal in a relationship?', '2022-04-05', 'open', 1, 1, null, 1);

-- Departments
INSERT INTO Department (name) VALUES
('Communication'),
('Jealousy'),
('Conflict resolution');

-- FAQ
INSERT INTO FAQ (question, answer) VALUES
('How can I improve communication in my relationship?', 'Try to actively listen to your partner and express your own thoughts and feelings clearly.'),
('What are some common causes of jealousy in relationships?', 'Insecurity, past experiences, and feelings of inadequacy are some common causes of jealousy.'),
('How can I resolve conflicts with my partner?', 'Try to identify the root cause of the conflict, communicate openly and honestly, and work together to find a solution.');