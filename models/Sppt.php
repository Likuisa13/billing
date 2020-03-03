<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sppt".
 *
 * @property string $KD_PROPINSI
 * @property string $KD_DATI2
 * @property string $KD_KECAMATAN
 * @property string $KD_KELURAHAN
 * @property string $KD_BLOK
 * @property string $NO_URUT
 * @property string $KD_JNS_OP
 * @property string $THN_PAJAK_SPPT
 * @property int $SIKLUS_SPPT
 * @property string $KD_KANWIL
 * @property string $KD_KANTOR
 * @property string $KD_TP
 * @property string $NM_WP_SPPT
 * @property string $JLN_WP_SPPT
 * @property string $BLOK_KAV_NO_WP_SPPT
 * @property string $RW_WP_SPPT
 * @property string $RT_WP_SPPT
 * @property string $KELURAHAN_WP_SPPT
 * @property string $KOTA_WP_SPPT
 * @property string $KD_POS_WP_SPPT
 * @property string $NPWP_SPPT
 * @property string $NO_PERSIL_SPPT
 * @property string $KD_KLS_TANAH
 * @property string $THN_AWAL_KLS_TANAH
 * @property string $KD_KLS_BNG
 * @property string $THN_AWAL_KLS_BNG
 * @property string $TGL_JATUH_TEMPO_SPPT
 * @property int $LUAS_BUMI_SPPT
 * @property int $LUAS_BNG_SPPT
 * @property int $NJOP_BUMI_SPPT
 * @property int $NJOP_BNG_SPPT
 * @property int $NJOP_SPPT
 * @property int $NJOPTKP_SPPT
 * @property int $PBB_TERHUTANG_SPPT
 * @property int $FAKTOR_PENGURANG_SPPT
 * @property int $PBB_YG_HARUS_DIBAYAR_SPPT
 * @property string $STATUS_PEMBAYARAN_SPPT
 * @property string $STATUS_TAGIHAN_SPPT
 * @property string $STATUS_CETAK_SPPT
 * @property string $TGL_TERBIT_SPPT
 * @property string $TGL_CETAK_SPPT
 * @property string $NIP_PENCETAK_SPPT
 */
