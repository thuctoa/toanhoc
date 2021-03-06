<?php
/* @var $this yii\web\View */
$this->title = 'Ứng dụng toán';
?>
<h1 class="tieude">
            Giải Hệ Phương Trình - Online
</h1>

<div class="cachtren"></div>
<form action="/matran/index" method="post">
    <div class="row">
        <div class="col-lg-9">
            <b>Số ẩn, số phương trình là </b>
            <input id="soan" type="text" name="soan" class="so_n" placeholder="n = .." value="<?=$soan?>">
        </div>
        <div class="col-lg-3 pheptinhmoi">
            <button type="submit" class="btn btn-default">Giải hệ mới</button>
        </div>
    </div>
</form>

<?php 
if($soan>0&&$soan<33){
?>
<form action="/matran/index" method="post">
    <table class="hephuongtrinh">
        <tr>
            <th colspan="<?=$soan+1?>" class="text-center">Nhập vào các hệ số của hệ phương trình</th>
        </tr>
        <?php
            for($i=0;$i<$soan;$i++){
                echo "<tr>";
                for($j=0;$j<$soan-1;$j++){
        ?>
        <td >
                    <input type="text"
                           id="<?='a'.$i.$j?>" 
                            onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                           onchange="bieuthuc('<?='a'.$i.$j?>')" 
                           value="<?=$a[$i][$j]?>" class="matran" 
                           placeholder="a[<?php echo $i;?>][<?php echo $j;?>]" 
                           name="a[<?php echo $i;?>][<?php echo $j;?>]"> 
                    <b>
                        x<sub><?=$j?></sub> +
                    </b>
                </td>
        <?php
                }
        ?>
                <td >
                    <input type="text" id="<?='a'.$i.$j?>" 
                           onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                           onchange="bieuthuc('<?='a'.$i.$j?>')"
                           value="<?=$a[$i][$j]?>" 
                           class="matran" 
                           placeholder="a[<?php echo $i;?>][<?php echo $j;?>]" 
                           name="a[<?php echo $i;?>][<?php echo $j;?>]">
                    <b>x<sub><?=$j?></sub></b>
                </td>

                <td >
                    <b>
                        =  
                    </b>
                   <input type="text" id="<?='b'.$i?>" 
                          onkeypress="this.style.width = ((this.value.length + 1) * 8+10) + 'px';"
                          onchange="bieuthuc('<?='b'.$i?>')" 
                          value="<?=$b[$i]?>" class="matran" 
                          placeholder="b[<?php echo $i;?>]" 
                          name="b[<?php echo $i;?>]"> 
                </td>      
        <?php
                echo "</tr>";
            }
        ?>
    </table>
    
    <input type="hidden" name="soan" class="text-warning"  value="<?=$soan?>">
        <div class="row giaihe cachtren">
            <div class="col-lg-12 text-center">
                <button type="submit" class="btn btn-default ">Giải hệ</button>
            </div>
            <div class="col-lg-8 mketqua">
                <?php
                    if($conghiem==1){
                        ?>
                $$\begin{array}{lcl}
                \\
                        & \text{Hệ có nghiệm duy nhất là }
                        \{
                         <?php
                            for($i=0;$i<$soan-1;$i++){
                                echo 'x_'.$i.'='.$this->mumuoi($x[$i]).', ';
                            }
                            echo 'x_'.$i.'='.$this->mumuoi($x[$i]);
                        ?>
                        \}\\
                        \\
                       & \mathbf{\text{Tóm tắt bước giải} }
                \end{array}$$
                <?php
                    }else if($conghiem==0){
                        echo '<h5 class="text-danger ketqua"><b>Hệ phương trình vô nghiệm</b></h5>';
                    }else if($conghiem==2){
                        echo '<h5 class="text-warning ketqua"><b>Hệ phương trình có vô số nghiệm</b></h5>';
                    } 
                ?>
            </div>
        </div>

</form>
<?php
}
if($conghiem==32){
    echo '<h5 class="text-danger ketqua"><b>Số ẩn không lớn hơn 32, nếu muốn giải quyết mời bạn liên'
    . ' lạc với chúng tôi để được hỗ trợ.</b></h5>';
}
?>
<?php
    if($conghiem==1){
        $khac=0;
        for($i=0;$i<$soan;$i++){
            for($j=0;$j<$soan;$j++){
                if($a[$i][$j]!=$a_giai[$i][$j]){
                    $khac=1;
                    break;
                }
            }
            if($khac==1){
                break;
            }
        }
    ?>
    <div class="row">
        $$\begin{array}{lcl}
            \begin{cases}
                <?php
                for($i=0;$i<$soan;$i++){
                    for($j=0;$j<$soan-1;$j++){
                        if($a[$i][$j]!=0){
                            echo $a[$i][$j].'x_'.$j;
                            for($k=$j+1;$k<$soan;$k++){
                                if($a[$i][$k]!=0){
                                    if($a[$i][$k]>0){
                                       echo ' + ';
                                    }
                                    break;
                                }
                            }
                           
                        }
                        
                ?>

                <?php 
                    }
                    if($a[$i][$j]!=0){
                        echo $a[$i][$j].'x_'.$j.' = '.$b[$i];
                    }else{
                        echo ' = '.$b[$i];
                    }
                    echo "\\\\";
                }
                ?>
            \end{cases}
            <?php 
            if($khac==1){
            ?>
            \\
                \Longleftrightarrow 
                \begin{cases}
                    <?php
                    for($i=0;$i<$soan;$i++){
                        for($j=0;$j<$soan-1;$j++){
                            if($a_giai[$i][$j]!=0){
                                echo $a_giai[$i][$j].'x_'.$j;
                                for($k=$j+1;$k<$soan;$k++){
                                    if($a_giai[$i][$k]!=0){
                                        if($a_giai[$i][$k]>0){
                                            echo ' + ';
                                        }
                                        break;
                                    }
                                }

                            }

                    ?>

                    <?php 
                        }
                        if($a_giai[$i][$j]!=0){
                            echo $a_giai[$i][$j].'x_'.$j.' = '.$this->mumuoi($b_giai[$i]);
                        }else{
                            echo ' = '.$this->mumuoi($b_giai[$i]);
                        }
                        echo "\\\\";
                    }
                    ?>
                \end{cases}
            <?php
            }
            ?>
                \\
            \Longleftrightarrow 
            \begin{cases}
            <?php
            for($i=0;$i<$soan;$i++){
                echo 'x_'.$i.' = '.$this->mumuoi($x[$i]);
                echo "\\\\";
            }
            ?>
            \end{cases}
        \end{array}$$
        
</div>
    <?php
    }
    ?>