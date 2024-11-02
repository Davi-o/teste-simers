<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property float $salary
 * @property string $department
 * @property string|null $hire_date
 */
class Employees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'salary', 'department'], 'required'],
            [['first_name', 'last_name', 'email', 'department'], 'string', 'max' => 255],
            [['salary'], 'number'],
            [['hire_date'], 'date', 'format'=> 'php:Y-m-d'],
            [['hire_date'], 'safe'],
            [['email'], 'email'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'salary' => 'Salary',
            'department' => 'Department',
            'hire_date' => 'Hire Date',
        ];
    }

    public function formatSalary()
    {
        return Yii::$app->formatter->asCurrency($this->salary);
    }

}
