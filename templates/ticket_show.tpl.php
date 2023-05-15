<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/ticket.class.php');
  
  require_once(__DIR__ . '/../database/user.class.php');
  
  require_once(__DIR__ . '/../database/connection.db.php');
?>

<?php function drawTicket(Ticket $ticket, User $user) { ?>
  <section id="ticket">
    <?php
      echo "<h1>$ticket->title</h1>";
      echo "<p id=\"description\">$ticket->description</p>";
      if ($ticket->department != null) {
        echo "<p>Department: $ticket->department</p>";
      }
      // acrescentar hashtags mais tarde
      $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
      $datetime = $datetime->format('M d Y \a\t H:i');
      echo "<p>Posted by <a href=\"../profile.php?id=$user->id\">$user->username</a> on $datetime.<p>";
    ?>
  </section>
<?php } ?>

<?php function drawTicketsPreview(Session $session, PDO $db) { ?>
  <section class="recent-tickets">
    <h2>Recent Tickets</h2>
    <ul class="ticket-list">
      <?php 
        $id_array = array_slice(array_reverse(Ticket::getAllTicketIds($db)), 0, 5);
        foreach($id_array as &$id) {
          $ticket = Ticket::getTicketById($db, $id);
          echo "<li>";
          echo "<h4><a href=\"../pages/ticket.php?id=$ticket->id\">$ticket->title</a></h4>";

          $description = substr($ticket->description, 0, 50) . "...";
          echo "<p>$description</p>";
          
          $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
          $datetime = $datetime->format('M d Y \a\t H:i');
          $user = User::getUser($db, $ticket->client_id);
          echo "<span class=\"ticket-date\">Posted by <a href=\"../pages/profile.php?id=$user->id\">$user->username</a> on $datetime</span>";
          // acrescentar hashtags aqui nalgum lado mais tarde
        }
      ?>
    </ul>
  </section>
<?php } ?>
