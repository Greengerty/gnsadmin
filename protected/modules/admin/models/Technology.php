<?php

class Technology extends CActiveRecord 
{
    public function __construct(){
        parent::__construct();
    }

    public function tableName()
    {
        return Yii::app()->db->tablePrefix.'technology';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, alias', 'required'),
            array('status, courses', 'safe'),
            // The following rule is used by search().
            array('id, name, alias', 'safe', 'on'=>'search'),
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
            'courses' => array(self::MANY_MANY, 'Courses', 'gns_technology_course(id_technology, id_course)'),
            'path' => array(self::MANY_MANY, 'Path', 'gns_path_technology(id_technology, id_path)'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => Yii::t('adminModule.app','Название'),
            'alias' => Yii::t('adminModule.app','Алиас'),
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
        /* SEARCH PART */
        $searchColumns = array(
            'id',
            'name',
            'alias',
        );

        $criteria = new CDbCriteria;
        if (isset($_GET['search']))
        {
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

        /* SORT PART */
        $criteria->order = "id DESC"; //defalut order
        if (isset($_GET['sort']))
        {        
            if(isset($_GET['howsort']) && $_GET['howsort'] == 'asc')
                $criteria->order = $_GET['sort'].' ASC';
            else
                $criteria->order = $_GET['sort'].' DESC';
        }

        return new CActiveDataProvider($this, array(
            'pagination'=>array('pageSize'=>10),
            'criteria'=>$criteria,
        ));
    }

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * automatically save MANY_MANY relation objects when save()-ing an Object.
     * http://www.yiiframework.com/extension/cadvancedarbehavior/
    */
    public function behaviors()
    {
        return array( 'CAdvancedArBehavior' => array(
            'class' => 'application.extensions.CAdvancedArBehavior'));
    }

    protected function beforeSave() 
    {
        /* zero array courses */
        if (!isset($_POST[__CLASS__]['courses']) || count($_POST[__CLASS__]['courses']) == 0)
            $this->courses = array();

        return parent::beforeSave();
    }
}