<div id="professionalRenewalCourses-view">
<div id="professionalRenewalCourses-gridbox">
<?php
if ($professionalCourses = $model->renewalCoursesProfessional) {
	$provider = new CArrayDataProvider($professionalCourses, array(
		'id' => 'professionalRenewalCourses',
		'sort' => array(
			'attributes' => array(
				'year_from'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'professionalRenewalCourses-grid',
		'dataProvider' => $provider,
		'enableSorting' => true,
		'columns' => array(
			array(
				'name' => 'name',
				'header' => $model->getAttributeLabel('name'),
			),
			array(
				'name' => 'year',
				'header' => $model->getAttributeLabel('year'),
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/renewalCoursesProfessional/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/renewalCoursesProfessional/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="professionalRenewalCourses-edit">
<?php
$course = new RenewalCoursesProfessional;
$course->member_id = $model->id;
$this->renderPartial("/renewalCoursesProfessional/_form", array(
	'model' => $course
));
?>
</div>
