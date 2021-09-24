<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;


class UsersSearch extends User
{
    public function rules()
    {
        return [
            [['id','auth_item_id','key_login','username','email','status','created_at'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = User::find();
        //$query->joinWith('personal_data', true, 'LEFT JOIN'); #this added

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50
            ]
        ]);

        $this->load($params);
        //$query->joinWith(['personal_data']);

        $query->andFilterWhere(['auth_item_id' => $this->auth_item_id])
            ->andFilterWhere(['like', 'key_login', $this->key_login])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['status' => $this->status])
            //->andFilterWhere(['region_id' => $this->region_id])
            //->andFilterWhere(['municipality_id' => $this->municipality_id])
            //->andFilterWhere(['like', 'key_login_departament', $this->key_login_departament])
        ;

        return $dataProvider;
    }
}
