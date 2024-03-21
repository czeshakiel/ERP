<?php
echo "
    <!-- Body: Header -->
    <div class='header'>
      <nav class='navbar py-4'>
        <div class='container-xxl'>
          <!-- header rightbar icon -->
          <div class='h-right d-flex align-items-center mr-5 mr-lg-0 order-1'>
            <div class='d-flex'>

            </div>
            
           
          </div>
          <!-- menu toggler -->
          <button class='navbar-toggler p-0 border-0 menu-toggle order-3' type='button' data-bs-toggle='collapse' data-bs-target='#mainHeader'>
            <span class='fa fa-bars'></span>
          </button>
          <!-- Company Header-->
          <div>
            <table width='100%'>
              <tr>
                <td width='10%'><img src='".$ipadd."img/logo/mmshi.png' width='60px'></td>
                <td style='font-size: 13px;'><b>$heading</b><br>$address<br>$telno</td>
              </tr>
            </table>
          </div>

        </div>
      </nav>
    </div>
";

if($arv_ip!=="$ip"){echo"<script>window.location='http://$arv_ip/ERP/pages-error-404.html';</script>";}
?>
