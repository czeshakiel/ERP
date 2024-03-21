<?php
  mysqli_query($mycon1,"INSERT INTO `quotationdetails` (`caseno`, `productcode`, `productdesc`, `quantity`, `price_cash`, `price_charge`, `datearray`, `nursename`) VALUES ('$caseno', '$code', '$itemname', '$qty', '$spcash', '$spcharge', '".date("Y-m-d")."', '$ccname')");
?>
