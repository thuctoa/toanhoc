<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title =Yii::t('app','About');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-sm-4">

            <!-- normal -->
            <div class="ih-item square effect4"><a href="#">
                <div class="img"><img src="../../img/anh22.jpg" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3><?=Yii::t('app','Heading here')?></h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end normal -->

        </div>
        <div class="col-sm-4">

            <!-- colored -->
            <div class="ih-item square colored effect4"><a href="#">
                <div class="img"><img src="../../img/anh12.jpg" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3><?=Yii::t('app','Heading here')?></h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end colored -->

        </div>
        <div class="col-sm-4">

            <!-- colored -->
            <div class="ih-item square colored effect4"><a href="#">
                <div class="img"><img src="../../img/anh32.jpg" alt="img"></div>
                <div class="mask1"></div>
                <div class="mask2"></div>
                <div class="info">
                  <h3><?=Yii::t('app','Heading here')?></h3>
                  <p><?=Yii::t('app','Description goes here')?></p>
                </div></a>
            </div>
            <!-- end colored -->

        </div>
    </div>
</div>
