<?php

/* @var $this yii\web\View */

/* @var $list Array */
/* @var $news \app\modules\news\models\News */

$this->title = Yii::$app->name;
use yii\helpers\Url;
?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <!--Пути сделаны так специально, т.к. Сергей смотрит через подсеть 192-->
                        <div class="carousel-inner">
                            <div class="carousel-item active" data-interval="10000">
                                <img class="d-block w-100" src="<?=Yii::$app->homeUrl?>img/main/slider/1.png">
                            </div>
                            <div class="carousel-item" data-interval="10000">
                                <img class="d-block w-100" src="<?=Yii::$app->homeUrl?>img/main/slider/2.png">
                            </div>
                            <div class="carousel-item" data-interval="10000">
                                <a href="<?=Url::to(['/jk/default/calc'],true);?>" title="Перейти в калькулятор Жилищной Программы"
                                   style="position: absolute; left: 47.8%; top: 74.6%; width: 9.6%; height: 9.68%; z-index: 100;"></a>
                                <img class="d-block w-100" src="<?=Yii::$app->homeUrl;?>img/main/slider/3.svg" usemap="#map">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php
        foreach ($news as $item) {
            echo $this->render(
                'news_item',
                [
                    'item' => $item,
                ]
            );
        }
        ?>
    </div>

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