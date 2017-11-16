<?php
use yii\helpers\Html;
use app\models\Posts;

foreach ($posts as $post){
    echo '<li>';
    echo Html::encode("{$post->title} ({$post->date})");
    echo '<p>'.$post->content.'</p>';
    echo '</li>';
}

?>