<x-app-layout>
    <form action="{{ route('task.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="relative w-full max-w-2xl max-h-full mt-5 mx-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 mt-5">
                <div class="mt-5 p-3">
                    <div class="relative w-3/4 mx-auto mt-2">
                        <input name='title' class="dark:bg-gray-700 p-2.5 rounded-lg w-full text-white" type="text"
                            placeholder="Task title?" value="{{ $task->title }}">
                    </div>
                    @include('components.dropdown-checkbox', [
                        'categories' => $categories,
                        'task' => $task,
                    ])
                    <textarea id="message" rows="4" name='description'
                        class="mt-5 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your thoughts about the task here...">{{ $task->description }}</textarea>

                    <textarea id="message" rows="4" name='collaborates'
                        class="mt-5 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="list of collaborates:{{ "\n" }}example@example.com,example@example.com,example@example.com...">
@foreach ($task->taskUser as $user)
@if ($user->id !== userId())
{{ trim($user->email . ',', ',') }}
@endif
@endforeach
</textarea>
                    <div class="mt-5 block mx-auto relative max-w-sm">
                        <div class="dark">
                            <x-datetime-picker without-time placeholder="Appointment Date" name='dueDate'
                                x-bind:value="model ? (getDisplayValue() == new Date().toLocaleDateString('en-US', {
                                        month: 'numeric',
                                        day: 'numeric',
                                        year: 'numeric'
                                    })) ? '{{ $task->date_due }}' :
                                    getDisplayValue() : null"
                                class="dark" />
                        </div>
                    </div>
                    <button type="submit"
                        class="flex mx-auto mb-5 mt-5 md:text-xl bg-blue-500 hover:bg-transparent text-white font-semibold hover:text-blue-700 py-2 px-4 border border-blue-500 hover:border-blue-500 rounded">
                        Edit Task
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>
