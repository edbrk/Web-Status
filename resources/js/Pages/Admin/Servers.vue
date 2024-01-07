<template>
    <Head title="Servers" />

    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Servers</h2>
      </template>

      <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
          <!-- Table container -->
          <div class="bg-contrast shadow overflow-hidden rounded-lg p-3">
            <div class="flex justify-between">
                <h2 class="font-semibold text-xl text-gray-200 leading-tight">Uptime Monitors</h2>
                <button @click="isModalOpen = true" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Create Server
                </button>
            </div>

            <br class="border-gray-200">

            <!-- Table -->
            <DataTable :data="servers" :options="options" class="px-3 min-w-full">
              <thead class="bg-gray-500 border-gray-500">
                <tr>
                  <th class="text-left px-3 border-gray-300">Name</th>
                  <th >Uptime</th>
                  <th >Type</th>
                  <th >Last Down</th>
                  <th >Added</th>
                  <th >Checked</th>
                  <th>Status</th>
                  <th >Action</th>
                </tr>
              </thead>
            </DataTable>

                                <!-- Modal -->
            <div v-if="isModalOpen" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" @click.self="isModalOpen = false">
                <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                    <div class="mt-3 text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                            <!-- ... icon for the modal ... -->
                        </div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">Create New Server</h3>
                        <!-- ... modal content ... -->
                        <span class="mt-2 px-7 py-3.5 flex items-center justify-between">
                            <button @click="isModalOpen = false" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                                Cancel
                            </button>
                            <button @click="createServer" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                Create
                            </button>
                        </span>
                    </div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>

  <script setup>
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { Head } from '@inertiajs/vue3';
  import DataTable from 'datatables.net-vue3';
  import DataTablesCore from 'datatables.net';
  import 'datatables.net-select';
  import { ref } from 'vue';
  import 'datatables.net-responsive';

  DataTable.use(DataTablesCore);

  const isModalOpen = ref(false);

  function createServer() {
    // Logic to create a server
    console.log('Create server logic goes here.');

    // Close the modal after creation
    isModalOpen.value = false;
}

  const servers = ref([
  {
    name: 'CA-05',
    uptime: '99.95%',
    type: 'Server',
    lastDown: 'since 1d 19h ago',
    added: '21 Dec 2023',
    checked: '1 min ago',
    status: 'Active',
    action: 'Yes',
    usage: {
      ram: 70, // in percentage
      cpu: 55,
      disk: 40,
      networkIn: 80,
      networkOut: 80
    }
  },
  {
    name: 'CA-06',
    uptime: '99.95%',
    type: 'Server',
    lastDown: 'since 1d 19h ago',
    added: '21 Dec 2023',
    checked: '1 min ago',
    status: 'active',
    action: 'Yes',
    usage: {
      ram: 70, // in percentage
      cpu: 55,
      disk: 40,
      networkIn: 80,
      networkOut: 80
    }
  },
  // ... more servers
    ]);

  const options = {
    //responsive: true,
    language: {
        search: "", // Set to an empty string to remove the label
        paginate: {
            first: "<<", // or use a more appropriate character/icon
            previous: "<",
            next: ">",
            last: ">>" // or use a more appropriate character/icon
        }
    },
    dom: `
        <'flex flex-row flex-wrap pt-2 justify-between'<'flex-grow'f><'flex-grow'B>>
        <'row'<'col-sm-12'tr>>
        <'flex flex-row flex-wrap space-x-2 justify-between'<'flex-grow'li><'flex-grow'p>>
    `,
    initComplete: function() {
        // Tailwind styling for the search box
        const searchBox = document.querySelector('div.dataTables_filter input');
        searchBox.classList.remove('input-sm');
        searchBox.classList.add('form-input', 'border', 'bg-transparent', 'text-white', 'placeholder-white', 'shadow-inner', 'rounded', 'mb-3');
        searchBox.setAttribute('placeholder', 'Search...');

        const pagination = document.querySelector('.dataTables_paginate');
        if (pagination) {
            pagination.classList.add('flex', 'items-center', 'space-x-2', 'justify-end', 'mt-3');

            // Find and style pagination buttons
            const paginateButtons = pagination.querySelectorAll('.paginate_button');
            paginateButtons.forEach(button => {
                button.classList.add('px-2', 'py-1', 'rounded-md', 'bg-opacity-50', 'hover:bg-opacity-75');
                // Apply additional styles or conditional styles based on active/disabled state
            });

            // Style the active page button differently
            const activeButton = pagination.querySelector('.paginate_button.current');
            if (activeButton) {
                activeButton.classList.add('bg-blue-500', 'text-white');
            }
        }

        // Style the information text
        document.querySelector('.dataTables_info').classList.add('text-sm', 'text-gray-100');
        document.querySelector('.dataTables_length').classList.add('text-sm', 'text-gray-100');

        const lengthSelect = document.querySelector('.dataTables_length select');
        if (lengthSelect) {
        lengthSelect.classList.add('form-select', 'rounded-md', 'shadow-sm', 'border', 'border-gray-500', 'text-gray-100', 'bg-contrast', 'mt-3');

        // Optionally, you can wrap the select in a div for better styling

        // Wrap the select element with the new wrapper
        lengthSelect.parentNode.insertBefore(wrapper, lengthSelect);
        wrapper.appendChild(lengthSelect);

        // Style the "Show [number] entries" text
        const label = document.querySelector('.dataTables_length label');
        if (label) {
            label.childNodes.forEach((node) => {
            if (node.nodeType === 3) { // Node is text
                const span = document.createElement('span');
                span.textContent = node.textContent;
                span.classList.add('text-sm', 'text-gray-100',); // Tailwind classes for styling text
                node.replaceWith(span);
            }
            });
        }
        }
    },
    data: servers.value,
    columns: [
        { data: 'name', width: '30%' },
        { data: 'uptime' },
        { data: 'type' },
        { data: 'lastDown' },
        { data: 'added' },
        { data: 'checked' },
        { data: 'status', // This is the data key that contains the status
            render: function(data, type, row) {
                const stateClass = data === 'Maintenance Mode' ? 'bg-yellow-400'
                                : data === 'Maintenance Mode (without notifications)' ? 'bg-yellow-300'
                                : 'bg-green-400'; // Active state

                return `
                <div x-data="{ open: false }" @click.away="open = false" class="relative">
                    <button @click="open = !open" class="${stateClass} text-white text-sm rounded-md px-2 py-1">
                    ${data}
                    <svg class="fill-current h-4 w-4 transform inline-block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M5.707 7.293a1 1 0 0 1 1.414 0L10 10.172l2.879-2.879a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 1 1 1.414-1.414z"/>
                    </svg>
                    </button>
                    <div x-show="open" class="absolute bg-white shadow overflow-hidden rounded-md mt-1 z-10" style="display: none;">
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Maintenance Mode (with notifications)</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Maintenance Mode (without notifications)</a>
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Schedule Maintenance</a>
                    </div>
                </div>
                `;
            }
        },
        { data: 'action' },
    ],
    columnDefs: [
        { targets: 0, sortable: true },  // Enable sorting on the first column.
        { targets: 1, sortable: true },  // Enable sorting on the second column.
        { targets: [6, 7], sortable: false } // Disable sorting on the seventh and eighth columns.
    ],
    createdRow: function (row, data, dataIndex) {
        const cells = row.getElementsByTagName('td');
        for (let i = 0; i < cells.length; i++) {
            cells[i].classList.add('text-center', 'text-sm', 'px-3', 'py-2', 'whitespace-nowrap', 'text-gray-100', 'border', 'border-gray-500');
        }

        // Name Cell with Status Rows.
        const nameCell = row.getElementsByTagName('td')[0]; // Get the "Name" cell
        nameCell.innerHTML = `
            <div class="text-sm font-medium text-gray-100 text-left">${data.name}</div>
            <div class="flex flex-col space-y-1 mt-1">
                <div class="rounded h-1 relative" title="RAM ${data.usage.ram}%">
                    <div class="bg-blue-500 h-1 rounded" style="width: ${data.usage.ram}%"></div>
                </div>
                <div class="rounded h-1 relative" title="CPU ${data.usage.cpu}%">
                    <div class="bg-green-500 h-1 rounded" style="width: ${data.usage.cpu}%"></div>
                </div>
                <div class="rounded h-1 relative" title="Disk ${data.usage.disk}%">
                    <div class="bg-yellow-500 h-1 rounded" style="width: ${data.usage.disk}%"></div>
                </div>
                <div class="rounded h-1 relative" title="Network ${data.usage.network}%">
                    <div class="bg-red-500 h-1 rounded" style="width: ${data.usage.network}%"></div>
                </div>
            </div>
            `;

        // Action Cell Button
        const actionCell = cells[cells.length - 1];
        actionCell.classList.add('relative');
        actionCell.innerHTML = `
            <div class="dropdown relative">
            <button class="dropdown-button text-white bg-blue-500 hover:bg-blue-700 font-medium py-1 px-4 rounded inline-flex items-center">
                Action
                <svg class="fill-current h-4 w-4 ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M5.516 7.548c0-0.258 0.099-0.516 0.294-0.71 0.195-0.195 0.451-0.294 0.71-0.294h7.96c0.259 0 0.516 0.099 0.71 0.294 0.195 0.195 0.294 0.452 0.294 0.71 0 0.258-0.099 0.516-0.294 0.71l-3.98 3.979c-0.195 0.196-0.452 0.294-0.71 0.294s-0.516-0.099-0.71-0.294l-3.979-3.979c-0.195-0.194-0.294-0.452-0.294-0.71z"></path>
                </svg>
            </button>
            <ul class="dropdown-menu absolute hidden text-gray-700 pt-1">
                <li class=""><a class="rounded-t bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Uptime Report Link</a></li>
                <!-- ... other dropdown items ... -->
                <li class=""><a class="rounded-b bg-gray-200 hover:bg-gray-400 py-2 px-4 block whitespace-no-wrap" href="#">Delete Monitor</a></li>
            </ul>
            </div>
        `;

        // Add a click event listener to the button to toggle the dropdown
        const dropdownButton = actionCell.querySelector('.dropdown-button');
        dropdownButton.onclick = function() {
            this.nextElementSibling.classList.toggle('hidden');
        };

        // Close the dropdown when clicking outside
        window.onclick = function(event) {
            if (!event.target.matches('.dropdown-button')) {
            var dropdowns = document.getElementsByClassName('dropdown-menu');
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('hidden')) {
                openDropdown.classList.add('hidden');
                }
            }
            }
        };
    }

  };

  </script>

