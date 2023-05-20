<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/ticket.class.php');
  
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../database/message.class.php');
  
  require_once(__DIR__ . '/../database/connection.db.php');
?>

<?php function drawChat(Ticket $ticket, $messages, Session $session) { ?>
  <div class="chat">
    <h4>Chat</h4>

    <div class="messages" id="message-container">

      <?php 
        foreach ($messages as $message) { ?>
          <div class=<?php echo $message->sender_id === $session->getId() ? "\"me\"" : "\"them\""; ?>>
            <div class="sender"> <?php echo $message->sender_username ?> </div>
            <div class="text"> <?php echo $message->text ?> </div>
          </div>
        <?php }
      ?>

    </div>

    <form action="../actions/send_message.php" class="chat-input" method="post">
      <input type="text" name="text" placeholder="Write a message..." autocomplete="off" autofocus />
      <input type="hidden" name="ticket_id" value=<?php echo $ticket->id; ?> />
      <input type="hidden" name="sender_id" value=<?php echo $session->getId(); ?> />
      <button>Send</button>
    </form>

  </div>
<?php } ?>

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
    <p>Posted by <a href="../pages/profile.php?id=<?= $user->id ?>"><?= $user->username ?></a> on <?= $formattedDatetime ?></p>
<?php } ?>

<?php function drawTicketAdminView(Ticket $ticket, User $user, $messages, Session $session) {
  drawTicketStandard($ticket, $user); ?>
  <div class="admin-view">
    <h4>Admin View</h4>
    <?php if ($ticket->isAssigned()):
        $db = getDatabaseConnection();
        $agent_user_id = $ticket->getAgentUserId($db);
        $agent_username = User::getUser($db, $agent_user_id)->username;
      ?>
      <p>Agent: <a href="<?php echo "../pages/profile.php?id=$agent_user_id"; ?>"><?php echo $agent_username; ?></a></p>
      <?php if (!$ticket->isClosed()): ?>
        <form id="unassign" action="../actions/unassign_agent.php" method="post">
          <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>">
          <input type="submit" value="Unassign">
        </form>
      <?php endif ?>
    <?php elseif (!$ticket->isClosed()): ?>
      <label>Assign an agent here <input type="text" id="agent-search" placeholder="Search agents..." oninput="agentSearch('<?php echo $ticket->department; ?>', <?php echo $ticket->id?>)"></label>
      <ul id="agent-list"></ul>
    <?php endif; ?>
    <p>Status: <?php echo ($ticket->isClosed() ? "closed" : "open"); ?></p>
    <?php if (!$ticket->isClosed()): ?>
      <form id="mark-closed" action="../actions/close_ticket.php" method="post">
        <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>">
        <input type="submit" value="Mark as closed">
      </form>
    <?php endif; ?>
  </div>

  <?php drawChat($ticket, $messages, $session); ?>

  </section>
<?php } ?>

<?php function drawTicketAgentView(Ticket $ticket, User $user, $messages, Session $session) {
  drawTicketStandard($ticket, $user); ?>
  <div class="admin-view">
    <h4>Agent View</h4>
    
    <?php if ($ticket->isAssigned()):
        $db = getDatabaseConnection();
        $agent_user_id = $ticket->getAgentUserId($db);
        $agent_username = User::getUser($db, $agent_user_id)->username;
      ?>

      <p>Agent: <a href="<?php echo "../pages/profile.php?id=$agent_user_id"; ?>"><?php echo $agent_username; ?></a></p>
    
    <?php elseif (!$ticket->isClosed()): ?>
    
      <label>Assign an agent here <input type="text" id="agent-search" placeholder="Search agents..." oninput="agentSearch('<?php echo $ticket->department; ?>', <?php echo $ticket->id?>)"></label>
      <ul id="agent-list"></ul>
    
    <?php endif; ?>
  
    <p>Status: <?php echo ($ticket->isClosed() ? "closed" : "open"); ?></p>
  
    <?php if (!$ticket->isClosed() and $ticket->isAssigned() and $ticket->agent_id === $session->getId()): ?>
  
      <form id="mark-closed" action="../actions/close_ticket.php" method="post">
        <input type="hidden" name="ticket_id" value="<?php echo $ticket->id; ?>">
        <input type="submit" value="Mark as closed">
      </form>
  
      <?php endif; ?>
  </div>

  <?php 
    if ($ticket->isAssigned() and $ticket->agent_id === $session->getId()) {
      drawChat($ticket, $messages, $session);
    }
  ?>

  </section>
<?php } ?>

<?php function drawTicketClientView(Ticket $ticket, User $user, $messages, Session $session) { ?>
  <?php drawTicketStandard($ticket, $user); ?>
  <?php 
    if ($ticket->client_id === $session->getId()) {
      drawChat($ticket, $messages, $session);
    }
  ?>
  </section>
<?php } ?>

