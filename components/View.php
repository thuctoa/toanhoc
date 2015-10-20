<?php

    namespace app\components;

    use Yii;

    class View extends \yii\web\View
    {
        public $subTitle;

        public function helloWorld()
        {
            return 'Hello World';
        }
        public function mumuoi($bien){
            if(strpos($bien, 'E')){
                $bien= str_replace('E', '*10^{', $bien).'}';
            }
            return $bien;
        }
    }