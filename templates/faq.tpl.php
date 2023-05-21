<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');

  require_once(__DIR__ . '/../database/faq.class.php');
  
  require_once(__DIR__ . '/../database/user.class.php');

  require_once(__DIR__ . '/../database/message.class.php');
  
  require_once(__DIR__ . '/../database/connection.db.php');
?>

<?php function drawFaqsPreview(Session $session, PDO $db) { ?>
  <section class="faqs">
    <h2>FAQ</h2>
    <ul class="faq-list">
      <?php 
        $id_array = Faq::getAllFaqIds($db);
        foreach($id_array as &$id) {
          $faq = Faq::getFaqById($db, $id);
          echo "<li>" . "\n";
          echo "<h4><a href=\"../pages/faq.php?id=$faq->id\">$faq->title</a></h4>" . "\n";

          $answer = substr($faq->answer, 0, 50) . "...";
          echo "<p>$answer</p>" . "\n";
        }
      ?>
    </ul>
  </section>
<?php } ?>

<?php function drawFaq(Faq $faq) { ?>
  <section id="faq">
    <h1>Question: "<?= $faq->title ?>"</h1>
    <p id="answer"><?= $faq->answer ?></p>
  </section>
<?php } ?>