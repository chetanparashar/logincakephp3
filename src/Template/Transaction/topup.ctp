<?php
$curdate = date('d-m-Y');
$paymode = array('CC' => 'CREDIT CARD', 'DC' => 'DEBIT_CARD', 'NB' => 'NET BANKING');
echo $this->Html->tag('style', "div label{padding:4px 10px;white-space:nowrap;}.sunny{text-align:left;border:2px solid #337ab7;padding:10px;}");
echo $this->Html->div("row");
echo $this->Html->div("col-md-1", '');
echo $this->Html->div("col-md-10 sunny");
echo $this->Html->tag("H2", "Online Payment", array('class' => 'alert-info', 'style' => 'margin-top:0px;text-align:center;border:2px solid #337ab7;background-color: #3C8DBC !important;padding:5px 0px 10px 0px;'));
echo $this->Html->para(isset($response["msgclass"]) ? $response["msgclass"] : "", isset($response['error']) ? $response['msg'] : "", array('id' => 'msgDiv', 'style' => 'text-align:center;height:15px;color:red;'));
echo $this->Form->create('OLP', array("id" => "olp", "target" => "_self", "autocomplete" => "off"));
echo $this->Form->hidden('AuthVar', array('value' => $response["AuthVar"]));
echo $this->Form->hidden('agentcode', array('value' => $response["serno"]));
echo $this->Html->div('row');
echo $this->Html->div('col-sm-3 form-group', $this->Form->label('partyname', 'Party Name'));
echo $this->Html->div('col-sm-9 form-group');
echo $this->Form->input("partyname", array("id" => "partyname", "label" => FALSE, 'div' => array('class' => 'col-sm-9 form-group'), "class" => "form-control", 'value' => $response['partyname'], 'disabled' => true));
echo $this->Html->tag('/div');
echo $this->Html->tag('/div');

echo $this->Html->div('row');
echo $this->Html->div('col-sm-3 ', $this->Form->label('vdate', 'Voucher Date'));
echo $this->Html->div('col-sm-3 form-group');
echo $this->Form->input("vdate", array("id" => "date", "label" => FALSE, 'div' => array('class' => 'col-sm-3  form-group'), "class" => "form-control", 'value' => $curdate, 'disabled' => true));
echo $this->Html->tag('/div');
echo $this->Html->div('col-sm-3 ', $this->Form->label('paymode', 'Payment Mode'));
echo $this->Html->div('col-sm-3  form-group');
echo $this->Form->input("paymode", array("id" => "paymode", "label" => FALSE, 'div' => array('class' => 'col-sm-3  form-group'), "class" => "form-control", 'options' => $paymode, 'selected' => 'NB'));
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
echo $this->Html->div('row');
echo $this->Html->div('bankdiv');
echo $this->Html->div('col-sm-3 ', $this->Form->label('bank', 'Select Bank'));
echo $this->Html->div('col-sm-3 form-group');
echo $this->Form->input("bank", array("id" => "bank", "label" => FALSE, 'div' => array('class' => 'col-sm-3  form-group'), "class" => "form-control", 'options' => '', 'empty' => '---Select--', 'selected' => 'empty'));
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
echo $this->Html->div('col-sm-3 ', $this->Form->label('amount', 'Amount'));
echo $this->Html->div('col-sm-3 form-group');
echo $this->Form->input("amount", array("id" => "amt", "label" => FALSE, 'maxlength' => 7, 'value' => '', 'div' => array('class' => 'col-sm-3  form-group'), 'onkeyup' => "if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')", "class" => "form-control"));
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
echo $this->Html->div('row');
echo $this->Html->div('col-sm-6 col-md-3', $this->Form->label('narration', 'Narration'));
echo $this->Html->div('col-sm-9 form-group');
echo $this->Form->input("narration", array("id" => "narr", "label" => FALSE, 'value' => '', 'div' => array('class' => 'col-sm-6 col-md-9 form-group'), 'onkeyup' => "if (/[^A-Za-z0-9]/g.test(this.value)) this.value = this.value.replace(/[^A-Za-z0-9 ]/g,'')", "class" => "form-control"));
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
echo $this->Form->hidden('javascript', array('id' => 'myscript', 'value' => false));
echo $this->Form->unlockField('javascript');
echo $this->Form->hidden('esbanksexistflg', array('value' => 1));
echo $this->Html->div("row");
echo $this->Html->div('col-sm-4 form-group', '');
echo $this->Html->div('col-sm-2 form-group');
?>
<button type="submit"  class="btn btn-primary btn-block" id="submit">Submit</button>
<?php
//echo $this->Form->button("Submit", array("id" => "submit",/* 'type' => 'button',*/ "class" => "btn btn-block  "));
echo $this->Html->tag("/div");
echo $this->Html->div('col-sm-2 form-group');
?>
<button type="reset"  class="btn btn-primary btn-block" id="reset">Reset</button>
<?php
//echo $this->Form->button("Reset", array("id" => "reset", "type" => "reset", "class" => "btn btn-block"));
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
//echo $this->Html->div('popdiv');
//echo $this->Html->div("sunny", null, array('style' => 'width:70%;background-color:#ECF0F5'));
//echo $this->Html->tag("H4", "", array('id' => 'popmsg', 'style' => 'color:#0D5877;font-size: 18px;margin-top:0px;text-align:center;margin-top:0px;padding:10px 10px;'));
//echo $this->Html->div("row");
//echo $this->Html->div('col-sm-4 form-group', '');
//echo $this->Html->div('col-sm-2 form-group');
//echo $this->Form->button("OK", array("id" => "go", 'type' => 'submit', "class" => "btn btn-primary form-control", 'style' => 'background-color: rgba(91, 132, 91, 0.86)'));
//echo $this->Html->tag("/div");
//echo $this->Html->div('col-sm-2 form-group');
//echo $this->Form->button("Cancel", array("id" => "cancel", "type" => "button", "class" => "btn btn-primary form-control", 'style' => 'background-color:#AE5656;'));
//echo $this->Html->tag("/div");
//echo $this->Html->tag("/div");
//echo $this->Html->tag("/div");
echo $this->Form->end();
echo $this->Html->tag("/div");
echo $this->Html->tag("/div");
?>
<style>
    .popdiv{
        position: fixed;
        left: 0px;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        top: 0px;
        z-index: 1000;
        padding-top:20%;
        padding-left:25%;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {
        alert("document loaded");
    });
    // $('.popdiv').hide();
