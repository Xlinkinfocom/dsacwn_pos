<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
<script>
    $(document).ready(function(){
        document.getElementById("paypalForm").submit();
    });
</script>
<form name="paypalForm" id="paypalForm" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="cmd" value="_xclick">
    <input type="hidden" name="item_name" value="{{ $paypal_data['invoice_id'] }}">
    <input type="hidden" name="business" value="subratasah@gmail.com">
    <input type="hidden" name="currency_code" value="USD">
    <input type="hidden" name="return" value="{{ route('paypal') }}">
    <input type="hidden" name="cancel_return" value="{{ route('cancel_return') }}">
    <input type="hidden" name="address_override" value="0">
    <input type="hidden" name="item_number" value="{{ $data['package_id'] }}">
    <input type="hidden" name="quantity" value="1">
    <input type="hidden" name="invoice" value="{{ $paypal_data['invoice_id'].'|'.rand(9,999) }}">
    <input type="hidden" name="cbt" value="Please click here to confirm your payment">
    <input type="hidden" name="country" value="GB">
</form>
