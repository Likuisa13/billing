<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id
 * @property string $nama
 * @property int $usia
 */
class Dosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usia'], 'integer'],
            [['nama'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'usia' => 'Usia',
        ];
    }
}
