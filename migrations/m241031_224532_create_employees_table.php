<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Handles the creation of table `{{%employees}}`.
 */
class m241031_224532_create_employees_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees}}', [
            'id' => $this->primaryKey(),
            'first_name' => Schema::TYPE_STRING . ' not null ',
            'last_name' => Schema::TYPE_STRING . ' not null ',
            'email' => Schema::TYPE_STRING . ' not null unique',
            'salary' => Schema::TYPE_FLOAT . ' not null ',
            'department' => Schema::TYPE_STRING . ' not null ',
            'hire_date' => Schema::TYPE_DATE,
        ]);

        $this->batchInsert('{{%employees}}', 
        [
            'first_name',
            'last_name',
            'email',
            'salary',
            'department',
            'hire_date',
        ], 
        [
            ['john','doe','john@doe',3500,'HR','2023-11-15'],
            ['joao','silva','joao@silva',3500,'HR','2023-11-12'],
            ['maria','doe','doe@maria',3500,'HR','2022-01-01'],
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%employees}}');
    }
}
