<div id="siblings-view">
<?php
$sibs = $model->siblings;
echo "<div id='sib-list'>";
if ($sibs) {
	$provider = new CArrayDataProvider($sibs, array(
		'id'=>'siblings',
		'sort'=>array(
			'attributes' => array(
				'fullname', 'phone', 'alive'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'siblings-grid',
		'dataProvider'=>$provider,
		'columns'=>array(
			'fullname',
			'phone',
			array(
				'name' => 'alive',
				'type' => 'raw',
				'value' => '$data->alive ? "Y" : "N"'
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/siblings/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/siblings/delete","id"=>$data->id)'),
				)
			),
		)
	));
}
echo "</div>";
echo "<div id='sib-edit'>";
$sib = new Siblings;
$sib->member_id = $model->id;
$this->renderPartial("/siblings/_form", array(
	'model' => $sib,
));
echo "</div>";
?>
</div>
