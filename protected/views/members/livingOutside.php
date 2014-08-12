<div id="livingOutside-view">
<div id="livingOutside-gridbox">
<?php
if ($comms = $model->living_outside) {
	$provider = new CArrayDataProvider($comms, array(
		'id' => 'livingOutside',
		'sort' => array(
			'defaultOrder' => 'year_from DESC',
			'attributes' => array(
				'institution', 'year_from', 'purpose', 'year_to'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'livingOutside-grid',
		'dataProvider' => $provider,
		'enableSorting' => true,
		'columns' => array(
			array(
				'name' => 'year_from',
				'header' => $model->getAttributeLabel('year_from'),
			),
			array(
				'name' => 'year_to',
				'header' => $model->getAttributeLabel('year_to'),
			),
			array(
				'name' => 'institution',
				'header' => $model->getAttributeLabel('institution'),
			),
			array(
				'name' => 'purpose',
				'header' => $model->getAttributeLabel('purpose'),
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/livingOutside/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/livingOutside/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="livingOutside-edit">
<?php
$commTerm = new LivingOutside;
$commTerm->member_id = $model->id;
$this->renderPartial("/livingOutside/_form", array(
	'model' => $commTerm
));
?>
</div>
