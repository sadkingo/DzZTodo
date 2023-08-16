<tbody>
    <tr
        class="bg-white border-b dark:bg-gray-600 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 dark:text-gray-300">
        <th scope="row" class="px-6 py-4 font-medium text-gray-100 whitespace-nowrap dark:text-white">
            {{ $title }}
        </th>
        <td class="px-6 py-4">
            {{ $username }}
        </td>
        <td class="px-6 py-4">
            {{ $dueDate }}
        </td>
        <td wire:click.prevent='priorityChange({{ $id }})' class="px-6 py-4 ">
            <span
                class="
                @switch($priority)
                @case('Low')
                {{ 'bg-gray-800' }}
                @break
                @case('Medium')
                {{ 'bg-green-500' }}
                @break
                @case('High')
                {{ 'bg-red-500' }}
                @break

                @default
                {{ 'bg-gray-800' }}
            @endswitch
            ext-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $priority }}
            </span>
        </td>
        <td class="px-6 py-4" wire:click.prevent='statusChange({{ $id }})'>
            <span
                class="
                @switch($status)
                @case('Not Started')
                {{ 'bg-red-500' }}
                @break
                @case('In Progress')
                {{ 'bg-gray-800' }}
                @break
                @case('Completed')
                {{ 'bg-green-500' }}
                @break

                @default
                {{ 'bg-gray-800' }}
            @endswitch text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $status }}
            </span>
        </td>
        <td class="px-6 py-4">
            <a href="{{ route('task.edit', $id) }}" style="display: inline-block">
                <button type="button"
                    class="text-white bg-blue-700 border-transparent hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 disabled:hover:bg-blue-700 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 dark:disabled:hover:bg-blue-600 focus:!ring-2 group flex h-min items-center justify-center p-0.5 text-center font-medium focus:z-10 rounded-lg">
                    <span class="flex items-center rounded-md text-sm px-3 py-1.5">
                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24"
                            height="1em" width="1em">
                            <path
                                d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a.996.996 0 000-1.41l-2.34-2.34a.996.996 0 00-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z">
                            </path>
                        </svg>
                    </span>
                </button>
            </a>
            <button type="button" wire:click.prevent='deleteTask({{ $id }})' style="display: inline-block"
                class="text-white bg-red-600  border-transparent hover:bg-red-800 focus:ring-4 focus:ring-red-300 disabled:hover:bg-red-800 dark:bg-red-600 dark:hover:bg-red-500 dark:focus:ring-red-900 dark:disabled:hover:bg-red-600 focus:!ring-2 group flex h-min items-center justify-center p-0.5 text-center font-medium focus:z-10 rounded-lg">
                <span class="flex items-center rounded-md text-sm px-3 py-1.5">
                    <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 24 24" height="1em"
                        width="1em">
                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z">
                        </path>
                    </svg>
                </span>
            </button>
        </td>
    </tr>
</tbody>
