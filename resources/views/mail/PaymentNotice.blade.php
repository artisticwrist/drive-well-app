<!DOCTYPE html>
<html>

<head>
    <title>Payment Reciept</title>
</head>

<body>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>reference:</strong> {{ $data['reference'] }}</p>
    <p><strong>amount:</strong>{{ $data['amount'] }}</p>
    <p><strong>duration:</strong>{{ $data['duration'] }} hours</p>
</body>

</html>
