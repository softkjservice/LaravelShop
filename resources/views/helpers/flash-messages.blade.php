@if (session('status'))
    <div class="row">
        <div clas="col-12" >
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert" aria-hidden="true">
                    &times;
                </button>
                {{ session('status')}}&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            </div>
        </div>
    </div>
@endif
