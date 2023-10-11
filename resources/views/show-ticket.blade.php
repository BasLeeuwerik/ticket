<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Open Tickets') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <table class="text-white-900 dark:text-white mt-16 ml-6 mb-6 mr-6" style="width:100%">

                    <tr class="text-left">
                        <th>Time</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Materials</th>
                    </tr>
                    @php
                    $datetime1 = new DateTime($ticket->created_at);
                    $datetime2 = new DateTime($ticket->updated_at);
                    $interval = $datetime1->diff($datetime2);

                    $days = $interval->format('%m months %a days %h hours');

                    @endphp

                    <tr>
                        <td>{{ $days }}</td>
                        <td>{{ $ticket->status }}</td>
                        <td>{{ $ticket }}</td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
    </div>
</x-app-layout>