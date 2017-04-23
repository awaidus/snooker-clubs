<template>

    <div>


        <table class="table table-hover table-condensed table-bordered">
            <tbody>
            <tr>
                <th>Date</th>
                <th>Table</th>
                <th>Game Type</th>
                <th>Players</th>
                <th>Game Started on</th>
                <th>Game Ended on</th>
                <th>Bill</th>
                <th>Payment</th>
                <th></th>
            </tr>

            <tr v-for="game in club.games">

                <td>{{game.working_day.date | date }}</td>
                <td>{{game.table.table_no }}</td>
                <td>{{game.game_type.game_type }}</td>
                <td>
                    <ul class="fa-ul" v-for="player in game.players">
                        <li><i class="fa-li fa fa-user-o"></i>{{player.player_name}}</li>
                    </ul>

                </td>

                <td>{{game.started_at.date | dateTime }}</td>

                <td><span v-if="game.ended_at">{{ game.ended_at.date | dateTime}}</span></td>

                <td>{{game.bill - game.discount}}</td>

                <td>{{game.total_payments}}</td>
                <td>
                    <a :href="showGameURL(game.id)" class="btn btn-default"><i class="fa fa-edit"></i></a>
                    <button class="btn btn-danger" @click="deleteGame(game.id)"><i class="fa fa-trash"></i></button>
                </td>
            </tr>

            </tbody>
        </table>
    </div>

</template>

<script type="text/babel">


    export default{


        props: ['clubId'],

        data(){

            return {
                club: []
            }


        },

        created() {

            this.fetchGameData();

        },

        methods: {

            fetchGameData() {
                axios.get('/api/gamesList/' + this.clubId)
                        .then(response => {
                            this.club = response.data.club;
                            //console.log(response.data);
                        })
                        .catch(e => {

                            this.errors.push(e)
                        })
            },

            deleteGame(id){
                let _this = this;

                axios.get('/game/destroy/' + id)

                        .then(response => {

                            _this.fetchGameData();
                            toastr.success('Game is deleted.')

                        });
            },

            showGameURL(id){

                return '/game/show/' + id;
            }


        },

        filters: {

            dateTime (value){

                if (value) {
                    return moment(value).format('D-MM-YYYY @ h:mm a');
                }

            },

            date (value){

                if (value) {
                    return moment(value).format('D-MM-YYYY');
                }

            },

            searchForIn: function (data, value, keys) {
                keys = keys.split(/, ?/);

                var matches = [];

                data.forEach(function (obj) {
                    keys.forEach(function (path) {
                        var propVal = this.path(obj, path);
                        if (propVal && propVal == value) {
                            matches.push(obj);
                        }
                    }.bind(this));
                }.bind(this));

                return matches;
            }

        }

    }


</script>
