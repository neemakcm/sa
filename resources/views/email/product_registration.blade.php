
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impex</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{URL('public/user-assets/font-Geosans/font-Geosans/styles.css')}}">
</head>

<body style="margin: 0rem;padding: 0rem;box-sizing: border-box;">
    <table cellspacing="0" cellpadding="0" border="0" height="100%" width="100%" style="margin-top: 0px;">

        <!-- [ header starts here] -->
        <tbody>
            <tr>
                <td align="center" valign="top">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" style="background: #F5F5F5;">
                        <tbody>
                            <tr>
                               
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- [ Nav starts here] -->
            <tr>
                <td align="center" valign="top" style="padding:0px 0 0 0;">
                    <table style="width: 600px;background-color: #fff;" border="0">
                        <tbody>
                            <tr>
                                <td style="font-family:'Poppins',sans-serif">
                                    <h1 style="text-align: center;margin: 0.3em 0rem 0rem;">
                                        Product Registration
                                    </h1>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div
                                        style="display: block;width: 170px;height: 1px;background-color: #1BA44B;margin: 0px auto;margin-bottom: 8px;">
                                    </div>
                                    <div
                                        style="display: block;width: 98px;height: 1px;background-color: #1BA44B;margin: 0px auto;margin-bottom: 8px;">
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <!-- [ middle starts here] -->

            <tr>
                <td align="center" valign="top" style="padding:0px 0 0 0">
                    <table style="background: #fff;padding-bottom: 30px;" cellspacing="0" cellpadding="0" border="0"
                        width="600">
                        <tbody>
                            <tr>
                               
                                <td>
                                    <table width="100%">
                                        <tbody>
                                            <tr>
                                                <td>Name</td>
                                                <td> {{$data->first_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Last Name</td>
                                                <td> {{$data->last_name}}</td>
                                            </tr>
                                            <tr>
                                                <td>mobile</td>
                                                <td> {{$data->mobile}}</td>
                                            </tr>
                                            <tr>
                                                <td>email</td>
                                                <td> {{$data->email}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td> {{$data->address_1}}</td>
                                            </tr>
                                            <tr>
                                                <td>Address</td>
                                                <td> {{$data->address_2}}</td>
                                            </tr>
                                            <tr>
                                                <td>District</td>
                                                <td> {{$data->district}}</td>
                                            </tr>
                                           
                                            @if($data->states)
                                         
                                          
                                            <tr>
                                                <td>State</td>
                                                <td> {{$data->states->name}}</td>
                                            </tr>
                                            
                                            @endif
                                            @if($data->category)
                                            <tr>
                                                <td>Category</td>
                                                <td> {{$data->category->name}}</td>
                                            </tr>
                                            @endif
                                            @if($data->products)
                                            <tr>
                                                <td>Product</td>
                                                <td> {{$data->products->name}}</td>
                                            </tr>
                                            <tr>
                                                <td>Model No</td>
                                                <td> {{$data->products->sku}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Purchased From</td>
                                                <td> {{$data->purchased_from}}</td>
                                            </tr>
                                            <tr>
                                                <td>Purchased Date</td>
                                                <td> {{$data->purchased_date}}</td>
                                            </tr>
                                            <tr>
                                                <td>Serial No</td>
                                                <td> {{$data->serial_number}}</td>
                                            </tr>
                                          
                                            
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>

            <!-- [ middle ends here] -->

            <!-- [ footer starts here] -->
            <tr>
                <td>
                    <table style="margin: 0px auto;width: 600px;" cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                            <tr>
                                <td>
                                    <table cellspacing="0" cellpadding="0" border="0"
                                        style="width: 364px;margin: 0px auto;font-family: 'GeosansLight';text-align: center;margin-bottom: 15px;">
                                        <tbody>
                                            <tr>
                                                <td style="font-size: 14px;line-height: 14px;color: #000000;">
                                                    Copyright © 2021 Impex. All Rights Reserved.
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>




</body>

</html>


