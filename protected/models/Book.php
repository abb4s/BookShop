<?php

/**
 * This is the model class for table "book".
 *
 * The followings are the available columns in table 'book':
 * @property integer $id
 * @property integer $owner_id
 * @property string $name
 * @property string $author
 * @property integer $pages
 *
 * The followings are the available model relations:
 * @property User $owner
 * @property Category[] $categories
 * @property User[] $users
 */
class Book extends CActiveRecord
{
    public $user_id_for_wanted;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'book';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('owner_id, name', 'required'),
			array('owner_id, pages', 'numerical', 'integerOnly'=>true),
			array('name, author', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, owner_id, name, author, pages', 'safe', 'on'=>'search'),
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
			'owner' => array(self::BELONGS_TO, 'User', 'owner_id'),
			'categories' => array(self::MANY_MANY, 'Category', 'book_category(book_id, category_id)'),
            'book_category'=>array(self::HAS_MANY, 'BookCategory','book_id'),
			'users' => array(self::MANY_MANY, 'User', 'wanted_list(book_id, users_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'owner_id' => 'Owner',
			'name' => 'Name',
			'author' => 'Author',
			'pages' => 'Pages',

		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
        $criteria->with=array(
            'users'=>array(
                'alias'=>'abc',
            ),
        );
        $criteria->together=true;
        $criteria->group = 't.id';
        $criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
        $criteria->compare('owner_id',$this->owner_id,false);
        $criteria->compare('abc.id',$this->user_id_for_wanted,false);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
