@extends('admin.layouts.panel')

@section('head')
    <title>laundryku - create new admin account</title>
@endsection

@section('body')
    <div class="container-fluid">
        <div class="d-block p-3 mb-3">
            <h2 class="text-them fw-bold mb-0">Account</h2>
            <p class="text-them-sec mb-0">Membuat account laudry baruku</p>
        </div>

        <form action="{{ route('admin.account.update.post', ['id' => $data->admin_id]) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="d-block rounded bg-white p-3 mb-3">
                <div class="row gx-5">
                    <div class="col-12 col-md-7 col-lg-7">
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="#" class="form-label">Username</label>
                                <input type="text" name="username"
                                    class="form-control  @error('username') is-invalid @enderror" value="{{$data->username}}">
                                @error('username')
                                    <span class="invalid-feedback text-capitalize">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="#" class="form-label">Email</label>
                                <input type="email" disabled readonly
                                    class="form-control disabled" value="{{$data->email}}">
                            </div>

                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <div class="flex-fill">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select name="gender" id="gender"
                                            class="form-select @error('gender') is-invalid @enderror">
                                            <option value="" disabled>Pilih status</option>
                                            <option value="m" @selected($data->gender == "m")>Pria</option>
                                            <option value="f" @selected($data->gender == "f")>Wanita</option>
                                        </select>
                                        @error('gender')
                                            <span class="invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="flex-fill">
                                        <label for="born" class="form-label">Tanggal Lahir</label>
                                        <input type="date" id="born" name="born"
                                            class="form-control  @error('born') is-invalid @enderror" value="{{$data->born}}">
                                        @error('born')
                                            <span class="invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('born') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <div class="flex-fill">
                                        <label for="phone" class="form-label">Phone</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">+62</span>
                                            <input type="text" name="phone" id="phone"
                                                class="form-control  @error('phone') is-invalid @enderror" value="{{$data->phone}}">
                                        </div>
                                        @error('phone')
                                            <span class="d-block invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="flex-fill">
                                        <label for="is_active" class="form-label">Status</label>
                                        <select name="is_active" id="is_active"
                                            class="form-select @error('is_active') is-invalid @enderror">
                                            <option value="" disabled selected>Pilih status</option>
                                            <option value="1" @selected($data->is_active == 1)>Active</option>
                                            <option value="0" @selected($data->is_active == 0)>Non Active</option>
                                        </select>
                                        @error('is_active')
                                            <span class="invalid-feedback text-capitalize">
                                                <strong>{{ $errors->first('is_active') }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3">
                            <label for="#" class="form-label">Alamat</label>
                            <textarea name="address" id="address" rows="4"
                                class="form-control  @error('address') is-invalid @enderror">{{$data->address}}</textarea>
                            @error('address')
                                <span class="invalid-feedback text-capitalize">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-5 col-lg-5">
                        @livewire('admin.account.image-upload', ['post' => $data->avatar])
                    </div>
                </div>
            </div>
            <div class="d-block rounded bg-white p-3 mb-3">
                <button type="submit" class="btn btn-outline-success">Update Account</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
@endsection
