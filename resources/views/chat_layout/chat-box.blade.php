<div id="chat_box" class="chat_box pull-right" style="display: none">
    <div class="row">
        <div class="col-xs-12 col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Chat with <i
                            class="chat-user"></i> <i class="redDot"></i></h3>
                    <h5 class="text-white"><i class="last-seen"> </i></h5>
                    <span class="glyphicon glyphicon-remove pull-right close-chat" style="color: white"></span>
                </div>
                <div class="panel-body chat-area">
                </div>
                <div class="panel-footer">
                    <div class="input-group form-controls" style="margin-right: 10px">
                        <textarea style="font-size: 13px" class="form-control w-50 input-sm chat_input"
                            placeholder="Write your message here..."></textarea>
                        <span class="input-group-btn" style="margin: auto">
                            <button  class="btn ml-2 btn-primary btn-sm btn-chat" type="button"
                                data-to-user="" disabled>
                                <i class="glyphicon glyphicon-send"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="to_user_id" value="" />
</div>
