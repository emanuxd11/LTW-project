<?php
    require("tickets.class.php");

    function DisplayTickets($ticket_array) {
        /*$department = $_GET["departmentChoice"];
        $sortOrder = $_GET["sortOrder"];
        $searchBar = $_GET["ticketSearchBar"];
        */
        $ticket_class = "ticket";
        $ticket_id_initial = "ticket_";
        
        foreach($ticket_array as $ticket) {
            $ticket_id_initial = $ticket_id_initial . $ticket->getId();
            $department = $ticket->getDepartment();
            $redirectFunction = "redirectTicket(" . $ticket->getId() . ")";
        
            echo "<article class=$ticket_class id=$ticket_id_initial onClick=$redirectFunction>
                    <h1>Title: $ticket->title</h1>
                    <h2>Author: $ticket->client</h2>
                    <h3>Department: $department</h3>
                    <p>Ticket: $ticket->description</p>
                </article>";

            $ticket_id_initial = "ticket_";

        }
    }
    
?>