<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit Task') }}
            </h2>
            <a href="{{ route('tasks.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">
                &larr; Back to List
            </a>
        </div>
    </x-slot>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <form method="POST" action="{{ route('tasks.update', $task) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}" required autofocus class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 sm:text-sm">
                    @error('title')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 sm:text-sm">{{ old('description', $task->description) }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status <span class="text-red-500">*</span></label>
                        <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 sm:text-sm">
                            <option value="pending" {{ old('status', $task->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status', $task->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Priority -->
                    <div>
                        <label for="priority" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Priority <span class="text-red-500">*</span></label>
                        <select name="priority" id="priority" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 sm:text-sm">
                            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
                            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
                            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
                        </select>
                        @error('priority')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Due Date -->
                <div>
                    <label for="due_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Due Date</label>
                    <input type="date" name="due_date" id="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 shadow-sm focus:border-blue-500 focus:ring-blue-500 bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 sm:text-sm">
                    @error('due_date')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Update Task
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
