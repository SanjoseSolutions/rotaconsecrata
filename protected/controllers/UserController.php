<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','activate','forgotPassword','resetPassword'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	public function actionForgotPassword()
	{
		if (isset($_POST['email'])) {
			$email = $_POST['email'];
			$model = Users::model()->findByAttributes(array(
				'email' => $email
			));
			if (!isset($model)) {
				Yii::app()->user->setFlash('error', 'Email address not found! Have you activated your account yet?');
				return;
			}
			
			$ucode = new UserCodes;
			$code = bin2hex(openssl_random_pseudo_bytes(3));
			$ucode->code = sha1($code);
			$ucode->purpose = 'resetPass';
			$ucode->data = $model->id;
			$ucode->created = date_format(new DateTime(), 'Y-m-d H:i:s');
			$url = Yii::app()->createAbsoluteUrl('/user/resetPassword', array('code'=>$code));
			if ($ucode->save()) {
				$msg = "Reset password link sent. Valid for 4 hours. Check your mail";
				Yii::app()->user->setFlash('notice', $msg);
				$appName = Yii::app()->name;
				$email = Yii::app()->email;
				$email->from = Yii::app()->params['adminEmail'];
				$email->type = 'text/plain';
				$email->to = $model->email;
				$email->subject = "$appName: Reset Password";
				$member = $model->member;
				$email->message = sprintf("Dear %s,\n\n".
					"This is an automatic email to reset your password. If you\n".
					"have sent this mail and want to reset your password, click\n".
					"the link below:\n\n".
					"\t%s\n\n".
					"This link will expire in 4 hours. If you're unable to login\n".
					"within this time, please retry resetting your password.\n\n".
					"Regards, $appName Admin.", $member->fullname, $url);
				$email->send();
				Yii::trace("$msg. Link: $url", 'application.controllers.UserController');
			} else {
				$errs = $ucode->getErrors();
				$earr = array();
				foreach($errs as $attr => $ea) {
					array_push($earr, "$attr : " . implode("; ", $ea));
				}
				throw new Exception(implode("\n", $earr));
			}
		}

		$this->render('forgot_password');
	}

	public function actionResetPassword($code)
	{
		$sha = sha1($code);
		$ucode = UserCodes::model()->find("code='$sha'");
		if (!isset($ucode)) {
			throw new CHttpException(403, "Access denied You are not allowed to access this page");
		}
		$expTime = new DateTime($ucode->created);
		Yii::trace("Exp:".$expTime->format('Y-m-d H:i:s'), 'application.controllers.UserController');
		$expTime->add(new DateInterval('PT4H'));
		$now = new DateTime();
		if ($now > $expTime) {
			Yii::trace("Now: ".$now->format('Y-m-d H:i:s').", Exp:".$expTime->format('Y-m-d H:i:s'), 'application.controllers.UserController');
			$ucode->delete();
			throw new CHttpException(403, "Access denied. This link has expired");
		}
		$id = $ucode->data;
		$model = new ResetPasswordForm();
		$model->setUser($id);
		$user = Users::model()->find("id=$id");
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form') 
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if(isset($_POST['ResetPasswordForm']))
		{
			$model->attributes = $_POST['ResetPasswordForm'];
			$username = $user->username;
			$pass = $model->newPassword;
			if($model->validate() && $model->changePassword())
			{
				$ident = new UserIdentity($username, $pass);
				if ($ident->authenticate()) {
					Yii::app()->user->login($ident);
					$ucode->delete();
					Yii::trace('Password reset success', 'application.controllers.UserController');
					Yii::app()->user->setFlash('success', "Password reset successful!! Password set. Proceed by clicking 'Home'");
				} else {
					$errs = $model->getErrors();
					throw new Exception("Failed to reset user password: " .
						implode("\n", array_map(function($k, $v) {
							return "$k: $v";
						}, array_keys($errs), $errs)));
				}
			}
/*			catch (Exception $e) {
				$err = "Password reset failed. " . $e->getMessage();
				Yii::app()->user->setFlash('error', $err);
				Yii::debug($err, 'application.controllers.UserController');
			}*/
		}

		$this->render('reset_password', array(
			'model' => $model,
			'user' => $user,
			'member' => $user->member,
		));
	}

	public function actionActivate($code)
	{
		$sha = sha1($code);
		$ucode = null;
		$ucode = UserCodes::model()->find("code='$sha'");
		if (!isset($ucode)) {
			throw new CHttpException(403, "Access denied. You are not allowed to access this page");
		}
		$expTime = new DateTime($ucode->created);
		$expTime->add(new DateInterval('P1D'));
		$now = new DateTime();
		if ($now > $expTime) {
			$ucode->delete();
			throw new CHttpException(403, "Access denied. This link has expired");
		}
		$mData = json_decode($ucode->data);
		$model = new Users;
		$model->email = $model->username = $mData->email;
		$model->member_id = $mData->id;
		$member = Members::model()->find("id=".$mData->id);

		if (Yii::app()->request->isPostRequest) {
			$model->attributes = $_POST['Users'];
			$pass = $model->password;

			$role = $mData->role;
			if ('Admin' == $role) $model->superuser = 1;

			try {
				if ($model->save()) {
					if (!empty($role)) {
						$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
						$authorizer->authManager->assign($role, $model->id);
					}

					$ident = new UserIdentity($model->username, $pass);
					$model->password = $pass;
					if ($ident->authenticate()) {
						Yii::app()->user->login($ident);
						$ucode->delete();
						Yii::trace('Activation success', 'application.controllers.UserController');
						Yii::app()->user->setFlash('msg', "Activation successful!! Password set. Proceed by clicking 'Home'");
					}
				} else {
					$errs = $model->getErrors();
					throw new Exception("Failed to save user: " .
						implode("\n", array_map(function($k, $v) {
							return "$k: $v";
						}, array_keys($errs), $errs)));
				}
			}
			catch (Exception $e) {
				$err = "Activation failed. " . $e->getMessage();
				Yii::app()->user->setFlash('err', $err);
				Yii::debug($err, 'application.controllers.UserController');
			}
		}

		$this->render('activate', array(
			'model'=>$model,
			'member'=>$member,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Users;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Users']))
		{
			$model->attributes=$_POST['Users'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Users');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Users('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Users']))
			$model->attributes=$_GET['Users'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Users the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Users::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Users $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='users-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
