<?php

$baseScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets'));
Yii::app()->clientScript->registerCssFile($baseScriptUrl.'/gridview/styles.css');

$pagerScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.widgets.pagers'));
Yii::app()->clientScript->registerCssFile($pagerScriptUrl.'/pager.css');

$autoCompleteScriptUrl=Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('system.web.js.source'));
Yii::app()->clientScript->registerScriptFile($autoCompleteScriptUrl.'/jquery.yiiactiveform.js');
Yii::app()->clientScript->registerScriptFile($autoCompleteScriptUrl.'/jui/js/jquery-ui.min.js');
Yii::app()->clientScript->registerCssFile($autoCompleteScriptUrl.'/jui/css/base/jquery-ui.css');

$this->widget('application.extensions.fancybox.EFancyBox', array(
    'target'=>'a[rel=gallery]',
        'config'=>array(),
));

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-booksWritten.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-siblings.js');
#Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-communities.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-academicCourses.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-spiritualRenewalCourses.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-professionalRenewalCourses.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-travels.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-membersMultiData.js');
$mul_flds = array();
$models = array();
$mul_fld_script = "";
foreach($mul_flds as $fld) {
	$mul_fld_script .= "
$('#add-$fld').fancybox( {
	'onComplete': function() {
		set_multi_field_data_button_click('$fld');
		set_multi_field_data_form_submit('$fld');
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'multiFieldDataSummary', 'id'=>$model->id, 'fieldName'=>$fld
		)) . "', function(data) {
			$('#$fld-summary .val').html(data);
		} );
	}
} );
";
}
$courses_script = "";
foreach(AcademicCourseNames::getAllNames() as $course) {
	$courses_script .= "
$('#add-$course-courses').fancybox( {
	'onComplete': function() {
		console.log('completed: $course');
		set_academic_course_button_click('$course');
		set_academic_course_form_submit('$course');
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'academicCoursesSummary',
			'id' => $model->id,
			'course' => $course
		)) . "', function(data) {
			$('#$course-courses-summary .val').html(data);
		} );
	}
} );
";
}
Yii::app()->clientScript->registerScript('addSibs', "
$('#add-sibs').fancybox( {
	'onComplete': function() {
		set_form_submit();
		set_button_click();
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'/members/siblingsSummary', 
			'id' => $model->id
		)) . "', function(data) {
			$('#siblings-summary .val').html(data);
		} );
	}
} );
$('#add-comms').fancybox( {
        'onComplete': function() {
                set_comm_form_submit();
                set_comm_button_click();
		set_comm_autocomplete();
        },
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'/members/communitiesSummary',
			'id' => $model->id
		)) . "', function(data) {
			$('#communities-summary .val').html(data);
		} );
	}
} );
function set_comm_autocomplete()
{
	jQuery('#CommunityTerms_communityName').autocomplete( {
		'source': " . json_encode(Communities::getAll()) . "
	} );
}
$('#add-books-written').fancybox( {
	'onComplete': function() {
		set_book_written_button_click();
		set_book_written_form_submit();
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'booksWrittenSummary', 'id'=>$model->id
		)) . "', function(data) {
			$('#books-written-summary .val').html(data);
		} );
	}
} );
$('#add-travels').fancybox( {
	'onComplete': function() {
		set_travel_button_click();
		set_travel_form_submit();
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'travelsSummary', 'id'=>$model->id
		)) . "', function(data) {
			$('#travels-summary .val').html(data);
		} );
	}
} );
$('#add-spiritual-courses').fancybox( {
	'onComplete': function() {
                set_spiritual_course_button_click();
                set_spiritual_course_form_submit();
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'spiritualRenewalCoursesSummary', 'id'=>$model->id
		)) . "', function(data) {
			$('#renewal-courses-spiritual-summary .val').html(data);
		} );
	}
} );
$('#add-professional-courses').fancybox( {
	'onComplete': function() {
                set_professional_course_button_click();
                set_professional_course_form_submit();
	},
	'onClosed': function() {
		$.get('" . CHtml::normalizeUrl(array(
			'professionalRenewalCoursesSummary', 'id'=>$model->id
		)) . "', function(data) {
			$('#renewal-courses-professional-summary .val').html(data);
		} );
	}
} );
".$mul_fld_script
.$courses_script
.file_get_contents(dirname(__FILE__).'/../../../js/add-communities.js')
);

/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
	array('label'=>'Create Member', 'url'=>array('create'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
	array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->id), 'visible' => Yii::app()->user->checkAccess('ProvAdm')),
	array('label'=>'Update Self', 'url'=>array('selfUpdate'), 'visible' => !Yii::app()->user->checkAccess('ProvAdm')),
	array('label'=>'Delete Member', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
	array('label'=>'Manage Members', 'url'=>array('admin'), 'visible' => Yii::app()->user->checkAccess('ProvAdmin')),
);

