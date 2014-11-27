<?php

class News extends CActiveRecord 
{
    public $img;

    public function __construct(){
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
            array('name, alias', 'required'),
            array('name, alias, author', 'length', 'max'=>255),
            array('status, body, tags, alias, sdate, popular, media, intro', 'safe'),
            array('img', 'imageValidate',
                    'types'=>array('jpg', 'jpeg', 'gif', 'png'), 
                    'mimeTypes' => array('image/jpeg', 'image/png', 'image/gif'),
                    'maxWidth'=>800,
                    'maxHeight'=>800,
                    'postFieldName'=>'image', // Form field
                 ),
            // The following rule is used by search().
            array('id, name, tags, alias', 'safe', 'on'=>'search'),
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
            'name' => Yii::t('adminModule.app','Название'),
            'alias' => Yii::t('adminModule.app','Алиас'),
            'media' => Yii::t('adminModule.app','Медиа контент'),
            'intro' => Yii::t('adminModule.app','Интро'),
            'body' => Yii::t('adminModule.app','Текст'),
            'sdate' => Yii::t('adminModule.app','Дата'),
            'img' => Yii::t('adminModule.app','Изображение'),
            'tags' => Yii::t('adminModule.app','Теги'),
            'author' => Yii::t('adminModule.app','Автор'),
            'popular' => Yii::t('adminModule.app','Популярно'),
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
        $criteria->compare('name',$this->name,true);
        $criteria->compare('tags',$this->name,true);
        $criteria->compare('alias',$this->name,true);

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
        return Yii::app()->db->tablePrefix.'news';
    }

    /**
     * delete Image from HDD
     */    
    public function delOldImgFile($image = null){
        if(is_file(Yii::app()->basePath . '/../uploads/' . strtolower(get_class($this)) . '/' . $image))
            unlink(Yii::app()->basePath . '/../uploads/' . strtolower(get_class($this)) . '/' . $image);
        return true;
    }

    /**
     * validate Image on upload
     */    
    public function imageValidate($attribute, $params)
    {
        if (isset($_FILES[get_class($this)]['tmp_name'][$params['postFieldName']]) 
            && 
            $_FILES[get_class($this)]['tmp_name'][$params['postFieldName']] != '')
        {
            $imagehw = getimagesize($_FILES[get_class($this)]['tmp_name']['image']);
            $imageWidth  = $imagehw[0];
            $imageHeight = $imagehw[1];
            $imageMType  = $imagehw['mime'];

            if (in_array($imageMType, $params['mimeTypes']))
            {
                if($imageWidth < $params['maxWidth'] || $imageHeight < $params['maxHeight'] )
                    return true;
                else
                    $this->addError($attribute, 'Размер больше '.$params['maxWidth'].'px * '.$params['maxHeight'].'px');
            }
            else
                $this->addError($attribute, 'Неверный формат файла');

            return false;
        }
    }

    // protected function beforeSave() 
    // {
    //     return parent::beforeSave();
    // }
}