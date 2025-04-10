<?php

    function AuthenticationRequire(){
        return true;
    }

    function GetTitile(){
        return "ویرایش برگه‌ها";  
    }

    function GetContent (){     ?>

        <h3>برگه ها</h3>
        <table class="table table-bordered table-hover">
            <tr class="info">
                <th style="width: 60px;">ردیف</th>
                <th>عنوان</th>
                <th style="width: 240px;">عملیات</th>
            </tr>
            <?php
                $pages = GetAllPages(true);
                $counter = 0;
                foreach ($pages as $page) {
                    $id = $page['id'];
                    $title = $page['title'];
                    $hidden = $page['hidden'];
                    ?>
                    <tr>
                        <td>
                            <?php echo ++$counter; ?>
                        </td>
                        <td>
                            <?php echo "<strong>$title</strong>"; ?>
                            <?php if ($hidden): ?>
                                <span style="font-size: small; color: red;">
                                    [مخفی]
                                </span>
                            <?php endif; ?>
                            <br>
                            <span style="color: #398439;">
                                <?php echo GetPageURL($id); ?>
                            </span>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="<?php echo GetPageEditURL($id); ?>">
                                ویرایش
                            </a>

                            <?php if ($hidden): ?>
                                <a class="btn btn-sm btn-success" href="<?php echo GetPageunHideURL($id); ?>">
                                    ظاهر کردن
                                </a>
                            <?php else: ?>
                                <a class="btn btn-sm btn-warning" href="<?php echo GetPageHideURL($id); ?>">
                                    مخفی کردن
                                </a>
                            <?php endif; ?>

                            <a class="btn btn-sm btn-danger" href="<?php echo GetPageDeleteURL($id); ?>">
                                حدف
                            </a>
                        </td>
                    </tr>

                    <?php 
                }
            ?>
        </table>

        <br>
        <a class="btn btn-success" href="<?php echo SetUrl('new'); ?>">
            صفحه جدید
        </a>
        
    <?php } 

    function ProccessInput (){
        if(empty($_GET)){
            return;
        }

        $action = strtolower(GetInput($_GET, 'action'));
        $id = GetInput($_GET, 'id');

        switch ($action){
            case 'hide':
                HidePage($id);
                break;
            
            case 'unhide':
                unHidePage($id);
                break;

            case 'delete':
                DeletePage($id);
                break;
        }

        ReDirectory(SetUrl("info"));
    }