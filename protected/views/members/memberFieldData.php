<?php $fieldName = $field->name; ?>
<div id="<?php echo $fieldName ?>-view">
<?php
$data = $model;
echo "<div id='".$fieldName."-list'>";
if ($data) {
	$provider = new CArrayDataProvider($data, array(
		'id'=>$fieldName,
		'sort'=>array(
			'attributes' => array( 'descr' ),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>$fieldName.'-grid',
		'dataProvider'=>$provider,
		'columns'=>array(
			'descr',
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/multiFieldData/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/multiFieldData/delete","id"=>$data->id)'),
				)
			),
		)
	));
}
echo "</div>";
echo "<div id='".$fieldName."-edit'>";
$obj = new MultiFieldData;
$obj->member_id = $member_id;
$obj->field_id = $field->id;
$this->renderPartial("/multiFieldData/_form", array(
	'model' => $obj,
	'fieldName' => $fieldName
));
echo "</div>";
?>
</div>
