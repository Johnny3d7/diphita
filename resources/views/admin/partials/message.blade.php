                                        @if(session()->has('message'))
                                        <div class="alert text-white {{ session()->get('type') }} d-flex align-items-center justify-content-between" role="alert">
                                            <div class="alert-text">{{ session()->get('message') }}</div>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ti-close text-white f_s_14"></i>
                                            </button>
                                         </div>
                                        @endif