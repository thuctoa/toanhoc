<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Lũy thừa ma trận';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/matran/matran" method="post">
        Số bậc, cấp của ma trận P là <input type="text" placeholder="Nhập một số ..." name="sobac" value="<?=$sobac?>">
        <button type="submit" class="btn btn-success">Ma trận mới</button><br><br><br>
</form>
 <?php 
if($sobac>0){

    ?>
<form action="/matran/matran" method="post">
    <table class="hephuongtrinh">
        <tr>
            <th colspan="<?=$sobac?>" class="text-center">Ma trận ban đầu</th>
        <?php
            if($luythuaduoc==1){
        ?>
            <th colspan="<?=$sobac?>" class="text-center" >Ma trận kết quả</th>
        <?php
            }
        ?>
        </tr>
<?php
    for($i=0;$i<$sobac;$i++){
?>
    <tr>
        <?php
            for($j=0;$j<$sobac;$j++){
        ?>
                <td>
                    <input type="text" id="<?='p'.$i.$j?>" onchange="bieuthuc('<?='p'.$i.$j?>')" value="<?=$p[$i][$j]?>" class="matran" placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                </td>
        <?php
                }
                if($luythuaduoc==1){
        ?>
                <td class="pluythua_ketqua">
                    <input  type="text" id="<?='p_luythua'.$i.'0'?>" onchange="bieuthuc('<?='p_luythua'.$i.'0'?>')" value="<?=$p_luythua[$i][0]?>" class="matran ketqua_matran xem_ketquamatran" placeholder="p_luythua[<?php echo $i;?>][<?php echo 0;?>]" name="p_luythua[<?php echo $i;?>][<?php echo 0;?>]"> 
                    </td>
        <?php
                     for($j=1;$j<$sobac;$j++){
        ?>
                    <td >
                        <input type="text" id="<?='p_luythua'.$i.$j?>" onchange="bieuthuc('<?='p_luythua'.$i.$j?>')" value="<?=$p_luythua[$i][$j]?>" class="matran xem_ketquamatran" placeholder="p_luythua[<?php echo $i;?>][<?php echo $j;?>]" name="p_luythua[<?php echo $i;?>][<?php echo $j;?>]"> 
                    </td>
        <?php
                    }

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
            <button type="submit" class="btn btn-success ">Thực hiện tính</button>
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
