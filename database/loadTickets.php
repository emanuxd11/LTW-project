<?php

use function PHPSTORM_META\map;
    require_once($_SERVER['DOCUMENT_ROOT'] . '/database/connection.db.php');

    function loadTickets(bool $isMine = true) {
        $db = getDatabaseConnection();
        
        $departmentQuery = "SELECT name FROM department WHERE id = ?"; //Query to get department name from id

        
        if ($_GET["departmentChoice"] == null) { //If the user didn't select a department, the default is "all"
            $department = "all";
        }
        else {
            $department = $_GET["departmentChoice"];
        }
        
        if ($_GET["sortOrder"] == null) { //If the user didn't select a sort order, the default is "newest"
            $sortOrder = "newest";
        }
        else {
            $sortOrder = $_GET["sortOrder"];
        }
        
        if ($_GET["ticketSearchBar"] == null or $_GET["ticketSearchBar"] == "") { //If the user didn't search for anything, the default is an empty string
            $searchBar = "";
        }
        else {
            $searchBar = $_GET["ticketSearchBar"];
        }
        
        if ($department != "all") {
            $stmt = $db->prepare("SELECT id FROM department WHERE name = '$department'");
            $stmt->execute();
            $department = $stmt->fetch()["id"];

            $query = "SELECT * FROM ticket WHERE department = '$department'";
        } else {
            $query = "SELECT * FROM ticket WHERE 1=1";
        }
        
        /* This should be changed later, in order to display just the current user's tickets
        if($isMine) {
            $query = $query . " AND client = '$_SESSION[username]'";
        }
        */

        if($searchBar != "") {
            $query = $query . " AND title LIKE '%$searchBar%'";
        }

        if($sortOrder == "newest") {
            $query = $query . " ORDER BY post_date DESC";
        } else if($sortOrder == "oldest") {
            $query = $query . " ORDER BY post_date ASC";
        }
        

        //Obtain the tickets from the database
        $stmt = $db->prepare($query);
        $stmt->execute();
        $tickets = $stmt->fetchAll();

        //Prepare the query that will obtain the department name from the id
        $stmt = $db->prepare($departmentQuery);

        $ticket_array = array();

        foreach($tickets as $ticket) {
            $department_id = $ticket["department"];

            $stmt->execute(array($department_id));
            $department_name = $stmt->fetch()["name"];
            
            $ticket = new Ticket($ticket["id"], $ticket["title"], $ticket["description"], $department_name, null, $ticket["date"]); //null is the client name, add it later
            array_push($ticket_array, $ticket);
        }

        return $ticket_array;
    }

?>