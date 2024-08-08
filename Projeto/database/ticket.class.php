<?php
    declare(strict_types=1);

    class Ticket {
        public int $id;
        public string $title;
        public string $description;
        public DateTime $date;
        public string $status;
        public int $creator_id;
        public ?int $assignee_id;
        public ?int $department_id;

        public function __construct(int $id, string $title, string $description, DateTime $date, string $status, int $creator_id, ?int $assignee_id, ?int $department_id) {
            $this->id = $id;
            $this->title = $title;
            $this->description = $description;
            $this->date = $date;
            $this->status = $status;
            $this->creator_id = $creator_id;
            $this->assignee_id = $assignee_id;
            $this->department_id = $department_id;
        }

        public static function createTicket($db,$creator_id, $title, $description, $department) {
            // Get the current date
            $date = new DateTime();
    
            // Default status is 'open'
            $status = 'open';
    
            // Default assignee_id is NULL
            $assignee_id = null;
    
            // Prepare and execute the SQL query
            $query = "INSERT INTO Ticket (title, description, date, status, creator_id, assignee_id, department_id)
                      VALUES (:title, :description, :date, :status, :creator_id, :assignee_id, :department_id)";
            $statement = $db->prepare($query);
            $statement->bindParam(':title', $title);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':date', $date->format('Y-m-d'));
            $statement->bindParam(':status', $status);
            $statement->bindParam(':creator_id', $creator_id);
            $statement->bindParam(':assignee_id', $assignee_id);
            $statement->bindParam(':department_id', $department);
    
            if ($department === 'None') {
                $department = null; // Set the department to NULL
                $statement->bindValue(':department_id', $department, PDO::PARAM_NULL);
            } else {
                $statement->bindParam(':department_id', $department);
            }

            // Execute the query
            if ($statement->execute()) {
                // Return the created Ticket object
                $ticketId = (int)$db->lastInsertId();
                return new Ticket($ticketId, $title, $description, $date, $status, (int)$creator_id, $assignee_id, (int)$department);
            } else {
                // Return null if the ticket creation failed
                echo('no');
                return null;
            }
        }


        public static function editTicket($db, $ticketId, $title, $description, $department) {
            $query = "UPDATE Ticket SET title = :title, description = :description, department_id = :department_id WHERE id = :ticket_id";
            $statement = $db->prepare($query);
            $statement->bindParam(':title', $title);
            $statement->bindParam(':description', $description);
            $statement->bindParam(':department_id', $department);
            $statement->bindParam(':ticket_id', $ticketId);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }

        public static function editDepartment($db, $ticketId, $department) {
            $query = "UPDATE Ticket SET department_id = :department_id WHERE id = :ticket_id";
            $statement = $db->prepare($query);
            $statement->bindParam(':department_id', $department);
            $statement->bindParam(':ticket_id', $ticketId);

            if ($statement->execute()) {
                return true;
            } else {
                return false;
            }
        }


        //agent functions
        public static function getTicketsByDepartment(PDO $db, int $departmentId, array $filters = []): array {
            $query = "SELECT * FROM tickets WHERE department_id = :departmentId";
            $queryParams = [':departmentId' => $departmentId];
    
            // Apply filters
            if (isset($filters['status'])) {
                $query .= " AND status = :status";
                $queryParams[':status'] = $filters['status'];
            }
    
            if (isset($filters['priority'])) {
                $query .= " AND priority = :priority";
                $queryParams[':priority'] = $filters['priority'];
            }
    
            // Add additional filters as needed 
            $stmt = $db->prepare($query);
            $stmt->execute($queryParams);
    
            $tickets = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ticket = new Ticket(
                    $row['ticket_id'],
                    $row['title'],
                    $row['description'],
                    new DateTime($row['date']),
                    $row['status'],
                    $row['creator_id'],
                    $row['assignee_id'],
                    $row['department_id']
                );
            
                $tickets[] = $ticket;
            }
    
            return $tickets;
        }

        public function updateAssignedAgent(PDO $db, int $ticketId, ?int $assigneeId): bool {
            $stmt = $db->prepare('UPDATE tickets SET assignee_id = ? WHERE ticket_id = ?');
            $stmt->execute([$assigneeId, $ticketId]);

            return $stmt->rowCount() > 0;
        }

        public function updateTicketStatus(PDO $db, int $ticketId, string $status): bool {
            $stmt = $db->prepare('UPDATE tickets SET status = ? WHERE ticket_id = ?');
            $stmt->execute([$status, $ticketId]);

            return $stmt->rowCount() > 0;
        }


        
    }


?>
