<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Tìm nghiệm của đa thức';
//$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title)?></h1>

 <form action="/dathuc/index" method="post">
            Số bậc đa thức P là <input id ="nghiemdathuc" type="text" placeholder="Nhập một số ..." name="sobac" value="<?=$sobac?>">
            <button type="submit" class="btn btn-success">Đa thức mới</button><br><br><br>
</form>
<?php 
if($sobac>0){
?>
<form action="/dathuc/index" method="post">
    $ P_{<?=$sobac?>}(x)=$
    <?php
        for($i=$sobac;$i>0;$i--){
    ?>  
            <input  class="dathuc"
                    id="<?='a'.$i?>" 
                    onchange="bieuthuc('<?='a'.$i?>')"
                    onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                    placeholder="a[<?php echo $i;?>]..."
                    value="<?=$a[$i]?>" 
                    name="a[<?php echo $i;?>]"
            >$x^{<?=$i?>}+$
    <?php
        }
    ?>
            <input class="dathuc"
                   id="<?='a'.$i?>"
                   onchange="bieuthuc('<?='a'.$i?>')"
                   onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                   placeholder="a[<?php echo $i;?>]..."
                   value="<?=$a[$i]?>" 
                   name="a[<?php echo $i;?>]"
                   
            >$x^{<?=$i?>} =0 $
            
        <?php
            if($conghiem==-10){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Hệ số $a_{'.$sobac.'}$ bắt buộc phải khác 0 mời nhập lại.'
                . '</b></h5>';
            }
        ?>   
            
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">

    <div class="row " style="margin-top: 30px;">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-success " >Tìm nghiệm</button>
        </div>
        <div class="col-lg-4 text-center">
            <?php if($conghiem==0){
                echo '<h5 class="text-danger ketqua"><b>Đa thức không có nghiệm thực</b></h5>';
            }
            ?>
        </div>
    </div>
</form>  
    <?= $this->render('dathuc', [
        'sobac' => $sobac,
        'a' => $a,
    ]) ?>
    <?= $this->render('dathuc', [
        'sobac' => $sobac-1,
        'a' => $a_daoham,
    ]) ?>
<?php
}
?>