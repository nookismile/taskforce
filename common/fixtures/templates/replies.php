<?php
/**
 * @var $faker \Faker\Generator
 * @var $index integer
 */

use app\models\Task;
use app\models\User;
use yii\db\Expression;

return [
    'user_id' => User::find()->select('id')->orderBy(new Expression('rand()'))->scalar(),
    'dt_add' => $faker->dateTimeBetween('-1 month')->format('Y-m-d'),
    'description' => $faker->realTextBetween(),
    'task_id' => Task::find()->select('id')->orderBy(new Expression('rand()'))->scalar(),
    'is_approved' => rand(0, 1)
];