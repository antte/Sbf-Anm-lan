<?php $modelData = $this->requestAction('admins/getModelDump/Person'); ?>
<?php 
debug($modelData);
foreach($modelData[0] as) 
foreach($modelData[0]['Person'] as $fieldName => $fieldValue) {
	$tableHeaders[] = $fieldName;
}
echo $html->tableHeaders($tableHeaders);
echo $html->tableCells($modelData);
