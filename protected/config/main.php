<?php
// Sort cache options
$caches = array();
$fastCache = true;

// Sort the type of cache to use
if( function_exists('xcache_isset') )
{
    // Using XCache
    $caches = array( 'class' => 'CXCache' );
}
else if( extension_loaded('apc') )
{
    // Using APC
    $caches = array( 'class' => 'CApcCache' );
}
else if( function_exists('eaccelerator_get') )
{
    // Using Eaccelerator
    $caches = array( 'class' => 'CEAcceleratorCache' );
}
else if( function_exists('zend_shm_cache_store') )
{
    // Using ZendDataCache
    $caches = array( 'class' => 'CZendDataCache' );
}
else
{
    // Using File Cache - fallback
    $caches = array( 'class' => 'CFileCache' );
    $fastCache = false;
}

// Current active domain
$current_domain = CURRENT_ACTIVE_DOMAIN;

// Required system configuration. There should be no edit performed here.
return array(
        'preload' => array('log', 'session', 'db', 'cache'),
        'basePath' => ROOT_PATH . 'protected/',
        'modules' => array(
                            'admin' => array(
                                                'import' => array('admin.components.*'),
                                                'layout' => 'main'
                                            ),
                            'site' => array(
                                                'import' => array('site.components.*'),
                                                'layout' => 'main'
                                            ),
        ),
        'import' => array(
                            'application.components.*',
                            'application.models.*',
                            'application.extensions.*',
        ),
        'theme' => 'default',
        'name' => 'Yii CMS',
        'defaultController' => 'site/index',
        'layout' => 'main',
        'charset'=>'UTF-8',
        'sourceLanguage' => 'en',
        'language' => 'en',
        'params' => array( 
							'fastcache' => $fastCache, 
							'languages' => array( 'en' => 'English', 'he' => 'Hebrew' ),
							'subdomain_languages' => false,
							'loggedInDays' => 10,
							'current_domain' => $current_domain,
							'default_group' => 'user',
							'facebookappid' => 'XXXXX',
							'facebookapikey' => 'XXXXX',
							'facebookapisecret' => 'XXXXX',
							'emailin' => 'admin@admin.com',
							'emailout' => 'admin@admin.com',
							 ),
        'aliases' => array(
                'helpers' => 'application.widgets',
                'widgets' => 'application.widgets',
        ),
        'components' => array(
                'format' => array(
                        'class' => 'CFormatter',
              	 ),
				'email' => array(
	                    'class' => 'application.extensions.email.Email',
	                    'view' => 'email',
	                    'viewVars' => array(),
	                    'layout' => 'main',
	            ),
				'func' => array(
	                    'class' => 'application.components.Functions',
	            ),
				'errorHandler'=>array(
			            'errorAction'=>'site/error/error',
			    ),
				'settings' => array(
	                    'class' => 'XSettings',
	            ),
				'authManager'=>array(
				            'class'=>'AuthManager',
				            'connectionID'=>'db',
							'itemTable' => 'authitem',
							'itemChildTable' => 'authitemchild',
							'assignmentTable' => 'authassignment',
							'defaultRoles'=>array('guest'),
				),
				'user'  => array(
						'class' => 'CustomWebUser',
						'allowAutoLogin' => true,
						'autoRenewCookie' => true,
				),
                'messages' => array(
                        'class' => 'CDbMessageSource',
                        'cacheID' => 'cache',
                ),
                'urlManager' => array(
                        'class' => 'CustomUrlManager',
                        'urlFormat' => 'path',
                        'cacheID' => 'cache',
                        'showScriptName' => false,
                        'appendParams' => true,
                        'urlSuffix' => ''
                ),
                'request' => array(
                        'class' => 'CHttpRequest',
                        'enableCookieValidation' => true,
                        'enableCsrfValidation' => !isset($_POST['dontvalidate']) ? true : false,
                        'csrfTokenName' => 'SECTOKEN',
                ),
                'session' =>  array(
					'class' => 'CDbHttpSession',
					'sessionTableName' => 'sessions',
					'connectionID' => 'db',
                    'timeout' => 3600,
                    'sessionName' => 'SECSESS',

                ),
                'cache' => $caches,
        ),
);
