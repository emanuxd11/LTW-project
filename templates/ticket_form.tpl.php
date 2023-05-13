<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawTicketForm() { ?>
  <section id="ticket-form">
    <h1>Create a Ticket</h1>
    <form action="../actions/submit_ticket.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" onblur="checkValidTitle()">
      <span id="title_status"></span>

      <label for="description">Description:</label>
      <textarea id="description" name="description" onblur="checkValidDescription()"></textarea>
      <span id="description_status"></span>

      <label for="department">Department:</label>
      <select id="department" name="department">
        <option value="" selected disabled>Select Department (optional)</option>
        <?php
          $departments = array("Accounting", "Sales", "Marketing", "IT");

          foreach ($departments as $department) {
            echo "<option value='" . $department . "'>" . $department . "</option>";
          }
        ?>
      </select>

      <label for="hashtags">Hashtags (não funciona, fazer isto mais tarde porque é complexo):</label>
      <input type="text" id="hashtags" name="hashtags">

      <input type="submit" id="submit-button" value="Submit Ticket" disabled>
    </form>
  </section>
<?php } ?>
