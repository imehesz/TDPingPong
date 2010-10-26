<?php

/**
 * This is the model class for table "games".
 *
 * The followings are the available columns in table 'games':
 * @property integer $id
 * @property string $name
 * @property string $players_home
 * @property string $players_visitor
 * @property integer $score_home
 * @property integer $score_visitor
 * @property string $details
 * @property integer $created
 *
 * The followings are the available model relations:
 */
class Game extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Game the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'games';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('score_home, score_visitor, created', 'numerical', 'integerOnly'=>true),
			array('name, players_home, players_visitor', 'length', 'max'=>255),
			array('details', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, players_home, players_visitor, score_home, score_visitor, details, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'players_home' => 'Players Home',
			'players_visitor' => 'Players Visitor',
			'score_home' => 'Score Home',
			'score_visitor' => 'Score Visitor',
			'details' => 'Details',
			'created' => 'Created',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('players_home',$this->players_home,true);
		$criteria->compare('players_visitor',$this->players_visitor,true);
		$criteria->compare('score_home',$this->score_home);
		$criteria->compare('score_visitor',$this->score_visitor);
		$criteria->compare('details',$this->details,true);
		$criteria->compare('created',$this->created);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}