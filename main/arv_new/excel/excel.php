<script type="text/javascript">
function ExportToExcel(type, fn, dl) {
var elt = document.getElementById('excel');
var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
return dl ?
XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
}


function printDiv() {
var divContents = document.getElementById("GFG").innerHTML;
var a = window.open('', '', 'height=500, width=500');
a.document.write('<html>');
a.document.write(divContents);
a.document.write('</body></html>');
a.document.close();
a.print();
}
</script>  

