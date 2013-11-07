<?php
/**
 * Tutorials comments model
 */
class TutorialsComments extends CActiveRecord
{		
	/**
	 * @return object
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string Table name
	 */
	public function tableName()
	{
		return '{{tutorialscomments}}';
	}
	
	/**
	 * Relations
	 */
	public function relations()
	{
		return array(
		    'tutorial' => array(self::BELONGS_TO, 'Tutorials', 'tutorialid'),
			'author' => array(self::BELONGS_TO, 'Members', 'authorid'),
		);
	}
	
	/**
	 * Attribute values
	 *
	 * @return array
	 */
	public function attributeLabels()
	{
		return array(
			'comment' => Yii::t('tutorials', 'Comment'),
		);
	}
	
	/**
	 * Before save operations
	 */
	public function beforeSave()
	{
		if( $this->isNewRecord )
		{
			$this->postdate = time();
			$this->authorid = Yii::app()->user->id;
		}
		
		return parent::beforeSave();
	}
	
	/**
	 * Scopes
	 */
	public function scopes()
	{
		return array(
					'orderDate'=>array(
		                'order'=>'postdate DESC',
		            ),
		        );
	}
	
	/**
	 * table data rules
	 *
	 * @return array
	 */
	public function rules()
	{
		return array(
			array('comment', 'required' ),
		);
	}
}