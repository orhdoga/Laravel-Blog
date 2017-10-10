<div class="modal fade" id="myModal" role="dialog">

    <div class="modal-dialog" style="position: absolute; left: 30%; top: 25%;">
  
        <!-- Modal content-->
        <div class="modal-content">
        
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Delete prompt</h4>
            </div>
            
            <div class="modal-body">
                <p>Are you sure you wish to <span style="color: red;"><b>delete</b></span> <i><b>{{ trim($thread->title, '.') }}</b>?</i></p>
            </div>
            
            <div class="modal-footer">
                <form action="{{ url('/threads/' . $thread->tag->name . '/' . $thread->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>    
            </div>

        </div>
    
  </div>

</div>