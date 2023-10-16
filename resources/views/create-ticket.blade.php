<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create ticket') }}
        </h2>
    </x-slot>

    <div class="container text-white-900 mt-6 ml-6 mb-6 mr-6" style="width:100%">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white text-white-900 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                    <div class="container text-white-900 dark:text-white mt-6 ml-6 mb-6 mr-6" style="width:100%">
                        <h1>Create Ticket</h1><br>
                        <form method="POST" action="/tickets">
                            @csrf
                            @method('POST')

                            <label for="employee">Employee</label>
                            <div class="form-group text-gray-900">
                                <div class="relative inline-block text-left">
                                    <select name="user_id" class="mt-6 mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        @foreach ($users as $user)
                                        <option value={{ $user->id }}> {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                </label>

                                <label for="status">Status</label>
                                <div class="form-group text-gray-900">
                                    <div class="relative inline-block text-left">
                                        <select name="status" class="mt-6 mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                            <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                            <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                            <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                    </div><br>
                                    </label>

                                    <div class="form-group">
                                        <label for="start_date_time">Start Date and Time:</label>
                                        <input type="datetime-local" class="form-control" id="start_date_time" name="start_date_time" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="end_date_time">End Date and Time:</label>
                                        <input type="datetime-local" class="form-control" id="end_date_time" name="end_date_time">
                                    </div>

                                    <div class="form-group">
                                        <label for="comment">Comment:</label>
                                        <textarea class="form-control" id="comment" name="comment" rows="3" required></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Create Ticket</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>