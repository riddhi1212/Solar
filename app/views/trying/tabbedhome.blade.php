<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kashmiri Floods 2014 Person Finder</title>
        {{ HTML::style('http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'); }}
    </head>
    <body>
        <div class="container">
            <div class="stripe">
                <h1>Panels with nav tabs.<span class="pull-right label label-default">:)</span></h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel with-nav-tabs panel-info">
                        <div class="panel-heading">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab1info" data-toggle="tab">Info 1</a></li>
                                    <li><a href="#tab2info" data-toggle="tab">Info 2</a></li>
                                    <li><a href="#tab3info" data-toggle="tab">Really long tab name</a></li>
                                    <li class="dropdown">
                                        <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="#tab4info" data-toggle="tab">How can I contribute?</a></li>
                                            <li><a href="#tab5info" data-toggle="tab">Volunteers</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </span>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="tab1info">Info 1</div>
                                <div class="tab-pane fade" id="tab2info">Info 2A</div>
                                <div class="tab-pane fade" id="tab3info">Info 3M</div>
                                <div class="tab-pane fade" id="tab4info">Info 4</div>
                                <div class="tab-pane fade" id="tab5info">Info 5</div>
                            </div>
                        </div>
                    </div>
                </div>
        	</div>
        </div>
        <br/>
        {{ HTML::script('js/jquery-1.8.3.js'); }}
        {{ HTML::script('js/bootstrap.js'); }}
        {{ HTML::script('js/tabs.js'); }}
    </body>
</html>