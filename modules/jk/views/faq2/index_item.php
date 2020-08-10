<?php

use yii\helpers\Html;

?>
<div class="card card-primary">
    <div class="card-header">
        <h4 class="card-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#faq-<?=$model->id?>"
               class="collapsed" aria-expanded="false">
                <i class='fas fa-question'></i> <?= Html::encode($model->question) ?>
            </a>
        </h4>
    </div>
    <div id="faq-<?=$model->id?>" class="panel-collapse collapse">
        <div class="card-body">
            <?= $model->answer ?>
            <div class="row">
                <div class="col-5 col-sm-3">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="tab-1-tab" data-toggle="pill" href="#tab-1" role="tab" aria-controls="tab-1" aria-selected="true">
                            При каких условиях я могу участвовать в заявочной компании?
                        </a>
                        <a class="nav-link" id="tab-2-tab" data-toggle="pill" href="#tab-2" role="tab" aria-controls="tab-2" aria-selected="false">
                            Может ли принимать участие в жилищной программе работник, находящийся в декретном отпуске?
                        </a>
                        <a class="nav-link" id="tab-3-tab" data-toggle="pill" href="#tab-3" role="tab" aria-controls="tab-3" aria-selected="false">
                            Может ли принимать участие в жилищной программе работник, принятый на работу по срочному трудовому договору?
                        </a>
                        <a class="nav-link" id="tab-4-tab" data-toggle="pill" href="#tab-4" role="tab" aria-controls="tab-4" aria-selected="false">
                            Может ли принять участи в жилищной программе работник ДЗО?
                        </a>
                        <a class="nav-link" id="tab-5-tab" data-toggle="pill" href="#tab-5" role="tab" aria-controls="tab-5" aria-selected="false">
                            ...
                        </a>

                        <a class="nav-link" id="tab-6-tab" data-toggle="pill" href="#tab-6" role="tab" aria-controls="tab-6" aria-selected="false">
                            Может ли принимать участие в жилищной программе работник, находящийся в декретном отпуске?
                        </a>
                        <a class="nav-link" id="tab-7-tab" data-toggle="pill" href="#tab-7" role="tab" aria-controls="tab-7" aria-selected="false">
                            Может ли принимать участие в жилищной программе работник, принятый на работу по срочному трудовому договору?
                        </a>
                        <a class="nav-link" id="tab-8-tab" data-toggle="pill" href="#tab-8" role="tab" aria-controls="tab-8" aria-selected="false">
                            Может ли принять участи в жилищной программе работник ДЗО?
                        </a>
                        <a class="nav-link" id="tab-9-tab" data-toggle="pill" href="#tab-9" role="tab" aria-controls="tab-9" aria-selected="false">
                            ...
                        </a>
                        <a class="nav-link" id="tab-10-tab" data-toggle="pill" href="#tab-10" role="tab" aria-controls="tab-10" aria-selected="false">
                            ...
                        </a>
                        <a class="nav-link" id="tab-11-tab" data-toggle="pill" href="#tab-11" role="tab" aria-controls="tab-11" aria-selected="false">
                            Может ли принимать участие в жилищной программе работник, принятый на работу по срочному трудовому договору?
                        </a>
                        <a class="nav-link" id="tab-12-tab" data-toggle="pill" href="#tab-12" role="tab" aria-controls="tab-12" aria-selected="false">
                            Может ли принять участи в жилищной программе работник ДЗО?
                        </a>
                        <a class="nav-link" id="tab-13-tab" data-toggle="pill" href="#tab-13" role="tab" aria-controls="tab-13" aria-selected="false">
                            ...
                        </a>


                    </div>
                </div>
                <div class="col-7 col-sm-9">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade  active show" id="tab-1" role="tabpanel" aria-labelledby="tab-1-tab">
                            <strong>Условия при одновременном соблюдении которых работники имеют право участвовать в Программе:</strong><br>
                            <strong>1. Работник Общества</strong><br/>
                            В Программе может участвовать работники, для которых работа в Обществе является основным местом работы.
                        </div>
                        <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2-tab">
                            В Программе может принимать участие работник, находящийся в декретном отпуске.
                            При подаче заявления на комиссию необходимо учитывать, что при отсутствии достаточности
                            средств получаемых от Общества, на работника ложится обязанность в самостоятельном
                            перечислении ежемесячных сумм возврата займа, контроль соблюдения
                            своевременного поступления на р/с средств, оплата комиссии банку (при наличии).
                        </div>
                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3-tab">
                            В связи с тем, что Программа предуссматривает долгосрочный период оказания материальной помощи
                            (до 10 лет), поэтому работники оформленные по срочному Трудовому договору не могут участвовать в Программе.
                        </div>
                        <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="tab-4-tab">
                            Программа не распространяется на работников ДЗО и сотрудников, для которых работа в Обществе не является основным местом работы
                        </div>
                        <div class="tab-pane fade" id="tab-5" role="tabpanel" aria-labelledby="tab-5-tab">
                            <strong> 2. Возраст работника</strong><br>
                            На 01 января года подачи заявления возраст работника составляет не менее 21 года и не более пенсионного возраста.
                        </div>

                        <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="tab-6-tab">
                            <strong> 2. Возраст работника</strong><br>
                            В Программе может принимать участие работник, находящийся в декретном отпуске.
                            При подаче заявления на комиссию необходимо учитывать, что при отсутствии достаточности
                            средств получаемых от Общества, на работника ложится обязанность в самостоятельном
                            перечислении ежемесячных сумм возврата займа, контроль соблюдения
                            своевременного поступления на р/с средств, оплата комиссии банку (при наличии).
                        </div>
                        <div class="tab-pane fade" id="tab-7" role="tabpanel" aria-labelledby="tab-7-tab">
                            <strong> 2. Возраст работника</strong><br>
                            На 01 января года подачи заявления возраст работника составляет не менее 21 года и не более пенсионного возраста.
                        </div>
                        <div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="tab-8-tab">
                            <strong> 2. Возраст работника</strong><br>
                            В Программе может принимать участие работник, находящийся в декретном отпуске.
                            При подаче заявления на комиссию необходимо учитывать, что при отсутствии достаточности
                            средств получаемых от Общества, на работника ложится обязанность в самостоятельном
                            перечислении ежемесячных сумм возврата займа, контроль соблюдения
                            своевременного поступления на р/с средств, оплата комиссии банку (при наличии).
                        </div>
                        <div class="tab-pane fade" id="tab-9" role="tabpanel" aria-labelledby="tab-9-tab">
                            <strong> 2. Возраст работника</strong><br>
                            На 01 января года подачи заявления возраст работника составляет не менее 21 года и не более пенсионного возраста.
                        </div>
                        <div class="tab-pane fade" id="tab-10" role="tabpanel" aria-labelledby="tab-10-tab">
                            <strong> 2. Возраст работника</strong><br>
                            В Программе может принимать участие работник, находящийся в декретном отпуске.
                            При подаче заявления на комиссию необходимо учитывать, что при отсутствии достаточности
                            средств получаемых от Общества, на работника ложится обязанность в самостоятельном
                            перечислении ежемесячных сумм возврата займа, контроль соблюдения
                            своевременного поступления на р/с средств, оплата комиссии банку (при наличии).
                        </div>

                        <div class="tab-pane fade" id="tab-11" role="tabpanel" aria-labelledby="tab-11-tab">
                            В связи с тем, что Программа предуссматривает долгосрочный период оказания материальной помощи
                            (до 10 лет), поэтому работники оформленные по срочному Трудовому договору не могут участвовать в Программе.
                        </div>
                        <div class="tab-pane fade" id="tab-12" role="tabpanel" aria-labelledby="tab-12-tab">
                            Программа не распространяется на работников ДЗО и сотрудников, для которых работа в Обществе не является основным местом работы
                        </div>
                        <div class="tab-pane fade" id="tab-13" role="tabpanel" aria-labelledby="tab-13-tab">
                            <strong> 2. Возраст работника</strong><br>
                            На 01 января года подачи заявления возраст работника составляет не менее 21 года и не более пенсионного возраста.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>