@extends('admin.adminLayout')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h3 align="center" style="text-shadow: 1px 1px 5px grey;">Danh sách đơn hàng</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên khách hàng</th>
                    <th>Trạng thái đơn hàng</th>
                    <th>Ngày đặt đơn</th>
                    <th>Tổng đơn</th>
                    <th>Xem</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                       <td>{{$order->id}}</td>
                        <td>{{$order->customerName}}</td>
                        <td>@if($order->status==0)
                                Chưa xử lý
                            @elseif($order->status == 1)
                                Đang vận chuyển
                            @else
                                Đã giao
                            @endif
                        </td>
                        <td>{{$order->created_at->format('h:m:s-d/m/Y')}}</td>
                        <td>{{number_format($order->subTotal)}}</td>
                        <td align="left"><a
                                            href="{{route('order.view',['id' => $order->id])}}">
                                <i class="fas fa-eye"></i>
                            </a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
