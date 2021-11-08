<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "theme_training_program".
 *
 * @property int $id
 * @property string $name Название темы обучения
 * @property string $created_at
 *
 * @property News[] $news
 * @property TrainingProgram[] $trainingPrograms
 */
class ThemeTrainingProgram extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'theme_training_program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['created_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название темы',
            'created_at' => 'Дата добавления',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['theme_training_program_id' => 'id']);
    }

    /**
     * Gets query for [[TrainingPrograms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTrainingPrograms()
    {
        return $this->hasMany(TrainingProgram::className(), ['theme_training_program_id' => 'id']);
    }

}
