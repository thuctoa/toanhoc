
    <?php
    $j=0;
        for($i=$sobac;$i>0;$i--){
           
            if($a[$i]!=0){
                 $j++;
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
                if($j%8==0&&$j>5){
                    echo '\\\\';
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


