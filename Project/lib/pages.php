<?php

    function GetAllPages ($include_hidden = false){
        global $db;
        if ($include_hidden){
            $result = $db -> query("
                SELECT *
                FROM Pages
            ");
        } else {
            $result = $db -> query("
                SELECT *
                FROM Pages
                WHERE hidden = 0
            ");
        }

        $pages = array();
        while($row = $result -> fetch_assoc()){
            $pages[] = $row;
        }

        return $pages;
    }

    function PageCount (){
        global $db;
        $result = $db -> query("
            SELECT *
            FROM Pages
            WHERE hidden = 0
        ");

        return $result -> num_rows;
    }

    function GetPage ($id) {
        global $db;
        if (!$id) {
            return null;
        }

        $result = $db -> query("
            SELECT *
            FROM Pages
            WHERE id = '$id'
        ");

        $row = $result -> fetch_assoc();
        return $row;
    }

    function GetPageBySlug ($slug) {
        if(!$slug) {
            return null;
        }
        
        global $db;
        $result = $db->query("
            SELECT *
            FROM pages
            WHERE slug = '$slug'
        ");
        
        $row = $result->fetch_assoc();
        return $row;
    }

    function PageExists ($id){
        if (!$id){
            return false;
        }
        $Page = GetPage($id);
        return isset($Page['id']);
    }

    function PageExistsBySlug ($slug){
        if (!$slug){
            return false;
        }
        $Page = GetPageBySlug($slug);
        return isset($Page['id']);
    }

    function AddPage ($Pagedata){
        global $db;
        $id = $Pagedata['id'];

        if (!$id){
            $id = 0;
        }

        $title = $Pagedata['title'];
        $slug = $Pagedata['slug'];
        $content = $Pagedata['content'];
        $hidden = $Pagedata['hidden'] ?? 0;

        if ($hidden != 0){
            $hidden = 1;
        } else {
            $hidden = 0;
        }

        if (!PageExists($id)){
            $db -> query("
                INSERT INTO pages ()
                VALUES (NULL, '$title', '$slug', '$content', '$hidden');                
            ");
            $id = $db -> insert_id;

        } else {
            $db -> query("
                UPDATE pages
                SET title = '$title',
                    slug = '$slug',
                    content = '$content',
                    hidden = '$hidden'
                WHERE id = $id;
            ");
        }
        
        return $id;
    }

    function UpdatePage ($Pagedata){
        return AddPage ($Pagedata);
    }

    function DeletePage ($id){
        global $db;
        if (!PageExists($id)){
            return;
        }

        $db -> query("
            DELETE FROM Pages
            WHERE id = '$id';
        ");
    }

    function GetPageTitle ($id){
        $page = GetPage($id);
        if (!$page){
            return null;
        }
        return $page['title'];
    }

    function GetPageSlug ($id){
        $page = GetPage($id);
        if (!$page){
            return null;
        }
        return $page['slug'];
    }

    function GetPageContent ($id){
        $page = GetPage($id);
        if (!$page){
            return null;
        }
        return $page['content'];
    }

    function is_PageHidden ($id){
        $page = GetPage($id);
        if (!$page){
            return false;
        }

        if ($page['hidden']){
            return true;
        }

        return false;
    }

    function GetPageURL ($id){ 
        $slug = GetPageSlug($id);
        return SetUrl($slug);
    }

    function GetPageEditURL ($id){
        return SetUrl("edit?id=$id");
    }

    function GetPageHideURL ($id){
        return SetUrl("info?action=hide&id=$id");
    }

    function HidePage ($id){
        $page = GetPage($id);
        if(!$page){
            return;
        }

        $page['hidden'] = 1;
        UpdatePage($page);
    }

    function GetPageunHideURL ($id){
        return SetUrl("info?action=unhide&id=$id");
    }

    function unHidePage ($id){
        $page = GetPage($id);
        if(!$page){
            return;
        }

        $page['hidden'] = 0;
        UpdatePage($page);
    }

    function GetPageDeleteURL ($id){
        return SetUrl("info?action=delete&id=$id");
    }

    function DispalyPageList ($add_ul = true){
        $pages = GetAllPages();

        if(!$pages){
            return;
        }

        if ($add_ul){
            echo "<ul>";
        }

        foreach ($pages as $page){
            if ($page['hidden']){
                continue;
            }
             
            $url = GetPageURL($page['id']);
            $title = $page['title'];
            
            echo "<li>";
            echo '<a href="'.$url.'">'.$title.'</a>';
            echo "</li>";
        }
        if ($add_ul){
            echo "</ul>";
        }
    }