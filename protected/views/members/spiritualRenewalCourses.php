<div id="spiritualRenewalCourses-view">
<div id="spiritualRenewalCourses-gridbox">
<?php
if ($spiritualCourses = $model->renewalCoursesSpiritual) {
	$provider = new CArrayDataProvider($spiritualCourses, array(
		'id' => 'spiritualRenewalCourses',
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
		'id' => 'spiritualRenewalCourses-grid',
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
					'update' => array('url' => 'array("/renewalCoursesSpiritual/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/renewalCoursesSpiritual/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="spiritualRenewalCourses-edit">
<?php
$course = new RenewalCoursesSpiritual;
$course->member_id = $model->id;
$this->renderPartial("/renewalCoursesSpiritual/_form", array(
	'model' => $course
));
?>
</div>
