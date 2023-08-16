<!--== list start ==!-->
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-600 dark:bg-gray-700 dark:text-white">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Task name
                </th>
                <th scope="col" class="px-6 py-3">
                    Username
                </th>
                <th scope="col" class="px-6 py-3">
                    Due Date
                </th>
                <th scope="col" class="px-6 py-3">
                    Priority
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
            </tr>
        </thead>
        @foreach ($todoList as $task)
            @include('components.todolist-rows', [
                'username' => $task->users->username,
                'dueDate' => $task->date_due,
                'title' => $task->title,
                'priority' => $task->priority,
                'status' => $task->status,
                'id' => $task->id,
            ])
        @endforeach
    </table>
</div>

<!--== list end ==!-->
