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
                        <form method="POST" action="/tickets" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            <label for="employee">Employee</label>
                            <div class="form-group text-gray-900">
                                <div class="relative inline-block text-left">
                                    <select name="user_id" class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                        @foreach ($users as $user)
                                        <option value={{ $user->id }}> {{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div><br>
                                </label>
                                <div class="container text-white-900 dark:text-white" style="width:100%">

                                    <label for="status">Status</label>
                                    <div class="form-group text-gray-900">
                                        <div class="relative inline-block text-left">
                                            <select name="status" class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                                <option value="open" {{ $ticket->status == 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="closed" {{ $ticket->status == 'closed' ? 'selected' : '' }}>Closed</option>
                                                <option value="completed" {{ $ticket->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                            </select>
                                        </div><br>
                                        </label>

                                        <div class="form-group container text-white-900 dark:text-white" style="width:100%">
                                            <label for="start_date_time">Start Date and Time:</label>
                                        </div>
                                        <input type="datetime-local" class="form-control shadow-sm sm:rounded-lg" id="start_date_time" name="start_date_time" required>

                                    <div class="form-group container text-white-900 dark:text-white" style="width:100%">
                                        <label for="end_date_time">End Date and Time:</label>
                                    </div>
                                <input type="datetime-local" class="form-control shadow-sm sm:rounded-lg" id="end_date_time" name="end_date_time">
                            </div>

                            <div class="mt-6 mb-6 form-group container text-gray-900">
                                <label for="comment">Comment:</label>
                                <textarea class="form-control shadow-sm sm:rounded-lg" id="comment" name="comment" rows="3"></textarea>
                            </div>

                            <div class="form-group mt-6 mb-6">
                                <label for="image">Image (optional):</label>
                                <input type="file" class="form-control-file shadow-sm sm:rounded-lg" id="image" name="image" enctype="multipart/form-data">
                            </div>

                            <label for="employee">Materials</label><br>
                            <div id="materials-section">
                                <div class="material-group">
                                    <div class="form-group">
                                        <label for="material_name">Material Name:</label>
                                        <input type="text" class="form-control text-gray-900 shadow-sm sm:rounded-lg" name="material_name[]">
                                    </div>

                                    <div class="form-group">
                                        <label for="material_quantity">Material Quantity:</label>
                                        <input type="number" class="form-control text-gray-900 shadow-sm sm:rounded-lg" name="material_quantity[]">
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="add-material">Add Material (new material field)</button><br>

                            <div class="text-white-900">
                                <button type="submit" class="text-white-900 mt-6 btn btn-primary">Create Ticket</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.getElementById('add-material').addEventListener('click', function() {
        var materialsSection = document.getElementById('materials-section');
        var materialGroup = document.createElement('div');
        materialGroup.classList.add('material-group');

        materialGroup.innerHTML = `
        <div class="form-group">
            <label for="material_name">Material Name:</label>
            <input type="text" class="form-control text-gray-900 shadow-sm sm:rounded-lg" name="material_name[]">
        </div>

        <div class="form-group">
            <label for="material_quantity">Material Quantity:</label>
            <input type="number" class="form-control text-gray-900 shadow-sm sm:rounded-lg" name="material_quantity[]">
        </div>
    `;

        materialsSection.appendChild(materialGroup);
    });
</script>