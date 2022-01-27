  <!-- JQVMap -->
  <link rel="stylesheet" href="/theinventory_v2/assets/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/theinventory_v2/assets/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  
<?php

require_once __DIR__ . '/vendor/autoload.php';

include '../../configdb.php';


$adid = $_GET['adid'];
$sqlcust = "SELECT * FROM ad_v2.users AS u 
INNER JOIN itborrow.adddata AS i ON i.users_id = u.id 
INNER JOIN itborrow.equipmet AS ei ON ei.ad_id = i.ad_id
INNER JOIN ad_v2.organizations AS aor ON u.or_id = aor.or_id 
INNER join ad_v2.sides AS asi ON u.side_id = asi.Sid 
INNER join ad_v2.departments AS ade ON u.dep_id = ade.Did 
INNER join itborrow.type AS iy ON ei.TID = iy.TID 
Where ei.ad_id = $adid
Group By i.users_id";
$resultcust = $conn->query($sqlcust);
$rowcust = $resultcust ->fetch_assoc();

$sql = "SELECT * FROM ad_v2.users AS u 
INNER JOIN itborrow.adddata AS i ON i.users_id = u.id 
INNER JOIN itborrow.equipmet AS ei ON ei.ad_id = i.ad_id
INNER JOIN ad_v2.organizations AS aor ON u.or_id = aor.or_id 
INNER join ad_v2.sides AS asi ON u.side_id = asi.Sid 
INNER join ad_v2.departments AS ade ON u.dep_id = ade.Did 
INNER join itborrow.type AS iy ON ei.TID = iy.TID 
Where ei.ad_id = $adid";
$result = $conn->query($sql);

	
$mpdf = new \Mpdf\Mpdf();

$content = '
<style>
	body{
		font-family: "Garuda";
	}
</style>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img style="text-align:right" src="data:image/png;base64,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" width="100" />
<h3 style="text-align:center">บริษัท แสงทองสหฟาร์ม จำกัด</h3>
<h3 style="text-align:center">ใบรับอุปกรณ์</h3>


<h5 style="text-align:left">ข้าพเจ้า(นาย/นาง/นางสาว)..................................................................................หน่วยงาน...............................................เบอร์โทร..............................</h5>
<h5 style="text-align:left">ขอรับอุปกรณ์ดังต่อไปนี้เพื่อใช้ประโยชน์</h5>
<h5><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> ใช้งาน</h5>
<h5><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> เลิกใช้</h5>
<h5><input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> อื่นๆ..........................................................</h5>




<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
    <tr  style="border:1px solid #000;padding:4px;">
    <th  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</th>
    <th  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="30%">ยี่ห้อ</th>
    <th  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="20%">รุ่น</th>
    <th  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="20%">S/N</th>
</tr>';

$products = "";
if (mysqli_num_rows($result) > 0) {
    $i = 1;
    while($objResult = mysqli_fetch_assoc($result)) {
    $products .= '<tr style="border:1px solid #000;">
        <td style="border-right:1px solid #000;padding:3px;text;"  >'.$i.'</td>
        <td style="border-right:1px solid #000;padding:3px;text;"  >'.$objResult["EBland"].'</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$objResult["EModel"].' ชิ้น</td>
        <td style="border-right:1px solid #000;padding:3px;text-align:center;" >'.$objResult["ESN"].' ชิ้น</td>
        
    </tr>
   ';
    $i++;
  }
}


$end = '

</table>

';

$texts = '

<h5 style="text-align:left">


<h5 style="text-align:center">(ลงชื่อ).....................................(ผู้เบิก)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ).....................................</h5>
<h5 style="text-align:center">(จนท.ฝ่ายสนับสนุนเทคโนโลยี)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (จนท./ผจก.สาขา/ผู้บริหาร)</h5>

';

$mpdf->WriteHTML($content);
$mpdf->WriteHTML($products);
$mpdf->WriteHTML($end);
$mpdf->WriteHTML($texts);

$mpdf->Output();

?>
