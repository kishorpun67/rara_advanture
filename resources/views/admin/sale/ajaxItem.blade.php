@forelse ($foodMenus as $data)
<a href="javascript:" class="add_item" item_id="{{ $data->id }}" price="{{ $data->sale_price }}"  names="{{$data->name }}">
<div class="card" style="width: 18rem;">
   <img class="card-img-top" src="{{asset($data->image)}}" alt="" width="100" height="100" srcset="">
  <div class="card-body">
    <h5 class="card-title">{{ $data->name }}</h5>
    <p class="card-text">Price: {{ $data->sale_price }}</p>
  </div>
</div>
</a>

@empty
@endforelse