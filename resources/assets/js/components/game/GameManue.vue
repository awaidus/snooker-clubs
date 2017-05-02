<template>
    <div>
        <h1>Game Hall
            <small>({{club.club_name}})</small>
        </h1>

        <div class="row">
            <div class="col-md-12">

                @if(Sentinel::inRole('super') || Sentinel::inRole('admin'))
                <a href="getGameTableURL" class="btn btn-default">
                    <i class="fa fa-plus" aria-hidden="true"></i> New Table
                </a>
                @endif

                <a href="getShowGameURL" class="btn btn-info"> <i class="fa fa-plus"></i> New Game
                </a>

                <a href="{{route('showPlayers')}}" class="btn btn-default">
                    <i class="fa fa-list" aria-hidden="true"></i> Players</a>
                <a href="{{route('showTransactions')}}" class="btn btn-default">
                    <i class="fa fa-book" aria-hidden="true"></i> Payments Summery</a>

                <a href="{{route('listGames', ['club_id', session('club_id')])}}" class="btn btn-info">
                    <i class="fa fa-list" aria-hidden="true"></i> All Games
                </a>
            </div>
        </div>

    </div>
</template>

<script type="text/javascript">

    export default{

        props: ['club'],

        data(){
            return {
                msg: 'hello vue'
            }
        },

        computed: {
            getGameTableURL(){
                return 'game-table/show/' + club.id;
            }
        }

    }
</script>
