<?php

namespace app\modules\news\models;

use app\models\Model;
use Yii;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $created_at
 * @property int $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string $title
 * @property string $img
 * @property string $description
 * @property string $annotation
 * @property string $text
 */
class News extends Model
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'annotation', 'text'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'deleted_at', 'deleted_by'], 'integer'],
            [['description', 'annotation', 'text'], 'string'],
            [['title', 'img'], 'string', 'max' => 255],

            [['img'], 'safe'],
            [['img'], 'file', 'extensions'=>Yii::$app->params['file']['img']['extensions']],
            [['img'], 'file', 'maxSize'=>'2048000'],
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
            'img' => Yii::t('app', 'Img'),
            'description' => Yii::t('app', 'Description'),
            'annotation' => Yii::t('app', 'Annotation'),
            'text' => Yii::t('app', 'Text'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return NewsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsQuery(get_called_class());
    }

    public function upload(){
        $this->img = UploadedFile::getInstance($this, 'img');
        if ($this->img){
            $dirPath = Yii::$app->params['module']['news']['path'].$this->id;
            $date = date('YmdHis');
            $fileThumbName = $this->id .'_thumb_'.$date. '.' . $this->img->extension;
            $fileOrigName = $this->id .'_orig_'.$date. '.' . $this->img->extension;
            FileHelper::createDirectory( $dirPath, $mode = 0777, $recursive = true);
            $this->img->saveAs($dirPath. '/'.$fileOrigName);
            Image::thumbnail($dirPath.'/'.$fileOrigName, 400, 300)
                ->save(Yii::getAlias($dirPath.'/'. $fileThumbName), ['quality' => 100]);
            $this->img = $fileThumbName;
            $this->save();
        }
    }
}
