<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Task') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.task.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Task')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
                        <!-- Created_by Input -->
            <div class='form-group'>
                <label for='input-created_by' class='col-sm-2 control-label '> {{ __('Created_by') }}</label>
                <input type='number' id='input-created_by' wire:model.lazy='created_by' class="form-control  @error('created_by') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('created_by') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Title Input -->
            <div class='form-group'>
                <label for='input-title' class='col-sm-2 control-label '> {{ __('Title') }}</label>
                <input type='text' id='input-title' wire:model.lazy='title' class="form-control  @error('title') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('title') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Category Input -->
            <div class='form-group'>
                <label for='input-category' class='col-sm-2 control-label '> {{ __('Category') }}</label>
                <select id='input-category' wire:model.lazy='category' class="form-control  @error('category') is-invalid @enderror">
                    @foreach(getCrudConfig('Task')->inputs()['category']['select'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
                </select>
                @error('category') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Description Input -->
            <div class='form-group'>
                <label for='input-description' class='col-sm-2 control-label '> {{ __('Description') }}</label>
                <textarea id="input-description" wire:model.lazy='description' class="form-control  @error('description') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                @error('description') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Collaborates Input -->
            <div class='form-group'>
                <label for='input-collaborates' class='col-sm-2 control-label '> {{ __('Collaborates') }}</label>
                <textarea id="input-collaborates" wire:model.lazy='collaborates' class="form-control  @error('collaborates') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                @error('collaborates') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Date_due Input -->
            <div class='form-group'>
                <label for='input-date_due' class='col-sm-2 control-label '> {{ __('Date_due') }}</label>
                <input type='date' id='input-date_due' wire:model.lazy='date_due' class="form-control  @error('date_due') is-invalid @enderror" autocomplete='on'>
                @error('date_due') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Priority Input -->
            <div class='form-group'>
                <label for='input-priority' class='col-sm-2 control-label '> {{ __('Priority') }}</label>
                <select id='input-priority' wire:model.lazy='priority' class="form-control  @error('priority') is-invalid @enderror">
                    @foreach(getCrudConfig('Task')->inputs()['priority']['select'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
                </select>
                @error('priority') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Status Input -->
            <div class='form-group'>
                <label for='input-status' class='col-sm-2 control-label '> {{ __('Status') }}</label>
                <select id='input-status' wire:model.lazy='status' class="form-control  @error('status') is-invalid @enderror">
                    @foreach(getCrudConfig('Task')->inputs()['status']['select'] as $key => $value)
                        <option value='{{ $key }}'>{{ $value }}</option>
                    @endforeach
                </select>
                @error('status') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.task.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
