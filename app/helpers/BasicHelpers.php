<?php
if(!function_exists('userId')){
    function userId() {
        return Auth::user()?->id;
    }
}
if(!function_exists('authUser')){
    function authUser() {
        return Auth::user();
    }
}
