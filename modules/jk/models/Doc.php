<?php

namespace app\modules\jk\models;

use app\models\Model;
use app\modules\jk\Module;
use kartik\icons\Icon;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\UploadedFile;

/**
 * This is the model class for table "jk_doc".
 *
 * @property int         $id
 * @property string      $created_at
 * @property int         $created_by
 * @property string|null $updated_at
 * @property int|null    $updated_by
 * @property string|null $deleted_at
 * @property int|null    $deleted_by
 * @property string      $title
 * @property string      $description
 * @property string      $src
 * @property int         $weight
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
            [['title', 'description', 'weight'], 'required'],
            [['weight'], 'integer'],
            [['description'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['file'], 'file', 'extensions' => 'doc,docx,pdf,xls,xlsx', 'checkExtensionByMimeType' => false],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'title' => Module::t('doc', 'Title'),
                'description' => Module::t('doc', 'Description'),
                'src' => Module::t('doc', 'Src'),
                'file' => Module::t('doc', 'File'),
                'filePathLink' => Module::t('doc', 'File'),
                'weight' => Module::t('doc', 'Weight'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return DocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DocQuery(get_called_class());
    }


    /**
     * Загрузка файлов
     *
     * @return bool
     */
    public function upload()
    {
        $this->file = UploadedFile::getInstance($this, 'file');
        if ($this->validate() && $this->file) {
            $this->file->saveAs(Yii::$app->params['module']['jk']['doc']['filePath'] . $this->id . '.' . $this->file->extension);
            $this->src = $this->id . '.' . $this->file->extension;
            $this->save();
            return true;
        } else {
            return false;
        }
    }


    /**
     * Максимальный вес элемента
     *
     * @return mixed
     */
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }


    /**
     * Полный путь до файла для скачивани
     *
     * @return string
     */
    public function getFilePath()
    {
        return '/' . Yii::$app->params['module']['jk']['doc']['filePath'] . $this->src;
    }

    /**
     * Ссылка для скачивания файла
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getFilePathLink()
    {
        return Html::a(Icon::show('download') . Module::t('doc', 'Download'), [$this->getFilePath()], ['data-pjax' => 0, 'id' => 'doc-' . $this->id]);

    }
}