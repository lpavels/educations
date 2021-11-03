<?php

namespace common\models;


use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property int $theme_training_program_id Тема обучающей программы (метка новости)
 * @property int $news_category_id Категория новости (ютуб, важно, новость)
 * @property string $theme Тема новости
 * @property string $small_text Краткая новость
 * @property string $full_text Полная новость
 * @property int $sequence_number Порядковый номер новости
 * @property int $status 0-не отображается, 1 - отображается
 * @property string $created_at
 * @property string|null $updated_at
 *
 * @property NewsAccess[] $newsAccesses
 * @property NewsCategory $newsCategogy
 * @property ThemeTrainingProgram $themeTrainingProgram
 */
class News extends \yii\db\ActiveRecord
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
            [['theme_training_program_id', 'news_category_id', 'theme', 'small_text', 'full_text'], 'required'],
            [['theme_training_program_id', 'news_category_id', 'sequence_number', 'status'], 'integer'],
            [['full_text'], 'string'],
            [['sequence_number', 'created_at', 'updated_at'], 'safe'],
            [['theme', 'small_text'], 'string', 'max' => 255],
            [['small_text'], 'unique'],
            [['full_text'], 'unique'],
            [
                ['news_category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => NewsCategory::className(),
                'targetAttribute' => ['news_category_id' => 'id']
            ],
            [
                ['theme_training_program_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => ThemeTrainingProgram::className(),
                'targetAttribute' => ['theme_training_program_id' => 'id']
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $news = News::find()->orderBy(['sequence_number' => SORT_DESC])->one();

            $this->sequence_number = $news->sequence_number + 1; #порядковый номер новости

            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'theme_training_program_id' => 'Тема обучающей программы (ID)',
            'news_category_id' => 'Категория новости (ID)',
            'theme' => 'Тема новости',
            'small_text' => 'Текст краткой новости',
            'full_text' => 'Текст полной новости',
            'sequence_number' => 'Порядковый номер новости',
            'status' => 'Статус',
            'created_at' => 'Дата добавления',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[NewsAccesses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsAccesses()
    {
        return $this->hasMany(NewsAccess::className(), ['news_id' => 'id']);
    }

    /**
     * Gets query for [[NewsCategogy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNewsCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'news_category_id']);
    }

    /**
     * Gets query for [[ThemeTrainingProgram]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getThemeTrainingProgram()
    {
        return $this->hasOne(ThemeTrainingProgram::className(), ['id' => 'theme_training_program_id']);
    }

    public function getThemeTrainingPrograms($id = null) #Вывод темы обучающей программы или массив для её выбора
    {
        if (!isset($id)) {
            $newsCategory = ArrayHelper::map(ThemeTrainingProgram::find()->all(), 'id', 'name');
        } else {
            $newsCategory = ThemeTrainingProgram::findOne($id)->name;
        }

        return $newsCategory;
    }

    public function getNewsCategorys($id = null) #Вывод категории новости или массив для её выбора
    {
        if (!isset($id)) {
            $newsCategory = ArrayHelper::map(NewsCategory::find()->all(), 'id', 'name');
        } else {
            $newsCategory = NewsCategory::findOne($id)->name;
        }

        return $newsCategory;
    }
}
