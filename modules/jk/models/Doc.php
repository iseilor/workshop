<?php

namespace app\modules\jk\models;

use app\models\Model;
use Yii;

/**
 * This is the model class for table "jk_doc".
 *
 * @property int $id
 * @property string $created_at
 * @property int $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 * @property string|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $description
 * @property string $src
 */
class Doc extends Model
{
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jk_doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],


            [['file'], 'file', 'extensions'=>'doc,docx,pdf,xls,xlsx,txt','checkExtensionByMimeType'=>false],
            [['file'], 'file', 'maxSize'=>'2048000'],
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
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'src' => Yii::t('app', 'Src'),
            'file' => Yii::t('app', 'File'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return DocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocQuery(get_called_class());
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->file->saveAs(Yii::$app->params['module']['jk']['doc']['filePath'].$this->id . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
