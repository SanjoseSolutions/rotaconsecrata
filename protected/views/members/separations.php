<div id="separations-view">
<div id="separations-gridbox">
<?php
if ($seps = $model->separations) {
	$provider = new CArrayDataProvider($seps, array(
		'id' => 'separations',
		'sort' => array(
			'defaultOrder' => 'year_from DESC',
			'attributes' => array(
				'institution', 'year_from', 'nature', 'year_to'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id' => 'separations-grid',
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
				'name' => 'nature',
				'header' => $model->getAttributeLabel('nature'),
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/separation/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/separation/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="separations-edit">
<?php
$sep = new Separations;
$sep->member_id = $model->id;
$this->renderPartial("/separation/_form", array(
	'model' => $sep
));
?>
</div>
