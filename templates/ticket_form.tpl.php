<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawTicketForm() { ?>
  <section id="ticket-form">
    <h1>Create a Ticket</h1>
    <form action="../actions/submit_ticket.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title">

      <label for="description">Description:</label>
      <textarea id="description" name="description"></textarea>

      <label for="hashtags">Hashtags:</label>
      <input type="text" id="hashtags" name="hashtags" list="hashtag-list" multiple>
      <datalist id="hashtag-list">
        <option value="#sales">
        <option value="#marketing">
        <option value="#accounting">
        <option value="#IT">
      </datalist>

      <label for="department">Department:</label>
      <select id="department" name="department">
        <option value="" selected disabled>Select Department</option>
        <?php
          $departments = array("Accounting", "Sales", "Marketing", "IT");

          for ($i = 0; $i < count($departments); $i++) {
            echo "<option value='" . ($i+1) . "'>" . $departments[$i] . "</option>";
          }
        ?>
      </select>

      <input type="submit" value="Submit Ticket">
    </form>
  </section>
<?php } ?>