class Sppt extends \yii\db\ActiveRecord
{
    public $nop;
    public $tahun;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sppt';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['KD_PROPINSI', 'KD_DATI2', 'KD_KECAMATAN', 'KD_KELURAHAN', 'KD_BLOK', 'NO_URUT', 'KD_JNS_OP', 'THN_PAJAK_SPPT', 'PBB_YG_HARUS_DIBAYAR_SPPT'], 'required'],
            [['SIKLUS_SPPT', 'LUAS_BUMI_SPPT', 'LUAS_BNG_SPPT', 'NJOP_BUMI_SPPT', 'NJOP_BNG_SPPT', 'NJOP_SPPT', 'NJOPTKP_SPPT', 'PBB_TERHUTANG_SPPT', 'FAKTOR_PENGURANG_SPPT', 'PBB_YG_HARUS_DIBAYAR_SPPT'], 'integer'],
            [['nop','tahun','TGL_JATUH_TEMPO_SPPT', 'TGL_TERBIT_SPPT', 'TGL_CETAK_SPPT'], 'safe'],
            [['KD_PROPINSI', 'KD_DATI2', 'KD_KANWIL', 'KD_KANTOR', 'KD_TP', 'RW_WP_SPPT'], 'string', 'max' => 2],
            [['KD_KECAMATAN', 'KD_KELURAHAN', 'KD_BLOK', 'RT_WP_SPPT', 'KD_KLS_TANAH', 'KD_KLS_BNG'], 'string', 'max' => 3],
            [['NO_URUT', 'THN_PAJAK_SPPT', 'THN_AWAL_KLS_TANAH', 'THN_AWAL_KLS_BNG'], 'string', 'max' => 4],
            [['KD_JNS_OP', 'STATUS_PEMBAYARAN_SPPT', 'STATUS_TAGIHAN_SPPT', 'STATUS_CETAK_SPPT'], 'string', 'max' => 1],
            [['NM_WP_SPPT', 'JLN_WP_SPPT', 'KELURAHAN_WP_SPPT', 'KOTA_WP_SPPT'], 'string', 'max' => 30],
            [['BLOK_KAV_NO_WP_SPPT', 'NPWP_SPPT'], 'string', 'max' => 15],
            [['KD_POS_WP_SPPT', 'NO_PERSIL_SPPT'], 'string', 'max' => 5],
            [['NIP_PENCETAK_SPPT'], 'string', 'max' => 18],
            [['KD_PROPINSI', 'KD_DATI2', 'KD_KECAMATAN', 'KD_KELURAHAN', 'KD_BLOK', 'NO_URUT', 'KD_JNS_OP', 'THN_PAJAK_SPPT'], 'unique', 'targetAttribute' => ['KD_PROPINSI', 'KD_DATI2', 'KD_KECAMATAN', 'KD_KELURAHAN', 'KD_BLOK', 'NO_URUT', 'KD_JNS_OP', 'THN_PAJAK_SPPT']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nop' => 'Nomor Objek Pajak',
            'tahun' => 'Tahun',
            'KD_PROPINSI' => 'Kd Propinsi',
            'KD_DATI2' => 'Kd Dati2',
            'KD_KECAMATAN' => 'Kd Kecamatan',
            'KD_KELURAHAN' => 'Kd Kelurahan',
            'KD_BLOK' => 'Kd Blok',
            'NO_URUT' => 'No Urut',
            'KD_JNS_OP' => 'Kd Jns Op',
            'THN_PAJAK_SPPT' => 'Thn Pajak Sppt',
            'SIKLUS_SPPT' => 'Siklus Sppt',
            'KD_KANWIL' => 'Kd Kanwil',
            'KD_KANTOR' => 'Kd Kantor',
            'KD_TP' => 'Kd Tp',
            'NM_WP_SPPT' => 'Nm Wp Sppt',
            'JLN_WP_SPPT' => 'Jln Wp Sppt',
            'BLOK_KAV_NO_WP_SPPT' => 'Blok Kav No Wp Sppt',
            'RW_WP_SPPT' => 'Rw Wp Sppt',
            'RT_WP_SPPT' => 'Rt Wp Sppt',
            'KELURAHAN_WP_SPPT' => 'Kelurahan Wp Sppt',
            'KOTA_WP_SPPT' => 'Kota Wp Sppt',
            'KD_POS_WP_SPPT' => 'Kd Pos Wp Sppt',
            'NPWP_SPPT' => 'Npwp Sppt',
            'NO_PERSIL_SPPT' => 'No Persil Sppt',
            'KD_KLS_TANAH' => 'Kd Kls Tanah',
            'THN_AWAL_KLS_TANAH' => 'Thn Awal Kls Tanah',
            'KD_KLS_BNG' => 'Kd Kls Bng',
            'THN_AWAL_KLS_BNG' => 'Thn Awal Kls Bng',
            'TGL_JATUH_TEMPO_SPPT' => 'Tgl Jatuh Tempo Sppt',
            'LUAS_BUMI_SPPT' => 'Luas Bumi Sppt',
            'LUAS_BNG_SPPT' => 'Luas Bng Sppt',
            'NJOP_BUMI_SPPT' => 'Njop Bumi Sppt',
            'NJOP_BNG_SPPT' => 'Njop Bng Sppt',
            'NJOP_SPPT' => 'Njop Sppt',
            'NJOPTKP_SPPT' => 'Njoptkp Sppt',
            'PBB_TERHUTANG_SPPT' => 'Pbb Terhutang Sppt',
            'FAKTOR_PENGURANG_SPPT' => 'Faktor Pengurang Sppt',
            'PBB_YG_HARUS_DIBAYAR_SPPT' => 'Pbb Yg Harus Dibayar Sppt',
            'STATUS_PEMBAYARAN_SPPT' => 'Status Pembayaran Sppt',
            'STATUS_TAGIHAN_SPPT' => 'Status Tagihan Sppt',
            'STATUS_CETAK_SPPT' => 'Status Cetak Sppt',
            'TGL_TERBIT_SPPT' => 'Tgl Terbit Sppt',
            'TGL_CETAK_SPPT' => 'Tgl Cetak Sppt',
            'NIP_PENCETAK_SPPT' => 'Nip Pencetak Sppt',
        ];
    }

    // public function __construct()
    // {
    //     $this->nop = 'KD_PROPINSI,KD_DATI2,KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP';
    // }
}
