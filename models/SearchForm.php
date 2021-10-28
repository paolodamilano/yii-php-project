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

    public function search($params = null){
        $query = Pratiche::find();
        //$query->select(['data_creazione', 'id_pratica', 'stato', 'clienti.codice_fiscale']);
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
}
