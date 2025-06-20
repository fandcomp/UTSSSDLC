<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Secure Contact</title>
</head>
<body>
    <h1>Secure Contact Form</h1>

    <?php if (session()->getFlashdata('errors')) : ?>
        <ul>
            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                <li><?= esc($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form action="<?= base_url('contact/submit') ?>" method="post">
        <?= csrf_field() ?>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Message:</label>
        <textarea name="message" required></textarea><br>
        <button type="submit">Send</button>
    </form>
</body>
</html>
