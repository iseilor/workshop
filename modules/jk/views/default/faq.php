<?php

$this->title = "Частые вопросы";
$this->params['breadcrumbs'][] = ['label' => 'Жилищная политика', 'url' => ['/jk/']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-question"></i> <?= $this->title; ?></h3>
            </div>
            <div class="card-body">
                <div id="accordion">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#e1"
                                   class="collapsed" aria-expanded="false">
                                    На каких основаниях мне дадут разрешение на улучшение жилищных
                                    условий?
                                </a>
                            </h4>
                        </div>
                        <div id="e1" class="panel-collapse in collapse" style="">
                            <div class="card-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id
                                    est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id
                                    est laborum.
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                    enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                    nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                    nulla pariatur. Excepteur sint occaecat
                                    cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id
                                    est laborum.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4 class="card-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#e2"
                                   class="collapsed" aria-expanded="false">
                                    Есть ли ограничения по стажу?
                                </a>
                            </h4>
                        </div>
                        <div id="e2" class="panel-collapse in collapse" style="">
                            <div class="card-body">
                                <p>Есть ли ограничения по стажу?</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>