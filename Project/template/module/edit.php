<?php
    
    function AuthenticationRequire(){
        return true;
    }

    function GetTitile(){
        return "ویرایش صفحه";  
    }

    function GetContent (){     ?>

        <?php 
            $page = GetPage(GetInput($_GET, 'id'));
            if (!$page){
                echo "صفحه نادرست است!";
                return;
            }
        ?>

        <h3>ویرایش</h3>
        <br>
          
        <form class="form-horizontal" method="post">
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">عنوان</label>
                <div class="col-sm-10">
                    <input class="form-control" id="title" name="title" placeholder="عنوان برگه" value="<?php echo $page['title']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="slug" class="col-sm-2 control-label">نامک</label>
                <div class="col-sm-10">
                    <input class="form-control" id="slug" name="slug" placeholder="نامک برگه" value="<?php echo $page['slug']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">محتوا</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="10" name="content" id="content"><?php echo $page['content']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <label>
                        <input type="checkbox" name="hidden" id="hidden" <?php echo $page['hidden'] ? 'checked' : ''; ?>>
                        مخفی بودن برگه
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                </div>
            </div>
        </form>
        
        <script src="https://cdn.tiny.cloud/1/f9honjw4tl69xv44iiw05gpprha65nf80lfz1akc0zoaoqe0/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '#content',
                directionality: 'rtl',
                height: 500,
                menubar: false,
                plugins: 'advlist autolink lists link image charmap print preview anchor',
                toolbar: 'undo redo | formatselect | bold italic backcolor | \
                        alignleft aligncenter alignright alignjustify | \
                        bullist numlist outdent indent | removeformat | help'
            });
        </script>        

    <?php } 

    function ProccessInput (){
        if (empty($_POST)){
            return;
        }

        $page = $_POST;
        $page['id'] = $_GET['id'];
        $id = $page['id'];

        if (isset($page['hidden']) and $page['hidden'] == 'on'){
            $page['hidden'] = 1;
        } else {
            $page['hidden'] = 0;
        }


        UpdatePage($page);
        ReDirectory(SetUrl("edit?id=$id"));
    }