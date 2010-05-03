<?php 

echo '<table>';
echo $html->tableHeaders($heads);
echo $html->tableCells($dump);
echo '</table>';
debug($dump);

?>