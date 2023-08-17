<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('UpdateTitle', ['name' => __('User') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.user.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('User')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Update') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="update" enctype="multipart/form-data">

        <div class="card-body">

                        <!-- Name Input -->
            <div class='form-group'>
                <label for='input-name' class='col-sm-2 control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Username Input -->
            <div class='form-group'>
                <label for='input-username' class='col-sm-2 control-label '> {{ __('Username') }}</label>
                <input type='text' id='input-username' wire:model.lazy='username' class="form-control  @error('username') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('username') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Email Input -->
            <div class='form-group'>
                <label for='input-email' class='col-sm-2 control-label '> {{ __('Email') }}</label>
                <input type='email' id='input-email' wire:model.lazy='email' class="form-control  @error('email') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('email') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Password Input -->
            <div class='form-group'>
                <label for='inputpassword' class='col-sm-2 control-label '> {{ __('Password') }}</label>
                <input type='password' id='input-password' wire:model.lazy='password' class="form-control  @error('password') is-invalid @enderror" placeholder=''>
                @error('password') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- User_type Input -->
            <div class='form-group'>
                <label for='input-user_type' class='col-sm-2 control-label '> {{ __('User_type') }}</label>
                <select id='input-user_type' wire:model.lazy='user_type' class="form-control  @error('user_type') is-invalid @enderror">
                    @foreach(getCrudConfig('User')->inputs()['user_type']['select'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
                </select>
                @error('user_type') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>


        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Update') }}</button>
            <a href="@route(getRouteName().'.user.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
