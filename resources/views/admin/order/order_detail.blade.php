@extends('layouts.admin_layout.admin_layout')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
        </div>
      </div>
    </div>
    <section class="content">
      <div class="container-fluid">
      @if(Session::has('error_message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('error_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
            {{ Session::get('success_message') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        @endif
        <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Billing Details</h3>
                </div>

                <div class="card-body">
                    <table id="categories" class="table table-hover">
                        <tbody>
                        <tr>
                            <td>Name </td>
                            <td>{{$userDetails->name}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$userDetails->address}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>{{$userDetails->number}}</td>
                        </tr>
                        <td>City</td>
                            <td>{{$userDetails->city}}</td>
                        </tr>
                        <td>Country</td>
                            <td>{{$userDetails->country}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Update Status</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.order.detail',$orderDetails->id)}}" method="post">
                    @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group" style="width:200px;">
                                    <label for="status">Select Status</label>
                                    <select name="order_status" id="order_status" class="form-control select2">
                                    <option value="New"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="New")
                                    selected
                                    @endif
                                    >New</option>
                                    <option value="Pending"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Pending")
                                    selected
                                    @endif
                                    >Pending</option>
                                    <option value="Cancelling"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Cancelling")
                                    selected
                                    @endif
                                    >Cancelling</option>
                                    <option value="Confirmed"
                                    @if(!empty($orderDetails->status) && $orderDetails->status=="Confirmed")
                                    selected
                                    @endif
                                    >Confirmed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table id="categories" class="table table-bordered table-striped  text-center">
          <thead>
          <tr>
            <th>ID</th>
            <th>Place</th>
            <th>Price</th>
            <th>Checkin Date </th>
            <th>Checkout Date</th>
            <th>Number of Customer</th>

          </tr>
          </thead>
          <tbody>
            @if(!$orderDetails->orderDetails->isEmpty())
            @forelse($orderDetails->orderDetails as $order)
              <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->title}}</td>
                <td>{{$order->price}}</td>
                <td>{{$order->checkin}}</td>
                <td>{{$order->checkout}}</td>
                <td>{{$order->number_of_customer}}</td>
              </tr>
              @empty
              <p>No Data</p>
              @endforelse
            @endif

          </tbody>
        </table>
      </div>
    </section>
</div>

@endsection
@section('script')
<script>
  $(function () {
    $("#categories").DataTable();

  });
</script>
@endsection
