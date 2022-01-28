<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Todo;
use app\models\User;

class TodoController extends Controller
{

    public function actionIsAuthorized($todo)
    {
        $user = User::getAuthUser();
        $todo = Todo::findOne($todo["id"]);

        //replace this with logged in middleware
        if(!$user)
        {
            return "You are not logged in";
            exit();
        }

        if($user->id == $todo["user_id"])
        {
            return true;
        }else
        {
            return false;
        }

    }

    public function actionIndex()
    {
        // $user = Yii::$app->user;
        // var_dump($user);
        // exit();
        $user = User::getAuthUser();

        //replace this with logged in middleware
        if(!$user)
        {
            return "You are not logged in";
            exit();
        }

        $todos = $user->todos;
        return $this->render('index-todo', ["todos" => $todos]);
    }

    public function actionCreate()
    {
        $user = User::getAuthUser();

        //replace this with logged in middleware
        if(!$user)
        {
            return "You are not logged in";
            exit();
        }

        $todo = new Todo();
        $request = Yii::$app->request->post();

        if ($request)
        {
            $todo->todo = $request["todo"];
            $todo->link("user", $user);

            return $this->redirect(['todo/index']);
        }else
        {
            return "Kindly input a todo";
        }
    }

    public function actionEdit()
    {
        
        $todos = new Todo;
        $request = Yii::$app->request->get();

        if($request && $this->actionIsAuthorized($request))
        {
            $id = $request['id'];
            $todo = Todo::find()->where(['id' => $id])->one();
            return $this->render('edit-todo', ['todo' => $todo]);
        }else
        {
            return "Bad request. Kindly try again";
        }
    }

    public function actionUpdate()
    {
        $request = Yii::$app->request->post();
        if($request && $this->actionIsAuthorized($request))
        {
            $id = $request['id'];
            $todo = Todo::findOne($id);
            $todo->todo = $request['todo'];
            $todo->isComplete = array_key_exists('isComplete', $request) ? 1 : 0;
            $todo->updated_at = Date('Y-m-d H:i:s');
            $todo->save();

            //check if updated
            if($todo->todo == $request['todo'])
            {
                return $this->redirect(['/todo/index']);
    
            }else
            {
                return "An error occured. Please try again.";
            }

        }else
        {
            return "Bad request. Kindly try again";
        }
       
    }

    
    public function actionDestroy()
    {
        $request = Yii::$app->request->post();
        if($request && $this->actionIsAuthorized($request))
        {
            $todo = Todo::findOne($request['id']);
            
            if($todo->delete())
            {
                return $this->redirect(['todo/index']);
            }else
            {
                return 'Something went wrong. Please try again';
            }
        }else
        {
            return "Bad request. Kindly try again";
        }
    }

}