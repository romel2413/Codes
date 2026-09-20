<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>ORDER DETAILS</h1>

    Customer Name   :<h3>{{ $transaction->name }}</h3>
    Customer Email  :<h3>{{ $transaction->email }}</h3>
    Customer Phone  :<h3>{{ $transaction->phone }}</h3>
    Customer Address    :<h3>{{ $transaction->address }}</h3>
    Customer ID :<h3>{{ $transaction->user_id }}</h3>
    Product Name    :<h3>{{ $transaction->product_title }}</h3>
    Product Quantity    :<h3>{{ $transaction->quantity }}</h3>
    Product Price   :<h3>{{ $transaction->price }}</h3>
    Payment Status  :<h3>{{ $transaction->payment_status }}</h3>
    <br><br>
{{-- <img height="250" width="450" src="product/{{ $transaction->image }}" alt=""> --}}


</body>

</html>
