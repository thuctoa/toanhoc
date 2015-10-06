<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Nhập vào ma trận xac suất chuyển';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/matran/markov" method="post">
        Số bậc, cấp của ma trận P là <input type="text" class="matran" name="sobac" value="<?=$sobac?>">
         <input type="hidden" name="khoitao" class="text-warning"  value="1">
        <button type="submit" class="btn btn-success">Ma trận mới</button><br><br><br>
</form>
 <?php 
if($sobac>0){

    ?>
<form action="/matran/markov" method="post">
    <table class="hephuongtrinh">
        <tr>
            <th colspan="<?=$sobac?>" class="text-center">Ma trận phân phối xác suất chuyển P</th>
            <?php
            if($markovduoc==1){
            ?>
                <th colspan="<?=$sobac?>" class="text-center" >Ma trận P sau <?=$somu?> bước</th>
            <?php
                }
            ?>
            <?php
            if($markovduoc==3){
            ?>
                <th colspan="<?=$sobac?>" class="text-center" >Phân phối dừng của xích là</th>
            <?php
                }
            ?>
            <?php
            if($markovduoc==7){
            ?>
                <th colspan="<?=$sobac?>" class="text-center" >Ma trận phân phối giới hạn</th>
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
                if($markovduoc==1||$markovduoc==7){
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
                if($markovduoc==3){
        ?>
                    <td style=" border-left: 1px solid black; ">
                        <b style="margin-left: 50px;">π<sup></sup><sub><?=$i?></sub></b> 
                        = <input type="text" id="<?='phanphoidung'.$i?>"
                                 onchange="bieuthuc('<?='phanphoidung'.$i?>')" 
                                 value="<?=$phanphoidung[$i]?>" class="matran ketqua_matran xem_ketquamatran " 
                                 placeholder="phanphoidung[<?php echo $i;?>]"
                                 name="phanphoidung[<?php echo $i;?>]"> 
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
    <input type="hidden" name="kiemtrapp" class="text-warning"  value="1">
    <div class="row giaihe">
        <div class="col-lg-3 text-center">
            <button type="submit" class="btn btn-success ">Kiểm tra P có là ma trận xác suất chuyển</button>
        </div>
        <div class="col-lg-6 text-center">
            <?php 
            if($markovduoc==2){
                echo '<h5 class="text-danger ketqua"><b>Ma trận vừa nhập không phải là một ma trận phân phối xác suất chuyển</b></h5>';
            }else if($markovduoc==-1){
                echo '<h5 class="text-success ketqua"><b>Ma trận vừa nhập là một ma trận phân phối xác suất chuyển</b></h5>';
            }else if($markovduoc==4){
                echo '<h5 class="text-success ketqua"><b>Xích có nhiều hơn một trạng thái hút, nên xích không có tính dừng</b></h5>';
            }
            else if($markovduoc==5){
                echo '<h5 class="text-danger ketqua"><b>Ma trận không có tính tối giản</b></h5>';
            }
            else if($markovduoc==6){
                echo '<h5 class="text-success ketqua"><b>Ma trận là tối giản </b></h5>';
            }
            ?>
        </div>
    </div>
</form> 

<form action="/matran/markov" method="post">
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>

            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
             
                        <input type="hidden" id="<?='p'.$i.$j?>" onchange="bieuthuc('<?='p'.$i.$j?>')" value="<?=$p[$i][$j]?>" class="matran" placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                  
            <?php
                }
            ?>
 

     <?php
        }
    ?>
    <div class="col-lg-2 text-center">
        Số bước n = <input type="text" name="somu" class="matran"  value="<?=$somu?>">
    </div>
    <div class="col-lg-3 text-center">
        <button type="submit" class="btn btn-success ">Tính P sau n bước </button>
    </div>
</form>
<form action="/matran/markov" method="post">
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>

            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
             
                        <input type="hidden" id="<?='p'.$i.$j?>" onchange="bieuthuc('<?='p'.$i.$j?>')" value="<?=$p[$i][$j]?>" class="matran" placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                  
            <?php
                }
            ?>

     <?php
        }
    ?>
    <input type="hidden" name="phanphoidung" class="text-warning"  value="1">           
    <div class="col-lg-3 text-center">
        <button type="submit" class="btn btn-success ">Tìm phân phối dừng của xích </button>
    </div>
</form>
<form action="/matran/markov" method="post">
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>

            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
             
                        <input type="hidden" id="<?='p'.$i.$j?>" onchange="bieuthuc('<?='p'.$i.$j?>')" value="<?=$p[$i][$j]?>" class="matran" placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                  
            <?php
                }
            ?>

     <?php
        }
    ?>
    <input type="hidden" name="tinhtoigian" class="text-warning"  value="1">           
    <div class="col-lg-2 text-center">
        <button type="submit" class="btn btn-success ">Tính tối giản của ma trận</button>
    </div>
</form>
<form action="/matran/markov" method="post">
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>

            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
             
                        <input type="hidden" id="<?='p'.$i.$j?>" onchange="bieuthuc('<?='p'.$i.$j?>')" value="<?=$p[$i][$j]?>" class="matran" placeholder="p[<?php echo $i;?>][<?php echo $j;?>]" name="p[<?php echo $i;?>][<?php echo $j;?>]"> 
                  
            <?php
                }
            ?>

     <?php
        }
    ?>
    <input type="hidden" name="phanphoigioihan" class="text-warning"  value="1">           
    <div class="col-lg-2 text-center">
        <button type="submit" class="btn btn-success ">Tìm phân phối giới hạn</button>
    </div>
</form>
<?php
}
?>



