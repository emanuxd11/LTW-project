<?php
    // TODO: implement page to view ticket
    //       implement adding images to tickets in form and database       

    declare(strict_types = 1);

    class Ticket {
        private $departments = array("Accounting", "Sales", "Marketing", "IT");

        private int $id;
        private string $department;
        
        public string $title;
        public string $description;
        public bool $status_closed;
        public string $creation_date;
        public string $closing_date;
        public int $clientId;
        public int $agentId;

        function __construct($id, $department, $title, $description, $status, $creation_date, $closing_date, $clientId, $agentId) {
            $this->id = $id;
            $this->department = $department;
            $this->title = $title;
            $this->description = $description;
            $this->status = $status;
            $this->creation_date = $creation_date;
            $this->closing_date = $closing_date;
            $this->clientId = $clientId;
            $this->agentId = $agentId;
        }

        function getId() {
            return $this->id;
        }

        function getDepartment() {
            return $this->department;
        }

        function setDepartment($department) {
            if (!in_array($department, $departments)) {
                $this->department = null;
            } else {
                $this->department = $aDepartment;
            }
        }

        static function submitTicket(PDO $db, $department, $title, $description, $clientId) {
            // insert ticket into ticket table
            $stmt = $db->prepare('
                INSERT INTO ticket (department, original_poster, title, description) VALUES ( ?, ?, ?, ? )
            ');
            $stmt->execute(array($department, $clientId, $title, $description));
        }
    }
?>