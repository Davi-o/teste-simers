<?php

namespace app\controllers;

use app\models\Employees;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $query = Employees::find();

        if ($department = Yii::$app->request->get('department')) {
            $query->andFilterWhere(['like', 'department', $department]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $model = new Employees();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model
        ]);
    }
    public function actionIncreaseSalary()
    {
        $department = Yii::$app->request->post('department');
        if($department) {
            $employees = Employees::find()->where(['department' => $department])->all();
            foreach ($employees as $employee) {
                $employee->salary *= 1.05;
                if (!$employee->save()) {
                    Yii::$app->session->setFlash('error', 'Failed to increase salary to ' . $employee->first_name . ' ' . $employee->last_name);
                }
            }
    
            Yii::$app->session->setFlash('success', 'Increased the salary in the department: ' . $department);

        } else {
            Yii::$app->session->setFlash('error', 'Department cannot be empty ');
        }

        return $this->redirect(['index', 'department' => $department]);
    }

    public function actionRecentHires()
    {
        $query = Employees::find()
            ->where(['>=', 'hire_date', new \yii\db\Expression('DATE_SUB(CURDATE(), INTERVAL 6 MONTH)')]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('recent-hires', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreate()
    {
        $model = new Employees();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Employees::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
