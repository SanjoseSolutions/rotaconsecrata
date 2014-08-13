<?php

class MembersController extends RController
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
			'rights'
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
#			array('allow',  // allow all users to perform 'index' and 'view' actions
#				'actions'=>array('index','view'),
#				'users'=>array('*'),
#			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','index',
					'view','photo','crop', 'authorize',
					'renewals', 'renewalsSummary',
					'siblings', 'siblingsSummary',
					'communities', 'communitiesSummary',
					'outsideServices', 'outsideServicesSummary',
					'academicCourses', 'academicCoursesSummary',
					'booksWritten', 'booksWrittenSummary',
					'travels', 'travelsSummary',
					'multiFieldData', 'multiFieldDataSummary',
					'livingOutside', 'livingOutsideSummary',
					'separations', 'separationsSummary',
					'spiritualRenewalCourses', 'spiritualRenewalCoursesSummary',
					'professionalRenewalCourses', 'professionalRenewalCoursesSummary'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete','admin'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionSelfView()
	{
		$id = Yii::app()->user->profile->member_id;
		$this->render('view', array(
			'model'=>$this->loadModel($id),
		));
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

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Members;
		$specs = Specializations::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
			$specs = isset($_POST['specialization']) ? $_POST['specialization'] : array();
			$spokenLangs = isset($_POST['spokenLang']) ? $_POST['spokenLang'] : array();
			$model->updated_on = date_format(new DateTime(), 'd/m/Y');
			$model->updated_by = Yii::app()->user->id;
			Yii::trace("specs: ".var_export($specs, true), 'application.controllers.MembersController');
			if($model->save()) {
				foreach($specs as $spec) {
					$memSpec = new MemberSpecializations;
					$memSpec->member_id = $model->id;
					$memSpec->spec_id = $spec;
					$memSpec->save();
				}
				foreach($spokenLangs as $slang) {
					$sl = new SpokenLangs;
					$sl->member_id = $model->id;
					$sl->lang_id = $slang;
					$sl->save();
				}
					
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
			'specializations'=>$specs,
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

		$specs = Specializations::model()->findAll();
		$setSpecs = array_map(function($ms) { return $ms->spec_id; }, $model->memberSpecs);
		$setSpokenLangs = array_map(function($sl) { return $sl->lang_id; }, $model->spokenLangs);

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
			$specs = isset($_POST['specialization']) ? $_POST['specialization'] : array();
			foreach(array_diff($specs, $setSpecs) as $spec) {
				$memSpec = new MemberSpecializations;
				$memSpec->member_id = $id;
				$memSpec->spec_id = $spec;
				$memSpec->save();
			}
			foreach(array_diff($setSpecs, $specs) as $spec) {
				$memSpec = MemberSpecializations::model()->findByAttributes(array(
					'member_id' => $id,
					'spec_id' => $spec
				));
				$memSpec->delete();
			}
			$spokenLangs = isset($_POST['spokenLang']) ? $_POST['spokenLang'] : array();
			$newSpokenLangs = array_diff($spokenLangs, $setSpokenLangs);
			foreach($newSpokenLangs as $slang) {
				$sl = new SpokenLangs;
				$sl->member_id = $id;
				$sl->lang_id = $slang;
				$sl->save();
			}
			$delSpokenLangs = array_diff($setSpokenLangs, $spokenLangs);
			foreach($delSpokenLangs as $slang) {
				$sl = SpokenLangs::model()->findByAttributes(array(
					'member_id' => $id,
					'lang_id' => $slang,
				));
				$sl->delete();
			}

			$model->updated_on = date_format(new DateTime(), 'd/m/Y');
			$model->updated_by = Yii::app()->user->id;
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
			'specializations'=>$specs,
			'setSpecs'=>$setSpecs,
			'setSpokenLangs'=>$setSpokenLangs,
		));
	}

	public function actionSelfUpdate()
	{
		$id = Yii::app()->user->profile->member_id;
		$model = $this->loadModel($id);
		$specs = Specializations::model()->findAll();
		$setSpecs = array_map(function($ms) { return $ms->spec_id; }, $model->memberSpecs);
		$setSpokenLangs = array_map(function($sl) { return $sl->lang_id; }, $model->spokenLangs);

		$this->render('update', array(
			'model'=>$model,
			'specializations'=>$specs,
			'setSpecs'=>$setSpecs,
			'setSpokenLangs'=>$setSpokenLangs,
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
		$u = Yii::app()->user;
		$params = array();
		if ($u->checkAccess('ProvAdm')) {
			if (!$u->checkAccess('Admin')) {
				$params['criteria'] = array(
					'condition' => "province_id = " . $u->profile->member->province_id
				);
			}
			$dataProvider=new CActiveDataProvider('Members', $params);
			$this->render('index',array(
				'dataProvider'=>$dataProvider,
			));
		} else {
			throw new CHttpException(403, "Access denied. You are not allowed to access this page.");
		}
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin($search=null)
	{
		$model=new Members('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Members']))
			$model->attributes=$_GET['Members'];

		if( isset( $_GET[ 'export' ] ) )
		{       
		    header( "Content-Type: application/vnd.ms-excel; charset=utf-8" );
		    header( "Content-Disposition: inline; filename=\"members-report.xls\"" );

		    $dataProvider = $model->search();
		    $dataProvider->pagination = false;

		    $fields = array('id', 'fullname', 'dob', 'mobile', 'email', 'fathers_name',
		    	'mothers_name', 'joining_dt', 'first_commitment_dt', 'final_commitment_dt',
			'address', 'home_phone', 'home_mobile', 'parish', 'diocese');

		    $labels = $model->attributeLabels();
		    $fval = array();

		    foreach($fields as $field) {
			array_push($fval, $labels[$field]);
		    }           
		    echo implode("\t", $fval) . "\n";

		    foreach( $dataProvider->data as $data ) {
			$fval = array();
			foreach($fields as $field) {
			    array_push($fval, $data->$field);
			}               
			echo implode("\t", $fval) . "\n";
		    }           

		    Yii::app()->end();
		    return;
		
		}

		$this->render('admin',array(
			'model'=>$model,
			'search'=>isset($search)?$search:0
		));
	}

	public function actionAuthorize($id)
	{
		$model=$this->loadModel($id);

		if (Yii::app()->request->isPostRequest) {
			$role = $_POST['role'];
			$user=new Users;
			$user->username = $model->email;
			$user->password = 'NO-PASSWD';
			$user->email = $model->email;
			$user->member_id = $model->id;
			if ('Admin' == $role) {
				$user->superuser = 1;
			}
			if ($user->save()) {
				$ucode = new UserCodes;
				$code=bin2hex(openssl_random_pseudo_bytes(3));
				$ucode->code=sha1($code);
				$ucode->purpose='userReg';
				$ucode->data=$id;
				$ucode->created = date_format(new DateTime(), 'Y-m-d h:i:s');
				$url = Yii::app()->createAbsoluteUrl('/user/activate', array('code'=>$code));
				if ($ucode->save()) {
					if (!empty($role)) {
						$authorizer = Yii::app()->getModule("rights")->getAuthorizer();
						$authorizer->authManager->assign($role, $user->id);
					}
					$msg = "Authorization successful. Activation link emailed";
					Yii::app()->user->setFlash('msg', $msg);
					$email = Yii::app()->email;
					$email->to = $model->email;
					$email->subject = 'Welcome to RotaConsecrata';
					$email->message = sprintf("Dear %s,\n\n".
						"This is an email notification email that your user account has\n".
						"been created by administrator and can be activated by clicking\n".
						"the below link:\n\n".
						"\t%s\n\n".
						"This link will expire after 24 hours. If you are unable to login\n".
						"within this time, please contact your admin:\n\n".
						"Regards, RotaConsecrata Admin.", $model->fullname, $url);
					$email->send();
					Yii::trace("$msg. Link: $url", 'application.controllers.MembersController');
				}
			} else {
				$errs = $user->getErrors();
				$earr = array();
				foreach($errs as $attr => $ea) {
					array_push($earr, "$attr : " . implode("; ", $ea));
				}
				throw new Exception(implode("\n", $earr));
			}
		}

		$this->render('authorize', array(
			'model' => $model,
		));
	}

	public function actionRenewals($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('renewals', array(
			'model' => $model,
		));
	}

	public function actionRenewalsSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/renewals/summary', array(
			'renewals' => $model->renewals,
		));
	}

	public function actionBooksWritten($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('booksWritten', array(
			'model' => $model,
		));
	}

	public function actionBooksWrittenSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/booksWritten/summary', array(
			'booksWritten' => $model->booksWritten,
		));
	}

	public function actionMultiFieldData($id, $fieldName)
	{
		$field = MultiFieldNames::get($fieldName);

		$model=MultiFieldData::model()->findAllByAttributes(array(
			'member_id' => $id,
			'field_id' => $field->id
		));

		$this->renderPartial('memberFieldData', array(
			'field' => $field,
			'member_id' => $id,
			'model' => $model
		));
	}

	public function actionMultiFieldDataSummary($id, $fieldName)
	{
		$field = MultiFieldNames::get($fieldName);

		$model=MultiFieldData::model()->findAllByAttributes(array(
			'member_id' => $id,
			'field_id' => $field->id
		));

		$this->renderPartial('/multiFieldData/summary', array(
			'field' => $field,
			'member_id' => $id,
			'data' => $model
		));
	}

	public function actionSiblings($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('siblings', array(
			'model' => $model,
		));
	}

	public function actionSiblingsSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/siblings/summary', array(
			'siblings' => $model->siblings,
		));
	}

	public function actionAcademicCourses($id, $course)
	{
		$model=$this->loadModel($id);
		$course = AcademicCourseNames::get($course);
		$courses=AcademicCourses::model()->findAllByAttributes(array(
			'member_id' => $id,
			'course_id' => $course->id,
		));
		$this->renderPartial('academicCourses', array(
			'model' => $model,
			'courses' => $courses,
			'course' => $course,
		));
	}

	public function actionAcademicCoursesSummary($id, $course)
	{
		$courses=AcademicCourses::model()->findAllByAttributes(array(
			'member_id' => $id,
			'course_id' => AcademicCourseNames::getId($course),
		));
		$this->renderPartial('/academicCourses/summary', array(
			'courses' => $courses,
			'coures' => $course,
		));
	}

	public function actionCommunities($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('communities', array(
			'model' => $model
		));
	}

	public function actionCommunitiesSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/communityTerms/summary', array(
			'model' => $model,
			'commTerms' => $model->communityTerms,
		));
	}

	public function actionOutsideServices($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('outsideServices', array(
			'model' => $model
		));
	}

	public function actionOutsideServicesSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/outsideService/summary', array(
			'model' => $model,
			'outsideServices' => $model->outside_services,
		));
	}

	public function actionLivingOutside($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('livingOutside', array(
			'model' => $model
		));
	}

	public function actionLivingOutsideSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/livingOutside/summary', array(
			'model' => $model,
			'livingOutside' => $model->living_outside,
		));
	}

	public function actionSeparations($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('separations', array(
			'model' => $model
		));
	}

	public function actionSeparationsSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/separation/summary', array(
			'model' => $model,
			'separations' => $model->separations,
		));
	}

	public function actionSpiritualRenewalCourses($id)
	{
		$model = $this->loadModel($id);
		$this->renderPartial('spiritualRenewalCourses', array(
			'model' => $model
		));
	}

	public function actionSpiritualRenewalCoursesSummary($id)
	{
		$model = $this->loadModel($id);
                $this->renderPartial('/renewalCoursesSpiritual/summary', array(
                        'spiritualCourses' => $model->renewalCoursesSpiritual
                )); 
	}

	public function actionProfessionalRenewalCourses($id)
	{
		$model = $this->loadModel($id);
		$this->renderPartial('professionalRenewalCourses', array(
			'model' => $model
		));
	}

	public function actionProfessionalRenewalCoursesSummary($id)
	{
		$model = $this->loadModel($id);
                $this->renderPartial('/renewalCoursesProfessional/summary', array(
                        'professionalCourses' => $model->renewalCoursesProfessional
                )); 
	}

	public function actionTravels($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('travels', array(
			'model' => $model,
		));
	}

	public function actionTravelsSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/travels/summary', array(
			'travels' => $model->travels,
		));
	}

	public function actionPhoto($id)
	{
		$model=$this->loadModel($id);

		if (isset($_FILES['Members'])) { # uploading
			$files = $_FILES['Members'];
			$filename = $files['name']['raw_photo'];
			if (isset($filename) and '' != $filename) {
				Yii::trace("M.actionPhoto filename $filename", 'application.controllers.MembersController');
				$tmp_path = $files['tmp_name']['raw_photo'];
				if (isset($tmp_path) and '' != $tmp_path) {
					Yii::trace("M.actionPhoto tmp_path $tmp_path", 'application.controllers.MembersController');
					$dir = "./images/uploaded/";
					$dest = $dir . $filename;
					list($width, $height) = getimagesize($tmp_path);
					if ($width < 900) {
						$w = $width;
						$h = $height;
						$zoom = 1;
					} else {
						$w = 900;
						$h = $height * 900 / $width;
						$zoom = $w / $width;
					}
					$w = ($width < 900) ? $width : 900;

					move_uploaded_file($tmp_path, $dest);
					$this->render('crop', array('model'=>$model,'pfile'=>$filename, 'width' => $w, 'height' => $h, 'zoom' => $zoom));
					return;
				} else {
					$errors = array(
						1 => "Size exceeds max_upload",
						2 => "FORM_SIZE",
						3 => "No tmp dir",
						4 => "can't write",
						5 => "error extension",
						6 => "error partial",
					);
					$error = $errors[$files['error']['raw_photo']];
					Yii::trace("M.actionPhoto file error $error", 'application.controllers.PersonController');
				}
			}
		} elseif (isset($_POST['x1'])) { # cropping
			$x1 = $_POST['x1'];
			$y1 = $_POST['y1'];
			$width = $_POST['width'];
			$height = $_POST['height'];
			$pfile = $_POST['pfile'];
			$sdir = './images/uploaded/';
			list($w, $h, $t) = getimagesize($sdir . $pfile);
			Yii::trace("PC.actionPhoto crop received $x1, $y1, $width, $height, $w, $h, $t", 'application.controllers.PersonController');
			switch ($t) {
			case 1: $img = imagecreatefromgif($sdir . $pfile); break;
			case 2: $img = imagecreatefromjpeg($sdir . $pfile); break;
			case 3: $img = imagecreatefrompng($sdir . $pfile); break;
			case IMAGETYPE_BMP: $img = ImageHelper::ImageCreateFromBMP($sdir . $pfile); break;
			case IMAGETYPE_WBMP: $img = imagecreatefromwbmp($sdir . $pfile); break;
			default: Yii::trace("PC.actionPhoto crop unknown image type $t", 'application.controllers.PersonController');
			}
			if (function_exists('imagecrop')) { # untested
				$cropped = imagecrop($img, array('x1' => $x1, 'y1' => $y1, 'width' => $width, 'height' => $height));
				$scaled = imagescale($cropped, 200);
			} else {
				$h = $height * 200 / $width;
				$scaled = imagecreatetruecolor(200, $h);
				imagecopyresampled($scaled, $img, 0, 0, $x1, $y1, 200, $h, $width, $height);
			}
			$dir = './images/members/';
			$fname = preg_replace('/\.[a-z]+$/i', '', $pfile);
			$fext = ".jpg";
			if (file_exists($dir . $pfile)) {
				$fname .= "_01";
				while (file_exists($dir. $fname . $fext)) {
					++$fname;
				}
			}
			$dest = $dir . $fname . $fext;
			imagejpeg($scaled, $dest, 90);
			imagedestroy($scaled);
			imagedestroy($img);
			unlink($sdir . $pfile);
			$model->photo = $fname . $fext;
			$model->save(false);
			Yii::trace("PC.actionPhoto saved to $pfile", 'application.controllers.PersonController');
			$this->redirect(array('view', 'id' => $model->id));
			return;
		}

		$this->render('photo', array(
			'model' => $model
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Members the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Members::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Members $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='members-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
