<?php
use yii\helpers\Html;
/* @var $this yii\web\View */
$this->title = 'Ứng dụng toán';
//$this->params['breadcrumbs'][] = $this->title;
?>
<p class="tieude">Giải phương trình</p>

 <form action="/dathuc/index" method="post">
            Số bậc của phương trình, có đa thức P là 
            <input class="so_n" 
                id ="nghiemdathuc" type="text" placeholder="..." name="sobac" value="<?=$sobac?>">
            <button type="submit" class="btn btn-danger">Phương trình mới</button><br><br><br>
</form>
<?php 
if($sobac>0){
?>
<form action="/dathuc/index" method="post">
    $ P_{<?=$sobac?>}(x)=$
    <?php
        for($i=$sobac;$i>0;$i--){
    ?>  
            <input  class="dathuc"
                    id="<?='a'.$i?>" 
                    onchange="bieuthuc('<?='a'.$i?>')"
                    onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                    placeholder="a[<?php echo $i;?>]..."
                    value="<?=$a[$i]?>" 
                    name="a[<?php echo $i;?>]"
            >$x^{<?=$i?>}+$
    <?php
        }
    ?>
            <input class="dathuc"
                   id="<?='a'.$i?>"
                   onchange="bieuthuc('<?='a'.$i?>')"
                   onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                   placeholder="a[<?php echo $i;?>]..."
                   value="<?=$a[$i]?>" 
                   name="a[<?php echo $i;?>]"
                   
            >$x^{<?=$i?>} =0 $
            
        <?php
            if($conghiem==-10){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Hệ số $a_{'.$sobac.'}$ bắt buộc phải khác 0 mời nhập lại.'
                . '</b></h5>';
            }
        ?>   
        <?php
            if($conghiem==-20){
                echo '<h5 class="text-danger ketqua"><b>'
                . 'Vì lý do tài nguyên của máy tính nên bạn hãy nhập số bậc không vượt quá 16. '
                . '</b></h5>';
            }
        ?> 
<!--            <input  name="tinh" class="text-warning"  >
            <input  name="ketqua" value= "<?php //echo $gtt;?>" class="text-warning"  >-->
    <input type="hidden" name="sobac" class="text-warning"  value="<?=$sobac?>">

    <div class="row " style="margin-top: 30px;">
        <div class="col-lg-2 text-center">
            <button type="submit" class="btn btn-warning " >Tìm nghiệm</button>
        </div>
        <div class="col-lg-4 text-center">
            <?php if($conghiem==0){
                echo '<h5 class="text-danger ketqua"><b>Phương trình không có nghiệm thực</b></h5>';
            }
            ?>
        </div>
    </div>
</form>  
    <?php
    
    if($conghiem>0){
        
        echo $this->render('dathuc', [
            'sobac'=>$sobac,
            'a' => $a,
            'daohamcap'=>0,
        ]);
       
//        for($i=$sobac;$i>1;$i--){
//            echo $this->render('dathuc', [
//            'a' => $a_daoham[$sobac-$i],
//            'daohamcap'=>$i-2,
//            ]) ;
//        }
    }
    if(count($nghiem)>0){
        if($sobac>5&&$sobac!=  count($nghiem)){
            echo '$$\text{Có thể tìm thấy được số nghiệm gần đúng và có thể bỏ sót nghiệm của phương trình là}$$';
        }else{
            echo '$$\text{Nghiệm của phương trình là}$$';
        }
        echo '$$\begin{cases}';
        foreach ($nghiem as $key=>$val){
            echo 'x_{'.$key.'}='.$val.'\\\\';
        }
        echo '\end{cases}$$';
    }else if($conghiem>0){
        echo '<h5 class="text-danger ketqua"><b>Không thể tìm được nghiệm thực của phương trình</b></h5>';
    }
}
?>