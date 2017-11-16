<?php

namespace app\models;

use Yii;

class Author extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'Authors';
    }        
}
