<template>
    <div>
        <div class="modal fade" tabindex="-1" role="dialog" id="gameDetailsModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Game Details</h4>
                    </div>
                    <div class="modal-body">


                        <form method="POST" class="form-horizontal">
                            <input v-model="game.id" type="hidden">
                            <div class="form-group">
                                <label for="working_day" class="control-label col-md-3">Working Day*</label>
                                <div class="col-sm-9">
                                    <input data-type="date" v-model="game.working_day" type="text" id="working_day"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="player_id" class="col-sm-3 control-label">Player</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select multiple="" name="game.player_ids[]" id="player_id"
                                                class="form-control "></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="game_table_id" class="control-label col-md-3">Table</label>
                                <div class="col-sm-9">
                                    <select id="game_table_id" v-model="game.game_table_id"
                                            class="form-control"></select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="game_type_id" class="control-label col-md-3">
                                    Game Type</label>
                                <div class="col-sm-9">
                                    <select id="game_type_id" v-model="game.game_type_id" class="form-control"></select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="started_at" class="control-label col-md-3">Started At*</label>
                                <div class="col-sm-9">
                                    <input data-type="datetime" v-model="game.started_at" type="text"
                                           id="started_at" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ended_at" class="control-label col-md-3">Ended At</label>
                                <div class="col-sm-9">
                                    <input data-type="datetime" v-model="game.ended_at" type="text" id="ended_at"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bill" class="control-label col-md-3">Bill Amount*</label>
                                <div class="col-sm-9">
                                    <input v-model="game.bill" type="text" id="bill" class="form-control">
                                </div>
                            </div>

                            <div class="form-group"><label for="discount"
                                                           class="control-label col-md-3">Discount</label>
                                <div class="col-sm-9"><input v-model="game.discount" type="text" id="discount"
                                                             class="form-control"></div>
                            </div>

                            <div class="form-group"><label for="no_of_players" class="control-label col-md-3">
                                No. of Player</label>
                                <div class="col-sm-9"><select id="no_of_players" v-model="game.no_of_players"
                                                              class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select></div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>

                        </form>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" @click="onGameSubmit">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</template>

<script type="text/javascript">

    export default{

        props: ['game'],

        data(){
            return {
                msg: 'hello vue'
            }
        },

        methods: {

            onGameSubmit(){

                console.log('submitted.')

            }
        }

    }
</script>
