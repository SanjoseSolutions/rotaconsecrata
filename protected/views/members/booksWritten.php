<div id="booksWritten-view">
<?php
$books = $model->booksWritten;
echo "<div id='book-list'>";
if ($books) {
	$provider = new CArrayDataProvider($books, array(
		'id'=>'booksWritten',
		'sort'=>array(
			'defaultOrder' => 'year ASC',
			'attributes' => array(
				'title', 'authors', 'year', 'publisher'
			),
		),
		'pagination' => array(
			'pageSize' => 10
		)
	));
	$label = $books[0]->attributeLabels();
	$this->widget('zii.widgets.grid.CGridView', array(
		'id'=>'booksWritten-grid',
		'dataProvider'=>$provider,
		'columns'=>array(
			array(
				'name' => 'title',
				'header' => $label['title'],
			),
			array(
				'name' => 'authors',
				'header' => $label['authors'],
			),
			array(
				'name' => 'year',
				'header' => $label['year'],
			),
			array(
				'name' => 'publisher',
				'header' => $label['publisher'],
			),
			array(
				'class' => 'CButtonColumn',
				'buttons' => array(
					'view' => array('visible' => 'false'),
					'update' => array('url' => 'array("/booksWritten/update","id"=>$data->id)'),
					'delete' => array('url' => 'array("/booksWritten/delete","id"=>$data->id)'),
				)
			),
		)
	));
}
echo "</div>";
echo "<div id='booksWritten-edit'>";
$book = new BooksWritten;
$book->member_id = $model->id;
$this->renderPartial("/booksWritten/_form", array(
	'model' => $book,
));
echo "</div>";
?>
</div>
