<?php
require_once 'connection.php';
require_once 'phpqrcode/qrlib.php';
$path = 'images/';
$qrcode = $path.time().".png";
$qrimg = time().".png";

if(isset($_REQUEST['submit']))
{
$query = mysqli_query($conn,"insert into qrcode set qrimg='$qrimg'");
	if($query)
	{
		?>
		<script>
			alert("Data saved successfully.");
		</script>
		<?php
	}
}

QRcode :: png($file, $qrcode, 'H', 4, 4);
echo "<img src='".$qrcode."'>";
?>