<?php

class Pages extends CActiveRecord 
{
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent, name, url', 'required'),
            array('body', 'safe'),
            array('status', 'safe'),
            array('reiting', 'numerical'),
            array('url', 'unique', 'message'=>'Страница с таким адресом уже существует.'),
            array('url', 'match', 'pattern' => '/^[0-9A-Za-z-_]+$/', 'message' => 'Поле содержит недопустимые символы.'),
            array('name, url, controller, meta_title, meta_description, meta_keywords', 'length', 'max'=>255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, name, url', 'safe', 'on'=>'search'),
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
            'parent' => Yii::t('adminModule.app','Предок'),
            'name' => Yii::t('adminModule.app','Название'),
            'url' => Yii::t('adminModule.app','Адрес страницы'),
            'body' => Yii::t('adminModule.app','Содержание'),
            'controller' => Yii::t('adminModule.app','Контроллер'),
            'meta_title' => Yii::t('adminModule.app','META-заголовок'),
            'meta_description' => Yii::t('adminModule.app','META-описание'),
            'meta_keywords' => Yii::t('adminModule.app','META-ключевые слова'),
            'reiting' => Yii::t('adminModule.app','Рейтинг страницы'),
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
        return Yii::app()->db->tablePrefix.'pages';
    }

    /**
    * @var $except is $val->id of element that should be unset from tree array  
    */
    public function getTree($except = null){
        $tree = array();
        foreach ($this->findAll(array('order'=>'reiting DESC')) as $val) {
            $tree[$val->parent][$val->id] = $val->name;
        }
        return $tree;
    }

    public function getTreeActive(){
        $tree = array();
        foreach ($this->findAll() as $val) {
            $tree[$val->id] = $val->status;
        }
        return $tree;
    }

    public function getControllers(){
        $controllersList[''] = '';

        if ($handle = opendir(Yii::app()->getBasePath().'/controllers/')) 
        {
            while (false !== ($file = readdir($handle))) 
            { 
                if ($file != "." && $file != "..")
                {
                    $name = explode('.', $file);
                    $controllerName = $name[0];
                    $controllerShortName = strtolower(str_replace('Controller', '', $controllerName));

                    //PageController by default. don't show it in list
                    if ($controllerName != 'PageController')
                    {
                        Yii::import('application.controllers.'.$controllerName);
                        $controller = new $controllerName($controllerName);
                        if (isset($controller->controllerName))
                            $controllersList[$controllerShortName] = $controller->controllerName;
                        else
                            $controllersList[$controllerShortName] = $controllerName;
                    }
                }       
            }
            closedir($handle); 
        }

        return $controllersList;
    }


    // protected function beforeSave() 
    // {
    //     return parent::beforeSave();
    // }

    
}