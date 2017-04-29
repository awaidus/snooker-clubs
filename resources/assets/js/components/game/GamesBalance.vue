<template>
    <div>


        <div class="panel panel-danger">
            <div class="panel-heading">Total Balance<strong> </strong></div>

            <table class="table table-condensed table-bordered">
                <tbody>
                <tr>
                    <th>Table</th>
                    <th>Game</th>
                </tr>

                <tr v-for="table in club.tables">
                    <td><h4><span class="label label-default">{{table.table_no}}</span></h4></td>
                    <td>
                        <table class="table table-condensed"
                               style="font-size: 12px;margin-bottom: 1px;background-color;#ffffff">
                            <tbody>
                            <tr class="info">
                                <th>Type</th>
                                <th>Time</th>
                                <th>Bill</th>
                                <th>Players</th>
                                <th></th>

                            </tr>
                            <tr v-for="game in table.games" v-show="game.total_payments < (game.bill - game.discount)"
                                :class="{danger: !game.ended_at}">

                                <td>{{ game.type.game_type }}</td>
                                <td>
                                    <div v-if="game.started_at">Started:{{ game.started_at.date | dateTime }}</div>
                                    <div v-if="game.ended_at">Ended:{{ game.ended_at.date | dateTime }}</div>
                                </td>

                                <td>

                                    Bill: <span class="label label-default">{{ game.bill - game.discount }}</span>
                                    Paid: <span class="label label-danger">{{ game.total_payments }}</span>

                                </td>

                                <td>
                                    <div v-for="player in game.players">{{ player.player_name }}</div>
                                </td>

                                <td>
                                    <button type="button" class="btn btn-success btn-xs"
                                            @click="setGame(game)"
                                            data-toggle="modal" data-target="#paymentModal">
                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                    </button>
                                </td>

                            </tr>
                            </tbody>
                        </table>
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


                            <table class="table table-condensed table-bordered"
                                   style="margin-bottom: 5px; font-size:12px;">
                                <tbody>
                                <tr>
                                    <th>Game</th>
                                    <th>Started</th>
                                    <th>Ended</th>
                                    <th>Bill</th>
                                    <th>Players</th>
                                </tr>
                                <tr>
                                    <td><span v-if="game.type">{{ game.type.game_type }}</span></td>
                                    <td>
                                        <div v-if="game.started_at">{{ game.started_at.date | dateTime }}</div>
                                    </td>
                                    <td>
                                        <div v-if="game.ended_at">{{ game.ended_at.date | dateTime }}</div>
                                    </td>
                                    <td>
                                        Bill: <span class="label label-default">{{ game.bill - game.discount }}</span>
                                        Paid: <span class="label label-danger">{{ game.total_payments }}</span>
                                    </td>
                                    <td>
                                        <div v-for="player in game.players">{{ player.player_name }}</div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>


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

        props: ['club'],


        data: () => ({
            //club: [],
            total_balance: '',
            errors: [],
            payment: {
                id: '',
                game_id: '',
                amount: '',
                receive_date: ''
            },

            game: {}

        }),

        created() {

        },

        methods: {

            setGame(game){
                this.game = game;
                this.payment.game_id = game.id;
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

            dateTime(value){
                return moment(value).format('D-MM-YY@h:mm a');
            }
        }


    }


</script>
