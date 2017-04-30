<template>

    <div>

        <div class="col-md-6">

            <games-list :club="clubWithActiveGames">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </games-list>

        </div>

        <div class="col-md-6">

            <games-balance :club="clubWithPendingPayments" @onPaymentSubmit="paymentSubmit()">
                <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
                <span class="sr-only">Loading...</span>
            </games-balance>

        </div>

    </div>


</template>


<script type="text/babel">

    //import GamesBalance from '../components/game/GamesBalance.vue'

    import GamesBalance from '../game/GamesBalance.vue'
    import GamesList from '../game/GameList.vue'


    export default{

        components: {
            GamesBalance, GamesList
        },

        props: ['clubId'],

        data(){
            return {
                clubWithActiveGames: [],
                clubWithPendingPayments: [],
                errors: [],
            }
        },

        mounted() {

            this.fetchGameData();

        },


        methods: {


            fetchGameData() {

                var self = this;

                axios.get('/games/' + this.clubId)
                        .then(response => {
                            self.clubWithPendingPayments = response.data.clubWithPendingPayments;
                            self.clubWithActiveGames = response.data.clubWithActiveGames;
                        })
                        .catch(e => {

                            this.errors.push(e)
                        })
            },


            paymentSubmit(){

                this.fetchGameData();

            },


        },


    }
</script>
