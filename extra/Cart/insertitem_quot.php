<?php
  mysqli_query($conn,"INSERT INTO `quotationdetails` (`caseno`, `productcode`, `productdesc`, `quantity`, `price_cash`, `price_charge`, `datearray`, `nursename`) VALUES ('$caseno', '$code', '$itemname', '$qty', '$spcash', '$spcharge', '".date("Y-m-d")."', '$ccname')");
?>
