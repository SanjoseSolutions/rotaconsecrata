<div id="outsideServices-view">
<div id="outsideServices-gridbox">
<?php
if ($comms = $model->outside_services) {
	$provider = new CArrayDataProvider($comms, array(
		'id' => 'outsideServices',
		'sort' => array(
			'defaultOrder' => 'year_from DESC',
			'attributes' => array(
				'institution', 'year_from', 'designation', 'duration'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'outsideServices-grid',
		'dataProvider' => $provider,
		'enableSorting' => true,
		'columns' => array(
			array(
				'name' => 'institution',
				'header' => $model->getAttributeLabel('institution'),
			),
			array(
				'name' => 'year_from',
				'header' => $model->getAttributeLabel('year_from'),
			),
			array(
				'name' => 'year_to',
				'header' => $model->getAttributeLabel('year_to'),
			),
			array(
				'name' => 'designation',
				'header' => $model->getAttributeLabel('designation'),
			),
			array(
				'name' => 'duration',
				'header' => $model->getAttributeLabel('duration'),
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/outsideService/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/outsideService/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="outsideServices-edit">
<?php
$commTerm = new OutsideServices;
$commTerm->member_id = $model->id;
$this->renderPartial("/outsideService/_form", array(
	'model' => $commTerm
));
?>
</div>
