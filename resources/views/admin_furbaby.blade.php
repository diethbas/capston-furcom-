@extends('layouts.authenticated.main')

@section('content')
<div class="container mx-auto mt-10 px-4">
    <h1 class="text-2xl font-bold mb-4 text-white">Furbabies Management</h1>
    
    <form id="recordForm" class="mb-6">
        <input type="hidden" id="furbabyID" value=""> <!-- Hidden field for furbabyID -->
        <input type="hidden" id="furparentID" value=""> <!-- Hidden field for furparentID -->
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <input type="text" id="name" placeholder="Furbaby Name" class="p-2 rounded bg-gray-800 text-white" required>
            <input type="number" id="age" placeholder="Age" class="p-2 rounded bg-gray-800 text-white" required>
            <input type="text" id="description" placeholder="Description" class="p-2 rounded bg-gray-800 text-white" required>
            <input type="text" id="img" placeholder="Image URL" class="p-2 rounded bg-gray-800 text-white">
            <select id="ismissing" class="p-2 rounded bg-gray-800 text-white">
                <option value="0">Not Missing</option>
                <option value="1">Missing</option>
            </select>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded p-2">
                Add/Update Furbaby
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
        // Sets up initial variables and API endpoint.
        constructor(apiEndpoint) {
            this.apiEndpoint = apiEndpoint;
            this.records = [];
            this.columns = new Set();
            this.editingRecordId = null;
            this.init();
        }
        // Prepare the grid with the table structure and initial data.
        init() {
            this.renderTable();
            document.getElementById('recordForm').addEventListener('submit', (event) => {
                event.preventDefault();
                this.handleSubmit();
            });
            this.fetchRecords();
        }
        // Retrieves data from the API and updates the table with this data.
        async fetchRecords() {
            const response = await fetch(`${this.apiEndpoint}/fetch`);
            this.records = await response.json();
            this.updateColumns();
            this.renderTable();
        }
        // Generates unique columns from this.records to define the table structure.
        updateColumns() {
            this.records.forEach(record => {
                Object.keys(record).forEach(key => {
                    if (key !== "furparent") {this.columns.add(key)}
                });
            });
        }
        // Handles the submission of the form
        async handleSubmit() {
            const formData = this.getFormData();
            console.log('Form Data Submitted:', formData);
            
            const furbabyID = formData.furbabyID; // Get the furbabyID for the update

            if (furbabyID) {
                await this.updateRecord(furbabyID, formData);
                this.editingRecordId = null; // Reset editing ID after update
            } else {
                await this.addRecord(formData);
            }

            document.getElementById('recordForm').reset();
            this.fetchRecords();
        }
        // Add a new furbaby record.
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
        // Update an existing furbaby record based on the furbabyID.
        async updateRecord(furbabyID, data) {
            console.log('Updating Record ID:', furbabyID, 'Data:', data);
            await fetch(`${this.apiEndpoint}/edit/${furbabyID}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window._.csrf
                },
                body: JSON.stringify(data)
            });
        }
        //  Remove a furbaby record based on furbabyID.
        async deleteRecord(furbabyID) {
            await fetch(`${this.apiEndpoint}/delete/${furbabyID}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window._.csrf
                }
            });
            this.fetchRecords();
        }
        // Retrieves data from the form inputs and returns it as an object.
        getFormData() {
            const data = {};
            this.columns.forEach(column => {
                const input = document.getElementById(column);
                if (input) {
                    data[column] = input.value;
                }
            });
            data.furbabyID = document.getElementById('furbabyID').value; // Include furbabyID
            data.furparentID = document.getElementById('furparentID').value; // Include furparentID
            return data;
        }
        // Builds and displays the table with fetched records.
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
                        <button onclick="adminGrid.editRecord(${record.furbabyID})" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold rounded p-2 w-24 mb-2">
                            Edit
                        </button>
                        <button onclick="adminGrid.deleteRecord(${record.furbabyID})" class="bg-red-500 hover:bg-red-600 text-white font-semibold rounded p-2 w-24">
                            Delete
                        </button>
                    </td>

                `;
                tableBody.appendChild(row);
            });
        }
        //  Loads a specific record's data into the form, enabling editing.
        editRecord(furbabyID) {
            console.log('Editing Record ID:', furbabyID);
            const record = this.records.find(record => record.furbabyID === furbabyID);
            
            if (record) {
                console.log('Found Record:', record);
                this.columns.forEach(column => {
                    const input = document.getElementById(column);
                    if (input) {
                        input.value = record[column]; // Populate the form with the record's data
                    }
                });
                document.getElementById('furbabyID').value = furbabyID; // Store furbabyID for updating
                document.getElementById('furparentID').value = record.furparentID; // Store furparentID for updating
                this.editingRecordId = furbabyID; // Store the ID of the editing record
            } else {
                console.error('Record not found for ID:', furbabyID);
            }
        }
    }
    // Intialization
    const adminGrid = new AdminGrid('/api/admin/furbabies');
</script>
@endsection
