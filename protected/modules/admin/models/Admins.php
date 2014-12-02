<?php

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
        /* SORT PART */
        $sort = new CSort;
        $sort->defaultOrder = array(
            'id'=>CSort::SORT_DESC,
        );        

        /* SEARCH PART */
        $searchColumns = array(
            'id',
            'login',
            'name',
            'role',
        );

        $criteria = new CDbCriteria;
        if(isset($_GET['search'])){
            $criteria->condition = '';
            $i = 0;
            foreach ($searchColumns as $column)
            {
                if($i == 0)
                    $criteria->condition = $column.' LIKE :'.$column.' ';                
                else
                    $criteria->condition .= ' OR '.$column.' LIKE :'.$column.' ';                

                $criteria->params[':'.$column] = '%'.$_GET['search'].'%';
                $i++;
            }
        }

        return new CActiveDataProvider($this, array(
            'pagination'=>array('pageSize'=>10),
            'criteria'=>$criteria,
            'sort'=>$sort,
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