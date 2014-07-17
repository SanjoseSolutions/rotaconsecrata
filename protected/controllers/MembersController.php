<?php

class MembersController extends Controller
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
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','photo','crop',
					'renewals', 'renewalsSummary',
					'siblings', 'siblingsSummary',
					'communities', 'communitiesSummary',
					'academicCourses', 'academicCoursesSummary',
					'spiritualRenewalCourses', 'spiritualRenewalCoursesSummary',
					'professionalRenewalCourses', 'professionalRenewalCoursesSummary'),
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
		$specs = Specializations::model()->findAll();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$setSpecs = array();
		$memSpecs = $model->memberSpecs;
		Yii::trace("memSpecs: " . var_export($memSpecs, true), 'application.controllers.MembersController');
		foreach($memSpecs as $spec) {
			array_push($setSpecs, $spec->spec_id);
		}
		Yii::trace("setSpecs: " . var_export($setSpecs, true), 'application.controllers.MembersController');

		if(isset($_POST['Members']))
		{
			$model->attributes=$_POST['Members'];
			$specs = isset($_POST['specialization']) ? $_POST['specialization'] : array();
			Yii::trace("specs: ".var_export($specs, true), 'application.controllers.MembersController');
			foreach($specs as $spec) {
				if (!in_array($spec, $setSpecs)) {
					$memSpec = new MemberSpecializations;
					$memSpec->member_id = $id;
					$memSpec->spec_id = $spec;
					$memSpec->save();
				}
			}
			foreach($setSpecs as $spec) {
				if (!in_array($spec, $specs)) {
					$memSpec = MemberSpecializations::model()->findByAttributes(array(
						'member_id' => $id,
						'spec_id' => $spec
					));
					$memSpec->delete();
				}
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
		$dataProvider=new CActiveDataProvider('Members');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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

	public function actionAcademicCourses($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('academicCourses', array(
			'model' => $model,
		));
	}

	public function actionAcademicCoursesSummary($id)
	{
		$model=$this->loadModel($id);
		$this->renderPartial('/academicCourses/summary', array(
			'academicCourses' => $model->academicCourses,
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
