@extends('admin.master.layout')

@section('content')
    <div class="card mt-2">
        <div class="card-header">
            <h3 class="card-title">Danh sách giao dịch</h3>
        </div>
        <div class="card-header">
            <form action="{{ route('transaction.index') }}" method="get">
            <div class="row">
                <div class="form-group col-md-3">
                    <label for="trans_id">Mã giao dịch</label>
                    <input type="text" id="trans_id" class="form-control" name="trans_id" value="{{ request('trans_id') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="reservation">Thời gian giao dịch</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="far fa-calendar-alt"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control float-right" name="time_range" id="reservation">
                        </div>

                    </div>
                <div class="form-group col-md-3">
                    <label for="status">Trạng thái</label>
                    <select class="select form-control" name="status">
                        <option value="">-- Tất cả --</option>
                        <option value="0" {{ request('status') == '0' ? "selected" : ''}}>Chờ duyệt</option>
                        <option value="1" {{ request('status') == 1 ? "selected" : ''}}>Đã duyệt</option>
                        <option value="2" {{ request('status') == 2 ? "selected" : ''}}>Đã hủy</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                    <label for="type">Loại giao dịch</label>
                    <select class="select form-control" name="type">
                        <option value="">-- Tất cả --</option>
                        <option value="0" {{ request('type') == '0' ? "selected" : ''}}>Nạp tiền</option>
                        <option value="1" {{ request('type') == 1 ? "selected" : ''}}>Rút tiền</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                   <button type="submit" class="btn btn-primary"> Tìm kiếm</button>
                </div>
            </div>
            </form>
        </div>
        @if (session('success'))
            <div class="alert alert-success mx-2 mt-4">
                {{ session('success') }}
            </div>
        @endif
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <th>STT</th>
                <th>Mã giao dịch</th>
                <th>Số tiền</th>
                <th>Mức quy đổi</th>
                <th>Mã khuyến mãi</th>
                <th>Loại giao dịch</th>
                <th>Trạng thái</th>
                <th>Thời gian yêu cầu</th>
                <th>Thời gian duyệt</th>
                <th width="150px">Thao tác</th>
                </thead>
                <tbody>
                @foreach($transactions as $id => $item)
                    <tr>
                        <td>{{ $id + 1 }}</td>
                        <td>{{ $item->trans_id }}</td>
                        <td>{{ number_format($item->amount) }}</td>
                        <td>
                            @switch($item->user->rate)
                                @case(1)
                                1đ = 25.000đ
                                @break
                                @case(2)
                                1đ = 50.000đ
                                @break
                                @case(3)
                                1đ = 100.000đ
                                @break
                            @endswitch
                        </td>
                        <td>{{ $item->promotion_code }}</td>
                        <td>
                            @switch($item->type)
                                @case(0)
                                <span class="badge badge-primary">Nạp tiền</span>
                                @break;
                                @case(1)
                                <span class="badge badge-info">Rút tiền</span>
                                @break;
                            @endswitch
                        </td>
                        <td>
                            @switch($item->status)
                                @case(0)
                                <span class="badge badge-warning">Chờ duyệt</span>
                                @break;
                                @case(1)
                                <span class="badge badge-success">Đã duyệt</span>
                                @break;
                                @case(2)
                                <span class="badge badge-danger">Đã hủy</span>
                                @break;
                            @endswitch
                        </td>
                        <td>{{ isset($item->request_time) ? date('d-m-Y H:i', strtotime($item->request_time)) : ''  }}</td>
                        <td>{{ isset($item->update_end_status_at) ? date('d-m-Y H:i', strtotime($item->update_end_status_at)) : ''  }}</td>
                        <td>
                            @if($item->status == 0)
                            <a onclick="deleteItem(this);" url="{{ route('transaction.destroy', ['transaction' => $item->trans_id]) }}" title="Xóa"><button class="btn btn-danger"><i class="fa fa-trash-alt"></i></button></a>
                            <a onclick="acceptItem(this);" url="{{ route('transaction_accept', ['trans_id' => $item->trans_id]) }}" title="Duyệt">
                                <button class="btn btn-success">
                                    <i class="fa fa-angle-up"></i>
                                </button>
                            </a>
                            <a href="{{ route('transaction_cancel', ['trans_id' => $item->trans_id]) }}" title="Hủy ">
                                <button class="btn btn-warning">
                                    <i class="fa fa-ban"></i>
                                </button>
                            </a>
                            @endif

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $transactions->links() }}
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#reservation').daterangepicker()
    </script>
@endsection