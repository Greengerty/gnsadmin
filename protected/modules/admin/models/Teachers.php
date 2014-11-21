<?php
/**
 * Модель Admin
 *
 * @property integer $id
 * @property string $login
 * @property string $password
 * @property string $role
 */
class Teachers extends CActiveRecord 
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
            array('name', 'required'),
            array('name, position', 'length', 'max'=>255),
            array('status, body, tags, position', 'safe'),
            array('img', 'file', 
                  'types'=>'jpg, gif, png', 
                  'allowEmpty'=>true,
                  'maxSize'=>1024 * 1024 * 1, //1 MB
                  'tooLarge'=>Yii::t('adminModule.app','Файл весит больше 2 MB. Пожалуйста, загрузите файл меньшего размера.'),
                  ),
            // The following rule is used by search().
            array('id, name, tags, position', 'safe', 'on'=>'search'),
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
            'name' => Yii::t('adminModule.app','Имя'),
            'body' => Yii::t('adminModule.app','Информация'),
            'img' => Yii::t('adminModule.app','Изображение'),
            'position' => Yii::t('adminModule.app','Должность'),
            'tags' => Yii::t('adminModule.app','Теги'),
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
        $criteria->compare('position',$this->name,true);

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
        return Yii::app()->db->tablePrefix.'teachers';
    }

    public function delOldImg($model){
        if ($model->img != null)
        {
            try
            {
                unlink(Yii::app()->basePath . '/../uploads/' . strtolower(get_class($this)) . '/' . $model->img);
                $model->img = null;
            }
            catch (Exception $e) {
                return false;
            }        
        }
        return $model;
    }

    // protected function beforeSave() 
    // {
    //     $this->delOldImg();
    // }
}