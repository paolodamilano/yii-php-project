<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model{
    public $file;
    public $dbtable;

    public function rules(){
        return [
            [['file','dbtable'],'required'],
            [['file'],'file','extensions'=>'csv','maxSize'=>1024 * 1024 * 5],
            [['dbtable'],'string'],
        ];
    }
   
    public function attributeLabels(){
        return [
            'dbtable'=>'Category',
            'file'=>'File',
        ];
    }

    public function upload()
    {
        try{
            // get data from CSV
            $tmppath = 'uploads/tmp/';
            $this->file->saveAs($tmppath .$this->file->name);
            $csv_data = [];
            ini_set('auto_detect_line_endings',TRUE);
            $handle = fopen($tmppath.$this->file->name, 'r');
            if($this->dbtable === "pratiche"){
                $keys = array('id_pratica', 'data_creazione', 'stato', 'note','id_cliente');
            }
            else{
                $keys = array('id', 'nome', 'cognome', 'codice_fiscale','note');
            }
            while ( ($data = fgetcsv($handle) ) !== FALSE ) {
                array_push($csv_data,array_combine($keys,$data));
            }
            fclose($handle);
            ini_set('auto_detect_line_endings',FALSE);

            if($this->dbtable === "pratiche"){
                $upl = Pratiche::insertRecords($csv_data);
            }
            else{
                $upl = Clienti::insertRecords($csv_data);
            }

            return $upl;
        } catch (Exception $e) {
            return false;
        }
        
    }
}