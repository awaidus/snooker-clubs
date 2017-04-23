<template>
    <div>
        <div class="panel panel-danger">
            <div class="panel-heading">Total Balance<strong> </strong></div>

            <table class="table table-hover table-condensed table-bordered">
                <tbody>
                <tr>
                    <th>Table</th>
                    <th>Game</th>
                </tr>

                <tr v-for="table in club.tables">
                    <td><h3><span class="label label-default">{{table.table_no}}</span></h3></td>
                    <td>
                        <ul class="list-group">
                            <li class="list-group-item" v-for="game in table.games"
                                v-show="game.total_payments < (game.bill - game.discount)">
                                {{ game.started_at.date | date }}
                                <div>
                                    Bill: <span class="label label-default">{{ game.bill - game.discount }}</span>
                                    Payment: <span class="label label-danger">{{ game.total_payments }}</span>

                                    <button type="button" class="btn btn-success btn-xs btn-block"
                                            @click="setGameId(game.id)"
                                            data-toggle="modal" data-target="#paymentModal">

                                        Make Payment <i class="fa fa-arrow-right" aria-hidden="true"></i>

                                    </button>

                                </div>

                            </li>
                        </ul>

                    </td>
                </tr>

                </tbody>
            </table>


            <div class="panel-footer">

                <h3>Total: <span class="label label-danger">{{ total_balance }}</span></h3>

            </div>

            <div class="modal fade" tabindex="-1" role="dialog" id="paymentModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Payment</h4>
                        </div>


                        <div class="modal-body">

                            <form class="form-horizontal" method="POST" action="/transaction/store">

                                <input type="hidden" id="id">
                                <input type="hidden" id="game_id" v-model="payment.game_id">

                                <div class="form-group">
                                    <label for="amount" class="col-sm-3 control-label">Amount</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="amount" v-model="payment.amount">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="receive_date" class="col-sm-3 control-label">
                                        Receive Date</label>
                                    <div class="col-sm-8">
                                        <!--<input type="text" class="form-control" id="receive_date"-->
                                        <!--v-model="payment.receive_date" data-type="date">-->
                                        <input type="date" class="form-control" id="receive_date"
                                               v-model="payment.receive_date">
                                    </div>
                                </div>
                            </form>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class='btn btn-success' @click="onSubmit">Save</button>

                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </div>


    </div>
</template>

<script type="text/babel">

    // import Modal from '../components/Modal.vue'


    export default{
        components: {
            //paymentModal: Modal
        },

        props: ['clubId'],


        data: () => ({
            club: [],
            total_balance: '',
            errors: [],
            payment: {
                id: '',
                game_id: '',
                amount: '',
                receive_date: ''
            }
        }),

        created() {

            this.fetchClubData();

        },

        methods: {

            fetchClubData() {
                axios.get('/api/games/' + this.clubId, {
                    // params: {
                    //     club_id: 1
                    // }
                })
                        .then(response => {
                            this.club = response.data.club;
                            //this.total_balance = response.data.total_balance;
                            //console.log(response.data);
                        })
                        .catch(e => {
                            this.errors.push(e)
                        })
            },

            setGameId(gameId){
                this.payment.game_id = gameId
            },

            onSubmit(){
                let _this = this;
                axios.post('/transaction/store', this.payment)

                        .then(function (response) {

                            _this.fetchClubData();
                            _this.clearForm();

                            $('#paymentModal').modal('hide');

                            toastr.success('Successful saved.');

                        });

            },


            clearForm(){
                this.payment = {
                    game_id: '',
                    amount: '',
                    receive_date: ''
                }
            }


        },

        computed: {
            pending: function (game) {
                return game.total_payments < (game.bill - game.discount);
            }
            // totalPayments: function(items){
            //     return items.reduce(function(prev, item){
            //         return sum + item.amount;
            //     },0);
            // }
        },

        filters: {

            date(date){
                return moment(date).format('D-MM-YYYY @ h:mm a');
            }
        }


    }


</script>
