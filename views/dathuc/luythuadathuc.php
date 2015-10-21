<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Ứng dụng toán';
?>
<h1 class="tieude">
     Lũy Thừa Đa Thức - Online
</h1>
<div class="cachtren"></div>
<form action="/dathuc/luythuadathuc" method="post">
    <div class="row">
        <div class="col-lg-9">
            <b>Số bậc của đa thức là </b>
            <input type="text" id="n" class="so_n" placeholder="n =..." name="n" value="<?=$n?>">
        </div>
        <div class="col-lg-3 pheptinhmoi">
            <button type="submit"  class="btn btn-danger">Đa thức mới</button>
        </div>
    </div>
</form>
<?php 
    if($n>0){
?>
<div class="cachtren bieuthuc-dathuc text-center">
<form action="/dathuc/luythuadathuc" method="post">
    <div class="row">
        <p><b>Nhập vào các hệ số của đa thức </b></p><br>
        <div class="col-lg-12">
<?php
                for($i=$n;$i>0;$i--){
?>  
                   
                        <input type="text" id="<?='a'.$i?>"
                               onchange="bieuthuc('<?='a'.$i?>')" 
                               onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                               value="<?=$a[$i]?>" class="matran" 
                               placeholder="a[<?php echo $i;?>]" 
                               name="a[<?php echo $i;?>]"> $x^{<?=$i?>}+$
                   
<?php
                }
?>
                    
                        <input type="text" id="<?='a'.$i?>"
                               onchange="bieuthuc('<?='a'.$i?>')" 
                               onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                               value="<?=$a[$i]?>" class="matran" 
                               placeholder="a[<?php echo $i;?>]" 
                               name="a[<?php echo $i;?>]"> $x^{<?=$i?>}$
                  
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
    <div class="row cachtren">
        <div class="col-lg-12 text-center">
            <span>Số mũ </span> <input type="text" id="somu" placeholder="Số mũ ..." name="somu" value="<?=$somu?>">
        </div>
        <div class="col-lg-12 text-center">
            <button type="submit" class="btn btn-danger ">Thực hiện tính</button>
        </div>
        
    </div>
</form>
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
    <?=$this->render('dathuccon',[
           'sobac'=>$n,
            'a'=>$a,
        ]);?> \\
    \text{Kết quả}\\
    (<?=$this->render('dathuccon',[
           'sobac'=>$n,
            'a'=>$a,
        ]);?> )^{<?=$somu?>}=<?=$this->render('dathuccon',[
           'sobac'=>$n_luythua,
            'a'=>$a_luythua,
        ]);?> \\
    $$
<?php
    }
?>
