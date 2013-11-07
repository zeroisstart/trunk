<?php
/**
 * Source message model
 */
class SourceMessage extends CActiveRecord
{
	/**
	 * @return SourceMessage
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
		return '{{SourceMessage}}';
	}
}