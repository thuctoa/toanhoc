<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Ứng dụng toán';
?>
<h1 class="text-center">Đề tài 6 - Nhóm 3</h1>
<div class="cachtren"></div>
<form action="/matran/markov" method="post">
    <div class="row">
        <div class="col-lg-9">
            Số bậc, cấp của ma trận P là 
            <input type="text" class="so_n" 
                   placeholder="n =..."
                   id ="sobac" class="matran" name="sobac" value="<?=$sobac?>">
             <input type="hidden" name="khoitao" class="text-warning"  value="1">
        </div>
        <div class="col-lg-3 pheptinhmoi">
            <button type="submit" class="btn btn-danger">Ma trận chuyển mới</button>
        </div>
    </div>
</form>
 <?php 
if($sobac>0){

    ?>
    <form action="/matran/markov" method="post">
        <table class="hephuongtrinh ">
            <tr>
                <th colspan="<?=$sobac+1?>" class="text-center">Ma trận phân phối xác suất chuyển P</th>

            </tr>
    <?php
        for($i=0;$i<$sobac;$i++){
    ?>
        <tr>
            <?php
                for($j=0;$j<$sobac;$j++){
            ?>
                    <td>
                        <input  type="text" 
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
        <input type="hidden" name="kiemtrapp" class="text-warning"  value="1">
        <input type="hidden" name="dakiemtrapp" class="text-warning"  value="1">
        <div class="row giaihe cachtren" style="margin-bottom: 20px;">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-warning ">Kiểm tra P</button>
            </div>
            <div class="col-lg-8 text-center">
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
                else if($markovduoc==7){
                    echo '<h5 class="text-danger ketqua"><b>Không có phân phối giới hạn của ma trận,'
                     . ' mặc dù P là tối giản nhưng tuần hoàn </b></h5>';
                }
                else if($markovduoc==8){
                    echo '<h5 class="text-success ketqua"><b>Ma trận là tối giản, và phi tuần hoàn nên có phân phối giới hạn</b></h5>';
                }
                else if($markovduoc==9){
                    echo '<h5 class="text-danger ketqua"><b>Không có phân phối giới hạn của ma trận,'
                     . ' vì P là không tối giản</b></h5>';
                }
                ?>
            </div>
        </div>
</form> 
<?php
    if($dakiemtrapp==1){
?>
<form action="/matran/markov" method="post">
    <input type="hidden" name="dakiemtrapp" class="text-warning"  value="1">
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
    <div class="col-lg-3 text-center">
        Số bước n = <input type="text" name="somu" class="matran so_n"  value="<?=$somu?>">
    </div>
    <div class="col-lg-2 text-center">
        <button type="submit" class="btn btn-success ">Tính $P^{(n)}$ </button>
    </div>
</form>
<form action="/matran/markov" method="post">
    <input type="hidden" name="dakiemtrapp" class="text-warning"  value="1">
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
    <div class="col-lg-2 text-center">
        <button type="submit" class="btn btn-success ">Phân phối dừng </button>
    </div>
</form>

<form action="/matran/markov" method="post">
    <input type="hidden" name="dakiemtrapp" class="text-warning"  value="1">
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
        <button type="submit" class="btn btn-success ">Tính tối giản</button>
    </div>
</form>

<form action="/matran/markov" method="post">
    <input type="hidden" name="dakiemtrapp" class="text-warning"  value="1">
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
    
    <input type="hidden" name="phanphoigioihan" class="text-warning"  value="1">           
    <div class="col-lg-2 text-center">
        <button type="submit" class="btn btn-success ">Phân phối giới hạn</button>
    </div>
</form>
<?php
    }
     
}
?>
<br><br><br><br><br>
<?php
    if($markovduoc==1){
?>
    $$
    \text{P sau <?=$somu?> bước là }\\
    \begin{bmatrix}
    <?php
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac-1;$j++){
    ?>  
                <?=round($p[$i][$j],5)?>&
    <?php
            }
            echo round($p[$i][$j],5).'\\\\';
        }
    ?>
    
    \end{bmatrix}^\mathrm{<?=$somu?>}
    =
    \begin{bmatrix}
    <?php
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac-1;$j++){
    ?>  
                <?=round($p_luythua[$i][$j],5)?>&
    <?php
            }
            echo round($p_luythua[$i][$j],5).'\\\\';
        }
    ?>
    \end{bmatrix}
    $$
<?php
    }
    if($markovduoc==3){
?>
    $$
    \text{Phân phối dừng của xích là}
    \\
    \begin{cases}
        <?php
            for($i=0;$i<$sobac;$i++){
        ?>
            π_{<?=$i?>} = & <?=round($phanphoidung[$i],5)?> \\
        <?php
            }
        ?>
    \end{cases}
    $$
<?php
    }
    if($markovduoc==8){
?>
    $$
    \text{Ma trận giới hạn là }\\
    \begin{bmatrix}
    <?php
        for($i=0;$i<$sobac;$i++){
            for($j=0;$j<$sobac-1;$j++){
    ?>  
                <?= round( $phanphoidung[$j],5)?>&
    <?php
            }
            echo round( $phanphoidung[$j],5).'\\\\';
        }
    ?>
    \end{bmatrix}
    $$
<?php
    }
    if($dakiemtrapp==1&&$markovduoc!=2){
       echo $this->render('/matran/bieudo',[
           'p'=>$p,
           'sobac'=>$sobac
       ]);
   }
?>



