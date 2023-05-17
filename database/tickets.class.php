<?php
    class Ticket {
        private $id;
        private $department;
        private $status;
        
        public $title;
        public $description;
        public $creation_date;
        public $closing_date;
        public $client;
        public $agent;

        //Constructor for the ticket class
        function __construct($aId, $aTitle, $aDescription, $aDepartment, $aClient, $aDate) {
            $this->id = $aId;
            $this->title = $aTitle;
            $this->description = $aDescription;
            $this->setStatus("Open");
            $this->creation_date = new DateTime("now"); //Change this later so the date of the object ticket is the creation date and not the time the object was created
            $this->closing_date = null;
            $this->setDepartment($aDepartment);
            $this->client = $aClient;
            $this->agent = null;
        }

        //Getter function for the ticket's id
        function getId() {
            return $this->id;
        }

        //Getter function for the ticket's department
        function getDepartment() {
            return $this->department;
        }

        //Setter function for the ticket's department
        function setDepartment($aDepartment) {
            if($aDepartment != "Marketing" && $aDepartment != "Support" && $aDepartment != "Sales") { //Once we define more departments, they should be added here
                $this->department = "No Department";
            }
            else {
                $this->department = $aDepartment;
            }
        }

        //Getter function for the ticket's status
        function getStatus() {
            return $this->status;
        }

        //Setter function for the ticket's status
        function setStatus($aStatus) {
            if($aStatus != "Open" && $aStatus != "Closed") {
                $this->status = "Open";
            }
            else {
                $this->status = $aStatus;
            }
        }

        //returns a string with the creation date in the format "dd-MMM-yyyy HH:mm:ss"
        function displayDate() {
            $date_string = $this->creation_date;
            $date_string = $date_string->format("d-M-Y H:i:s");
            return $date_string;
        }
    }
?>