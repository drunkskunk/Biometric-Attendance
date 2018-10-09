<html>
    <head>
<style>
table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>
<?php
function sql_to_html_table($sqlresult, $delim="\n") {
  // starting table
  $htmltable =  "<table>" . $delim ;   
  $counter   = 0 ;
  // putting in lines
  while( $row = $sqlresult->fetch_assoc()  ){
    if ( $counter===0 ) {
      // table header
      $htmltable .=   "<tr>"  . $delim;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<th>" . $key . "</th>"  . $delim ;
      }
      $htmltable .=   "</tr>"  . $delim ; 
      $counter = 22;
    } 
      // table body
      $htmltable .=   "<tr>"  . $delim ;
      foreach ($row as $key => $value ) {
          $htmltable .=   "<td>" . $value . "</td>"  . $delim ;
      }
      $htmltable .=   "</tr>"   . $delim ;
  }
  // closing table
  $htmltable .=   "</table>"   . $delim ; 
  // return
  return( $htmltable ) ; 
}


$mysqli = new mysqli('localhost', 'your_username', 'your_password', 'db_name');   // Database connectivity
	if($mysqli->errno){
		header("location: index.php");
	}
	$stmt1 = $mysqli->query("SELECT * FROM minner;");
	$stmt2 = $mysqli->query("SELECT * FROM mouter;");
echo '<h2>In Log</h2>';
echo sql_to_html_table( $stmt1, $delim="\n" ) ; 
echo '<br>';
echo '<h2>Out Log</h2>';
echo sql_to_html_table( $stmt2, $delim="\n" ) ; 

?>
</body>
</html>
