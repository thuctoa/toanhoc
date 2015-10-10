$$
    <?php
    $sobac=count($a)-1;
        if($daohamcap==0){   
    ?>
        P_{<?=$sobac?>}(x)=
    <?php
        }else{
    ?>
        P_{<?=$sobac + $daohamcap?>}^{(<?=$daohamcap?>)}(x)=
    <?php
        }
    ?>
    <?php
        for($i=$sobac;$i>0;$i--){
            if($a[$i]!=0){
                if($i!=1){
                    if($a[$i]!=1){
                        if($a[$i]!=-1){
                            echo $a[$i].'x^{'.$i.'}';
                        }else{
                            echo '-x^{'.$i.'}';
                        }
                    }else {
                        echo 'x^{'.$i.'}';
                    }

                }else{
                    if($a[$i]!=1){
                        if($a[$i]!=-1){
                            echo $a[$i].'x';
                        }else{
                            echo '-x';
                        }
                        
                    }else{
                        echo 'x';
                    }
                }
                for($k=$i-1;$k>=0;$k--){
                    if($a[$k]!=0){
                        if($a[$k]>0){
                            echo ' + ';
                        }
                        break;
                    }
                }

            }
        }
        if($a[$i]!=0){
            echo $a[$i];
        }
    ?>

$$
