<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "billing".
 *
 * @property string $NOP
 * @property int $TH_PJK
 * @property double $NOMINAL
 * @property string $VA
 * @property string $EXP_DATE
 * @property string $CREATED_DATE
 */
class Billing extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $secret_key;
    public $prefix;
    public $client_id;
    public static function tableName()
    {
        return 'billing';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['VA'], 'required'],
            [['TH_PJK','STATUS'], 'integer'],
            [['NOMINAL'], 'number'],
            [['EXP_DATE', 'CREATED_DATE', 'TR_DATE'], 'safe'],
            [['NOP'], 'string', 'max' => 18],
            [['VA'], 'string', 'max' => 16],
            [['VA'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NOP' => 'Nop',
            'TH_PJK' => 'Th Pjk',
            'NOMINAL' => 'Nominal',
            'VA' => 'Va',
            'EXP_DATE' => 'Exp Date',
            'CREATED_DATE' => 'Created Date',
            'TR_DATE' => 'Transaction Date',
            'STATUS' => 'Status',
        ];
    }
}
