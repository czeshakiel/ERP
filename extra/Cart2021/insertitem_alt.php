<?php
  mysqli_query($mycon1,"INSERT INTO `quotationdetails` (`caseno`, `productcode`, `productdesc`, `quantity`, `price_cash`, `cash_gross`, `cash_disc`, `price_charge`, `datearray`, `nursename`) VALUES ('$caseno', '$code', '$itemname', '$qty', '$spcash', '".($spcash*$qty)."', '0', '$spcharge', '".date("Y-m-d")."', '$ccname')");
?>
