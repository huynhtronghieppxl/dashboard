@extends('layouts.layout')
@section('content')
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body">
                <div class="row">
                    <div class="col-xl-12 filter-bar">
                        <!-- Nav Filter tab start -->
                        <nav class="navbar navbar-light bg-faded m-b-30 p-10">
                            <div class="card-block p-t-10">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search here...">
                                    <span class="input-group-addon" id="basic-addon1"><i class="icofont icofont-search"></i></span>
                                </div>
                                <div class="task-right">
                                    <div class="task-right-header-status">
                                        <span data-toggle="collapse">Completed Status</span>
                                        <i class="icofont icofont-rounded-down f-right"></i>
                                    </div>
                                    <!-- end of sidebar-header completed status-->
                                    <div class="taskboard-right-progress">
                                        <h6>Highest Priority</h6>
                                        <div class="faq-progress">
                                            <div class="progress">
                                                <!-- <span class="faq-text3"></span> -->
                                                <div class="faq-bar3" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <h6>High Priority</h6>
                                        <div class="faq-progress">
                                            <div class="progress">
                                                <!-- <span class="faq-text1"></span> -->
                                                <div class="faq-bar1" style="width: 70%;"></div>
                                            </div>
                                        </div>
                                        <h6>Normal Priority</h6>
                                        <div class="faq-progress">
                                            <div class="progress">
                                                <!-- <span class="faq-text2"></span> -->
                                                <div class="faq-bar2" style="width: 50%;"></div>
                                            </div>
                                        </div>
                                        <h6>Low Priority</h6>
                                        <div class="faq-progress">
                                            <div class="progress">
                                                <!-- <span class="faq-text4"></span> -->
                                                <div class="faq-bar4" style="width: 60%;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of task-board-right progress -->
                                    <!-- start task right users -->
                                    <div class="task-right-header-users">
                                        <span data-toggle="collapse">Assign Users</span>
                                        <i class="icofont icofont-rounded-down f-right"></i>
                                    </div>
                                    <div class="user-box assign-user taskboard-right-users">
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="#">
                                                    <img class="media-object img-radius" src="..\files\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                    <div class="live-status bg-danger"></div>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6>Josephin Doe</h6>
                                                <p>Santa Ana,CA</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="#">
                                                    <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                                    <div class="live-status bg-success"></div>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6>Josephin Doe</h6>
                                                <p>Huntingston, NJ</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="#">
                                                    <img class="media-object img-radius" src="..\files\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                                    <div class="live-status bg-danger"></div>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6>Josephin Doe</h6>
                                                <p>Willingstion, WA</p>
                                            </div>
                                        </div>
                                        <div class="media">
                                            <div class="media-left media-middle photo-table">
                                                <a href="#">
                                                    <img class="media-object img-radius" src="..\files\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                                    <div class="live-status bg-success"></div>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <h6>Josephin Doe</h6>
                                                <p>Illions, IL</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end of task-board-right users -->
                                    <div class="task-right-header-revision">
                                        <span data-toggle="collapse">Revision</span>
                                        <i class="icofont icofont-rounded-down f-right"></i>
                                    </div>
                                    <div class="taskboard-right-revision user-box">
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="btn btn-outline-primary btn-lg txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-gears"></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="chat-header">Drop the IE specific hacks for temporal inputs</div>
                                                <p class="chat-header  text-muted">4 minutes ago</p>
                                            </div>
                                            <!-- end of media body -->
                                        </div>
                                        <!-- end of media -->
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="btn btn-outline-danger btn-lg txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-share"></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="chat-header">Have Carousel ignore keyboard events</div>
                                                <p class="chat-header  text-muted">12 Dec,2015</p>
                                            </div>
                                            <!-- end of media body -->
                                        </div>
                                        <!-- end of media -->
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="btn btn-outline-warning btn-lg txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-font"></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="chat-header">Add full font overrides for popovers and tooltips</div>
                                                <p class="chat-header text-muted">2 month ago</p>
                                            </div>
                                            <!-- end of media body -->
                                        </div>
                                        <!-- end of media -->
                                        <div class="media">
                                            <div class="media-left">
                                                <a class="btn btn-outline-success btn-lg txt-muted btn-icon" href="#!" role="button"><i class="icofont icofont-responsive"></i>
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div class="chat-header">Responsive Asssignment</div>
                                                <p class="chat-header  text-muted">6 month ago</p>
                                            </div>
                                            <!-- end of media body -->
                                        </div>
                                        <!-- end of media -->
                                    </div>
                                    <!-- end of task-right-revision -->
                                </div>
                                <!-- end of sidebar-right -->
                            </div>
                            <div class="nav-item nav-grid">
                                <span class="m-r-15">View Mode: </span>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light m-r-10" data-toggle="tooltip" data-placement="top" title="" data-original-title="list view">
                                    <i class="icofont icofont-listine-dots"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="grid view">
                                    <i class="icofont icofont-table"></i>
                                </button>
                            </div>
                        </nav>
                        <!-- Nav Filter tab end -->
                        <!-- Task board design block start-->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card card-border-default">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown3" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-primary">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown4" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown5" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown7" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown7" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown8" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown8" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown9" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown9" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-info">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown10" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown11" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown12" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-warning">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown13" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown13" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown14" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown15" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown15" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-danger">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown16" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown16" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown17" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown17" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown18" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown18" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-inverse">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown19" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown19" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown20" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown21" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card card-border-success">
                                    <div class="card-header">
                                        <a href="#" class="card-title">#24. Create UI design model </a>
                                        <span class="label label-default f-right"> 28 January, 2015 </span>
                                    </div>
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p class="task-detail">A collection of textile samples lay spread out on the table One morning, when Gregor Samsa woke from troubled.</p>
                                                <p class="task-due"><strong> Due : </strong><strong class="label label-danger">23 hours</strong></p>
                                            </div>
                                            <!-- end of col-sm-8 -->
                                        </div>
                                        <!-- end of row -->
                                    </div>
                                    <div class="card-footer">
                                        <div class="task-list-table">
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-1.jpg" alt="1"></a>
                                            <a href="#!"><img class="img-fluid img-radius" src="..\files\assets\images\avatar-2.jpg" alt="1"></a>
                                            <a href="#!"><i class="icofont icofont-plus"></i></a>
                                        </div>
                                        <div class="task-board">
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-primary btn-mini dropdown-toggle waves-effect waves-light" type="button" id="dropdown22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Normal</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown22" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-danger"></span>Highest priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-warning"></span>High priority</a>
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!"><span class="point-marker bg-success"></span>Normal priority</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><span class="point-marker bg-info"></span>Low priority</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown23" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Open</button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown23" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect active" href="#!">Open</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">On hold</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Resolved</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Closed</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Dublicate</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Invalid</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!">Wontfix</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of dropdown-secondary -->
                                            <div class="dropdown-secondary dropdown">
                                                <button class="btn btn-grd-disabled btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown24" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown24" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-alarm"></i> Check in</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-attachment"></i> Attach screenshot</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-spinner-alt-5"></i> Reassign</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-ui-edit"></i> Edit task</a>
                                                    <a class="dropdown-item waves-light waves-effect" href="#!"><i class="icofont icofont-close-line"></i> Remove</a>
                                                </div>
                                                <!-- end of dropdown menu -->
                                            </div>
                                            <!-- end of seconadary -->
                                        </div>
                                        <!-- end of pull-right class -->
                                    </div>
                                    <!-- end of card-footer -->
                                </div>
                            </div>
                        </div>
                        <!-- Task board design block end -->
                    </div>
                    <!-- Left column end -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
