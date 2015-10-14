<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Chia hai đa thức';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/dathuc/chiadachodathuc" method="post">
        Số bậc của đa thức bị chia $A(x)$ là <input type="text" id="n1" placeholder="Nhập vào một số ..." name="n1" value="<?=$n1?>">
       
        , Số bậc của đa thức chia $B(x)$ là<input type="text" value="<?=$n2?>" id="n2"
                                          placeholder="Nhập vào một số ..." name="n2" >
        <button type="submit" id="nhanhaidathuc"  class="btn btn-success">Nhân hai ma trận mới</button><br><br><br>
</form>
<?php 
    if($n1>0&&$n2>0){
?>
    <form action="/dathuc/chiadachodathuc" method="post">
    <div class="row">
        <div class="col-lg-12">
            <table>
                <tr>
                    <th colspan="<?=$n1+1?>" class="text-center">Đa thức $A(x)$ </th>
                </tr>
<?php
                for($i=$n1;$i>0;$i--){
?>  
                    <td>
                        <input type="text" id="<?='a'.$i?>"
                               onchange="bieuthuc('<?='a'.$i?>')" 
                               onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                               value="<?=$a[$i]?>" class="matran" 
                               placeholder="a[<?php echo $i;?>]" 
                               name="a[<?php echo $i;?>]"> $x^{<?=$i?>}+$
                    </td>
<?php
                }
?>
                    <td>
                        <input type="text" id="<?='a'.$i?>"
                               onchange="bieuthuc('<?='a'.$i?>')" 
                               onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                               value="<?=$a[$i]?>" class="matran" 
                               placeholder="a[<?php echo $i;?>]" 
                               name="a[<?php echo $i;?>]"> $x^{<?=$i?>}$
                    </td>
            </table>
<?php
            if($ladathuc==1||$ladathuc==2){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Hệ số $a_{'.$n1.'}$ bắt buộc phải khác 0 mời nhập lại.'
                . '</b></h5>';
            }
?>  
            </div>
            <div class="col-lg-12">
            <table style="margin-top: 30px;">
                <tr >
                    <th colspan="<?=$n2+1?>" class="text-center"  >Đa thức $B(x)$</th>
                </tr>
<?php
                    for($i=$n2;$i>0;$i--){
?>
                        <td>
                            <input type="text" id="<?='b'.$i?>"
                                   onchange="bieuthuc('<?='b'.$i?>')" 
                                   onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                                   value="<?=$b[$i]?>" class="matran" 
                                   placeholder="b[<?php echo $i;?>]" 
                                   name="b[<?php echo $i;?>]"> $x^{<?=$i?>}+$
                        </td>
<?php
                    }
?>
                        <td>
                            <input type="text" id="<?='b'.$i?>"
                                   onchange="bieuthuc('<?='b'.$i?>')" 
                                   onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                                   value="<?=$b[$i]?>" class="matran" 
                                   placeholder="b[<?php echo $i;?>]" 
                                   name="b[<?php echo $i;?>]"> $x^{<?=$i?>}$
                        </td>
                       
            </table>
<?php
                if($ladathuc==3||$ladathuc==2){
                    echo '<h5 class="text-danger ketqua"><b>'
                        . 'Hệ số $b_{'.$n2.'}$ bắt buộc phải khác 0 mời nhập lại.'
                        . '</b></h5>';
                    }
?> 
        </div>
    </div>
    <input type="hidden" name="n1" class="text-warning"  value="<?=$n1?>">
    <input type="hidden" name="n2" class="text-warning"  value="<?=$n2?>">
    <div class="row">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-success ">Thực hiện tính</button>
        </div>
    </div>
<?php
    }
    if($ladathuc==4){
?>
    $$ 
    A(x) = <?=$this->render('dathuccon',[
           'sobac'=>$n1,
            'a'=>$a,
        ]);?> \text{ , và }
    B(x) = <?=$this->render('dathuccon',[
           'sobac'=>$n2,
            'a'=>$b,
        ]);?>\\
       
    \text{Kết quả phép phân tích là}\\
    \frac{
    <?=$this->render('dathuccon',[
           'sobac'=>$n1,
            'a'=>$a,
        ]);?>
    }{
    <?=$this->render('dathuccon',[
       'sobac'=>$n2,
        'a'=>$b,
    ]);?>}
    =<?php if($nphanchia>0){ echo $this->render('dathuccon',[
                    'sobac'=>$nphanchia,
                     'a'=>$phanchia,
                 ]);
            }else{
                echo 0;
            }
    ?>
    +
    \frac{
    <?=$this->render('dathuccon',[
           'sobac'=>$nphandu,
            'a'=>$phandu,
        ]);?>
    }{
    <?=$this->render('dathuccon',[
       'sobac'=>$n2,
        'a'=>$b,
    ]);?>}
    $$
<?php
    }
?>
