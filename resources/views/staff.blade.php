@extends('layouts.app')

@section('title', 'Staffs')

@section('content')
    <div class="flex h-screen">
    <main class="flex-1 overflow-y-auto p-10">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-900 dark:text-slate-100">Staff Management</h1>
            <div class="flex space-x-2">
                <a href="{{ route('staff.export') }}" class="px-4 py-2 bg-emerald-500 text-white rounded-md text-sm font-medium hover:bg-emerald-600 transition">
                    Export
                </a>
                <button onclick="$('#importInput').click()" class="px-4 py-2 bg-amber-500 text-white rounded-md text-sm font-medium hover:bg-amber-600 transition">
                    Import
                </button>
                <input type="file" id="importInput" class="hidden" accept=".xlsx, .csv">
                <x-forms.button onclick="toggleModal()">
                    Add New Staff
                </x-forms.button>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
            <table id="staffTable" class="w-full text-left border-collapse">
                <thead class="text-slate-500 dark:text-slate-400 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="pb-4 px-2">Name</th>
                        <th class="pb-4 px-2">Department</th>
                    </tr>
                </thead>
                <tbody class="text-slate-700 dark:text-slate-300">
                </tbody>
            </table>
        </div>
    </main>
</div>

<div id="staffModal" class="fixed inset-0 z-50 hidden bg-slate-950/50 backdrop-blur-sm flex items-center justify-center p-4">
    <div class="bg-white dark:bg-slate-900 w-full max-w-lg rounded-3xl shadow-2xl p-8 border border-slate-200 dark:border-slate-800">
        <h2 class="text-xl font-bold text-slate-900 dark:text-slate-100 mb-6">New Staff</h2>
        
        <form id="addStaffForm" class="space-y-4">
            @csrf
            <div>
                <x-forms.label for="name" required>Name</x-forms.label>
                <x-forms.input id="name" name="name" type="text" required class="mt-2" />
            </div>

            <div>
                <x-forms.label for="department_id" required>Department</x-forms.label>
                <x-forms.select name="department_id" id="dept_select" required>
                    <option value="">Select Dept</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>

            <div class="flex justify-end space-x-3 mt-8">
                <button type="button" onclick="toggleModal()" class="px-4 py-2 text-slate-600 dark:text-slate-400 font-medium text-sm">Cancel</button>
                <x-forms.button type="submit">
                    Add Staff
                </x-forms.button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            let table = $('#staffTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('staff.index') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { 
                        data: 'department.name', 
                        name: 'department.name', 
                        defaultContent: '<span class="text-slate-400 italic">N/A</span>' 
                    },
                ],
                dom: '<"flex justify-between mb-4"f>rt<"flex justify-between mt-4"ip>',
                language: { search: "", searchPlaceholder: "Search Staffs..." }
            });

            $('#addStaffForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('staff.store') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(res) {
                        toggleModal();
                        table.ajax.reload();
                        Swal.fire('Success', 'Staff added successfully!', 'success');
                        $('#addStaffForm')[0].reset();
                    },
                    error: function(err) {
                        Swal.fire('Error', err.responseJSON.message, 'error');
                    }
                });
            });
        });

        $('#importInput').on('change', function() {
            let formData = new FormData();
            formData.append('file', this.files[0]);
            formData.append('_token', "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('staff.import') }}",
                method: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    Swal.fire('Success', res.message, 'success');
                    table.ajax.reload();
                    $('#importInput').val('');
                },
                error: function(err) {
                    Swal.fire('Error', err.responseJSON.message, 'error');
                    $('#importInput').val('');
                }
            });
        });

        function toggleModal() {
            $('#staffModal').toggleClass('hidden');
        }
    </script>
@endsection