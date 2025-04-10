<?php

    function GetTitile(){
        return "login";  
    }

    function GetContent (){     ?>
    
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">ورود به سیستم</h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label">نام کاربری</label>
                                <div class="col-sm-10">
                                    <?php
                                        $username = '';
                                        if (isset($_POST['username'])){
                                            $username = $_POST['username'];
                                        }
                                    ?>
                                    <input class="form-control" id="username" name="username" placeholder="نام کاربری" value="<?php echo $username; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-sm-2 control-label">رمز عبور</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="رمز عبور">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" name="login" class="btn btn-primary">ورود</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>        
        </div>
    
    <?php } 

    function ProccessInput (){

        if (!isset($_POST['login'])){
            return;
        }

        if (isset($_POST['username'])){
            $username = $_POST['username'];
        }

        if (empty($username)){
            Notic('نام کاربری نمیتواند خالی باشد.', 'error');
            return;
        }

        if (isset($_POST['password'])){
            $password = $_POST['password'];
        }
        
        if (empty($password)){
            Notic('رمز عیور نمیتواند خالی باشد.', 'error');
            return;
        }

        UserLogin($username, $password);

        if (!UserLoggenIn()){
            Notic('نام کاربری یا رمز عبور اشتباه است.', 'error');
        } else {
            ReDirectory(SetUrl('dashboard'));
        }
    }