//        var number = /^([0-9]+)$/;
//        var narr = /^([A-Za-z0-9., ]+)$/;
////        EnterNumericKeyOnly('#amt');
////        EnterAlphaNumericOnly('#narr');
//
//        $('#bank,#amt,#narr').click(function () {
//            $("#msgDiv").html('&nbsp');
//        });
//
//          $('#paymode').change(function(){
//            $('#bankdiv').show();
//            $('#bank').select('');
//            if($('#paymode').val()!="NB")
//             $('#bankdiv').hide();
//            
//        });
//        $("#submit").click(function () {
//            if ($('#agentname').val() == '') {
//                $("#msgDiv").html("Party Name Can Not Black!!!");
//                $("#msgDiv").css("color", "red");
//                return false;
//            }
//            if ($('#vdate').val() == '') {
//                $("#msgDiv").html("Voucher Date Can Not Black!!!");
//                $("#msgDiv").css("color", "red");
//                return false;
//
//            }
//            if ($('#paymentmode').val() == '') {
//                $("#msgDiv").html("Payment Mode Can Not Black!!!");
//                $("#msgDiv").css("color", "red");
//                return false;
//
//            }
//            
//            if ($('#bank').val() == '' && $('#paymode').val()=="NB") {
//                $("#msgDiv").html("Please Select A Bank!!!");
//                $("#msgDiv").css("color", "red");
//                $('#bank').focus();
//                return false;
//
//            }
//            if ($('#amt').val() == '') {
//                $("#msgDiv").html("Amount Can Not Black!!!");
//                $("#msgDiv").css("color", "red");
//                $('#amt').focus();
//                return false;
//
//            }
//            if (!number.test($.trim($('#amt').val()))) {
//                $("#msgDiv").html("Amount Should be in Number Format!!!");
//                $("#msgDiv").css("color", "red");
//                $('#amt').focus();
//                return false;
//
//            }
//            if ($.trim($('#amt').val()) < 1000 || $.trim($('#amt').val()) > 1000000) {
//                $("#msgDiv").html("Amount Range Must be 1000 to 1000000 !!!");
//                $("#msgDiv").css("color", "red");
//                $('#amt').focus();
//                return false;
//
//            }
//            if ($.trim($('#narr').val()) == "") {
//                $("#msgDiv").html("Narration can not black!!!");
//                $("#msgDiv").css("color", "red");
//                $('#narr').focus();
//                return false;
//            }
//            if (!narr.test($.trim($('#narr').val()))) {
//                $("#msgDiv").html("In The Narration Allowed Aphanumeric or . , !!!");
//                $("#msgDiv").css("color", "red");
//                $('#narr').focus();
//                return false;
//            }
    //$('#myscript').val(true);
    //$('#popmsg').html('Are You Confrim ? For This Transaction Amount=' + $.trim($('#amt').val()));
    // $('.popdiv').show();


//        });
//        $('#go').click(function () {
//            $('#olp').submit();
//        });
    // $('#cancel').click(function () {
    //   $('.popdiv').hide();
    //});
//        $('#reset').click(function () {
//            $('#narr').val('');
//            $('#amt').val('');
//             $('#bankdiv').show();
//        });


//    });
</script>
