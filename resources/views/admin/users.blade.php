



<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight NHaasGroteskDSPro-65Md">
            Admin Users
        </h2>
    </x-slot>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">

    @if(session('success'))
        <div class="absolute top-0 left-0 mt-4 mr-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded"
            role="alert" id="success-message">
            <strong class="font-bold">Successful update!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>

        <script>
            setTimeout(function () {
                document.getElementById('success-message').style.display = 'none';
            }, 5000); // 5000 milliseconds (5 seconds)
        </script>
    @endif

    <div class="container-fluid mx-auto pt-6  bg-SelectColor">
        <div class="text-left text-black bg-SelectColor lg:px-24 p-0 relative z-10">
            <h3 class="text-3xl leading-none pb-8 font-semibold orpheusproMedium">Users Table</h3>
        </div>
        <hr class="  border-black dark:border-black">
       

        <table id="userTable" class="table table-bordered min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
                <tr>
                    <!--<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <input id="selectAllCheckbox" type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 select-all">
                    </th>-->
                    
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Phone No</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Age Range</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">How did you hear</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Confirm Attendance</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>
            <tbody id="tableBody" class="bg-white divide-y divide-gray-200">
                @foreach($users as $user)
                <tr>
                   <!-- <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500 select-user">
                    </td>-->
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->phone }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->gender }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->age }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">
                        @if($user->role === 'user')
                            attendee
                        @else
                            {{ $user->role }}
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->referral }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $user->attending }}</td>
                    <!-- Add more columns as needed -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr>

    <script>
        $(document).ready(function() {
            $('#userTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print',
                    {
                        text: 'Export Confirm',
                        action: function (e, dt, node, config) {
                            exportPhoneNumbers();
                        }
                    }
                ]
            });

            function exportPhoneNumbers() {
                var phoneNumbers = [];
                $('#userTable tbody tr').each(function() {
                    var phoneNumber = $(this).find('td:eq(7)').text(); // Change 2 to the index of the phone number column
                    phoneNumbers.push(phoneNumber.trim());
                });

                var csvContent = "data:text/csv;charset=utf-8,";
                phoneNumbers.forEach(function(phoneNumber) {
                    csvContent += phoneNumber + "\n";
                });

                var encodedUri = encodeURI(csvContent);
                var link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "Raffle.csv");
                document.body.appendChild(link);
                link.click();
            }
        });
    </script>
</x-admin-layout>
