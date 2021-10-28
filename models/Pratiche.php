<?php

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\db\IntegrityException;

/**
 * This is the model class for table "pratiche".
 *
 * @property int $id
 * @property string $id_pratica
 * @property string $data_creazione
 * @property string|null $stato
 * @property string|null $note
 * @property int $id_cliente
 */
class Pratiche extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pratiche';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pratica', 'data_creazione', 'id_cliente'], 'required'],
            [['data_creazione'], 'safe'],
            [['stato', 'note'], 'string'],
            [['id_cliente'], 'integer'],
            [['id_pratica'], 'string', 'max' => 255],
            [['id_pratica'], 'unique'],
            [['cliente'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pratica' => 'Id Pratica',
            'data_creazione' => 'Data Creazione',
            'stato' => 'Stato',
            'note' => 'Note',
            'id_cliente' => 'Id Cliente',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getClienteInfo()
    {
        return $this->hasOne(Clienti::className(), ['id' => 'id_cliente']);
    }

    public static function insertRecords($records){
        $columnsName = array_keys($records[0]);
        try{
            $db = Yii::$app->db;
            $result = $db->createCommand()->batchInsert("pratiche",$columnsName,$records)->execute();
            return true;
        }catch (IntegrityException $e) {
            return false;
        }
    }
}
