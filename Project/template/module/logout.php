<?php

    function ProccessInput (){
        UserLogout();
        ReDirectory(SetUrl('login'));
    }