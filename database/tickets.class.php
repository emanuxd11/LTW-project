<?php
    class Ticket {
        private $id;
        private $department;
        
        public $title;
        public $description;
        public $status;
        public $creation_date;
        public $closing_date;
        public $client;
        public $agent;

        function __construct($aId, $aTitle, $aDescription, $aDepartment, $aClient) {
            $this->id = $aId;
            $this->title = $aTitle;
            $this->description = $aDescription;
            $this->status = "Open";
            $this->creation_date = date("d-m-Y");
            $this->closing_date = null;
            $this->setDepartment($aDepartment);
            $this->client = $aClient;
            $this->agent = null;
        }

        function getId() {
            return $this->id;
        }

        function getDepartment() {
            return $this->department;
        }

        function setDepartment($aDepartment) {
            if($aDepartment != "Marketing" && $aDepartment != "Engineering") { //Once we define more departments, they should be added here
                $this->department = "No Department";
            }
            else {
                $this->department = $aDepartment;
            }
        }

    }
?>