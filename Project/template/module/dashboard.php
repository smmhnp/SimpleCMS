<?php

    function AuthenticationRequire(){
        return true;
    }

    function GetTitile(){
        return "صفحه کاربری";  
    }

    function GetContent (){     ?>

        <p>
            این محتوایی است که فقط به کاربران وارد شده نمایش داده می شود.
        </p>
        
    <?php } 