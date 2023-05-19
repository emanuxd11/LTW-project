<?php
    // TODO: implement page to view ticket
    //       implement adding images to tickets in form and database       

    declare(strict_types = 1);

    class Ticket {
        private $DEPARTMENTS = array("Accounting", "Sales", "Marketing", "IT");

        public int $id;
        public string $department;
        public string $title;
        public string $description;
        public bool $status_closed;
        public string $creation_date;
        public string $closing_date;
        public int $client_id;
        public int $agent_id;
        public string $image_rfr;

        function __construct($id, $department, $title, $description, $status, $creation_date, $closing_date, $client_id, $agent_id, $image_rfr) {
            $this->id = $id;
            $this->department = $department;
            $this->title = $title;
            $this->description = $description;
            $this->status = $status;
            $this->creation_date = $creation_date;
            $this->closing_date = $closing_date;
            $this->client_id = $client_id;
            $this->agent_id = $agent_id;
            $this->image_rfr = $image_rfr;
        }

        function getId() : int {
            return $this->id;
        }

        function isClosed() : bool {
            return $this->closing_date !== "";
        }

        function markClosed(PDO $db) {
            // status is derived from closing date
            // assign closing date in the db
        }

        function isAssigned() : bool {
            return $this->agent_id !== -1;
        }

        static function submitTicket(PDO $db, $department, $title, $description, $client_id) {
            // insert ticket into ticket table
            $stmt = $db->prepare('
                INSERT INTO ticket (department, original_poster, title, description) VALUES ( ?, ?, ?, ? )
            ');
            $stmt->execute(array($department, $client_id, $title, $description));

            // do something for the image and hashtags later
        }

        static function getAllTicketIds(PDO $db) {
            $stmt = $db->prepare('
                SELECT id 
                FROM ticket 
            ');
            $stmt->execute();

            $id_array = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $id_array[] = $row['id'];
            }

            return $id_array;
        }

        static function getTicketById(PDO $db, int $id) : Ticket {
            $stmt = $db->prepare('
                SELECT * 
                FROM ticket 
                WHERE id = ?
            ');

            $stmt->execute(array($id));
            $ticket = $stmt->fetch();

            return new Ticket (
                $ticket['id'],
                $ticket['department'] === null ? "" : $ticket['department'],
                $ticket['title'],
                $ticket['description'],
                $ticket['status'],
                $ticket['post_date'],
                $ticket['closing_date'] === null ? "" : $ticket['closing_date'],
                $ticket['original_poster'],
                $ticket['agent_id'] === null ? -1 : $ticket['agent_id'],
                $ticket['image_reference'] === null ? "" : $ticket['image_reference']
            );
        }

        static function getTicketIdsFiltered(PDO $db, $department, $sortOrder, $searchText) {
            
            if ($department != "all") {
                $query = "SELECT id FROM ticket WHERE department = '$department'";
            } else {
                $query = "SELECT id FROM ticket WHERE 1=1";
            }
    
            if($searchText != "") {
                $query = $query . " AND (title LIKE '%$searchText%' OR description LIKE '%$searchText%')";
            }
    
            if($sortOrder == "newest") {
                $query = $query . " ORDER BY post_date ASC";
            } else if($sortOrder == "oldest") {
                $query = $query . " ORDER BY post_date DESC";
            }
            
    
            //Obtain the tickets from the database
            $stmt = $db->prepare($query);
            $stmt->execute();
    
            
            $ticket_ids_array = array();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $ticket_ids_array[] = $row['id'];
            }
    
            return $ticket_ids_array;
        }
    }
?>