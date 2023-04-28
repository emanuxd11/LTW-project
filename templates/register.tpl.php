<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawHeaderWithoutLogin(Session $session) { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>No Name Tickets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../javascript/script.js" defer></script>
  </head>
  <body>

    <header>
      <h1><a href="/">No Name Tickets</a></h1>
      <?php 
        // if ($session->isLoggedIn()) drawLogoutForm($session);
        // else drawLoginForm($session);
      ?>
    </header> 

    <main>
<?php } ?>


<?php function drawRegisterForm() { ?>
    <section id="register">
      <h1>Register</h1>
      <form>
        <label> E-mail <input type="email" name="email"></label>
        <label> Username <input type="text" name="username"></label>
        <label> Password <input type="password" name="password"></label>
        <button formaction="#" formmethod="post">Register</button>
      </form>
    </section>
<?php } ?>