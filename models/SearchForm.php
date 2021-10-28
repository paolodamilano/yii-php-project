<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pratiche;

/**
 * SearchForm is the model behind the contact form.
 */
class SearchForm extends Model
{
    public $id_pratica;
    public $cf_piva;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['id_pratica', 'string'],
            ['cf_piva', 'string'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_pratica' => 'ID pratica',
            'cf_piva' => 'Cod.Fiscale / P.IVA',
        ];
    }

    // function for extract data from DB (all or filtered)
    public function search($params = null){
        $query = Pratiche::find();
        $query->andFilterWhere(['id_pratica' => $this->id_pratica]);
        $query->andFilterWhere(['clienti.codice_fiscale' => $this->cf_piva]);
        $query->joinWith('clienteInfo');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);
        return $dataProvider;
    }

    /*
    // function for export data on CSV file
    public function export($data){
        $tmppath = 'export';
        $list = array ();
        foreach ($data->models as $model) {
            $row = array(
                $model->data_creazione,
                $model->id_pratica,
                $model->stato,
                $model->clienteInfo['nome']." ".$model->clienteInfo['cognome'],
            );
            array_push($list, $row);
        }
        $filepath = $tmppath.'/'.date('Ymd').'_exportfile.csv';
        $fp = fopen($filepath, 'w+');
        foreach ($list as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        
        return $filepath;
    }
    */
}
