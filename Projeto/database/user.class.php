<?php 
    declare(strict_types=1);

    class User {
        public int $id;
        public string $name;
        public string $username;
        public string $email;
        public string $role;
        
        public function __construct(int $id, string $name, string $username, string $email, string $role)
        {
            $this->id = $id;
            $this->name = $name;
            $this->username = $username;
            $this->email = $email;
            $this->role = $role;
        }

        public function getId(): int
        {
            return $this->id;
        }
    
        public function getName(): string
        {
            return $this->name;
        }
    
        public function getUsername(): string
        {
            return $this->username;
        }
    
        public function getEmail(): string
        {
            return $this->email;
        }
    
        public function getRole(): string
        {
            return $this->role;
        }

        static function getUserWithPassword(PDO $db, string $email, string $password) : ?User {
            $stmt = $db->prepare('
              SELECT id, name, username, email, role
              FROM User 
              WHERE lower(email) = ? AND password = ?
            ');
      
            $stmt->execute(array(strtolower($email), sha1($password)));
        
            if ($user = $stmt->fetch()) {
              return new User(
                $user['id'],
                $user['name'],
                $user['username'],
                $user['email'],
                $user['role']
              );
            } else return null;
        }

        static function createUserWithPassword(PDO $db, string $name, string $username, string $email, string $password, string $role) : ?User {
          $stmt = $db->prepare('INSERT INTO User (name, username, email, password, role) VALUES (?, ?, ?, ?, ?)');
          $stmt->execute([$name, $username, $email, sha1($password), $role]);
  
          if ($stmt->rowCount() > 0) {
              $id = (int)$db->lastInsertId();
              return new User($id, $name, $username, $email, $role);
          } else {
              return null;
          }
        }

        static function getUser(PDO $db, int $id): ?User {
          $stmt = $db->prepare('
            SELECT id, name, username, email, role
            FROM User 
            WHERE id = ?
          ');
        
          $stmt->execute([$id]);
          $user = $stmt->fetch();
          
          return new User(
            $user['id'],
            $user['name'],
            $user['username'],
            $user['email'],
            $user['role']
          );
        }

        static function updateUser(PDO $db, int $id, string $name, string $username, string $email, string $password) {
          $stmt = $db->prepare('UPDATE User SET name = ?, username = ?, email = ?, password = ? WHERE id = ?');
          $stmt->execute([$name, $username, $email, sha1($password), $id]);
        }


        //admin functions 
        public function upgradeRole(PDO $db, string $newRole) {
          if ($this->role === 'admin') {
            $stmt = $db->prepare('UPDATE users SET role = ? WHERE id = ?');
            $stmt->execute([$newRole, $this->id]);
            if ($stmt->rowCount() > 0) {
              $this->role = $newRole;
              return json_encode(['success' => true]);
            }
          }
          return json_encode(['success' => false]);
        }

        function addDepartment(PDO $db, string $departmentName) {
          if ($this->role == 'admin'){
            $stmt = $db->prepare('INSERT INTO departments (name) VALUES (?)');
            $stmt->execute([$departmentName]);
        
            if ($stmt->rowCount() > 0) {
                return true;
            }
          }
          return false;
        }

        function assignAgentToDepartment(PDO $db, int $userId, int $departmentId) {
          if ($this->role == 'admin'){

            $stmt = $db->prepare('SELECT id FROM users WHERE id = ? AND role = "agent"');
            $stmt->execute([$userId]);
            $agent = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($agent) {
                $agentId = $agent['id'];
        
                $stmt = $db->prepare('INSERT INTO department_assignments (agent_id, department_id) VALUES (?, ?)');
                $stmt->execute([$agentId, $departmentId]);
        
                // Check if was successful
                if ($stmt->rowCount() > 0) {
                    return true;
                }
            }
          }
          return false;
        }
    }

?>
