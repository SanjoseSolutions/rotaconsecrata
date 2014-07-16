<div id="renewals-view">
<?php
$renewals = $model->renewals;
echo "<div id='renewal-list'>";
if ($renewals) {
	$provider = new CArrayDataProvider($renewals, array(
		'id'=>'renewals',
		'sort'=>array(
			'attributes' => array(
				'renewal_dt', 'place',
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'renewals-grid',
		'dataProvider'=>$provider,
		'columns'=>array(
			array(
				'name' => 'renewal_dt',
				'header' => 'Renewal Date',
			),
			array(
				'name' => 'place',
				'header' => 'Place',
			),
/*			array(
				'name' => 'alive',
				'type' => 'raw',
				'value' => '$data->alive ? "Y" : "N"'
			),
*/			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/renewals/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/renewals/delete","id"=>$data->id)'),
				)
			),
		)
	));
}
echo "</div>";
echo "<div id='renewal-edit'>";
$rwl = new Renewals;
$rwl->member_id = $model->id;
$this->renderPartial("/renewals/_form", array(
	'model' => $rwl,
));
echo "</div>";
?>
</div>
