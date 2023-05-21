<?php
  declare(strict_types = 1);

  require_once(__DIR__ . '/../utils/session.php');
  $session = new Session();

  require_once(__DIR__ . '/../database/connection.db.php');

  require_once(__DIR__ . '/../templates/common.tpl.php');

  require_once(__DIR__ . '/../templates/faq_form.tpl.php');

  $db = getDatabaseConnection();

  drawHeader($session); ?>
  
  <section id="about-us">
    <h1>About Us</h1>
    <p>Welcome to our tech company! At NNTickets, we are dedicated to revolutionizing the world through innovative technology solutions. Our mission is to empower individuals and businesses by providing cutting-edge software, hardware, and digital services.</p>
    <p>With a team of highly skilled engineers, designers, and visionaries, we strive to deliver exceptional products and services that exceed our customers' expectations. We are committed to staying at the forefront of technological advancements, constantly pushing boundaries and exploring new possibilities.</p>
    <p>Our core values of creativity, collaboration, and customer-centricity drive everything we do. We believe in fostering a culture of innovation and continuous learning, encouraging our team members to unleash their full potential and embrace challenges.</p>
    <p>Whether you're a small startup or a large enterprise, we're here to partner with you on your digital transformation journey. From software development and cloud solutions to IoT and AI, we have the expertise to help you leverage technology to drive growth and achieve your goals.</p>
    <p>Thank you for choosing NNTickets. We look forward to serving you and being your trusted technology partner.</p>
  </section>

  
  <?php drawFooter();
?>