?>

<div class="title">
<h1 style="display:inline"><?php echo $model->fullname ? $model->fullname : 'View Member #' . $model->id; ?></h1>
<h2 style="display:inline">(maiden name: <?php echo $model->maiden_name ?>)</h2>
</div>

<figure class="photo">
	<?php
	
	if (!$model->photo) {
			$sex = $model->sex == 'M' ? 'male' : 'female';
			$photo_path = "/images/placeholder-$sex.jpg";
			$src = Yii::app()->request->baseUrl . $photo_path;
			list($width, $height) = getimagesize(".$photo_path");
			$label = 'Add Photo';
		} else {
			$src = Yii::app()->request->baseUrl . '/images/members/' . $model->photo;
			list($width, $height) = getimagesize("./images/members/" . $model->photo);
			$label = 'Update Photo';
		}
		$alt = $model->fullname . "'s photo";
		echo CHtml::image($src, $alt, array('width' => $width, 'height' => $height));
		echo '<figcaption>';
		echo CHtml::link($label, array('photo', 'id'=>$model->id))."<br>";
		$lbl = null;
		if (!isset($model->user)) {
			if (isset($model->email)) {
				$lbl = "Grant Access";
				echo CHtml::link($lbl, array('authorize', 'id'=>$model->id));
			}
		} else {
			$user = $model->user;
			$roles = array_map(function($role) {
				return $role->name;
			}, Rights::getAssignedRoles($user->id));
			$lbl = "";
			if ($user->superuser) {
				$lbl = "Superuser ";
			}
			if (in_array('Admin', $roles)) {
				$lbl .= "Generate Admin";
			} elseif (in_array('ProvAdm', $roles)) {
				$lbl .= "Provincial Admin";
			} else {
				$lbl .= "Member";
			}
			echo CHtml::link($lbl, array('authorize', 'id'=>$model->id));
		}
		if (isset($lbl)) {
		}

		echo '<div class="fields">';
		echo CHtml::label($model->getAttributeLabel('province_id').': ', false);
		echo CHtml::tag('span',array('class'=>'val'),$model->province->name);
		echo '</div>';

		echo '<div class="fields">';
		echo CHtml::label($model->getAttributeLabel('member_no').': ', false);
		echo CHtml::tag('span',array('class'=>'val'),$model->member_no);
		echo '</div>';

		echo '</figcaption>';
	?>
</figure>

