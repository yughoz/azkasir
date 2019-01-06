<style type="text/css">
        .selectize-control.selectizer .selectize-dropdown [data-selectable] {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            /*height: 60px;*/
            position: relative;
            -webkit-box-sizing: content-box;
            box-sizing: content-box;
            padding: 10px 10px 10px 10px;
        }
        /*
        .selectize-control.selectizer .selectize-dropdown [data-selectable]:last-child {
            border-bottom: 0 none;
        }
        .selectize-control.selectizer .selectize-dropdown .by {
            font-size: 11px;
            opacity: 0.8;
        }
        .selectize-control.selectizer .selectize-dropdown .by::before {
            content: 'by ';
        }
        .selectize-control.selectizer .selectize-dropdown .name {
            font-weight: bold;
            margin-right: 5px;
        }
        .selectize-control.selectizer .selectize-dropdown .description {
            font-size: 12px;
            color: #a0a0a0;
        }
        .selectize-control.selectizer .selectize-dropdown .actors,
        .selectize-control.selectizer .selectize-dropdown .description,
        .selectize-control.selectizer .selectize-dropdown .title {
            display: block;
            white-space: nowrap;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .selectize-control.selectizer .selectize-dropdown .actors {
            font-size: 10px;
            color: #a0a0a0;
        }
        .selectize-control.selectizer .selectize-dropdown .actors span {
            color: #606060;
        }
        .selectize-control.selectizer .selectize-dropdown img {
            height: 60px;
            left: 10px;
            position: absolute;
            border-radius: 3px;
            background: rgba(0,0,0,0.04);
        }
        .selectize-control.selectizer .selectize-dropdown .meta {
            list-style: none;
            margin: 0;
            padding: 0;
            font-size: 10px;
        }
        .selectize-control.selectizer .selectize-dropdown .meta li {
            margin: 0;
            padding: 0;
            display: inline;
            margin-right: 10px;
        }
        .selectize-control.selectizer .selectize-dropdown .meta li span {
            font-weight: bold;
        }
        .selectize-control.selectizer::before {
            -moz-transition: opacity 0.2s;
            -webkit-transition: opacity 0.2s;
            transition: opacity 0.2s;
            content: ' ';
            z-index: 2;
            position: absolute;
            display: block;
            top: 12px;
            right: 34px;
            width: 16px;
            height: 16px;
            background: url(images/spinner.gif);
            background-size: 16px 16px;
            opacity: 0;
        }
        .selectize-control.selectizer.loading::before {
            opacity: 0.4;
        }
        */
        </style>
<form class="form-horizontal az-form" id="form_product" name="form" method="post">
    <input type="hidden" name="idtransaction_group" tabindex="1" id="idtransaction_group" value="<?php echo $idtransaction_group;?>"/>
    <div class="form-group">
        <label for="" class="col-sm-1 control-label"><?php echo azlang('Product');?></label>
        <div class="col-sm-3">
              <select id="productSelect" class="selectizer" placeholder="select product name" tabindex="1">
                <option value="">Product Name</option>
              </select>
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-1 control-label"><?php echo azlang('Barcode');?></label>
        <div class="col-sm-3">
            <?php
                echo $product;
            ?>
        </div>
        <label class="col-sm-7 control-label txt-left">
            <div id="l_product_name" class="l-product-name"></div>
        </label>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-1 control-label"><?php echo azlang('Qty');?></label>
        <div class="col-sm-1">
            <input class="form-control txt-center format-number" tabindex="2" type="number" min="1" name="qty" id="qty" placeholder="1" maxlength="5" />
        </div>
    </div>
    <div class="form-group">
        <label for="" class="col-sm-1 control-label"><?php echo azlang('Grosir');?></label>
        <div class="col-sm-1">
            <!-- cheks -->
            <input class="form-control" type="checkbox" name="grosirBtn" id="grosirBtn" value="grosir"/>
        </div>
    </div>
</form>

<div class="transaction-group-code-div">
    Nota &nbsp;
    <input style="width:150px;" type='text' id='transaction_group_code_hd' readonly value='<?php echo $transaction_group_code;?>'/>
</div>

<div class="transaction-price">
    <?php echo $transaction_price;?>
</div>


<div class="transaction-btn">
    <button tabindex="3" class="btn btn-primary" type="button" id="btn_add_transaction"><i class="fa fa-plus"></i> <?php echo azlang('Add');?></button>&nbsp;
    <button tabindex="4" class="btn btn-primary" type="button" id="btn_payment"><i class="fa fa-floppy-o"></i> <?php echo azlang('Payment');?></button>&nbsp;
    <a href="<?php echo app_url().'transaction';?>"><button tabindex="5" class="btn btn-info" type="button"><i class="fa fa-file-o"></i> <?php echo azlang('New Transaction');?></button></a>
