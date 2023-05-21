<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  require_once(__DIR__ . '/../templates/faq_form.tpl.php');

  $db = getDatabaseConnection();

  drawHeader($session); ?>
  
  <section id="contact">
    <h1>Contact Us</h1>
    <div class="contact-info">
      <div class="address">
        <h3>Address</h3>
        <p>401 No Name Street</p>
        <p>Porto, Portugal</p>
      </div>
      <div class="phone">
        <h3>Phone</h3>
        <p>+1 123-456-7890</p>
      </div>
      <div class="email">
        <h3>Email</h3>
        <p>nnt@nnt.com</p>
      </div>
      <div class="fax">
        <h3>Fax</h3>
        <p>+1 987-654-3210</p>
      </div>
    </div>
  </section>
  
  <?php drawFooter();
?>
