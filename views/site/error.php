<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <!--<h1><?php// echo Html::encode($this->title); ?></h1>-->

<!--    <div class="alert alert-danger">
        <?php //echo nl2br(Html::encode($message)); ?>
    </div>-->
    <div class="alert alert-danger">
    <?php 
        if(strpos($name, '#403' )){
    ?>
     Chức năng này đang được xây dựng, bạn có góp ý gì hãy <a href="/site/contact"> liên lạc </a> với chúng tôi cảm ơn. 
    <?php
        }else if(strpos($name, '#2' )){
     ?>
        Không thể thực hiện phép chia cho 0 mời bạn thử lại.
    <?php      
        }else if(strpos($name, '#1' )){
     ?>
        Bạn đã nhập sai hệ số, mời nhập lại.
    <?php
        }else{
    ?>
        <p> Bạn hãy kiểm tra lại thao tác của mình vừa làm, đã có gì đó không đúng. </p>
    <?php
        }
       
    ?>
    </div>
</div>
