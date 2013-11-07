<?php

class Message extends CActiveRecord
{
	/**
	 * @return Message
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
		return '{{Message}}';
	}
	
	/**
	 * Grab language names by their keys
	 */
	public function getLanguageNames($lang)
	{
		if( !$lang )
		{
			return Yii::t('global', 'All');
		}
		
		$names = array();
		
		foreach(explode(',', $lang) as $language)
		{
			$names[] = Yii::app()->params['languages'][ $language ];
		}
		
		return implode(', ', $names);
	}
}