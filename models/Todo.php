<?php

namespace app\models;

use Yii;
use app\models\User;
use yii\db\ActiveRecord;

class Todo extends ActiveRecord
{

    public function rules()
    {
        return [
            ["todo", "required"]
        ];
    }

    public static function tableName()
    {
        return "Todos";
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ["id" => "user_id"])->inverseOf("todos");
    }

}