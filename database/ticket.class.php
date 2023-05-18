<?php
    //       implement adding images to tickets in form and database       

    declare(strict_types = 1);

    class Ticket {
        private $DEPARTMENTS = array("Accounting", "Sales", "Marketing", "IT");

        public int $id;
        public string $department;
        public string $title;
        public string $description;
        public string $creation_date;
        public string $closing_date;
        public int $client_id;
        public int $agent_id;
        public string $image_rfr;

        function __construct($id, $department, $title, $description, $creation_date, $closing_date, $client_id, $agent_id, $image_rfr) {
            $this->id = $id;
            $this->department = $department;
            $this->title = $title;
            $this->description = $description;
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

        function hasDepartment() : bool {
            return $this->department !== "";
        }

        function assignAgent(PDO $db, $agent_id) {
            $stmt = $db->prepare('
                UPDATE ticket
                SET agent_id = ?
                WHERE id = ?;
            ');

            $stmt->execute(array($agent_id, $this->id));

            $this->agent_id = $agent_id;
        }

        function getAgentUserId(PDO $db) : ?int {
            /* if (!$this->isAssigned) {
                return null;
            } */

            $stmt = $db->prepare('
                SELECT user.id
                FROM agent 
                INNER JOIN user ON agent.user_id=user.id 
                WHERE agent.id=?;
            ');

            $stmt->execute(array($this->agent_id));
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = intval($row['id']);

            return $id;
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
                $ticket['post_date'],
                $ticket['closing_date'] === null ? "" : $ticket['closing_date'],
                $ticket['original_poster'],
                $ticket['agent_id'] === null ? -1 : intval($ticket['agent_id']),
                $ticket['img_reference'] === null ? "" : $ticket['image_reference']
            );
        }
    }
?>