<?php

/**
 * This is the model class for table "players".
 *
 * The followings are the available columns in table 'players':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $photo
 * @property integer $won
 * @property integer $lost
 * @property integer $created
 * @property integer $updated
 *
 * The followings are the available model relations:
 */
class Player extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Player the static model class
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
		return 'players';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array( 'name,email', 'required' ),
			array('won, lost, created, updated', 'numerical', 'integerOnly'=>true),
			array('name, email, photo', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, photo, won, lost, created, updated', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'photo' => 'Photo',
			'won' => 'Won',
			'lost' => 'Lost',
			'created' => 'Created',
			'updated' => 'Updated',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('photo',$this->photo,true);
		$criteria->compare('won',$this->won);
		$criteria->compare('lost',$this->lost);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

    public function beforeSave()
    {
        $timestamp = time();
        
        if( $this->isNewRecord )
        {
            $this->created = $timestamp;
        }

        $this->updated = $timestamp;

        if ( ! is_numeric( $this->won ) )   { $this->won    = 0;  }
        if ( ! is_numeric( $this->lost ) )  { $this->lost   = 0;  }

        // code...
        return parent::beforeSave();
    }

    public function getPlayerList()
    {
        $players = $this->findAll( 'created <> 0 ORDER BY name' );

        $retval = array();

        foreach( $players as $player )
        {
            $retval[$player->id] = $player->name; 
        }

        return $retval;
        // code...
    }
}
