<?php

    function GetTitile(){
        return "صغحه اصلی";  
    }

    function GetContent (){     ?>

        <p>
            این محتوایی است که به همه کاربران نمایش داده می شود.
        </p>
        
        <h3>برگه ها</h3>
        <p>
            <?php
                $pagecount = PageCount();
                echo "در این سیستم $pagecount صفحه تعریف شده است.";
            ?>
        </p>

        <p>
            <?php   DispalyPageList();  ?>
        </p>
    <?php } 