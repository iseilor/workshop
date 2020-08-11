<?php

use yii\helpers\Html;

?>
<div class="card card-primary">
    <div class="card-header">
        <h4 class="card-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#faq-<?= $model->id ?>"
               class="collapsed" aria-expanded="false">
                <i class='fas fa-question'></i> <?= Html::encode($model->question) ?>
            </a>
        </h4>
    </div>
    <div id="faq-<?= $model->id ?>" class="panel-collapse collapse">
        <div class="card-body">

            <p><strong>Условия при одновременном соблюдении которых работники имеют право участвовать в Программе:</strong>
            </p>

            <p><strong>1. Работник Общества</strong></p>
            <p>В Программе может участвовать работники, для которых работа в Обществе является основным местом работы.
            </p>


            <p><a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Может ли принимать участие в жилищной программе работник, находящийся в декретном отпуске? </a>
                </a></p>

            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    В Программе может принимать участие работник, находящийся в декретном отпуске. При подаче заявления на комиссию необходимо учитывать, что при отсутствии достаточности средств
                    получаемых
                    от Общества, на работника ложится обязанность в самостоятельном перечислении ежемесячных сумм возврата займа, контроль соблюдения своевременного поступления на р/с средств, оплата
                    комиссии банку (при наличии).
                </div>
            </div>


                <p><a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                    Может ли принимать участие в жилищной программе работник, принятый на работу по срочному трудовому договору?
                </a></p>

            <div class="collapse" id="collapseExample2">
                <div class="card card-body">
                    В связи с тем, что Программа предуссматривает долгосрочный период оказания материальной помощи (до 10 лет), поэтому работники оформленные по срочному Трудовому договору
                    не могут
                    участвовать в Программе.
                </div>
            </div>


            <p><a data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                    Может ли принять участи в жилищной программе работник ДЗО?
                </a></p>

            <div class="collapse" id="collapseExample3">
                <div class="card card-body">
                    Программа не распространяется на работников ДЗО и сотрудников, для которых работа в Обществе не является основным местом работы
                </div>
            </div>






            <p><strong>2. Возраст работника</strong>
            </p>
            <p>На 01 января года подачи заявления возраст работника составляет не менее 21 года и не более пенсионного возраста.
            </p>

            <p><a data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                    Может ли принять участие в жилищной политике работник, которому до пенсии осталось 3 года?
                </a></p>
            <div class="collapse" id="collapseExample4">
                <div class="card card-body">
                    Да, может. Работник, которому осталось 3 года до пенсии может участвовать в Программе до наступления пенсионного возраста, таким образом максимальный срок оказания материальной помощи
                    будет ограничен датой наступления пенсионного возраста (не более 3х лет)
                </div>
            </div>



            <p><strong>3. Стаж</strong>
            </p>
            <p>Стаж работы в Обществе на 01 января должен быть не менее одного года.
            </p>


        </div>
    </div>
</div>

