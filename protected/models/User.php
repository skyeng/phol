<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $nicname
 * @property string $password
 * @property string $email
 * @property string $mobile
 * @property string $skype
 * @property string $gender
 * @property string $country
 * @property string $city
 * @property string $birth
 * @property integer $privacy
 * @property integer $classes
 * @property integer $UTC
 * @property string $vk_page
 * @property string $identity
 * @property string $network
 * @property string $full_name
 * @property integer $state
 * @property string $role
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('identity, network', 'required'),
			array('privacy, classes, UTC, state', 'numerical', 'integerOnly'=>true),
			array('name, nicname, skype', 'length', 'max'=>30),
			array('surname, password, vk_page', 'length', 'max'=>40),
			array('email, identity, network, full_name', 'length', 'max'=>255),
			array('mobile, country, city', 'length', 'max'=>20),
			array('gender', 'length', 'max'=>1),
			array('role', 'length', 'max'=>15),
			array('birth', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, surname, nicname, password, email, mobile, skype, gender, country, city, birth, privacy, classes, UTC, vk_page, identity, network, full_name, state, role', 'safe', 'on'=>'search'),
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
			'surname' => 'Surname',
			'nicname' => 'Nicname',
			'password' => 'Password',
			'email' => 'Email',
			'mobile' => 'Mobile',
			'skype' => 'Skype',
			'gender' => 'Gender',
			'country' => 'Country',
			'city' => 'City',
			'birth' => 'Birth',
			'privacy' => 'Privacy',
			'classes' => 'Classes',
			'UTC' => 'Utc',
			'vk_page' => 'Vk Page',
			'identity' => 'Identity',
			'network' => 'Network',
			'full_name' => 'Full Name',
			'state' => 'State',
			'role' => 'Role',
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
		$criteria->compare('surname',$this->surname,true);
		$criteria->compare('nicname',$this->nicname,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('birth',$this->birth,true);
		$criteria->compare('privacy',$this->privacy);
		$criteria->compare('classes',$this->classes);
		$criteria->compare('UTC',$this->UTC);
		$criteria->compare('vk_page',$this->vk_page,true);
		$criteria->compare('identity',$this->identity,true);
		$criteria->compare('network',$this->network,true);
		$criteria->compare('full_name',$this->full_name,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('role',$this->role,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}