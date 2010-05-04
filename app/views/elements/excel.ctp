<?php 

$exportType = $this->params['pass'][0];
$modelData = $this->requestAction('admins/getExport/'. $exportType);

$modelNames = array_keys($modelData[0]);

echo "<table style='border:1px solid #000;'>";
echo "<thead style='border:1px solid #000;'>";
	
	//from the first row in the table ($modelData[0]) on the first model ($modelNames[0]) add fieldName to tabelHeaders
	foreach($modelData[0][$modelNames[0]] as $fieldName => $fieldValue) {
		//TODO translate
		$tableHeaders[] = $fieldName;
	}
	
	echo $html->tableHeaders($tableHeaders, array('style' => 'border:1px solid #000;'));

echo "</thead>";
echo "<tbody>";
	foreach($modelData as $dataSet) {
		echo $html->tableCells($dataSet[$modelNames[0]], array('style' => 'border:1px solid #000;'), array('style' => 'border:1px solid #000;'));
	}

echo "</tbody>";
echo "</table>";