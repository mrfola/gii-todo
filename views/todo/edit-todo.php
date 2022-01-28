<?php
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Todo</title>
</head>
<body>
    <?php
        ActiveForm::begin([
                'action' => ['todo/update'],
                'method' => 'post'
        ]);
    ?>

    <input type="hidden" name="id" value="<?= $todo['id']; ?>" />
    <input type="text" name="todo" value="<?= $todo['todo']; ?>" />
    <input type="checkbox" name="isComplete" <?= $todo['isComplete'] ? "checked" : ''; ?> />
    <button type="submit">Update</button>

    <?php
        ActiveForm::end();
    ?>
</body>
</html>