</div>
<br>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/selectize/dist/css/selectize.bootstrap2.css">
<script type="text/javascript" src="<?php echo base_url() ?>assets/plugins/selectize/dist/js/standalone/selectize.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        backProductSelect = false;
        grosirBtn = false;
        jQuery("#barcode").focus();
        refresh_sess();
        jQuery('#productSelect').selectize({
            valueField: 'barcode',
            labelField: 'name',
            searchField: 'name',
            options: [],
            create: false,
            render: {
                option: function(item, escape) {

                    return '<div>' +
                        '<span class="title">' +
                            '<span class="name">' + escape(item.name) + '</span>' +
                        '</span>' +
                    '</div>';
                }
            },
            load: function(query, callback) {
                if (!query.length) return callback();
                $.ajax({
                    url: '<?php echo base_url() ?>product/getSelect',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        p_name: query,
                    },
                    error: function() {
                        callback();
                    },
                    success: function(res) {
                        // console.log(res.data[0].name);
                        // callback(res.data[0].name);
                        callback(res.data);
                    }
                });
            }
        });

        jQuery('#productSelect').on("change", function(e) {
            // alert(jQuery('#productSelect').val());
            if (jQuery('#productSelect').val() != "") {
                jQuery("#barcode").val(jQuery('#productSelect').val());
                jQuery("#l_product_name").text("");
                jQuery("#qty").focus();
                backProductSelect =  true;
                // add_transaction();
            };
            
            // alert(jQuery('#productSelect').val());
        });

        jQuery("#btn_add_transaction").click(function() {
            add_transaction();
        });

        jQuery("#barcode, #qty").on("keyup", function(e) {
            jQuery("#l_product_name").text("");
            if (e.keyCode == 13) {
                add_transaction();
            }
        });

        jQuery("#btn_hold").click(function() {
            hold_transaction();
        });

        jQuery("#btn_payment").click(function() {
            show_modal("payment");
            jQuery(".az-modal .modal-title").text("<?php echo azlang('Payment');?>");
        });

        jQuery(document).on("hidden.bs.modal", ".modal", function () {
            jQuery("#barcode").focus();
        });

        jQuery('#grosirBtn').change(function(){
            grosirBtn = $(this).is(':checked');
             // alert($(this).is(':checked'));
             // alert($(this).val()); //gives you 'your_value' in any case
        }); 

        function refresh_sess() {
            // alert("test");
            $.ajax({
                    url: '<?php echo base_url() ?>product/getSelect',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        p_name: "",
                    },
                    error: function() {
                        // callback();
                    },
                    success: function(res) {
                        setTimeout(function(){ refresh_sess(); }, 10000);
                        // console.log(res.data[0].name);
                        // callback(res.data[0].name);
                        // callback(res.data);
                    }
                });

        }
        function add_transaction() {
            show_loading();
            // alert(jQuery('#grosirBtn').val());
            // alert(grosirBtn);
            
            jQuery.ajax({
                url: app_url+'transaction/add_transaction',
                data: {
                    "barcode" : jQuery("#barcode").val(),
                    "qty" : jQuery("#qty").val(),
                    "grosir" : grosirBtn,
                    "idcustomer" : jQuery("#idcustomer").val(),
                    "transaction_date" : jQuery("#transaction_date").val(), 
                    "idtransaction_group" : jQuery("#idtransaction_group").val()
                },
                dataType: 'JSON',
                type: 'POST',
                success: function(response){
                    hide_loading();
                    if (response.sMessage != "") {
                        bootbox.alert({
                            title: "Error",
                            message: response.sMessage
                        });
                    }
                    else {
                        jQuery("#idtransaction_group").val(response.idtransaction_group);
                    }

                    var dtable = jQuery('#transaction').dataTable({bRetrieve:true});
                    dtable.fnDraw();

                    jQuery("#barcode").val("");
                    jQuery("#l_product_name").text("");
                    jQuery("#qty").val("");
                    if (backProductSelect == true) {
                        jQuery("#productSelect").focus();
                        jQuery("#barcode").focus();
                        backProductSelect = false;
                    } else {
                        jQuery("#barcode").focus();
                    }
                    jQuery('#productSelect').val("");

                    jQuery(".transaction-price").html(response.final_price);
                    jQuery("#btn_hold").prop("disabled", false);
                },
                error:function(response){
                    console.log(response);
                }
            });
        }

        function hold_transaction() {
            jQuery.ajax({
                url: app_url+'transaction/hold_transaction',
                data: {
                    "idtransaction_group" : jQuery("#idtransaction_group").val()
                },
                dataType: 'JSON',
                type: 'POST',
                success: function(response){
                    if (response.sMessage != "") {
                        bootbox.alert({
                            title: "Error",
                            message: response.sMessage
                        });
                    }
                    else {
                        bootbox.alert({
                            title: "Success",
                            message: "Transaksi Berhasil Ditahan"
                        });
                        location.href = "<?php echo app_url();?>transaction";
                    }
                },
                error:function(response){
                    console.log(response);
                }
            });
        }

    });
</script>