@extends('admin.master.layout')

@section('content')
    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Chỉnh sửa số tài khoản</h3>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                <form method="post" action="{{ route('bank-admin.update', ['bank_admin' => $bankAdmin->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="bank_no">Ngân hàng</label>
                            <select name="bank_no" class="form-control"  id="bank_no">
                                <option value="">Vui lòng chọn</option>
                                @foreach($banks as $bank)
                                    <option value="{{ $bank->bank_no }}" {{ old('bank_no') ?? $bankAdmin->bank_no == $bank->bank_no ? 'selected' : '' }}>
                                        {{ $bank->bank_name }} ({{ $bank->bank_short_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="acc_name">Tên tài khoản</label>
                            <input type="text" id="acc_name" name="acc_name" class="form-control" value="{{ old('acc_name') ?? $bankAdmin->acc_name }}">
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-outline">
                            <label class="form-label" for="acc_no">Số tài khoản</label>
                            <input type="text" id="acc_no" name="acc_no" class="form-control" value="{{ old('acc_no') ?? $bankAdmin->acc_no }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input class="btn btn-primary" type="submit" value="Lưu">
                    </div>
                </form>
        </div>
    </div>
@endsection

@section('js')

@endsection
