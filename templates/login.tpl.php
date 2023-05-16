<?php 
  declare(strict_types = 1); 

  require_once(__DIR__ . '/../utils/session.php');
?>

<?php function drawLoginHeader() { ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>No Name Tickets</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/login-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../js/ajax.js" defer></script>
  </head>
  <body>

    <header>
      <h3><a href="/">No Name Tickets</a></h3>
    </header>

    <main>
<?php } ?>

<?php function drawLoginForm(Session $session) { ?>
    <section id="login-register">
      <h1>Sign In</h1>
      <form action="../actions/user_login.php" method="post" class="login">
        <label> Email <input type="email" name="email" required> </label>
        <label> Password <input type="password" name="password" required></label>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Sign up</a></p>
      </form>

      <section id="messages">
        <?php foreach ($session->getMessages() as $messsage) { ?>
          <article class="<?=$messsage['type']?>">
            <?=$messsage['text']?>
          </article>
        <?php } ?>
      </section>

    </section>
<?php } ?>