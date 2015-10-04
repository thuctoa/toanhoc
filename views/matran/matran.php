<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Lũy thừa ma trận';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/matran/matran" method="post">
        Số bậc, cấp của ma trận: <input type="text" class="matran" name="sobac" value="<?=$sobac?>">
        <button type="submit" class="btn btn-success">Ma trận mới</button><br><br><br>
</form>
 <?php 
if($sobac>0){

    ?>
<form action="/matran/index" method="post">
    <table class="hephuongtrinh">
<?php
    for($i=0;$i<$sobac;$i++){
?>
    <tr>
        <?php
            for($j=0;$j<$sobac-1;$j++){
        ?>
                <td>
                    <input type="text" id="<?='a'.$i.$j?>" onchange="bieuthuc('<?='a'.$i.$j?>')" value="<?=$a[$i][$j]?>" class="matran" placeholder="a[<?php echo $i;?>][<?php echo $j;?>]" name="a[<?php echo $i;?>][<?php echo $j;?>]"> 
                    <b>
                    x<sub><?=$j?></sub> +
                    </b>
                </td>
        <?php
                }
        ?>

        <td>
            <input type="text" id="<?='a'.$i.$j?>" onchange="bieuthuc('<?='a'.$i.$j?>')"value="<?=$a[$i][$j]?>" class="matran" placeholder="a[<?php echo $i;?>][<?php echo $j;?>]" name="a[<?php echo $i;?>][<?php echo $j;?>]">
            <b>x<sub><?=$j?></sub></b>
        </td>

        <td>
            <b>
                =  
            </b>
           <input type="text" id="<?='b'.$i?>" onchange="bieuthuc('<?='b'.$i?>')" value="<?=$b[$i]?>" class="matran" placeholder="b[<?php echo $i;?>]" name="b[<?php echo $i;?>]"> 
        </td>  
        <?php
        if($conghiem==1){
        ?>

        <td class="nghiemthanhphan">
            <b> x<sub><?=$i?></sub> = </b><input type="text" value="<?=  $x[$i]?>" class="nghiem" placeholder="x[<?php echo $i;?>]" name="x[<?php echo $i;?>]">
            </td>
        <?php
        }
        ?>
   </tr>
 <?php
    }
?>
    </table>
    <input type="hidden" name="soan" class="text-warning"  value="<?=$sobac?>">
    <div class="row giaihe">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-success ">Giải hệ</button>
        </div>
        <div class="col-lg-8 mketqua">
            <?php
                if($conghiem==1){
                    echo '<h5 class="text-default ketqua"><b>Hệ phương trình có một nghiệm duy nhất</b></h5>';
                }else if($conghiem==0){
                    echo '<h5 class="text-danger ketqua"><b>Hệ phương trình vô nghiệm</b></h5>';
                }else if($conghiem==2){
                    echo '<h5 class="text-warning ketqua"><b>Hệ phương trình có vô số nghiệm</b></h5>';
                }
            ?>
        </div>
    </div>


</form>     
<?php
}
?>
