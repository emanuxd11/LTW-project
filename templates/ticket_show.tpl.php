<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/ticket.class.php');
  
  require_once(__DIR__ . '/../database/user.class.php');
  
  require_once(__DIR__ . '/../database/connection.db.php');
?>

<?php function drawTicketStandard(Ticket $ticket, User $user) { ?>
  <section id="ticket">
    <h1><?= $ticket->title ?></h1>
    <p id="description"><?= $ticket->description ?></p>
    <?php if ($ticket->department != null): ?>
     <p>Department: <?= $ticket->department ?></p>
    <?php endif; ?>
    <?php
    $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
    $formattedDatetime = $datetime->format('M d Y \a\t H:i');
    ?>
    <p>Posted by <a href="../profile.php?id=<?= $user->id ?>"><?= $user->username ?></a> on <?= $formattedDatetime ?></p>
<?php } ?>

<?php function drawTicketAdminView(Ticket $ticket, User $user) {
  drawTicketStandard($ticket, $user); ?>
  <div class="admin-view">
    <h4>Admin View</h4>
    <?php if ($ticket->isAssigned()):
        $db = getDatabaseConnection();
        $agent_user_id = $ticket->getAgentUserId($db);
        $agent_username = User::getUser($db, $agent_user_id)->username;
      ?>
      <p>Agent: <a href="<?php echo "../pages/profile.php?id=$agent_user_id"; ?>"><?php echo $agent_username; ?></a></p>
      <p>Status: <?php echo ($ticket->isClosed() ? "closed" : "open"); ?></p>
    <?php else: ?>
      <label>Assign an agent here <input type="text" id="agent-search" placeholder="Search agents..." oninput="agentSearch('<?php echo $ticket->department; ?>', <?php echo $ticket->id?>)"></label>
      <ul id="agent-list"></ul>
    <?php endif; ?>
  </div>
  </section>
<?php } ?>

<?php function drawTicketAgentView(Ticket $ticket, User $user) { ?>
  <?php
    drawTicketStandard($ticket, $user);
  
    if ($ticket->isAssigned()) {
      $agent_user_id = $ticket->getAgentUserId($db);
      $agent_username = User::getUserById($db, $agent_user_id)->username;
      echo "<p>Agent: <a href=\"../pages/profile.php?id=$agent_user_id\">$agent_username</a></p>" . "\n";
    } else {
      echo "<p>Agent: N/A</p>" . "\n";
    }
    // complete with more stuff
  ?>
  </section>
<?php } ?>

<?php function drawTicketClientView(Ticket $ticket, User $user) { ?>
  <?php drawTicketStandard($ticket, $user); ?>
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
          echo "<li>" . "\n";
          echo "<h4><a href=\"../pages/ticket.php?id=$ticket->id\">$ticket->title</a></h4>" . "\n";

          $description = substr($ticket->description, 0, 50) . "...";
          echo "<p>$description</p>" . "\n";
          
          $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
          $datetime = $datetime->format('M d Y \a\t H:i');
          $user = User::getUser($db, $ticket->client_id);
          echo "<span class=\"ticket-date\">Posted by <a href=\"../pages/profile.php?id=$user->id\">$user->username</a> on $datetime</span>" . "\n";
          // acrescentar hashtags aqui nalgum lado mais tarde
        }
      ?>
    </ul>
  </section>
<?php } ?>
