<?php
    use yii\bootstrap4\ActiveForm;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    
    <?php
    ActiveForm::begin([
        "method" => "post",
        "action" => ["/site/create"]
    ]);
    ?>
    <div>
        <label for="name">Name</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label for="name">Username</label>
        <input type="text" name="username" required>
    </div>

    <div>
        <label for="name">Password</label>
        <input type="password" name="password" required>
    </div>

    <!-- <div>
        <label for="name">Confirm Password</label>
        <input type="password" name="password_confirmation" required>
    </div> -->

    <div>
        <button type="submit">Submit</button>
    </div>

    <?php
    ActiveForm::end();
    ?>


</body>
</html>