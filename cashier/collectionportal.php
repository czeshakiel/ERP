<?php
    $type=$_GET['stat'];
    if($type=='Cash'){
        ?>
        <script>
            window.location="collectionendorsement.php?startdate=<?=$_GET['startdate'];?>";
        </script>
        <?php
    }if($type=='CashOR'){
        ?>
        <script>
            window.location="collectionendorsementOR.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>&department=<?=$_GET['department'];?>&shift=<?=$_GET['shift'];?>";
        </script>
        <?php
    }if($type=='CashORMain'){
        ?>
        <script>
            window.location="collectionendorsementORMain.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>&department=<?=$_GET['department'];?>&shift=<?=$_GET['shift'];?>";
        </script>
        <?php
    }if($type=='Cash1'){
        ?>
        <script>
            window.location="collectionendorsementdetailed.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>&department=<?=$_GET['department'];?>&shift=<?=$_GET['shift'];?>";
        </script>
        <?php
    }if($type=='Cash2'){
        ?>
        <script>
            window.location="collectionendorsementdetailedRDU.php?startdate=<?=$_GET['startdate'];?>&orstart=<?=$_GET['orstart'];?>&orend=<?=$_GET['orend'];?>&orstart1=<?=$_GET['orstart1'];?>&orend1=<?=$_GET['orend1'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }if($type=='Other'){
        ?>
        <script>
            window.location="collectionendorsementother.php?startdate=<?=$_GET['startdate'];?>&orstart=<?=$_GET['orstart'];?>&orend=<?=$_GET['orend'];?>&orstart1=<?=$_GET['orstart1'];?>&orend1=<?=$_GET['orend1'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }else if($type=='Senior'){
        ?>
        <script>
            window.location="collectionendorsementseniormedsup.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>&department=<?=$_GET['department'];?>&shift=<?=$_GET['shift'];?>";
        </script>
        <?php
    }else if($type=='Senior1'){
        ?>
        <script>
            window.location="collectionendorsementseniormedsupdetailed.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>&department=<?=$_GET['department'];?>&shift=<?=$_GET['shift'];?>";
        </script>
        <?php
    }else if($type=='Professional Fee'){
        ?>
        <script>
            window.location="collectionendorsementservices.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }else if($type=='Professional Fee Summary'){
        ?>
        <script>
            window.location="collectionendorsementnormalmedsup.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }else if($type=='APPF'){
        ?>
        <script>
            window.location="collectionendorsementpfcollection.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }else if($type=='PFPHIC'){
        ?>
        <script>
            window.location="collectionendorsementpfcollectionphic.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php
    }else if($type=="CASH SUMMARY"){
        ?>
        <script>
            window.location="collectionsummaryreport.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php    
    }else if($type=="CASH SUMMARY BETA"){
        ?>
        <script>
            window.location="collectionsummaryreportbeta.php?startdate=<?=$_GET['startdate'];?>&nursename=<?=$_GET['nursename'];?>";
        </script>
        <?php    
    }else{
      ?>
      <script>
          window.location="collectionendorsepfsummary.php?startdate=<?=$_GET['startdate'];?>&ap=<?=$_GET['ap'];?>&nursename=<?=$_GET['nursename'];?>";
      </script>
      <?php
    }
?>
