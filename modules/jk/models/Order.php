<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "jk_order".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 */
class Order extends Model
{

    /**
     * @var \yii\web\UploadedFile|null
     */


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_mortgage','is_spouse'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],

            [['mortgage_file'], 'safe'],
            [['mortgage_file'], 'file', 'extensions' => 'pdf, docx'],
            [['mortgage_file'], 'file', 'maxSize' => '2048000'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'deleted_by' => Yii::t('app', 'Deleted By'),

            'is_mortgage' => Module::t('module', 'Is Mortgage'),
            'mortgage_file' => Module::t('module', 'Mortgage File'),

            'is_spouse' => Module::t('module', 'Is Spouse'),
            'spouse_fio' => Module::t('module', 'Spouse Fio'),
            'is_spouse_dzo' => Module::t('module', 'Is Spouse Dzo'),
            'child_count' => Module::t('module', 'Child Count'),

        ];
    }

    /**
     * {@inheritdoc}
     * @return OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OrderQuery(get_called_class());
    }

    // Загрузка файлов
    public function upload()
    {
        $this->mortgage_file = UploadedFile::getInstance($this, 'mortgage_file');
        if ($this->mortgage_file) {
            $pathDir = Yii::$app->params['module']['jk']['order']['filePath'] .$this->id;
            FileHelper::createDirectory($pathDir, $mode = 0775, $recursive = true);
            $fileName = 'mortgage_file_'.$this->id . '.' . $this->mortgage_file->extension;
            $this->mortgage_file->saveAs($pathDir. '/'.$fileName);
            $this->mortgage_file = $fileName;
        }
        return true;
    }
}
