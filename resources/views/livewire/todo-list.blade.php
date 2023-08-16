<div class="livewire-bs">
    <div class="container-todo mx-auto" style="margin-top:25px;">
        @if ($errors->first())
            <span class="text-red-700 text-xl flex justify-center">
                {{ $errors->first() }}
            </span>
        @endif
        <button data-modal-target="defaultModal" data-modal-toggle="defaultModal"
            class="flex mx-auto mb-5 mt-5 md:text-xl bg-blue-500 hover:bg-transparent text-white font-semibold hover:text-blue-700 py-2 px-4 border border-blue-500 hover:border-blue-500 rounded">
            Add Task
        </button>
        @include('components.search-todo')
        @include('components.itemController', ['todoList' => $todoList])
    </div>

    <div wire:ignore id="defaultModal" tabindex="-1" aria-hidden="true"
        class="fixed backdrop-blur top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full justify-center items-center flex">
        <div class="relative w-full max-w-2xl max-h-full mt-5 mx-auto">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-800 mt-5">
                <div class="mb-5 mt-5 p-3">
                    <div class="relative w-3/4 mx-auto mt-2">
                        <input wire:model="title" wire:keydown.enter.prevent="addTask"
                            class="dark:bg-gray-700 p-2.5 rounded-lg w-full text-white" type="text"
                            placeholder="Task title?">
                    </div>
                    <label for="Categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        catagory</label>
                    <select wire:model='category' id="Categories"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    <label for="Categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                        Priority</label>
                    <select wire:model='priority' id="Categories"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                    </select>
                    
                    <textarea wire:model="description" wire:keydown.enter.prevent="addTask" id="message" rows="4"
                        class="mt-5 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write your thoughts about the task here..."></textarea>

                    <textarea wire:model="collaborates" wire:keydown.enter.prevent="addTask" id="message" rows="4"
                        class="mt-5 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="list of collaborates:{{ "\n" }}example@example.com,example@example.com,example@example.com..."></textarea>

                    <div class="mt-5 block mx-auto relative max-w-sm">
                        <div class="dark">
                            <x-datetime-picker without-time placeholder="Appointment Date" wire:model="dateDue"
                                class="dark" />
                        </div>
                    </div>
                    <button wire:click.prevent="addTask" data-modal-target="defaultModal"
                        data-modal-toggle="defaultModal"
                        class="flex mx-auto mt-5 md:text-xl bg-blue-500 hover:bg-transparent text-white font-semibold hover:text-blue-700 py-2 px-4 border border-blue-500 hover:border-blue-500 rounded">
                        Add Task
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
