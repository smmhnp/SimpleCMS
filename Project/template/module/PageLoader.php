<?php

    function GetTitile(){
        global $CurrentPage;
        return $CurrentPage['title'];  
    }

    function GetContent (){  
        global $CurrentPage;
        echo $CurrentPage['content']; 

        $id = $CurrentPage['id'];
?>
        <?php if (UserLoggenIn()): ?>
            <br>
            <a class="btn btn-primary" href="<?php echo GetPageEditURL($id); ?>">
                ویرایش
            </a>
        <?php endif; ?>
<?php

    } 