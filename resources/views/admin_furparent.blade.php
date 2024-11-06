@extends('layouts.authenticated.main')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Furparents Management</h1>
    
    <form id="recordForm" class="mb-6">
        <input type="hidden" id="id" value=""> <!-- Hidden field for furparent ID -->
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" id="firstname" placeholder="First Name" class="p-2 rounded bg-gray-800 text-white" required>
            <input type="text" id="lastname" placeholder="Last Name" class="p-2 rounded bg-gray-800 text-white" required>
            <select id="admin_access" class="p-2 rounded bg-gray-800 text-white">
                <option value="0">Furparent</option>
                <option value="1">Furparent / Admin</option>
            </select>
            <input type="email" id="email" placeholder="Email" class="p-2 rounded bg-gray-800 text-white" required>
            <input type="text" id="mobile_number" placeholder="Mobile Number" class="p-2 rounded bg-gray-800 text-white">
            <input type="text" id="city" placeholder="City" class="p-2 rounded bg-gray-800 text-white">
            <input type="text" id="province" placeholder="Province" class="p-2 rounded bg-gray-800 text-white">
            <input type="text" id="img" placeholder="Image URL" class="p-2 rounded bg-gray-800 text-white">
            <input type="password" id="password" placeholder="Password (leave blank to keep current)" class="p-2 rounded bg-gray-800 text-white">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded p-2">
                Add/Update Furparent
            </button>
        </div>
    </form>

    <div class="overflow-y-auto h-[calc(100vh-15rem)]">
        <table class="min-w-full bg-gray-800 border border-gray-700">
            <thead>
                <tr id="tableHeader">
                    <!-- Dynamic headers will be injected here -->
                </tr>
            </thead>
            <tbody id="recordTableBody">
                <!-- Dynamic records will be injected here -->
            </tbody>
        </table>
    </div>
</div>

<script>
    class AdminGrid {
        constructor(apiEndpoint) {
            this.apiEndpoint = apiEndpoint;
            this.records = [];
            this.columns = new Set();
            this.editingRecordId = null;
            this.init();
        }

        init() {
            this.renderTable();
            document.getElementById('recordForm').addEventListener('submit', (event) => {
                event.preventDefault();
                this.handleSubmit();
            });
            this.fetchRecords();
        }

        async fetchRecords() {
            const response = await fetch(`${this.apiEndpoint}/fetch`);
            this.records = await response.json();
            this.updateColumns();
            this.renderTable();
        }

        updateColumns() {
            this.records.forEach(record => {
                Object.keys(record).forEach(key => {
                    this.columns.add(key);
                });
            });
        }

        async handleSubmit() {
            const formData = this.getFormData();
            console.log('Form Data Submitted:', formData);
            
            const id = formData.id; // Get the furparent ID for the update

            if (id) {
                await this.updateRecord(id, formData);
                this.editingRecordId = null; // Reset editing ID after update
            } else {
                await this.addRecord(formData);
            }

            document.getElementById('recordForm').reset();
            this.fetchRecords();
        }

        async addRecord(data) {
            await fetch(`${this.apiEndpoint}/add`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                },
                body: JSON.stringify(data)
            });
        }

        async updateRecord(id, data) {
            // Remove password if it's empty
            if (!data.password) {
                delete data.password;
            }
            console.log('Updating Record ID:', id, 'Data:', data);
            await fetch(`${this.apiEndpoint}/edit/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                },
                body: JSON.stringify(data)
            });
        }

        async deleteRecord(id) {
            await fetch(`${this.apiEndpoint}/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window._.csrf
                }
            });
            this.fetchRecords();
        }

        getFormData() {
            const data = {};
            this.columns.forEach(column => {
                const input = document.getElementById(column);
                if (input) {
                    data[column] = input.value;
                }
            });
            data.id = document.getElementById('id').value; // Include ID
            return data;
        }

        renderTable() {
            const tableBody = document.getElementById('recordTableBody');
            tableBody.innerHTML = '';
            const tableHeader = document.getElementById('tableHeader');
            tableHeader.innerHTML = '';

            this.columns.forEach(column => {
                const headerCell = document.createElement('th');
                headerCell.className = 'py-2 px-4 border-b text-white';
                headerCell.textContent = column.charAt(0).toUpperCase() + column.slice(1);
                tableHeader.appendChild(headerCell);
            });

            const actionsHeader = document.createElement('th');
            actionsHeader.className = 'py-2 px-4 border-b text-white';
            actionsHeader.textContent = 'Actions';
            tableHeader.appendChild(actionsHeader);

            this.records.forEach(record => {
                const row = document.createElement('tr');
                row.innerHTML = Array.from(this.columns).map(column => 
                    `<td class="py-2 px-4 border-b text-white">${record[column]}</td>`
                ).join('') + `
                    <td class="py-2 px-4 border-b text-center justify-center">
                        <button onclick="adminGrid.editRecord(${record.id})" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded p-2 w-24 mb-2">
                            Edit
                        </button>
                        <button onclick="adminGrid.deleteRecord(${record.id})" class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded p-2 w-24">
                            Delete
                        </button>
                    </td>
                `;
                tableBody.appendChild(row);
            });
        }

        editRecord(id) {
            console.log('Editing Record ID:', id);
            const record = this.records.find(record => record.id === id);
            
            if (record) {
                console.log('Found Record:', record);
                this.columns.forEach(column => {
                    const input = document.getElementById(column);
                    if (input) {
                        // Only set value for fields other than password
                        if (column !== 'password') {
                            input.value = record[column]; // Populate the form with the record's data
                        }
                    }
                });
                document.getElementById('id').value = id; // Store ID for updating
                this.editingRecordId = id; // Store the ID of the editing record
            } else {
                console.error('Record not found for ID:', id);
            }
        }

    }

    const adminGrid = new AdminGrid('/api/admin/furparents');
</script>
@endsection
