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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/script.js" defer></script>
  </head>
  <body>

    <header>
      <h1><a href="/">No Name Tickets</a></h1>
    </header>

    <main>
<?php } ?>

<?php function drawRegisterForm(Session $session) { ?>
    <section id="register">
      <h1>Register</h1>
      <form action="../actions/user_register.php" method="post" class="register">
        <label> Email <input type="email" name="email" id="email" oninput="checkEmailExists()" required> </label>
        <span id="email_status"></span>

        <!-- falta: 
          verificar a força da pass durante o input;
          bloquear o submit enquanto houver erros
        -->

        <label> First Name <input type="text" name="first_name"></label>
        <label> Last Name <input type="text" name="last_name"></label>

        <label> Username <input type="text" name="username" id="username" oninput="checkUsernameExists()" required> </label>
        <span id="username_status"></span>

        <label> Password <input type="password" name="password" id="password" required></label>
        <label> Confirm Password <input type="password" name="password_confirmation" id="password_confirmation" oninput="checkPasswordsMatch()" required></label>
        <span id="password_status"></span>

        <button type="submit">Register</button>
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