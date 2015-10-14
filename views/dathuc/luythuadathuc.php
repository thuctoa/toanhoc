<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Lũy thừa đa thức';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form action="/dathuc/luythuadathuc" method="post">
        Số bậc của đa thức $A(x)$ là <input type="text" id="n" placeholder="Nhập vào một số ..." name="n" value="<?=$n?>">
        <button type="submit"  class="btn btn-success">Đa thức mới</button><br><br><br>
</form>
<?php 
    if($n>0){
?>
    <form action="/dathuc/luythuadathuc" method="post">
    <div class="row">
        <div class="col-lg-12">
            <table>
                <tr>
                    <th colspan="<?=$n+1?>" class="text-center">Đa thức $A(x)$ </th>
                </tr>
<?php
                for($i=$n;$i>0;$i--){
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
            if($ladathuc==1){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Hệ số $a_{'.$n.'}$ bắt buộc phải khác 0 mời nhập lại.'
                . '</b></h5>';
            }
            
?>  
            
    </div>
    </div>
    <input type="hidden" name="n" class="text-warning"  value="<?=$n?>">
    <div class="row">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-success ">Thực hiện tính</button>
        </div>
        <div class="col-lg-2 text-center">
            <input type="text" id="somu" placeholder="Số mũ ..." name="somu" value="<?=$somu?>">
        </div>
    </div>
    
<?php
    if($ladathuc==2){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Số mũ phải lớn hơn 0 mời nhập lại.'
                . '</b></h5>';
            }
    }
    if($ladathuc==4){
?>
    $$
    \text{Đa thức ban đầu}\\
    A(x) = <?=$this->render('dathuccon',[
           'sobac'=>$n,
            'a'=>$a,
        ]);?> \\
    \text{Kết quả}\\
    A^{<?=$somu?>}(x)=<?=$this->render('dathuccon',[
           'sobac'=>$n_luythua,
            'a'=>$a_luythua,
        ]);?> \\
    $$
<?php
    }
?>
