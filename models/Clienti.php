<?php

namespace app\models;

use Yii;
use yii\base\ErrorException;
use yii\db\IntegrityException;

/**
 * This is the model class for table "clienti".
 *
 * @property int $id
 * @property string $nome
 * @property string $cognome
 * @property string $codice_fiscale
 * @property string|null $note
 */
class Clienti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clienti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nome', 'cognome', 'codice_fiscale'], 'required'],
            [['id'], 'integer'],
            [['note'], 'string'],
            [['nome', 'cognome', 'codice_fiscale'], 'string', 'max' => 50],
            [['codice_fiscale'], 'unique'],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'codice_fiscale' => 'Codice Fiscale',
            'note' => 'Note',
        ];
    }

    public static function insertRecords($records){
        $columnsName = array_keys($records[0]);
        try{
            $db = Yii::$app->db;
            $result = $db->createCommand()->batchInsert("clienti",$columnsName,$records)->execute();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }
}