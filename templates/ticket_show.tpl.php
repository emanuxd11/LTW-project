<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
  require_once(__DIR__ . '/../database/ticket.class.php');
  require_once(__DIR__ . '/../database/user.class.php');
?>

<?php function drawTicket($ticket, $user) { ?>
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
