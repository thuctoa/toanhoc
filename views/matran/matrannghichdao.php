<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Ứng dụng toán';
?>
<h1 class="tieude">
     Ma Trận Nghịch Đảo - Online
</h1>
<div class="cachtren"></div>
<form action="/matran/matrannghichdao" method="post">
    <div class="row">
        <div class="col-lg-9">
            Số bậc, cấp của ma trận P là 
            <input type="text" id ="sobac" class="so_n" placeholder="n =..." name="sobac" value="<?=$sobac?>">
        </div>
        <div class="col-lg-3 pheptinhmoi">
            <button type="submit" class="btn btn-danger">Ma trận mới</button>
        </div>
    </div>
</form>
 <?php 
if($sobac>0){

    ?>
<form action="/matran/matrannghichdao" method="post">
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
                           onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                           id="<?='p'.$i.$j?>" 
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
    
    <div class="row giaihe cachtren">
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-danger ">Thực hiện tính</button>
        </div>
        <div class="col-lg-2 text-center">
             <input type="hidden" name="somu" class="matran"  value="-1">
        </div>
        <div class="col-lg-4 text-center">
            <?php if($luythuaduoc==0){
                echo '<h5 class="text-danger ketqua"><b>Không thực hiện được phép nghịch đảo vì ma trận là không khả nghịch</b></h5>';
            }
?>
        </div>
    </div>
</form>     
<?php
}
?>
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

