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
	public $selection_home;
	public $selection_visitor;
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
			array( 'name', 'required' ),
			array('score_home, score_visitor, created', 'numerical', 'integerOnly'=>true),
			array('name, players_home, players_visitor', 'length', 'max'=>255),
			array('details', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, players_home, players_visitor, score_home, score_visitor, details, created', 'safe', 'on'=>'search'),
			array('selection_home,selection_visitor', 'safe' ),
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
            /*
            'homeScore' => array( self::STAT, 'Game', 'score_home' ),
            'visitorScore' => array( self::STAT, 'Game', 'score_visitor', 'select' => 'SUM(score_visitor)' ),
            */
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
	
	/**
	 *
	 */
	public function beforeValidate()
	{
		// TODO we have to make sure that all the players are real, before saving anything ...
		if( is_array( $this->selection_home ) )
		{
			$this->players_home 	=  implode( ',', $this->selection_home );

			// we have to update the team members' WIN column
			foreach( $this->selection_home as $home_player_id )
			{
				$player = Player::model()->findByPk( $home_player_id );
				if( $player )
				{
					if( (int)$this->score_home > (int)$this->score_visitor )
					{
						$player->won = $player->won+1;
					}
					elseif( (int)$this->score_home < (int)$this->score_visitor )
					{
						$player->lost = $player->lost+1;
					}

					$player->save( false );
				}
			}
		}
		else
		{
			$this->addError( 'selection_home', 'Select at least 1 player from the HOME team' );
		}

		if( is_array( $this->selection_visitor ) )
		{
			$this->players_visitor 	=  implode( ',', $this->selection_visitor );

			// we have to update the team members' WIN column
			foreach( $this->selection_visitor as $visitor_player_id )
			{
				$player = Player::model()->findByPk( $visitor_player_id );
				if( $player )
				{
					if( (int)$this->score_visitor > (int)$this->score_home )
					{
						$player->won = $player->won+1;
					}
					elseif( (int)$this->score_visitor < (int)$this->score_home )
					{
						$player->lost = $player->lost+1;
					}
					$player->save( false );
				}
			}
		}
		else
		{
			$this->addError( 'selection_visitor', 'Select at least 1 player from the VISITOR team' );
		}


		return parent::beforeValidate();
	}

	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->created = time();
		}

		return parent::beforeSave();
	}
}
