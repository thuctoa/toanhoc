<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-68540870-1', 'auto');
        ga('send', 'pageview');

    </script>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
               // 'brandLabel' =>  '<img src= "/favicon.ico" style="width:170px; margin-left:-70px;margin-top:-10px;" class="img-responsive">',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $items = [
                //    ['label' => 'Bài 6', 'url' => ['/matran/markov']],
                    ['label' => 'Giải hệ phương trình tuyến tính', 'url' => ['/matran/index']],
                    ['label' => 'Lũy thừa ma trận', 'url' => ['/matran/matran']],
                    ['label' => 'Nhân hai ma trận', 'url' => ['/matran/nhanhaimatran']],
                    ['label' => 'Ma trận nghịch đảo', 'url' => ['/matran/matrannghichdao']],
                  //  ['label' => Yii::t('app','About'), 'url' => ['/site/about']],
                    ['label' => Yii::t('app','Contact'), 'url' => ['/site/contact']],
                   // ['label' => Yii::t('app','Books'), 'url' => ['/book/index']],
                   //  ['label' => Yii::t('app','Authors'), 'url' => ['/author/index']],
                    Yii::$app->user->isGuest ?
                        ['label' => Yii::t('app','Login'), 'url' => ['/site/login']] :
                        ['label' => Yii::t('app','Logout').' (' . Yii::$app->user->identity->username . ')',
                            'url' => ['/site/logout'],
                            'linkOptions' => ['data-method' => 'post']],
                ];
            if(Yii::$app->user->isGuest){
                $items[] = ['label' => Yii::t('app','Signup'), 'url' => ['/site/signup']];
            }
            if ( Yii::$app->user->can('permission_admin') )
                $items[] = ['label' => Yii::t('app','Permissions'), 'url' => ['/admin/assignment']];
            
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $items,
            ]);
            NavBar::end();
        ?>
        
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div  id="language-selector" class="pull-right" style="position: relative;">
            <?= \app\components\widgets\LanguageSelector::widget(); ?>
        </div>
        <div class="container">
            <p class="pull-left">&copy; <?=Yii::t('app','My Company')?> <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::ngongu() ?></p>
        </div>
         
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
