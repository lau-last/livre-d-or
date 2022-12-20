<?php

require 'elements/header.php';
require_once 'class/Message.php';
require_once 'class/GuestBook.php';

$success = false;
$title = 'Livre d\'or';
$errors = null;
$guest_book = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');

if (isset($_POST['username'], $_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->is_valid()) {
        $guest_book->add_message($message);
        $success = true;
        $_POST = [];
    } else {
        $errors = $message->get_errors();
    }
}

$messages = $guest_book->get_messages();

?>

<div class="container">
    <h1>Livre d'or</h1>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            Formulaire invalide
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            Merci pour votre message
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="form-groupe mt-4">
            <input value="<?php echo htmlentities($_POST['username'] ?? '') ?>" type="text" name="username"
                   placeholder="Votre pseudo"
                   class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">

            <?php if (isset($errors['username'])): ?>
                <div class="invalid-feedback"><?php echo $errors['username'] ?></div>
            <?php endif; ?>

        </div>
        <div class="form-group mt-4">
            <textarea name="message" placeholder="Votre message"
                      class="form-control <?php echo isset($errors['message']) ? 'is-invalid' : '' ?>"><?php echo htmlentities($_POST['message'] ?? '') ?></textarea>

            <?php if (isset($errors['message'])): ?>
                <div class="invalid-feedback"><?php echo $errors['message'] ?></div>
            <?php endif; ?>

        </div>
        <button class="btn btn-primary mt-4">Envoyer</button>
    </form>

    <?php if (!empty($messages)): ?>
        <h1 class="mt-4">Vos messages</h1>
        <?php foreach ($messages as $message): ?>
            <?php echo $message->to_HTML() ?>
        <?php endforeach ;?>
    <?php endif ;?>

</div>

<?php
require 'elements/footer.php';
?>

