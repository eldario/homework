<?php

namespace app\models;

use Yii;

class Post extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'Posts';
    }        
}
