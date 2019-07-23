<?php


namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class UploadImage extends Model{

    public $image;

    public function rules(){
        return[
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['image'], 'required'],
        ];
    }

    public function upload($dir){
        if($this->validate()){
            $path = '../../frontend/web/upload/' . $dir;
            FileHelper::createDirectory($path);
            $this->image->saveAs("{$path}{$this->image->baseName}.{$this->image->extension}");
            return $this->image->name;
        }else{
            return false;
        }
    }

    public function attributeLabels()
    {
        return [
            'image' => 'Картинка'
        ];
    }

}