<html>
<head>
	<style type="text/css">
	/*body {
	    height: 100px;
	    width: 50%;
	    background-color: powderblue;
	}*/
	 @media print {
                @page  { 
                    width: 80mm;
                    margin: 0mm;
                    font-size:16px;
                }
            }

	</style>
	<title>Print Barcode</title>
</head>
<body onload="window.print();">
	<a href=""></a>
	<H5><?php echo $name ?></H5>
	<div id="barcodePrint"></div>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/plugins/jquery/jquery-barcode.js')?>"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        // jQuery("#printBarcode").click(function() {
            $("#barcodePrint").barcode(
                "<?php echo $barcode ?>", // Value barcode (dependent on the type of barcode)
                "ean13" // type (string)
            );

            // alert(jQuery("#barcode").val());
            // jQuery("#barcodePrint").JsBarcode("Hi!");
        // });
    });
</script>
</body>
	
</html>