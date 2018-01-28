<?php

namespace app\models;

use yii\db\Query;

class User extends \dektrium\user\models\User
{
    /**
     * @param $role
     * @return array
     * @throws \yii\db\Exception
     */
    public function getUsersByRole($role)
    {
        $query = new Query;
        $query->select('auth_assignment.user_id')
              ->from('auth_assignment')
              ->where(['item_name' => $role]);

        $command = $query->createCommand();
        $result = $command->queryAll();
        if ($result) {
            foreach ($result as $item) {
                $finalResult[] = $item['user_id'];
            }
        }
        return $finalResult;
    }
}
