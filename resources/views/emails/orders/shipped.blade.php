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
            font-size: 14px;
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

        .d25w {
            width : 25%;
            text-align: center;
            font-size: 13px;
        }

    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">


        <div >
            <div class="fullFlex">
                <img class="logo" width="100px" target="_blank"
                    src="https://res.cloudinary.com/dk93ofxer/image/upload/v1595159521/logo_qiatnl.jpg"
                    alt="florax pharmacy's logo">
            </div>
            <div>
                <h3>Dear {{ $name }},</h3>
                <p>
                    This is to notify you that your order with order number <strong>{{ strtoupper($orderNum) }}</strong> on Florax Pharmacy has been recieved and confirmed.
                </p>
                <p> <a href="{{ $url }}">For more information about your order click on this link</a></p>

                <p>Find below the details of your oder, Kindly contact us if you notice any issue with your order, Thanks</p>


            </div>


            <table style="margin-top:30px;width: 100%; max-width:500px">
                <thead>
                    <tr>
                        <th colspan="2" style="padding:10px">Order details</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p><strong>Order status: </strong>:
                                {{ $order->payment_status ? 'Paid' : 'Awaiting payment' }}</p>
                                <p><strong>Order Number</strong>: {{ strtoupper($orderNum) }}</p>
                                <p><strong>Delivery Type:</strong>:
                                    {{ $order->delivery_type == 1 ? 'Home Delivery' : 'Pick up' }}</p>
                                @if ($order->delivery_location_id)
                                    <p><strong>Shipping Region: </strong>:
                                        {{ $order->deliveryLocation->name }}</p>
                                @endif
                                <p><strong>Phone Number</strong>: {{ $phone }}</p>

                            <p><strong>Date of Order</strong>: {{ $order->created_at }}</p>

                            <p><strong>Email</strong>: {{ $email }}</p>




                        </td>
                    </tr>
                </tbody>
            </table>

            <table style="margin-top:40px">
                <thead>
                    <tr>
                        <th colspan="4" style="padding:20px">Product(s) Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="padding:20px">
                        <td class="d25w"><strong>Product Name</strong> </td>
                        <td class="d25w"><strong>Quantity</strong> </td>
                        <td class="d25w"><strong>Price</strong> </td>
                        <td class="d25w"><strong>Total</strong> </td>
                    </tr>
                    @foreach ($order->orderDetail as $item)
                        <tr >
                            <td class="d25w"> <p> {{ $item->product_name }} </p></td>
                            <td class="d25w"> <p> {{ $item->quantity }} </p></td>
                            <td class="d25w"> <p> {{ '#' . number_format($item->amount) }} </p></td>
                            <td class="d25w"> <p> {{ '#' . number_format($item->total_amount) }} </p></td>
                        </tr>
                    @endforeach
                    <tr>
                        <td style="text-align:center" colspan="3"> <p>Total </p></td>
                        <td><p> <strong>{{ '#' . number_format($order->total_amount) }}</strong></p> </td>
                    </tr>
                </tbody>
            </table>



             {{-- delivery location --}}
             <table style="margin-top:30px; max-width:350px"">
                <thead>
                    <tr>
                        <th style="padding:10px">
                            <p> {{ $order->delivery_type == 1 ? 'Delivery Location' : 'Pick up Location' }}</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding:10px;"> <strong>Address : </strong>{{ $address }} </td>
                    </tr>
                </tbody>
            </table>

            <div style="margin: 50px 0">

                <p>Thanks for your patronage.</p>
                <p>Florax Pharmacy</p>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
