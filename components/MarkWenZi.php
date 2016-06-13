<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.*/
 namespace app\components;
 use yii\base\Widget;
 class MarkWenZi extends Widget{
     public $dafen,$buju;
     public function init() {
         
     }
     public function run() {
        return $this->render('markwenzi',['dafen'=> $this->dafen,'buju'=>  $this->buju,]); 
     }
}

