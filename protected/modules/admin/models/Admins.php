<?php
/**
 * Модель Admin
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 */
class Admins extends CActiveRecord 
{

    public $roles = array();

    public function __construct(){
        $this->roles = array(
                            'root' => Yii::t('adminModule.app','Рут'),
                            'moderator' => Yii::t('adminModule.app','Модератор'),
                            'user' => Yii::t('adminModule.app','Пользователь'),
                        );
        parent::__construct();
    }
 
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('login, password, name, role', 'required'),
            array('login', 'unique', 'message'=>'Запись с таким логином уже существует.'),
            array('login, password, name, role', 'length', 'max'=>255),
            array('status', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, login, name, role', 'safe', 'on'=>'search'),
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
            'login' => Yii::t('adminModule.app','Логин'),
            'password' => Yii::t('adminModule.app','Пароль'),
            'name' => Yii::t('adminModule.app','Имя'),
            'role' => Yii::t('adminModule.app','Роль'),
            'status' => Yii::t('adminModule.app','Вкл.'),
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

        $criteria->compare('id',$this->id);
        $criteria->compare('login',$this->login,true);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('role',$this->role,true);

        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }
 
    public function tableName()
    {
        return Yii::app()->db->tablePrefix.'admins';
    }

    protected function beforeSave() 
    {
        $this->password = crypt($this->password, md5($this->password));
        return parent::beforeSave();
    }
}