@extends('site.master.layout')

@section('content')
    <div class="main-panel">
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Nạp tiền</h4>
                            </div>
                            <div class="card-body">
                                <form method="post" action="{{ route('post_topup') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> Chọn ngân hàng </label>
                                                <select class="select form-control" name="acc_no">
                                                    <option value="">Tất cả</option>
                                                    @foreach($banks as $bank)
                                                        <option
                                                            value="{{ $bank->acc_no }}" {{ isset($bankUser->acc_no) && old('acc_no') == $bank->acc_no ? "selected" : ''}}>
                                                            {{ $bank->bank->bank_name }} ({{ $bank->bank->bank_short_name }})
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('acc_no')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Số tiền</label>
                                                <input type="number" class="form-control" name="amount"
                                                       placeholder="Số tiền nạp"
                                                       value="{{ old('amount') }}">
                                                @error('amount')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Mã khuyến mãi</label>
                                                <input type="text" class="form-control" name="promotion_code"
                                                       placeholder="Mã khuyến mãi"
                                                       value="{{ old('promotion_code') }}">
                                                @error('amount')
                                                <p class="text-danger"><i>{{ $message }}</i></p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="text-danger">
                                                Mức quy đổi:
                                                @switch($user->rate)
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
                                            </p>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-info btn-fill pull-right">Nạp tiền</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
