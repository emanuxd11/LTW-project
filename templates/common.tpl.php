<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeader(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>No Name Tickets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- css -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/ticket_form.css">
    <link rel="stylesheet" href="../css/faq_form.css">
    <link rel="stylesheet" href="../css/faq.css">
    <link rel="stylesheet" href="../css/about.css">
    <link rel="stylesheet" href="../css/ticket_page.css">
    <link rel="stylesheet" href="../css/contact.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" >
    
    <!-- js -->
    <script src="../js/chat.js" defer></script>
    <script src="../js/ajax.js" defer></script>
    <script src="../js/form_validation.js" defer></script>
  </head>

  <body>
    <header>
      <h3><a href="/">No Name Tickets</a></h3>
      <?php 
        if ($session->isLoggedIn()) {
          drawLogoutForm($session);
        } else {
          drawLoginRegisterLink();
        }
      ?>
    </header>

    <section id="top-bar">
      <ul id="menu-items">
        <li> <a href="../pages/index.php">Home</a> </li>
        <li> <a href="../pages/faq_list.php">FAQ</a> </li>
        <li> <a href="../pages/contacts.php">Contact Us</a> </li>
        <li> <a href="../pages/profile.php?id=<?php echo $session->getId(); ?>">Account</a> </li>
        <li> <a href="../pages/about_us.php">About Us</a> </li>
      </ul>
    </section>

    <main>
<?php } ?>

<?php function drawTicketFormLink(Session $session) { ?>
  <?php
    if ($session->isLoggedIn()) {
      echo "<a href=\"../pages/ticket_form.php\" id=\"ticket-form-link\">Having issues? Click here to create a new ticket!</a>";
    } else {
      echo "<a href=\"../pages/login.php\" id=\"ticket-form-link\">Having issues? Sign in to create a new ticket!</a>";
    }
  ?>
<?php } ?>

<?php function drawFaqFormLink() { ?>
  <a href="../pages/faq_form.php" id="faq-form-link">Tired of seeing similar questions? Click here to create a FAQ.</a>;
<?php } ?>

<?php function drawLoginRegisterLink() { ?>
  <div class="login-register">
    <a href="../pages/register.php" class="register-btn">Sign up</a>
    <a href="../pages/login.php" class="login-btn">Log in</a>
  </div>
<?php } ?>

<?php function drawLogoutForm(Session $session) { ?>
  <form action="../actions/user_logout.php" method="post" class="logout">
    <a href="../pages/profile.php"><?=$session->getUsername()?></a>
    <button type="submit">Logout</button>
  </form>
<?php } ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
      No Name Tickets ltd. &copy; 2023
    </footer>
  </body>
</html>
<?php } ?>
