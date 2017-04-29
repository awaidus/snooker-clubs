<template>

    <div>

        <div class="panel panel-primary">
            <div class="panel-heading">Games</div>

            <table class="table table-bordered table-condensed">
                <tbody>
                <tr>
                    <th>Table</th>
                    <th>Games</th>

                </tr>

                <tr v-for="table in club.tables">
                    <td>
                        <h3>
                            <span :class="{'label label-success': countActiveGames(table.games) > 0}">{{ table.table_no }}</span>
                        </h3>
                    </td>

                    <td>
                        <table class="table table-condensed table-hover" style="margin-bottom: 1px;"
                               v-if="countActiveGames(table.games) > 0">
                            <tbody>
                            <tr class='info'>
                                <th>Game</th>
                                <th>Started at</th>
                                <th>Bill</th>
                                <th>Player</th>
                                <th></th>
                            </tr>
                            <tr v-for="game in table.games" v-if="! game.ended_at">
                                <td>{{ game.type.game_type }}</td>
                                <td>
                                    <div v-if="game.started_at">Started:{{ game.started_at.date | dateTime }}</div>
                                </td>

                                <td>{{ game.bill - game.discount }}</td>
                                <td>
                                    <div v-for="player in game.players">{{ player.player_name }}</div>
                                </td>
                                <td>
                                    <a :href="getGameURL(game.id)" class="btn btn-default btn-sm">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>


                    </td>
                    <td></td>
                </tr>
                </tbody>
            </table>

        </div>


    </div>

</template>

<script type="text/babel">


    export default{

        props: ['club'],

        data(){
            return {}
        },

        methods: {

            getGameURL(id){

                return '/game/show/' + id;
            },

            countActiveGames(games){
                //return _.sumBy(games, i => (!i.ended_at));
                return _.filter(games, function (game) {
                    if (!game.ended_at) return game
                }).length;
            },
        },

        computed: {},

        filters: {

            dateTime(value){
                return moment(value).format('D-MM-YY@h:mm a');
            }
        }


    }


</script>
