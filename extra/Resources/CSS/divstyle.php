<script type="text/JavaScript">
<!--
function placeFocus() {
  if (document.forms.length > 0) {
    var field = document.forms[0];
    for (i = 0; i < field.length; i++) {
      if ((field.elements[i].type == "password") || (field.elements[i].type == "textarea") || (field.elements[i].type.toString().charAt(0) == "s")) {
        document.forms[0].elements[i].focus();
        break;
      }
    }
  }
}

function toggleCodes(on) {
  var obj = document.getElementById('icons');

  if (on) {
    obj.className += ' codesOn';
  } else {
    obj.className = obj.className.replace(' codesOn', '');
  }
}
//-->
</script>
<style>
@font-face {
  font-family: 'edit';
  src: url('./font/edit.eot?50604029');
  src: url('./font/edit.eot?50604029#iefix') format('embedded-opentype'),
       url('./font/edit.woff?50604029') format('woff'),
       url('./font/edit.ttf?50604029') format('truetype'),
       url('./font/edit.svg?50604029#edit') format('svg');
  font-weight: normal;
  font-style: normal;
}
.demo-icon {
  font-family: "edit";
  font-style: normal;
  font-weight: normal;
  speak: never;
     
  display: inline-block;
  text-decoration: inherit;
  width: 1em;
  margin-right: .2em;
  text-align: center;
  /* opacity: .8; */
     
  /* For safety - reset parent styles, that can break glyph codes*/
  font-variant: normal;
  text-transform: none;
     
  /* fix buttons height, for twitter bootstrap */
  line-height: 1em;
     
  /* Animation center compensation - margins should be symmetric */
  /* remove if not needed */
  margin-left: .2em;
    
  /* You can be more comfortable with increased icons size */
  /* font-size: 120%; */
   
  /* Font smoothing. That was taken from TWBS */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  /* Uncomment for 3D effect */
  /* text-shadow: 1px 1px 1px rgba(127, 127, 127, 0.3); */
}

.divstyle .btn {padding: 5px 10px;border: none;cursor: pointer;opacity: 0.8;border-radius: 0px;}
.divstyle .btn:hover, .open-button:hover {opacity: 1;}


/*
 CSS for the main interaction
*/
.tabset > input[type="radio"] {
  position: absolute;
  left: -200vw;
}

.tabset .tab-panel {
  display: none;
}

.tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
.tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
.tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
.tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
.tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
.tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
  display: block;
}

/*
 Styling
*/
.bodyset {
  font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
  color: #333;
  font-weight: 300;
}

.tabset > label {
  position: relative;
  display: inline-block;
  padding: 10px 10px 15px;
  border: 1px solid transparent;
  border-bottom: 0;
  cursor: pointer;
  font-weight: 600;
}

.tabset > label::after {
  content: "";
  position: absolute;
  left: 15px;
  bottom: 10px;
  width: 22px;
  height: 4px;
  background: #8d8d8d;
}

.tabset > label:hover,
.tabset > input:focus + label {
  color: #06c;
}

.tabset > label:hover::after,
.tabset > input:focus + label::after,
.tabset > input:checked + label::after {
  background: #06c;
}

.tabset > input:checked + label {
  border-color: #000000;
  border-top: 3px solid;
  border-bottom: 3px solid #fff;
  margin-bottom: -3px;
}

.tab-panel {
  padding: 5px 0;
  border-top: 3px solid #000000;
}

/*
 Demo purposes only
*/
*,
*:before,
*:after {
  box-sizing: border-box;
}


.tabset {
  max-width: 100%;
}


/* Define the default color for all the table rows */
.hoverTable tr{background: #ffffff;}

/* Define the hover highlight color for the table row */
.hoverTable tr:hover {background-color: #ffff99;}
</style>

