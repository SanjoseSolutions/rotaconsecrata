<div id="communities-view">
<div id="communities-gridbox">
<?php
if ($comms = $model->communityTerms) {
	$provider = new CArrayDataProvider($comms, array(
		'id' => 'communities',
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
		'id' => 'communities-grid',
		'dataProvider' => $provider,
		'enableSorting' => true,
		'columns' => array(
			array(
				'name' => 'Community',
				'type' => 'raw',
				'value' => '$data->community->name',
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
					'update' => array('url' => 'array("/communityTerms/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/communityTerms/delete","id"=>$data->id)'),
				)
			)
		)
	));
}
?>
</div>
<div id="communities-edit">
<?php
$commTerm = new CommunityTerms;
$commTerm->member_id = $model->id;
$this->renderPartial("/communityTerms/_form", array(
	'model' => $commTerm
));
?>
</div>
