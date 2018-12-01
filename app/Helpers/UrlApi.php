<?php
/**
 * Created by PhpStorm.
 * User: Verbeck DEGBESSE
 * Date: 30/09/2018
 * Time: 10:45
 */

namespace App\Helpers;


class UrlApi
{
    public static function url_api_rest(){
       return 'http://localhost/back_up/immo/api';
    }

    public static function url_img(){
        return 'http://localhost/back_up/immo/';
    }

    public static function findData($id){
        return json_decode(file_get_contents(self::url_api_rest().'/images/'.$id));
    }

    public static function findTypeLocation($id){
        return json_decode(file_get_contents(self::url_api_rest().'/typelogement/'.$id));
    }

    public static function findVoiture($id){
        return json_decode(file_get_contents(self::url_api_rest().'/findvoiture/'.$id));
    }

    public static function find_article($id){
        return json_decode(file_get_contents(self::url_api_rest().'/findArticle/'.$id));
    }

    public static function getArticles(){
        return json_decode(file_get_contents(self::url_api_rest().'/all_liste/'));
    }

    public static function getArticleById($cat){
        return json_decode(file_get_contents(self::url_api_rest().'/articleBycat/'.$cat));
    }

    public static function getAllMarques(){
        return json_decode(file_get_contents(self::url_api_rest().'/all_marque'));
    }

    public static function reservation(){
        return json_decode(file_get_contents(self::url_api_rest().'/reservation'));
    }


}