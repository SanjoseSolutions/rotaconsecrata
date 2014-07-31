<div id="travels-view">
<?php
$travels = $model->travels;
echo "<div id='travel-list'>";
if ($travels) {
	$provider = new CArrayDataProvider($travels, array(
		'id'=>'travels',
		'sort'=>array(
			'defaultOrder' => 'year ASC',
			'attributes' => array(
				'year', 'places', 'nature'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$label = $travels[0]->attributeLabels();
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'travels-grid',
		'dataProvider'=>$provider,
		'columns'=>array(
			array(
				'name' => 'year',
				'header' => $label['year'],
			),
			array(
				'name' => 'places',
				'header' => $label['places'],
			),
			array(
				'name' => 'nature',
				'header' => $label['nature'],
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/travels/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/travels/delete","id"=>$data->id)'),
				)
			),
		)
	));
}
echo "</div>";
echo "<div id='travels-edit'>";
$travel = new Travels;
$travel->member_id = $model->id;
$this->renderPartial("/travels/_form", array(
	'model' => $travel,
));
echo "</div>";
?>
</div>
