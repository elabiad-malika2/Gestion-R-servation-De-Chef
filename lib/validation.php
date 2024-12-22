<?php
    function validate($data){
        $data=trim($data);
        $data=htmlspecialchars($data);
        return $data ;
    }
    

?>