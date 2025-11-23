<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Tasks List') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Add New Task
            </a>
        </div>
    </x-slot>

    <!-- Search and Filter -->
    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <form method="GET" action="{{ route('tasks.index') }}" class="flex flex-col md:flex-row gap-4">
                <div class="flex-grow">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md leading-5 bg-white dark:bg-gray-700 placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100" placeholder="Search tasks by title...">
                    </div>
                </div>
                <div class="w-full md:w-48">
                    <label for="status" class="sr-only">Status</label>
                    <select name="status" id="status" class="block w-full py-2 px-3 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-gray-900 dark:text-gray-100">
                        <option value="all">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <button type="submit" class="w-full md:w-auto inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        Filter
                    </button>
                    @if(request('search') || (request('status') && request('status') !== 'all'))
                        <a href="{{ route('tasks.index') }}" class="ml-2 text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-200">Clear</a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- Messages -->
    @if (session('success'))
        <div class="bg-green-100 dark:bg-green-900 border border-green-400 text-green-700 dark:text-green-300 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Tasks Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($tasks as $task)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-full border-l-4 {{ $task->status === 'done' ? 'border-green-500' : ($task->status === 'in_progress' ? 'border-blue-500' : 'border-yellow-500') }}">
                <div class="p-6 flex-grow">
                    <div class="flex justify-between items-start mb-2">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100 line-clamp-2" title="{{ $task->title }}">
                            {{ $task->title }}
                        </h3>
                        <div class="ml-2 flex-shrink-0">
                            @if($task->priority === 'high')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                    High
                                </span>
                            @elseif($task->priority === 'medium')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                    Medium
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                                    Low
                                </span>
                            @endif
                        </div>
                    </div>
                    
                    <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                        {{ $task->description ?? 'No description provided.' }}
                    </p>
                    
                    <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mt-2 space-x-4">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            {{ $task->due_date ? $task->due_date->format('M d, Y') : 'No due date' }}
                        </div>
                        <div class="flex items-center">
                             <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span class="capitalize">{{ str_replace('_', ' ', $task->status) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 px-6 py-4 flex justify-end space-x-3">
                    <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 font-medium text-sm">Edit</a>
                    
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline-block" x-data @submit.prevent="if(confirm('Are you sure you want to delete this task?')) $el.submit()">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium text-sm focus:outline-none">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No tasks found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Get started by creating a new task.</p>
                    <div class="mt-6">
                        <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                            New Task
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $tasks->withQueryString()->links() }}
    </div>
</x-app-layout>
