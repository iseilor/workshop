<?php

namespace app\modules\pulsar\models;

use app\models\Model;
use app\modules\pulsar\Module;
use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "pulsar".
 *
 * @property int         $id
 * @property int         $created_at
 * @property int         $created_by
 * @property int|null    $updated_at
 * @property int|null    $updated_by
 * @property int|null    $deleted_at
 * @property int|null    $deleted_by
 * @property int         $health_value
 * @property int         $mood_value
 * @property int         $job_value
 * @property string|null $health_comment
 * @property string|null $mood_comment
 * @property string|null $job_comment
 */
class Pulsar extends Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pulsar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['health_value', 'mood_value', 'job_value'], 'required'],
            [
                [
                    'created_at',
                    'created_by',
                    'updated_at',
                    'updated_by',
                    'deleted_at',
                    'deleted_by',
                    'health_value',
                    'mood_value',
                    'job_value',
                ],
                'integer',
            ],
            [['health_comment', 'mood_comment', 'job_comment'], 'string', 'max' => 255],
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
            'health_value' => Module::t('module', 'Health'),
            'mood_value' => Module::t('module', 'Mood'),
            'job_value' => Module::t('module', 'Job'),
            'health_comment' => Module::t('module', 'Health Comment'),
            'mood_comment' => Module::t('module', 'Mood Comment'),
            'job_comment' => Module::t('module', 'Job Comment'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PulsarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PulsarQuery(get_called_class());
    }

    // Список сотрудников не проголосовавших в определённую дату и в определённом подразделении
    public static function usersNotVoted($department_id, $date)
    {
        // Выбираем тех, кто сегодня ещё не проголосовал
        $userIdsVoted = Pulsar::find()->select('created_by')
            ->where('created_at>=' . strtotime($date))
            ->groupBy('created_by')->asArray()->all();
        $userIds = [];
        foreach ($userIdsVoted as $item) {
            $userIds[] = $item['created_by'];
        }
        $whereNotIn = '';
        $usersVoted = []; // Никто ещё не проголосовал
        if (count($userIds)) {
            $whereNotIn = " and id NOT IN(" . implode(',', $userIds) . ")";
            $whereIn = " and id IN(" . implode(',', $userIds) . ")";
            $usersVoted = User::find()->where('department_id=' . $department_id . ' ' . $whereIn)->all();
        }
        $usersNotVoted = User::find()->select('id,fio')->where('department_id=' . $department_id . ' ' . $whereNotIn)
            ->orderBy('fio')->asArray()->all();

        return $usersNotVoted;
    }

    // Среднее значение по здоровью за определённую дату
    public static function getHealthAverage($date, $department_id)
    {
        return round(Pulsar::find()->where('pulsar.created_at>=' . strtotime($date) . ' and pulsar.created_at<=' . (strtotime($date) + 86400))
            ->leftJoin('user', 'pulsar.created_by = user.id')
            ->andWhere('user.department_id=' . $department_id)
            ->average('health_value'), 1);
    }

    // Среднее значение по настроению за определённую дату
    public static function getMoodAverage($date, $department_id)
    {
        return round(Pulsar::find()->where('pulsar.created_at>=' . strtotime($date) . ' and pulsar.created_at<=' . (strtotime($date) + 86400))
            ->leftJoin('user', 'pulsar.created_by = user.id')
            ->andWhere('user.department_id=' . $department_id)
            ->average('mood_value'), 1);
    }

    // Среднее значение по работоспособности за определённую дату
    public static function getJobAverage($date, $department_id)
    {
        return round(Pulsar::find()->where('pulsar.created_at>=' . strtotime($date) . ' and pulsar.created_at<=' . (strtotime($date) + 86400))
            ->leftJoin('user', 'pulsar.created_by = user.id')
            ->andWhere('user.department_id=' . $department_id)
            ->average('job_value'), 1);
    }

    // Получить средние значения всех параметрах за указанную дату
    public static function getAverageValue($date, $department_id)
    {
        $types = ['health', 'mood', 'job'];
        $data = [];
        foreach ($types as $type) {
            $data[$type] = round(Pulsar::find()->where('pulsar.created_at>=' . strtotime($date) . ' and pulsar.created_at<=' . (strtotime($date) + 86400))
                ->leftJoin('user', 'pulsar.created_by = user.id')
                ->andWhere('user.department_id=' . $department_id)
                ->average($type . '_value'), 1);
        }
        return $data;
    }

    // Разбивка по значениям за конкретную дату и конкретного подразделения
    public static function getDataValue($date, $department_id)
    {
        $types = ['health', 'mood', 'job'];
        $data = [];
        foreach ($types as $type) {
            $values = Pulsar::find()->select('count(*) as cnt, '.$type.'_value')
                ->where('pulsar.created_at>=' . strtotime($date) . ' and pulsar.created_at<=' . (strtotime($date) + 86400))
                ->leftJoin('user', 'pulsar.created_by = user.id')
                ->andWhere('user.department_id=' . $department_id)
                ->groupBy($type . '_value')
                ->asArray()->all();
            $dat = [0, 0, 0, 0, 0];
            foreach ($values as $value) {
                $dat[$value[$type.'_value'] - 1] = intval($value['cnt']);
            }
            $data[$type] = $dat;
        }
        return $data;
    }


}