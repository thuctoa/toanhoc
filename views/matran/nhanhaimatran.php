<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Nhân hai ma trận';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/matran/nhanhaimatran" method="post">
        Số hàng của ma trận A là <input type="text" placeholder="Số hàng của A ..." name="ma" value="<?=$ma?>">
        Số cột <input type="text"value="<?=$na?>" placeholder="Số cột của A ..." id="na" name="na" onchange="dongcuamatranb();" ><br>
        Số hàng của ma trận B là <input type="text" value="<?=$mb?>" id="mb" onchange="dongcuamatrana();" placeholder="Số hàng của B ..." name="mb" >
        Số cột <input type="text" placeholder="Số cột của B ..." name="nb"  value="<?=$nb?>"><br>
        <button type="submit" class="btn btn-success">Nhân hai ma trận mới</button><br><br><br>
</form>

 <?php 
if($na>0&&$ma>0&&$mb>0&&$nb>0){

    ?>
<form action="/matran/nhanhaimatran" method="post">
    <div class="row">
        <div class="col-lg-6">
            <table>
                <tr>
                    <th colspan="<?=$na?>" class="text-center">Ma trận A</th>
                </tr>
                <?php

                    for($i=0;$i<$ma;$i++){
                ?>
                    <tr>
                        <?php
                            for($j=0;$j<$na;$j++){
                        ?>
                                <td>
                                    <input type="text" id="<?='a'.$i.$j?>" onchange="bieuthuc('<?='a'.$i.$j?>')" value="<?=$a[$i][$j]?>" class="matran" placeholder="a[<?php echo $i;?>][<?php echo $j;?>]" name="a[<?php echo $i;?>][<?php echo $j;?>]"> 
                                </td>
                        <?php
                                }

                        ?>


                   </tr>

                <?php
                   }
               ?>
            </table>
        </div>
        <div class="col-lg-6">
            <table>
                <tr >
                    <th colspan="<?=$nb?>" class="text-center">Ma trận B</th>
                </tr>
                <?php
                    for($i=0;$i<$mb;$i++){
                ?>
                    <tr>
                        <?php
                            for($j=0;$j<$nb;$j++){
                        ?>
                                <td>
                                    <input type="text" id="<?='b'.$i.$j?>" onchange="bieuthuc('<?='b'.$i.$j?>')" value="<?=$b[$i][$j]?>" class="matran" placeholder="b[<?php echo $i;?>][<?php echo $j;?>]" name="b[<?php echo $i;?>][<?php echo $j;?>]"> 
                                </td>
                        <?php
                                }

                        ?>


                   </tr>

                <?php
                   }
                ?>
            </table>
        </div>
    </div>
    <table>
        <?php
            if($nhanthanhcong==1){
        ?>
            <tr >
                <th colspan="<?=$na?>" class="text-center cachtren50">Kết quả A*B là </th>
            </tr>
        <?php

            for($i=0;$i<$ma;$i++){
        ?>
            <tr>
                <?php
                    for($j=0;$j<$nb;$j++){
                ?>
                        <td>
                            <input type="text" id="<?='ab'.$i.$j?>" onchange="bieuthuc('<?='ab'.$i.$j?>')" value="<?=$ab[$i][$j]?>" class="matran xem_ketquamatran" placeholder="ab[<?php echo $i;?>][<?php echo $j;?>]" name="ab[<?php echo $i;?>][<?php echo $j;?>]"> 
                        </td>
                <?php
                        }

                ?>


           </tr>

        <?php
            }
        }
    ?>
    </table>
    <input type="hidden" name="ma" class="text-warning"  value="<?=$ma?>">
    <input type="hidden" name="na" class="text-warning"  value="<?=$na?>">
    <input type="hidden" name="mb" class="text-warning"  value="<?=$mb?>">
    <input type="hidden" name="nb" class="text-warning"  value="<?=$nb?>">
    <div class="row giaihe">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-success ">Thực hiện tính</button>
        </div>
    </div>
</form>     
<?php
}
?>
