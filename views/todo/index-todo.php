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
    <title>Todos</title>
</head>
<body>
    <div class="container">
        <h1>Todos</h1>
        <div class="body">

        <?php if($todos)
        {
        ?>
            <div class="todos">
                <div class="todo">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>SN</td>
                                <td>Todo</td>
                                <td>Completed</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $i = 0;
                                foreach($todos as $todo)
                                { 
                                    $i += 1;
                            ?>
                            <tr>
                                <td><?= $i; ?></td>
                                <td><?= $todo->todo; ?></td>
                                <td><?= $todo->isComplete ? 'Completed' : 'Not Completed'; ?></td>
                                <td>
                                <?php
                                    ActiveForm::begin([
                                            'action' => ['todo/edit'],
                                            'method' => 'get',
                                        ]);
                                ?>

                                        <input type="hidden" name="id" value="<?=$todo['id'];?>">
                                        <button class='btn btn-primary' type="submit">Edit</button>
                                    </form>
                                    <?php
                                        ActiveForm::end();
                                    ?>
                                </td>
                                <td> 
                                <?php
                                    ActiveForm::begin([
                                            'action' => ['todo/destroy'],
                                            'method' => 'post',
                                        ]);
                                ?>
                                        <input type="hidden" name="id" value="<?=$todo['id'];?>">

                                        <!-- Add confirmation pop-up -->
                                        <button type="submit" class='btn btn-danger' >Delete</button>
                                <?php
                                    ActiveForm::end();
                                ?>
                                </td>

                            </tr>

                            <?php } ?>
                        </tbody>

                    </table>
                </div>
            </div>

            <?php 
                }else
                {
            ?>
                <p>You have no item in your todo list.</p>
            <?php
                }
            ?>

            <div class="add-todo">
                <?php
                    ActiveForm::begin([
                            'action' => ['todo/create'],
                            'method' => 'post',
                        ]);
                ?>
                    <div class="form-row">
                        <div class="form-group">
                            <!-- CSRF Protection -->
                            <input type="text" class="form-input" name="todo" required placeholder="Wash dishes"/>
                        </div>
                        <div class="form-group">
                            <button class="form-submit btn btn-primary" type="submit">Add Todo</button>
                        </div>
                    </div>
                <?php
                    ActiveForm::end()
                ?>
            </div>

        </div>
    </div>
</body>
</html>