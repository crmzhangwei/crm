<?php

class SiteController extends GController
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}
        /**
         * 修改密码
         */
        public function actionUpdatePW()
        {
            $model = Users::model()->findByPk(Yii::app()->user->id);
            if(isset($_POST['Users']))
            {
                        if ($model->pass !== $model->encrypt($_POST['Users']['pass'])) {
                           $model->addError('pass', '旧密码不正确');
                        }else
                        {
                            $model->pass = $model->encrypt($_POST['Users']['newpass']);
                        }
			if(!$model->getErrors() && $model->save())
                        {
                             Utils::showMsg (1, '密码修改成功!');
                        } 
                        else
                        {
                            $error = $model->getErrors();
                            $error = current($error);
                            Utils::showMsg (0, "$error[0]");
                        }
                     Yii::app()->end;	
            }
            $model->pass = '';
            $this->renderPartial('UpdatePW',array('model'=>$model));
        }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->renderpartial('loginview',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
         /**
     * 403处理页面
     */
    public function actionForbidden() {
        header("http/1.1 403 Forbidden");
        
        $boss = '';
       // $boss = $this->userInfo['bossname'];
        $bossname = $boss == '' ? '管理员' : '您的上级（'. $boss .'）';
        $error = array(
            'code' => '403',
            'message' => '您未被授权访问此页面，请联系'.$bossname.'申请权限.'
        );
        if (Yii::app()->request->isAjaxRequest)
            echo $error['message'];
        else
            $this->render('forbidden', $error);
    }
}