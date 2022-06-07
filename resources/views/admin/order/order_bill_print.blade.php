
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tour | Invoice</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/adminlte.min.css')}}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h2 class="page-header">
                        <i class="fas fa-globe"></i> {{$admin->name}}.
                        <small class="float-right">Date: <?php echo date("d/m/Y") . "<br>";?>                        </small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    From
                    <address>
                        <strong>{{auth('admin')->user()->name}}.</strong><br>
                        {{$admin->name}}<br>
                        Phone: (+977) {{$admin->contact}}<br>
                        {{-- Lane Line: (+977) {{$admin->lane_line}}<br> --}}
                        Email: {{$admin->email}}
                      </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    To
                    <strong>{{$userDetails->name}}</strong><br>
                    {{$userDetails->address}}<br>
                    Phone: (+977) {{$userDetails->number}}<br>
                    Email: {{$userDetails->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                    <b>Invoice #00{{$orderDetails->id}}</b><br>
                    <br>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Title</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $i=1;
                          $subTotal = 0;
                            ?>
                          @if(!$orderDetails->orderDetails->isEmpty())
                              @foreach ($orderDetails->orderDetails as $item)
                              
                                <tr>
                                    <td>{{$i}}</td>
                                    <?php $i++; 
                                     $subTotal += $item->price;
                                    ?>
                                    <td>Tour Charge</td>
                                    <td>{{$item->price}}</td>
                                </tr>
                              @endforeach
                          @endif

                           
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    {{-- <p class="lead">Payment Methods:</p>
                    <img src="../../dist/img/credit/visa.png" alt="Visa">
                    <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                    <img src="../../dist/img/credit/american-express.png" alt="American Express">
                    <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                    </p> --}}
                </div>
                <!-- /.col -->
                <div class="col-6">
                    {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                              <th style="width:50%">Subtotal:</th>
                              <td>{{$subTotal}}</td>
                            </tr>
                            <tr>
                              <th>Tax (0)</th>
                              <td>0</td>
                            </tr>
                            <tr>
                              <th>Total:</th>
                              <td>{{$subTotal}}</td>
                            </tr>
                          </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->

    <script type="text/javascript">
        window.addEventListener("load", window.print());
    </script>
</body>

</html>