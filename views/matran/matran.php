<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Lũy thừa ma trận';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div onload="giannonhap();">
    <form action="/matran/matran" method="post">
            Số bậc, cấp của ma trận P là <input id ="sobac" type="text" placeholder="Nhập một số ..." name="sobac" value="<?=$sobac?>">
            <button type="submit" class="btn btn-primary">Ma trận mới</button><br><br><br>
    </form>
     <?php 
    if($sobac>0){

        ?>
    <form action="/matran/matran" method="post">
        <table class="hephuongtrinh">
            <tr>
                <th colspan="<?=$sobac?>" class="text-center">Ma trận ban đầu</th>
            </tr>
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>
        <tr>
            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
                    <td>
                        <input type="text" 
                               id="<?='p'.$i.$j?>" 
                               onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                               onchange="bieuthuc('<?='p'.$i.$j?>')" 
                               value="<?=$p[$i][$j]?>" 
                               class="matran" 
                               placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" 
                               name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                    </td>
            <?php
                    }
            ?>
       </tr>

     <?php
        }
    ?>
        </table>
        <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">

        <div class="row giaihe">
            <div class="col-lg-2 text-center">
                <button type="submit" class="btn btn-primary " >Thực hiện tính</button>
            </div>
            <div class="col-lg-2 text-center">
                Số mũ = <input type="text" name="somu" class="matran"  value="<?=$somu?>">
            </div>
            <div class="col-lg-4 text-center">
                <?php if($luythuaduoc==0){
                    echo '<h5 class="text-danger ketqua"><b>Không thực hiện được phép lũy thừa vì ma trận không khả nghịch</b></h5>';
                }
    ?>
            </div>
        </div>
    </form>     
    <?php
    }
    ?>
</div>

<?php
     if($luythuaduoc==1){
?>
    $$
    \begin{bmatrix}
    <?php
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac-1;$j++){
    ?>  
                <?=$p[$i][$j]?>&
    <?php
            }
            echo $p[$i][$j].'\\\\';
        }
    ?>
    
    \end{bmatrix}^\mathrm{<?=$somu?>}
    =
    \begin{bmatrix}
    <?php
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac-1;$j++){
    ?>  
                <?=$p_luythua[$i][$j]?>&
    <?php
            }
            echo $p_luythua[$i][$j].'\\\\';
        }
    ?>
    \end{bmatrix}
    $$
<?php } ?>
