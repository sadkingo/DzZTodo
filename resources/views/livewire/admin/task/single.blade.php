<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $task->title }}</td>
    <td class="">{{ $task->description }}</td>
    <td class="">{{ $task->date_due }}</td>
    <td class="">{{ $task->priority }}</td>
    <td class="">{{ $task->status }}</td>
    <td class="">{{ $task->created_by }}</td>
    
    @if(getCrudConfig('Task')->delete or getCrudConfig('Task')->update)
        <td>

            @if(getCrudConfig('Task')->update && hasPermission(getRouteName().'.task.update', 1, 1, $task))
                <a href="@route(getRouteName().'.task.update', $task->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Task')->delete && hasPermission(getRouteName().'.task.delete', 1, 1, $task))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Task') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Task') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
    @endif
</tr>
