<?php
echo '
<script type="text/JavaScript">
  <!--
    function placeFocus() {
      if (document.forms.length > 0) {
        var field = document.forms[0];
        for (i = 0; i < field.length; i++) {
          if ((field.elements[i].type == "text") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
            document.forms[0].elements[i].focus();
            break;
          }
        }
      }
    }
    function showResult() {
      if (document.searchme.searchme.value.length==0) {
        document.getElementById("livesearch").innerHTML=" ";
        return;
      }
      if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
          document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","sot.php?caseno='.$caseno.'&dept='.$dept.'&ct='.$ct.'&user='.$user.'&tick='.$tick.'&at='.$totgross.'&cl='.$cl.'&searchme="+document.searchme.searchme.value,true);
      xmlhttp.send();
    }

    function MM_openBrWindow(theURL,winName,features) { //v2.0
      window.open(theURL,winName,features);
    }
  //-->
</script>
';
?>
