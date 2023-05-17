<?php
    declare(strict_types = 1);
    require($_SERVER['DOCUMENT_ROOT'] . '/database/tickets.class.php');

    function DisplayTickets($ticket_array) {
        $ticket_class = "ticket";
        $ticket_id_initial = "ticket_";
        
        foreach($ticket_array as $ticket) {
            $ticket_id_initial = $ticket_id_initial . $ticket->getId();
            $department = $ticket->getDepartment();
            $redirectFunction = "redirectTicket(" . $ticket->getId() . ")";
            $ticket_date_f = $ticket->displayDate();
            $ticket_status = $ticket->getStatus(); 
        
            echo "<article class=$ticket_class id=$ticket_id_initial onClick=$redirectFunction>
                    <h1>Title: $ticket->title</h1>";
            
            //Blockquote that displays the status of the ticket
            if($ticket_status == "Open") {
                echo "<blockquote value=$ticket_status>Open</blockquote>";
            }
            else {
                echo "<blockquote value=$ticket_status>Close</blockquote>";
            }

            echo  "<h2>Author: $ticket->client</h2>
                    <h3>Department: $department</h3>
                    <h4>Post Date: $ticket_date_f</h4>
                    <p>Description: $ticket->description</p>
                </article>";

            $ticket_id_initial = "ticket_";

        }
    }
    
?>
