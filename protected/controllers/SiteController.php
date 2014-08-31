<?php

class SiteController extends Controller
{
	public $layout='//layouts/column2';
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
		$u = Yii::app()->user;
		if ($u->isGuest) {
			$this->redirect(array('login'));
		} else {
			$params = array();
			if ($u->checkAccess('ProvAdm')) {
				$m = $u->profile->member;
				$title = 'Generalate Admin: Member listing of entire congregation (all Groups)..';
				if (!$u->checkAccess('Admin')) {
					$pname = $m->province->name;
					$title = "You're a Group Admin for $pname Group. Member listing for your Group..";
					$params['criteria'] = array(
						'condition' => "province_id = " . $m->province_id
					);
				}
				$provider = new CActiveDataProvider('Members', $params);
				$this->render('index', array(
					'title'=>$title,
					'provider'=>$provider
				));
			} else {
				$this->redirect(array('/members/selfView'));
			}
		}
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
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

        public function actionChangePassword()
        {
            $model = new ChangePasswordForm;
            if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
            {
              echo CActiveForm::validate($model);
              Yii::app()->end();
            }

            // collect user input data
            if(isset($_POST['ChangePasswordForm']))
            {
              $model->attributes=$_POST['ChangePasswordForm'];
              // Validate input of the user
              if($model->validate() && $model->changePassword())
              {
		      Yii::trace("Site/changePassword invoked ChangePasswordForm.changePassword", "application.controllers.SiteController");
               Yii::app()->user->setFlash('success', '<strong>Success!</strong> Password changed successfully.');
               $this->redirect(array('index'));
              }
            }
            $this->render('changePassword',array('model'=>$model));
        }
}
