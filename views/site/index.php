<?php
use yii\helpers\Url;
/* @var $this yii\web\View */
$this->title = Yii::t('app','Application');
?>
<a href="#">
<div class="site-index">
    <div class="row">
    <?php $i=2;?>
        <div class="col-lg-12 banner">
            <div id="myCarousel<?=$i?>" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <li data-target="#myCarousel<?=$i?>" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel<?=$i?>" data-slide-to="1"></li>
                  <li data-target="#myCarousel<?=$i?>" data-slide-to="2"></li>
                  <li data-target="#myCarousel<?=$i?>" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <div class="item active">
                      <img src="../../img/anh1<?=$i?>.jpg" alt="Chania" class="img-banner" >
                  </div>

                  <div class="item">
                    <img src="../../img/anh2<?=$i?>.jpg" alt="Chania" class="img-banner">
                  </div>

                  <div class="item">
                    <img src="../../img/anh3<?=$i?>.jpg" alt="Flower" class="img-banner">
                  </div>

                  <div class="item">
                    <img src="../../img/anh4<?=$i?>.jpg" alt="Flower" class="img-banner">
                  </div>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel<?=$i?>" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel<?=$i?>" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
    
</a>
<div class="body-content">
    <div class="row product_idex">
        <div class="col-lg-4">
            <h2 class=" text-success"><?= Yii::t('app','Heading') ?></h2>
            <a href="#">
                <img src="../../img/anh12.jpg" alt="..." class="img-rounded">
            </a>
            <p><a class="btn btn-default" href="#"><?= Yii::t('app','View more') ?> &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2 class=" text-success"><?= Yii::t('app','Heading') ?></h2>
            <a href="#">
                <img src="../../img/anh22.jpg" alt="..." class="img-rounded">
            </a>
            <p><a class="btn btn-default" href="#"><?= Yii::t('app','View more') ?> &raquo;</a></p>
        </div>
        <div class="col-lg-4">
             <h2 class="text-success"><?= Yii::t('app','Heading') ?></h2>
             <a href="#">
                <img src="../../img/anh32.jpg" alt="..." class="img-rounded">
             </a>
            <p><a class="btn btn-default" href="#"><?= Yii::t('app','View more') ?> &raquo;</a></p>
        </div>
    </div>

</div>
