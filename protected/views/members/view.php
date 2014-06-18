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

Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-communities.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-spiritualRenewalCourses.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/add-professionalRenewalCourses.js');
Yii::app()->clientScript->registerScript('addSibs', "
$('#add-sibs').fancybox( {
	'onComplete': function() {
		set_form_submit();
		set_button_click();
	}
} );
$('#add-comms').fancybox( {
        'onComplete': function() {
                set_comm_form_submit();
                set_comm_button_click();
		set_comm_autocomplete();
        }
} );
function set_comm_autocomplete()
{
	jQuery('#CommunityTerms_community').autocomplete( {
		'source': " . json_encode(Communities::getAll()) . "
	} );
}
$('#add-spiritual-courses').fancybox( {
	'onComplete': function() {
                set_spiritual_course_button_click();
                set_spiritual_course_form_submit();
	}
} );
$('#add-professional-courses').fancybox( {
	'onComplete': function() {
                set_professional_course_button_click();
                set_professional_course_form_submit();
	}
} );
");

/* @var $this MembersController */
/* @var $model Members */

$this->breadcrumbs=array(
	'Members'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Members', 'url'=>array('index')),
	array('label'=>'Create Members', 'url'=>array('create')),
	array('label'=>'Update Members', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Members', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Members', 'url'=>array('admin')),
);

?>

<div class="title">
<h1 style="display:inline"><?php echo $model->fullname ? $model->fullname : 'View Member #' . $model->id; ?></h1>
<h2 style="display:inline">(maiden name: <?php echo $model->maiden_name ?>)</h2>
</div>

<figure class="photo">
	<?php if (!$model->photo) {
			$photo_path = "/images/placeholder-woman.jpg";
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
		echo CHtml::link($label, array('photo', 'id'=>$model->id));
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

	echo '<div class="joining fields">';
	echo "<label>Joined: </label>";
	echo "<span class='date val'>" . $model->joining_dt . "</span>&nbsp;&nbsp;";

	if ($model->vestation_dt) {
		echo "<label>Vestation: </label>";
		echo "<span class='date val'>" . $model->vestation_dt . "</span>";
	}

	echo "</div>";

	if ($model->first_commitment_dt) {
		echo '<div class="commitment fields">';
		echo "<label>First Commitment: </label>";
		echo "<span class='date val'>" . $model->first_commitment_dt . "</span>&nbsp;";

		if ($model->final_commitment_dt) {
			echo "<label>Final: </label>";
			echo "<span class='date val'>" . $model->final_commitment_dt . "</span>";
		}

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

	if ($model->parish) {
		echo "<div class='fields'>";
		echo "<label>Parish: </label>";
		echo "<span class='val'>". $model->parish . "</span>&nbsp;&nbsp;";
		echo "<label>Diocese: </label>";
		echo "<span class='val'>" . $model->diocese . "</span>";
		echo "</div>";
	}

	if ($model->siblings) {
		echo "<div class='fields'>";
		$siblings = $model->siblings;
		$sibs = array();
		$i = 0;
		$xtra = "";
		foreach($siblings as $sib) {
			if (++$i > 2) {
				$xtra = " +" . (count($siblings) - $i + 1);
				break;
			}
			array_push($sibs, $sib->fullname);
		}
		echo "<label>Siblings: </label>";
		$sibstr = implode(", ", $sibs) . $xtra;
		echo "<span class='val'>$sibstr</span> ";
		echo CHtml::link("Edit", array('/members/siblings', 'id' => $model->id), array('id' => 'add-sibs'));
		echo "</div>";
	} else {
		echo CHtml::link("Add Siblings", array('/members/siblings', 'id' => $model->id), array('id' => 'add-sibs'));
	}

	echo "<div class='fields'>";
	if ($model->communityTerms) {
		$commTerms = $model->communityTerms;
		$nComm = count($commTerms) - 1;
		$xtra = $nComm ? " +$nComm" : "";
		$comm = $model->presentCommunity;
		echo "<label>Community: </label>";
		echo "<span class='val'>" . $comm->community->name .
			" (since " . $comm->year_from . ")$xtra</span> ";
		$lbl = "Edit";
		echo CHtml::link($lbl, array('/members/communities', 'id' => $model->id), array('id' => 'add-comms'));
	} else {
		$lbl = "Add Communities";
		echo CHtml::link($lbl, array('/members/communities', 'id' => $model->id), array('id' => 'add-comms'));
	}
	echo "</div>";

	echo "<div class='fields'>";
	if ($model->renewalCoursesSpiritual) {
		$spiritualCourses = $model->renewalCoursesSpiritual;
		$nComm = count($spiritualCourses);
		echo "<label>Spiritual Renewal Courses: </label>";
		echo "<span class='val'>$nComm</span> ";
		$lbl = "Edit";
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

	echo "<div class='fields'>";
	if ($model->renewalCoursesProfessional) {
		$professionalCourses = $model->renewalCoursesProfessional;
		$nComm = count($professionalCourses);
		echo "<label>Professional Renewal Courses: </label>";
		echo "<span class='val'>$nComm</span> ";
		$lbl = "Edit";
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
	echo "</div><!-- end of rightSection -->";

	echo "<div class='fields'>";
	$flds = array('mission', 'generalate', 'swiss_visit', 'holyland_visit', 'family_abroad', 'annual_checkups');
	$cls = "left13";
	foreach($flds as $fld) {
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
?>
