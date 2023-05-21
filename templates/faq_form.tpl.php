<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawFaqForm() { ?>
  <section id="faq-form">
    <h1>Create a FAQ</h1>
    <form action="../actions/submit_faq.php" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" onblur="checkValidTitle()">
      <span id="title_status"></span>

      <label for="answer">Answer:</label>
      <textarea id="answer" name="answer" onblur="checkValidAnswer()"></textarea>
      <span id="answer_status"></span>

      <input type="submit" id="submit-button" value="Add FAQ" disabled>
    </form>
  </section>
<?php } ?>