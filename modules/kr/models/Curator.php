<?php

namespace app\modules\kr\models;

use app\models\Model;
use app\modules\kr\Module;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "kr_curator".
 *
 * @property int      $id
 * @property int      $created_at
 * @property int      $created_by
 * @property int|null $updated_at
 * @property int|null $updated_by
 * @property int|null $deleted_at
 * @property int|null $deleted_by
 * @property string   $fio
 * @property string   $position
 * @property string   $description
 * @property string   $phone
 * @property string   $email
 * @property string   $img
 * @property int      $weight
 * @property int      $block_id
 */
class Curator extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kr_curator';
    }

    public $img_form;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'position', 'description', 'weight', 'block_id','img'], 'required'],
            [['weight', 'block_id'], 'integer'],
            ['email', 'email'],
            [['description'], 'string'],
            [[ 'email'], 'email'],
            [['fio', 'position', 'phone', 'img'], 'string', 'max' => 255],
            [['img_form'], 'file', 'extensions' => 'jpg,png', 'checkExtensionByMimeType' => false],
            [['img_form'], 'file', 'maxSize' => '2097152'],
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
                'fio' => Module::t('curator', 'Fio'),
                'position' => Module::t('curator', 'Position'),
                'description' => Module::t('curator', 'Description'),
                'phone' => Module::t('curator', 'Phone'),
                'email' => Module::t('curator', 'Email'),
                'img' => Module::t('curator', 'Img'),
                'img_form' => Module::t('curator', 'Img'),
                'weight' => Module::t('curator', 'Weight'),
                'block_id' => Module::t('curator', 'Block ID'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     * @return CuratorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CuratorQuery(get_called_class());
    }


    // Загрузка фотографии
    public function upload()
    {
        $this->img_form = UploadedFile::getInstance($this, 'img_form');
        if ($this->validate() && $this->img_form) {
            $this->img_form->saveAs(Yii::$app->params['module']['kr']['curator']['path'] . $this->id . '.' . $this->img_form->extension);
            $this->img = $this->id . '.' . $this->img_form->extension;
            $this->save();
            return true;
        } else {
            return false;
        }
    }

    // Максимальный вес для сотрировки
    public static function getMaxWeight()
    {
        return self::find()->max('weight');
    }
}