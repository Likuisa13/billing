<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sppt;

/**
 * SpptSearch represents the model behind the search form of `app\models\Sppt`.
 */
class SpptSearch extends Sppt
{
    /**
     * {@inheritdoc}
     */
    
    public $nop;
    public $tahun;
    public function rules()
    {
        return [
            [['tahun','nop','KD_PROPINSI', 'KD_DATI2', 'KD_KECAMATAN', 'KD_KELURAHAN', 'KD_BLOK', 'NO_URUT', 'KD_JNS_OP', 'THN_PAJAK_SPPT', 'KD_KANWIL', 'KD_KANTOR', 'KD_TP', 'NM_WP_SPPT', 'JLN_WP_SPPT', 'BLOK_KAV_NO_WP_SPPT', 'RW_WP_SPPT', 'RT_WP_SPPT', 'KELURAHAN_WP_SPPT', 'KOTA_WP_SPPT', 'KD_POS_WP_SPPT', 'NPWP_SPPT', 'NO_PERSIL_SPPT', 'KD_KLS_TANAH', 'THN_AWAL_KLS_TANAH', 'KD_KLS_BNG', 'THN_AWAL_KLS_BNG', 'TGL_JATUH_TEMPO_SPPT', 'STATUS_PEMBAYARAN_SPPT', 'STATUS_TAGIHAN_SPPT', 'STATUS_CETAK_SPPT', 'TGL_TERBIT_SPPT', 'TGL_CETAK_SPPT', 'NIP_PENCETAK_SPPT'], 'safe'],
            [['SIKLUS_SPPT', 'LUAS_BUMI_SPPT', 'LUAS_BNG_SPPT', 'NJOP_BUMI_SPPT', 'NJOP_BNG_SPPT', 'NJOP_SPPT', 'NJOPTKP_SPPT', 'PBB_TERHUTANG_SPPT', 'FAKTOR_PENGURANG_SPPT', 'PBB_YG_HARUS_DIBAYAR_SPPT'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Sppt::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere(['concat(KD_PROPINSI,KD_DATI2,KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP)' => $this->nop])
        ->andFilterWhere(['THN_PAJAK_SPPT' => $this->tahun]);
        return $dataProvider;
    }
}
