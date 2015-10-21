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
    <meta name="robots" content="ALL" />
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-68540870-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script type="text/x-mathjax-config">
        MathJax.Hub.Config({tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}});
    </script>
    <script type="text/javascript"
        src="/js/MathJax.js?config=TeX-AMS-MML_HTMLorMML">
    </script>
<?php $this->beginBody() ?>
    <div class="wrap">
        <div class="row ">
            <div class="col-lg-2 menutrai">
                
                <?php  
                $items = [
                            ['label' => 'Giải hệ phương trình', 'url' => ['/matran/index']],
                            ['label' => 'Lũy thừa ma trận', 'url' => ['/matran/matran']],
                            ['label' => 'Nhân hai ma trận', 'url' => ['/matran/nhanhaimatran']],
                            ['label' => 'Ma trận nghịch đảo', 'url' => ['/matran/matrannghichdao']],
                        ];
                
                echo Nav::widget([
                    'options' => ['class' => ' nav nav-pills nav-stacked '],
                    'items' => $items,
                ]);?>
            </div>
             
            <div class="col-lg-8 noidung" >
                 <?= $content ?>
            </div>
            
            <div class="col-lg-2 menuphai">
                <?php  
                $items = [
                            ['label' => 'Giải phương trình', 'url' => ['/dathuc/index']],
                            ['label' => 'Lũy thừa đa thức', 'url' => ['/dathuc/luythuadathuc']],
                            ['label' => 'Nhân hai đa thức', 'url' => ['/dathuc/nhanhaidathuc']],
                            ['label' => 'Chia đa thức', 'url' => ['/dathuc/chiadachodathuc']],
                        ];
                
                echo Nav::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked '],
                    'items' => $items,
                ]);?>
            </div>
        </div>
        <div class="row huongdan-head">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 huongdan">
                <?php 
                    echo$this->render('//site/vidu',[
                        ]);
                ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
        <div class="row huongdan-head">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 huongdan">
                <?php 
                    echo$this->render('//site/huongdan',[
                        ]);
                ?>
            </div>
            <div class="col-lg-2"></div>
        </div>
       
    </div>
    <footer class="footer">
         <?php
           NavBar::begin([
                'brandLabel' => "<img class='img-circle img-responsive logo' height='100' width='100' src='" . Yii::$app->request->baseUrl . "/img/logo"  . ".png' alt='Image Missing'>",
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'breadcrumb navbar-fixed-bottom',
                ],
            ]);
            
            $items = [
                  //  ['label' => Yii::t('app','About'), 'url' => ['/site/about']],
                    ['label' => 'Góp ý', 'url' => ['/site/contact']],
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
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