<div class="rightSection">
<?php
	echo '<div class="contact fields">';
	if ($model->mobile) {
		echo '<span class="mobile">';
		echo '<span class="val">' . CHtml::encode($model->mobile).'</span>';
		echo '</span> ';
	}

	if ($model->email) {
		echo '<span class="email">';
		echo '<span class="date val">' . CHtml::encode($model->email).'</span>';
		echo '</span>';
	}
	echo '</div>';

	echo '<div class="life-event fields">';
	echo "<label>Born:</label> ";
	echo "<span class='date val'>" . $model->dob . "</span> ";

	if ($model->demise_dt) {
		echo "<label>Demise Date</label>";
		echo "<span class='date val'>" . $model->demise_dt . "</span> ";
	}

	echo "</div>";

	if ($model->baptism_dt) {
		echo '<div class="life-event fields">';
		echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('baptism_dt')). ': ', false);
		echo "<span class='date val'>" . $model->baptism_dt . "</span> ";

		if ($model->baptism_place) {
			echo ', '.CHtml::label($model->getAttributeLabel('baptism_place').': ', false);
			echo CHtml::tag('span', array('class' => 'date val'), $model->baptism_place);
		}

		echo "</div>";
	}

	if ($model->confirmation_dt) {
		echo '<div class="life-event fields">';
		echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('confirmation_dt')). ': ', false);
		echo "<span class='date val'>" . $model->confirmation_dt . "</span>";

		if ($model->confirmation_place) {
			echo ', '.CHtml::label($model->getAttributeLabel('confirmation_place').': ', false);
			echo CHtml::tag('span', array('class' => 'date val'), $model->confirmation_place);
		}

		echo "</div>";
	}

	echo '<div class="joining fields">';
	echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('joining_dt')). ': ', false);
	echo CHtml::tag('span', array('class'=>'date val'), $model->joining_dt);

	if ($model->joining_place) {
		echo ',&nbsp;&nbsp;'.CHtml::label($model->getAttributeLabel('joining_place'). ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->joining_place);
	}

	echo "</div>";

	echo '<div class="joining fields">';
	if ($model->vestition_dt) {
		echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('vestition_dt')). ': ', false);
		echo CHtml::tag('span', array('class'=>'date val'), $model->vestition_dt);

		if ($model->vestition_place) {
			echo ',&nbsp;&nbsp;'.CHtml::label($model->getAttributeLabel('vestition_place'). ': ', false);
			echo CHtml::tag('span', array('class'=>'val'), $model->vestition_place);
		}

	}
	echo "</div>";

	if ($model->first_commitment_dt) {
		echo '<div class="commitment fields">';
		echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('first_commitment_dt')). ': ', false);
		echo CHtml::tag('span', array('class'=>'date val'), $model->first_commitment_dt);

		if ($model->first_commitment_place) {
			echo ',&nbsp;&nbsp;'.CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('first_commitment_place')). ': ', false);
			echo CHtml::tag('span', array('class'=>'date val'), $model->first_commitment_place);
		}

		echo "</div>";
	}

	if ($model->final_commitment_dt) {
		echo '<div class="commitment fields">';
		echo CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('final_commitment_dt')). ': ', false);
		echo CHtml::tag('span', array('class'=>'date val'), $model->final_commitment_dt);

		if ($model->final_commitment_place) {
			echo ',&nbsp;&nbsp;'.CHtml::label(str_replace(' Date', '', $model->getAttributeLabel('final_commitment_place')). ': ', false);
			echo CHtml::tag('span', array('class'=>'date val'), $model->final_commitment_place);
		}

		echo "</div>";
	}

	echo "<div class='fields'>";
	echo "<label>Father's Name: </label>";
	if ($model->father_alive) {
		echo "<span class='val'>" . $model->fathers_name . "</span> (alive)";
	} else {
		echo "<span class='val'>(late) " . $model->fathers_name . "</span>";
	}
	echo "</div>";

	echo "<div class='fields'>";
	echo "<label>Mother's Name: </label>";
	if ($model->mother_alive) {
		echo "<span class='val'>" . $model->mothers_name . "</span> (alive)";
	} else {
		echo "<span class='val'>(late) " . $model->mothers_name . "</span>";
	}
	echo "</div>";

	echo "<div class='fields'>";
	if ($model->address) {
		echo "<label>Home Contact: </label>";
		if ($model->home_phone) {
			echo "<span class='val'><span class='phone'>".$model->home_phone."</span>&nbsp;";
			if ($model->home_mobile) {
				echo "<span class='mobile'>".$model->home_mobile."</span>";
			}
		}
		echo "<br />" . $model->address . "</span><br>";
	}
	echo "</div>";

	echo "<div class='fields'>";
	if ($model->mother_tongue) {
		echo CHtml::label($model->getAttributeLabel('mother_tongue') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'),
			FieldValues::decode('languages', $model->mother_tongue));
	}
	echo "</div>";

	if ($model->parish) {
		echo "<div class='fields'>";
		echo "<label>Parish: </label>";
		echo "<span class='val'>". $model->parish . "</span>&nbsp;&nbsp;";
		echo "<label>Diocese: </label>";
		echo "<span class='val'>" . $model->diocese . "</span>";
		echo "</div>";
	}

	echo '<div id="siblings-summary" class="fields">';
	if ($model->siblings) {
		echo "<label>Siblings: </label>";
		echo "<span class='val'>";
		$this->renderPartial('/siblings/summary', array('siblings' => $model->siblings));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add Siblings";
	}
	echo CHtml::link($lbl, array('/members/siblings', 'id' => $model->id), array('id' => 'add-sibs'));
	echo "</div>";

	echo "<div class='fields'>";
	if ($model->place_family) {
		echo CHtml::label($model->getAttributeLabel('place_family') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->place_family);
	}
	if ($model->num_priests) {
		echo ', '.CHtml::label($model->getAttributeLabel('num_priests') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->num_priests);
	}
	if ($model->num_nuns) {
		echo ', '.CHtml::label($model->getAttributeLabel('num_nuns') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->num_nuns);
	}
	echo "</div>";

	if ($model->edu_joining) {
		echo "<div class='fields'>";
		echo CHtml::label($model->getAttributeLabel('edu_joining') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->edu_joining);
		echo "</div>";
	}

	if ($model->edu_present) {
		echo "<div class='fields'>";
		echo CHtml::label($model->getAttributeLabel('edu_present') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), $model->edu_present);
		echo "</div>";
	}

	$slangs = array_map(function($el) { return $el->lang->value; }, $model->spokenLangs);
	if ($slangs) {
		echo "<div class='fields'>";
		echo "<label>Spoken Languages: </label>";
		echo "<span class='val'>" . implode(', ', $slangs) . "</span>";
		echo "</div>";
	}

	if ($model->teach_lang) {
		echo "<div class='fields'>";
		echo CHtml::label($model->getAttributeLabel('teach_lang') . ': ', false);
		echo CHtml::tag('span', array('class'=>'val'), FieldValues::value($model->teach_lang));
		echo "</div>";
	}

	$specs = array();
	foreach($model->memberSpecs as $spec) {
		array_push($specs, $spec->spec->name);
	}
	if ($specs) {
		echo "<div class='fields'>";
		echo "<label>Specializations: </label>";
		echo "<span class='val'>" . implode(', ', $specs) . "</span>";
		echo "</div>";
	}

	foreach(AcademicCourseNames::getAllNames() as $course) {
		$this->renderPartial('academicCourseSummary', array(
			'model' => $model,
			'course' => $course));
	}

	echo "<div id='renewal-courses-spiritual-summary' class='fields'>";
	if ($model->renewalCoursesSpiritual) {
		echo "<label>Spiritual Renewal Courses: </label>";
		echo "<span class='val'>";
		$this->renderPartial('/renewalCoursesSpiritual/summary', array(
			'spiritualCourses' => $model->renewalCoursesSpiritual
		));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add Spiritual Renewal Courses";
	}
	echo CHtml::link($lbl, array(
		'/members/spiritualRenewalCourses',
		'id'=>$model->id
	), array(
		'id'=>'add-spiritual-courses')
	);
	echo "</div>";

	echo "<div id='renewal-courses-professional-summary' class='fields'>";
	if ($model->renewalCoursesProfessional) {
		echo "<label>Professional Renewal Courses: </label>";
		echo "<span class='val'>";
		$this->renderPartial('/renewalCoursesProfessional/summary', array(
			'professionalCourses' => $model->renewalCoursesProfessional
		));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add Professional Renewal Courses";
	}
	echo CHtml::link($lbl, array(
		'/members/professionalRenewalCourses',
		'id'=>$model->id
	), array(
		'id'=>'add-professional-courses')
	);
	echo "</div>";
	echo '<div id="travels-summary" class="fields">';
	if ($model->travels) {
		echo "<label>Travels: </label>";
		echo "<span class='val'>";
		$this->renderPartial('/travels/summary', array('travels' => $model->travels));
		echo "</span> ";
		$lbl = CHtml::image(Yii::app()->request->baseUrl."/images/edit.png", "Edit", array('height'=>14,'width'=>14,'title'=>'Edit'));;
	} else {
		$lbl = "Add Travels";
	}
	echo CHtml::link($lbl, array('/members/travels', 'id'=>$model->id), array('id'=>'add-travels'));
	echo "</div>";

	echo "</div><!-- end of rightSection -->";

	echo "<div class='fields'>";
	$flds = array('mission', 'generalate', 'swiss_visit', 'holyland_visit', 'family_abroad', 'annual_checkups');
	$cls = "left13";
	foreach($flds as $fld) {
		if (!isset($model->$fld)) continue;
		echo "<span class='$cls'>";
		$cls = $cls === "left13" ? "right13" : "left13";
		echo "<label>";
		echo $model->attributeLabels()[$fld];
		echo ": </label>";
		echo "<span class='val'>";
		echo $model->$fld ? 'YES' : 'NO';
		echo '</span>';
		echo '</span>';
	}
	echo "</div>";

	echo "<div class='fields'>";
	$flds = array('age_retired', 'pension_amt', 'decease_time');
	$cls = "left13";
	foreach($flds as $fld) {
		if (!isset($model->$fld)) continue;
		echo "<span class='$cls'>";
		$cls = $cls === "left13" ? "right13" : "left13";
		echo "<label>";
		echo $model->getAttributeLabel($fld);
		echo ": </label>";
		echo CHtml::tag('span',array('class'=>'val'),$model->$fld);
		echo "</span>";
	}
	echo "</div>";

	echo "<div class='fields'>";
	$flds = array('last_illness_nature', 'funeral_celebrant', 'burial_place', 'cemetery');
	$cls = 'leftHalf';
	foreach($flds as $fld) {
		if (!isset($model->$fld)) continue;
		echo "<span class='$cls'>";
		echo "<label>";
		echo $model->getAttributeLabel($fld); 
		echo ": </label>";
		echo CHtml::tag('span',array('class'=>'val'),$model->$fld);
		echo "</span>";
		if ($cls == "leftHalf") {
			$cls = "rightHalf";
		} else {
			$cls = "leftHalf";
			echo "</div><div class='fields'>";
		}
	}
	echo "</div>";

	if ($model->convent_dec) {
		echo "<div class='fields'>";
		echo CHtml::label($model->getAttributeLabel('convent_decease').': ', false);
		echo CHtml::tag('span',array('class'=>'val'),$model->convent_dec->name);
		echo "</div>";
	}
?>
