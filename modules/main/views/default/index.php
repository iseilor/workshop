<?php

/* @var $this yii\web\View */

/* @var $list Array */
$this->title = Yii::$app->name;

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

?>
    <div class="row">
        <?php
        foreach ($list as $item) {
            echo $this->render(
                'index_item',
                [
                    'item' => $item,
                ]
            );
        }
        ?>
    </div>
<?php


echo Url::base(true).Url::to('/user/1');

$this->registerJs(<<<JS
     // Таймер
     function time() {
		var date = new Date();
		var hou = date.getHours().toString();
		var min = date.getMinutes().toString();
		var sec = date.getSeconds().toString();
		hou = (hou<10)?0+hou:hou;
		min = (min<10)?0+min:min;
		sec = (sec<10)?0+sec:sec;
		$('.clock .hou').html(hou);
		$('.clock .min').html(min);
		$('.clock .sec').html(sec);
		setTimeout(time,1000);
	}
	time();
	
	// Курсы валют
	function curs(){
        if ($('.curs-1').is(":visible")){
            $(".curs-1").fadeOut(500,"linear");
            $(".curs-2").fadeIn(800,"linear");
        }else if ($('.curs-2').is(":visible")){
            $(".curs-2").fadeOut(500,"linear");
            $(".curs-3").fadeIn(800,"linear");
        }else if ($('.curs-3').is(":visible")){
            $(".curs-3").fadeOut(500,"linear");
            $(".curs-1").fadeIn(800,"linear");
        }
        setTimeout(curs,10000);
	}
    curs();
JS
);