<?php $modelName = $this->params['pass'][0]; ?>
<?php $modelData = $this->requestAction('admins/getModelDump/'. $modelName); ?>
<?php 

debug($modelData);
foreach($modelData[0]['Person'] as $fieldName => $fieldValue) {

$modelNames = array_keys($modelData[0]);

echo "<table>";
echo "<thead>";
//from the first row in the table ($modelData[0]) on the first model ($modelNames[0]) add fieldName to tabelHeaders
foreach($modelData[0][$modelNames[0]] as $fieldName => $fieldValue) {
	$tableHeaders[] = $fieldName;
}
echo "</thead>";
echo "<tbody>";

echo $html->tableHeaders($tableHeaders);
foreach($modelData as $dataSet) {
	echo $html->tableCells($dataSet[$modelNames[0]]);
}
echo "</tbody>";
echo "</table>";