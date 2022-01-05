<html>
 <head>
  <title>ADM 1C</title>
  <link href="./external.css" rel="stylesheet">
 </head>
 <body>
  <div class="header"><h1>1C admin session</h1></div>
  <div class="sidebar">
    
	<div class="header2"><h3>Офисные БД</h3></div>
	<form method="POST">
			<input name="DB" id="DB" value="3b2f6a2e-fe52-41cf-9d29-78984470c4a2" type="hidden" readonly >
			<input name="SRV" id="SRV" value="192.168.0.2" type="hidden" readonly >
			<input name="CL" id="CL" value="daca2f07-0606-4034-8128-c1e57e1fc643" type="hidden" readonly >
			<input type="submit" name="DBSELECT" value="HUB" style="width:120px;height:25px"/>
        </form>
	<div class="header2"><h3>ERP</h3></div>
	<form method="POST">
    		<input name="DB" id="DB" value="065a2b34-1fc7-46c6-a6e5-447b3c72e510" type="hidden" readonly >
			<input name="SRV" id="SRV" value="192.168.0.7:1645" type="hidden" readonly >
			<input name="CL" id="CL" value="2a4a0eb1-50a6-459c-bd95-5f125e3c92c6" type="hidden" readonly >
			<input type="submit" name="DBSELECT" value="ERP" style="width:120px;height:25px" />
        </form>
	<div class="header2"><h3>WMS</h3></div>
	<form method="POST">
    		<input name="DB" id="DB" value="fff78869-3a75-4fde-ac53-2a7ae9a71d44" type="hidden" readonly >
			<input name="SRV" id="SRV" value="192.168.0.4" type="hidden" readonly >
			<input name="CL" id="CL" value="5ba0af8c-077f-413b-a445-912db31da02b" type="hidden" readonly >
			<input type="submit" name="DBSELECT" value="WMS" style="width:120px;height:25px" />
        </form>
  </div>
  <div class="content">
    <h2>Список сеансов в выбранной базе</h2>
	
<body>
<table class="table_dark">
            <tr>
                <th>User Name</th>
                <th>Session</th>
                <th>Session-ID</th>
				<th>Action</th>
            </tr>
<?php
$DB=htmlspecialchars($_POST['DB']);
$CL=htmlspecialchars($_POST['CL']);
$SRV=htmlspecialchars($_POST['SRV']);
$SU=htmlspecialchars($_POST['SU']);

if( isset( $_POST['DBSELECT'] ) )
    {

		exec(" /opt/1C/v8.3/x86_64/rac $SRV session list --cluster=$CL  --infobase=$DB | grep user-name | cut -d':' -f2", $username);
        exec(" /opt/1C/v8.3/x86_64/rac $SRV session list --cluster=$CL  --infobase=$DB | grep -E 'session(\s|$)' | cut -d':' -f2 | sed s/' '//g", $session);
        exec(" /opt/1C/v8.3/x86_64/rac $SRV session list --cluster=$CL  --infobase=$DB | grep -E 'session-id(\s|$)' | cut -d':' -f2 | sed s/' '//g", $sessionid);
		$srv1C = array_fill(0 , count($username) , $SRV);
		$cluster1C = array_fill(0 , count($username) , $CL);
		array_map(function($V1, $V2, $V3, $V4, $V5) {
            echo "<tr>
            <td>".$V1."</td>
            <td>".$V2."</td>
            <td>".$V3."</td>
			<td><form method='POST'>
			<input name='SRV' id='SRV' value=".$V4." type='hidden' readonly>
			<input name='CL' id='CL' value=".$V5." type='hidden' readonly>
			<input name='SU' id='SU' value=".$V2." type='hidden' readonly>
			<input class ='deleteSession' type='submit' name='USRSELECT' value='Delete Session'/>
        	</form>
			</td>
            </tr>";
        },  $username, $session, $sessionid, $srv1C, $cluster1C);
        }else{
		
	    }

if( isset($_POST['USRSELECT'] ) )
    {
		exec(" /opt/1C/v8.3/x86_64/rac $SRV session --cluster=$CL  terminate --session=$SU");
	echo "Session delete";
    }else{
		
	}

?>
</table>
</body>
  </div>
  <div class="footer">&copy; 2021</div>
 </body>
</html>