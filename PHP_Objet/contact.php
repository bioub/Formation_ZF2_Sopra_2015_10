<?php
require_once 'vendor/autoload.php';

if (isset($_POST['sujet'], $_POST['message'])) {
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    $dest = 'tmp/';

    $mail = new \Zend\Mail\Message();
    $mail->setSubject($sujet)
        ->addTo('romain.bohdanowicz@gmail.com')
        ->setFrom('romain.bohdanowicz@gmail.com')
        ->setBody($message);

    $options = new \Zend\Mail\Transport\FileOptions();
    $options->setPath($dest);

    $transport = new \Zend\Mail\Transport\File($options);
    $transport->send($mail);

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Formulaire Contact</title>
</head>
<body>
<form method="post">
    <p>
        Sujet :
        <input name="sujet">
    </p>

    <p>
        Message :
        <textarea name="message"></textarea>
    </p>

    <p>
        <button type="submit">Nous contacter</button>
    </p>
</form>
</body>
</html>