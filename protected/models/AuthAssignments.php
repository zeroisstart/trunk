<?php
/**
 * auth item child model
 */
class AuthAssignments extends CActiveRecord
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
		return '{{authassignment}}';
	}	
}