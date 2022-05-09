<table id="categories" class="table table-bordered table-striped  text-center">
  <thead>
    <tr>
      <th>ID</th>
      <th>Item</th>
      <th>Price</th>
      <th>Qty</th>
      <th>Action</th>
      {{-- <th>Discount</th> --}}
      {{-- <th>Total</th> --}}
    </tr>
  </thead>
  <tbody>
    @forelse($carts as $data)
    <td>{{ $data->id }}</td>
    <td>{{ $data->item }}</td>
    <td>{{ $data->price }}</td>
    <td>{{ $data->quantity }}</td>
    {{-- <td>{{ $data->discount }}</td> --}}
    <td>
      <form action="{{ route('admin.delete.cart',$data->id) }}" method="POST">
      {{-- <a href="{{route('admin.add.edit', $data->id)}}"><i class="fa fa-edit">Edit</i></a>&nbsp;&nbsp; --}}
               @csrf
               <button type="submit" style="border:none; background:none"><i class="fa fa-trash fa-" aria-hidden="true" ></i></button>
           </form>
      </td>
    </tr>
    @empty
    <p>No Data</p>
    @endforelse
    
</tbody>
</table>