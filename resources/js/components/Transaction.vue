<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" >
                        <div class="card-header">
                            <h3 class="card-title">Transaction List</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-primary" @click="newModal">
                                    <i class="fa fa-plus-square"></i>
                                    Add New
                                </button>
                                <a href="api/transaksi/print" class="btn btn-sm btn-primary">
                                    <i class="fa fa-plus-square"></i>
                                    Export CSV
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Type</th>
                                        <th>Ticket</th>
                                        <th>Jumlah orang</th>
                                        <th>Status</th>
                                        <th>Harga Ticket</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="transaction in transactions.data" :key="transaction.id">

                                        <td>{{transaction.id}}</td>
                                        <td class="text-capitalize">{{transaction.nama_customer}}</td>
                                        <td class="text-capitalize">{{transaction.tipe}}</td>
                                        <td>{{transaction.ticket_code}}</td>
                                        <td>{{transaction.amount}}</td>
                                        <td>{{transaction.status}}</td>
                                        <td>{{transaction.harga_ticket}}</td>
                                        <td>{{transaction.created_by}}</td>
                                        <td>
                                            <a href="#" @click="print(transaction)">
                                                <i class="fa fa-print blue"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="transactions" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-show="!editmode">Create New Transaction</h5>
                            <h5 class="modal-title" v-show="editmode">Update Transaction's Info</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <!-- <form @submit.prevent="createTransaction"> -->

                        <form @submit.prevent="editmode ? updateTransaction() : createTransaction()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input v-model="form.name" type="text" name="name" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('name') }">
                                    <has-error :form="form" field="name"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Type Customer</label>
                                    <select name="type" v-model="form.type" id="type" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('type') }">
                                        <option value="">Select Type Customer</option>
                                        <option value="individual">Individual</option>
                                        <option value="group">Group</option>
                                    </select>
                                    <has-error :form="form" field="type"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Ticket</label>
                                    <select name="type" v-model="form.ticket" id="ticket" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('ticket') }"
                                        v-on:change="countTicket()">
                                        <option value="">Select Ticket</option>
                                        <option v-for="ticket in tickets" :key="ticket.id" :value="ticket.id">
                                            {{ticket.name}}</option>
                                    </select>
                                    <has-error :form="form" field="ticket"></has-error>
                                </div>
                                <div class="form-group" v-if="form.type =='group'">
                                    <label>Jumlah Orang</label>
                                    <input v-model="form.amount" type="number" name="amount" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('amount') }"
                                        v-on:change="countTicket()">
                                    <has-error :form="form" field="amount"></has-error>
                                </div>
                                <div class="form-group">
                                    <label>Harga Ticket</label>
                                    <input v-model="form.harga_ticket" type="number" name="harga_ticket"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('harga_ticket') }"
                                        readonly>
                                    <has-error :form="form" field="harga_ticket"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        data() {
            return {
                editmode: false,
                transactions: {},
                form: new Form({
                    id: '',
                    type: '',
                    ticket: '',
                    amount: 1,
                    harga_ticket: 0,
                    name: ''
                }),
                tickets: []
            }
        },
        methods: {

            getResults(page = 1) {

                this.$Progress.start();

                axios.get('api/transaction?page=' + page).then(({
                    data
                }) => (this.transactions = data.data));

                this.$Progress.finish();
            },
            editModal(transaction) {
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(transaction);
            },
            newModal() {
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },

            loadTransactions() {
                this.$Progress.start();

                axios.get("api/transaction").then(({
                    data
                }) => (this.transactions = data.data));

                this.$Progress.finish();
            },

            createTransaction() {

                this.form.post('api/transaction')
                    .then((response) => {
                        $('#addNew').modal('hide');

                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });

                        this.$Progress.finish();
                        this.loadTransactions();

                    })
                    .catch(() => {

                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    })
            },

            loadTicket() {
                axios.get("api/ticket/code").then(({
                    data
                }) => (this.tickets = data.data));
            },
            countTicket() {
                const ticket = this.tickets.find(x => {
                    return x.id == this.form.ticket
                })
                this.form.harga_ticket = this.form.amount * ticket.harga
            }
        },
        mounted() {
            console.log('Transaction Component mounted.')
        },
        created() {
            this.loadTicket();
            this.$Progress.start();
            this.loadTransactions();
            this.$Progress.finish();
        },
    }

</script>
