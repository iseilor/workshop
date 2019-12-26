
    <div class="card bg-light">
        <div class="card-header text-muted border-bottom-0">
            <?=$model->status;?>
        </div>
        <div class="card-body pt-0">
            <div class="row">
                <div class="col-7">
                    <h2 class="lead"><b><?=$model->name;?></b></h2>
                    <p class="text-muted text-sm"><b><?=$model->position;?></b> / <?=$model->department;?></p>
                    <ul class="ml-4 mb-0 fa-ul text-muted">
                        <!--<li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Адрес: <?=$model->address;?></li>-->
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-envelope"></i></span> Email: <?=$model->email;?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Телефон: <?=$model->phone;?></li>
                    </ul>
                </div>
                <div class="col-5 text-center">
                    <img src="/img/main/team/<?=$model->photo?>" alt="<?=$model->full_name?>" class="img-circle img-fluid">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="text-right">
                <a href="#" class="btn btn-sm bg-teal">
                    <i class="fas fa-comments"></i>
                </a>
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fas fa-user"></i> Профиль
                </a>
            </div>
        </div>
    </div>