<?php function drawTicketsPreview(Session $session, PDO $db) { ?>
  <section class="recent-tickets">
    <h2>Recent Tickets</h2>
    <ul class="ticket-list">
      <?php 
        if ($_GET["departmentChoice"] == null) { //If the user didn't select a department, the default is "all"
          $department = "all";
        }
        else {
          $department = $_GET["departmentChoice"];
        }
        
        if ($_GET["sortOrder"] == null) { //If the user didn't select a sort order, the default is "newest"
          $sortOrder = null;
        }
        else {
          $sortOrder = $_GET["sortOrder"];
        }
        
        if (($_GET["searchText"] == null) or ($_GET["searchText"] == "")) { //If the user didn't search for anything, the default is an empty string
            $searchText = "";
        }
        else {
            $searchText = $_GET["searchText"];
        }
        
        $id_array = array_slice(array_reverse(Ticket::getTicketIdsFiltered($db, $department, $sortOrder, $searchText)), 0, 5);
        foreach($id_array as &$id) {
          $ticket = Ticket::getTicketById($db, $id);
          echo "<li>" . "\n";
          echo "<h4><a href=\"../pages/ticket.php?id=$ticket->id\">$ticket->title</a></h4>" . "\n";

          $description = substr($ticket->description, 0, 50) . "...";
          echo "<p>$description</p>" . "\n";
          
          $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
          $datetime = $datetime->format('M d Y \a\t H:i');
          $user = User::getUser($db, $ticket->client_id);
          echo "<span class=\"ticket-date\">Posted by <a href=\"../pages/user.php?id=$user->id\">$user->username</a> on $datetime</span>" . "\n";
          // acrescentar hashtags aqui nalgum lado mais tarde
        }
      ?>
    </ul>
  </section>
<?php } ?>

<?php function drawUserTickets(PDO $db, $user_id) { ?>
  <section class="user-tickets">
    <?php 
      $user = User::getUser($db, $user_id);
      $username = $user->username;

      echo '<h3>' . $username . '\'s Tickets:</h3>' . "\n";
    ?>
  
    <ul class="ticket-list">
      <?php
        $id_array = array_reverse(Ticket::getUserTickets($db, $user_id));
        foreach($id_array as &$id) {
          $ticket = Ticket::getTicketById($db, $id);
          echo "<li>" . "\n";
          echo "<h4><a href=\"../pages/ticket.php?id=$ticket->id\">$ticket->title</a></h4>" . "\n";

          $description = substr($ticket->description, 0, 50) . "...";
          echo "<p>$description</p>" . "\n";
          
          $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
          $datetime = $datetime->format('M d Y \a\t H:i');
          $user = User::getUser($db, $ticket->client_id);
          echo "<span class=\"ticket-date\">Posted by <a href=\"../pages/user.php?id=$user->id\">$user->username</a> on $datetime</span>" . "\n";
          // acrescentar hashtags aqui nalgum lado mais tarde
        }
      ?>
    </ul>
  </section>
<?php } ?>

<?php function drawMyTickets(Session $session, PDO $db) { ?>
  <section class="my-tickets">
    <h3>My Tickets </h3>
    <ul class="ticket-list">
      <?php
        $id_array = array_reverse(Ticket::getUserTickets($db, $session->getId()));
        foreach($id_array as &$id) {
          $ticket = Ticket::getTicketById($db, $id);
          echo "<li>" . "\n";
          echo "<h4><a href=\"../pages/ticket.php?id=$ticket->id\">$ticket->title</a></h4>" . "\n";

          $description = substr($ticket->description, 0, 50) . "...";
          echo "<p>$description</p>" . "\n";
          
          $datetime = DateTime::createFromFormat('Y-m-d H:i:s', $ticket->creation_date);
          $datetime = $datetime->format('M d Y \a\t H:i');
          $user = User::getUser($db, $ticket->client_id);
          $username = $user->username;
          echo "<span class=\"ticket-date\">Posted by <a href=\"../pages/profile.php\">$username</a> on $datetime</span>" . "\n";
          // acrescentar hashtags aqui nalgum lado mais tarde
        }
      ?>
    </ul>
  </section>
<?php } ?>

<?php function DrawSearchOptions() { ?>
  <form action="../pages/index.php" method="get">
    <?php
      $db = getDatabaseConnection();
      $stmt = $db->prepare('SELECT name FROM department');
      $stmt->execute();
      $departments = $stmt->fetchAll();
    ?>

    <div id="searchOptions">
      <div class="searchOptionsSection">
        <label for="department" >Department: </label>

        <select id="departmentSelect" name="departmentChoice">
          <?php
            echo "<option value=\"all\">All Departments</option>";

            foreach($departments as $department) {
              $department_name = $department['name'];

              echo "<option value=$department_name>$department_name</option>";
            }
          ?>
        </select>
      </div>

      <div class="searchOptionsSection">
        <label for="sortOrder">Sort by: </label> 
        
        <select id="sortOrder" name="sortOrder">
          <option value="newest">Newest</option>
          <option value="oldest">Oldest</option>
        </select>
      </div>

      <div class="search-bar">
        <input type="text" placeholder="Search..." name="searchText">
        <input type="submit" class="searchButton" value="Search">
      </div>
    </div> 
  </form>
<?php } ?> 
