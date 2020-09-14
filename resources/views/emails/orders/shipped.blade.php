<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="widtd=device-width, initial-scale=1">

    <title>Invoice</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
            padding: 5px
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {

            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            width: 100%;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }



        .m-b-md {
            margin-bottom: 30px;
        }

        tbody,
        thead {
            background: #e4e4ec2e;


            max-width: 500px;
            justify-content: center;
            color: black;
        }

        thead {
            padding: 10px;
            text-transform: uppercase;
            padding-bottom: 0;

        }



        .flex,
            {
            display: flex !important;
        }

        .td {
            border: 3px solid white;
            padding: 10px;
            width: 50%;
        }

        table {
            max-widtzh: 500px;
        }

        .fullFlex {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            margin: 10px 0;
        }



    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">

        <div class="content">
            <div class="fullFlex">
                <img class="logo" width="100px" target="_blank"
                    src="https://res.cloudinary.com/dk93ofxer/image/upload/v1595159521/logo_qiatnl.jpg"
                    alt="florax pharmacy's logo">
            </div>
            <div>
                <h3>Dear {{ $name }},</h3>
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero alias pariatur molestias, non
                    voluptates velit distinctio aspernatur fugiat at, placeat, nobis beatae? Inventore nesciunt tempora
                    omnis similique autem eligendi maiores!
                </p>

                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta amet accusamus doloremque ipsum qui
                    debitis pariatur ipsa eligendi? Harum, nihil? Non, ratione error? Sed nemo voluptatem nobis
                    accusantium maiores quidem.</p>

                <p> <a href="{{ $url }}">For more information about your order; click on this link</a></p>

                <p>Thanks for shopping on florax Pharmacy</p>
            </div>


            <table>
                <thead>
                    <tr>
                        <th colspan="2" style="padding:10px">Order details</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td >
                            <p><strong>Order Number</strong>: {{ $orderNum }}</p>
                            <p><strong>Date of Order</strong>: {{ $order->created_at }}</p>
                            <p><strong>Delivery Type:</strong>:
                                {{ $order->delivery_type == 1 ? 'Home Delivery' : 'Pick up' }}</p>
                            @if ($order->delivery_location_id)
                                <p><strong>Shipping Region: </strong>:
                                    {{ $order->deliveryLocation->name }}</p>
                            @endif

                        </td>

                        <td class="td">
                            <p><strong>Email</strong>: {{ $email }}</p>
                            <p><strong>Telephone</strong>: {{ $phone }}</p>

                            <p><strong>Order status: </strong>:
                                {{ $order->payment_status ? 'Paid' : 'Awaiting payment' }}</p>
                        </td>

                    </tr>
                </tbody>
            </table>

            {{-- delivery location --}}
            <table style="margin-top:30px">
                <thead>
                    <tr>
                        <th style="padding:10px">
                           <p > {{ $order->delivery_type == 1 ? 'Delivery Location' : 'Pick up Location' }}</p></th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:10px">
                            {{ $address }}
                        </td>
                    </tr>
                </tbody>
            </table>


            <table style="margin-top:30px">
                <thead>
                    <tr>
                        <th style="padding:10px">
                            {{ $order->delivery_type == 1 ? 'Delivery Location' : 'Pick up Location' }}</th>

                    </tr>
                </thead>
                <tbody>
                    <tr >
                        <td><strong>Product Name</strong> </td>
                        <td><strong>Quantity</strong> </td>
                        <td><strong>Price</strong> </td>
                        <td><strong>Total</strong> </td>
                    </tr>
                    @foreach ($order->orderDetail as $item)
                        <tr style="display: flex">
                            <td> {{ $item->product_name }} </td>
                            <td> {{ $item->quantity }} </td>
                            <td> {{ '#' . number_format($item->amount) }} </td>
                            <td> {{ '#' . number_format($item->total_amount) }} </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align:right" colspan="2"> {{ $item->product_name }} </td>
                        <td> {{ '#' . number_format($item->total_amount) }} </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
