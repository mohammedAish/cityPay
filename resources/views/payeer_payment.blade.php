<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post" action="https://payeer.com/merchant/">
    <input type="hidden" name="m_shop" value="12345">
    <input type="hidden" name="m_orderid" value="1">
    <input type="hidden" name="m_amount" value="1.00">
    <input type="hidden" name="m_curr" value="USD">
    <input type="hidden" name="m_desc" value="dGVzdA==">
    <input type="hidden" name="m_sign" value="9F86D081884C7D659A2FEAA0C55AD015A3BF4F1B2B0B822CD15D6C15B0F0
0A08">
    <!--
    <input type="hidden" name="form[ps]" value="2609">
    <input type="hidden" name="form[curr[2609]]" value="USD">
    -->
    <!--
    <input type="hidden" name="m_params" value="">
    -->
    <input type="submit" name="m_process" value="send"/>
</form>

</body>
</html>